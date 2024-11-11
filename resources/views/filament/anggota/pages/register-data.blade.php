<x-filament-panels::page>
    <form wire:submit="create">

        {{ $this->form }}

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-filament-panels::page>