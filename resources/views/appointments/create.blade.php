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
          class="bg-white border rounded-xl p-6 space-y-6">

        @csrf


        {{-- Customer --}}
        <div>

            <label class="block font-medium mb-2">
                Customer
            </label>

            <select
                name="customer_id"
                required
                class="w-full border rounded-lg px-4 py-2">

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
                    class="w-full border rounded-lg px-4 py-2">

            </div>


            <div>

                <label class="block font-medium mb-2">
                    Appointment Time
                </label>

                <input
                    type="time"
                    name="appointment_time"
                    value="{{ old('appointment_time') }}"
                    class="w-full border rounded-lg px-4 py-2">

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
                    class="w-full border rounded-lg px-4 py-2">

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
                    class="w-full border rounded-lg px-4 py-2">

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
                class="w-full border rounded-lg px-4 py-2">

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
                class="w-full border rounded-lg px-4 py-2">{{ old('problem_description') }}</textarea>

        </div>


        {{-- Cost --}}
        <div>

            <label class="block font-medium mb-2">
                Estimated Cost
            </label>

            <input
                type="number"
                step="0.01"
                name="estimated_cost"
                value="{{ old('estimated_cost') }}"
                placeholder="₱0.00"
                class="w-full border rounded-lg px-4 py-2">

        </div>


        {{-- Status --}}
        <div class="grid md:grid-cols-2 gap-4">

            <div>

                <label class="block font-medium mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-2">

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
                    class="w-full border rounded-lg px-4 py-2">

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
                class="w-full border rounded-lg px-4 py-2">{{ old('notes') }}</textarea>

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