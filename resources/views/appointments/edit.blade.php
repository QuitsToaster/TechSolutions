@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-gray-900">Edit Appointment</h1>
                <span class="bg-gray-100 px-3 py-1 rounded-full text-xs font-medium text-gray-700">#{{ $appointment->id }}</span>
            </div>
            <p class="mt-1 text-sm text-gray-500">Update the appointment information below.</p>
        </div>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="font-medium text-red-800 text-sm">Please correct the following errors:</div>
            <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Customer Information -->
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="font-semibold text-gray-900">Customer Information</h2>
            </div>
            <div class="p-6">
                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Customer <span class="text-red-500">*</span>
                </label>
                <select id="customer_id" name="customer_id" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    <option value="">Select Customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" 
                                @selected(old('customer_id', $appointment->customer_id) == $customer->id)>
                            {{ $customer->name }} @if($customer->contact_number) — {{ $customer->contact_number }} @endif
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="font-semibold text-gray-900">Appointment Details</h2>
            </div>
            <div class="grid gap-6 p-6 md:grid-cols-2">
                <!-- Date -->
                <div>
                    <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Appointment Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="appointment_date" name="appointment_date"
                           value="{{ old('appointment_date', $appointment->appointment_date?->format('Y-m-d')) }}"
                           required
                           class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    @error('appointment_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time -->
                <div>
                    <label for="appointment_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Appointment Time
                    </label>
                    <input type="time" id="appointment_time" name="appointment_time"
                           value="{{ old('appointment_time', $appointment->appointment_time) }}"
                           class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    @error('appointment_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Device Type -->
                <div>
                    <label for="device_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Device Type <span class="text-red-500">*</span>
                    </label>
                    <select id="device_type" name="device_type" required
                            class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        <option value="">Select Device Type</option>
                        @foreach(['Smartphone', 'Tablet', 'Laptop', 'Desktop', 'Printer', 'Other'] as $type)
                            <option value="{{ $type }}" @selected(old('device_type', $appointment->device_type) === $type)>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    @error('device_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Device Model -->
                <div>
                    <label for="device_model" class="block text-sm font-medium text-gray-700 mb-2">
                        Device Model <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="device_model" name="device_model"
                           value="{{ old('device_model', $appointment->device_model) }}"
                           placeholder="e.g. iPhone 13 Pro Max"
                           required
                           class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    @error('device_model')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Service -->
                <div class="md:col-span-2">
                    <label for="service" class="block text-sm font-medium text-gray-700 mb-2">
                        Service / Repair <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="service" name="service"
                           value="{{ old('service', $appointment->service) }}"
                           placeholder="e.g. LCD Replacement, Battery Replacement"
                           required
                           class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    @error('service')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Problem & Cost -->
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="font-semibold text-gray-900">Problem & Cost</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Add the parts, labor, estimated customer charge, and expected profit for this repair.
                </p>
            </div>

            <div class="space-y-6 p-6">

                <!-- Problem Description -->
                <div>
                    <label for="problem_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Problem Description
                    </label>

                    <textarea
                        id="problem_description"
                        name="problem_description"
                        rows="4"
                        placeholder="Describe the customer's reported problem..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                    >{{ old('problem_description', $appointment->problem_description) }}</textarea>

                    @error('problem_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Parts Breakdown --}}
                <div class="border-t border-gray-200 pt-6">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">
                                Parts / Materials
                            </h3>

                            <p class="text-xs text-gray-500 mt-1">
                                Enter your unit cost and customer selling price for each part.
                            </p>
                        </div>

                        <button
                            type="button"
                            id="addPartBtn"
                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition"
                        >
                            + Add Part
                        </button>

                    </div>


                    @php
                        $parts = old('parts_breakdown', $appointment->parts_breakdown ?? []);

                        if (empty($parts)) {
                            $parts = [
                                [
                                    'name' => '',
                                    'quantity' => 1,
                                    'unit_cost' => '',
                                    'selling_price' => '',
                                ]
                            ];
                        }
                    @endphp


                    <div
                        id="partsContainer"
                        class="space-y-4"
                    >

                        @foreach($parts as $index => $part)

                            <div
                                class="part-row rounded-xl border border-gray-200 bg-gray-50 p-4"
                            >

                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                                    {{-- Part Name --}}
                                    <div class="md:col-span-4">

                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            Part / Material
                                        </label>

                                        <input
                                            type="text"
                                            name="parts_breakdown[{{ $index }}][name]"
                                            value="{{ $part['name'] ?? '' }}"
                                            placeholder="e.g. iPhone 13 LCD"
                                            class="part-name w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                        >

                                    </div>


                                    {{-- Quantity --}}
                                    <div class="md:col-span-2">

                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            Quantity
                                        </label>

                                        <input
                                            type="number"
                                            name="parts_breakdown[{{ $index }}][quantity]"
                                            value="{{ $part['quantity'] ?? 1 }}"
                                            min="0"
                                            step="1"
                                            class="part-quantity w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                        >

                                    </div>


                                    {{-- Unit Cost --}}
                                    <div class="md:col-span-2">

                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            Unit Cost
                                        </label>

                                        <div class="relative">

                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                                                ₱
                                            </span>

                                            <input
                                                type="number"
                                                name="parts_breakdown[{{ $index }}][unit_cost]"
                                                value="{{ $part['unit_cost'] ?? '' }}"
                                                min="0"
                                                step="0.01"
                                                placeholder="0.00"
                                                class="part-unit-cost w-full pl-8 rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                            >

                                        </div>

                                        <p class="text-[11px] text-gray-400 mt-1">
                                            Your cost
                                        </p>

                                    </div>


                                    {{-- Selling Price --}}
                                    <div class="md:col-span-2">

                                        <label class="block text-xs font-medium text-gray-600 mb-1">
                                            Selling Price
                                        </label>

                                        <div class="relative">

                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                                                ₱
                                            </span>

                                            <input
                                                type="number"
                                                name="parts_breakdown[{{ $index }}][selling_price]"
                                                value="{{ $part['selling_price'] ?? '' }}"
                                                min="0"
                                                step="0.01"
                                                placeholder="0.00"
                                                class="part-selling-price w-full pl-8 rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                                            >

                                        </div>

                                        <p class="text-[11px] text-gray-400 mt-1">
                                            Customer price
                                        </p>

                                    </div>


                                    {{-- Remove --}}
                                    <div class="md:col-span-2 flex items-end">

                                        <button
                                            type="button"
                                            class="remove-part w-full inline-flex items-center justify-center px-3 py-2 rounded-lg border border-red-200 text-red-600 bg-white hover:bg-red-50 text-sm font-medium transition"
                                        >
                                            Remove
                                        </button>

                                    </div>

                                </div>


                                {{-- Part Calculation --}}
                                <div class="mt-3 pt-3 border-t border-gray-200 flex flex-wrap gap-x-6 gap-y-2 text-xs">

                                    <div>
                                        <span class="text-gray-500">
                                            Part Cost:
                                        </span>

                                        <span class="part-cost-display font-semibold text-gray-800">
                                            ₱0.00
                                        </span>
                                    </div>


                                    <div>
                                        <span class="text-gray-500">
                                            Part Selling:
                                        </span>

                                        <span class="part-selling-display font-semibold text-gray-800">
                                            ₱0.00
                                        </span>
                                    </div>


                                    <div>
                                        <span class="text-gray-500">
                                            Part Profit:
                                        </span>

                                        <span class="part-profit-display font-semibold text-green-600">
                                            ₱0.00
                                        </span>
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    @error('parts_breakdown')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                {{-- Labor --}}
                <div class="border-t border-gray-200 pt-6">

                    <label
                        for="labor_cost"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Labor Charge
                    </label>

                    <p class="text-xs text-gray-500 mb-3">
                        This is the labor/service amount charged to the customer.
                    </p>

                    <div class="relative max-w-md">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            id="labor_cost"
                            name="labor_cost"
                            value="{{ old('labor_cost', $appointment->labor_cost) }}"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            class="w-full pl-8 rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                        >

                    </div>

                    @error('labor_cost')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                </div>


                {{-- Financial Summary --}}
                <div class="border-t border-gray-200 pt-6">

                    <h3 class="text-sm font-semibold text-gray-900 mb-4">
                        Estimated Financial Summary
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        {{-- Parts Cost --}}
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                            <p class="text-xs font-medium text-gray-500">
                                Total Parts Cost
                            </p>

                            <p
                                id="totalPartsCost"
                                class="mt-1 text-lg font-bold text-gray-900"
                            >
                                ₱0.00
                            </p>

                            <p class="text-[11px] text-gray-400">
                                Your actual parts expense
                            </p>

                        </div>


                        {{-- Parts Selling --}}
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                            <p class="text-xs font-medium text-gray-500">
                                Parts Selling
                            </p>

                            <p
                                id="totalPartsSelling"
                                class="mt-1 text-lg font-bold text-gray-900"
                            >
                                ₱0.00
                            </p>

                            <p class="text-[11px] text-gray-400">
                                Customer charge for parts
                            </p>

                        </div>


                        {{-- Labor --}}
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">

                            <p class="text-xs font-medium text-gray-500">
                                Labor Charge
                            </p>

                            <p
                                id="totalLabor"
                                class="mt-1 text-lg font-bold text-gray-900"
                            >
                                ₱0.00
                            </p>

                            <p class="text-[11px] text-gray-400">
                                Customer charge for labor
                            </p>

                        </div>


                        {{-- Profit --}}
                        <div class="rounded-xl border border-green-200 bg-green-50 p-4">

                            <p class="text-xs font-medium text-green-700">
                                Estimated Profit
                            </p>

                            <p
                                id="totalProfit"
                                class="mt-1 text-lg font-bold text-green-700"
                            >
                                ₱0.00
                            </p>

                            <p class="text-[11px] text-green-600">
                                Expected earnings
                            </p>

                        </div>

                    </div>


                    {{-- Estimated Customer Charge --}}
                    <div class="mt-4 rounded-xl border border-gray-900 bg-gray-900 p-5">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                            <div>
                                <p class="text-sm font-medium text-gray-300">
                                    Estimated Customer Charge
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Parts Selling Price + Labor
                                </p>
                            </div>

                            <p
                                id="estimatedCustomerCharge"
                                class="text-2xl font-bold text-white"
                            >
                                ₱0.00
                            </p>

                        </div>

                    </div>


                    {{-- Hidden calculated values --}}
                    <input
                        type="hidden"
                        id="estimated_cost"
                        name="estimated_cost"
                        value="{{ old('estimated_cost', $appointment->estimated_cost) }}"
                    >

                    <input
                        type="hidden"
                        id="estimated_profit"
                        name="estimated_profit"
                        value="{{ old('estimated_profit', $appointment->estimated_profit) }}"
                    >

                </div>

            </div>
        </div>

        <!-- Status & Payment -->
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="font-semibold text-gray-900">Status & Payment</h2>
            </div>
            <div class="grid gap-6 p-6 md:grid-cols-2">
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        @foreach(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'in_progress' => 'In Progress', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $appointment->status) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Status -->
                <div>
                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Payment Status <span class="text-red-500">*</span>
                    </label>
                    <select id="payment_status" name="payment_status" required
                            class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                        @foreach(['unpaid' => 'Unpaid', 'partial' => 'Partial', 'paid' => 'Paid'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('payment_status', $appointment->payment_status) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('payment_status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="font-semibold text-gray-900">Notes</h2>
            </div>
            <div class="p-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Additional Notes
                </label>
                <textarea id="notes" name="notes" rows="4"
                          placeholder="Add any additional notes..."
                          class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">{{ old('notes', $appointment->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('appointments.show', $appointment) }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const partsContainer = document.getElementById('partsContainer');
    const addPartBtn = document.getElementById('addPartBtn');
    const laborInput = document.getElementById('labor_cost');

    const totalPartsCostEl = document.getElementById('totalPartsCost');
    const totalPartsSellingEl = document.getElementById('totalPartsSelling');
    const totalLaborEl = document.getElementById('totalLabor');
    const estimatedCustomerChargeEl = document.getElementById('estimatedCustomerCharge');
    const totalProfitEl = document.getElementById('totalProfit');

    const estimatedCostInput = document.getElementById('estimated_cost');
    const estimatedProfitInput = document.getElementById('estimated_profit');


    function formatCurrency(value) {

        return new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
        }).format(value || 0);

    }


    function calculateTotals() {

        let totalPartsCost = 0;
        let totalPartsSelling = 0;

        const rows = partsContainer.querySelectorAll('.part-row');

        rows.forEach(row => {

            const quantity =
                parseFloat(
                    row.querySelector('.part-quantity')?.value
                ) || 0;

            const unitCost =
                parseFloat(
                    row.querySelector('.part-unit-cost')?.value
                ) || 0;

            const sellingPrice =
                parseFloat(
                    row.querySelector('.part-selling-price')?.value
                ) || 0;


            const partCost = quantity * unitCost;
            const partSelling = quantity * sellingPrice;
            const partProfit = partSelling - partCost;


            totalPartsCost += partCost;
            totalPartsSelling += partSelling;


            const costDisplay =
                row.querySelector('.part-cost-display');

            const sellingDisplay =
                row.querySelector('.part-selling-display');

            const profitDisplay =
                row.querySelector('.part-profit-display');


            if (costDisplay) {
                costDisplay.textContent = formatCurrency(partCost);
            }

            if (sellingDisplay) {
                sellingDisplay.textContent = formatCurrency(partSelling);
            }

            if (profitDisplay) {
                profitDisplay.textContent = formatCurrency(partProfit);
            }

        });


        const labor =
            parseFloat(laborInput?.value) || 0;


        const estimatedCustomerCharge =
            totalPartsSelling + labor;


        const estimatedProfit =
            estimatedCustomerCharge - totalPartsCost;


        totalPartsCostEl.textContent =
            formatCurrency(totalPartsCost);

        totalPartsSellingEl.textContent =
            formatCurrency(totalPartsSelling);

        totalLaborEl.textContent =
            formatCurrency(labor);

        estimatedCustomerChargeEl.textContent =
            formatCurrency(estimatedCustomerCharge);

        totalProfitEl.textContent =
            formatCurrency(estimatedProfit);


        /*
        |--------------------------------------------------------------------------
        | Hidden values submitted to Laravel
        |--------------------------------------------------------------------------
        */

        estimatedCostInput.value =
            estimatedCustomerCharge.toFixed(2);

        estimatedProfitInput.value =
            estimatedProfit.toFixed(2);

    }


    function createPartRow() {

        const index =
            partsContainer.querySelectorAll('.part-row').length;


        const row = document.createElement('div');

        row.className =
            'part-row rounded-xl border border-gray-200 bg-gray-50 p-4';


        row.innerHTML = `

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                <!-- Part Name -->
                <div class="md:col-span-4">

                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        Part / Material
                    </label>

                    <input
                        type="text"
                        name="parts_breakdown[${index}][name]"
                        placeholder="e.g. iPhone 13 LCD"
                        class="part-name w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                    >

                </div>


                <!-- Quantity -->
                <div class="md:col-span-2">

                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        Quantity
                    </label>

                    <input
                        type="number"
                        name="parts_breakdown[${index}][quantity]"
                        value="1"
                        min="0"
                        step="1"
                        class="part-quantity w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                    >

                </div>


                <!-- Unit Cost -->
                <div class="md:col-span-2">

                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        Unit Cost
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="parts_breakdown[${index}][unit_cost]"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            class="part-unit-cost w-full pl-8 rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                        >

                    </div>

                    <p class="text-[11px] text-gray-400 mt-1">
                        Your cost
                    </p>

                </div>


                <!-- Selling Price -->
                <div class="md:col-span-2">

                    <label class="block text-xs font-medium text-gray-600 mb-1">
                        Selling Price
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="parts_breakdown[${index}][selling_price]"
                            min="0"
                            step="0.01"
                            placeholder="0.00"
                            class="part-selling-price w-full pl-8 rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                        >

                    </div>

                    <p class="text-[11px] text-gray-400 mt-1">
                        Customer price
                    </p>

                </div>


                <!-- Remove -->
                <div class="md:col-span-2 flex items-end">

                    <button
                        type="button"
                        class="remove-part w-full inline-flex items-center justify-center px-3 py-2 rounded-lg border border-red-200 text-red-600 bg-white hover:bg-red-50 text-sm font-medium transition"
                    >
                        Remove
                    </button>

                </div>

            </div>


            <!-- Part Calculation -->
            <div class="mt-3 pt-3 border-t border-gray-200 flex flex-wrap gap-x-6 gap-y-2 text-xs">

                <div>
                    <span class="text-gray-500">
                        Part Cost:
                    </span>

                    <span class="part-cost-display font-semibold text-gray-800">
                        ₱0.00
                    </span>
                </div>


                <div>
                    <span class="text-gray-500">
                        Part Selling:
                    </span>

                    <span class="part-selling-display font-semibold text-gray-800">
                        ₱0.00
                    </span>
                </div>


                <div>
                    <span class="text-gray-500">
                        Part Profit:
                    </span>

                    <span class="part-profit-display font-semibold text-green-600">
                        ₱0.00
                    </span>
                </div>

            </div>

        `;


        partsContainer.appendChild(row);

        attachRowEvents(row);

        calculateTotals();

    }


    function attachRowEvents(row) {

        const inputs =
            row.querySelectorAll(
                '.part-quantity, .part-unit-cost, .part-selling-price'
            );


        inputs.forEach(input => {

            input.addEventListener('input', calculateTotals);

        });


        const removeBtn =
            row.querySelector('.remove-part');


        removeBtn.addEventListener('click', function () {

            const rows =
                partsContainer.querySelectorAll('.part-row');


            /*
            |--------------------------------------------------------------------------
            | Keep at least one row
            |--------------------------------------------------------------------------
            */

            if (rows.length === 1) {

                row.querySelector('.part-name').value = '';
                row.querySelector('.part-quantity').value = 1;
                row.querySelector('.part-unit-cost').value = '';
                row.querySelector('.part-selling-price').value = '';

            } else {

                row.remove();

            }


            calculateTotals();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Add Part
    |--------------------------------------------------------------------------
    */

    addPartBtn.addEventListener('click', function () {

        createPartRow();

    });


    /*
    |--------------------------------------------------------------------------
    | Existing Part Rows
    |--------------------------------------------------------------------------
    */

    partsContainer
        .querySelectorAll('.part-row')
        .forEach(row => {

            attachRowEvents(row);

        });


    /*
    |--------------------------------------------------------------------------
    | Labor Calculation
    |--------------------------------------------------------------------------
    */

    if (laborInput) {

        laborInput.addEventListener(
            'input',
            calculateTotals
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Calculation
    |--------------------------------------------------------------------------
    */

    calculateTotals();

});
</script>
@endsection