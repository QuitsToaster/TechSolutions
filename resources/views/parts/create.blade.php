@extends('layouts.app')

@section('title', 'Add Part')

@section('page-heading', 'Add Part')

@section('content')

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="mb-6">

            <h1 class="text-2xl font-bold text-gray-900">
                Add Part
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Add a new repair part to your inventory.
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
            action="{{ route('parts.store') }}"
            class="space-y-6"
        >

            @csrf


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
                        Enter the basic information for this repair part.
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
                            value="{{ old('name') }}"
                            required
                            placeholder="e.g. iPhone 13 LCD Display"
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
                            value="{{ old('part_number') }}"
                            placeholder="e.g. IP13-LCD-001"
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
                            value="{{ old('brand') }}"
                            placeholder="e.g. Apple / JK / GX"
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
                            value="{{ old('category') }}"
                            placeholder="e.g. LCD, Battery, Charging Port"
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

                            <option
                                value="Smartphone"
                                @selected(old('device_type') === 'Smartphone')
                            >
                                Smartphone
                            </option>

                            <option
                                value="Tablet"
                                @selected(old('device_type') === 'Tablet')
                            >
                                Tablet
                            </option>

                            <option
                                value="Laptop"
                                @selected(old('device_type') === 'Laptop')
                            >
                                Laptop
                            </option>

                            <option
                                value="Desktop"
                                @selected(old('device_type') === 'Desktop')
                            >
                                Desktop
                            </option>

                            <option
                                value="Printer"
                                @selected(old('device_type') === 'Printer')
                            >
                                Printer
                            </option>

                            <option
                                value="Other"
                                @selected(old('device_type') === 'Other')
                            >
                                Other
                            </option>

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
                                    @selected(old('supplier_id') == $supplier->id)
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
                            value="{{ old('location') }}"
                            placeholder="e.g. Cabinet A / Shelf 2"
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
                        Set the initial stock and pricing information.
                    </p>

                </div>


                <div class="grid gap-6 p-6 md:grid-cols-2 lg:grid-cols-4">

                    {{-- Initial Stock --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Initial Stock
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            value="{{ old('quantity', 0) }}"
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
                            value="{{ old('reorder_level', 1) }}"
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
                            value="{{ old('cost_price', 0) }}"
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
                            value="{{ old('selling_price', 0) }}"
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
                        Add additional information about this part.
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
                            placeholder="Part description..."
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
                        >{{ old('description') }}</textarea>

                    </div>


                    {{-- Notes --}}
                    <div class="mt-5">

                        <label class="mb-2 block text-sm font-medium text-gray-700">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="3"
                            placeholder="Additional notes..."
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
                        >{{ old('notes') }}</textarea>

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
                    Save Part
                </button>

            </div>

        </form>

    </div>

@endsection