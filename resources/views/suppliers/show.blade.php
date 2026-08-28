@extends('layouts.app')

@section('title', $supplier->name)

@section('page-heading', $supplier->name)

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
                {{ $supplier->name }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Supplier details and supplied parts.
            </p>

        </div>


        <div class="flex items-center gap-2">

            <a
                href="{{ route('suppliers.index') }}"
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
                href="{{ route('suppliers.edit', $supplier) }}"
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


        {{-- SUPPLIER INFORMATION --}}
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
                    Supplier Information
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Contact and business information.
                </p>

            </div>


            <div class="space-y-5 p-6">


                {{-- Supplier --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Supplier
                    </p>

                    <p class="mt-1 font-medium text-gray-900">
                        {{ $supplier->name }}
                    </p>

                </div>


                {{-- Contact Person --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Contact Person
                    </p>

                    <p class="mt-1 text-gray-900">
                        {{ $supplier->contact_person ?? '—' }}
                    </p>

                </div>


                {{-- Phone --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Phone
                    </p>

                    <p class="mt-1 text-gray-900">
                        {{ $supplier->phone ?? '—' }}
                    </p>

                </div>


                {{-- Email --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Email
                    </p>

                    <p class="mt-1 text-gray-900 break-words">
                        {{ $supplier->email ?? '—' }}
                    </p>

                </div>


                {{-- Address --}}
                <div>

                    <p class="text-sm text-gray-500">
                        Address
                    </p>

                    <p class="mt-1 whitespace-pre-line text-gray-900">
                        {{ $supplier->address ?? '—' }}
                    </p>

                </div>


            </div>

        </div>


        {{-- SUPPLIED PARTS --}}
        <div
            class="
                lg:col-span-2
                bg-white
                border
                border-gray-200
                rounded-xl
                overflow-hidden
            "
        >

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="font-semibold text-gray-900">
                    Supplied Parts
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Parts currently associated with this supplier.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th
                                class="
                                    px-6
                                    py-3
                                    text-left
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Part
                            </th>


                            <th
                                class="
                                    px-6
                                    py-3
                                    text-left
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Stock
                            </th>


                            <th
                                class="
                                    px-6
                                    py-3
                                    text-left
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Cost
                            </th>


                            <th
                                class="
                                    px-6
                                    py-3
                                    text-left
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Selling
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse ($supplier->parts as $part)

                            <tr class="hover:bg-gray-50">


                                {{-- PART --}}
                                <td class="px-6 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $part->name }}
                                    </div>

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $part->part_number ?? 'No part number' }}
                                    </div>

                                </td>


                                {{-- STOCK --}}
                                <td class="px-6 py-4">

                                    @php
                                        $stockClasses = match (true) {
                                            $part->quantity <= 0 => 'bg-red-100 text-red-700',
                                            $part->quantity <= $part->reorder_level => 'bg-yellow-100 text-yellow-700',
                                            default => 'bg-green-100 text-green-700',
                                        };
                                    @endphp

                                    <span
                                        class="
                                            inline-flex
                                            items-center
                                            rounded-full
                                            px-3
                                            py-1
                                            text-xs
                                            font-medium
                                            {{ $stockClasses }}
                                        "
                                    >
                                        {{ $part->quantity }}
                                    </span>

                                </td>


                                {{-- COST --}}
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    ₱{{ number_format($part->cost_price, 2) }}
                                </td>


                                {{-- SELLING --}}
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    ₱{{ number_format($part->selling_price, 2) }}
                                </td>


                            </tr>


                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="
                                        px-6
                                        py-16
                                        text-center
                                    "
                                >

                                    <p class="text-gray-500">
                                        No parts are associated with this supplier.
                                    </p>

                                    <a
                                        href="{{ route('parts.index') }}"
                                        class="
                                            inline-block
                                            mt-3
                                            text-sm
                                            text-blue-600
                                            hover:underline
                                        "
                                    >
                                        View Parts
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


    </div>


    {{-- NOTES --}}
    @if ($supplier->notes)

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
                    {{ $supplier->notes }}
                </p>

            </div>

        </div>

    @endif

</div>

@endsection
