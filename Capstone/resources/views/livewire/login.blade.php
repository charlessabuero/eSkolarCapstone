<div>
    <div class="h-screen overflow-hidden items-center justify-center" style="background: #edf2f7;">
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

                            <form wire:submit.prevent="submit">
                                {{ $this->form }}

                                <x-filament::button type="submit" form="submit" class="w-full mt-4">
                                    {{ __('filament::login.buttons.submit.label') }}
                                </x-filament::button>
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
    </div>
</div>
