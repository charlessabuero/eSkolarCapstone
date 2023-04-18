<div class="w-full flex justify-center">
    <div class="w-full shadow-xl flex justify-center rounded p-4 px-12 pt-5 mx-24 m-5">
        <form wire:submit.prevent="create">
            {{ $this->form }}

            <x-filament::button type="submit" form="submit" class="w-full mt-4">
                {{ 'Submit' }}
            </x-filament::button>
        </form>

        {{ $this->modal }}

    </div>
</div>
