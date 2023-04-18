<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
</head>
<style>
</style>

<body class="h-screen overflow-hidden items-center justify-center" style="background: #edf2f7;">
    <div class="bg-white">
        <div class="flex justify-center h-screen">
            <div class="hidden lg:block lg:w-2/6"
                style="background-image: url('images/login-pic2.png'); background-size: cover">
            </div>

            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                <div class="flex-1">
                    <div class="text-left">
                        <h2 class="text-4xl font-bold text-left">Log in</h2>

                        <p class="mt-3">Please enter your credentials</p>
                    </div>

                    <div class="mt-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div>
                                <label for="email" class="block mb-2 text-sm">Email</label>
                                <input type="email" name="email" id="email" placeholder="someone@example.com"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm">Password</label>
                                </div>

                                <input type="password" name="password" id="password" placeholder="Your Password"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-amber-400 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Sign in
                                </button>
                            </div>
                        </form>

                        <p class="mt-6 text-sm text-left text-gray-400">Forgot your credentials? <a href="#"
                                class="text-blue-500 focus:outline-none focus:underline hover:underline">Contact Your
                                Administrator</a>.</p>
                        <div class="mt-6">
                            <img class="w-1/3 h-1/3" src="images/sLogo.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
