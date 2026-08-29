@extends('layouts.app')

@section('title', 'Suppliers')

@section('page-heading', 'Suppliers')

@section('content')


<div class="space-y-6">

    {{-- HEADER --}}
    <div
        class="
            flex
            flex-col
            gap-4
            sm:flex-row
            sm:items-center
            sm:justify-between
        "
    >

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Suppliers
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manage your parts suppliers and supplier information.
            </p>

        </div>


        <a
            href="{{ route('suppliers.create') }}"
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
            + Add Supplier
        </a>

    </div>


    {{-- SEARCH --}}
    <div
        class="
            bg-white
            border
            border-gray-200
            rounded-xl
            p-4
        "
    >

        <form
            method="GET"
            action="{{ route('suppliers.index') }}"
            class="
                flex
                flex-col
                gap-3
                sm:flex-row
            "
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search supplier name, contact person, phone, or email..."
                class="
                    flex-1
                    border
                    border-gray-300
                    rounded-lg
                    px-4
                    py-2.5
                    text-sm
                    focus:outline-none
                    focus:ring-2
                    focus:ring-slate-900
                    focus:border-transparent
                "
            >


            <button
                type="submit"
                class="
                    inline-flex
                    items-center
                    justify-center
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

        </form>

    </div>


    {{-- SUPPLIERS TABLE --}}
    <div
        class="
            bg-white
            border
            border-gray-200
            rounded-xl
            overflow-hidden
        "
    >

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th
                            class="
                                px-6
                                py-3
                                text-left
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Supplier
                        </th>


                        <th
                            class="
                                px-6
                                py-3
                                text-left
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
                                px-6
                                py-3
                                text-left
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Phone
                        </th>


                        <th
                            class="
                                px-6
                                py-3
                                text-left
                                text-xs
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Parts
                        </th>


                        <th
                            class="
                                px-6
                                py-3
                                text-right
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

                    @forelse ($suppliers as $supplier)

                        <tr class="hover:bg-gray-50">

                            {{-- SUPPLIER --}}
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $supplier->name }}
                                </div>

                                @if ($supplier->email)

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $supplier->email }}
                                    </div>

                                @endif

                            </td>


                            {{-- CONTACT --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $supplier->contact_person ?? '—' }}
                            </td>


                            {{-- PHONE --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $supplier->phone ?? '—' }}
                            </td>


                            {{-- PARTS --}}
                            <td class="px-6 py-4">

                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        rounded-full
                                        bg-gray-100
                                        px-3
                                        py-1
                                        text-xs
                                        font-medium
                                        text-gray-700
                                    "
                                >
                                    {{ $supplier->parts_count }}
                                </span>

                            </td>


                            {{-- ACTION --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end gap-2">

                                     {{-- View --}}
                                    <a
                                        href="{{ route('suppliers.show', $supplier) }}"
                                        title="View Supplier"
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
                                
                                {{-- Edit --}}
                                    <a
                                        href="{{ route('suppliers.edit', $supplier) }}"
                                        title="Edit Supplier"
                                        class="inline-flex items-center justify-center
                                            w-9 h-9 rounded-lg
                                            border border-slate-200
                                            bg-white
                                            text-slate-600
                                            hover:bg-slate-50
                                            hover:text-amber-600
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
                                                d="M11 5H6
                                                a2 2 0 00-2 2v11
                                                a2 2 0 002 2h11
                                                a2 2 0 002-2v-5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M18.5 2.5
                                                a2.121 2.121 0 013 3L12 15l-4 1
                                                1-4 9.5-9.5z"
                                            />
                                        </svg>

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
                                    No suppliers found.
                                </p>

                                <a
                                    href="{{ route('suppliers.create') }}"
                                    class="
                                        inline-block
                                        mt-3
                                        text-sm
                                        text-blue-600
                                        hover:underline
                                    "
                                >
                                    Add your first supplier
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($suppliers->hasPages())

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $suppliers->links() }}
            </div>

        @endif

    </div>

</div>


@endsection

