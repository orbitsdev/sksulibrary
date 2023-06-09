<x-filament::page>

<style>
    @media print {
      body * {
        visibility: hidden;
      }
  
      .b {
        visibility: hidden;
      }
  
      .printblecontianer,
      .printblecontianer * {
        visibility: visible;
      }
  
      .printblecontianer {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
      }
    }
  </style>

<div class=" flex justify-end w-full b  ">
  <x-button rose spinner="printDetails" wire:click="printDetails" style="background: #03A340">Print</x-button>
</div>

<div class="printblecontianer  dark:bg-transparent bg-white w-full">
  <div class="flex justify-center p-6">
    <div class="mr-10">
      <img src="{{ asset('images/logo.png') }}" alt="" style="width: 60px; height: 60px">
    </div>
    <div class="text-center " style="padding: 0px  20px ">
      <p>Republic of The Philippines</p>
      <p class="uppercase">Sultan Kudarat State University</p>
     
  
    </div>
    <div class="ml-10">
      <img src="{{ asset('images/sksulogo2.png') }}" alt="" style="width: 60px; height: 60px">
    </div>
  </div>

  <div>
    
 
    
    
   
    
    
    
    {{-- @if($student->profile)
    {{$student->profile}}
    @endif
    @if($student->school_id)
    {{$student->school_id}}
    @endif
    @if($student->two_by_two)
    {{$student->two_by_two}}
    @endif --}}

  </div>
  

  <div>
    <div class=" mt-4">
      <div class="mx-auto max-w-3xl  ">
        <div class="w-full text-center ">
          <p class="mt-2 text-2xl font-simibold tracking-tight ">{{$student->last_name}}, {{$student->first_name}} {{$student->middle_name}}</p>
          <p class="mt-1 text-base  "> @if($student->course)
            {{$student->course->name}}
            @endif </p>
    
          {{-- <div class="mt-8  ">
            <div class="uppercase">ID NO.</div>
            <div class=" font-semibold italic"> </div>
          </div> --}}
        </div>
    
        <div class="mt-10 border-t border-gray-200">
     
          <div class="flex space-x-6 border-b border-gray-200 py-10">
            @if(!empty($student->profile))
            <a target="_blank" href="{{Storage::disk('public')->url($student->profile)}}">
              <img src="{{Storage::disk('public')->url($student->profile)}}" alt="Glass bottle with black plastic pour top and mesh insert." class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
            </a>

            @else
            <img src="{{asset('images/placeholder.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">

            @endif

            <div class="flex flex-auto flex-col">
              <div>
                <p class="font-medium ">
                  ID NO
                </p>
                <p class=" text-sm ">
                  {{$student->id_number}}
                </p>
              </div>
              {{-- <div>
                <p class="font-medium ">
                  Bar Code
                </p>
                <p class=" text-sm ">
                  {{$student->barcode}}
                </p>
              </div> --}}
              <div class="mt-2">
                <p class="font-medium ">
                  Year
                </p>
                <p class=" text-sm ">
                  {{$student->year}}
                </p>
              </div>
              <div class="mt-2">
                <p class="font-medium ">
                  Campus
                </p>
                <p class=" text-sm ">
              @if($student->campus)
              {{$student->campus->name}}
              @endif
                </p>
              </div>
             
            </div>
          </div>
    
          <div class="sm:ml-40 sm:pl-6">
         
    
            <dl class="grid grid-cols-2 gap-x-6 py-10 ">
             
              <div>
               
                <div class=" ">
                  <div>
                    <p class="font-medium ">
                      Contact Number
                    </p>
                    <p class=" text-sm ">
                      {{$student->contact_number}}
                    </p>
                  </div>
                  <div class="mt-2">
                    <p class="font-medium ">
                      Street
                    </p>
                    <p class=" text-sm ">
                      {{$student->street_address}}
                    </p>
                  </div>
                  <div class="mt-2">
                    <p class="font-medium ">
                      City
                    </p>
                    <p class=" text-sm ">
                      {{$student->city}}
                    </p>
                  </div>
                  <div class="mt-2">
                    <p class="font-medium ">
                      Zip Code
                    </p>
                    <p class=" text-sm ">
                      {{$student->postal_code}}
                    </p>
                  </div>

                  
                </div>
              </div>
              <div>
                <div>
                  <p class="font-medium ">
                  Sex
                  </p>
                  <p class=" text-sm ">
                    {{$student->sex}}
                  </p>
                </div>  
                <div>
                  <p class="font-medium ">
                  Status
                  </p>
                  <p class=" text-sm ">
                    {{$student->status}}
                  </p>
                </div>  
              </div>
            </dl>
           
           
            
    
            <dl class="space-y-6 border-t border-gray-200 py-10" >
              <div class="flex justify-between">
                <dt class="font-medium  capitalize">Total Record in library </dt>
                <dd class="">{{$student->logins()->count()}}</dd>
              </div>
            
              <div class="flex justify-between">
                <dt class="flex font-medium ">
                  Total Time Spend in library
                  {{-- <span class="ml-2 rounded-full bg-gray-200 px-2 py-0.5 text-xs ">
                   
                  </span> --}}
                </dt>
                <dd class="">  {{ \Carbon\CarbonInterval::seconds($student->logins->sum(function ($login) {
                  return $login->logout->updated_at->diffInSeconds($login->created_at);
              }))->cascade()->forHumans(['parts' => 2]) }}
              
              </dd>
              </div>
              
            </dl>
            <dl class="grid grid-cols-2 gap-x-6 py-10  border-t ">

              <div class="flex justify-center flex-col items-center">


                @if(!empty($student->school_id))
                <a target="_blank" href="{{Storage::disk('public')->url($student->school_id)}}">
                  <img src="{{Storage::disk('public')->url($student->school_id)}}" alt="Glass bottle with black plastic pour top and mesh insert." class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">

                </a>
                @else
                <img src="{{asset('images/placeholder.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
                @endif

                
                <p class="text-xs  mt-2 text-center"> School Id <Picture></Picture></p>

              </div>
              <div class="flex justify-center flex-col items-center" >
                @if(!empty($student->two_by_two))
                <a target="_blank" href="{{Storage::disk('public')->url($student->two_by_two)}}">
                  <img src="{{Storage::disk('public')->url($student->two_by_two)}}" alt="Glass bottle with black plastic pour top and mesh insert." class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
                </a>
                @else
                <img src="{{asset('images/placeholder.jpg')}}" alt="Glass bottle with black plastic pour top and mesh insert." class="h-20 w-20 flex-none rounded-lg bg-gray-100 object-cover object-center sm:h-40 sm:w-40">
                @endif
                
                <p class="text-xs  mt-2 text-center"> 2x2 Picture</p>

              </div>
             

            </dl>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
  


      
<script>
    window.addEventListener('printStudentDetails', function(){
      window.print();
    });
  </script>
      
</x-filament::page>
