<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with('customer')
            ->latest('appointment_date')
            ->latest('appointment_time');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('device_type', 'like', "%{$search}%")
                    ->orWhere('device_model', 'like', "%{$search}%")
                    ->orWhere('service', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($customerQuery) use ($search) {
                        $customerQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('contact_number', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query
            ->paginate(10)
            ->withQueryString();

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('appointments.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',

            'appointment_date' => 'required|date',

            'appointment_time' => 'nullable',

            'device_type' => 'required|string|max:255',

            'device_model' => 'required|string|max:255',

            'service' => 'required|string|max:255',

            'problem_description' => 'nullable|string',

            'parts_breakdown' => 'nullable|array',

            'parts_breakdown.*.name' => 'nullable|string|max:255',

            'parts_breakdown.*.quantity' => 'nullable|numeric|min:0',

            'parts_breakdown.*.unit_cost' => 'nullable|numeric|min:0',

            'parts_breakdown.*.selling_price' => 'nullable|numeric|min:0',

            'labor_cost' => 'nullable|numeric|min:0',

            'estimated_cost' => 'nullable|numeric|min:0',

            'estimated_profit' => 'nullable|numeric',

            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',

            'payment_status' => 'required|in:unpaid,partial,paid',

            'notes' => 'nullable|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Calculate estimated totals server-side
        |--------------------------------------------------------------------------
        */

        $parts = $request->input('parts_breakdown', []);

        $totalPartsCost = 0;
        $totalPartsSelling = 0;

        foreach ($parts as $part) {

            $quantity = (float) ($part['quantity'] ?? 0);
            $unitCost = (float) ($part['unit_cost'] ?? 0);
            $sellingPrice = (float) ($part['selling_price'] ?? 0);

            $totalPartsCost += $quantity * $unitCost;
            $totalPartsSelling += $quantity * $sellingPrice;
        }

        $laborCost = (float) ($request->input('labor_cost') ?? 0);

        /*
        |--------------------------------------------------------------------------
        | Estimated customer charge
        |--------------------------------------------------------------------------
        |
        | Parts selling price + labor
        |
        */

        $estimatedTotal = $totalPartsSelling + $laborCost;

        /*
        |--------------------------------------------------------------------------
        | Estimated profit
        |--------------------------------------------------------------------------
        |
        | Parts profit + labor
        |
        | Customer pays:
        |     Parts Selling + Labor
        |
        | Your expense:
        |     Parts Unit Cost
        |
        | Profit:
        |     Parts Selling - Parts Cost + Labor
        |
        */

        $estimatedProfit = $estimatedTotal - $totalPartsCost;

        $validated['parts_breakdown'] = $parts;
        $validated['labor_cost'] = $laborCost;
        $validated['estimated_cost'] = $estimatedTotal;
        $validated['estimated_profit'] = $estimatedProfit;

        Appointment::create($validated);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('customer');

        return view(
            'appointments.show',
            compact('appointment')
        );
    }

    public function edit(Appointment $appointment)
    {
        $customers = Customer::orderBy('name')->get();

        return view(
            'appointments.edit',
            compact('appointment', 'customers')
        );
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',

            'appointment_date' => 'required|date',

            'appointment_time' => 'nullable',

            'device_type' => 'required|string|max:255',

            'device_model' => 'required|string|max:255',

            'service' => 'required|string|max:255',

            'problem_description' => 'nullable|string',

            'parts_breakdown' => 'nullable|array',

            'parts_breakdown.*.name' => 'nullable|string|max:255',

            'parts_breakdown.*.quantity' => 'nullable|numeric|min:0',

            'parts_breakdown.*.unit_cost' => 'nullable|numeric|min:0',

            'parts_breakdown.*.selling_price' => 'nullable|numeric|min:0',

            'labor_cost' => 'nullable|numeric|min:0',

            'estimated_cost' => 'nullable|numeric|min:0',

            'estimated_profit' => 'nullable|numeric',

            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',

            'payment_status' => 'required|in:unpaid,partial,paid',

            'notes' => 'nullable|string',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Calculate estimated totals server-side
        |--------------------------------------------------------------------------
        */

        $parts = $request->input('parts_breakdown', []);

        $totalPartsCost = 0;
        $totalPartsSelling = 0;

        foreach ($parts as $part) {

            $quantity = (float) ($part['quantity'] ?? 0);
            $unitCost = (float) ($part['unit_cost'] ?? 0);
            $sellingPrice = (float) ($part['selling_price'] ?? 0);

            $totalPartsCost += $quantity * $unitCost;
            $totalPartsSelling += $quantity * $sellingPrice;
        }

        $laborCost = (float) ($request->input('labor_cost') ?? 0);

        $estimatedTotal = $totalPartsSelling + $laborCost;

        $estimatedProfit = $estimatedTotal - $totalPartsCost;

        $validated['parts_breakdown'] = $parts;
        $validated['labor_cost'] = $laborCost;
        $validated['estimated_cost'] = $estimatedTotal;
        $validated['estimated_profit'] = $estimatedProfit;

        $appointment->update($validated);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}