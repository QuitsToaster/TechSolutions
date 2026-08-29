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


                        <!-- Status -->

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

                                <option
                                    value="pending"
                                    @selected($repairJob->status === 'pending')
                                >
                                    Pending
                                </option>

                                <option
                                    value="diagnosing"
                                    @selected($repairJob->status === 'diagnosing')
                                >
                                    Diagnosing
                                </option>

                                <option
                                    value="waiting_for_parts"
                                    @selected($repairJob->status === 'waiting_for_parts')
                                >
                                    Waiting for Parts
                                </option>

                                <option
                                    value="repairing"
                                    @selected($repairJob->status === 'repairing')
                                >
                                    Repairing
                                </option>

                                <option
                                    value="ready_for_pickup"
                                    @selected($repairJob->status === 'ready_for_pickup')
                                >
                                    Ready for Pickup
                                </option>

                                <option
                                    value="released"
                                    @selected($repairJob->status === 'released')
                                >
                                    Released
                                </option>

                                <option
                                    value="on_hold"
                                    @selected($repairJob->status === 'on_hold')
                                >
                                    On Hold
                                </option>

                                <option
                                    value="cancelled"
                                    @selected($repairJob->status === 'cancelled')
                                >
                                    Cancelled
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Remarks -->

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


                        <!-- Submit -->

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

                    <!-- Estimated Cost -->
                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Estimated Cost
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->estimated_cost, 2) }}
                        </span>

                    </div>


                    <!-- Labor -->
                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Labor
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->labor_cost, 2) }}
                        </span>

                    </div>


                    <!-- Parts -->
                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Parts
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->parts_cost, 2) }}
                        </span>

                    </div>


                    <!-- Discount -->
                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Discount
                        </span>

                        <span class="font-medium text-gray-900">
                            ₱{{ number_format($repairJob->discount, 2) }}
                        </span>

                    </div>


                    <!-- Final Cost -->
                    <div class="border-t pt-4 flex justify-between">

                        <span class="font-semibold text-gray-900">
                            Final Cost
                        </span>

                        <span class="font-bold text-lg text-gray-900">
                            ₱{{ number_format($repairJob->final_cost, 2) }}
                        </span>

                    </div>


                    <!-- Amount Paid -->
                    <div class="flex justify-between">

                        <span class="text-sm text-gray-500">
                            Amount Paid
                        </span>

                        <span class="font-semibold text-green-600">
                            ₱{{ number_format($repairJob->amount_paid, 2) }}
                        </span>

                    </div>


                    <!-- Balance -->
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


                                        <!-- Payment Amount -->

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


                                        <!-- Payment Preview -->

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


                                        <!-- Submit -->

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
                                                    d="M12 8c-2.21 0-4 1.12-4 2.5S9.79 13 12 13s4 1.12 4 2.5S14.21 18 12 18m0-10V6m0 12v-2m-7-4a7 7 0 1114 0 7 7 0 01-14 0z"
                                                />

                                            </svg>

                                            Record Payment

                                        </button>

                                    </form>

                                </div>

                            </div>


                        @else

                            <!-- Fully Paid -->

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

                        <!-- Payment unavailable -->

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

                                <!-- Timeline line -->

                                @if(!$loop->last)

                                    <div class="absolute left-1.5 top-5 bottom-[-24px] w-px bg-gray-200"></div>

                                @endif


                                <!-- Timeline dot -->

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


                                <!-- Status -->

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


                                    <!-- Status transition -->

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


                                    <!-- Date -->

                                    <p class="text-xs text-gray-400 mt-1">

                                        {{ $history->created_at?->format('M d, Y h:i A') }}

                                        @if($history->changedBy)

                                            · {{ $history->changedBy->name }}

                                        @endif

                                    </p>


                                    <!-- Remarks -->

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

@endsection