@extends('layouts.app')

@section('title', 'Edit Part')

@section('page-heading', 'Edit Part')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Edit Part
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Update part information, inventory, and pricing.
        </p>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div
            class="
                rounded-lg
                border
                border-red-200
                bg-red-50
                px-4
                py-3
                text-sm
                text-red-700
                mb-6
            "
        >

            <ul class="list-inside list-disc">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('parts.update', $part) }}"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- PART INFORMATION --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                overflow-hidden
            "
        >

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="font-semibold text-gray-900">
                    Part Information
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update the basic information for this repair part.
                </p>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">

                {{-- Part Name --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Part Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $part->name) }}"
                        required
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Part Number --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Part Number
                    </label>

                    <input
                        type="text"
                        name="part_number"
                        value="{{ old('part_number', $part->part_number) }}"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Brand --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Brand
                    </label>

                    <input
                        type="text"
                        name="brand"
                        value="{{ old('brand', $part->brand) }}"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Category --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category', $part->category) }}"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Device Type --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Device Type
                    </label>

                    <select
                        name="device_type"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            bg-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                        <option value="">
                            Select Device Type
                        </option>

                        @foreach ([
                            'Smartphone',
                            'Tablet',
                            'Laptop',
                            'Desktop',
                            'Printer',
                            'Other'
                        ] as $type)

                            <option
                                value="{{ $type }}"
                                @selected(old('device_type', $part->device_type) === $type)
                            >
                                {{ $type }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Supplier --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Supplier
                    </label>

                    <select
                        name="supplier_id"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            bg-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                        <option value="">
                            No Supplier
                        </option>

                        @foreach ($suppliers as $supplier)

                            <option
                                value="{{ $supplier->id }}"
                                @selected(old('supplier_id', $part->supplier_id) == $supplier->id)
                            >
                                {{ $supplier->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Storage Location --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Storage Location
                    </label>

                    <input
                        type="text"
                        name="location"
                        value="{{ old('location', $part->location) }}"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>

            </div>

        </div>


        {{-- INVENTORY & PRICING --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                overflow-hidden
            "
        >

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="font-semibold text-gray-900">
                    Inventory & Pricing
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update stock levels and pricing information.
                </p>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2 lg:grid-cols-4">

                {{-- Stock Quantity --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Stock Quantity
                    </label>

                    <input
                        type="number"
                        name="quantity"
                        value="{{ old('quantity', $part->quantity) }}"
                        min="0"
                        required
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Reorder Level --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Reorder Level
                    </label>

                    <input
                        type="number"
                        name="reorder_level"
                        value="{{ old('reorder_level', $part->reorder_level) }}"
                        min="0"
                        required
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Cost Price --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Cost Price
                    </label>

                    <input
                        type="number"
                        name="cost_price"
                        value="{{ old('cost_price', $part->cost_price) }}"
                        min="0"
                        step="0.01"
                        required
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Selling Price --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Selling Price
                    </label>

                    <input
                        type="number"
                        name="selling_price"
                        value="{{ old('selling_price', $part->selling_price) }}"
                        min="0"
                        step="0.01"
                        required
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >

                </div>

            </div>

        </div>


        {{-- DESCRIPTION & NOTES --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                overflow-hidden
            "
        >

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="font-semibold text-gray-900">
                    Description & Notes
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update additional information about this part.
                </p>

            </div>


            <div class="p-6">

                {{-- Description --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="3"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            resize-none
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >{{ old('description', $part->description) }}</textarea>

                </div>


                {{-- Notes --}}
                <div class="mt-5">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            resize-none
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >{{ old('notes', $part->notes) }}</textarea>

                </div>

            </div>

        </div>


        {{-- ACTIONS --}}
        <div class="flex items-center justify-between">

            <a
                href="{{ route('parts.index') }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    px-5
                    py-2.5
                    rounded-lg
                    border
                    border-gray-300
                    hover:bg-gray-50
                    text-sm
                    font-medium
                    text-gray-700
                "
            >
                Cancel
            </a>


            <button
                type="submit"
                class="
                    inline-flex
                    items-center
                    justify-center
                    px-5
                    py-2.5
                    rounded-lg
                    bg-slate-900
                    hover:bg-slate-800
                    text-white
                    text-sm
                    font-medium
                "
            >
                Save Changes
            </button>

        </div>

    </form>

</div>


@endsection

