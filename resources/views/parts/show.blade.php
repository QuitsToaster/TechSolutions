@extends('layouts.app')

@section('title', $part->name)

@section('page-heading', $part->name)

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div
        class="
            flex
            flex-col
            gap-4
            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                {{ $part->name }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Part details and inventory information.
            </p>

        </div>


        <div class="flex items-center gap-2">

            <a
                href="{{ route('parts.index') }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    px-4
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
                Back
            </a>


            <a
                href="{{ route('parts.edit', $part) }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    px-4
                    py-2.5
                    rounded-lg
                    bg-slate-900
                    hover:bg-slate-800
                    text-white
                    text-sm
                    font-medium
                "
            >
                Edit
            </a>

        </div>

    </div>


    {{-- CONTENT --}}
    <div class="grid gap-6 lg:grid-cols-3">


        {{-- MAIN CONTENT --}}
        <div class="space-y-6 lg:col-span-2">


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
                        Basic information about this repair part.
                    </p>

                </div>


                <div class="grid gap-6 p-6 md:grid-cols-2">


                    {{-- Part Name --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Part Name
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $part->name }}
                        </p>

                    </div>


                    {{-- Part Number --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Part Number
                        </p>

                        <p class="mt-1 text-gray-900">
                            {{ $part->part_number ?? '—' }}
                        </p>

                    </div>


                    {{-- Category --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Category
                        </p>

                        <p class="mt-1 text-gray-900">
                            {{ $part->category ?? '—' }}
                        </p>

                    </div>


                    {{-- Brand --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Brand
                        </p>

                        <p class="mt-1 text-gray-900">
                            {{ $part->brand ?? '—' }}
                        </p>

                    </div>


                    {{-- Device Type --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Device Type
                        </p>

                        <p class="mt-1 text-gray-900">
                            {{ $part->device_type ?? '—' }}
                        </p>

                    </div>


                    {{-- Supplier --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Supplier
                        </p>

                        <p class="mt-1 text-gray-900">
                            {{ $part->supplier->name ?? 'No Supplier' }}
                        </p>

                    </div>


                    {{-- Storage Location --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Storage Location
                        </p>

                        <p class="mt-1 text-gray-900">
                            {{ $part->location ?? '—' }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- DESCRIPTION --}}
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
                        Description
                    </h2>

                </div>


                <div class="p-6">

                    <p class="whitespace-pre-line text-sm leading-6 text-gray-600">
                        {{ $part->description ?? 'No description provided.' }}
                    </p>

                </div>

            </div>


            {{-- NOTES --}}
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
                        Notes
                    </h2>

                </div>


                <div class="p-6">

                    <p class="whitespace-pre-line text-sm leading-6 text-gray-600">
                        {{ $part->notes ?? 'No additional notes.' }}
                    </p>

                </div>

            </div>


        </div>


        {{-- SIDEBAR --}}
        <div class="space-y-6">


            {{-- INVENTORY --}}
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
                        Inventory
                    </h2>

                </div>


                <div class="space-y-6 p-6">


                    {{-- Current Stock --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Current Stock
                        </p>

                        <p class="mt-1 text-3xl font-bold text-gray-900">
                            {{ $part->quantity }}
                        </p>

                    </div>


                    {{-- Reorder Level --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Reorder Level
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $part->reorder_level }}
                        </p>

                    </div>


                    {{-- Status --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        @php
                            $statusClasses = [
                                'In Stock' => 'bg-green-100 text-green-700',
                                'Low Stock' => 'bg-yellow-100 text-yellow-700',
                                'Out of Stock' => 'bg-red-100 text-red-700',
                            ];
                        @endphp

                        <span
                            class="
                                mt-2
                                inline-flex
                                items-center
                                rounded-full
                                px-3
                                py-1
                                text-xs
                                font-medium
                                {{ $statusClasses[$part->stock_status] ?? 'bg-gray-100 text-gray-700' }}
                            "
                        >
                            {{ $part->stock_status }}
                        </span>

                    </div>


                </div>

            </div>


            {{-- PRICING --}}
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
                        Pricing
                    </h2>

                </div>


                <div class="space-y-5 p-6">


                    {{-- Cost Price --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Cost Price
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            ₱{{ number_format($part->cost_price, 2) }}
                        </p>

                    </div>


                    {{-- Selling Price --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Selling Price
                        </p>

                        <p class="mt-1 text-xl font-bold text-gray-900">
                            ₱{{ number_format($part->selling_price, 2) }}
                        </p>

                    </div>


                    {{-- Potential Profit --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Potential Profit
                        </p>

                        <p class="mt-1 font-medium text-green-600">
                            ₱{{ number_format($part->selling_price - $part->cost_price, 2) }}
                        </p>

                    </div>


                </div>

            </div>


        </div>

    </div>

</div>

@endsection

