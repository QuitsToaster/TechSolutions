<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Part;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with([
            'part',
            'customer',
            'supplier',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('order_number', 'like', "%{$search}%")

                    ->orWhereHas('customer', function ($customer) use ($search) {

                        $customer->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    })

                    ->orWhereHas('supplier', function ($supplier) use ($search) {

                        $supplier->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    })

                    ->orWhereHas('part', function ($product) use ($search) {

                        $product->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Orders
        |--------------------------------------------------------------------------
        */

        $orders = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalOrders = Order::count();

        $pendingOrders = Order::whereIn('status', [
            'ordered',
            'confirmed',
        ])->count();

        $shippedOrders = Order::where(
            'status',
            'shipped'
        )->count();

        $arrivedOrders = Order::where(
            'status',
            'arrived'
        )->count();

        return view('orders.index', compact(
            'orders',
            'totalOrders',
            'pendingOrders',
            'shippedOrders',
            'arrivedOrders'
        ));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $parts = Part::orderBy('name')
            ->get();

        $customers = Customer::orderBy('name')
            ->get();

        $suppliers = Supplier::orderBy('name')
            ->get();

        return view('orders.create', compact(
            'parts',
            'customers',
            'suppliers'
        ));
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request)
{
    $validated = $request->validate([

        /*
        |--------------------------------------------------------------------------
        | Existing Part
        |--------------------------------------------------------------------------
        */

        'part_id' => [
            'nullable',
            'exists:parts,id',
        ],

        /*
        |--------------------------------------------------------------------------
        | New / Unregistered Part Name
        |--------------------------------------------------------------------------
        */

        'part_name' => [
            'nullable',
            'string',
            'max:255',
        ],

        /*
        |--------------------------------------------------------------------------
        | Existing Supplier
        |--------------------------------------------------------------------------
        */

        'supplier_id' => [
            'nullable',
            'exists:suppliers,id',
        ],

        /*
        |--------------------------------------------------------------------------
        | New Supplier
        |--------------------------------------------------------------------------
        */

        'new_supplier_name' => [
            'nullable',
            'string',
            'max:255',
        ],

        /*
        |--------------------------------------------------------------------------
        | Customer
        |--------------------------------------------------------------------------
        */

        'customer_id' => [
            'nullable',
            'exists:customers,id',
        ],

        /*
        |--------------------------------------------------------------------------
        | Quantity
        |--------------------------------------------------------------------------
        */

        'quantity' => [
            'required',
            'integer',
            'min:1',
        ],

        /*
        |--------------------------------------------------------------------------
        | Unit Price
        |--------------------------------------------------------------------------
        */

        'unit_price' => [
            'required',
            'numeric',
            'min:0',
        ],

        /*
        |--------------------------------------------------------------------------
        | Estimated Arrival
        |--------------------------------------------------------------------------
        */

        'estimated_arrival' => [
            'nullable',
            'date',
        ],

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        'status' => [
            'required',
            'in:ordered,confirmed,shipped,arrived,cancelled',
        ],

        /*
        |--------------------------------------------------------------------------
        | Notes
        |--------------------------------------------------------------------------
        */

        'notes' => [
            'nullable',
            'string',
            'max:5000',
        ],
    ]);


    /*
    |--------------------------------------------------------------------------
    | Create New Supplier If Needed
    |--------------------------------------------------------------------------
    */

    if (
        empty($validated['supplier_id']) &&
        !empty($validated['new_supplier_name'])
    ) {

        $supplier = Supplier::create([
            'name' => $validated['new_supplier_name'],
        ]);

        $validated['supplier_id'] = $supplier->id;
    }


    /*
    |--------------------------------------------------------------------------
    | Make Sure Supplier Exists
    |--------------------------------------------------------------------------
    */

    if (empty($validated['supplier_id'])) {

        return back()
            ->withErrors([
                'supplier_id' =>
                    'Please select an existing supplier or add a new supplier.',
            ])
            ->withInput();
    }


    /*
    |--------------------------------------------------------------------------
    | Make Sure Part Information Exists
    |--------------------------------------------------------------------------
    */

    if (
        empty($validated['part_id']) &&
        empty($validated['part_name'])
    ) {

        return back()
            ->withErrors([
                'part_id' =>
                    'Please select an existing part or enter the item name.',
            ])
            ->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Keep Only One Item Source
    |--------------------------------------------------------------------------
    */

    if (!empty($validated['part_id'])) {

        $validated['part_name'] = null;

    } else {

        $validated['part_id'] = null;
    }


    /*
    |--------------------------------------------------------------------------
    | Calculate Total
    |--------------------------------------------------------------------------
    */

    $validated['total_price'] =
        $validated['quantity'] * $validated['unit_price'];


    /*
    |--------------------------------------------------------------------------
    | Generate Order Number
    |--------------------------------------------------------------------------
    */

    $validated['order_number'] =
        $this->generateOrderNumber();


    /*
    |--------------------------------------------------------------------------
    | Remove Temporary Field
    |--------------------------------------------------------------------------
    */

    unset(
        $validated['new_supplier_name']
    );


    /*
    |--------------------------------------------------------------------------
    | Create Order
    |--------------------------------------------------------------------------
    */

    Order::create($validated);


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('orders.index')
        ->with(
            'success',
            'Order created successfully.'
        );
}

    /**
     * Generate a unique order number.
     */
    private function generateOrderNumber(): string
    {
        do {
            $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(
                Str::random(5)
            );
        } while (
            Order::where('order_number', $orderNumber)->exists()
        );

        return $orderNumber;
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load([
            'part',
            'customer',
            'supplier',
        ]);

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $parts = Part::orderBy('name')
            ->get();

        $customers = Customer::orderBy('name')
            ->get();

        $suppliers = Supplier::orderBy('name')
            ->get();

        $order->load([
            'part',
            'customer',
            'supplier',
        ]);

        return view('orders.edit', compact(
            'order',
            'parts',
            'customers',
            'suppliers'
        ));
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Existing Part
            |--------------------------------------------------------------------------
            */

            'part_id' => [
                'nullable',
                'exists:parts,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Unregistered Part Name
            |--------------------------------------------------------------------------
            */

            'part_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Supplier
            |--------------------------------------------------------------------------
            */

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Customer
            |--------------------------------------------------------------------------
            */

            'customer_id' => [
                'nullable',
                'exists:customers,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | Unit Price
            |--------------------------------------------------------------------------
            */

            'unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | Estimated Arrival
            |--------------------------------------------------------------------------
            */

            'estimated_arrival' => [
                'nullable',
                'date',
            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'in:ordered,confirmed,shipped,arrived,cancelled',
            ],

            /*
            |--------------------------------------------------------------------------
            | Notes
            |--------------------------------------------------------------------------
            */

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Make Sure Part Information Exists
        |--------------------------------------------------------------------------
        */

        if (
            empty($validated['part_id']) &&
            empty($validated['part_name'])
        ) {

            return back()
                ->withErrors([
                    'part_id' =>
                        'Please select an existing part or enter the item name.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Keep Only One Item Source
        |--------------------------------------------------------------------------
        |
        | Existing Part:
        |   part_id = selected ID
        |   part_name = NULL
        |
        | Unregistered Item:
        |   part_id = NULL
        |   part_name = entered name
        |
        */

        if (!empty($validated['part_id'])) {

            $validated['part_name'] = null;

        } else {

            $validated['part_id'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate Total
        |--------------------------------------------------------------------------
        */

        $validated['total_price'] =
            $validated['quantity'] * $validated['unit_price'];


        /*
        |--------------------------------------------------------------------------
        | Update Order
        |--------------------------------------------------------------------------
        */

        $order->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('orders.show', $order)
            ->with(
                'success',
                'Order updated successfully.'
            );
    }
}