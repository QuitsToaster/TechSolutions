@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Appointments</h1>
            <p class="text-gray-500 text-sm">Manage customer repair appointments.</p>
        </div>
        <a href="{{ route('appointments.create') }}" 
           class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition text-sm font-medium text-center whitespace-nowrap">
            + New Appointment
        </a>
    </div>

    <!-- Search / Filter -->
    <div class="bg-white border rounded-xl p-4">
        <form method="GET" action="{{ route('appointments.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Search customer, device or service..." 
                   class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none">
            
            <select name="status" class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none">
                <option value="">All Status</option>
                @foreach(['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-gray-900 text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-gray-800 transition">
                Search
            </button>
        </form>
    </div>

    <!-- Appointment Table -->
    <div class="bg-white border rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Customer</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Appointment</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Device</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Service</th>
                        <th class="text-left px-6 py-3 font-semibold text-gray-600">Status</th>
                        <th class="text-right px-6 py-3 font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $appointment->customer->name }}</div>
                                <div class="text-gray-500 text-xs">{{ $appointment->customer->contact_number }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div>{{ $appointment->appointment_date->format('M d, Y') }}</div>
                                @if($appointment->appointment_time)
                                    <div class="text-gray-500 text-xs">{{ date('h:i A', strtotime($appointment->appointment_time)) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium">{{ $appointment->device_model }}</div>
                                <div class="text-gray-500 text-xs">{{ $appointment->device_type }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $appointment->service }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'confirmed' => 'bg-blue-100 text-blue-700',
                                        'in_progress' => 'bg-purple-100 text-purple-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$appointment->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="{{ route('appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-800 transition">View</a>
                                <a href="{{ route('appointments.edit', $appointment) }}" class="text-gray-600 hover:text-gray-800 transition">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <p class="text-lg mb-1">No appointments found</p>
                                <p class="text-sm">Create your first appointment to get started.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($appointments->hasPages())
            <div class="p-4 border-t">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection