@extends('layouts.app')


@section('title', 'Customers')

@section('page-heading', 'Customers')


@section('content')


    {{-- HEADER --}}

    <div
        class="
            flex
            flex-col
            sm:flex-row
            sm:items-center
            sm:justify-between
            gap-4
        "
    >

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Customers
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manage customer information and repair history.
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


    {{-- SEARCH --}}

    <div
        class="
            bg-white
            border
            border-gray-200
            rounded-xl
            p-5
            mt-6
        "
    >

        <form
            method="GET"
            action="{{ route('customers.index') }}"
            class="flex flex-col sm:flex-row gap-3"
        >

            <div class="relative flex-1">

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search customer name, phone, or email..."
                    class="
                        w-full
                        border
                        border-gray-300
                        rounded-lg
                        px-4
                        py-2.5
                        text-sm
                        focus:outline-none
                        focus:ring-2
                        focus:ring-slate-900
                    "
                >

            </div>


            <button
                type="submit"
                class="
                    px-5
                    py-2.5
                    rounded-lg
                    bg-slate-900
                    hover:bg-slate-800
                    text-white
                    text-sm
                    font-medium
                "
            >
                Search
            </button>


            @if($search)

                <a
                    href="{{ route('customers.index') }}"
                    class="
                        px-5
                        py-2.5
                        rounded-lg
                        border
                        border-gray-300
                        hover:bg-gray-50
                        text-sm
                        text-center
                    "
                >
                    Clear
                </a>

            @endif

        </form>

    </div>


    {{-- CUSTOMER TABLE --}}

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
                            Contact
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
                            Address
                        </th>

                        <th
                            class="
                                text-center
                                px-6
                                py-3
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Repairs
                        </th>

                        <th
                            class="
                                text-right
                                px-6
                                py-3
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse($customers as $customer)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <p class="font-medium text-gray-900">
                                    {{ $customer->name }}
                                </p>

                                @if($customer->email)

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $customer->email }}
                                    </p>

                                @endif

                            </td>


                            <td class="px-6 py-4 text-sm">
                                {{ $customer->contact_number ?? '—' }}
                            </td>


                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $customer->address ?? '—' }}
                            </td>


                            <td class="px-6 py-4 text-center">

                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        justify-center
                                        min-w-8
                                        h-8
                                        px-2
                                        rounded-full
                                        bg-slate-100
                                        text-slate-700
                                        font-semibold
                                        text-sm
                                    "
                                >
                                    {{ $customer->appointments_count }}
                                </span>

                            </td>


                            <td class="px-6 py-4">

                                <div
                                    class="
                                        flex
                                        justify-end
                                        items-center
                                        gap-2
                                    "
                                >

                                    <a
                                        href="{{ route(
                                            'customers.show',
                                            $customer
                                        ) }}"
                                        class="
                                            px-3
                                            py-2
                                            text-sm
                                            rounded-lg
                                            bg-gray-100
                                            hover:bg-gray-200
                                        "
                                    >
                                        View
                                    </a>


                                    <a
                                        href="{{ route(
                                            'customers.edit',
                                            $customer
                                        ) }}"
                                        class="
                                            px-3
                                            py-2
                                            text-sm
                                            rounded-lg
                                            bg-blue-50
                                            hover:bg-blue-100
                                            text-blue-700
                                        "
                                    >
                                        Edit
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="
                                    px-6
                                    py-16
                                    text-center
                                "
                            >

                                <p class="text-gray-500">
                                    No customers found.
                                </p>


                                <a
                                    href="{{ route(
                                        'customers.create'
                                    ) }}"
                                    class="
                                        inline-block
                                        mt-3
                                        text-sm
                                        text-blue-600
                                        hover:underline
                                    "
                                >
                                    Add your first customer
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if($customers->hasPages())

            <div class="px-6 py-4 border-t">

                {{ $customers->links() }}

            </div>

        @endif

    </div>


@endsection