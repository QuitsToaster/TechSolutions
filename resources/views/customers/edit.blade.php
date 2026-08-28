@extends('layouts.app')


@section('title', 'Edit Customer')

@section('page-heading', 'Edit Customer')


@section('content')


    <div class="space-y-6">

        {{-- HEADER --}}

        <div class="mb-6">

            <a
                href="{{ route('customers.show', $customer) }}"
                class="text-sm text-gray-500 hover:text-gray-900"
            >
                ← Back to Customer
            </a>


            <h1 class="text-2xl font-bold mt-3">
                Edit Customer
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Update customer information.
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
            action="{{ route('customers.update', $customer) }}"
            class="
                bg-white
                border
                border-gray-200
                rounded-xl
                p-6
            "
        >

            @csrf

            @method('PUT')


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Full Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $customer->name) }}"
                        required
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


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Contact Number
                    </label>

                    <input
                        type="text"
                        name="contact_number"
                        value="{{ old(
                            'contact_number',
                            $customer->contact_number
                        ) }}"
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


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old(
                            'email',
                            $customer->email
                        ) }}"
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


                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
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
                    >{{ old(
                        'address',
                        $customer->address
                    ) }}</textarea>

                </div>


                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Facebook Account
                    </label>

                    <input
                        type="text"
                        name="facebook"
                        value="{{ old(
                            'facebook',
                            $customer->facebook
                        ) }}"
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
                    href="{{ route('customers.show', $customer) }}"
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
                    Save Changes
                </button>

            </div>

        </form>


        {{-- DELETE CUSTOMER --}}

        <div
            class="
                bg-white
                border
                border-red-200
                rounded-xl
                p-6
                mt-6
            "
        >

            <h2 class="font-semibold text-red-700">
                Delete Customer
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Deleting a customer permanently removes their record.
            </p>


            <form
                method="POST"
                action="{{ route(
                    'customers.destroy',
                    $customer
                ) }}"
                class="mt-4"
                onsubmit="return confirm(
                    'Are you sure you want to delete this customer?'
                )"
            >

                @csrf

                @method('DELETE')


                <button
                    type="submit"
                    class="
                        px-4
                        py-2
                        rounded-lg
                        bg-red-600
                        hover:bg-red-700
                        text-white
                        text-sm
                    "
                >
                    Delete Customer
                </button>

            </form>

        </div>

    </div>


@endsection