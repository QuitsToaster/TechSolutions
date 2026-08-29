@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-heading', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Dashboard
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Overview of your repair business.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">

            {{-- New Appointment --}}
            <a
                href="{{ route('appointments.create') }}"
                class="group flex items-center gap-3 rounded-xl border border-blue-100
                    bg-blue-50/50 px-4 py-3.5
                    hover:bg-blue-600 hover:border-blue-600
                    transition-all duration-200"
            >

                <div
                    class="w-10 h-10 shrink-0 rounded-lg bg-blue-100
                        text-blue-600 flex items-center justify-center
                        group-hover:bg-white/20 group-hover:text-white transition"
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
                            stroke-width="1.8"
                            d="M8 2v4M16 2v4M3 10h18"
                        />

                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="17"
                            rx="2"
                            stroke-width="1.8"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M12 13v4M10 15h4"
                        />
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 group-hover:text-white">
                        Appointment
                    </p>

                    <p class="text-xs text-gray-500 group-hover:text-blue-100">
                        Schedule a visit
                    </p>
                </div>

            </a>


            {{-- Add Customer --}}
            <a
                href="{{ route('customers.create') }}"
                class="group flex items-center gap-3 rounded-xl border border-emerald-100
                    bg-emerald-50/50 px-4 py-3.5
                    hover:bg-emerald-600 hover:border-emerald-600
                    transition-all duration-200"
            >

                <div
                    class="w-10 h-10 shrink-0 rounded-lg bg-emerald-100
                        text-emerald-600 flex items-center justify-center
                        group-hover:bg-white/20 group-hover:text-white transition"
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
                            stroke-width="1.8"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                            stroke-width="1.8"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M19 8v6M16 11h6"
                        />
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 group-hover:text-white">
                        Customer
                    </p>

                    <p class="text-xs text-gray-500 group-hover:text-emerald-100">
                        Add new customer
                    </p>
                </div>

            </a>


            {{-- Repair Jobs --}}
            <a
                href="{{ route('repair-jobs.index') }}"
                class="group flex items-center gap-3 rounded-xl border border-orange-100
                    bg-orange-50/50 px-4 py-3.5
                    hover:bg-orange-600 hover:border-orange-600
                    transition-all duration-200"
            >

                <div
                    class="w-10 h-10 shrink-0 rounded-lg bg-orange-100
                        text-orange-600 flex items-center justify-center
                        group-hover:bg-white/20 group-hover:text-white transition"
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
                            stroke-width="1.8"
                            d="M14.7 6.3a4 4 0 01-5 5L4 17l3 3 5.7-5.7a4 4 0 015-5z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 4l5 5"
                        />
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 group-hover:text-white">
                        Repair Jobs
                    </p>

                    <p class="text-xs text-gray-500 group-hover:text-orange-100">
                        Manage repairs
                    </p>
                </div>

            </a>


            {{-- New Order --}}
            <a
                href="{{ route('orders.create') }}"
                class="group flex items-center gap-3 rounded-xl border border-violet-100
                    bg-violet-50/50 px-4 py-3.5
                    hover:bg-violet-600 hover:border-violet-600
                    transition-all duration-200"
            >

                <div
                    class="w-10 h-10 shrink-0 rounded-lg bg-violet-100
                        text-violet-600 flex items-center justify-center
                        group-hover:bg-white/20 group-hover:text-white transition"
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
                            stroke-width="1.8"
                            d="M3 7h18M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 11v5M9.5 13.5h5"
                        />
                    </svg>
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 group-hover:text-white">
                        New Order
                    </p>

                    <p class="text-xs text-gray-500 group-hover:text-violet-100">
                        Order parts
                    </p>
                </div>

            </a>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MAIN STAT CARDS --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">

        {{-- Today's Appointments --}}

        <a
            href="{{ route('appointments.index') }}"
            class="bg-white rounded-xl border border-gray-200 p-5 hover:border-blue-300 hover:shadow-sm transition"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Today's Appointments
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $todayAppointments->count() }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="17"
                            rx="2"
                            stroke-width="1.8"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M16 2v4M8 2v4M3 10h18"
                        />
                    </svg>

                </div>

            </div>

        </a>


        {{-- Active Repairs --}}

        <a
            href="{{ route('repair-jobs.index') }}"
            class="bg-white rounded-xl border border-gray-200 p-5 hover:border-orange-300 hover:shadow-sm transition"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Active Repairs
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $activeRepairs }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M14.7 6.3a4 4 0 01-5 5L4 17l3 3 5.7-5.7a4 4 0 015-5z"
                        />
                    </svg>

                </div>

            </div>

        </a>


        {{-- Ready for Pickup --}}

        <a
            href="{{ route('repair-jobs.index') }}"
            class="bg-white rounded-xl border border-gray-200 p-5 hover:border-green-300 hover:shadow-sm transition"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Ready for Pickup
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $readyRepairs }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

            </div>

        </a>


        {{-- Low Stock --}}

        <a
            href="{{ route('parts.index') }}"
            class="bg-white rounded-xl border border-gray-200 p-5 hover:border-red-300 hover:shadow-sm transition"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Low Stock
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $lowStockParts }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4M12 17h.01M10.3 3.7L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.7a2 2 0 00-3.4 0z"
                        />
                    </svg>

                </div>

            </div>

        </a>

        {{-- Orders --}}

        <a
            href="{{ route('orders.index') }}"
            class="bg-white rounded-xl border border-gray-200 p-5 hover:border-indigo-300 hover:shadow-sm transition"
        >

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Orders
                    </p>

                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $totalOrders }}
                    </p>

                </div>

                <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 7h18M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 11h6M9 15h6"
                        />
                    </svg>

                </div>

            </div>

        </a>


        {{-- ========================================================= --}}
        {{-- FINANCIAL STAT CARDS --}}
        {{-- ========================================================= --}}

        <div class="lg:col-span-5 grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Monthly Revenue --}}

            <div class="bg-white rounded-xl border border-gray-200 p-6
                        hover:border-emerald-300 hover:shadow-sm transition">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Revenue This Month
                        </p>

                        <p class="text-3xl font-bold text-gray-900 mt-3">
                            ₱{{ number_format($monthlyRevenue, 2) }}
                        </p>

                        <p class="text-xs text-gray-400 mt-2">
                            Total revenue from released repairs
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 2v20M17 6.5C17 4.6 15 3 12 3S7 4.6 7 6.5 9 10 12 10s5 1.5 5 3.5S15 17 12 17s-5-1.6-5-3.5"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- Outstanding Balance --}}

            <div class="bg-white rounded-xl border border-gray-200 p-6
                        hover:border-yellow-300 hover:shadow-sm transition">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Outstanding Balance
                        </p>

                        <p class="text-3xl font-bold text-gray-900 mt-3">
                            ₱{{ number_format($outstandingBalance, 2) }}
                        </p>

                        <p class="text-xs text-gray-400 mt-2">
                            Unpaid repair balances
                        </p>

                    </div>

                    <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center">

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 8v4l3 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- REPAIR STATUS OVERVIEW --}}
    {{-- ========================================================= --}}

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200">

            <div>
                <h2 class="font-semibold text-gray-900">
                    Repair Job Overview
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Current status of all repair jobs.
                </p>
            </div>

        </div>


        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 divide-x divide-y lg:divide-y-0 divide-gray-100">

            {{-- Pending --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Pending
                </p>

                <p class="text-2xl font-bold text-gray-900 mt-2">
                    {{ $pendingRepairs }}
                </p>

            </div>


            {{-- Diagnosing --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Diagnosing
                </p>

                <p class="text-2xl font-bold text-purple-600 mt-2">
                    {{ $diagnosingRepairs }}
                </p>

            </div>


            {{-- Waiting for Parts --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Waiting Parts
                </p>

                <p class="text-2xl font-bold text-orange-600 mt-2">
                    {{ $waitingForParts }}
                </p>

            </div>


            {{-- Repairing --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Repairing
                </p>

                <p class="text-2xl font-bold text-blue-600 mt-2">
                    {{ $repairingRepairs }}
                </p>

            </div>


            {{-- On Hold --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    On Hold
                </p>

                <p class="text-2xl font-bold text-yellow-600 mt-2">
                    {{ $onHoldRepairs }}
                </p>

            </div>


            {{-- Ready --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Ready
                </p>

                <p class="text-2xl font-bold text-green-600 mt-2">
                    {{ $readyRepairs }}
                </p>

            </div>


            {{-- Released --}}

            <div class="p-5">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Released
                </p>

                <p class="text-2xl font-bold text-gray-900 mt-2">
                    {{ $releasedRepairs }}
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TODAY'S APPOINTMENTS + READY FOR PICKUP --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Today's Appointments --}}

        <div class="xl:col-span-2 bg-white border border-gray-200 rounded-xl overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">

                <div>

                    <h2 class="font-semibold text-gray-900">
                        Today's Appointments
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Scheduled appointments for today.
                    </p>

                </div>

                <a
                    href="{{ route('appointments.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700"
                >
                    View all
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                                Customer
                            </th>

                            <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                                Device
                            </th>

                            <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                                Service
                            </th>

                            <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @forelse($todayAppointments as $appointment)

                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4">

                                    <a
                                        href="{{ route('appointments.show', $appointment) }}"
                                        class="font-medium text-gray-900 hover:text-blue-600"
                                    >
                                        {{ $appointment->customer->name ?? 'Unknown Customer' }}
                                    </a>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $appointment->customer->contact_number ?? 'No contact' }}
                                    </p>

                                </td>


                                <td class="px-6 py-4">

                                    <p class="text-sm font-medium text-gray-900">

                                        {{ $appointment->brand ?? '' }}

                                        {{ $appointment->model ?? '' }}

                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $appointment->device_type ?? 'Unknown Device' }}
                                    </p>

                                </td>


                                {{-- Service --}}

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $appointment->service ?: 'No service' }}
                                </td>


                                <td class="px-6 py-4">

                                    @php
                                        $appointmentStatusClasses = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'in_progress' => 'bg-purple-100 text-purple-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp

                                    <span
                                        class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $appointmentStatusClasses[$appointment->status] ?? 'bg-gray-100 text-gray-700' }}"
                                    >
                                        {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="px-6 py-12 text-center"
                                >

                                    <p class="text-sm text-gray-500">
                                        No appointments scheduled for today.
                                    </p>

                                    <a
                                        href="{{ route('appointments.create') }}"
                                        class="inline-flex mt-3 text-sm font-medium text-blue-600 hover:text-blue-700"
                                    >
                                        Create an appointment
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Ready For Pickup --}}

        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">

                <div>

                    <h2 class="font-semibold text-gray-900">
                        Ready for Pickup
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Customers who can claim their devices.
                    </p>

                </div>

                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                    {{ $readyRepairs }}
                </span>

            </div>


            <div class="divide-y divide-gray-100">

                @forelse($readyForPickupJobs as $job)

                    <a
                        href="{{ route('repair-jobs.show', $job) }}"
                        class="block p-5 hover:bg-gray-50 transition"
                    >

                        <div class="flex items-start justify-between gap-3">

                            <div class="min-w-0">

                                <p class="text-xs font-semibold text-blue-600">
                                    {{ $job->job_number }}
                                </p>

                                <p class="font-medium text-gray-900 mt-1 truncate">
                                    {{ $job->customer->name ?? 'Unknown Customer' }}
                                </p>

                                <p class="text-sm text-gray-500 mt-1 truncate">
                                    {{ $job->brand ?? '' }}
                                    {{ $job->model ?? '' }}
                                </p>

                            </div>

                            <svg
                                class="w-5 h-5 text-gray-400 flex-shrink-0"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>

                        </div>

                        <div class="flex items-center justify-between mt-3">

                            <span class="text-xs text-gray-500">
                                Balance
                            </span>

                            <span class="text-sm font-semibold text-gray-900">
                                ₱{{ number_format($job->balance, 2) }}
                            </span>

                        </div>

                    </a>

                @empty

                    <div class="p-8 text-center">

                        <p class="text-sm text-gray-500">
                            No repairs are currently ready for pickup.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- RECENT REPAIR JOBS --}}
    {{-- ========================================================= --}}

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-gray-900">
                    Recent Repair Jobs
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Latest repair jobs recorded in the system.
                </p>

            </div>

            <a
                href="{{ route('repair-jobs.index') }}"
                class="text-sm font-medium text-blue-600 hover:text-blue-700"
            >
                View all
            </a>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Job #
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Customer
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Device
                        </th>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Status
                        </th>

                        <th class="text-right px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Cost
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($recentRepairJobs as $job)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('repair-jobs.show', $job) }}"
                                    class="font-semibold text-blue-600 hover:text-blue-700"
                                >
                                    {{ $job->job_number }}
                                </a>

                            </td>


                            <td class="px-6 py-4">

                                <p class="text-sm font-medium text-gray-900">
                                    {{ $job->customer->name ?? 'Unknown Customer' }}
                                </p>

                            </td>


                            <td class="px-6 py-4">

                                <p class="text-sm font-medium text-gray-900">

                                    {{ $job->brand ?? '' }}

                                    {{ $job->model ?? '' }}

                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $job->device_type }}
                                </p>

                            </td>


                            <td class="px-6 py-4">

                                @php
                                    $repairStatusClasses = [
                                        'pending' => 'bg-gray-100 text-gray-700',
                                        'diagnosing' => 'bg-purple-100 text-purple-700',
                                        'waiting_for_parts' => 'bg-orange-100 text-orange-700',
                                        'repairing' => 'bg-blue-100 text-blue-700',
                                        'ready_for_pickup' => 'bg-green-100 text-green-700',
                                        'released' => 'bg-slate-100 text-slate-700',
                                        'on_hold' => 'bg-yellow-100 text-yellow-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp

                                <span
                                    class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $repairStatusClasses[$job->status] ?? 'bg-gray-100 text-gray-700' }}"
                                >
                                    {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                </span>

                            </td>


                            <td class="px-6 py-4 text-right">

                                <p class="text-sm font-semibold text-gray-900">
                                    ₱{{ number_format($job->final_cost, 2) }}
                                </p>

                                @if($job->balance > 0)

                                    <p class="text-xs text-red-500 mt-1">
                                        ₱{{ number_format($job->balance, 2) }} balance
                                    </p>

                                @else

                                    <p class="text-xs text-green-600 mt-1">
                                        Paid
                                    </p>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-12 text-center text-sm text-gray-500"
                            >
                                No repair jobs have been created yet.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
    
</div>

@endsection