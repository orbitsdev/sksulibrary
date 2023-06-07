<div>


    <div class="flex items-center justify-center h-screen bg-gray-300 w-full">

        <div class="w-1/2">

            <x-card >

                <x-input  wire:model.debounce.700ms="barcode"  autofocus/>
                <div class="p-4">
                    {{$barcode}}

                </div>
                <x-button dark label="Save" wire:click="save" spinner="save" />

                {{-- {{($student == null || empty($student))  ?  'null' : $student}} --}}
                {{$dateNow}}
            </x-card>
        </div>
    </div>
    <x-dialog />
</div>