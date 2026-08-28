@extends('layouts.app')


@section('title', 'Dashboard')

@section('page-heading', 'Dashboard')


@section('content')


    {{-- PAGE HEADER --}}

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Dashboard
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Overview of your repair business.
            </p>

        </div>


        <a
            href="{{ route('customers.create') }}"
            class="
                inline-flex
                items-center
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
            + Add Customer
        </a>

    </div>


    {{-- STAT CARDS --}}

    <div
        class="
            grid
            grid-cols-1
            sm:grid-cols-2
            lg:grid-cols-4
            gap-5
            mt-8
        "
    >


        {{-- Today's Appointments --}}

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Today's Appointments
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $todayAppointments->count() }}
                    </p>

                </div>


                <div
                    class="
                        w-10
                        h-10
                        rounded-lg
                        bg-blue-50
                        text-blue-600
                        flex
                        items-center
                        justify-center
                    "
                >

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

        </div>


        {{-- Active Repairs --}}

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Active Repairs
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $pendingRepairs }}
                    </p>

                </div>


                <div
                    class="
                        w-10
                        h-10
                        rounded-lg
                        bg-orange-50
                        text-orange-600
                        flex
                        items-center
                        justify-center
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
                            stroke-width="1.8"
                            d="M14.7 6.3a4 4 0 01-5 5L4 17l3 3 5.7-5.7a4 4 0 015-5z"
                        />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Ready --}}

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Ready for Release
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $readyRepairs }}
                    </p>

                </div>


                <div
                    class="
                        w-10
                        h-10
                        rounded-lg
                        bg-green-50
                        text-green-600
                        flex
                        items-center
                        justify-center
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
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                </div>

            </div>

        </div>


        {{-- Low Stock --}}

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Low Stock
                    </p>

                    <p class="text-3xl font-bold mt-2">
                        {{ $lowStockParts }}
                    </p>

                </div>


                <div
                    class="
                        w-10
                        h-10
                        rounded-lg
                        bg-red-50
                        text-red-600
                        flex
                        items-center
                        justify-center
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
                            stroke-width="1.8"
                            d="M12 9v4M12 17h.01M10.3 3.7L2.9 17a2 2 0 001.7 3h14.8a2 2 0 001.7-3L13.7 3.7a2 2 0 00-3.4 0z"
                        />

                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- TODAY'S APPOINTMENTS --}}

    <div class="bg-white border border-gray-200 rounded-xl mt-8 overflow-hidden">

        <div
            class="
                px-6
                py-5
                border-b
                border-gray-200
                flex
                items-center
                justify-between
            "
        >

            <div>

                <h2 class="font-semibold text-gray-900">
                    Today's Appointments
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Scheduled repairs for today.
                </p>

            </div>


            <a
                href="#"
                class="text-sm text-blue-600 hover:text-blue-700"
            >
                View all
            </a>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th
                            class="
                                text-left
                                px-6
                                py-3
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Customer
                        </th>

                        <th
                            class="
                                text-left
                                px-6
                                py-3
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Device
                        </th>

                        <th
                            class="
                                text-left
                                px-6
                                py-3
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Service
                        </th>

                        <th
                            class="
                                text-left
                                px-6
                                py-3
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($todayAppointments as $appointment)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <p class="font-medium text-gray-900">
                                    {{ $appointment->customer->name }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $appointment->customer->contact_number }}
                                </p>

                            </td>


                            <td class="px-6 py-4">

                                <p class="text-sm font-medium">

                                    {{ $appointment->brand }}

                                    {{ $appointment->model }}

                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $appointment->device_type }}
                                </p>

                            </td>


                            {{-- Service --}}

                            <td class="px-6 py-4 text-sm">

                            @forelse(($appointment->services ?? collect()) as $service)

                                {{ $service->name }}

                                @if (!$loop->last)
                                    ,
                                @endif

                            @empty

                                <span class="text-gray-400">
                                    No service
                                </span>

                            @endforelse

                            </td>



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

                                No appointments scheduled for today.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- INVENTORY ALERT --}}

    <div
        class="
            bg-white
            border
            border-gray-200
            rounded-xl
            mt-6
            p-6
        "
    >

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold">
                    Inventory Overview
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Keep track of parts that need attention.
                </p>

            </div>

        </div>


        <div
            class="
                grid
                grid-cols-1
                sm:grid-cols-2
                gap-4
                mt-5
            "
        >

            <div
                class="
                    border
                    border-orange-200
                    bg-orange-50
                    rounded-lg
                    p-4
                "
            >

                <p class="text-sm text-orange-700">
                    Low Stock Parts
                </p>

                <p class="text-2xl font-bold text-orange-900 mt-1">
                    {{ $lowStockParts }}
                </p>

            </div>


            <div
                class="
                    border
                    border-red-200
                    bg-red-50
                    rounded-lg
                    p-4
                "
            >

                <p class="text-sm text-red-700">
                    Out of Stock
                </p>

                <p class="text-2xl font-bold text-red-900 mt-1">
                    {{ $outOfStockParts }}
                </p>

            </div>

        </div>

    </div>


@endsection