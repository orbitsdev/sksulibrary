<div class=" bg-gradient-to-r from-[#072510] to-[#072510]  overflow-y-auto">


    <div class="mx-auto flex flex-col justify-center items-center  h-screen ">


        <div class="bg-[#0d3119] container p-8 rounded-lg shadow-lg grid grid-cols-1 gap-8">
            <div class="flex justify-between items-center text-gray-100 ">

                <div class="flex items-center justify-center">

                    <p class=" capitalize mr-4">Teller {{ $teller->teller_letter }} </p>

                </div>
                <div class="flex items-center justify-center">

                    <p class=" capitalize mr-4">{{ $teller->teller_name }} - </p>
                    <button type="button"
                        class="transition-all flex items-center justify-center  rounded hover:text-green-600 "
                        wire:click="logout">

                        <p class="mr-2"> Logout</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 ">
                            <path fill-rule="evenodd"
                                d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 011.06 0z"
                                clip-rule="evenodd" />
                        </svg>

                    </button>
                </div>



            </div>



            <div class="flex">
                <div class=" p-4 ">
                    <h1 class="text-gray-100 text-2xl uppercase font-semibold mb-4 text-center">Current Queue Number
                    </h1>
                    <div
                        class="flex flex-col h-96 w-96 items-center justify-center   p-8 rounded bg-[#103f20] cursor-pointer transition-all  hover:bg-[#154d28]">

                        {{-- <h3 class="text-xl font-semibold text-gray-100 mb-2">Current Queue Number</h3> --}}
                        @if (empty($currentQueque))
                            <div wire:loading wire:target="selectNumber">


                                <div role="status">
                                    <svg aria-hidden="true"
                                        class="w-20 h-20 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-green-600"
                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor" />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill" />
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>


                            </div>
                            <p class="font-semibold text-gray-300 text-center">
                                No number is selected
                            </p>
                        @else
                            <p class="text-7xl font-semibold text-gray-100">
                                {{ $currentQueque->number }}
                            </p>
                           
                                
                        @endIf


                    </div>
                    {{-- <div class="mt-4 min-h-20">
                        @if(!empty($currentQueque))
                        <p class="text-gray-300 text-sm mb-4 leading-none">Some individuals might not be able to see the monitor. You can use this button to make an announcement:</p>
                        <x-button wire:click="callNumber({{ $currentQueque->id }})"
                            spinner="callNumber"
                            class="shout text-black text-simibold text-lg py-3 rounded  transition-all px-4 w-full"
                            label="Anounce Selected Number  " >

                        </x-button>
                        @endif
                    </div> --}}
                </div>
                <div class="w-full p-4" wire:poll.750ms>

                    <div class="mb-4">
                        <p class="text-gray-100 text-sm mb-1">Hold transactions </p>

                        <x-select placeholder="e.g 5" searchable wire:model="selectedHoldTransaction">

                            @foreach ($holdnumbers as $item)
                                <x-select.option label="{{ $item->number }}" value="{{ $item->id }}" />
                            @endforeach


                        </x-select>
                    </div>
                    <div>

                        {{-- <p class="text-gray-100">
                Current time: {{ now() }}
  
              </p> --}}
                        <h1 class="text-gray-100 text-2xl uppercase font-semibold mb-4"> Next Numbers
                            @if (empty($currentQueque) && count($waitingNumbers) > 0)
                                <span class="text-sm ml-2 text-gray-300 capitalize"> click number to select</span>
                            @endif
                        </h1>
                        <div class="grid grid-cols-3 gap-8 min-h-40  border-2 border-green-900 rounded-md">
                            @forelse($waitingNumbers as $item)
                                <button type="button" class="flex flex-col items-center justify-center h-40 p-8 rounded bg-[#103f20] cursor-pointer transition-all hover:scale-105 hover:bg-[#154d28]"
                                    wire:click="selectNumber({{ $item->id }})">
                                    <p class="text-6xl font-semibold text-gray-100">{{ $item->number }}</p>
                                </button>
                            @empty
                                <div class="flex items-center justify-center col-span-3 h-40">
                                    <h1 class="text-gray-300"> No number/person is called at the moment </h1>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-10">
                            @if (empty($currentQueque))
                                @if (count($pendingQueque) < 3)
                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <x-button wire:click="callNextPerson" spinner="callNextPerson"
                                            class="tellerbutton text-white text-lg py-3 rounded  transition-all px-4 "
                                            label="Call Next Person" />
                                        {{-- <button class="bg-[#103f20] text-gray-100 text-lg py-3 rounded hover:scale-95 transition-all px-4 hover:bg-[#154d28]">Skip Customer</button> --}}
                                    </div>
                                @endIf
                            @else
                                <div class="grid grid-cols-2 gap-4">
                                    @if (count($pendingQueque) < 3)
                                        <x-button wire:click="callNextPerson" spinner="callNextPerson"
                                            class="tellerbutton text-white text-lg py-3 rounded  transition-all px-4 "
                                            label="Call Next Person" />
                                    @else
                                        <div></div>
                                        {{-- <button class="bg-[#103f20] text-gray-100 text-lg py-3 rounded hover:scale-95 transition-all px-4 hover:bg-[#154d28]">Skip Customer</button> --}}
                                    @endIf

                                    <x-button wire:click="completeTransaction({{ $currentQueque->id }})"
                                        spinner="completeTransaction"
                                        class="tellerbutton text-white text-lg py-3 rounded  transition-all px-4 "
                                        label="Complete Transaction" />
                                    <x-button wire:click="cancelTransaction({{ $currentQueque->id }})"
                                        spinner="cancelTransaction"
                                        class="tellerbutton text-white text-lg py-3 rounded  transition-all px-4 "
                                        label="Cancel Transaction" />
                                    <x-button wire:click="holdTransaction({{ $currentQueque->id }})"
                                        spinner="holdTransaction"
                                        class="tellerbutton text-white text-lg py-3 rounded  transition-all px-4 "
                                        label="Hold Transaction" />
                                    <x-button wire:click="callNumber({{ $currentQueque->number }})"
                                        spinner="callNumber"
                                        class="tellerbutton text-white text-lg py-3 rounded  transition-all px-4 "
                                        label="Announce Number " />
                                   
                                </div>

                                {{-- <div class="mt-8">
                                    <p class="text-gray-200 text-sm mb-4 leading-none">Some individuals might not be able to see the monitor. You can use this button to make an announcement:</p>

                                    <x-button wire:click="callNumber({{ $currentQueque->id }})"
                                        spinner="callNumber"
                                        class="shout capitallize text-gray-200 text-xl py-3 rounded  transition-all px-4 "
                                        label="Announce  Selected Number" />
                            </div> --}}

                            @endif
                        </div>
                    </div>



                </div>






            </div>
        </div>

        <script>

document.addEventListener('DOMContentLoaded', function () {
    Livewire.on('shoutNumber', numberSelected => {

            var intro = 'number';
            var msg = new SpeechSynthesisUtterance();
            msg.text = intro+numberSelected.toString(); // Convert the number to string and set it as text
            window.speechSynthesis.speak(msg);
        });
});

        </script>

    </div>
