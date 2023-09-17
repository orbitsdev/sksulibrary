
<div class="min-h-screen relative bg-white   ">
    <div class=" border-green-500  rounded flex items-center justify-center  ">
        @livewire('test-live-wire')
    </div>
    <div class="max-w-[1200px]   mx-auto h-screen">
        <div class=" h-full flex justify-center items-center ">

            <section class="grid grid-cols-12 w-[80%] content-center items-stretch shadow-2xl ">
                <div class="px-10 pb-2 pt-12 bg-gray-50 col-span-6   ">



                    <p class="uppercase text-3xl text-gray-500 text-center tracking-tight pb-10">  Library Management System
                        </p>
                  <div class="flex justify-center mt-2">

                            <svg class="h-24 w-24 fill-gray-500 "  id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.61 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>qr-code-scan</title><path class="cls-1" d="M26.68,26.77H51.91V51.89H26.68V26.77ZM35.67,0H23.07A22.72,22.72,0,0,0,14.3,1.75a23.13,23.13,0,0,0-7.49,5l0,0a23.16,23.16,0,0,0-5,7.49A22.77,22.77,0,0,0,0,23.07V38.64H10.23V23.07a12.9,12.9,0,0,1,1-4.9A12.71,12.71,0,0,1,14,14l0,0a12.83,12.83,0,0,1,9.07-3.75h12.6V0ZM99.54,0H91.31V10.23h8.23a12.94,12.94,0,0,1,4.9,1A13.16,13.16,0,0,1,108.61,14l.35.36h0a13.07,13.07,0,0,1,2.45,3.82,12.67,12.67,0,0,1,1,4.89V38.64h10.23V23.07a22.95,22.95,0,0,0-6.42-15.93h0l-.37-.37a23.16,23.16,0,0,0-7.49-5A22.77,22.77,0,0,0,99.54,0Zm23.07,99.81V82.52H112.38V99.81a12.67,12.67,0,0,1-1,4.89,13.08,13.08,0,0,1-2.8,4.17,12.8,12.8,0,0,1-9.06,3.78H91.31v10.23h8.23a23,23,0,0,0,16.29-6.78,23.34,23.34,0,0,0,5-7.49,23,23,0,0,0,1.75-8.8ZM23.07,122.88h12.6V112.65H23.07A12.8,12.8,0,0,1,14,108.87l-.26-.24a12.83,12.83,0,0,1-2.61-4.08,12.7,12.7,0,0,1-.91-4.74V82.52H0V99.81a22.64,22.64,0,0,0,1.67,8.57,22.86,22.86,0,0,0,4.79,7.38l.31.35a23.2,23.2,0,0,0,7.5,5,22.84,22.84,0,0,0,8.8,1.75Zm66.52-33.1H96v6.33H89.59V89.78Zm-12.36,0h6.44v6H70.8V83.47H77V77.22h6.34V64.76H89.8v6.12h6.12v6.33H89.8v6.33H77.23v6.23ZM58.14,77.12h6.23V70.79h-6V64.46h6V58.13H58.24v6.33H51.8V58.13h6.33V39.33h6.43V58.12h6.23v6.33h6.13V58.12h6.43v6.33H77.23v6.33H70.8V83.24H64.57V95.81H58.14V77.12Zm31.35-19h6.43v6.33H89.49V58.12Zm-50.24,0h6.43v6.33H39.25V58.12Zm-12.57,0h6.43v6.33H26.68V58.12ZM58.14,26.77h6.43V33.1H58.14V26.77ZM26.58,70.88H51.8V96H26.58V70.88ZM32.71,77h13V89.91h-13V77Zm38-50.22H95.92V51.89H70.7V26.77Zm6.13,6.1h13V45.79h-13V32.87Zm-44,0h13V45.79h-13V32.87Z"/></svg>
                        </div>
                    <div class="mt-7">
                        <p for="name" class="block font-medium text-sm  text-gray-500"> ID Number </p>


                        <x-input  wire:model.debounce.700ms="barcode" autofocus
                            class="block border-gray-300 active:border-green-600 focus:border-green-600 outline-emerald-500 p-2 mt-1 w-full h-12" />
                    </div>
                    <div class="text-center mt-4 flex items-center justify-center">
                        <p class="text-xs  text-gray-500 mr-4">Auto-Trigger: Active by default, Click to Take Control</p>
                        <x-toggle lg wire:model="isManualInputBarCode" class="swithlabel" />
                    </div>
                    
                    

                    <div class="mt-6 flex justify-end h-10   ">
                        @if($isManualInputBarCode)
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

    

