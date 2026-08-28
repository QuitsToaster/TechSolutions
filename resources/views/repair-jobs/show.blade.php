@extends('layouts.app')

@section('title', 'Repair Job')

@section('page-heading', 'Repair Job')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-3">

                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $repairJob->job_number }}
                </h1>

                @php

                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'diagnosing' => 'bg-blue-100 text-blue-800',
                        'waiting_for_parts' => 'bg-orange-100 text-orange-800',
                        'repairing' => 'bg-purple-100 text-purple-800',
                        'ready_for_pickup' => 'bg-green-100 text-green-800',
                        'released' => 'bg-gray-100 text-gray-800',
                        'on_hold' => 'bg-gray-100 text-gray-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                    ];

                @endphp

                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$repairJob->status] ?? 'bg-gray-100 text-gray-800' }}">

                    {{ ucfirst(str_replace('_', ' ', $repairJob->status)) }}

                </span>

            </div>

            <p class="mt-1 text-sm text-gray-500">
                Repair job details and repair progress.
            </p>

        </div>


        <div class="flex gap-2">

            <a href="{{ route('repair-jobs.index') }}"
               class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">

                Back

            </a>

        </div>

    </div>


    <!-- Main Grid -->

    <div class="grid gap-6 lg:grid-cols-3">

        <!-- Main -->

        <div class="lg:col-span-2 space-y-6">


            <!-- Repair Job Information -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Repair Job Information
                    </h2>

                </div>


                <div class="grid gap-6 p-6 md:grid-cols-2">

                    <div>

                        <p class="text-sm text-gray-500">
                            Job Number
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->job_number }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Date Received
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->date_received?->format('F d, Y') }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Device Type
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->device_type }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Brand
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->brand ?: 'Not specified' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Model
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->model ?: 'Not specified' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Serial Number
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->serial_number ?: 'Not specified' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            IMEI
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->imei ?: 'Not specified' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Priority
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ ucfirst($repairJob->priority) }}
                        </p>

                    </div>

                </div>

            </div>


            <!-- Problem -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Problem Reported
                    </h2>

                </div>

                <div class="p-6">

                    <p class="whitespace-pre-line text-sm leading-6 text-gray-700">
                        {{ $repairJob->problem_reported }}
                    </p>

                </div>

            </div>


            <!-- Diagnosis -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Diagnosis
                    </h2>

                </div>

                <div class="p-6">

                    @if($repairJob->diagnosis)

                        <p class="whitespace-pre-line text-sm leading-6 text-gray-700">
                            {{ $repairJob->diagnosis }}
                        </p>

                    @else

                        <p class="text-sm text-gray-400">
                            No diagnosis recorded yet.
                        </p>

                    @endif

                </div>

            </div>


            <!-- Repair Notes -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Repair Notes
                    </h2>

                </div>

                <div class="p-6">

                    @if($repairJob->repair_notes)

                        <p class="whitespace-pre-line text-sm leading-6 text-gray-700">
                            {{ $repairJob->repair_notes }}
                        </p>

                    @else

                        <p class="text-sm text-gray-400">
                            No repair notes yet.
                        </p>

                    @endif

                </div>

            </div>

        </div>


        <!-- Sidebar -->

        <div class="space-y-6">


            <!-- Customer -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Customer
                    </h2>

                </div>

                <div class="space-y-4 p-6">

                    <div>

                        <p class="text-sm text-gray-500">
                            Name
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->customer->name ?? 'Unknown Customer' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Contact Number
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->customer->contact_number ?? 'Not provided' }}
                        </p>

                    </div>

                </div>

            </div>


            <!-- Cost -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Cost Summary
                    </h2>

                </div>

                <div class="space-y-4 p-6">

                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Estimated Cost
                        </span>

                        <span class="font-medium">
                            ₱{{ number_format($repairJob->estimated_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Labor
                        </span>

                        <span class="font-medium">
                            ₱{{ number_format($repairJob->labor_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Parts
                        </span>

                        <span class="font-medium">
                            ₱{{ number_format($repairJob->parts_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Discount
                        </span>

                        <span class="font-medium">
                            ₱{{ number_format($repairJob->discount, 2) }}
                        </span>

                    </div>


                    <div class="border-t pt-4 flex justify-between">

                        <span class="font-semibold">
                            Final Cost
                        </span>

                        <span class="font-bold text-lg">
                            ₱{{ number_format($repairJob->final_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Amount Paid
                        </span>

                        <span class="font-medium">
                            ₱{{ number_format($repairJob->amount_paid, 2) }}
                        </span>

                    </div>


                    <div class="border-t pt-4 flex justify-between">

                        <span class="font-semibold">
                            Balance
                        </span>

                        <span class="font-bold text-red-600">
                            ₱{{ number_format($repairJob->balance, 2) }}
                        </span>

                    </div>

                </div>

            </div>


            <!-- Status History -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Status History
                    </h2>

                </div>

                <div class="p-6">

                    <div class="space-y-5">

                        @forelse($repairJob->statusHistories->sortByDesc('created_at') as $history)

                            <div>

                                <p class="text-sm font-medium text-gray-900">

                                    {{ ucfirst(str_replace('_', ' ', $history->new_status)) }}

                                </p>

                                <p class="text-xs text-gray-500 mt-1">

                                    {{ $history->created_at?->format('M d, Y h:i A') }}

                                </p>

                                @if($history->remarks)

                                    <p class="mt-2 text-sm text-gray-600">
                                        {{ $history->remarks }}
                                    </p>

                                @endif

                            </div>

                        @empty

                            <p class="text-sm text-gray-400">
                                No status history.
                            </p>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection