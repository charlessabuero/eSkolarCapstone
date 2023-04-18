<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{asset('build/app.css')}}"> --}}
    {{-- <script src="{{asset('build/app.js')}}"></script> --}}
    @livewireStyles
    @livewireScripts
    @stack('scripts')
</head>

<body class="antialiased">

    @if (\Route::current()->getName() != 'filament.auth.login')
     <header>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav class="bg-gray-100">
            <div class="max-w-7xl mx-auto px-2 py-4 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <!--
              Icon when menu is closed.

              Heroicon name: outline/menu

              Menu open: "hidden", Menu closed: "block"
            -->
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!--
              Icon when menu is open.

              Heroicon name: outline/x

              Menu open: "block", Menu closed: "hidden"
            -->
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="block lg:hidden h-14 w-auto" src="images/sLogo.png" alt="Workflow">
                            <img class="hidden lg:block h-14 w-auto" src="images/sLogo.png" alt="Workflow">
                        </div>
                    </div>
                    <div class="items-right justify-right sm:items-stretch sm:justify-end">
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="#"
                                    class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page"><b>Home</b></a>

                                <a href="{{ route('scholarship.view') }}"
                                    class="text-black hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">View
                                    Scholarships</a>

                                <a href="https://www.ustp.edu.ph/cdeo/admission-and-scholarship-office/"
                                    class="text-black hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About
                                    Us</a>

                                <a href="{{ route('filament.auth.login') }}">
                                    <button
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Sign
                                        in</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                    <a href="#"
                        class="bg-gray-900 text-white hover:bg-blue-900 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        aria-current="page">Home</a>

                    <a href="{{ route('scholarship.view') }}"
                        class="text-black-300 hover:bg-blue-900 hover:text-white block px-3 py-2 rounded-md text-base font-medium">View
                        Scholarships</a>

                    <a href="https://www.ustp.edu.ph/cdeo/admission-and-scholarship-office/"
                        class="text-black-300 hover:bg-blue-900 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About
                        Us</a>

                    <a href="{{ route('filament.auth.login') }}">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Sign
                            in</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    @endif
   

    {{ $slot }}

    @livewire('notifications')
</body>

</html>
