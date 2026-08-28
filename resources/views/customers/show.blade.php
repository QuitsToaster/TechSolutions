@extends('layouts.app')

@section('title', $customer->name)

@section('page-heading', 'Customer Details')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <a
                href="{{ route('customers.index') }}"
                class="text-sm text-gray-500 hover:text-gray-900"
            >
                ← Back to Customers
            </a>

            <h1 class="text-2xl font-bold mt-3">
                {{ $customer->name }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Customer profile and repair history.
            </p>

        </div>

        <a
            href="{{ route('customers.edit', $customer) }}"
            class="
                inline-flex
                justify-center
                px-4
                py-2.5
                rounded-lg
                bg-slate-900
                hover:bg-slate-800
                text-white
                text-sm
                font-medium
            "
        >
            Edit Customer
        </a>

    </div>


    {{-- CUSTOMER INFORMATION --}}

    <div
        class="
            bg-white
            border
            border-gray-200
            rounded-xl
            p-6
        "
    >

        <h2 class="font-semibold text-gray-900">
            Customer Information
        </h2>

        <div
            class="
                grid
                grid-cols-1
                sm:grid-cols-2
                gap-6
                mt-6
            "
        >

            {{-- Contact Number --}}

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Contact Number
                </p>

                <p class="text-sm font-medium mt-1">
                    {{ $customer->contact_number ?? '—' }}
                </p>

            </div>


            {{-- Email --}}

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Email
                </p>

                <p class="text-sm font-medium mt-1">
                    {{ $customer->email ?? '—' }}
                </p>

            </div>


            {{-- Address --}}

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Address
                </p>

                <p class="text-sm font-medium mt-1">
                    {{ $customer->address ?? '—' }}
                </p>

            </div>


            {{-- Facebook --}}

            <div>

                <p class="text-xs uppercase tracking-wide text-gray-400">
                    Facebook
                </p>

                <p class="text-sm font-medium mt-1">
                    {{ $customer->facebook ?? '—' }}
                </p>

            </div>

        </div>

    </div>


    {{-- REPAIR HISTORY --}}

    <div
        class="
            bg-white
            border
            border-gray-200
            rounded-xl
            mt-6
            overflow-hidden
        "
    >

        <div class="px-6 py-5 border-b">

            <h2 class="font-semibold">
                Repair History
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Previous and current repair records.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-3 text-xs uppercase tracking-wide text-gray-500">
                            Date
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

                    @forelse($customer->appointments as $appointment)

                        <tr>

                            {{-- DATE --}}

                            <td class="px-6 py-4 text-sm">

                                {{ $appointment->appointment_date?->format('M d, Y') }}

                            </td>


                            {{-- DEVICE --}}

                            <td class="px-6 py-4">

                                <p class="text-sm font-medium">

                                    {{ $appointment->device_model }}

                                </p>

                                <p class="text-xs text-gray-500">

                                    {{ $appointment->device_type }}

                                </p>

                            </td>


                            {{-- SERVICE --}}

                            <td class="px-6 py-4 text-sm">

                                {{ $appointment->service ?? '—' }}

                            </td>


                            {{-- STATUS --}}

                            <td class="px-6 py-4">

                                <span
                                    class="
                                        inline-flex
                                        px-2.5
                                        py-1
                                        rounded-full
                                        text-xs
                                        font-medium
                                        bg-gray-100
                                        text-gray-700
                                    "
                                >

                                    {{ ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $appointment->status
                                        )
                                    ) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="
                                    px-6
                                    py-12
                                    text-center
                                    text-gray-500
                                "
                            >

                                No repair history yet.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection