<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        
        <x-button type="submit" green class="mt-4">
            Submit
        </x-button>
    </form>
</x-filament::page>
