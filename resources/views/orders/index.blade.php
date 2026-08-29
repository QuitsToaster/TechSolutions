@extends('layouts.app')

@section('title', 'Orders')

@section('page-heading', 'Orders')

@section('content')

<div class="space-y-6">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Orders
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Track parts and products ordered from suppliers.
            </p>

        </div>

        <a
            href="{{ route('orders.create') }}"
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
                transition
            "
        >
            + Add Order
        </a>

    </div>


    {{-- STATISTICS --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Total Orders --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <p class="text-sm text-gray-500">
                Total Orders
            </p>

            <p class="text-3xl font-bold text-gray-900 mt-2">
                {{ $totalOrders }}
            </p>

        </div>


        {{-- Pending --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <p class="text-sm text-gray-500">
                Pending Orders
            </p>

            <p class="text-3xl font-bold text-yellow-600 mt-2">
                {{ $pendingOrders }}
            </p>

        </div>


        {{-- Shipped --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <p class="text-sm text-gray-500">
                Shipped
            </p>

            <p class="text-3xl font-bold text-blue-600 mt-2">
                {{ $shippedOrders }}
            </p>

        </div>


        {{-- Arrived --}}

        <div class="bg-white border border-gray-200 rounded-xl p-5">

            <p class="text-sm text-gray-500">
                Arrived
            </p>

            <p class="text-3xl font-bold text-green-600 mt-2">
                {{ $arrivedOrders }}
            </p>

        </div>

    </div>


    {{-- FILTERS --}}

    <div class="bg-white border border-gray-200 rounded-xl p-5">

        <form
            method="GET"
            action="{{ route('orders.index') }}"
            class="grid grid-cols-1 md:grid-cols-3 gap-4"
        >

            {{-- Search --}}

            <div class="md:col-span-2">

                <label
                    for="search"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                    placeholder="Search order number, product, customer or supplier..."
                    class="
                        w-full
                        rounded-lg
                        border
                        border-gray-300
                        px-3
                        py-2.5
                        text-sm
                        focus:border-slate-500
                        focus:ring-slate-500
                    "
                >

            </div>


            {{-- Status --}}

            <div>

                <label
                    for="status"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="
                        w-full
                        rounded-lg
                        border
                        border-gray-300
                        bg-white
                        px-3
                        py-2.5
                        text-sm
                    "
                >

                    <option value="">
                        All Statuses
                    </option>

                    <option
                        value="ordered"
                        @selected(request('status') === 'ordered')
                    >
                        Ordered
                    </option>

                    <option
                        value="confirmed"
                        @selected(request('status') === 'confirmed')
                    >
                        Confirmed
                    </option>

                    <option
                        value="shipped"
                        @selected(request('status') === 'shipped')
                    >
                        Shipped
                    </option>

                    <option
                        value="arrived"
                        @selected(request('status') === 'arrived')
                    >
                        Arrived
                    </option>

                    <option
                        value="cancelled"
                        @selected(request('status') === 'cancelled')
                    >
                        Cancelled
                    </option>

                </select>

            </div>


            {{-- Buttons --}}

            <div class="md:col-span-3 flex gap-2">

                <button
                    type="submit"
                    class="
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
                    Search
                </button>

                <a
                    href="{{ route('orders.index') }}"
                    class="
                        px-4
                        py-2.5
                        rounded-lg
                        border
                        border-gray-300
                        bg-white
                        hover:bg-gray-50
                        text-sm
                        font-medium
                        text-gray-700
                    "
                >
                    Clear
                </a>

            </div>

        </form>

    </div>


    {{-- ORDERS TABLE --}}

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">

            <div>

                <h2 class="font-semibold text-gray-900">
                    Order List
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Track ordered parts, suppliers and expected arrival dates.
                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Order
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Product
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Customer
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Supplier
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Qty
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Price
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Est. Arrival
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Status
                        </th>

                        <th class="text-right px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($orders as $order)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Order --}}

                            <td class="px-6 py-4">

                                <p class="font-medium text-gray-900">
                                    {{ $order->order_number }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $order->created_at?->format('M d, Y') }}
                                </p>

                            </td>


                            {{-- Product --}}

                            <td class="px-6 py-4">

                                <p class="font-medium text-gray-900">

                                    {{ $order->part_name ?? 'Product unavailable' }}

                                </p>

                                @if($order->part)

                                    <p class="text-xs text-gray-500 mt-1">

                                        Part #{{ $order->part->id }}

                                    </p>

                                @endif

                            </td>


                            {{-- Customer --}}

                            <td class="px-6 py-4">

                                @if($order->customer)

                                    <p class="font-medium text-gray-900">
                                        {{ $order->customer->name }}
                                    </p>

                                    @if($order->customer->contact_number)

                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $order->customer->contact_number }}
                                        </p>

                                    @endif

                                @else

                                    <span class="text-gray-400">
                                        No customer
                                    </span>

                                @endif

                            </td>


                            {{-- Supplier --}}

                            <td class="px-6 py-4">

                                @if($order->supplier)

                                    <p class="font-medium text-gray-900">
                                        {{ $order->supplier->name }}
                                    </p>

                                @else

                                    <span class="text-gray-400">
                                        No supplier
                                    </span>

                                @endif

                            </td>


                            {{-- Quantity --}}

                            <td class="px-6 py-4">

                                <span class="font-medium text-gray-900">
                                    {{ $order->quantity }}
                                </span>

                            </td>


                            {{-- Price --}}

                            <td class="px-6 py-4">

                                <p class="font-medium text-gray-900">
                                    ₱{{ number_format($order->unit_price, 2) }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Total:
                                    ₱{{ number_format($order->total_price, 2) }}
                                </p>

                            </td>


                            {{-- Estimated Arrival --}}

                            <td class="px-6 py-4">

                                @if($order->estimated_arrival)

                                    <p class="font-medium text-gray-900">
                                        {{ $order->estimated_arrival->format('M d, Y') }}
                                    </p>

                                    @if($order->status !== 'arrived' && $order->status !== 'cancelled')

                                        @if($order->estimated_arrival->isPast())

                                            <p class="text-xs text-red-600 mt-1">
                                                Overdue
                                            </p>

                                        @else

                                            <p class="text-xs text-gray-500 mt-1">
                                                Expected
                                            </p>

                                        @endif

                                    @endif

                                @else

                                    <span class="text-gray-400">
                                        Not set
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}

                            <td class="px-6 py-4">

                                @php

                                    $statusColors = [

                                        'ordered' =>
                                            'bg-yellow-100 text-yellow-800',

                                        'confirmed' =>
                                            'bg-blue-100 text-blue-800',

                                        'shipped' =>
                                            'bg-purple-100 text-purple-800',

                                        'arrived' =>
                                            'bg-green-100 text-green-800',

                                        'cancelled' =>
                                            'bg-red-100 text-red-800',

                                    ];

                                @endphp

                                <span
                                    class="
                                        inline-flex
                                        px-2.5
                                        py-1
                                        rounded-full
                                        text-xs
                                        font-semibold
                                        {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}
                                    "
                                >

                                    {{ ucfirst($order->status) }}

                                </span>

                            </td>

                            {{-- Actions --}}

                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a
                                        href="{{ route('orders.show', $order) }}"
                                        title="View Order"
                                        class="inline-flex items-center justify-center
                                            w-9 h-9 rounded-lg
                                            border border-slate-200
                                            bg-white
                                            text-slate-600
                                            hover:bg-slate-50
                                            hover:text-blue-600
                                            transition"
                                    >

                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                c4.478 0 8.268 2.943 9.542 7
                                                -1.274 4.057-5.064 7-9.542 7
                                                -4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('orders.edit', $order) }}"
                                        title="Edit Order"
                                        class="inline-flex items-center justify-center
                                            w-9 h-9 rounded-lg
                                            border border-slate-200
                                            bg-white
                                            text-slate-600
                                            hover:bg-slate-50
                                            hover:text-amber-600
                                            transition"
                                    >

                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6
                                                a2 2 0 00-2 2v11
                                                a2 2 0 002 2h11
                                                a2 2 0 002-2v-5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M18.5 2.5
                                                a2.121 2.121 0 013 3L12 15l-4 1
                                                1-4 9.5-9.5z"
                                            />
                                        </svg>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-12 text-center"
                            >

                                <p class="text-sm font-medium text-gray-700">
                                    No orders found.
                                </p>

                                <p class="text-sm text-gray-400 mt-1">
                                    Orders you create will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}

        @if($orders->hasPages())

            <div class="px-6 py-4 border-t border-gray-200">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection