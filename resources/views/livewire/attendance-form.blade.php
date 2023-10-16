<div>


<style>
    .v2card{
        font-family: 'Inter', sans-serif;
    }

#show_bg_2 {
    background-image: linear-gradient(to bottom, hsla(72, 20%, 95%, 0.973), rgba(37, 162, 80, 0.90)), url('images/library.jpg');

background-size: cover;
color: white;
padding: 20px;
}
    </style>
<div class="v2card flex items-center justify-center h-screen  " id="show_bg_2">

    <div class="max-w-[800px] mx-auto bg-[#FEFEFE] shadow-xl m-2 rounded-lg  relative text-center py-8 px-12">  
        
      

        <img src="{{ asset('images/sksulogo.png') }}" alt="sksu-logo.png"
        class="w-24 h-24 mx-auto -mt-12 absolute inset-x-0 top-0">

        <p class="text-[#AAAAAA] uppercase text-xl leading-none mt-8 tracking-widest font-light">SKSU LIBRARY SYSTEM</p>

        <p class="capitalize text-[#36784D] font-medium text-[28px] leading-none mt-4 tracking-tight">University Learning Resource Center</p>

        <div class="mx-auto w-3/4 rounded-full  bg-[#D9D9D9] h-1 mt-5"></div>
      

        <div class="mt-6 max-auto flex items-center  justify-center">
            <div class="bg-[#f6f6f6] p-2">
                <img src="{{asset('images/qr-transparent.png')}}" alt="" class="w-24 h-24">

            </div>
            <div class="ml-4  py-2 px-4">
                <input wire:model.debounce.700ms="barcode" autofocus type="text" class="rounded-full border-2  focus:border-[#36784D]  focus:ring-[#36784D] border-[#36784D] placeholder-[#A7A7A7] w-full placeholder-sm text-green-900" placeholder="ID Number" >
                <div class="flex items-center justify-between mt-2.5">
                    <p class="text-[#A7A7A7] text-sm p-0 mr-3 " >
                        Auto-Trigger: Active by default, Click to Take Control
                    </p>
                    <x-toggle sm wire:model="isManualInputBarCode" class="swithlabel " />
                </div>
            </div>

          
        </div>
        <div x-data="{ isOpen: @entangle('isManualInputBarCode') }"
     x-show="isOpen"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="h-0"
     x-transition:enter-end="h-auto"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="h-auto"
     x-transition:leave-end="h-0"
     class="mt-6 flex justify-end overflow-hidden">
    <x-button wire:click="readBarCodeManually" spinner="readBarCodeManually"
              class="sk-button max-h-14 px-[34px] py-[12px] w-full justify-center rounded-full capitalize">
        Read Bar Code
    </x-button>
</div>

    </div>
</div>

<div>
  
</div>


 
<x-modal.card align="center" blur z-index="z-40" wire:model="isSuccess" sm show="true"
        spacing="">
        @if ($student != null && $todayRecord != null)
        <div class=" p-8 rounded  z-10 relative">
            {{-- <button wire:click="clearInformation" class="absolute top-2 right-2 text-[#B8B8B8]">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button> --}}
            <p class="text-[#36784D] uppercase text-2xl leading-none text-center">SKSU LIBRARY SYSTEM</p>
            <p class="mt-8 text-3xl font-bold text-center">
                {{ ucfirst($student?->last_name) ?? '' }} , {{ $student?->middle_name ?? '' }}
                    {{ $student?->first_name ?? '' }}    
            </p>
            <p class="mt-2 text-[#918f8f] text-lg text-center">
                {{ $student->year ?? '' }}, {{ $student?->course?->name ?? '' }}

            </p>
            @if ($studentLoginRecord = $this->student->logins()->latest()->first())
                @if ($studentLoginRecord->logout)
                    @if ($studentLoginRecord->logout->status == 'Logged out')
                    <p class="text-[#BB0000] mt-4 font-bold text-center">Has Been Logged out</p>
                    @else
                    <p class="text-[#36784D] mt-4 font-bold text-center">Has Been Logged in</p>
                        @endif
                        @endif
                        @else
                        <p class="text-[#BB0000] mt-4 font-bold text-center">Has Been Logged out</p>
            @endif
           
        </div>

        @else
        <div class="h-[200px]"></div>
    @endif
    
</x-modal.card>



<x-modal.card align="center" blur wire:model="hasError">
    

    @if ($errorType == 'not-found')
        <x-error-content :image="'not-found.png'" :message="$errorMessage" />
    @endif
    @if ($errorType == 'exception')
        <x-error-content :image="'error.png'" :message="$errorMessage" />
    @endif
    @if ($errorType == 'expired')
        <x-error-content :image="'expired.png'" :message="$errorMessage" />
    @endif


    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">


            <div class="flex">

                <x-button positive label="I Understand" x-on:click="close" />
            </div>
        </div>
    </x-slot>

</x-modal.card>

