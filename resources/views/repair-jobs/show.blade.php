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


    <div class="flex flex-wrap gap-2">

        <!-- Edit Button -->
        <button
            type="button"
            onclick="document.getElementById('edit-repair-job').classList.toggle('hidden'); document.getElementById('view-repair-job').classList.toggle('hidden');"
            class="
                inline-flex
                items-center
                justify-center
                gap-2
                px-4
                py-2
                text-sm
                font-medium
                text-white
                bg-slate-900
                rounded-lg
                hover:bg-slate-800
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
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                />
            </svg>

            Edit

        </button>


        <a
            href="{{ route('repair-jobs.index') }}"
            class="
                inline-flex
                items-center
                justify-center
                px-4
                py-2
                text-sm
                font-medium
                text-gray-700
                bg-white
                border
                border-gray-300
                rounded-lg
                hover:bg-gray-50
            "
        >
            Back
        </a>

    </div>

</div>


{{-- ========================================================= --}}
{{-- EDIT REPAIR JOB --}}
{{-- ========================================================= --}}

<div id="edit-repair-job" class="{{ $errors->any() ? '' : 'hidden' }}">

    <form
        method="POST"
        action="{{ route('repair-jobs.update', $repairJob) }}"
        class="space-y-6"
    >

        @csrf
        @method('PATCH')


        <!-- Device Information -->

        <div class="bg-white border rounded-xl overflow-hidden">

            <div class="border-b px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Edit Repair Job
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the repair job information and add additional details.
                </p>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">


                <!-- Job Number -->

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Job Number
                    </label>

                    <input
                        type="text"
                        value="{{ $repairJob->job_number }}"
                        disabled
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-200
                            bg-gray-100
                            px-3
                            py-2.5
                            text-sm
                            text-gray-500
                        "
                    >

                    <p class="mt-1 text-xs text-gray-400">
                        Job number cannot be changed.
                    </p>

                </div>


                <!-- Date Received -->

                <div>

                    <label
                        for="date_received"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Date Received
                    </label>

                    <input
                        type="date"
                        name="date_received"
                        id="date_received"
                        value="{{ old('date_received', optional($repairJob->date_received)->format('Y-m-d')) }}"
                        required
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('date_received')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Device Type -->

                <div>

                    <label
                        for="device_type"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Device Type
                    </label>

                    <input
                        type="text"
                        name="device_type"
                        id="device_type"
                        value="{{ old('device_type', $repairJob->device_type) }}"
                        required
                        placeholder="e.g. Laptop, iPhone, Desktop PC"
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('device_type')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Brand -->

                <div>

                    <label
                        for="brand"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Brand
                    </label>

                    <input
                        type="text"
                        name="brand"
                        id="brand"
                        value="{{ old('brand', $repairJob->brand) }}"
                        placeholder="e.g. Apple, ASUS, Dell"
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('brand')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Model -->

                <div>

                    <label
                        for="model"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Model
                    </label>

                    <input
                        type="text"
                        name="model"
                        id="model"
                        value="{{ old('model', $repairJob->model) }}"
                        placeholder="e.g. iPhone 13, VivoBook 15"
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('model')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Serial Number -->

                <div>

                    <label
                        for="serial_number"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Serial Number
                    </label>

                    <input
                        type="text"
                        name="serial_number"
                        id="serial_number"
                        value="{{ old('serial_number', $repairJob->serial_number) }}"
                        placeholder="Enter serial number"
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('serial_number')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- IMEI -->

                <div>

                    <label
                        for="imei"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        IMEI
                    </label>

                    <input
                        type="text"
                        name="imei"
                        id="imei"
                        value="{{ old('imei', $repairJob->imei) }}"
                        placeholder="Enter IMEI"
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('imei')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Priority -->

                <div>

                    <label
                        for="priority"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Priority
                    </label>

                    <select
                        name="priority"
                        id="priority"
                        required
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                        <option
                            value="low"
                            @selected(old('priority', $repairJob->priority) === 'low')
                        >
                            Low
                        </option>

                        <option
                            value="normal"
                            @selected(old('priority', $repairJob->priority) === 'normal')
                        >
                            Normal
                        </option>

                        <option
                            value="high"
                            @selected(old('priority', $repairJob->priority) === 'high')
                        >
                            High
                        </option>

                        <option
                            value="urgent"
                            @selected(old('priority', $repairJob->priority) === 'urgent')
                        >
                            Urgent
                        </option>

                    </select>

                    @error('priority')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Expected Completion Date -->

                <div>

                    <label
                        for="expected_completion_date"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Expected Completion Date
                    </label>

                    <input
                        type="date"
                        name="expected_completion_date"
                        id="expected_completion_date"
                        value="{{ old('expected_completion_date', optional($repairJob->expected_completion_date)->format('Y-m-d')) }}"
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >

                    @error('expected_completion_date')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        <!-- Repair Details -->

        <div class="bg-white border rounded-xl overflow-hidden">

            <div class="border-b px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Repair Details
                </h2>

            </div>


            <div class="space-y-6 p-6">


                <!-- Problem Reported -->

                <div>

                    <label
                        for="problem_reported"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Problem Reported
                    </label>

                    <textarea
                        name="problem_reported"
                        id="problem_reported"
                        rows="5"
                        required
                        placeholder="Describe the customer's reported problem..."
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            resize-y
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >{{ old('problem_reported', $repairJob->problem_reported) }}</textarea>

                    @error('problem_reported')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Diagnosis -->

                <div>

                    <label
                        for="diagnosis"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Diagnosis
                    </label>

                    <textarea
                        name="diagnosis"
                        id="diagnosis"
                        rows="5"
                        placeholder="Enter the technician's diagnosis..."
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            resize-y
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >{{ old('diagnosis', $repairJob->diagnosis) }}</textarea>

                    @error('diagnosis')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Repair Notes -->

                <div>

                    <label
                        for="repair_notes"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Repair Notes
                    </label>

                    <textarea
                        name="repair_notes"
                        id="repair_notes"
                        rows="5"
                        placeholder="Add repair notes, parts replaced, work performed, observations, etc."
                        class="
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            px-3
                            py-2.5
                            text-sm
                            resize-y
                            focus:border-slate-500
                            focus:ring-slate-500
                        "
                    >{{ old('repair_notes', $repairJob->repair_notes) }}</textarea>

                    @error('repair_notes')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        <!-- Cost Information -->

        <div class="bg-white border rounded-xl overflow-hidden">

            <div class="border-b px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Cost Information
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update the repair pricing and final cost.
                </p>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2 lg:grid-cols-5">


                <!-- Estimated Cost -->

                <div>

                    <label
                        for="estimated_cost"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Estimated Cost
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="estimated_cost"
                            id="estimated_cost"
                            min="0"
                            step="0.01"
                            value="{{ old('estimated_cost', $repairJob->estimated_cost) }}"
                            required
                            class="
                                w-full
                                rounded-lg
                                border
                                border-gray-300
                                pl-8
                                pr-3
                                py-2.5
                                text-sm
                                focus:border-slate-500
                                focus:ring-slate-500
                            "
                        >

                    </div>

                    @error('estimated_cost')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Labor Cost -->

                <div>

                    <label
                        for="labor_cost"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Labor Cost
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="labor_cost"
                            id="labor_cost"
                            min="0"
                            step="0.01"
                            value="{{ old('labor_cost', $repairJob->labor_cost) }}"
                            required
                            class="
                                w-full
                                rounded-lg
                                border
                                border-gray-300
                                pl-8
                                pr-3
                                py-2.5
                                text-sm
                                focus:border-slate-500
                                focus:ring-slate-500
                            "
                        >

                    </div>

                    @error('labor_cost')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Parts Cost -->

                <div>

                    <label
                        for="parts_cost"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Parts Cost
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="parts_cost"
                            id="parts_cost"
                            min="0"
                            step="0.01"
                            value="{{ old('parts_cost', $repairJob->parts_cost) }}"
                            required
                            class="
                                w-full
                                rounded-lg
                                border
                                border-gray-300
                                pl-8
                                pr-3
                                py-2.5
                                text-sm
                                focus:border-slate-500
                                focus:ring-slate-500
                            "
                        >

                    </div>

                    @error('parts_cost')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Discount -->

                <div>

                    <label
                        for="discount"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Discount
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="discount"
                            id="discount"
                            min="0"
                            step="0.01"
                            value="{{ old('discount', $repairJob->discount) }}"
                            required
                            class="
                                w-full
                                rounded-lg
                                border
                                border-gray-300
                                pl-8
                                pr-3
                                py-2.5
                                text-sm
                                focus:border-slate-500
                                focus:ring-slate-500
                            "
                        >

                    </div>

                    @error('discount')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Final Cost -->

                <div>

                    <label
                        for="final_cost"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Final Cost
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="final_cost"
                            id="final_cost"
                            min="0"
                            step="0.01"
                            value="{{ old('final_cost', $repairJob->final_cost) }}"
                            required
                            class="
                                w-full
                                rounded-lg
                                border
                                border-gray-300
                                pl-8
                                pr-3
                                py-2.5
                                text-sm
                                font-semibold
                                focus:border-slate-500
                                focus:ring-slate-500
                            "
                        >

                    </div>

                    <p class="mt-1 text-xs text-gray-400">
                        Amount already paid: ₱{{ number_format($repairJob->amount_paid, 2) }}
                    </p>

                    @error('final_cost')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        <!-- Form Actions -->

        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

            <button
                type="button"
                onclick="document.getElementById('edit-repair-job').classList.add('hidden'); document.getElementById('view-repair-job').classList.remove('hidden');"
                class="
                    px-5
                    py-2.5
                    rounded-lg
                    bg-white
                    border
                    border-gray-300
                    text-gray-700
                    text-sm
                    font-medium
                    hover:bg-gray-50
                    transition
                "
            >
                Cancel
            </button>

            <button
                type="submit"
                class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    px-5
                    py-2.5
                    rounded-lg
                    bg-slate-900
                    hover:bg-slate-800
                    text-white
                    text-sm
                    font-semibold
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                Save Changes

            </button>

        </div>

    </form>

