@extends('layouts.app')

@section('title', 'Parts / Inventory')

@section('page-heading', 'Parts / Inventory')

@section('content')

    <div>

        {{-- HEADER --}}
        <div
            class="
                flex
                flex-col
                sm:flex-row
                sm:items-center
                sm:justify-between
                gap-4
            "
        >

            <div>

                <h1 class="text-2xl font-bold text-gray-900">
                    Parts / Inventory
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Manage repair parts, stock levels, pricing, and suppliers.
                </p>

            </div>

            <a
                href="{{ route('parts.create') }}"
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
                + Add Part
            </a>

        </div>


        {{-- SEARCH / FILTER --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                p-5
                mt-6
            "
        >

            <form
                method="GET"
                action="{{ route('parts.index') }}"
                class="
                    flex
                    flex-col
                    sm:flex-row
                    gap-3
                "
            >

                <div class="relative flex-1">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search part name, part number, brand..."
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
                        "
                    >

                </div>


                <select
                    name="status"
                    class="
                        border
                        border-gray-300
                        rounded-lg
                        px-4
                        py-2.5
                        text-sm
                        focus:outline-none
                        focus:ring-2
                        focus:ring-slate-900
                    "
                >

                    <option value="">
                        All Stock
                    </option>

                    <option
                        value="in_stock"
                        @selected(request('status') === 'in_stock')
                    >
                        In Stock
                    </option>

                    <option
                        value="low_stock"
                        @selected(request('status') === 'low_stock')
                    >
                        Low Stock
                    </option>

                    <option
                        value="out_of_stock"
                        @selected(request('status') === 'out_of_stock')
                    >
                        Out of Stock
                    </option>

                </select>


                <button
                    type="submit"
                    class="
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
                    Search
                </button>


                @if(request('search') || request('status'))

                    <a
                        href="{{ route('parts.index') }}"
                        class="
                            px-5
                            py-2.5
                            rounded-lg
                            border
                            border-gray-300
                            hover:bg-gray-50
                            text-sm
                            text-center
                        "
                    >
                        Clear
                    </a>

                @endif

            </form>

        </div>


        {{-- INVENTORY TABLE --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                mt-6
                overflow-hidden
            "
        >

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th
                                class="
                                    text-left
                                    px-6
                                    py-3
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
                                    text-left
                                    px-6
                                    py-3
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Device
                            </th>

                            <th
                                class="
                                    text-left
                                    px-6
                                    py-3
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Supplier
                            </th>

                            <th
                                class="
                                    text-left
                                    px-6
                                    py-3
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
                                    text-left
                                    px-6
                                    py-3
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Selling Price
                            </th>

                            <th
                                class="
                                    text-left
                                    px-6
                                    py-3
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Status
                            </th>

                            <th
                                class="
                                    text-right
                                    px-6
                                    py-3
                                    text-xs
                                    uppercase
                                    tracking-wide
                                    text-gray-500
                                "
                            >
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse ($parts as $part)

                            @php
                                $statusClasses = [
                                    'In Stock' => 'bg-green-100 text-green-700',
                                    'Low Stock' => 'bg-yellow-100 text-yellow-700',
                                    'Out of Stock' => 'bg-red-100 text-red-700',
                                ];
                            @endphp

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4">

                                    <p class="font-medium text-gray-900">
                                        {{ $part->name }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">

                                        @if ($part->part_number)
                                            {{ $part->part_number }}
                                        @else
                                            No part number
                                        @endif

                                        @if ($part->brand)
                                            · {{ $part->brand }}
                                        @endif

                                    </p>

                                </td>


                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $part->device_type ?? '—' }}
                                </td>


                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $part->supplier->name ?? 'No supplier' }}
                                </td>


                                <td class="px-6 py-4">

                                    <span class="font-semibold text-gray-900">
                                        {{ $part->quantity }}
                                    </span>

                                    <span class="text-xs text-gray-500">
                                        / min {{ $part->reorder_level }}
                                    </span>

                                </td>


                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    ₱{{ number_format($part->selling_price, 2) }}
                                </td>


                                <td class="px-6 py-4">

                                    <span
                                        class="
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

                                </td>


                                <td class="px-6 py-4">

                                    <div
                                        class="
                                            flex
                                            justify-end
                                            items-center
                                            gap-2
                                        "
                                    >

                                        <a
                                            href="{{ route('parts.show', $part) }}"
                                            class="
                                                px-3
                                                py-2
                                                text-sm
                                                rounded-lg
                                                bg-gray-100
                                                hover:bg-gray-200
                                            "
                                        >
                                            View
                                        </a>


                                        <a
                                            href="{{ route('parts.edit', $part) }}"
                                            class="
                                                px-3
                                                py-2
                                                text-sm
                                                rounded-lg
                                                bg-blue-50
                                                hover:bg-blue-100
                                                text-blue-700
                                            "
                                        >
                                            Edit
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="
                                        px-6
                                        py-16
                                        text-center
                                    "
                                >

                                    <p class="text-gray-500">
                                        No parts found.
                                    </p>

                                    <a
                                        href="{{ route('parts.create') }}"
                                        class="
                                            inline-block
                                            mt-3
                                            text-sm
                                            text-blue-600
                                            hover:underline
                                        "
                                    >
                                        Add your first part
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if ($parts->hasPages())

                <div class="px-6 py-4 border-t">
                    {{ $parts->links() }}
                </div>

            @endif

        </div>

    </div>

@endsection