@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-bold text-gray-900">Appointment Details</h1>
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
            <p class="mt-1 text-sm text-gray-500">View appointment information and customer details.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('appointments.index') }}"
               class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Back
            </a>
            <a href="{{ route('appointments.edit', $appointment) }}"
               class="px-4 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 transition">
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
                    <h2 class="font-semibold text-gray-900">Appointment Information</h2>
                </div>
                <div class="grid gap-6 p-6 md:grid-cols-2">
                    <div>
                        <p class="text-sm text-gray-500">Appointment Date</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->appointment_date->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Appointment Time</p>
                        <p class="mt-1 font-medium text-gray-900">
                            @if($appointment->appointment_time)
                                {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                            @else
                                <span class="text-gray-400">Not specified</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Device Type</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->device_type }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Device Model</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->device_model }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Service</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->service }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Estimated Cost</p>
                        <p class="mt-1 font-medium text-gray-900">₱{{ number_format($appointment->estimated_cost ?? 0, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Payment Status</p>
                        <p class="mt-1 font-medium text-gray-900">{{ ucfirst($appointment->payment_status) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Created</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->created_at?->format('F d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Problem Description -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="font-semibold text-gray-900">Problem Description</h2>
                </div>
                <div class="p-6">
                    @if($appointment->problem_description)
                        <p class="whitespace-pre-line text-sm leading-6 text-gray-700">{{ $appointment->problem_description }}</p>
                    @else
                        <p class="text-sm text-gray-400">No problem description provided.</p>
                    @endif
                </div>
            </div>

            <!-- Notes -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="font-semibold text-gray-900">Notes</h2>
                </div>
                <div class="p-6">
                    @if($appointment->notes)
                        <p class="whitespace-pre-line text-sm leading-6 text-gray-700">{{ $appointment->notes }}</p>
                    @else
                        <p class="text-sm text-gray-400">No notes added.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Customer Information -->
            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="font-semibold text-gray-900">Customer</h2>
                </div>
                <div class="space-y-5 p-6">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->customer->name ?? 'Unknown Customer' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Contact Number</p>
                        <p class="mt-1 font-medium text-gray-900">{{ $appointment->customer->contact_number ?? 'Not provided' }}</p>
                    </div>
                    @if($appointment->customer)
                        <div class="pt-2">
                            <a href="{{ route('customers.show', $appointment->customer) }}"
                               class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                View Customer
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Repair Job -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <h2 class="font-semibold text-blue-900">Repair Job</h2>

                @if($appointment->repairJob)
                    <p class="mt-2 text-sm text-blue-700">
                        This appointment has already been converted into a repair job.
                    </p>

                    <a href="{{ route('repair-jobs.show', $appointment->repairJob) }}"
                    class="mt-4 block w-full px-4 py-2 text-center text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        View Repair Job
                    </a>
                @else
                    <p class="mt-2 text-sm text-blue-700">
                        Convert this appointment into a repair job to begin the repair process.
                    </p>

                    <form method="POST"
                        action="{{ route('appointments.convert-to-repair-job', $appointment) }}"
                        class="mt-4"
                        onsubmit="return confirm('Convert this appointment into a repair job?');">

                        @csrf

                        <button type="submit"
                                class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
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