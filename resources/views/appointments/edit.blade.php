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
        <div class="bg-white border rounded-xl overflow-hidden">
            <div class="border-b px-6 py-4">
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
        <div class="bg-white border rounded-xl overflow-hidden">
            <div class="border-b px-6 py-4">
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
        <div class="bg-white border rounded-xl overflow-hidden">
            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-gray-900">Problem & Cost</h2>
            </div>
            <div class="space-y-6 p-6">
                <!-- Problem Description -->
                <div>
                    <label for="problem_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Problem Description
                    </label>
                    <textarea id="problem_description" name="problem_description" rows="4"
                              placeholder="Describe the customer's reported problem..."
                              class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">{{ old('problem_description', $appointment->problem_description) }}</textarea>
                    @error('problem_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estimated Cost -->
                <div>
                    <label for="estimated_cost" class="block text-sm font-medium text-gray-700 mb-2">
                        Estimated Cost
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">₱</span>
                        <input type="number" id="estimated_cost" name="estimated_cost"
                               value="{{ old('estimated_cost', $appointment->estimated_cost) }}"
                               min="0" step="0.01" placeholder="0.00"
                               class="w-full pl-8 rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                    </div>
                    @error('estimated_cost')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Status & Payment -->
        <div class="bg-white border rounded-xl overflow-hidden">
            <div class="border-b px-6 py-4">
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
        <div class="bg-white border rounded-xl overflow-hidden">
            <div class="border-b px-6 py-4">
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
@endsection