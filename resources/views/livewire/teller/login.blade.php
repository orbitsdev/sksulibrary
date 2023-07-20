<div>


    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="w-full flex items-center justify-center mt-4 mb-2">
                <img src="{{ asset('images/logo.png') }}" class="w-24 h-24 " alt="sksu.pnh">

            </div>
            <h1 class="text-center text-2xl font-bold text-gray-800 uppercase mt-3"> SKSU TELLER </h1>


            <div class="mt-4">
                <x-label for="id_number"> Teller ID </x-label>
                <x-input id="id_number" class="block mt-1 w-full" required wire:model="id_number" type="text" />
       
            </div>
            <div class="mt-4">
                <x-label for="password"> Password</x-label>
                <x-input id="password" class="block mt-1 w-full" type="password" required
                    autocomplete="current-password" wire:model="password" />
            </div>
          
            <div class="flex items-center justify-end mt-4">
                <x-button wire:click="login" spinner="login"
                    class="text-white w-full bg-green-800 hover:bg-green-900 transition-all p-2 rounded skbutton">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </div>

    </div>

</div>