<x-modal.card align="center" z-index="z-50"  blur wire:model="isConfirmationShow" show="true" >
    <h1 class="text-xl text-center">Are you sure you 
        want to proceed?</h1>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
    
                    <div class="flex">
                        {{-- <x-button flat label="Cancel" x-on:click="close" /> --}}
                        <x-button wire:click="processLog" spinner="processLog" 
                        icon="check" 
                        class="sk-button max-h-14 px-[34px] py-[12px]  w-full justify-center capitalize mr-2 ">
                        Yes
                    </x-button>
                        <x-button wire:click="cancelProcess" spinner="cancelProcess" 
                        icon="x" 
                        class="sk-button max-h-14 px-[34px] py-[12px]  w-full justify-center capitalize">
                        No
                    </x-button>
                    </div>
                </div>
            </x-slot>

</x-modal.card>


    <x-modal.card align="center" blur  z-index="z-40" wire:model="isSuccess" max-width="6xl" show="true" 
        spacing="p-20">
        @if ($student != null && $todayRecord != null)
            <div class="modal-c rounded-md p-6 relative">
                <P class="text-3xl font-bold uppercase text-center ">
                    {{ now()->timezone('Asia/Manila')->format('F d, Y') }}

                </P>
                <div class="relative">
                    <img src="{{ asset('images/sksulogo.png') }}" alt="sksu-logo.png"
                    class="w-24 h-24 mx-auto absolute top-[-45px]  right-5">    
                   
                      
                </div>

                <div class="grid grid-cols-2 ">

                    <div class="mt-6 flex-2  flex items-center justify-center h-[300px] w-full  pr-16 ">
                            
                        <div class="w-[400px] h-[300px] rounded relative">
                          @if(!empty($student->profile))
                            <img src="{{ Storage::disk('public')->url($student->profile) }}" alt="profile.jpg"
                            class="h-full w-full object-cover rounded">
                            
                            @else
                            <img src="{{ asset('/images/placeholder.jpg') }}" alt="profile.jpg"
                            class="h-full w-full object-cover rounded">
                            <p class="text-center">NO PROFILE</p>

                            @endif
                          
                        </div>
                    </div>




                    <div class="mt-2 ">
                        <div class="mm  relative text-center text-white text-xl font-bold uppercase pt-4">
                         
                            <div
                            class="bg-white rounded-full w-[70px] h-[70px] text-green-700 text-3xl p-1 inline-flex items-center justify-center uppercase">
                            @if ($studentLoginRecord = $this->student->logins()->latest()->first())
                            
                            @php
                            $logoutrecord = $studentLoginRecord->logout;
                            @endphp
                                 @if ($logoutrecord && $logoutrecord->status == 'Logged out')
                                 Out
                                 @else
                                 In
                                 @endif
                            @endif
                        </div>

                            
                        </div>
                      
                      

                       
                    


                        <div class="  mt-4">
                            <P class="text-4xl text-center p-0 font-semibold capitalize">
                                {{$student?->last_name}} , {{$student?->middle_name}} {{$student?->first_name}} 
                            </P>

                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <P class="mt-2 text  capitalize">
                               ID Number
                            </P>
                            <P class="mt-2 text-xl ">
                             {{$student?->id_number}}
                            </P>

                        </div>
                     
                        <div class="flex items-center justify-between  ">
                            <P class="mt-2 text-md   capitalize"">
                               Course
                            </P>
                            <P class="mt-2 text-xl ">
                             {{$student?->course?->name}}
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
                    <x-button class="bg-green-700 ok transition-all" spinner="showConfirmation" primary label="Confirm" 
                       wire:click="showConfirmation" 
                        
                        />
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



