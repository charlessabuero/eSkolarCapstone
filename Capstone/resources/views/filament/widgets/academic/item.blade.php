<div id="academic--item" wire:click="openAcademic()" @class([
    'group cursor-pointer text-center rounded-lg bg-gray-400/10 content-center',
    'hover:bg-gray-500/10 dark:bg-gray-700',
]) style="">
    <div class="text-xs font-medium text-primary-600">
        {{ $year }}
    </div>
    @if ($semester)
        <div class="flex content-center items-center gap-2 px-3">
            <div class="font-medium ">
                {{ $semester }}
            </div>
            <div @class(['font-medium '])>
                {{ $semesterTitle }}
            </div>
        </div>
    @else
        <div class="content-center items-center flex justify-center">
            <div @class(['font-medium text-sm'])>
                {{ $semesterTitle }}
            </div>
        </div>
    @endif
</div>
