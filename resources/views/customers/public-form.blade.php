<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

<title>Customer Information | TechSolutions</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-gray-50 text-gray-900">

<div class="min-h-screen flex flex-col">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <header class="bg-white border-b border-gray-200">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-5">

            <div class="flex items-center gap-3">

                {{-- Logo / Icon --}}
                <div
                    class="flex items-center justify-center
                           w-11 h-11
                           rounded-xl
                           bg-gray-900
                           text-white
                           shadow-sm"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 4a2 2 0 114 0v1a2 2 0 11-4 0V4z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 8h14l1 12H4L5 8z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-lg font-bold text-gray-900">
                        TechSolutions
                    </h1>

                    <p class="text-xs text-gray-500">
                        Repair Service Management
                    </p>
                </div>

            </div>

        </div>

    </header>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <main class="flex-1 py-8 sm:py-12">

        <div class="max-w-2xl mx-auto px-4 sm:px-6">

            {{-- =================================================
                PAGE INTRODUCTION
            ================================================== --}}
            <div class="text-center mb-8">

                <div
                    class="inline-flex
                           items-center
                           gap-2
                           px-3
                           py-1.5
                           rounded-full
                           bg-gray-100
                           border border-gray-200
                           text-xs
                           font-medium
                           text-gray-600
                           mb-4"
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
                            d="M16 7a4 4 0 11-8 0
                               4 4 0 018 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                    </svg>

                    Customer Registration

                </div>


                <h2
                    class="text-2xl sm:text-3xl
                           font-bold
                           tracking-tight
                           text-gray-900"
                >
                    Customer Information
                </h2>


                <p
                    class="mt-3
                           text-sm sm:text-base
                           leading-6
                           text-gray-500
                           max-w-xl
                           mx-auto"
                >
                    Please provide your information below before
                    proceeding with your repair appointment.
                </p>

            </div>


            {{-- =================================================
                SUCCESS MESSAGE
            ================================================== --}}
            @if(session('success'))

                <div
                    class="mb-6
                           bg-green-50
                           border border-green-200
                           rounded-xl
                           p-4"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex-shrink-0
                                   flex items-center justify-center
                                   w-9 h-9
                                   rounded-full
                                   bg-green-100"
                        >

                            <svg
                                class="w-5 h-5 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>


                        <div>

                            <p
                                class="text-sm
                                       font-semibold
                                       text-green-800"
                            >
                                Information Submitted Successfully
                            </p>

                            <p
                                class="mt-1
                                       text-xs
                                       leading-5
                                       text-green-700"
                            >
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                VALIDATION ERRORS
            ================================================== --}}
            @if($errors->any())

                <div
                    class="mb-6
                           bg-red-50
                           border border-red-200
                           rounded-xl
                           p-4"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex-shrink-0
                                   flex items-center justify-center
                                   w-9 h-9
                                   rounded-full
                                   bg-red-100"
                        >

                            <svg
                                class="w-5 h-5 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4m0 4h.01
                                       M21 12a9 9 0 11-18 0
                                       9 9 0 0118 0z"
                                />
                            </svg>

                        </div>


                        <div>

                            <p
                                class="text-sm
                                       font-semibold
                                       text-red-800"
                            >
                                Please check the following:
                            </p>

                            <ul
                                class="mt-2
                                       list-disc
                                       list-inside
                                       text-sm
                                       text-red-700
                                       space-y-1"
                            >

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                FORM CARD
            ================================================== --}}
            <div
                class="bg-white
                       border border-gray-200
                       rounded-2xl
                       shadow-sm
                       overflow-hidden"
            >

                {{-- Card Header --}}
                <div
                    class="px-6 sm:px-8
                           py-6
                           border-b border-gray-200
                           bg-gray-50/70"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex-shrink-0
                                   flex items-center justify-center
                                   w-10 h-10
                                   rounded-lg
                                   bg-white
                                   border border-gray-200"
                        >

                            <svg
                                class="w-5 h-5 text-gray-700"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7
                                       a2 2 0 01-2-2V5
                                       a2 2 0 012-2h5.586
                                       a1 1 0 01.707.293l4.414 4.414
                                       A1 1 0 0118 8.414V19
                                       a2 2 0 01-2 2z"
                                />
                            </svg>

                        </div>


                        <div>

                            <h3
                                class="text-base
                                       font-semibold
                                       text-gray-900"
                            >
                                Your Information
                            </h3>

                            <p
                                class="mt-1
                                       text-sm
                                       text-gray-500"
                            >
                                Enter your contact details accurately
                                so we can reach you regarding your repair.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Form --}}
                <form
                    action="{{ route('customers.public.store') }}"
                    method="POST"
                    class="p-6 sm:p-8 space-y-6"
                >

                    @csrf


                    {{-- =========================================
                        PERSONAL INFORMATION
                    ========================================== --}}
                    <div>

                        <div class="mb-5">

                            <h4
                                class="text-sm
                                       font-semibold
                                       text-gray-900"
                            >
                                Personal Information
                            </h4>

                            <p
                                class="mt-1
                                       text-xs
                                       text-gray-500"
                            >
                                Please provide your complete name.
                            </p>

                        </div>


                        {{-- Full Name --}}
                        <div>

                            <label
                                for="name"
                                class="block
                                       text-sm
                                       font-medium
                                       text-gray-700
                                       mb-2"
                            >
                                Full Name
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Juan Dela Cruz"
                                required
                                autocomplete="name"
                                autofocus
                                class="w-full
                                       rounded-lg
                                       border-gray-300
                                       px-4
                                       py-3
                                       text-sm
                                       shadow-sm
                                       placeholder:text-gray-400
                                       focus:border-gray-900
                                       focus:ring-2
                                       focus:ring-gray-900
                                       focus:ring-offset-0"
                            >

                            @error('name')

                                <p
                                    class="mt-1.5
                                           text-xs
                                           text-red-600"
                                >
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- =========================================
                        CONTACT INFORMATION
                    ========================================== --}}
                    <div
                        class="pt-6
                               border-t border-gray-100"
                    >

                        <div class="mb-5">

                            <h4
                                class="text-sm
                                       font-semibold
                                       text-gray-900"
                            >
                                Contact Information
                            </h4>

                            <p
                                class="mt-1
                                       text-xs
                                       text-gray-500"
                            >
                                We'll use these details to contact you
                                about your repair.
                            </p>

                        </div>


                        <div class="grid gap-5 md:grid-cols-2">

                            {{-- Contact Number --}}
                            <div>

                                <label
                                    for="contact_number"
                                    class="block
                                           text-sm
                                           font-medium
                                           text-gray-700
                                           mb-2"
                                >
                                    Contact Number
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="tel"
                                    id="contact_number"
                                    name="contact_number"
                                    value="{{ old('contact_number') }}"
                                    placeholder="0912 345 6789"
                                    required
                                    autocomplete="tel"
                                    inputmode="tel"
                                    class="w-full
                                           rounded-lg
                                           border-gray-300
                                           px-4
                                           py-3
                                           text-sm
                                           shadow-sm
                                           placeholder:text-gray-400
                                           focus:border-gray-900
                                           focus:ring-2
                                           focus:ring-gray-900"
                                >

                                @error('contact_number')

                                    <p
                                        class="mt-1.5
                                               text-xs
                                               text-red-600"
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- Email --}}
                            <div>

                                <label
                                    for="email"
                                    class="block
                                           text-sm
                                           font-medium
                                           text-gray-700
                                           mb-2"
                                >
                                    Email Address

                                    <span
                                        class="text-gray-400
                                               font-normal"
                                    >
                                        (Optional)
                                    </span>

                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="juan@example.com"
                                    autocomplete="email"
                                    class="w-full
                                           rounded-lg
                                           border-gray-300
                                           px-4
                                           py-3
                                           text-sm
                                           shadow-sm
                                           placeholder:text-gray-400
                                           focus:border-gray-900
                                           focus:ring-2
                                           focus:ring-gray-900"
                                >

                                @error('email')

                                    <p
                                        class="mt-1.5
                                               text-xs
                                               text-red-600"
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =========================================
                        ADDRESS
                    ========================================== --}}
                    <div
                        class="pt-6
                               border-t border-gray-100"
                    >

                        <div class="mb-5">

                            <h4
                                class="text-sm
                                       font-semibold
                                       text-gray-900"
                            >
                                Address Information
                            </h4>

                            <p
                                class="mt-1
                                       text-xs
                                       text-gray-500"
                            >
                                Provide your complete address.
                            </p>

                        </div>


                        <div>

                            <label
                                for="address"
                                class="block
                                       text-sm
                                       font-medium
                                       text-gray-700
                                       mb-2"
                            >
                                Complete Address
                                <span class="text-red-500">*</span>
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="House/Unit No., Street, Barangay, City/Municipality, Province"
                                required
                                autocomplete="street-address"
                                class="w-full
                                       rounded-lg
                                       border-gray-300
                                       px-4
                                       py-3
                                       text-sm
                                       shadow-sm
                                       placeholder:text-gray-400
                                       focus:border-gray-900
                                       focus:ring-2
                                       focus:ring-gray-900"
                            >{{ old('address') }}</textarea>

                            @error('address')

                                <p
                                    class="mt-1.5
                                           text-xs
                                           text-red-600"
                                >
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- =========================================
                        FACEBOOK
                    ========================================== --}}
                    <div
                        class="pt-6
                               border-t border-gray-100"
                    >

                        <label
                            for="facebook"
                            class="block
                                   text-sm
                                   font-medium
                                   text-gray-700
                                   mb-2"
                        >
                            Facebook Account

                            <span
                                class="text-gray-400
                                       font-normal"
                            >
                                (Optional)
                            </span>

                        </label>

                        <input
                            type="text"
                            id="facebook"
                            name="facebook"
                            value="{{ old('facebook') }}"
                            placeholder="Facebook name or profile link"
                            autocomplete="off"
                            class="w-full
                                   rounded-lg
                                   border-gray-300
                                   px-4
                                   py-3
                                   text-sm
                                   shadow-sm
                                   placeholder:text-gray-400
                                   focus:border-gray-900
                                   focus:ring-2
                                   focus:ring-gray-900"
                        >

                        <p
                            class="mt-1.5
                                   text-xs
                                   text-gray-400"
                        >
                            This may help us contact you through Facebook
                            if necessary.
                        </p>

                        @error('facebook')

                            <p
                                class="mt-1.5
                                       text-xs
                                       text-red-600"
                            >
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =========================================
                        INFORMATION NOTICE
                    ========================================== --}}
                    <div
                        class="pt-6
                               border-t border-gray-100"
                    >

                        <div
                            class="rounded-xl
                                   bg-gray-50
                                   border border-gray-200
                                   p-4"
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex-shrink-0
                                           flex items-center justify-center
                                           w-8 h-8
                                           rounded-lg
                                           bg-white
                                           border border-gray-200"
                                >

                                    <svg
                                        class="w-4 h-4 text-gray-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01
                                               M12 20a8 8 0 100-16
                                               8 8 0 000 16z"
                                        />
                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="text-sm
                                               font-medium
                                               text-gray-700"
                                    >
                                        Before submitting
                                    </p>

                                    <p
                                        class="mt-1
                                               text-xs
                                               leading-5
                                               text-gray-500"
                                    >
                                        Please review your information
                                        carefully. Your contact details
                                        will be used by our repair team
                                        to communicate with you regarding
                                        your repair service.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =========================================
                        SUBMIT BUTTON
                    ========================================== --}}
                    <div class="pt-2">

                        <button
                            type="submit"
                            class="w-full
                                   inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   px-5
                                   py-3.5
                                   rounded-lg
                                   bg-gray-900
                                   hover:bg-gray-800
                                   active:bg-gray-950
                                   text-white
                                   text-sm
                                   font-semibold
                                   shadow-sm
                                   transition
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-gray-900
                                   focus:ring-offset-2"
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
                                    d="M5 12h14
                                       M12 5l7 7-7 7"
                                />
                            </svg>

                            Submit Information

                        </button>

                    </div>

                </form>

            </div>


            {{-- =================================================
                FOOTER MESSAGE
            ================================================== --}}
            <div class="mt-8 text-center">

                <p class="text-xs text-gray-400">
                    Thank you for choosing our repair service.
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    Please wait for our team to contact you regarding
                    your repair appointment.
                </p>

            </div>

        </div>

    </main>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="border-t border-gray-200 bg-white">

        <div
            class="max-w-3xl mx-auto
                   px-4 sm:px-6
                   py-5
                   text-center"
        >

            <p class="text-xs text-gray-400">
                TechSolutions &copy; {{ date('Y') }}. All rights reserved.
            </p>

            <p class="mt-1 text-xs text-gray-400">
                Customer Information Portal
            </p>

        </div>

    </footer>

</div>

</body>
</html>