{{-- <div class="h-screen ">

    <div class="container mx-auto h-full ">
        <div class="xl:px-12 xl:py-8 flex justify-end">
            <div class=" border-green-500  border-2 rounded flex items-center justify-center mr-6 p-4 ">
                @livewire('test-live-wire')
            </div>
        
            <a href="/admin"
                class="flex items-center justify-center bg-green-500 shadow hover:shadow-xl text-white w-36 rounded-lg hover:scale-105  hover:bg-green-600   hover:text-white transition-all  ">
                <div>

                    Admin 
                </div>
            </a>
        </div>
        <div class="grid grid-cols-2 relative ">
            <div class="h-full p-12 flex items-center justify-center flex-col w-full">
                <div class="h-28">

                    <p id="textSwap" class="text-4xl font-bold c-font text-center transition-opacity duration-1000"> " Science is not only a disciple of reason but also one of romance and passion "</p>
                </div>

                <div class="w-full relative  rounded-xl  bg-white shadow-xl xl:mt-30 lg:mt-20 pl-8  flex items-center justify-center">
                    <input type="text" placeholder="xxx-xxx-xxx" wire:model.debounce.700ms="barcode" autofocus class="w-full rounded c-field border-none py-5 text-lg outline-none focus:outline-none" style="outline: none; box-shadow: none;">
                    <div class="bg-green-500 text-white rounded-lg  h-full py-6 text-center text-lg w-40"> Barcode</div>

            
                </div>

                <div class="mt-16  w-full ">
                    
                    <div class="flex justify-center">
                        <x-toggle lg wire:model="isManualInputBarCode"  label="Use Manual Barcode Input"/>

                    </div>

                    <div class="mt-8 h-14 w-full flex justify-center">
                    @if ($isManualInputBarCode)
                        <x-button green class="w-6/12 py-4  bg-green-500 bhover hover:bg-gray-600 text-white hover:shadow-lg transition-all "   label="Read Bar Code" wire:click="readBarCodeManually" spinner="readBarCodeManually"   /> 
                        @endif
                    </div>


                    

                      
                      
                </div>
            </div>

            <div class="h-full pt-12 flex items-center justify-center flex-col ">
                <svg width="500" height="500" viewBox="0 0 287 349" fill="none" xmlns="http://www.w3.org/2000/svg" >
                    <g clip-path="url(#clip0_21_362)">
                        <path
                            d="M0.486059 138.893C0.486059 138.893 5.6077 31.6867 90.3974 46.3067C175.187 60.9268 177.117 2.03885 221.04 0.0135743C263.307 -1.93558 335.067 194.084 236.921 291.417C152.901 374.747 77.5906 359.151 37.1123 295.315C-3.36604 231.479 0.486059 138.893 0.486059 138.893Z"
                            fill="#F5F5FC" />
                        <path
                            d="M76.6881 165.203V177.05H73.7141L70.3296 165.203H62.6145V124.618L138.575 125.042V165.317H130.691L127.624 177.05H124.664L124.982 165.211L76.6881 165.203Z"
                            fill="#3A1313" />
                        <path d="M133.831 128.59H66.8445V144.132H133.831V128.59Z" fill="#671C1C" />
                        <path d="M72.3331 130.126H68.8942V142.501H72.3331V130.126Z" fill="#EEDF56" />
                        <path d="M77.5445 130.126H74.1056V142.501H77.5445V130.126Z" fill="#EEDF56" />
                        <path d="M80.872 130.359L78.4565 132.807L87.2645 141.499L89.68 139.051L80.872 130.359Z"
                            fill="#EEDF56" />
                        <path d="M104.936 134.753H91.1016V137.235H104.936V134.753Z" fill="#EEDF56" />
                        <path d="M104.936 138.436H91.1016V142.501H104.936V138.436Z" fill="#EEDF56" />
                        <path d="M133.831 146.296H66.8445V161.837H133.831V146.296Z" fill="#671C1C" />
                        <path d="M83.2995 147.878H81.1682V160.252H83.2995V147.878Z" fill="#EEDF56" />
                        <path d="M80.1895 151.616H78.0582V160.255H80.1895V151.616Z" fill="#EEDF56" />
                        <path d="M87.5077 147.878H84.0688V160.252H87.5077V147.878Z" fill="#EEDF56" />
                        <path d="M115.042 148.687L109.056 159.518L112.066 161.181L118.052 150.351L115.042 148.687Z"
                            fill="#EEDF56" />
                        <path d="M132.352 152.458H118.518V154.94H132.352V152.458Z" fill="#EEDF56" />
                        <path d="M132.352 156.142H118.518V160.206H132.352V156.142Z" fill="#EEDF56" />
                        <path d="M116.519 117.08H102.685V119.562H116.519V117.08Z" fill="#222122" />
                        <path d="M116.519 120.764H102.685V124.828H116.519V120.764Z" fill="#222122" />
                        <path d="M143.473 177.05H223.209V61.949H142.413L143.473 177.05Z" fill="#3A1313" />
                        <path d="M217.351 67.2799H147.777V100.666H217.351V67.2799Z" fill="#671C1C" />
                        <path d="M217.598 140.228H148.024V173.614H217.598V140.228Z" fill="#671C1C" />
                        <path d="M217.598 104.067H148.024V137.452H217.598V104.067Z" fill="#671C1C" />
                        <path d="M215.6 105.524H149.669V135.509H215.6V105.524Z" fill="#3A1313" />
                        <path d="M158.153 71.287H151.607V99.3581H158.153V71.287Z" fill="#EEDF56" />
                        <path d="M166.79 71.287H160.244V99.3581H166.79V71.287Z" fill="#EEDF56" />
                        <path d="M168.258 144.327H161.712V172.399H168.258V144.327Z" fill="#EEDF56" />
                        <path d="M170.589 167.359L170.548 172.173L198.618 172.413L198.659 167.599L170.589 167.359Z"
                            fill="#EEDF56" />
                        <path d="M212.128 143.044L200.098 170.7L204.512 172.62L216.543 144.965L212.128 143.044Z"
                            fill="#EEDF56" />
                        <path d="M170.898 163.475L170.863 166.931L198.934 167.211L198.969 163.756L170.898 163.475Z"
                            fill="#EEDF56" />
                        <path
                            d="M164.985 170.988C165.797 170.988 166.455 170.329 166.455 169.517C166.455 168.705 165.797 168.046 164.985 168.046C164.173 168.046 163.514 168.705 163.514 169.517C163.514 170.329 164.173 170.988 164.985 170.988Z"
                            fill="#671C1C" />
                        <path
                            d="M173.32 171.069C173.938 171.069 174.44 170.568 174.44 169.949C174.44 169.331 173.938 168.829 173.32 168.829C172.701 168.829 172.2 169.331 172.2 169.949C172.2 170.568 172.701 171.069 173.32 171.069Z"
                            fill="#671C1C" />
                        <path
                            d="M203.223 170.637C203.842 170.637 204.343 170.136 204.343 169.517C204.343 168.898 203.842 168.397 203.223 168.397C202.604 168.397 202.103 168.898 202.103 169.517C202.103 170.136 202.604 170.637 203.223 170.637Z"
                            fill="#671C1C" />
                        <path d="M186.557 91.9734L186.461 98.5188L214.529 98.9303L214.625 92.3849L186.557 91.9734Z"
                            fill="#EEDF56" />
                        <path d="M186.515 87.5243L186.46 91.27L214.528 91.6815L214.583 87.9359L186.515 87.5243Z"
                            fill="#EEDF56" />
                        <path
                            d="M163.517 96.2699C164.329 96.2699 164.987 95.6114 164.987 94.7992C164.987 93.9869 164.329 93.3285 163.517 93.3285C162.704 93.3285 162.046 93.9869 162.046 94.7992C162.046 95.6114 162.704 96.2699 163.517 96.2699Z"
                            fill="#671C1C" />
                        <path
                            d="M210.971 97.1915C211.783 97.1915 212.441 96.5331 212.441 95.7208C212.441 94.9086 211.783 94.2501 210.971 94.2501C210.158 94.2501 209.5 94.9086 209.5 95.7208C209.5 96.5331 210.158 97.1915 210.971 97.1915Z"
                            fill="#671C1C" />
                        <path
                            d="M210.971 90.7813C211.478 90.7813 211.89 90.3699 211.89 89.8625C211.89 89.355 211.478 88.9436 210.971 88.9436C210.463 88.9436 210.052 89.355 210.052 89.8625C210.052 90.3699 210.463 90.7813 210.971 90.7813Z"
                            fill="#671C1C" />
                        <path
                            d="M154.88 96.2699C155.692 96.2699 156.351 95.6114 156.351 94.7992C156.351 93.9869 155.692 93.3285 154.88 93.3285C154.068 93.3285 153.409 93.9869 153.409 94.7992C153.409 95.6114 154.068 96.2699 154.88 96.2699Z"
                            fill="#671C1C" />
                        <path d="M182.565 105.252H180.937V136.069H182.565V105.252Z" fill="#671C1C" />
                        <path
                            d="M176.239 122.952C176.912 122.952 177.457 122.407 177.457 121.734C177.457 121.061 176.912 120.516 176.239 120.516C175.567 120.516 175.021 121.061 175.021 121.734C175.021 122.407 175.567 122.952 176.239 122.952Z"
                            fill="#671C1C" />
                        <path
                            d="M186.183 122.952C186.856 122.952 187.401 122.407 187.401 121.734C187.401 121.061 186.856 120.516 186.183 120.516C185.511 120.516 184.966 121.061 184.966 121.734C184.966 122.407 185.511 122.952 186.183 122.952Z"
                            fill="#671C1C" />
                        <path d="M197.476 285.673L204.272 258.76H197.476L195.301 285.673H197.476Z" fill="#3A1313" />
                        <path d="M236.079 258.216L243.69 256.585L244.778 280.779H242.331L236.079 258.216Z"
                            fill="#3A1313" />
                        <path
                            d="M196.932 236.46C196.932 236.46 184.427 239.178 184.699 247.606C184.971 256.033 190.408 259.023 208.35 259.567C226.292 260.111 242.603 258.479 248.584 254.402C254.564 250.324 256.196 238.091 255.652 234.013C255.108 229.935 251.03 208.731 255.652 196.77C260.273 184.808 262.176 177.197 261.632 176.109C261.089 175.022 258.098 167.41 248.584 175.294C239.069 183.177 226.02 197.585 224.117 214.44C223.628 218.771 215.72 215.799 210.525 215.799C205.33 215.799 199.107 214.984 195.301 220.964C191.245 227.342 192.311 233.741 196.932 236.46Z"
                            fill="#222122" />
                        <path
                            d="M189.593 239.45C189.593 239.45 223.527 249.878 239.341 244.343C255.959 238.52 254.6 244.912 255.521 239.82C256.016 237.085 255.853 232.447 255.23 231.167C254.782 230.248 248.084 232.798 241.796 235.084C230.131 239.347 207.543 237.55 201.834 233.472C196.125 229.394 194.412 222.941 194.412 222.941C194.412 222.941 190.063 230.104 195.834 235.296C197.487 236.786 194.298 237.142 192.276 237.909C190.253 238.675 189.593 239.45 189.593 239.45Z"
                            fill="#BDAEBD" />
                        <path
                            d="M30.1339 285.238L38.5422 310.46H50.6395L57.6124 285.238L42.2339 279.904L30.1339 285.238Z"
                            fill="#F09642" />
                        <path
                            d="M37.6886 264.626C37.6886 264.626 6.04537 268.394 0.00488281 299.8C0.00488281 299.8 52.5098 291.009 47.2332 277.441C41.9566 263.873 37.6886 264.626 37.6886 264.626Z"
                            fill="#3A5F2D" />
                        <path
                            d="M51.5284 271.691C51.5284 271.691 47.5785 235.756 16.1418 229.068C16.1418 229.068 25.2379 288.663 38.7733 282.601C52.3086 276.538 51.5284 271.691 51.5284 271.691Z"
                            fill="#3A5F2D" />
                        <path
                            d="M39.366 266.241C39.366 266.241 48.4185 242.046 68.3478 244.169C74.7906 244.854 71.224 257.49 71.224 257.49L65.2623 251.14C65.2623 251.14 58.3084 279.458 51.5366 278.713C44.7649 277.968 39.366 266.241 39.366 266.241Z"
                            fill="#3A5F2D" />
                        <path
                            d="M42.9924 283.036C42.9924 283.036 69.688 293.814 65.4173 313.891C65.4173 313.891 79.5833 299.735 65.8794 279.909C52.1755 260.083 47.6057 272.463 47.6057 272.463L42.9924 283.036Z"
                            fill="#3A5F2D" />
                        <path
                            d="M53.6706 262.421C53.6706 262.421 80.5837 257.8 84.637 261.388C88.6902 264.977 81.6466 280.583 76.7343 283.036C76.7343 283.036 78.6563 276.943 78.6563 273.099C78.6563 269.256 64.5636 281.002 63.0685 281.002C61.5733 281.002 51.5366 267.334 51.5366 267.334L53.6706 262.421Z"
                            fill="#3A5F2D" />
                        <path
                            d="M41.5978 275.416C41.5978 275.416 54.9782 254.252 60.9589 248.804C64.3488 245.716 67.9372 248.486 70.2017 251.477"
                            stroke="#5BCC34" stroke-width="0.815547" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M41.5978 275.416C41.5978 275.416 69.9054 264.612 77.9766 264.08C82.5518 263.778 83.6175 267.924 80.3607 276.557"
                            stroke="#5BCC34" stroke-width="0.815547" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M41.5978 275.416C41.5978 275.416 54.4535 279.684 60.9996 284.438C63.3729 286.165 68.5706 291.585 68.2036 301.502"
                            stroke="#5BCC34" stroke-width="0.815547" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M21.6957 235.894C21.6957 235.894 24.474 243.463 30.5308 248.823C33.9642 251.863 39.5942 264.99 41.5977 275.416"
                            stroke="#5BCC34" stroke-width="0.815547" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M8.32886 293.589C8.32886 293.589 13.1188 286.646 19.8797 282.206C26.3497 277.957 31.5692 274.578 41.5977 275.41"
                            stroke="#5BCC34" stroke-width="0.815547" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_21_362">
                            <rect width="286.188" height="348.641" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </div>

            

        </div>

    </div>

    
<x-modal.card align="center" max-width="6xl" blur="false" wire:model.defer="isSuccess">

    @if ($student != null && $todayRecord != null)



        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-1 bg-red-400 " style="height:500px">
                <img class="h-full bg-gray-50 object-cover  lg:inset-y-0 lg:left-0  lg:w-1/2"
                    src="{{ asset('images/girl.jpg') }}" alt="" style="width:100%">

            </div>


            <div class="col-span-1 h-full">
                <div class="text-center">
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl capitalize">
                        {{ $student->first_name }} {{ $student->last_name }} </p>
                    <p class="mt-0.5 mr-2 text-lg leading-8 text-gray-900 capitalize"> {{ $student->course->name }}
                    </p>
                </div>




                <div class="mt-4">

                    <x-details-card :title="'ID NO.'" :body="$student->id_number" />
                    <x-details-card :title="'Year'" :body="$student->year" />





                    @if ($studentLoginRecord = $this->student->logins()->latest()->first())
                        <div class="shadow rounded py-3 px-6 mt-1 bg-green-100">
                            <div class="text-center">
                                <div class="text-md leading-6 text-green-900">Time in</div>
                                <div class="order-first text-2xl text-green-900 font-semibold tracking-tight">
                                    {{ $studentLoginRecord->created_at->timezone('Asia/Manila')->format('h:i A - l') }}
                                </div>

                            </div>
                        </div>
                </div>

                @php
                    $logoutrecord = $studentLoginRecord->logout;
                @endphp

                @if ($logoutrecord && $logoutrecord->status == 'Logged out')
                    <div class="shadow rounded py-3 px-6 mt-1 bg-red-100">
                        <div class="text-center">

                            <div class="text-md leading-6 text-red-900">Time out</div>
                            <div class="order-first text-2xl text-red-900 font-semibold tracking-tight ">
                                {{ $logoutrecord->updated_at->timezone('Asia/Manila')->format('h:i A - l') }}</div>
                        </div>
                    </div>
                @endif
    @endif




    <div class="px-6 py-2 flex items-center justify-center mt-4 ">
        <svg width="40" height="40" viewBox="0 0 168 133" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M141.995 0L63 80.969L25.998 45.892L0 71.904L63 133L168 26.005L141.995 0Z" fill="#4FA65B" />
        </svg>

    </div>
    </div>
    </div>
    @endif
    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <div class="flex">
                <x-button label="Continue" positive x-on:click="close" />
            </div>
        </div>
    </x-slot>
</x-modal.card>



</div>

<script>


    
    var sentences = [
        "\" Science is not only a disciple of reason but also one of romance and passion\"",
        "\"The beauty of science is in its endless exploration\"",
        "\"In the realm of science, possibilities become realities\"",
    ];

    var currentIndex = 0;
    var textElement = document.getElementById("textSwap");

    function updateText() {
        textElement.classList.remove("fade-in");
        textElement.classList.add("fade-out");

        setTimeout(function() {
            textElement.textContent = sentences[currentIndex];
            currentIndex = (currentIndex + 1) % sentences.length;

            textElement.classList.remove("fade-out");
            textElement.classList.add("fade-in");
        }, 500); // Delay before fading in the next text
    }

    updateText();
    setInterval(updateText, 10000);
</script> --}}