<x-modal.card align="center" blur wire:model="isExpired">
    
    <x-error-content :image="'expired.png'" :message="$errorMessage" />

    


    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">


            <div class="flex">

                <x-button positive label="I Understand" x-on:click="close" />
            </div>
        </div>
    </x-slot>

</x-modal.card>
<script>
    document.addEventListener('livewire:load', function () {
        window.closeSuccessModal = function () {
            @this.set('hasError', false);
        }
        window.closeExpiration = function () {
            @this.set('isExpired', false);
        }

        Livewire.on('closeSuccessModalAfterDelay', function () {
            setTimeout(function () {
                closeSuccessModal();
            }, 2000); // 3000 milliseconds = 3 seconds
        });
        
        Livewire.on('closeExpirationModalAfterDelay', function () {
            setTimeout(function () {
                closeExpiration();
            }, 2000); // 3000 milliseconds = 3 seconds
        });

        Livewire.on('triggerClose', function () {
            setTimeout(function () {
                @this.call('clearInformation'); 
            }, 3000); // 3000 milliseconds = 3 seconds
        });
    });
</script>
</div>


     

{{-- //end start update --}}


{{-- <div class="flex items-center justify-center ">
    <div class="border-green-500 rounded p-4">
        @livewire('test-live-wire')
    </div>
</div> --}}
{{-- 
<div class="min-h-screen relative bg-white   ">

    
    <div class="flex items-center justify-center">

        <h1 class="text-4xl font-bold text-gray-800  mt-[2%] ">University Learning Resource Center</h1>
    </div>


    <div class="flex flex-col items-center justify-center mt-8 text-center min-h-[100px]">
        @if ($student != null && $todayRecord != null)
            <div class="max-w-2xl  rounded p-4">
                <p class="text-xl text-green-700 font-bold">
                    {{ ucfirst($student?->last_name) ?? '' }} , {{ $student?->middle_name ?? '' }}
                    {{ $student?->first_name ?? '' }}
                </p>

                <p class="text-lg text-green-700">

                    {{ $student->year ?? '' }}, {{ $student?->course?->name ?? '' }}
                </p>
            </div>
            <div class=" p-2 bg-green-50 text-green-600  rounded min-w-[120px] ">

                @if ($studentLoginRecord = $this->student->logins()->latest()->first())
                    @if ($studentLoginRecord->logout)
                        @if ($studentLoginRecord->logout->status == 'Logged out')
                            Has Been logged in
                        @else
                            Has Been logged out
                        @endif
                    @endif
                @else
                    Has Been logged in
                @endif

            </div>
        @endif
        @if ($hasError)
            <div class=" p-2 bg-red-50 text-red-600  rounded min-w-[120px] capitalize ">
                @if ($errorType == 'not-found')
                    {{ $errorMessage }}
                @endif
                @if ($errorType == 'exception')
                    {{ $errorMessage }}
                @endif
            </div>

        @endif
    </div>



    <div class="max-w-[1200px]   mx-auto mt-8">
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
                        @endif

                    </div>




                 
                </div>
                <div class="p-10  sksu-primary col-span-6 flex items-center justify-center min-h-[560px]">
                    <img src="{{ asset('/images/sksulogo.png') }}" alt="" class="w-[300px] h-[300px]">
                </div>
            </section>

        </div>
    </div> --}}


   

    {{-- 
    <x-modal.card align="center" z-index="z-50" blur wire:model="isConfirmationShow" show="true">
        @if ($student != null && $todayRecord != null)
        <h1 class="text-xl text-center">Are you sure you want to proceed? @if ($studentLoginRecord = $this->student->logins()->latest()->first())
            @if ($studentLoginRecord->logout)
                @if ($studentLoginRecord->logout->status == 'Logged out')
                        In
                @else   
                        Out
                @endif
            @endif
    @else
        In
    @endif
            @endif
</h1>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">

                <div class="flex">
                 
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

    </x-modal.card> --}}

    {{-- 
    <x-modal.card align="center" blur z-index="z-40" wire:model="isSuccess" max-width="6xl" show="true"
        spacing="">
        @if ($student != null && $todayRecord != null)
            <div class="modal-c rounded-md px-6 py-2 relative">

                <p class="uppercase text-3xl text-green-900 text-center tracking-tight pb-10"> 
                    {{ now()->timezone('Asia/Manila')->format('F d, Y ( h:i A )') }}
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
                                        @if ($studentLoginRecord->logout->status == 'Logged out')
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
                        <div class="flex items-center text-green-900 justify-between  ">
                            <P class="mt-2 text-md   capitalize"">
                                Campus
                            </P>
                            <P class="mt-2 text-xl ">
                                {{ $student?->course?->campus->name }}
                            </P>

                        </div>

                    </div>
                </div>


            </div>


        @endif
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">

                <div class="flex">
                    <x-button class="bg-green-700 ok transition-all outline-none  ring-0 focus:ring-0 "
                        spinner="showConfirmation" primary label="Confirm" wire:click="showConfirmation" />
                    
                </div>
            </div>
        </x-slot>
    </x-modal.card>  --}}

{{-- </div> --}}
 {{-- //end before update --}}


 
