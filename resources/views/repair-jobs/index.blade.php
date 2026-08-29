@extends('layouts.app')

@section('title', 'Repair Jobs')

@section('page-heading', 'Repair Jobs')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Repair Jobs
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage and track all active and completed repair jobs.
            </p>
        </div>
    </div>


    <!-- Repair Jobs Table -->
    <div class="bg-white border rounded-xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Job Number
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Device
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-gray-700">
                            Priority
                        </th>

                        <th class="px-6 py-4 text-right font-semibold text-gray-700">
                            Cost
                        </th>

                        <th class="px-6 py-4 text-right font-semibold text-gray-700">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($repairJobs as $repairJob)

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

                            $priorityColors = [
                                'low' => 'bg-gray-100 text-gray-700',
                                'normal' => 'bg-blue-100 text-blue-700',
                                'high' => 'bg-orange-100 text-orange-700',
                                'urgent' => 'bg-red-100 text-red-700',
                            ];

                        @endphp

                        <tr class="hover:bg-gray-50">

                            <!-- Job Number -->
                            <td class="px-6 py-4">

                                <a href="{{ route('repair-jobs.show', $repairJob) }}"
                                   class="font-semibold text-blue-600 hover:text-blue-800">

                                    {{ $repairJob->job_number }}

                                </a>

                            </td>


                            <!-- Customer -->
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $repairJob->customer->name ?? 'Unknown Customer' }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $repairJob->customer->contact_number ?? 'No contact number' }}
                                </div>

                            </td>


                            <!-- Device -->
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $repairJob->device_type }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $repairJob->brand }}
                                    {{ $repairJob->model }}
                                </div>

                            </td>


                            <!-- Status -->
                            <td class="px-6 py-4">

                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$repairJob->status] ?? 'bg-gray-100 text-gray-800' }}">

                                    {{ ucfirst(str_replace('_', ' ', $repairJob->status)) }}

                                </span>

                            </td>


                            <!-- Priority -->
                            <td class="px-6 py-4">

                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $priorityColors[$repairJob->priority] ?? 'bg-gray-100 text-gray-800' }}">

                                    {{ ucfirst($repairJob->priority) }}

                                </span>

                            </td>


                            <!-- Cost -->
                            <td class="px-6 py-4 text-right">

                                <p class="text-sm font-semibold text-gray-900">
                                    ₱{{ number_format($repairJob->final_cost ?? 0, 2) }}
                                </p>

                                @if($repairJob->balance > 0)

                                    <p class="text-xs text-red-500 mt-1">
                                        ₱{{ number_format($repairJob->balance ?? 0, 2) }} balance
                                    </p>

                                @else

                                    <p class="text-xs text-green-600 mt-1">
                                        Paid
                                    </p>

                                @endif

                            </td>


                            <!-- Action -->
                            <td class="px-6 py-4 text-right">

                                 {{-- View --}}
                                    <a
                                        href="{{ route('repair-jobs.show', $repairJob) }}"
                                        title="View Repair Job"
                                        class="inline-flex items-center justify-center
                                            w-9 h-9 rounded-lg
                                            border border-slate-200
                                            bg-white
                                            text-slate-600
                                            hover:bg-slate-50
                                            hover:text-blue-600
                                            transition"
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
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5
                                                c4.478 0 8.268 2.943 9.542 7
                                                -1.274 4.057-5.064 7-9.542 7
                                                -4.477 0-8.268-2.943-9.542-7z"
                                            />
                                        </svg>

                                    </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="px-6 py-12 text-center text-gray-500">

                                No repair jobs found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- Pagination -->

        @if($repairJobs->hasPages())

            <div class="px-6 py-4 border-t">

                {{ $repairJobs->links() }}

            </div>

        @endif

    </div>

</div>

@endsection