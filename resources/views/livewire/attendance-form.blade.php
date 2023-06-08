<div>


    <div class="flex items-center justify-center h-screen  w-full">

        <div class="w-1/2">

            <x-card >


              

                
{{-- 
                <x-input  wire:model.debounce.700ms="barcode"  autofocus label="Barcode"/>
                <div class="p-4">
                    {{$barcode}}

                </div>
                <x-button dark label="Save" wire:click="save" spinner="save" /> --}}
                <x-button dark label="Save" wire:click="showModalForm" spinner="showModalForm" /> 
                {{
                    $showModal
                }}
             
            </x-card>
        </div>
    </div>
    <x-modal.card align="center"   max-width="6xl" blur="false" wire:model.defer="showModal">



        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-1 bg-red-400 " style="height:500px">
                <img class="h-full bg-gray-50 object-cover  lg:inset-y-0 lg:left-0  lg:w-1/2" src="{{asset('images/girl.jpg')}}" alt="" style="width:100%">

            </div>

            <div class="col-span-1 h-full">
                <div class="text-center">
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Maria Kate Jesisca </p>
                    <p class="mt-0.5 mr-2 text-lg leading-8 text-gray-900">Bachelor of Science in Information  Technology</p>
                </div>

{{-- 
                <div class="mt-10">
                    <div class="flex flex-col mb-4 col-span-2 border-l border-gray-900/10 pl-6">
                        <dt class="text-lg leading-6 text-gray-900">123213123</dt>
                        <dd class="order-first text-2xl font-semibold tracking-tight text-gray-900">ID NO. </dd>
                    </div>
                   
                </div> --}}


            
                <div class="mt-2.5 shadow rounded py-4 px-6">
                    <div>

                        <div class="order-first text-2xl text-gray-900 font-semibold tracking-tight ">12312312323 </div>
                        <div class="mt-1 text-lg leading-6  text-gray-600">ID NO.</div>
                    </div>
                </div>
                <div class="mt-2.5 shadow rounded py-4 px-6">
                    <div>

                        <div class="order-first text-2xl text-gray-900 font-semibold tracking-tight ">  1st Year </div>
                        <div class="mt-1 text-lg leading-6  text-gray-600">Year</div>
                    </div>
                </div>
                <div class="mt-2.5 shadow rounded py-4 px-6">
                    <div>

                        <div class="order-first text-2xl text-gray-900 font-semibold tracking-tight "> Male </div>
                        <div class="mt-1 text-lg leading-6  text-gray-600">Gender</div>
                    </div>
                </div>
                <div class="mt-2.5 shadow rounded py-4 px-6">
                    <div>

                        <div class="order-first text-2xl text-gray-900 font-semibold tracking-tight "> Isulan </div>
                        <div class="mt-1 text-lg leading-6  text-gray-600">Campus</div>
                    </div>
                </div>



            

                
            </div>

        </div>


        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
        
     
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    {{-- <x-button green  label="Save" wire:click="save" /> --}}
                    <x-button label="Save" positive icon="arrow-circle-down" wire:click="save" />
                </div>
            </div>
        </x-slot>

       
        {{-- <div class="grid grid-cols-2 gap-4">
            <div class="h-10 bg-red-400 col-span-1 ">

                <img class=" bg-gray-50 object-cover  lg:inset-y-0 lg:left-0  lg:w-1/2" src="{{asset('images/girl.jpg')}}" alt="" style="max-height:450px; width:100%">

            </div>
            <div class="col-span-1">
              <div class="px-6 pb-10 pt-16 sm:pb-32 sm:pt-20 lg:col-start-2 lg:px-8 lg:pt-10">
                <div class="mx-auto max-w-2xl lg:mr-0 lg:max-w-lg ">
               
                <div class="mt-8 min-h-96 bg-blue-400">
                    <div class="flex flex-col mb-4 col-span-2 border-l border-gray-900/10 pl-6">
                        <dt class="text-lg leading-6 text-gray-900">123213123</dt>
                        <dd class="order-first text-2xl font-semibold tracking-tight text-gray-900">ID NO. </dd>
                    </div>
                    {{-- <div class="flex flex-col mb-4 col-span-2 border-l border-gray-900/10 pl-6">
                        <dt class="text-lg leading-6 text-gray-900">Male</dt>
                        <dd class="order-first text-2xl font-semibold tracking-tight text-gray-900">Gender</dd>
                    </div>
                    <div class="flex flex-col mb-4 col-span-2 border-l border-gray-900/10 pl-6">
                        <dt class="text-lg leading-6 text-gray-900">Isulan</dt>
                        <dd class="order-first text-2xl font-semibold tracking-tight text-gray-900">Campus </dd>
                    </div>
                    <div class="flex flex-col  col-span-2 border-l border-gray-900/10 pl-6">
                        <dt class="text-lg leading-6 text-gray-900"> Student </dt>
                        <dd class="order-first text-2xl font-semibold tracking-tight text-gray-900">Status </dd>
                    </div> --}}
                    
                {{-- </div>
                  
                 
                </div>
              </div>
            </div>
          </div>  --}}
         

        {{-- <div class="h-64 bg-cover rounded relative" style="background-image: url('{{ asset('images/sksu-building1.jpg') }}');">
            <div class="absolute left-20" style="bottom: -5rem; ">
                <img src="{{asset('/images/logo.png')}}" alt="" class="w-64 h-64 rounded-full">
            </div>
        </div>
 --}}
        
       
    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="flex justify-center">
            <div class="flex flex-col items-center">
                <div class="flex justify-center">
                    <img src="{{asset('/images/logo.png')}}" alt="" class="w-64 h-64 rounded-full">
                </div>
                <div class="flex justify-center">
                    <x-button dark label="Take Photo" wire:click="takePhoto" spinner="takePhoto" />
                </div>
            </div> --}}
        
       
    </x-modal.card>
</div>