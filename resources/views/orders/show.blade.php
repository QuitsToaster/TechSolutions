@extends('layouts.app')

@section('title', 'Order Details')

@section('page-heading', 'Order Details')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>

            <div class="flex items-center gap-3">

                <h1 class="text-2xl font-bold text-slate-900">
                    Order Details
                </h1>

                @php
                    $statusClasses = [
                        'ordered' => 'bg-blue-50 text-blue-700 border-blue-200',
                        'confirmed' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                        'shipped' => 'bg-amber-50 text-amber-700 border-amber-200',
                        'arrived' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                        'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                    ];

                    $statusLabels = [
                        'ordered' => 'Ordered',
                        'confirmed' => 'Confirmed',
                        'shipped' => 'Shipped',
                        'arrived' => 'Arrived',
                        'cancelled' => 'Cancelled',
                    ];
                @endphp

                <span
                    class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold
                    {{ $statusClasses[$order->status] ?? 'bg-slate-50 text-slate-700 border-slate-200' }}"
                >
                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                </span>

            </div>

            <p class="text-sm text-slate-500 mt-1">
                {{ $order->order_number }}
            </p>

        </div>


        <div class="flex items-center gap-3">

            <a
                href="{{ route('orders.index') }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5 rounded-xl
                       border border-slate-200 bg-white
                       text-sm font-semibold text-slate-700
                       hover:bg-slate-50 transition"
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
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back

            </a>


            <a
                href="{{ route('orders.edit', $order) }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5 rounded-xl
                       bg-slate-900 text-white
                       text-sm font-semibold
                       hover:bg-slate-800 transition"
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
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"
                    />
                </svg>

                Edit Order

            </a>

        </div>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4">

            <div class="flex items-center gap-3">

                <svg
                    class="w-5 h-5 text-emerald-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                <p class="text-sm font-semibold text-emerald-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT SIDE --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- ORDER INFORMATION --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                <div class="px-6 py-5 border-b border-slate-100">

                    <h2 class="text-base font-bold text-slate-900">
                        Order Information
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Details about the ordered item and supplier.
                    </p>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- ORDER NUMBER --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Order Number
                            </p>

                            <p class="mt-1 text-sm font-bold text-slate-900">
                                {{ $order->order_number }}
                            </p>

                        </div>


                        {{-- ITEM --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Part / Item
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                {{ $order->item_name }}
                            </p>

                            @if(!$order->part_id)

                                <span
                                    class="inline-flex mt-2 rounded-full
                                           bg-amber-50 border border-amber-200
                                           px-2.5 py-1 text-xs font-semibold
                                           text-amber-700"
                                >
                                    Not in Inventory
                                </span>

                            @else

                                <span
                                    class="inline-flex mt-2 rounded-full
                                           bg-emerald-50 border border-emerald-200
                                           px-2.5 py-1 text-xs font-semibold
                                           text-emerald-700"
                                >
                                    Inventory Part
                                </span>

                            @endif

                        </div>


                        {{-- PART NUMBER --}}
                        @if($order->part && $order->part->part_number)

                            <div>

                                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                    Part Number
                                </p>

                                <p class="mt-1 text-sm text-slate-700">
                                    {{ $order->part->part_number }}
                                </p>

                            </div>

                        @endif


                        {{-- SUPPLIER --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Supplier
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                {{ $order->supplier?->name ?? '—' }}
                            </p>

                        </div>


                        {{-- CUSTOMER --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Customer
                            </p>

                            <p class="mt-1 text-sm text-slate-700">
                                {{ $order->customer?->name ?? 'No customer' }}
                            </p>

                        </div>


                        {{-- CREATED --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Created
                            </p>

                            <p class="mt-1 text-sm text-slate-700">
                                {{ $order->created_at?->format('M d, Y h:i A') ?? '—' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- QUANTITY & PRICING --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                <div class="px-6 py-5 border-b border-slate-100">

                    <h2 class="text-base font-bold text-slate-900">
                        Quantity & Pricing
                    </h2>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Quantity
                            </p>

                            <p class="mt-2 text-2xl font-bold text-slate-900">
                                {{ number_format($order->quantity) }}
                            </p>

                        </div>


                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Unit Price
                            </p>

                            <p class="mt-2 text-2xl font-bold text-slate-900">
                                ₱{{ number_format((float) $order->unit_price, 2) }}
                            </p>

                        </div>


                        <div class="rounded-xl bg-slate-900 p-5">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Total Cost
                            </p>

                            <p class="mt-2 text-2xl font-bold text-white">
                                ₱{{ number_format((float) $order->total_price, 2) }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- DELIVERY --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                <div class="px-6 py-5 border-b border-slate-100">

                    <h2 class="text-base font-bold text-slate-900">
                        Delivery Information
                    </h2>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Estimated Arrival
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                {{ $order->estimated_arrival?->format('F d, Y') ?? 'Not specified' }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Arrived At
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-900">
                                {{ $order->arrived_at?->format('F d, Y') ?? 'Not yet arrived' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- NOTES --}}
            @if($order->notes)

                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-base font-bold text-slate-900">
                            Notes
                        </h2>

                    </div>

                    <div class="p-6">

                        <p class="text-sm text-slate-700 whitespace-pre-line">
                            {{ $order->notes }}
                        </p>

                    </div>

                </div>

            @endif

        </div>


        {{-- RIGHT SIDE --}}
        <div class="space-y-6">

            {{-- STATUS --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                <div class="px-6 py-5 border-b border-slate-100">

                    <h2 class="text-base font-bold text-slate-900">
                        Order Status
                    </h2>

                </div>

                <div class="p-6">

                    <div class="flex items-center justify-center">

                        <span
                            class="inline-flex items-center rounded-full border px-4 py-2
                            text-sm font-bold
                            {{ $statusClasses[$order->status] ?? 'bg-slate-50 text-slate-700 border-slate-200' }}"
                        >
                            {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- ACTIONS --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                <a
                    href="{{ route('orders.edit', $order) }}"
                    class="w-full inline-flex items-center justify-center gap-2
                           rounded-xl bg-slate-900 px-5 py-3
                           text-sm font-semibold text-white
                           hover:bg-slate-800 transition"
                >

                    Edit Order

                </a>

                <a
                    href="{{ route('orders.index') }}"
                    class="mt-3 w-full inline-flex items-center justify-center
                           rounded-xl border border-slate-200
                           bg-white px-5 py-3
                           text-sm font-semibold text-slate-700
                           hover:bg-slate-50 transition"
                >
                    Back to Orders
                </a>

            </div>

        </div>

    </div>

@endsection