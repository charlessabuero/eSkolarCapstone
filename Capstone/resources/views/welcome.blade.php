<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
</head>
<style>
    #bannerimage {
        width: 100%;
        background-image: url(images/group-photo.png);
        background-position: top;
        background-size: cover;
    }
</style>

<body>
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
    <div id="bannerimage" class="container mx-auto px-4 py-56 sm:px-6 xl:px-12">
        <div class="flex flex-col items-center justify-center space-y-6 text-center">
            <h1 class="text-4xl font-bold text-white tracking-normal sm:text-5xl lg:text-6xl"><u>Scholarships</u>, at
                our hand.</h1>
            <p class="max-w-screen-sm text-lg text-white sm:text-2xl">A one-stop solution in monitoring USTP
                scholarships</p>
            <a href="{{route('filament.auth.login')}}">
                <button
                    class="w-full py-3 px-6 text-center text-white rounded-xl transition bg-yellow-500 shadow-xl hover:bg-yellow-600 active:bg-yellow-600 focus:bg-yellow-600 sm:w-max">EXPLORE</button>
            </a>
        </div>
    </div>
    <div class="py-24 bg-white">
        <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12 lg:px-20">
            <div class="justify-center text-center gap-6 md:text-left md:flex lg:items-center  lg:gap-16">
                <div class="order-last mb-6 space-y-6 md:mb-0 md:w-6/12 lg:w-6/12">
                    <h1 class="text-4xl text-gray-700 font-bold md:text-5xl">Who we are?</h1>
                    <p class="text-lg">At the USTP Admission and Scholarships Office, we care for our scholars. By
                        monitoring their progress in their academic journey, we provide the best possible solution to
                        give essential services and programs for their scholarship.</p>
                    <div class="flex flex-row-reverse flex-wrap justify-center gap-4 md:gap-6 md:justify-end">
                        <a href="https://www.ustp.edu.ph/cdeo/admission-and-scholarship-office/">
                            <button type="button" title="Learn More"
                                class="w-full py-3 px-6 text-center rounded-xl transition bg-yellow-500 shadow-xl hover:bg-yellow-600 active:bg-yellow-600 focus:bg-yellow-600 sm:w-max">
                                <span class="block text-white font-semibold" href="#">
                                    Learn More
                                </span>
                            </button>
                    </div>
                    </a>
                </div>
                <div class="grid grid-cols-5 grid-rows-4 gap-4 md:w-5/12 lg:w-6/12">
                    <div class="col-span-2 row-span-4">
                        <img src="images/aso3.png" class="rounded-full" width="640" height="960" alt="shoes"
                            loading="lazy">
                    </div>
                    <div class="col-span-2 row-span-2">
                        <img src="images/aso2.png" class="w-full h-full object-cover object-top rounded-xl"
                            width="640" height="640" alt="shoe" loading="lazy">
                    </div>
                    <div class="col-span-3 row-span-3">
                        <img src="images/aso1.png" class="w-full h-full object-cover object-top rounded-xl"
                            width="640" height="427" alt="shoes" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="w-full py-16 bg-gray-100">
        <div class="md:px-12 lg:px-28">
            <div class="container m-auto space-y-6 text-gray-600">
                <img src="images/sLogo.png" alt="logo tailus" class="w-40 m-auto" />
                <ul role="list" class="py-4 flex flex-col gap-4 items-center justify-center sm:flex-row sm:gap-8">
                    <li role="listitem"><a href="#" class="hover:text-cyan-500">Home</a></li>
                    <li role="listitem"><a href="{{ route('scholarship.view') }}" class="hover:text-cyan-500">View
                            Scholarships</a></li>
                    <li role="listitem"><a href="https://www.ustp.edu.ph/cdeo/admission-and-scholarship-office/"
                            class="hover:text-cyan-500">About Us</a></li>
                    <li role="listitem"><a href="login.html" class="hover:text-cyan-500">Sign in</a></li>
                </ul>
                <div class="w-max m-auto flex items-center justify-between space-x-4">
                    <a href="tel:+639360379533" aria-label="call">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 m-auto"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z">
                            </path>
                        </svg>
                    </a>
                    <a href="scholarship@ustp.edu.ph" aria-label="send mail">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 m-auto"
                            viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/USTPAdScho" title="facebook" target="blank"
                        aria-label="facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 m-auto"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="text-center">
                    <span class="text-sm tracking-wide">Copyright © e-Skolar Portal<span id="year"></span> | All
                        right reserved</span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
