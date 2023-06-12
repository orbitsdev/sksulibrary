<x-filament::page>

<style>
    @media print {
      body * {
        visibility: hidden;
      }
  
      .b {
        visibility: hidden;
      }
  
      .print-container,
      .print-container * {
        visibility: visible;
      }
  
      .print-container {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
      }
    }
  </style>

<div class=" flex justify-end w-full b  ">
  <x-button rose spinner="print" wire:click="print" style="background: #03A340">Print</x-button>
</div>
    <main class="print-container  p-10 bg-white" style="padding: 20px 10px ">

        <div class="flex justify-center p-6">
            <div class="mr-10">
              <img src="{{ asset('images/logo.png') }}" alt="" style="width: 60px; height: 60px">
            </div>
            <div class="text-center " style="padding: 0px 20px 0px 20px  ">
              <p>Republic of The Philippines</p>
              <p class="uppercase">Sultan Kudarat State University</p>
             
             
            
            </div>
            <div class="ml-10">
              <img src="{{ asset('images/sksulogo2.png') }}" alt="" style="width: 60px; height: 60px">
            </div>
          </div>
        <div class="mx-auto max-w-3xl">
          {{-- <div class="max-w-xl">
            <h1 class="text-base font-medium text-indigo-600">Thank you!</h1>
            <p class="mt-2 text-4xl font-bold tracking-tight">It's on the way!</p>
            <p class="mt-2 text-base text-gray-500">Your order #14034056 has shipped and will be with you soon.</p>
      
            <dl class="mt-12 text-sm font-medium">
              <dt class="text-gray-900">Tracking number</dt>
              <dd class="mt-2 text-indigo-600">51547878755545848512</dd>
            </dl>
          </div> --}}
      
          <section aria-labelledby="order-heading" class=" border-t border-gray-200">
            
      
            <h3 class="sr-only">Items</h3>
            <div class="flex space-x-6 border-b border-gray-200 py-10">
              <img src="{{asset('images/girl.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="flex-none rounded-lg bg-gray-100 object-cover object-center mr-10 " style="width: 144px; height:144px">
              <div class="flex flex-auto flex-col">
                <div>

                    <div class="flex items-center mt-1">
                        <p class="w-16 border-r mr-4"> ID </p>
                          <p class="italic font-semibold"> {{$student->id_number}}  
                            
                        </p>
                    </div>
                    {{-- <p class="text-gray-900 font-semibold"> ID:<span class="italic font-semibold "> {{$student->id_number }}</span></p> --}}
                  
                  <div class="flex items-center mt-1">
                    <p class="w-16 border-r mr-4"> Name  </p>
                      <p class=""> {{$student->first_name}},  {{$student->last_name}} {{$student->middle_name}} 
                        
                    </p>
                </div>
                  <div class="flex items-center mt-1">
                    <p class="w-16 border-r mr-4"> Course  </p>
                      <p class=""> {{$student->course->name}} 
                        
                    </p>
                </div>
                  <div class="flex items-center mt-1">
                    <p class="w-16 border-r mr-4"> Year  </p>
                      <p class=""> {{$student->year}}
                        
                    </p>
                </div>
                 
                  {{-- <p class="">Phone Number{{$student->contact_number }}</p> --}}
                </div>
             
              </div>
            </div>
      
            <div class="">
        
            <p  class="mt-4">  </p>
              <dl class="grid grid-cols-2 gap-x-4 py-8 ">
                <div>
                  <dt class="font-medium text-gray-900">Address</dt>
                  <dd class="mt-2 text-gray-700">
                    <address class="not-italic">
                      <span class="block">{{$student->country}}</span>
                      <span class="block">{{$student->street_address}}</span>
                      <span class="block">{{$student->postal_code}}</span>
                     
                    </address>
                  </dd>
                </div>
                <div>
                  <dt class="font-medium text-gray-900">University</dt>
                  <dd class="mt-2 text-gray-700">
                    <address class="not-italic">
                      <span class="block">{{$student->campus->name}}</span>
                      <span class="block">{{$student->course->name}}</span>
                      <span class="block">{{$student->barcode}}</span>
                    </address>
                  </dd>
                </div>
              </dl>
      
              <dl class="grid grid-cols-3 gap-x-6 border-t border-gray-200 py-10 text-sm">
                <div>
                    <img src="{{asset('images/girl.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="flex-none rounded-lg bg-gray-100 object-cover object-center mr-10 " style="width: 144px; height:144px">
                    <p class="mt-1 text-gray-500  ml-2 text-sm">Id Picture</p>
                </div>
                <div>
                    <img src="{{asset('images/girl.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="flex-none rounded-lg bg-gray-100 object-cover object-center mr-10 " style="width: 144px; height:144px">
                    <p class="mt-1 text-gray-500  ml-2 text-sm">2x2 Picture</p>
                </div>
                <div>
                    <img src="{{asset('images/girl.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="flex-none rounded-lg bg-gray-100 object-cover object-center mr-10 " style="width: 144px; height:144px">
                    <p class="mt-1 text-gray-500  ml-2 text-sm">Profile <Picture></Picture></p>
                </div>
               
              </dl>
      
           
      
              <div class="space-y-6 border-t py-8 border-gray-200 pt-10 ">
                <div class="flex justify-between">
                  <div class="font-medium text-gray-900">Total Logins </div>
                  <div class="text-gray-700">{{$student->logins()->count()}}   </div>
                </div>
                
                    </div>
      
              <div class="space-y-6 border-t py-8 border-gray-200 pt-10 ">
                <div class="flex justify-between">
                  <div class="font-medium text-gray-900">Total Login </div>
                  <div class="whitespace-normal px-3 py-2 text-center ">
                    {{-- {{
                        $student->logins->sum(function ($login) {
                            return $login->logout->updated_at->diffInSeconds($login->created_at);
                        })
                    }} --}}

{{-- 
                    {{ \Carbon\CarbonInterval::seconds($student->logins->sum(function ($login) {
                        return $login->logout->updated_at->diffInSeconds($login->created_at);
                    }))->cascade()->forHumans(['parts' => 3]) }} --}}
                    {{ \Carbon\CarbonInterval::seconds($student->logins->sum(function ($login) {
                        return $login->logout->updated_at->diffInSeconds($login->created_at);
                    }))->cascade()->forHumans(['parts' => 2]) }}
                    
                </div>
            
                
                
                
                
                </div>
                
                    </div>
            </div>
          </section>
        </div>
      </main>


      
<script>
    window.addEventListener('printTable', event => {
      window.print();
    });
  </script>
      
</x-filament::page>
