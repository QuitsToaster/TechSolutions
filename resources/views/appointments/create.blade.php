@extends('layouts.app')

@section('title', 'New Appointment')

@section('content')

<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold">
            New Appointment
        </h1>

        <p class="text-gray-500">
            Create a new customer repair appointment.
        </p>
    </div>


    <form action="{{ route('appointments.store') }}"
          method="POST"
          class="bg-white border border-gray-200 rounded-xl p-6 space-y-6">

        @csrf


        {{-- Customer --}}
        <div>

            <label class="block font-medium mb-2">
                Customer
            </label>

            <select
                name="customer_id"
                required
                class="w-full border border-gray-200 rounded-lg px-4 py-2">

                <option value="">
                    Select Customer
                </option>

                @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                        {{ $customer->name }}
                        — {{ $customer->contact_number }}

                    </option>

                @endforeach

            </select>

            @error('customer_id')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- Appointment --}}
        <div class="grid md:grid-cols-2 gap-4">

            <div>

                <label class="block font-medium mb-2">
                    Appointment Date
                </label>

                <input
                    type="date"
                    name="appointment_date"
                    value="{{ old('appointment_date') }}"
                    required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2">

            </div>


            <div>

                <label class="block font-medium mb-2">
                    Appointment Time
                </label>

                <input
                    type="time"
                    name="appointment_time"
                    value="{{ old('appointment_time') }}"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2">

            </div>

        </div>


        {{-- Device --}}
        <div class="grid md:grid-cols-2 gap-4">

            <div>

                <label class="block font-medium mb-2">
                    Device Type
                </label>

                <select
                    name="device_type"
                    required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2">

                    <option value="">Select Device</option>
                    <option value="iPhone">iPhone</option>
                    <option value="iPad">iPad</option>
                    <option value="Android Phone">Android Phone</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Desktop PC">Desktop PC</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Other">Other</option>

                </select>

            </div>


            <div>

                <label class="block font-medium mb-2">
                    Device Model
                </label>

                <input
                    type="text"
                    name="device_model"
                    value="{{ old('device_model') }}"
                    placeholder="Example: iPhone 11"
                    required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2">

            </div>

        </div>


        {{-- Service --}}
        <div>

            <label class="block font-medium mb-2">
                Service / Repair
            </label>

            <input
                type="text"
                name="service"
                value="{{ old('service') }}"
                placeholder="Example: LCD Replacement"
                required
                class="w-full border border-gray-200 rounded-lg px-4 py-2">

        </div>


        {{-- Problem --}}
        <div>

            <label class="block font-medium mb-2">
                Problem Description
            </label>

            <textarea
                name="problem_description"
                rows="4"
                placeholder="Describe the customer's problem..."
                class="w-full border border-gray-200 rounded-lg px-4 py-2">{{ old('problem_description') }}</textarea>

        </div>


        {{-- ========================================================= --}}
        {{-- ESTIMATED COST & PROFIT --}}
        {{-- ========================================================= --}}

        <div
            x-data="{
                parts: @js(old('parts_breakdown', [
                    [
                        'name' => '',
                        'quantity' => 1,
                        'unit_cost' => 0,
                        'selling_price' => 0,
                    ]
                ])),

                laborCost: {{ old('labor_cost', 0) }},

                get totalPartsCost() {
                    return this.parts.reduce((total, part) => {
                        return total +
                            (parseFloat(part.quantity) || 0) *
                            (parseFloat(part.unit_cost) || 0);
                    }, 0);
                },

                get totalPartsSelling() {
                    return this.parts.reduce((total, part) => {
                        return total +
                            (parseFloat(part.quantity) || 0) *
                            (parseFloat(part.selling_price) || 0);
                    }, 0);
                },

                get estimatedTotal() {
                    return this.totalPartsSelling +
                        (parseFloat(this.laborCost) || 0);
                },

                get estimatedProfit() {
                    return this.estimatedTotal -
                        this.totalPartsCost;
                },

                addPart() {
                    this.parts.push({
                        name: '',
                        quantity: 1,
                        unit_cost: 0,
                        selling_price: 0
                    });
                },

                removePart(index) {
                    if (this.parts.length > 1) {
                        this.parts.splice(index, 1);
                    }
                },

                formatMoney(value) {
                    return new Intl.NumberFormat('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(value || 0);
                }
            }"
        >

            {{-- Section Header --}}
            <div class="flex items-start justify-between gap-4 mb-4">

                <div>

                    <label class="block font-semibold text-gray-900">
                        Estimated Cost & Profit
                    </label>

                    <p class="text-sm text-gray-500 mt-1">
                        Add parts, selling prices, and labor to calculate the estimated repair profit.
                    </p>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- PARTS --}}
            {{-- ===================================================== --}}

            <div class="border border-gray-200 rounded-xl overflow-hidden">

                {{-- Parts Header --}}
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">

                    <div class="flex items-center justify-between gap-3">

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Parts
                            </h3>

                            <p class="text-xs text-gray-500 mt-0.5">
                                Enter your actual cost and customer selling price.
                            </p>

                        </div>

                        <button
                            type="button"
                            @click="addPart()"
                            class="
                                inline-flex
                                items-center
                                gap-1.5
                                px-3
                                py-2
                                rounded-lg
                                bg-gray-900
                                text-white
                                text-sm
                                font-medium
                                hover:bg-gray-800
                                transition
                            "
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
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Add Part

                        </button>

                    </div>

                </div>


                {{-- Parts List --}}
                <div class="p-4 space-y-4">

                    <template x-for="(part, index) in parts" :key="index">

                        <div class="border border-gray-200 rounded-xl p-4">

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                                {{-- Part Name --}}
                                <div class="md:col-span-4">

                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                        Part Name
                                    </label>

                                    <input
                                        type="text"
                                        :name="`parts_breakdown[${index}][name]`"
                                        x-model="part.name"
                                        placeholder="Example: iPhone 11 LCD"
                                        class="
                                            w-full
                                            border
                                            border-gray-200
                                            rounded-lg
                                            px-3
                                            py-2
                                            text-sm
                                            focus:ring-2
                                            focus:ring-gray-900
                                            focus:border-gray-900
                                        "
                                    >

                                </div>


                                {{-- Quantity --}}
                                <div class="md:col-span-2">

                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                        Qty
                                    </label>

                                    <input
                                        type="number"
                                        min="1"
                                        step="1"
                                        :name="`parts_breakdown[${index}][quantity]`"
                                        x-model.number="part.quantity"
                                        class="
                                            w-full
                                            border
                                            border-gray-200
                                            rounded-lg
                                            px-3
                                            py-2
                                            text-sm
                                            focus:ring-2
                                            focus:ring-gray-900
                                            focus:border-gray-900
                                        "
                                    >

                                </div>


                                {{-- Unit Cost --}}
                                <div class="md:col-span-2">

                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                        Unit Cost
                                    </label>

                                    <div class="relative">

                                        <span class="absolute left-3 top-2 text-gray-400 text-sm">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            :name="`parts_breakdown[${index}][unit_cost]`"
                                            x-model.number="part.unit_cost"
                                            placeholder="0.00"
                                            class="
                                                w-full
                                                border
                                                border-gray-200
                                                rounded-lg
                                                pl-7
                                                pr-3
                                                py-2
                                                text-sm
                                                focus:ring-2
                                                focus:ring-gray-900
                                                focus:border-gray-900
                                            "
                                        >

                                    </div>

                                    <p class="text-[11px] text-gray-400 mt-1">
                                        Your cost
                                    </p>

                                </div>


                                {{-- Selling Price --}}
                                <div class="md:col-span-2">

                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">
                                        Selling Price
                                    </label>

                                    <div class="relative">

                                        <span class="absolute left-3 top-2 text-gray-400 text-sm">
                                            ₱
                                        </span>

                                        <input
                                            type="number"
                                            min="0"
                                            step="0.01"
                                            :name="`parts_breakdown[${index}][selling_price]`"
                                            x-model.number="part.selling_price"
                                            placeholder="0.00"
                                            class="
                                                w-full
                                                border
                                                border-gray-200
                                                rounded-lg
                                                pl-7
                                                pr-3
                                                py-2
                                                text-sm
                                                focus:ring-2
                                                focus:ring-gray-900
                                                focus:border-gray-900
                                            "
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
                                        @click="removePart(index)"
                                        :disabled="parts.length === 1"
                                        class="
                                            w-full
                                            inline-flex
                                            items-center
                                            justify-center
                                            gap-1.5
                                            px-3
                                            py-2
                                            rounded-lg
                                            border
                                            border-red-200
                                            text-red-600
                                            text-sm
                                            font-medium
                                            hover:bg-red-50
                                            disabled:opacity-40
                                            disabled:cursor-not-allowed
                                            transition
                                        "
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
                                                stroke-width="1.8"
                                                d="M6 7h12M10 11v6M14 11v6M9 7V5h6v2M8 7l1 13h6l1-13"
                                            />
                                        </svg>

                                        Remove

                                    </button>

                                </div>

                            </div>


                            {{-- Part Profit --}}
                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">

                                <span class="text-xs text-gray-500">
                                    Estimated profit from this part
                                </span>

                                <span
                                    class="text-sm font-semibold"
                                    :class="
                                        (
                                            ((parseFloat(part.selling_price) || 0) -
                                            (parseFloat(part.unit_cost) || 0)) *
                                            (parseFloat(part.quantity) || 0)
                                        ) >= 0
                                            ? 'text-emerald-600'
                                            : 'text-red-600'
                                    "
                                >
                                    ₱<span
                                        x-text="formatMoney(
                                            (
                                                ((parseFloat(part.selling_price) || 0) -
                                                (parseFloat(part.unit_cost) || 0)) *
                                                (parseFloat(part.quantity) || 0)
                                            )
                                        )"
                                    ></span>
                                </span>

                            </div>

                        </div>

                    </template>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- LABOR --}}
            {{-- ===================================================== --}}

            <div class="mt-4 border border-gray-200 rounded-xl p-4">

                <div class="grid md:grid-cols-2 gap-4 items-end">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Labor Cost
                        </label>

                        <p class="text-xs text-gray-400 mb-2">
                            Your estimated labor charge for the repair.
                        </p>

                        <div class="relative">

                            <span class="absolute left-3 top-2.5 text-gray-400">
                                ₱
                            </span>

                            <input
                                type="number"
                                min="0"
                                step="0.01"
                                name="labor_cost"
                                x-model.number="laborCost"
                                placeholder="0.00"
                                class="
                                    w-full
                                    border
                                    border-gray-200
                                    rounded-lg
                                    pl-8
                                    pr-4
                                    py-2.5
                                    focus:ring-2
                                    focus:ring-gray-900
                                    focus:border-gray-900
                                "
                            >

                        </div>

                    </div>


                    {{-- Parts Cost --}}
                    <div class="bg-gray-50 rounded-lg p-4">

                        <div class="flex items-center justify-between">

                            <span class="text-sm text-gray-500">
                                Total Parts Cost
                            </span>

                            <span class="font-semibold text-gray-900">
                                ₱<span x-text="formatMoney(totalPartsCost)"></span>
                            </span>

                        </div>

                        <div class="flex items-center justify-between mt-2">

                            <span class="text-sm text-gray-500">
                                Total Parts Selling
                            </span>

                            <span class="font-semibold text-gray-900">
                                ₱<span x-text="formatMoney(totalPartsSelling)"></span>
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- SUMMARY --}}
            {{-- ===================================================== --}}

            <div class="mt-4 border border-gray-200 rounded-xl overflow-hidden">

                <div class="bg-gray-900 px-5 py-4">

                    <h3 class="text-sm font-semibold text-white">
                        Repair Estimate Summary
                    </h3>

                    <p class="text-xs text-gray-400 mt-1">
                        Automatically calculated from your parts and labor.
                    </p>

                </div>


                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                        {{-- Parts Selling --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Parts
                            </p>

                            <p class="text-xl font-bold text-gray-900 mt-2">
                                ₱<span x-text="formatMoney(totalPartsSelling)"></span>
                            </p>

                        </div>


                        {{-- Labor --}}
                        <div class="rounded-xl bg-gray-50 p-4">

                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Labor
                            </p>

                            <p class="text-xl font-bold text-gray-900 mt-2">
                                ₱<span x-text="formatMoney(laborCost)"></span>
                            </p>

                        </div>


                        {{-- Total --}}
                        <div class="rounded-xl bg-blue-50 border border-blue-100 p-4">

                            <p class="text-xs font-medium text-blue-600 uppercase tracking-wide">
                                Estimated Total
                            </p>

                            <p class="text-xl font-bold text-blue-700 mt-2">
                                ₱<span x-text="formatMoney(estimatedTotal)"></span>
                            </p>

                        </div>

                    </div>


                    {{-- Profit --}}
                    <div
                        class="mt-4 rounded-xl border p-5"
                        :class="
                            estimatedProfit >= 0
                                ? 'bg-emerald-50 border-emerald-100'
                                : 'bg-red-50 border-red-100'
                        "
                    >

                        <div class="flex items-center justify-between gap-4">

                            <div>

                                <p
                                    class="text-sm font-semibold"
                                    :class="
                                        estimatedProfit >= 0
                                            ? 'text-emerald-800'
                                            : 'text-red-800'
                                    "
                                >
                                    Estimated Profit
                                </p>

                                <p
                                    class="text-xs mt-1"
                                    :class="
                                        estimatedProfit >= 0
                                            ? 'text-emerald-600'
                                            : 'text-red-600'
                                    "
                                >
                                    Selling price + labor minus parts cost
                                </p>

                            </div>


                            <p
                                class="text-2xl font-bold"
                                :class="
                                    estimatedProfit >= 0
                                        ? 'text-emerald-700'
                                        : 'text-red-700'
                                "
                            >
                                ₱<span x-text="formatMoney(estimatedProfit)"></span>
                            </p>

                        </div>

                    </div>


                    {{-- Hidden Values --}}
                    <input
                        type="hidden"
                        name="estimated_cost"
                        :value="estimatedTotal"
                    >

                    <input
                        type="hidden"
                        name="estimated_profit"
                        :value="estimatedProfit"
                    >

                </div>

            </div>

        </div>


        {{-- Status --}}
        <div class="grid md:grid-cols-2 gap-4">

            <div>

                <label class="block font-medium mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2">

                    <option value="pending">
                        Pending
                    </option>

                    <option value="confirmed">
                        Confirmed
                    </option>

                    <option value="in_progress">
                        In Progress
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>

            </div>


            <div>

                <label class="block font-medium mb-2">
                    Payment Status
                </label>

                <select
                    name="payment_status"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2">

                    <option value="unpaid">
                        Unpaid
                    </option>

                    <option value="partial">
                        Partial
                    </option>

                    <option value="paid">
                        Paid
                    </option>

                </select>

            </div>

        </div>


        {{-- Notes --}}
        <div>

            <label class="block font-medium mb-2">
                Notes
            </label>

            <textarea
                name="notes"
                rows="3"
                placeholder="Additional notes..."
                class="w-full border border-gray-200 rounded-lg px-4 py-2">{{ old('notes') }}</textarea>

        </div>


        {{-- Buttons --}}
        <div class="flex justify-end gap-3 pt-4 border-t">

            <a
                href="{{ route('appointments.index') }}"
                class="px-4 py-2 border rounded-lg">

                Cancel

            </a>

            <button
                type="submit"
                class="px-5 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">

                Create Appointment

            </button>

        </div>

    </form>

</div>

@endsection