</div>


{{-- ========================================================= --}}
{{-- VIEW REPAIR JOB --}}
{{-- ========================================================= --}}

<div id="view-repair-job" class="{{ $errors->any() ? 'hidden' : '' }}">

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


                    <div>
                        <p class="text-sm text-gray-500">
                            Expected Completion
                        </p>

                        <p class="mt-1 font-medium text-gray-900">
                            {{ $repairJob->expected_completion_date?->format('F d, Y') ?? 'Not specified' }}
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


            <!-- Update Status -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Update Status
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Update the current repair progress.
                    </p>

                </div>


                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('repair-jobs.update-status', $repairJob) }}"
                        class="space-y-4"
                    >

                        @csrf
                        @method('PATCH')


                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Repair Status
                            </label>

                            <select
                                name="status"
                                id="status"
                                required
                                class="
                                    w-full
                                    rounded-lg
                                    border
                                    border-gray-300
                                    bg-white
                                    px-3
                                    py-2.5
                                    text-sm
                                    focus:border-slate-500
                                    focus:ring-slate-500
                                "
                            >

                                <option value="pending" @selected($repairJob->status === 'pending')>
                                    Pending
                                </option>

                                <option value="diagnosing" @selected($repairJob->status === 'diagnosing')>
                                    Diagnosing
                                </option>

                                <option value="waiting_for_parts" @selected($repairJob->status === 'waiting_for_parts')>
                                    Waiting for Parts
                                </option>

                                <option value="repairing" @selected($repairJob->status === 'repairing')>
                                    Repairing
                                </option>

                                <option value="ready_for_pickup" @selected($repairJob->status === 'ready_for_pickup')>
                                    Ready for Pickup
                                </option>

                                <option value="released" @selected($repairJob->status === 'released')>
                                    Released
                                </option>

                                <option value="on_hold" @selected($repairJob->status === 'on_hold')>
                                    On Hold
                                </option>

                                <option value="cancelled" @selected($repairJob->status === 'cancelled')>
                                    Cancelled
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <div>

                            <label
                                for="remarks"
                                class="block text-sm font-medium text-gray-700 mb-2"
                            >
                                Remarks
                            </label>

                            <textarea
                                name="remarks"
                                id="remarks"
                                rows="3"
                                placeholder="Optional status update notes..."
                                class="
                                    w-full
                                    rounded-lg
                                    border
                                    border-gray-300
                                    px-3
                                    py-2.5
                                    text-sm
                                    resize-none
                                    focus:border-slate-500
                                    focus:ring-slate-500
                                "
                            >{{ old('remarks') }}</textarea>

                            @error('remarks')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <button
                            type="submit"
                            class="
                                w-full
                                px-4
                                py-2.5
                                rounded-lg
                                bg-slate-900
                                hover:bg-slate-800
                                text-white
                                text-sm
                                font-medium
                                transition
                            "
                        >
                            Update Status
                        </button>

                    </form>

                </div>

            </div>


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

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->estimated_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Labor
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->labor_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Parts
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->parts_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Discount
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->discount, 2) }}
                        </span>

                    </div>


                    <div class="border-t pt-4 flex justify-between">

                        <span class="font-semibold text-gray-900">
                            Final Cost
                        </span>

                        <span class="font-bold text-lg text-gray-900">
                            ₱{{ number_format($repairJob->final_cost, 2) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Amount Paid
                        </span>

                        <span class="font-semibold text-green-600">
                            ₱{{ number_format($repairJob->amount_paid, 2) }}
                        </span>

                    </div>


                    <div class="border-t pt-4 flex justify-between">

                        <span class="font-semibold text-gray-900">
                            Balance
                        </span>

                        <span class="font-bold text-lg {{ $repairJob->balance > 0 ? 'text-red-600' : 'text-green-600' }}">
                            ₱{{ number_format($repairJob->balance, 2) }}
                        </span>

                    </div>


                    {{-- Payment Section --}}

                    @if($repairJob->status === 'released')

                        @if($repairJob->balance > 0)

                            <div class="border-t pt-5">

                                <div class="rounded-lg bg-blue-50 border border-blue-200 p-4">

                                    <div class="flex items-start gap-3">

                                        <div class="flex-shrink-0">

                                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">

                                                <svg
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8c-2.21 0-4 1.12-4 2.5S9.79 13 12 13s4 1.12 4 2.5S14.21 18 12 18m0-10V6m0 12v-2m-7-4a7 7 0 1114 0 7 7 0 01-14 0z"
                                                    />
                                                </svg>

                                            </div>

                                        </div>


                                        <div class="flex-1">

                                            <h3 class="text-sm font-semibold text-blue-900">
                                                Record Payment
                                            </h3>

                                            <p class="mt-1 text-xs text-blue-700">
                                                Enter the amount paid by the customer.
                                                Partial payments are allowed.
                                            </p>

                                        </div>

                                    </div>


                                    <form
                                        method="POST"
                                        action="{{ route('repair-jobs.mark-paid', $repairJob) }}"
                                        class="mt-4 space-y-4"
                                    >

                                        @csrf


                                        <div>

                                            <label
                                                for="payment_amount"
                                                class="block text-sm font-medium text-gray-700 mb-2"
                                            >
                                                Payment Amount
                                            </label>

                                            <div class="relative">

                                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                                    ₱
                                                </span>

                                                <input
                                                    type="number"
                                                    name="payment_amount"
                                                    id="payment_amount"
                                                    min="0.01"
                                                    max="{{ $repairJob->balance }}"
                                                    step="0.01"
                                                    value="{{ old('payment_amount') }}"
                                                    required
                                                    placeholder="0.00"
                                                    class="
                                                        w-full
                                                        rounded-lg
                                                        border
                                                        border-gray-300
                                                        bg-white
                                                        pl-8
                                                        pr-3
                                                        py-2.5
                                                        text-sm
                                                        focus:border-blue-500
                                                        focus:ring-blue-500
                                                    "
                                                >

                                            </div>

                                            <p class="mt-1 text-xs text-gray-500">

                                                Remaining balance:

                                                <span class="font-semibold text-red-600">
                                                    ₱{{ number_format($repairJob->balance, 2) }}
                                                </span>

                                            </p>

                                            @error('payment_amount')
                                                <p class="mt-1 text-xs text-red-600">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>


                                        <div class="rounded-lg bg-white border border-blue-100 p-3">

                                            <div class="flex justify-between text-sm">

                                                <span class="text-gray-500">
                                                    Current Paid
                                                </span>

                                                <span class="font-medium text-gray-900">
                                                    ₱{{ number_format($repairJob->amount_paid, 2) }}
                                                </span>

                                            </div>


                                            <div class="flex justify-between text-sm mt-2">

                                                <span class="text-gray-500">
                                                    Current Balance
                                                </span>

                                                <span class="font-medium text-red-600">
                                                    ₱{{ number_format($repairJob->balance, 2) }}
                                                </span>

                                            </div>

                                        </div>


                                        <button
                                            type="submit"
                                            class="
                                                w-full
                                                inline-flex
                                                items-center
                                                justify-center
                                                gap-2
                                                px-4
                                                py-2.5
                                                rounded-lg
                                                bg-blue-600
                                                hover:bg-blue-700
                                                text-white
                                                text-sm
                                                font-semibold
                                                transition
                                            "
                                        >

                                            <svg
                                                class="w-5 h-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8c-2.21 0-4 1.12-4 2.5S9.79 13 12 13s4 1.12 4 2.5S14.21 18 12 18m0-10V6m0 12v-2m-7-4a7 7 0 1114 0 7 7 0 01-14 0 7 7 0 00-7-7z"
                                                />
                                            </svg>

                                            Record Payment

                                        </button>

                                    </form>

                                </div>

                            </div>

                        @else

                            <div class="border-t pt-5">

                                <div class="rounded-lg bg-green-50 border border-green-200 p-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-full bg-green-100 text-green-600 flex items-center justify-center">

                                            <svg
                                                class="w-5 h-5"
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

                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-green-900">
                                                Fully Paid
                                            </p>

                                            <p class="text-xs text-green-700 mt-1">
                                                This repair job has been paid in full.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif

                    @else

                        <div class="border-t pt-5">

                            <div class="rounded-lg bg-gray-50 border border-gray-200 p-4">

                                <p class="text-sm font-medium text-gray-700">
                                    Payment unavailable
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Payment can only be recorded after the repair job has been released.
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            <!-- Status History -->

            <div class="bg-white border rounded-xl overflow-hidden">

                <div class="border-b px-6 py-4">

                    <h2 class="font-semibold text-gray-900">
                        Status History
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Track changes made to this repair job.
                    </p>

                </div>


                <div class="p-6">

                    <div class="space-y-6">

                        @forelse($repairJob->statusHistories->sortByDesc('created_at') as $history)

                            @php

                                $historyColors = [
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


                            <div class="relative pl-6">

                                @if(!$loop->last)

                                    <div class="absolute left-1.5 top-5 bottom-[-24px] w-px bg-gray-200"></div>

                                @endif


                                <div
                                    class="
                                        absolute
                                        left-0
                                        top-1.5
                                        w-3
                                        h-3
                                        rounded-full
                                        bg-slate-900
                                        ring-4
                                        ring-white
                                    "
                                ></div>


                                <div>

                                    <div class="flex flex-wrap items-center gap-2">

                                        <span
                                            class="
                                                inline-flex
                                                px-2.5
                                                py-1
                                                rounded-full
                                                text-xs
                                                font-semibold
                                                {{ $historyColors[$history->new_status] ?? 'bg-gray-100 text-gray-800' }}
                                            "
                                        >
                                            {{ ucfirst(str_replace('_', ' ', $history->new_status)) }}
                                        </span>

                                    </div>


                                    @if($history->old_status)

                                        <p class="text-xs text-gray-500 mt-2">

                                            From

                                            <span class="font-medium text-gray-700">
                                                {{ ucfirst(str_replace('_', ' ', $history->old_status)) }}
                                            </span>

                                            to

                                            <span class="font-medium text-gray-700">
                                                {{ ucfirst(str_replace('_', ' ', $history->new_status)) }}
                                            </span>

                                        </p>

                                    @else

                                        <p class="text-xs text-gray-500 mt-2">
                                            Initial repair job status
                                        </p>

                                    @endif


                                    <p class="text-xs text-gray-400 mt-1">

                                        {{ $history->created_at?->timezone('Asia/Manila')->format('M d, Y h:i A') }}

                                        @if($history->changedBy)

                                            · {{ $history->changedBy->name }}

                                        @endif

                                    </p>


                                    @if($history->remarks)

                                        <div
                                            class="
                                                mt-3
                                                rounded-lg
                                                bg-gray-50
                                                border
                                                border-gray-100
                                                px-3
                                                py-2.5
                                            "
                                        >

                                            <p class="text-sm text-gray-600 whitespace-pre-line">
                                                {{ $history->remarks }}
                                            </p>

                                        </div>

                                    @endif

                                </div>

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


</div>

@endsection
