@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <h1 class="text-2xl font-bold text-gray-900">
                    Appointment Details
                </h1>

                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'confirmed' => 'bg-blue-100 text-blue-800',
                        'in_progress' => 'bg-purple-100 text-purple-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                    ];
                @endphp

                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$appointment->status] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                </span>

            </div>

            <p class="mt-1 text-sm text-gray-500">
                View appointment information, repair costs, profit, and customer details.
            </p>
        </div>

        <div class="flex gap-2">

            <a
                href="{{ route('appointments.index') }}"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition"
            >
                Back
            </a>

            <a
                href="{{ route('appointments.edit', $appointment) }}"
                class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition"
            >
                Edit Appointment
            </a>

        </div>

    </div>


    <!-- Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3">

        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">


            <!-- Appointment Information -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

                <div class="border-b border-gray-200 px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Appointment Information
                    </h2>

                </div>

                <div class="grid gap-6 p-6 md:grid-cols-2">

                    <!-- Appointment Date -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Appointment Date
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->appointment_date->format('F d, Y') }}
                        </p>
                    </div>


                    <!-- Appointment Time -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Appointment Time
                        </p>

                        <p class="mt-1 font-medium text-gray-900">

                            @if($appointment->appointment_time)

                                {{ date('h:i A', strtotime($appointment->appointment_time)) }}

                            @else

                                <span class="text-gray-400">
                                    Not specified
                                </span>

                            @endif

                        </p>
                    </div>


                    <!-- Device Type -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Device Type
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->device_type }}
                        </p>
                    </div>


                    <!-- Device Model -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Device Model
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->device_model }}
                        </p>
                    </div>


                    <!-- Service -->
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-500">
                            Service / Repair
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->service }}
                        </p>
                    </div>


                    <!-- Payment Status -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Payment Status
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ ucfirst($appointment->payment_status) }}
                        </p>
                    </div>


                    <!-- Created -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Created
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->created_at?->format('F d, Y h:i A') }}
                        </p>
                    </div>

                </div>

            </div>


            <!-- Problem Description -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

                <div class="border-b border-gray-200 px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Problem Description
                    </h2>

                </div>

                <div class="p-6">

                    @if($appointment->problem_description)

                        <p class="whitespace-pre-line text-sm leading-6 text-gray-700">
                            {{ $appointment->problem_description }}
                        </p>

                    @else

                        <p class="text-sm text-gray-400">
                            No problem description provided.
                        </p>

                    @endif

                </div>

            </div>


            <!-- Repair Cost & Profit -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

                <div class="border-b border-gray-200 px-6 py-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h2 class="font-semibold text-gray-900">
                                Repair Cost & Profit
                            </h2>

                            <p class="mt-1 text-xs text-gray-500">
                                Breakdown of parts, labor, customer charge, and estimated profit.
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-6 space-y-6">


                    <!-- Parts Breakdown -->
                    <div>

                        <div class="flex items-center justify-between mb-3">

                            <h3 class="text-sm font-semibold text-gray-900">
                                Parts Breakdown
                            </h3>

                            @if(!empty($appointment->parts_breakdown))
                                <span class="text-xs text-gray-500">
                                    {{ count($appointment->parts_breakdown) }}
                                    {{ count($appointment->parts_breakdown) === 1 ? 'item' : 'items' }}
                                </span>
                            @endif

                        </div>


                        @if(!empty($appointment->parts_breakdown))

                            <div class="overflow-x-auto border border-gray-200 rounded-lg">

                                <table class="min-w-full text-sm">

                                    <thead class="bg-gray-50 border-b border-gray-200">

                                        <tr>

                                            <th class="px-4 py-3 text-left font-medium text-gray-600">
                                                Part
                                            </th>

                                            <th class="px-4 py-3 text-center font-medium text-gray-600">
                                                Qty
                                            </th>

                                            <th class="px-4 py-3 text-right font-medium text-gray-600">
                                                Unit Cost
                                            </th>

                                            <th class="px-4 py-3 text-right font-medium text-gray-600">
                                                Selling Price
                                            </th>

                                            <th class="px-4 py-3 text-right font-medium text-gray-600">
                                                Total Cost
                                            </th>

                                            <th class="px-4 py-3 text-right font-medium text-gray-600">
                                                Total Selling
                                            </th>

                                            <th class="px-4 py-3 text-right font-medium text-gray-600">
                                                Profit
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody class="divide-y divide-gray-200 bg-white">

                                        @foreach($appointment->parts_breakdown as $part)

                                            @php
                                                $quantity = (float) ($part['quantity'] ?? 0);
                                                $unitCost = (float) ($part['unit_cost'] ?? 0);
                                                $sellingPrice = (float) ($part['selling_price'] ?? 0);

                                                $totalCost = $quantity * $unitCost;
                                                $totalSelling = $quantity * $sellingPrice;
                                                $partProfit = $totalSelling - $totalCost;
                                            @endphp

                                            <tr class="hover:bg-gray-50">

                                                <!-- Part Name -->
                                                <td class="px-4 py-3">

                                                    <p class="font-medium text-gray-900">
                                                        {{ $part['name'] ?? 'Unnamed Part' }}
                                                    </p>

                                                </td>


                                                <!-- Quantity -->
                                                <td class="px-4 py-3 text-center text-gray-700">
                                                    {{ rtrim(rtrim(number_format($quantity, 2), '0'), '.') }}
                                                </td>


                                                <!-- Unit Cost -->
                                                <td class="px-4 py-3 text-right text-gray-700">
                                                    ₱{{ number_format($unitCost, 2) }}
                                                </td>


                                                <!-- Selling Price -->
                                                <td class="px-4 py-3 text-right text-gray-700">
                                                    ₱{{ number_format($sellingPrice, 2) }}
                                                </td>


                                                <!-- Total Cost -->
                                                <td class="px-4 py-3 text-right text-gray-700">
                                                    ₱{{ number_format($totalCost, 2) }}
                                                </td>


                                                <!-- Total Selling -->
                                                <td class="px-4 py-3 text-right font-medium text-gray-900">
                                                    ₱{{ number_format($totalSelling, 2) }}
                                                </td>


                                                <!-- Part Profit -->
                                                <td class="px-4 py-3 text-right font-medium text-green-700">
                                                    ₱{{ number_format($partProfit, 2) }}
                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>


                            <!-- Parts Totals -->
                            @php
                                $totalPartsCost = 0;
                                $totalPartsSelling = 0;

                                foreach ($appointment->parts_breakdown as $part) {

                                    $quantity = (float) ($part['quantity'] ?? 0);
                                    $unitCost = (float) ($part['unit_cost'] ?? 0);
                                    $sellingPrice = (float) ($part['selling_price'] ?? 0);

                                    $totalPartsCost += $quantity * $unitCost;
                                    $totalPartsSelling += $quantity * $sellingPrice;
                                }

                                $totalPartsProfit = $totalPartsSelling - $totalPartsCost;
                            @endphp


                            <div class="grid gap-3 mt-4 sm:grid-cols-3">

                                <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                                    <p class="text-xs text-gray-500">
                                        Total Parts Cost
                                    </p>

                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                        ₱{{ number_format($totalPartsCost, 2) }}
                                    </p>

                                </div>


                                <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                                    <p class="text-xs text-gray-500">
                                        Total Parts Selling
                                    </p>

                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                        ₱{{ number_format($totalPartsSelling, 2) }}
                                    </p>

                                </div>


                                <div class="rounded-lg bg-green-50 border border-green-200 p-4">

                                    <p class="text-xs text-green-700">
                                        Parts Profit
                                    </p>

                                    <p class="mt-1 text-lg font-semibold text-green-700">
                                        ₱{{ number_format($totalPartsProfit, 2) }}
                                    </p>

                                </div>

                            </div>

                        @else

                            <div class="rounded-lg border border-dashed border-gray-300 p-6 text-center">

                                <p class="text-sm text-gray-400">
                                    No parts added to this appointment.
                                </p>

                            </div>

                        @endif

                    </div>


                    <!-- Labor -->
                    <div class="border-t border-gray-200 pt-6">

                        <h3 class="text-sm font-semibold text-gray-900 mb-3">
                            Labor
                        </h3>

                        <div class="flex items-center justify-between rounded-lg bg-gray-50 border border-gray-200 px-4 py-4">

                            <div>

                                <p class="text-sm text-gray-500">
                                    Labor Charge
                                </p>

                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    ₱{{ number_format($appointment->labor_cost ?? 0, 2) }}
                                </p>

                            </div>

                            <div class="text-right">

                                <p class="text-xs text-gray-500">
                                    Labor Profit
                                </p>

                                <p class="mt-1 font-semibold text-green-700">
                                    ₱{{ number_format($appointment->labor_cost ?? 0, 2) }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Financial Summary -->
                    <div class="border-t border-gray-200 pt-6">

                        <h3 class="text-sm font-semibold text-gray-900 mb-4">
                            Financial Summary
                        </h3>


                        <div class="grid gap-4 sm:grid-cols-3">


                            <!-- Customer Charge -->
                            <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

                                <p class="text-xs font-medium uppercase tracking-wide text-blue-600">
                                    Customer Charge
                                </p>

                                <p class="mt-2 text-2xl font-bold text-blue-900">
                                    ₱{{ number_format($appointment->estimated_cost ?? 0, 2) }}
                                </p>

                                <p class="mt-1 text-xs text-blue-600">
                                    Parts Selling + Labor
                                </p>

                            </div>


                            <!-- Total Cost -->
                            <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">

                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Total Cost
                                </p>

                                <p class="mt-2 text-2xl font-bold text-gray-900">

                                    ₱{{ number_format($totalPartsCost ?? 0, 2) }}

                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Parts purchase cost
                                </p>

                            </div>


                            <!-- Estimated Profit -->
                            <div class="rounded-xl border border-green-200 bg-green-50 p-5">

                                <p class="text-xs font-medium uppercase tracking-wide text-green-600">
                                    Estimated Profit
                                </p>

                                <p class="mt-2 text-2xl font-bold text-green-700">
                                    ₱{{ number_format($appointment->estimated_profit ?? 0, 2) }}
                                </p>

                                <p class="mt-1 text-xs text-green-600">
                                    Parts Profit + Labor
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Profit Calculation -->
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <p class="text-sm font-medium text-gray-900">
                                    Profit Calculation
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Estimated customer charge minus parts cost.
                                </p>

                            </div>

                            <p class="text-sm font-semibold text-gray-900">

                                ₱{{ number_format($appointment->estimated_cost ?? 0, 2) }}

                                <span class="text-gray-400 mx-1">
                                    −
                                </span>

                                ₱{{ number_format($totalPartsCost ?? 0, 2) }}

                                <span class="text-gray-400 mx-1">
                                    =
                                </span>

                                <span class="text-green-700">
                                    ₱{{ number_format($appointment->estimated_profit ?? 0, 2) }}
                                </span>

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Notes -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

                <div class="border-b border-gray-200 px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Notes
                    </h2>

                </div>

                <div class="p-6">

                    @if($appointment->notes)

                        <p class="whitespace-pre-line text-sm leading-6 text-gray-700">
                            {{ $appointment->notes }}
                        </p>

                    @else

                        <p class="text-sm text-gray-400">
                            No notes added.
                        </p>

                    @endif

                </div>

            </div>

        </div>


        <!-- Sidebar -->
        <div class="space-y-6">


            <!-- Customer Information -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

                <div class="border-b border-gray-200 px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Customer
                    </h2>

                </div>

                <div class="space-y-5 p-6">

                    <div>

                        <p class="text-sm text-gray-500">
                            Name
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->customer->name ?? 'Unknown Customer' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Contact Number
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $appointment->customer->contact_number ?? 'Not provided' }}
                        </p>

                    </div>


                    @if($appointment->customer)

                        <div class="pt-2">

                            <a
                                href="{{ route('customers.show', $appointment->customer) }}"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition"
                            >
                                View Customer
                            </a>

                        </div>

                    @endif

                </div>

            </div>


            <!-- Financial Quick Summary -->
            <div class="bg-gray-900 rounded-xl p-6 text-white">

                <p class="text-xs font-medium uppercase tracking-wider text-gray-400">
                    Financial Summary
                </p>

                <div class="mt-4 space-y-4">


                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-400">
                            Customer Charge
                        </span>

                        <span class="font-semibold">
                            ₱{{ number_format($appointment->estimated_cost ?? 0, 2) }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-400">
                            Parts Cost
                        </span>

                        <span class="font-semibold">
                            ₱{{ number_format($totalPartsCost ?? 0, 2) }}
                        </span>

                    </div>


                    <div class="border-t border-gray-700 pt-4 flex items-center justify-between">

                        <span class="text-sm text-gray-400">
                            Estimated Profit
                        </span>

                        <span class="text-lg font-bold text-green-400">
                            ₱{{ number_format($appointment->estimated_profit ?? 0, 2) }}
                        </span>

                    </div>

                </div>

            </div>


            <!-- Repair Job -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">

                <h2 class="font-semibold text-blue-900">
                    Repair Job
                </h2>


                @if($appointment->repairJob)

                    <p class="mt-2 text-sm text-blue-700">
                        This appointment has already been converted into a repair job.
                    </p>


                    <a
                        href="{{ route('repair-jobs.show', $appointment->repairJob) }}"
                        class="mt-4 block w-full px-4 py-2 text-center text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition"
                    >
                        View Repair Job
                    </a>

                @else

                    <p class="mt-2 text-sm text-blue-700">
                        Convert this appointment into a repair job to begin the repair process.
                    </p>


                    <form
                        method="POST"
                        action="{{ route('appointments.convert-to-repair-job', $appointment) }}"
                        class="mt-4"
                        onsubmit="return confirm('Convert this appointment into a repair job?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition"
                        >
                            Convert to Repair Job
                        </button>

                    </form>


                    <p class="mt-2 text-xs text-blue-600">
                        This will create a new repair job with the appointment information.
                    </p>

                @endif

            </div>

        </div>

    </div>

</div>
@endsection