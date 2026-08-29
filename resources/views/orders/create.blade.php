@extends('layouts.app')

@section('title', 'Add Order')

@section('page-heading', 'Add Order')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Add Order
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Create a new parts order.
            </p>
        </div>

        <a
            href="{{ route('orders.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                   rounded-xl border border-slate-200 bg-white
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

            Back to Orders
        </a>

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
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>

    @endif


    {{-- ORDER FORM --}}
    <form
        action="{{ route('orders.store') }}"
        method="POST"
        id="orderForm"
    >

        @csrf

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
                            Select the part and supplier for this order.
                        </p>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                         {{-- PART / ITEM --}}
                            <div class="md:col-span-2">

                                <label
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Part / Item
                                    <span class="text-red-500">*</span>
                                </label>


                                {{-- MODE TOGGLE --}}
                                <div class="flex items-center gap-2 mb-3">

                                    <button
                                        type="button"
                                        id="existingPartBtn"
                                        onclick="showExistingPart()"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                            bg-slate-900 text-white transition"
                                    >
                                        Existing Part
                                    </button>

                                    <button
                                        type="button"
                                        id="unregisteredPartBtn"
                                        onclick="showUnregisteredPart()"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                            bg-slate-100 text-slate-600
                                            hover:bg-slate-200 transition"
                                    >
                                        + Unregistered Item
                                    </button>

                                </div>


                                {{-- EXISTING PART --}}
                                <div id="existingPartWrapper">

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
                                                {{ old('part_id') == $part->id ? 'selected' : '' }}
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
                                        Select a part that already exists in Parts / Inventory.
                                    </p>

                                </div>


                                {{-- UNREGISTERED ITEM --}}
                                <div
                                    id="unregisteredPartWrapper"
                                    class="hidden"
                                >

                                    <input
                                        type="text"
                                        name="part_name"
                                        id="part_name"
                                        value="{{ old('part_name') }}"
                                        placeholder="Enter item or part name"
                                        class="w-full rounded-xl border border-slate-200
                                            px-4 py-3 text-sm text-slate-700
                                            focus:border-blue-500 focus:ring-2
                                            focus:ring-blue-100 outline-none"
                                    >

                                    <p class="mt-2 text-xs text-slate-400">
                                        This item will be recorded only on this order.
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


                                {{-- EXISTING / NEW TOGGLE --}}
                                <div class="flex items-center gap-2 mb-3">

                                    <button
                                        type="button"
                                        id="existingSupplierBtn"
                                        onclick="showExistingSupplier()"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                            bg-slate-900 text-white transition"
                                    >
                                        Existing
                                    </button>

                                    <button
                                        type="button"
                                        id="newSupplierBtn"
                                        onclick="showNewSupplier()"
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold
                                            bg-slate-100 text-slate-600
                                            hover:bg-slate-200 transition"
                                    >
                                        + Add New
                                    </button>

                                </div>


                                {{-- EXISTING SUPPLIER --}}
                                <div id="existingSupplierWrapper">

                                    <select
                                        name="supplier_id"
                                        id="supplier_id"
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
                                                {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}
                                            >
                                                {{ $supplier->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>


                                {{-- NEW SUPPLIER --}}
                                <div
                                    id="newSupplierWrapper"
                                    class="hidden"
                                >

                                    <input
                                        type="text"
                                        name="new_supplier_name"
                                        id="new_supplier_name"
                                        value="{{ old('new_supplier_name') }}"
                                        placeholder="Enter new supplier name"
                                        class="w-full rounded-xl border border-slate-200
                                            px-4 py-3 text-sm text-slate-700
                                            focus:border-blue-500 focus:ring-2
                                            focus:ring-blue-100 outline-none"
                                    >

                                    <p class="mt-2 text-xs text-slate-400">
                                        This will automatically be added to your Suppliers.
                                    </p>

                                </div>


                                @error('supplier_id')
                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                                @error('new_supplier_name')
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
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}
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

                        <p class="text-sm text-slate-500 mt-1">
                            Enter the quantity and purchase price.
                        </p>

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
                                    value="{{ old('quantity', 1) }}"
                                    min="1"
                                    step="1"
                                    required
                                    class="w-full rounded-xl border border-slate-200
                                           px-4 py-3 text-sm text-slate-700
                                           focus:border-blue-500 focus:ring-2
                                           focus:ring-blue-100 outline-none"
                                >

                                @error('quantity')
                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

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
                                        value="{{ old('unit_price') }}"
                                        min="0"
                                        step="0.01"
                                        required
                                        class="w-full rounded-xl border border-slate-200
                                               pl-9 pr-4 py-3 text-sm text-slate-700
                                               focus:border-blue-500 focus:ring-2
                                               focus:ring-blue-100 outline-none"
                                    >

                                </div>

                                @error('unit_price')
                                    <p class="mt-1 text-xs text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

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

                        <div>

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
                                value="{{ old('estimated_arrival') }}"
                                class="w-full rounded-xl border border-slate-200
                                       px-4 py-3 text-sm text-slate-700
                                       focus:border-blue-500 focus:ring-2
                                       focus:ring-blue-100 outline-none"
                            >

                            @error('estimated_arrival')
                                <p class="mt-1 text-xs text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

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
                        >{{ old('notes') }}</textarea>

                        @error('notes')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

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

                        {{-- ORDER NUMBER --}}
                        <div class="mb-5">

                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Order Number
                            </p>

                            <p class="mt-1 text-sm font-bold text-slate-900">
                                Automatically generated
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
                                    {{ old('status', 'ordered') === 'ordered' ? 'selected' : '' }}
                                >
                                    Ordered
                                </option>

                                <option
                                    value="confirmed"
                                    {{ old('status') === 'confirmed' ? 'selected' : '' }}
                                >
                                    Confirmed
                                </option>

                                <option
                                    value="shipped"
                                    {{ old('status') === 'shipped' ? 'selected' : '' }}
                                >
                                    Shipped
                                </option>

                                <option
                                    value="arrived"
                                    {{ old('status') === 'arrived' ? 'selected' : '' }}
                                >
                                    Arrived
                                </option>

                                <option
                                    value="cancelled"
                                    {{ old('status') === 'cancelled' ? 'selected' : '' }}
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

                        Save Order

                    </button>


                    <a
                        href="{{ route('orders.index') }}"
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


    {{-- TOTAL PRICE CALCULATION --}}
    <script>

    document.addEventListener('DOMContentLoaded', function () {

        const quantityInput = document.getElementById('quantity');
        const unitPriceInput = document.getElementById('unit_price');
        const totalDisplay = document.getElementById('totalDisplay');

        const partSelect = document.getElementById('part_id');


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
        | Automatically Load Part Cost
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Initial Total
        |--------------------------------------------------------------------------
        */

        calculateTotal();


        /*
        |--------------------------------------------------------------------------
        | Restore New Part / Supplier Mode After Validation Error
        |--------------------------------------------------------------------------
        */

        @if(old('part_name'))
            showUnregisteredPart();
        @endif

        @if(old('new_supplier_name'))
            showNewSupplier();
        @endif

    });


    /*
    |--------------------------------------------------------------------------
    | PART TOGGLE
    |--------------------------------------------------------------------------
    */

    function showExistingPart() {

        const existingWrapper =
            document.getElementById('existingPartWrapper');

        const newWrapper =
            document.getElementById('newPartWrapper');

        const existingSelect =
            document.getElementById('part_id');

        const newInput =
            document.getElementById('new_part_name');

        const existingButton =
            document.getElementById('existingPartBtn');

        const newButton =
            document.getElementById('newPartBtn');


        existingWrapper.classList.remove('hidden');

        newWrapper.classList.add('hidden');


        existingSelect.required = true;

        newInput.required = false;


        newInput.value = '';


        existingButton.classList.remove(
            'bg-slate-100',
            'text-slate-600'
        );

        existingButton.classList.add(
            'bg-slate-900',
            'text-white'
        );


        newButton.classList.remove(
            'bg-slate-900',
            'text-white'
        );

        newButton.classList.add(
            'bg-slate-100',
            'text-slate-600'
        );

    }


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


    /*
    |--------------------------------------------------------------------------
    | SUPPLIER TOGGLE
    |--------------------------------------------------------------------------
    */

    function showExistingSupplier() {

        const existingWrapper =
            document.getElementById('existingSupplierWrapper');

        const newWrapper =
            document.getElementById('newSupplierWrapper');

        const existingSelect =
            document.getElementById('supplier_id');

        const newInput =
            document.getElementById('new_supplier_name');

        const existingButton =
            document.getElementById('existingSupplierBtn');

        const newButton =
            document.getElementById('newSupplierBtn');


        existingWrapper.classList.remove('hidden');

        newWrapper.classList.add('hidden');


        existingSelect.required = true;

        newInput.required = false;


        newInput.value = '';


        existingButton.classList.remove(
            'bg-slate-100',
            'text-slate-600'
        );

        existingButton.classList.add(
            'bg-slate-900',
            'text-white'
        );


        newButton.classList.remove(
            'bg-slate-900',
            'text-white'
        );

        newButton.classList.add(
            'bg-slate-100',
            'text-slate-600'
        );

    }


    function showNewSupplier() {

        const existingWrapper =
            document.getElementById('existingSupplierWrapper');

        const newWrapper =
            document.getElementById('newSupplierWrapper');

        const existingSelect =
            document.getElementById('supplier_id');

        const newInput =
            document.getElementById('new_supplier_name');

        const existingButton =
            document.getElementById('existingSupplierBtn');

        const newButton =
            document.getElementById('newSupplierBtn');


        existingWrapper.classList.add('hidden');

        newWrapper.classList.remove('hidden');


        existingSelect.required = false;

        newInput.required = true;


        existingSelect.value = '';


        existingButton.classList.remove(
            'bg-slate-900',
            'text-white'
        );

        existingButton.classList.add(
            'bg-slate-100',
            'text-slate-600'
        );


        newButton.classList.remove(
            'bg-slate-100',
            'text-slate-600'
        );

        newButton.classList.add(
            'bg-slate-900',
            'text-white'
        );

    }

</script>

@endsection