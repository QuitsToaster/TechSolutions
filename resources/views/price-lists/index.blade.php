@extends('layouts.app')

@section('title', 'Price List')

@section('page-heading', 'Price List')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header -->

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Price List
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Reference pricing for parts, services, and labor.
            </p>

        </div>


        <a
            href="{{ route('price-lists.create') }}"
            class="
                inline-flex
                items-center
                justify-center
                gap-2
                px-4
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
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Price

        </a>

    </div>


    <!-- Search & Filters -->

    <div class="bg-white border rounded-xl p-5">

        <form
            method="GET"
            action="{{ route('price-lists.index') }}"
            class="grid gap-4 md:grid-cols-4"
        >

            <!-- Search -->

            <div class="md:col-span-2">

                <label
                    for="search"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                    placeholder="Search device, brand, model, item..."
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

            </div>


            <!-- Device Type -->

            <div>

                <label
                    for="device_type"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Device
                </label>

                <select
                    name="device_type"
                    id="device_type"
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

                    <option value="">
                        All Devices
                    </option>

                    @foreach($deviceTypes as $deviceType)

                        <option
                            value="{{ $deviceType }}"
                            @selected(request('device_type') === $deviceType)
                        >
                            {{ $deviceType }}
                        </option>

                    @endforeach

                </select>

            </div>


            <!-- Brand -->

            <div>

                <label
                    for="brand"
                    class="block text-sm font-medium text-gray-700 mb-2"
                >
                    Brand
                </label>

                <select
                    name="brand"
                    id="brand"
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

                    <option value="">
                        All Brands
                    </option>

                    @foreach($brands as $brand)

                        <option
                            value="{{ $brand }}"
                            @selected(request('brand') === $brand)
                        >
                            {{ $brand }}
                        </option>

                    @endforeach

                </select>

            </div>


            <!-- Buttons -->

            <div class="md:col-span-4 flex flex-wrap gap-2">

                <button
                    type="submit"
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
                        transition
                    "
                >
                    Search
                </button>


                <a
                    href="{{ route('price-lists.index') }}"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        px-4
                        py-2.5
                        rounded-lg
                        bg-white
                        border
                        border-gray-300
                        text-gray-700
                        text-sm
                        font-medium
                        hover:bg-gray-50
                    "
                >
                    Clear
                </a>

            </div>

        </form>

    </div>


    <!-- Price List -->

    <div class="bg-white border rounded-xl overflow-hidden">

        <div class="border-b px-6 py-4">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                <div>

                    <h2 class="font-semibold text-gray-900">
                        Repair Pricing
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Use these prices as a reference when preparing repair estimates.
                    </p>

                </div>


                <div class="text-sm text-gray-500">

                    {{ $priceLists->total() }} price
                    {{ $priceLists->total() === 1 ? 'item' : 'items' }}

                </div>

            </div>

        </div>


        @if($priceLists->count())

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Device
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Model
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Repair
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Quality
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Part
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Labor
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Total
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($priceLists as $price)

                            <tr class="hover:bg-gray-50 transition">

                                <!-- Device -->

                                <td class="px-6 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $price->brand }}
                                    </div>

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $price->device_type }}
                                    </div>

                                </td>


                                <!-- Model -->

                                <td class="px-6 py-4">

                                    <span class="font-medium text-gray-900">
                                        {{ $price->model }}
                                    </span>

                                </td>


                                <!-- Repair -->

                                <td class="px-6 py-4">

                                    <div class="font-medium text-gray-900">
                                        {{ $price->item }}
                                    </div>

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $price->category }}
                                    </div>

                                </td>


                                <!-- Quality -->

                                <td class="px-6 py-4">

                                    @if($price->quality)

                                        <span class="
                                            inline-flex
                                            px-2.5
                                            py-1
                                            rounded-full
                                            bg-blue-100
                                            text-blue-800
                                            text-xs
                                            font-semibold
                                        ">
                                            {{ $price->quality }}
                                        </span>

                                    @else

                                        <span class="text-sm text-gray-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                <!-- Part -->

                                <td class="px-6 py-4 text-right">

                                    <span class="font-medium text-gray-900">
                                        ₱{{ number_format($price->part_price, 2) }}
                                    </span>

                                </td>


                                <!-- Labor -->

                                <td class="px-6 py-4 text-right">

                                    <span class="font-medium text-gray-900">
                                        ₱{{ number_format($price->labor_cost, 2) }}
                                    </span>

                                </td>


                                <!-- Total -->

                                <td class="px-6 py-4 text-right">

                                    <span class="font-bold text-gray-900">
                                        ₱{{ number_format($price->total_price, 2) }}
                                    </span>

                                </td>


                                <!-- Actions -->

                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        <a
                                            href="{{ route('price-lists.edit', $price) }}"
                                            class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                px-3
                                                py-2
                                                rounded-lg
                                                bg-white
                                                border
                                                border-gray-300
                                                text-gray-700
                                                text-xs
                                                font-medium
                                                hover:bg-gray-50
                                            "
                                        >
                                            Edit
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('price-lists.destroy', $price) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this price list item?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    px-3
                                                    py-2
                                                    rounded-lg
                                                    bg-red-50
                                                    border
                                                    border-red-200
                                                    text-red-700
                                                    text-xs
                                                    font-medium
                                                    hover:bg-red-100
                                                "
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <!-- Pagination -->

            @if($priceLists->hasPages())

                <div class="border-t px-6 py-4">

                    {{ $priceLists->links() }}

                </div>

            @endif


        @else

            <div class="px-6 py-12 text-center">

                <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"
                        />
                    </svg>

                </div>


                <h3 class="mt-4 text-sm font-semibold text-gray-900">
                    No price list items found
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Add your first repair price to get started.
                </p>


                <div class="mt-5">

                    <a
                        href="{{ route('price-lists.create') }}"
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
                        Add Price
                    </a>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection