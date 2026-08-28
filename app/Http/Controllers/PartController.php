<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $query = Part::with('supplier')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('part_number', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            match ($request->status) {
                'in_stock' => $query->whereColumn('quantity', '>', 'reorder_level'),
                'low_stock' => $query
                    ->where('quantity', '>', 0)
                    ->whereColumn('quantity', '<=', 'reorder_level'),
                'out_of_stock' => $query->where('quantity', 0),
                default => null,
            };
        }

        $parts = $query->paginate(10)->withQueryString();

        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();

        return view('parts.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'part_number' => 'nullable|string|max:255|unique:parts,part_number',
            'category' => 'nullable|string|max:255',
            'device_type' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        Part::create($validated);

        return redirect()
            ->route('parts.index')
            ->with('success', 'Part added successfully.');
    }

    public function show(Part $part)
    {
        $part->load('supplier');

        return view('parts.show', compact('part'));
    }

    public function edit(Part $part)
    {
        $suppliers = Supplier::orderBy('name')->get();

        return view('parts.edit', compact('part', 'suppliers'));
    }

    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'supplier_id' => 'nullable|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'part_number' => 'nullable|string|max:255|unique:parts,part_number,' . $part->id,
            'category' => 'nullable|string|max:255',
            'device_type' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $part->update($validated);

        return redirect()
            ->route('parts.index')
            ->with('success', 'Part updated successfully.');
    }

    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()
            ->route('parts.index')
            ->with('success', 'Part deleted successfully.');
    }
}