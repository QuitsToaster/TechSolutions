<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    /**
     * Display the price list.
     */
    public function index(Request $request)
    {
        $query = PriceList::query();

        /*
         * Search
         */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('device_type', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('item', 'like', "%{$search}%")
                    ->orWhere('quality', 'like', "%{$search}%");

            });
        }

        /*
         * Device filter
         */
        if ($request->filled('device_type')) {

            $query->where(
                'device_type',
                $request->device_type
            );
        }

        /*
         * Brand filter
         */
        if ($request->filled('brand')) {

            $query->where(
                'brand',
                $request->brand
            );
        }

        /*
         * Active prices only by default.
         */
        $query->where('is_active', true);

        $priceLists = $query
            ->orderBy('brand')
            ->orderBy('model')
            ->orderBy('category')
            ->orderBy('item')
            ->paginate(20)
            ->withQueryString();

        /*
         * Filter options.
         */
        $deviceTypes = PriceList::query()
            ->where('is_active', true)
            ->whereNotNull('device_type')
            ->distinct()
            ->orderBy('device_type')
            ->pluck('device_type');

        $brands = PriceList::query()
            ->where('is_active', true)
            ->whereNotNull('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        return view(
            'price-lists.index',
            compact(
                'priceLists',
                'deviceTypes',
                'brands'
            )
        );
    }


    /**
     * Show the create price form.
     */
    public function create()
    {
        return view('price-lists.create');
    }


    /**
     * Store a new price.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'device_type' => [
                'required',
                'string',
                'max:255',
            ],

            'brand' => [
                'required',
                'string',
                'max:255',
            ],

            'model' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:255',
            ],

            'item' => [
                'required',
                'string',
                'max:255',
            ],

            'quality' => [
                'nullable',
                'string',
                'max:255',
            ],

            'part_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'labor_cost' => [
                'required',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);

        $validated['is_active'] = true;

        PriceList::create($validated);

        return redirect()
            ->route('price-lists.index')
            ->with(
                'success',
                'Price list item added successfully.'
            );
    }


    /**
     * Show the edit price form.
     */
    public function edit(PriceList $priceList)
    {
        return view(
            'price-lists.edit',
            compact('priceList')
        );
    }


    /**
     * Update a price list item.
     */
    public function update(
        Request $request,
        PriceList $priceList
    ) {
        $validated = $request->validate([

            'device_type' => [
                'required',
                'string',
                'max:255',
            ],

            'brand' => [
                'required',
                'string',
                'max:255',
            ],

            'model' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:255',
            ],

            'item' => [
                'required',
                'string',
                'max:255',
            ],

            'quality' => [
                'nullable',
                'string',
                'max:255',
            ],

            'part_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'labor_cost' => [
                'required',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);

        $validated['is_active'] =
            $request->boolean('is_active');

        $priceList->update($validated);

        return redirect()
            ->route('price-lists.index')
            ->with(
                'success',
                'Price list item updated successfully.'
            );
    }


    /**
     * Delete a price list item.
     */
    public function destroy(PriceList $priceList)
    {
        $priceList->delete();

        return redirect()
            ->route('price-lists.index')
            ->with(
                'success',
                'Price list item deleted successfully.'
            );
    }
}