<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Repair Book Pro') | TechSolutions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out" 
               :class="{ 'translate-x-0': sidebarOpen }">
            <!-- Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-800">
                <div>
                    <div class="text-lg font-bold tracking-tight">TechSolutions</div>
                    <div class="text-xs text-slate-400 mt-0.5">REPAIR | UPGRADE | SOLVE</div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-12rem)]">
                <!-- Main Menu -->
                <div class="px-3 pt-2 pb-2">
                    <p class="text-[10px] uppercase tracking-widest font-semibold text-slate-500">Main</p>
                </div>

                @php
                    $navItems = [
                        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6'],
                        ['route' => 'appointments.index', 'label' => 'Appointments', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['route' => 'customers.index', 'label' => 'Customers', 'icon' => 'M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2 M9 7a4 4 0 100-8 4 4 0 000 8z M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs($item['route']) ? 'bg-slate-800 text-white' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach

                @php
                    $repairsActive = request()->routeIs('repair-jobs.*');
                @endphp

                <a href="{{ route('repair-jobs.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition
                        {{ $repairsActive
                            ? 'bg-slate-800 text-white'
                            : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M14.7 6.3a4 4 0 01-5 5L4 17l3 3 5.7-5.7a4 4 0 015-5z"/>

                    </svg>

                    Repairs
                </a>

                <!-- Divider -->
                <div class="border-t border-slate-800 my-5"></div>

                <!-- Inventory -->
                <div class="px-3 pb-2">
                    <p class="text-[10px] uppercase tracking-widest font-semibold text-slate-500">
                        Inventory
                    </p>
                </div>

                @php
                    $inventoryItems = [
                        [
                            'route' => 'parts.index',
                            'label' => 'Stocks',
                            'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10',
                        ],

                        [
                            'route' => 'orders.index',
                            'label' => 'Orders',
                            'icon' => 'M3 7h18M5 7V5a2 2 0 012-2h10a2 2 0 012 2v2M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7M9 11h6',
                        ],

                        [
                            'route' => 'suppliers.index',
                            'label' => 'Suppliers',
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        ],
                    ];
                @endphp

                @foreach($inventoryItems as $item)

                    <a
                        href="{{ route($item['route']) }}"
                        class="
                            flex
                            items-center
                            gap-3
                            px-3
                            py-2.5
                            rounded-lg
                            text-sm
                            font-medium
                            transition
                            {{ request()->routeIs($item['route'])
                                ? 'bg-slate-800 text-white'
                                : 'text-slate-400 hover:bg-slate-900 hover:text-white'
                            }}
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
                                d="{{ $item['icon'] }}"
                            />

                        </svg>

                        {{ $item['label'] }}

                    </a>

                @endforeach


                <!-- Divider -->
                <div class="border-t border-slate-800 my-5"></div>

                <!-- System -->
                <div class="px-3 pb-2">
                    <p class="text-[10px] uppercase tracking-widest font-semibold text-slate-500">System</p>
                </div>

                @php
                    $systemItems = [
                        ['label' => 'Services', 'icon' => 'M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z M19.4 15a1.65 1.65 0 00.33 1.82l.06.06-1.5 1.5-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V20h-2.12v-.08a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06-1.5-1.5.06-.06A1.65 1.65 0 009.4 15a1.65 1.65 0 00-1.51-1H7.8v-2.12h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82L9 9l1.5-1.5.06.06a1.65 1.65 0 001.82.33 1.65 1.65 0 001-1.51V6h2.12v.08a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06L19.9 8.7l-.06.06A1.65 1.65 0 0019.5 10c.2.61.77 1 1.41 1H21v2.12h-.09a1.65 1.65 0 00-1.51 1z'],
                        ['label' => 'Settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M12 15a3 3 0 100-6 3 3 0 000 6z'],
                    ];
                @endphp

                @foreach($systemItems as $item)
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:bg-slate-900 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-slate-700 flex items-center justify-center font-semibold">BT</div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium truncate">Bryan Tan</p>
                        <p class="text-xs text-slate-500 truncate">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay -->
        <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 bg-black/40 z-40 lg:hidden" x-cloak></div>

        <!-- Main Content -->
        <div class="flex-1 lg:pl-64">
            <!-- Topbar -->
            <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <button type="button" @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="hidden lg:block">
                    <h2 class="font-semibold text-gray-800">@yield('page-heading', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-4 ml-auto">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium">Bryan Tan</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center text-sm font-semibold">BT</div>
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="max-w-7xl mx-auto bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="max-w-7xl mx-auto bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>