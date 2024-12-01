<x-filament-panels::page>
    {{ $this->form }}

    <div class="flex gap-3 justify-end">
        {{ $this->cancel }}
        {{ $this->save }}
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>