@extends('layouts.app')

@section('title', 'Edit Price')

@section('page-heading', 'Edit Price')

@section('content')

<div class="space-y-6">

    <!-- Header -->

    <div>

        <div class="flex items-center gap-3">

            <a
                href="{{ route('price-lists.index') }}"
                class="text-sm text-gray-500 hover:text-gray-900"
            >
                Price List
            </a>

            <span class="text-gray-300">
                /
            </span>

            <span class="text-sm text-gray-900">
                Edit Price
            </span>

        </div>


        <h1 class="mt-3 text-2xl font-bold text-gray-900">
            Edit Price
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Update the reference price for this repair.
        </p>

    </div>


    <form
        method="POST"
        action="{{ route('price-lists.update', $priceList) }}"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        <!-- Device Information -->

        <div class="bg-white border rounded-xl overflow-hidden">

            <div class="border-b px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Device Information
                </h2>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">


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
                        value="{{ old('device_type', $priceList->device_type) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                    @error('device_type')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


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
                        value="{{ old('brand', $priceList->brand) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                    @error('brand')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


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
                        value="{{ old('model', $priceList->model) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                    @error('model')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Repair Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        id="category"
                        value="{{ old('category', $priceList->category) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                    @error('category')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="item"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Repair Item
                    </label>

                    <input
                        type="text"
                        name="item"
                        id="item"
                        value="{{ old('item', $priceList->item) }}"
                        required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                    @error('item')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label
                        for="quality"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Quality
                    </label>

                    <input
                        type="text"
                        name="quality"
                        id="quality"
                        value="{{ old('quality', $priceList->quality) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                    >

                    @error('quality')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        <!-- Pricing -->

        <div class="bg-white border rounded-xl overflow-hidden">

            <div class="border-b px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Pricing
                </h2>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">


                <div>

                    <label
                        for="part_price"
                        class="block text-sm font-medium text-gray-700 mb-2"
                    >
                        Part Price
                    </label>

                    <div class="relative">

                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            ₱
                        </span>

                        <input
                            type="number"
                            name="part_price"
                            id="part_price"
                            value="{{ old('part_price', $priceList->part_price) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-lg border border-gray-300 pl-8 pr-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                        >

                    </div>

                    @error('part_price')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


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
                            value="{{ old('labor_cost', $priceList->labor_cost) }}"
                            min="0"
                            step="0.01"
                            required
                            class="w-full rounded-lg border border-gray-300 pl-8 pr-3 py-2.5 text-sm focus:border-slate-500 focus:ring-slate-500"
                        >

                    </div>

                    @error('labor_cost')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="md:col-span-2">

                    <div class="rounded-lg bg-slate-50 border border-slate-200 p-4">

                        <div class="flex justify-between">

                            <span class="text-sm text-gray-500">
                                Reference Total
                            </span>

                            <span
                                id="total-preview"
                                class="text-xl font-bold text-gray-900"
                            >
                                ₱{{ number_format($priceList->total_price, 2) }}
                            </span>

                        </div>

                        <p class="mt-1 text-xs text-gray-400">
                            Part price + labor cost
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- Notes -->

        <div class="bg-white border rounded-xl overflow-hidden">

            <div class="border-b px-6 py-4">

                <h2 class="font-semibold text-gray-900">
                    Notes
                </h2>

            </div>


            <div class="p-6">

                <textarea
                    name="notes"
                    id="notes"
                    rows="4"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm resize-y focus:border-slate-500 focus:ring-slate-500"
                >{{ old('notes', $priceList->notes) }}</textarea>

                @error('notes')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        <!-- Active -->

        <div class="bg-white border rounded-xl p-6">

            <label class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', $priceList->is_active))
                    class="rounded border-gray-300 text-slate-900 focus:ring-slate-500"
                >

                <span>

                    <span class="block text-sm font-medium text-gray-900">
                        Active Price
                    </span>

                    <span class="block text-xs text-gray-500 mt-1">
                        Active prices appear in the price reference list.
                    </span>

                </span>

            </label>

        </div>


        <!-- Actions -->

        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

            <a
                href="{{ route('price-lists.index') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-white border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold"
            >
                Save Changes
            </button>

        </div>

    </form>

</div>


<script>

    const partPrice = document.getElementById('part_price');
    const laborCost = document.getElementById('labor_cost');
    const totalPreview = document.getElementById('total-preview');

    function updateTotal() {

        const part = parseFloat(partPrice.value) || 0;
        const labor = parseFloat(laborCost.value) || 0;

        const total = part + labor;

        totalPreview.textContent =
            '₱' + total.toLocaleString('en-PH', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
    }

    partPrice.addEventListener('input', updateTotal);
    laborCost.addEventListener('input', updateTotal);

    updateTotal();

</script>

@endsection