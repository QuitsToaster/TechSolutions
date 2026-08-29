@extends('layouts.app')

@section('title', 'Edit Order')

@section('page-heading', 'Edit Order')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>

            <h1 class="text-2xl font-bold text-slate-900">
                Edit Order
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update {{ $order->order_number }}.
            </p>

        </div>


        <div class="flex items-center gap-3">

            <a
                href="{{ route('orders.show', $order) }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5 rounded-xl
                       border border-slate-200 bg-white
                       text-sm font-semibold text-slate-700
                       hover:bg-slate-50 transition"
            >
                View Order
            </a>

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

        </div>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex items-start gap-3">

                <svg
                    class="w-5 h-5 text-red-500 mt-0.5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4m0 4h.01M10.29 3.86l-8.18 14A2 2 0 003.84 21h16.32a2 2 0 001.73-3.14l-8.18-14a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please correct the following errors:
                    </p>

                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('orders.update', $order) }}"
        method="POST"
        id="orderForm"
    >

        @csrf

        @method('PUT')


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ORDER INFORMATION --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-base font-bold text-slate-900">
                            Order Information
                        </h2>

                        <p class="text-sm text-slate-500 mt-1">
                            Select an existing part or enter an unregistered item.
                        </p>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- PART / ITEM --}}
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">

                                    Part / Item

                                    <span class="text-red-500">*</span>

                                </label>


                                {{-- TOGGLE --}}
                                <div class="flex items-center gap-2 mb-3">

                                    <button
                                        type="button"
                                        id="existingPartBtn"
                                        onclick="showExistingPart()"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                        {{ $order->part_id
                                            ? 'bg-slate-900 text-white'
                                            : 'bg-slate-100 text-slate-600' }}"
                                    >
                                        Existing Part
                                    </button>


                                    <button
                                        type="button"
                                        id="unregisteredPartBtn"
                                        onclick="showUnregisteredPart()"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                        {{ !$order->part_id
                                            ? 'bg-slate-900 text-white'
                                            : 'bg-slate-100 text-slate-600' }}"
                                    >
                                        + Unregistered Item
                                    </button>

                                </div>


                                {{-- EXISTING PART --}}
                                <div
                                    id="existingPartWrapper"
                                    class="{{ !$order->part_id ? 'hidden' : '' }}"
                                >

                                    <select
                                        name="part_id"
                                        id="part_id"
                                        class="w-full rounded-xl border border-slate-200
                                               bg-white px-4 py-3 text-sm text-slate-700
                                               focus:border-blue-500 focus:ring-2
                                               focus:ring-blue-100 outline-none"
                                    >

                                        <option value="">
                                            Select an existing part
                                        </option>

                                        @foreach ($parts as $part)

                                            <option
                                                value="{{ $part->id }}"
                                                data-price="{{ $part->cost_price }}"
                                                {{ old('part_id', $order->part_id) == $part->id ? 'selected' : '' }}
                                            >

                                                {{ $part->name }}

                                                @if($part->part_number)
                                                    — {{ $part->part_number }}
                                                @endif

                                                @if($part->brand)
                                                    ({{ $part->brand }})
                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                    <p class="mt-2 text-xs text-slate-400">
                                        Select a part that already exists in inventory.
                                    </p>

                                </div>


                                {{-- UNREGISTERED --}}
                                <div
                                    id="unregisteredPartWrapper"
                                    class="{{ $order->part_id ? 'hidden' : '' }}"
                                >

                                    <input
                                        type="text"
                                        name="part_name"
                                        id="part_name"
                                        value="{{ old('part_name', $order->part_name) }}"
                                        placeholder="Enter item or part name"
                                        class="w-full rounded-xl border border-slate-200
                                               px-4 py-3 text-sm text-slate-700
                                               focus:border-blue-500 focus:ring-2
                                               focus:ring-blue-100 outline-none"
                                    >

                                    <p class="mt-2 text-xs text-slate-400">
                                        This item is recorded only on this order.
                                        It will not be added to Parts / Inventory.
                                    </p>

                                </div>


                                @error('part_id')

                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>

                                @enderror


                                @error('part_name')

                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- SUPPLIER --}}
                            <div>

                                <label
                                    for="supplier_id"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Supplier
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    name="supplier_id"
                                    id="supplier_id"
                                    required
                                    class="w-full rounded-xl border border-slate-200
                                           bg-white px-4 py-3 text-sm text-slate-700
                                           focus:border-blue-500 focus:ring-2
                                           focus:ring-blue-100 outline-none"
                                >

                                    <option value="">
                                        Select supplier
                                    </option>

                                    @foreach ($suppliers as $supplier)

                                        <option
                                            value="{{ $supplier->id }}"
                                            {{ old('supplier_id', $order->supplier_id) == $supplier->id ? 'selected' : '' }}
                                        >
                                            {{ $supplier->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('supplier_id')

                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- CUSTOMER --}}
                            <div>

                                <label
                                    for="customer_id"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Customer
                                    <span class="text-xs font-normal text-slate-400">
                                        (Optional)
                                    </span>
                                </label>

                                <select
                                    name="customer_id"
                                    id="customer_id"
                                    class="w-full rounded-xl border border-slate-200
                                           bg-white px-4 py-3 text-sm text-slate-700
                                           focus:border-blue-500 focus:ring-2
                                           focus:ring-blue-100 outline-none"
                                >

                                    <option value="">
                                        No customer
                                    </option>

                                    @foreach ($customers as $customer)

                                        <option
                                            value="{{ $customer->id }}"
                                            {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}
                                        >
                                            {{ $customer->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('customer_id')

                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>

                                @enderror

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

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- QUANTITY --}}
                            <div>

                                <label
                                    for="quantity"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Quantity
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    value="{{ old('quantity', $order->quantity) }}"
                                    min="1"
                                    step="1"
                                    required
                                    class="w-full rounded-xl border border-slate-200
                                           px-4 py-3 text-sm text-slate-700
                                           focus:border-blue-500 focus:ring-2
                                           focus:ring-blue-100 outline-none"
                                >

                            </div>


                            {{-- UNIT PRICE --}}
                            <div>

                                <label
                                    for="unit_price"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Unit Price
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-4 top-1/2 -translate-y-1/2
                                               text-sm font-semibold text-slate-400"
                                    >
                                        ₱
                                    </span>

                                    <input
                                        type="number"
                                        name="unit_price"
                                        id="unit_price"
                                        value="{{ old('unit_price', $order->unit_price) }}"
                                        min="0"
                                        step="0.01"
                                        required
                                        class="w-full rounded-xl border border-slate-200
                                               pl-9 pr-4 py-3 text-sm text-slate-700
                                               focus:border-blue-500 focus:ring-2
                                               focus:ring-blue-100 outline-none"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- TOTAL --}}
                        <div class="mt-6 rounded-xl bg-slate-50 border border-slate-200 p-5">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-medium text-slate-500">
                                        Total Order Cost
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Quantity × Unit Price
                                    </p>

                                </div>


                                <div
                                    id="totalDisplay"
                                    class="text-2xl font-bold text-slate-900"
                                >
                                    ₱0.00
                                </div>

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

                        <label
                            for="estimated_arrival"
                            class="block text-sm font-semibold text-slate-700 mb-2"
                        >
                            Estimated Arrival
                        </label>

                        <input
                            type="date"
                            name="estimated_arrival"
                            id="estimated_arrival"
                            value="{{ old('estimated_arrival', $order->estimated_arrival?->format('Y-m-d')) }}"
                            class="w-full rounded-xl border border-slate-200
                                   px-4 py-3 text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none"
                        >

                    </div>

                </div>


                {{-- NOTES --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-base font-bold text-slate-900">
                            Notes
                        </h2>

                    </div>


                    <div class="p-6">

                        <textarea
                            name="notes"
                            id="notes"
                            rows="5"
                            placeholder="Add any notes about this order..."
                            class="w-full rounded-xl border border-slate-200
                                   px-4 py-3 text-sm text-slate-700
                                   resize-none
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none"
                        >{{ old('notes', $order->notes) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="space-y-6">

                {{-- ORDER SUMMARY --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

                    <div class="px-6 py-5 border-b border-slate-100">

                        <h2 class="text-base font-bold text-slate-900">
                            Order Summary
                        </h2>

                    </div>


                    <div class="p-6">

                        <div class="mb-5">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Order Number
                            </p>

                            <p class="mt-1 text-sm font-bold text-slate-900">
                                {{ $order->order_number }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Order number cannot be changed.
                            </p>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-semibold text-slate-700 mb-2"
                            >
                                Order Status
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="w-full rounded-xl border border-slate-200
                                       bg-white px-4 py-3 text-sm text-slate-700
                                       focus:border-blue-500 focus:ring-2
                                       focus:ring-blue-100 outline-none"
                            >

                                <option
                                    value="ordered"
                                    {{ old('status', $order->status) === 'ordered' ? 'selected' : '' }}
                                >
                                    Ordered
                                </option>

                                <option
                                    value="confirmed"
                                    {{ old('status', $order->status) === 'confirmed' ? 'selected' : '' }}
                                >
                                    Confirmed
                                </option>

                                <option
                                    value="shipped"
                                    {{ old('status', $order->status) === 'shipped' ? 'selected' : '' }}
                                >
                                    Shipped
                                </option>

                                <option
                                    value="arrived"
                                    {{ old('status', $order->status) === 'arrived' ? 'selected' : '' }}
                                >
                                    Arrived
                                </option>

                                <option
                                    value="cancelled"
                                    {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}
                                >
                                    Cancelled
                                </option>

                            </select>

                            @error('status')

                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ACTIONS --}}
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2
                               rounded-xl bg-slate-900 px-5 py-3
                               text-sm font-semibold text-white
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Update Order

                    </button>


                    <a
                        href="{{ route('orders.show', $order) }}"
                        class="mt-3 w-full inline-flex items-center justify-center
                               rounded-xl border border-slate-200
                               bg-white px-5 py-3
                               text-sm font-semibold text-slate-700
                               hover:bg-slate-50 transition"
                    >
                        Cancel
                    </a>

                </div>

            </div>

        </div>

    </form>


    {{-- JAVASCRIPT --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const quantityInput =
                document.getElementById('quantity');

            const unitPriceInput =
                document.getElementById('unit_price');

            const totalDisplay =
                document.getElementById('totalDisplay');

            const partSelect =
                document.getElementById('part_id');


            /*
            |--------------------------------------------------------------------------
            | Calculate Total
            |--------------------------------------------------------------------------
            */

            function calculateTotal() {

                const quantity =
                    parseFloat(quantityInput.value) || 0;

                const unitPrice =
                    parseFloat(unitPriceInput.value) || 0;

                const total =
                    quantity * unitPrice;

                totalDisplay.textContent =
                    '₱' + total.toLocaleString('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
            }


            quantityInput.addEventListener(
                'input',
                calculateTotal
            );

            unitPriceInput.addEventListener(
                'input',
                calculateTotal
            );


            /*
            |--------------------------------------------------------------------------
            | Load Part Cost Price
            |--------------------------------------------------------------------------
            */

            if (partSelect) {

                partSelect.addEventListener('change', function () {

                    const selectedOption =
                        this.options[this.selectedIndex];

                    const price =
                        selectedOption.dataset.price;


                    if (price) {

                        unitPriceInput.value = price;

                    }

                    calculateTotal();

                });

            }


            calculateTotal();

        });


        /*
        |--------------------------------------------------------------------------
        | Existing Part
        |--------------------------------------------------------------------------
        */

        function showExistingPart() {

            const existingWrapper =
                document.getElementById('existingPartWrapper');

            const unregisteredWrapper =
                document.getElementById('unregisteredPartWrapper');

            const existingSelect =
                document.getElementById('part_id');

            const partNameInput =
                document.getElementById('part_name');

            const existingButton =
                document.getElementById('existingPartBtn');

            const unregisteredButton =
                document.getElementById('unregisteredPartBtn');


            existingWrapper.classList.remove('hidden');

            unregisteredWrapper.classList.add('hidden');


            existingSelect.required = true;

            partNameInput.required = false;


            partNameInput.value = '';


            existingButton.classList.remove(
                'bg-slate-100',
                'text-slate-600'
            );

            existingButton.classList.add(
                'bg-slate-900',
                'text-white'
            );


            unregisteredButton.classList.remove(
                'bg-slate-900',
                'text-white'
            );

            unregisteredButton.classList.add(
                'bg-slate-100',
                'text-slate-600'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Unregistered Part
        |--------------------------------------------------------------------------
        */

        function showUnregisteredPart() {

            const existingWrapper =
                document.getElementById('existingPartWrapper');

            const unregisteredWrapper =
                document.getElementById('unregisteredPartWrapper');

            const existingSelect =
                document.getElementById('part_id');

            const partNameInput =
                document.getElementById('part_name');

            const existingButton =
                document.getElementById('existingPartBtn');

            const unregisteredButton =
                document.getElementById('unregisteredPartBtn');


            existingWrapper.classList.add('hidden');

            unregisteredWrapper.classList.remove('hidden');


            existingSelect.required = false;

            partNameInput.required = true;


            existingSelect.value = '';


            existingButton.classList.remove(
                'bg-slate-900',
                'text-white'
            );

            existingButton.classList.add(
                'bg-slate-100',
                'text-slate-600'
            );


            unregisteredButton.classList.remove(
                'bg-slate-100',
                'text-slate-600'
            );

            unregisteredButton.classList.add(
                'bg-slate-900',
                'text-white'
            );

        }

    </script>

@endsection