<div class="min-h-screen relative bg-white   ">
    <div class=" border-green-500  rounded flex items-center justify-center  ">
        @livewire('test-live-wire')
    </div>
    <div class="max-w-[1200px]   mx-auto h-screen">
        <div class=" h-full flex justify-center items-center ">

            <section class="grid grid-cols-12 w-[80%] content-center items-stretch shadow-2xl ">
                <div class="px-10 pb-2 pt-12 bg-gray-50 col-span-6   ">



                    <p class="uppercase text-3xl text-gray-500 text-center tracking-tight pb-10"> Library Management
                        System
                    </p>
                    <div class="flex justify-center mt-2">

                        <svg class="h-24 w-24 fill-gray-500 " id="Layer_1" data-name="Layer 1"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.61 122.88">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill-rule: evenodd;
                                    }
                                </style>
                            </defs>
                            <title>qr-code-scan</title>
                            <path class="cls-1"
                                d="M26.68,26.77H51.91V51.89H26.68V26.77ZM35.67,0H23.07A22.72,22.72,0,0,0,14.3,1.75a23.13,23.13,0,0,0-7.49,5l0,0a23.16,23.16,0,0,0-5,7.49A22.77,22.77,0,0,0,0,23.07V38.64H10.23V23.07a12.9,12.9,0,0,1,1-4.9A12.71,12.71,0,0,1,14,14l0,0a12.83,12.83,0,0,1,9.07-3.75h12.6V0ZM99.54,0H91.31V10.23h8.23a12.94,12.94,0,0,1,4.9,1A13.16,13.16,0,0,1,108.61,14l.35.36h0a13.07,13.07,0,0,1,2.45,3.82,12.67,12.67,0,0,1,1,4.89V38.64h10.23V23.07a22.95,22.95,0,0,0-6.42-15.93h0l-.37-.37a23.16,23.16,0,0,0-7.49-5A22.77,22.77,0,0,0,99.54,0Zm23.07,99.81V82.52H112.38V99.81a12.67,12.67,0,0,1-1,4.89,13.08,13.08,0,0,1-2.8,4.17,12.8,12.8,0,0,1-9.06,3.78H91.31v10.23h8.23a23,23,0,0,0,16.29-6.78,23.34,23.34,0,0,0,5-7.49,23,23,0,0,0,1.75-8.8ZM23.07,122.88h12.6V112.65H23.07A12.8,12.8,0,0,1,14,108.87l-.26-.24a12.83,12.83,0,0,1-2.61-4.08,12.7,12.7,0,0,1-.91-4.74V82.52H0V99.81a22.64,22.64,0,0,0,1.67,8.57,22.86,22.86,0,0,0,4.79,7.38l.31.35a23.2,23.2,0,0,0,7.5,5,22.84,22.84,0,0,0,8.8,1.75Zm66.52-33.1H96v6.33H89.59V89.78Zm-12.36,0h6.44v6H70.8V83.47H77V77.22h6.34V64.76H89.8v6.12h6.12v6.33H89.8v6.33H77.23v6.23ZM58.14,77.12h6.23V70.79h-6V64.46h6V58.13H58.24v6.33H51.8V58.13h6.33V39.33h6.43V58.12h6.23v6.33h6.13V58.12h6.43v6.33H77.23v6.33H70.8V83.24H64.57V95.81H58.14V77.12Zm31.35-19h6.43v6.33H89.49V58.12Zm-50.24,0h6.43v6.33H39.25V58.12Zm-12.57,0h6.43v6.33H26.68V58.12ZM58.14,26.77h6.43V33.1H58.14V26.77ZM26.58,70.88H51.8V96H26.58V70.88ZM32.71,77h13V89.91h-13V77Zm38-50.22H95.92V51.89H70.7V26.77Zm6.13,6.1h13V45.79h-13V32.87Zm-44,0h13V45.79h-13V32.87Z" />
                        </svg>
                    </div>
                    <div class="mt-7">
                        <p for="name" class="block font-medium text-sm  text-gray-500"> ID Number </p>


                        <x-input wire:model.debounce.700ms="barcode" autofocus
                            class="block border-gray-300 active:border-green-600 focus:border-green-600 outline-emerald-500 p-2 mt-1 w-full h-12" />
                    </div>
                    <div class="text-center mt-4 flex items-center justify-center">
                        <p class="text-xs  text-gray-500 mr-4">Auto-Trigger: Active by default, Click to Take Control
                        </p>
                        <x-toggle lg wire:model="isManualInputBarCode" class="swithlabel" />
                    </div>



                    <div class="mt-6 flex justify-end h-10   ">
                        @if ($isManualInputBarCode)
                            <x-button wire:click="readBarCodeManually" spinner="readBarCodeManually"
                                class="sk-button max-h-14 px-[34px] py-[12px]  w-full justify-center capitalize">
                                Read Bar Code
                            </x-button>
                        @else
                            {{-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class="w-full h-24 " fill="#6b7280" viewBox="0 0 122.88 82.185" enable-background="new 0 0 122.88 82.185" xml:space="preserve"><g><path d="M7.059,0H115.82h0.002v0.011c1.948,0.002,3.713,0.798,4.987,2.08c1.268,1.279,2.057,3.045,2.057,4.989h0.014v0.006h-0.014 v72.132c0,1.63-1.322,2.955-2.955,2.955v0.011H2.968C1.329,82.185,0,80.856,0,79.219c0-0.091,0.004-0.182,0.014-0.27V7.086H0V7.084 h0.014c0-1.948,0.789-3.717,2.059-4.994c1.272-1.281,3.034-2.077,4.98-2.08V0H7.059L7.059,0z M15.817,13.767h75.302v10.975H15.817 V13.767L15.817,13.767z M95.736,13.767h11.326v10.975H95.736V13.767L95.736,13.767z M15.817,68.418v-6.234 c3.335-1.482,13.547-4.233,14.028-8.317c0.108-0.921-2.064-4.504-2.563-6.188c-0.626-1-0.964-1.354-0.948-2.587 c0.009-0.694,0.021-1.377,0.118-2.044c0.129-0.853,0.102-0.877,0.549-1.564c0.462-0.712,0.265-3.315,0.265-4.297 c0-9.773,17.125-9.776,17.125,0c0,1.236-0.286,3.506,0.388,4.479c0.324,0.472,0.268,0.528,0.376,1.106 c0.143,0.755,0.154,1.53,0.166,2.32c0.016,1.233-0.32,1.587-0.945,2.587c-0.608,1.769-2.917,5.116-2.719,6.118 c0.735,3.729,10.205,6.233,13.187,7.561v7.062H15.817L15.817,68.418z M60.859,34.385h46.203v6.08H60.859V34.385L60.859,34.385z M61.93,61.769h45.133v6.08H61.93V61.769L61.93,61.769z M81.475,48.077h25.588v6.079H81.475V48.077L81.475,48.077z M61.93,48.077 h14.32v6.079H61.93V48.077L61.93,48.077z M115.82,5.932H7.059H7.052V5.921c-0.297,0-0.578,0.132-0.785,0.34 C6.055,6.477,5.923,6.767,5.923,7.084h0.012v0.002H5.923v69.167h111.034V7.086h-0.012V7.08h0.012c0-0.313-0.132-0.604-0.343-0.816 c-0.209-0.211-0.49-0.343-0.792-0.343v0.011H115.82L115.82,5.932z"/></g></svg> --}}
                        @endif

                    </div>




                    {{-- <div class="pt-[44px] flex  justify-end flex-col ">
                        <a href="/admin"
                            class="tex-sm text-slate-500 hover:text-green-700 ">Admin?</a>
                        <p class="text-slate-500 text-sm "> Unauthorized personnel are not permitted access to this area
                        </p>
                    </div> --}}
                </div>
                <div class="p-10  sksu-primary col-span-6 flex items-center justify-center min-h-[560px]">
                    <img src="{{ asset('/images/sksulogo.png') }}" alt="" class="w-[300px] h-[300px]">
                </div>
            </section>

        </div>
    </div>



    <x-modal.card align="center" z-index="z-50" blur wire:model="isConfirmationShow" show="true">
        <h1 class="text-xl text-center">Are you sure do you
            want to proceed?</h1>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">

                <div class="flex">
                    {{-- <x-button flat label="Cancel" x-on:click="close" /> --}}
                    <x-button wire:click="processLog" spinner="processLog" icon="check"
                        class="sk-button max-h-14 px-[34px] py-[12px]  w-full justify-center capitalize mr-2 ">
                        Yes
                    </x-button>
                    <x-button wire:click="cancelProcess" spinner="cancelProcess" icon="x"
                        class="sk-button max-h-14 px-[34px] py-[12px]  w-full justify-center capitalize">
                        No
                    </x-button>
                </div>
            </div>
        </x-slot>

    </x-modal.card>


    <x-modal.card align="center" blur z-index="z-40" wire:model="isSuccess" max-width="6xl" show="true"
        spacing="">
        @if ($student != null && $todayRecord != null)
            <div class="modal-c rounded-md px-6 py-2 relative">

                <p class="uppercase text-3xl text-green-900 text-center tracking-tight pb-10"> 
                    {{ now()->timezone('Asia/Manila')->format('F d, Y') }}
                </p>

                <div class="relative">
                    <img src="{{ asset('images/sksulogo.png') }}" alt="sksu-logo.png"
                        class="w-24 h-24 mx-auto absolute top-[-80px]  right-5">


                </div>

                <div class="grid grid-cols-2 ">

                    <div class=" flex-2  flex items-center justify-center h-[300px] w-full  pr-16 ">

                        <div class="w-[400px] h-[300px] rounded relative">
                            @if (!empty($student->profile))
                                <img src="{{ Storage::disk('public')->url($student->profile) }}" alt="profile.jpg"
                                    class="h-full w-full object-cover rounded">
                            @else
                                <img src="{{ asset('/images/placeholder.jpg') }}" alt="profile.jpg"
                                    class="h-full w-full object-cover rounded">
                              
                            @endif

                        </div>
                    </div>




                    <div class="mt-2 ">
                        <div class="mm  relative text-center text-xl font-bold uppercase pt-4">

                            <div
                                class="bg-[#166534] rounded-full w-[70px] h-[70px] text-white text-3xl p-1 inline-flex items-center justify-center uppercase">
                                @if ($studentLoginRecord = $this->student->logins()->latest()->first())
                                    @if ($studentLoginRecord->logout)
                                        @if($studentLoginRecord->logout->status == 'Logged out')
                                                In
                                        @else   
                                                Out
                                        @endif
                                    @endif
                            @else
                                In
                            @endif
                            
                            

                            </div>


                        </div>







                        <div class="  mt-4">
                            <P class="text-4xl text-center p-0 font-semibold capitalize text-[#166534]">
                                {{ $student?->last_name }} , {{ $student?->middle_name }} {{ $student?->first_name }}
                            </P>

                        </div>
                        <div class="mt-6 flex items-center text-green-900 justify-between">
                            <P class="mt-2 text  capitalize">
                                ID Number
                            </P>
                            <P class="mt-2 text-xl ">
                                {{ $student?->id_number }}
                            </P>

                        </div>

                        <div class="flex items-center text-green-900 justify-between  ">
                            <P class="mt-2 text-md   capitalize"">
                                Course
                            </P>
                            <P class="mt-2 text-xl ">
                                {{ $student?->course?->name }}
                            </P>

                        </div>

                    </div>
                </div>


            </div>


        @endif
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">

                <div class="flex">
                    {{-- <x-button flat label="Cancel" x-on:click="close" /> --}}
                    <x-button class="bg-green-700 ok transition-all outline-none  ring-0 focus:ring-0 "
                        spinner="showConfirmation" primary label="Confirm" wire:click="showConfirmation" />
                    {{-- <x-button class="bg-green-700 ok transition-all" primary label="DONE" icon="check"
                        x-on:click="close" /> --}}
                </div>
            </div>
        </x-slot>
    </x-modal.card>

</div>



<x-modal.card align="center" blur wire:model="hasError">




    @if ($errorType == 'not-found')
        <x-error-content :image="'not-found.png'" :message="$errorMessage" />
    @endif
    @if ($errorType == 'exception')
        <x-error-content :image="'error.png'" :message="$errorMessage" />
    @endif


    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">


            <div class="flex">

                <x-button positive label="I Understand" x-on:click="close" />
            </div>
        </div>
    </x-slot>

</x-modal.card>

