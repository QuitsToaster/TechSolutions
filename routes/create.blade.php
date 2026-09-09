@extends('layouts.app')


@section('title', 'Add Customer')

@section('page-heading', 'Add Customer')


@section('content')


    <div class="space-y-6">

        {{-- HEADER --}}

        <div class="mb-6">

            <a
                href="{{ route('customers.index') }}"
                class="text-sm text-gray-500 hover:text-gray-900"
            >
                ← Back to Customers
            </a>


            <h1 class="text-2xl font-bold text-gray-900 mt-3">
                Add Customer
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Create a new customer record.
            </p>

        </div>


        {{-- ERRORS --}}

        @if($errors->any())

            <div
                class="
                    bg-red-50
                    border
                    border-red-200
                    text-red-700
                    rounded-lg
                    p-4
                    mb-6
                "
            >

                <ul class="list-disc pl-5 text-sm">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORM --}}

        <form
            method="POST"
            action="{{ route('customers.store') }}"
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                p-6
            "
        >

            @csrf


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- NAME --}}

                <div class="md:col-span-2">

                    <label
                        class="
                            block
                            text-sm
                            font-medium
                            text-gray-700
                            mb-2
                        "
                    >
                        Full Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
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
                        "
                    >

                </div>


                {{-- CONTACT --}}

                <div>

                    <label
                        class="
                            block
                            text-sm
                            font-medium
                            text-gray-700
                            mb-2
                        "
                    >
                        Contact Number
                    </label>

                    <input
                        type="text"
                        name="contact_number"
                        value="{{ old('contact_number') }}"
                        placeholder="09XXXXXXXXX"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                        "
                    >

                </div>


                {{-- EMAIL --}}

                <div>

                    <label
                        class="
                            block
                            text-sm
                            font-medium
                            text-gray-700
                            mb-2
                        "
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                        "
                    >

                </div>


                {{-- ADDRESS --}}

                <div class="md:col-span-2">

                    <label
                        class="
                            block
                            text-sm
                            font-medium
                            text-gray-700
                            mb-2
                        "
                    >
                        Complete Address
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
                        "
                    >{{ old('address') }}</textarea>

                </div>


                {{-- FACEBOOK --}}

                <div class="md:col-span-2">

                    <label
                        class="
                            block
                            text-sm
                            font-medium
                            text-gray-700
                            mb-2
                        "
                    >
                        Facebook Account
                    </label>

                    <input
                        type="text"
                        name="facebook"
                        value="{{ old('facebook') }}"
                        placeholder="Facebook name or profile"
                        class="
                            w-full
                            border
                            border-gray-300
                            rounded-lg
                            px-4
                            py-2.5
                            text-sm
                        "
                    >

                </div>

            </div>


            {{-- ACTIONS --}}

            <div
                class="
                    flex
                    justify-end
                    gap-3
                    mt-8
                    pt-6
                    border-t
                "
            >

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
                    "
                >
                    Cancel
                </a>


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
                    Save Customer
                </button>

            </div>

        </form>

    </div>


@endsection