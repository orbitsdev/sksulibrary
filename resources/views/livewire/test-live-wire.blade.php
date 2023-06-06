<div class="flex items-center justify-center bg-gray-500 h-screen w-screen">

    <div class="w-1/3">
        
        <x-card class="">
            
            
            
            
            <form wire:submit.prevent="save">
                <input type="file" wire:model="file">
                
                <x-button type="submit" spinner="save" dark label="Import" />
                
                
            </form>

            @error('file') <span class="error text-red-600">{{ $message }}</span> @enderror
        </x-card>
    </div>

</div>
