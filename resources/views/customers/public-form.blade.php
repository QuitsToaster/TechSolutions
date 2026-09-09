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
                    id="customerInformationForm"
                    action="{{ route('customers.public.store') }}"
                    method="POST"
                    class="p-6 sm:p-8 space-y-6"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="privacy_consent"
                        id="privacyConsentValue"
                        value=""
                    >


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
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            id="facebook"
                            name="facebook"
                            value="{{ old('facebook') }}"
                            placeholder="Facebook name or profile link"
                            required
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
                            id="submitInformationButton"
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

    </footer>

</div>


{{-- =========================================================
    DATA PRIVACY NOTICE MODAL
========================================================= --}}
<div
    id="privacyModal"
    class="fixed inset-0 z-50 hidden"
    aria-labelledby="privacyModalTitle"
    aria-modal="true"
    role="dialog"
>

    {{-- Backdrop --}}
    <div
        id="privacyModalBackdrop"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm"
    ></div>


    {{-- Modal Container --}}
    <div
        class="relative z-10 flex min-h-full items-center justify-center p-4 sm:p-6"
    >

        <div
            class="w-full max-w-2xl
                   rounded-2xl
                   bg-white
                   shadow-2xl
                   border border-gray-200
                   overflow-hidden"
        >

            {{-- Modal Header --}}
            <div
                class="px-6 sm:px-8
                       py-5
                       border-b border-gray-200
                       bg-gray-50"
            >

                <div class="flex items-start gap-4">

                    <div
                        class="flex-shrink-0
                               flex items-center justify-center
                               w-11 h-11
                               rounded-xl
                               bg-gray-900
                               text-white"
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
                                stroke-width="2"
                                d="M12 15v2m-6 4h12
                                   a2 2 0 002-2V9
                                   a8 8 0 10-16 0v10
                                   a2 2 0 002 2z"
                            />
                        </svg>

                    </div>


                    <div class="flex-1">

                        <h2
                            id="privacyModalTitle"
                            class="text-lg
                                   sm:text-xl
                                   font-bold
                                   text-gray-900"
                        >
                            Data Privacy Notice
                        </h2>

                        <p
                            class="mt-1
                                   text-xs
                                   sm:text-sm
                                   text-gray-500"
                        >
                            Please review this notice before submitting
                            your information.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Modal Content --}}
            <div
                class="px-6 sm:px-8
                       py-6
                       max-h-[60vh]
                       overflow-y-auto"
            >

                <div class="space-y-5">

                    {{-- Introduction --}}
                    <div>

                        <p
                            class="text-sm
                                   leading-6
                                   text-gray-600"
                        >
                            At <strong class="text-gray-900">TechSolutions</strong>,
                            we respect your privacy and are committed to
                            protecting your personal information.
                        </p>

                    </div>


                    {{-- Information Collected --}}
                    <div>

                        <h3
                            class="text-sm
                                   font-semibold
                                   text-gray-900
                                   mb-2"
                        >
                            Information We Collect
                        </h3>

                        <p
                            class="text-sm
                                   leading-6
                                   text-gray-600"
                        >
                            The information you provide, including your
                            name, contact number, email address, address,
                            and Facebook account information, may be
                            collected for the purpose of processing and
                            managing your repair service.
                        </p>

                    </div>


                    {{-- Purpose --}}
                    <div>

                        <h3
                            class="text-sm
                                   font-semibold
                                   text-gray-900
                                   mb-2"
                        >
                            How We Use Your Information
                        </h3>

                        <p
                            class="text-sm
                                   leading-6
                                   text-gray-600"
                        >
                            Your information may be used to contact you
                            regarding your repair appointment, provide
                            updates about your device, process your
                            repair service, maintain customer records,
                            and provide after-sales or warranty support.
                        </p>

                    </div>


                    {{-- Protection --}}
                    <div>

                        <h3
                            class="text-sm
                                   font-semibold
                                   text-gray-900
                                   mb-2"
                        >
                            Protection of Your Information
                        </h3>

                        <p
                            class="text-sm
                                   leading-6
                                   text-gray-600"
                        >
                            TechSolutions will take reasonable measures
                            to protect your personal information from
                            unauthorized access, disclosure, alteration,
                            or misuse.
                        </p>

                    </div>


                    {{-- Sharing --}}
                    <div>

                        <h3
                            class="text-sm
                                   font-semibold
                                   text-gray-900
                                   mb-2"
                        >
                            Disclosure of Information
                        </h3>

                        <p
                            class="text-sm
                                   leading-6
                                   text-gray-600"
                        >
                            Your personal information will not be sold
                            or disclosed to unrelated third parties
                            except when necessary to provide the
                            requested service, comply with applicable
                            laws, or when otherwise permitted by law.
                        </p>

                    </div>


                    {{-- Consent --}}
                    <div
                        class="rounded-xl
                               border border-gray-200
                               bg-gray-50
                               p-4"
                    >

                        <div class="flex items-start gap-3">

                            <input
                                type="checkbox"
                                id="privacy_consent"
                                class="mt-1
                                    h-4
                                    w-4
                                    rounded
                                    border-gray-300
                                    text-gray-900
                                    focus:ring-gray-900"
                            >

                            <label
                                for="privacy_consent"
                                class="text-sm
                                       leading-6
                                       text-gray-700
                                       cursor-pointer"
                            >
                                I have read and understood the Data
                                Privacy Notice. I consent to TechSolutions
                                collecting and processing the personal
                                information I provide for the purposes
                                stated above.
                                <span class="text-red-500">*</span>
                            </label>

                        </div>


                        <p
                            id="privacyConsentError"
                            class="hidden
                                   mt-2
                                   ml-7
                                   text-xs
                                   font-medium
                                   text-red-600"
                        >
                            Please check the box to confirm that you
                            understand and agree to the privacy notice.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Modal Footer --}}
            <div
                class="px-6 sm:px-8
                       py-4
                       border-t border-gray-200
                       bg-gray-50"
            >

                <div
                    class="flex
                           flex-col-reverse
                           sm:flex-row
                           sm:justify-end
                           gap-3"
                >

                    {{-- Cancel --}}
                    <button
                        type="button"
                        id="cancelPrivacyButton"
                        class="w-full
                               sm:w-auto
                               inline-flex
                               items-center
                               justify-center
                               px-5
                               py-2.5
                               rounded-lg
                               border border-gray-300
                               bg-white
                               text-gray-700
                               text-sm
                               font-semibold
                               hover:bg-gray-50
                               transition"
                    >
                        Go Back
                    </button>


                    {{-- Confirm --}}
                    <button
                        type="button"
                        id="confirmPrivacyButton"
                        class="w-full
                               sm:w-auto
                               inline-flex
                               items-center
                               justify-center
                               gap-2
                               px-5
                               py-2.5
                               rounded-lg
                               bg-gray-900
                               text-white
                               text-sm
                               font-semibold
                               hover:bg-gray-800
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Continue & Submit

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    PRIVACY MODAL JAVASCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('customerInformationForm');

    const modal = document.getElementById('privacyModal');

    const backdrop = document.getElementById('privacyModalBackdrop');

    const cancelButton = document.getElementById('cancelPrivacyButton');

    const confirmButton = document.getElementById('confirmPrivacyButton');

    const privacyCheckbox = document.getElementById('privacy_consent');

    const privacyConsentValue = document.getElementById('privacyConsentValue');

    const privacyError = document.getElementById('privacyConsentError');


    /*
    |--------------------------------------------------------------------------
    | Open Privacy Modal
    |--------------------------------------------------------------------------
    */

    form.addEventListener('submit', function (event) {

        /*
         * Stop the form from being submitted immediately.
         * The customer must first review the privacy notice.
         */

        event.preventDefault();


        /*
         * Make sure the modal is visible.
         */

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');


        /*
         * Reset previous error message.
         */

        privacyError.classList.add('hidden');

    });


    /*
    |--------------------------------------------------------------------------
    | Close Modal
    |--------------------------------------------------------------------------
    */

    function closePrivacyModal() {

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    }


    cancelButton.addEventListener('click', function () {

        closePrivacyModal();

    });


    backdrop.addEventListener('click', function () {

        closePrivacyModal();

    });


    /*
    |--------------------------------------------------------------------------
    | Confirm Privacy Consent
    |--------------------------------------------------------------------------
    */

    confirmButton.addEventListener('click', function () {

        /*
        * Make sure the customer checked the consent checkbox.
        */

        if (!privacyCheckbox.checked) {

            privacyError.classList.remove('hidden');

            privacyCheckbox.focus();

            return;

        }


        /*
        * Store the customer's consent in the
        * hidden form field.
        */

        privacyConsentValue.value = '1';


        /*
        * Hide the error message.
        */

        privacyError.classList.add('hidden');


        /*
        * Prevent multiple clicks.
        */

        confirmButton.disabled = true;

        confirmButton.classList.add(
            'opacity-60',
            'cursor-not-allowed'
        );


        /*
        * Submit the form.
        */

        form.submit();

    });


    /*
    |--------------------------------------------------------------------------
    | Hide Consent Error When Checkbox Is Checked
    |--------------------------------------------------------------------------
    */

    privacyCheckbox.addEventListener('change', function () {

        if (privacyCheckbox.checked) {

            privacyError.classList.add('hidden');

        }

    });


    /*
    |--------------------------------------------------------------------------
    | ESC Key
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function (event) {

        if (
            event.key === 'Escape' &&
            !modal.classList.contains('hidden')
        ) {

            closePrivacyModal();

        }

    });

});

</script>

</body>
</html>
