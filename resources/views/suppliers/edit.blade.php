@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('page-heading', 'Edit Supplier')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-900">
            Edit Supplier
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Update supplier information.
        </p>

    </div>


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div
            class="
                rounded-lg
                border
                border-red-200
                bg-red-50
                px-4
                py-3
                text-sm
                text-red-700
                mb-6
            "
        >

            <ul class="list-inside list-disc">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('suppliers.update', $supplier) }}"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- SUPPLIER INFORMATION --}}
        <div
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                overflow-hidden
            "
        >

            <div class="px-6 py-4 border-b border-gray-200">

                <h2 class="font-semibold text-gray-900">
                    Supplier Information
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update the contact and business information for this supplier.
                </p>

            </div>


            <div class="grid gap-6 p-6 md:grid-cols-2">


                {{-- Supplier Name --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Supplier Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $supplier->name) }}"
                        required
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
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Contact Person --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Contact Person
                    </label>

                    <input
                        type="text"
                        name="contact_person"
                        value="{{ old('contact_person', $supplier->contact_person) }}"
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
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Phone --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $supplier->phone) }}"
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
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Email --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $supplier->email) }}"
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
                            focus:border-transparent
                        "
                    >

                </div>


                {{-- Address --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            resize-none
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >{{ old('address', $supplier->address) }}</textarea>

                </div>


                {{-- Notes --}}
                <div class="md:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-gray-700">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                            resize-none
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-900
                            focus:border-transparent
                        "
                    >{{ old('notes', $supplier->notes) }}</textarea>

                </div>


            </div>

        </div>


        {{-- ACTIONS --}}
        <div class="flex items-center justify-between">

            <a
                href="{{ route('suppliers.index') }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    px-5
                    py-2.5
                    rounded-lg
                    border
                    border-gray-300
                    hover:bg-gray-50
                    text-sm
                    font-medium
                    text-gray-700
                "
            >
                Cancel
            </a>


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
                Save Changes
            </button>

        </div>

    </form>

</div>

@endsection
