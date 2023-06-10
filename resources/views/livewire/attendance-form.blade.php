<div class="h-screen sksubg w-full ">
   
        <div class="flex flex-col items-center  h-full " >
            <nav class="flex items-center justify-start w-full h-16  text-white px-8">
                <ul class="flex space-x-4">
                    <li ><a href="/admin" class="hover:text-gray-300 flex items-center justify-center hover:bg-black px-4 py-3 rounded  transition-all  "> <x-icon name="view-grid" class="w-5 h-5 mr-1" solid /> Go to admin</a></li>
                   
                </ul>
            </nav>

            <div class="flex flex-col items-center justify-center w-full" style="height: 100%">

          
            <div class="w-2/5 h-20 ">

                <p id="textSwap" class="text-3xl font-bold text-gray-100 text-center transition-opacity duration-1000"> " Science is not only a disciple of reason but also one of romance and passion "</p>
            </div>
        
        <div class="w-2/5  relative  rounded-xl p-8"> 
            <div class="flex items-center justify-center">
                <div class="w-64 h-64  rounded-full z-10  flex items-center justify-center" style="">
                    <img src="photo.png" alt="">
                    <svg id="Layer_1" class="h-28 w-28" fill="#F3F4F6" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.61 122.88"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>qr-code-scan</title><path class="cls-1" d="M26.68,26.77H51.91V51.89H26.68V26.77ZM35.67,0H23.07A22.72,22.72,0,0,0,14.3,1.75a23.13,23.13,0,0,0-7.49,5l0,0a23.16,23.16,0,0,0-5,7.49A22.77,22.77,0,0,0,0,23.07V38.64H10.23V23.07a12.9,12.9,0,0,1,1-4.9A12.71,12.71,0,0,1,14,14l0,0a12.83,12.83,0,0,1,9.07-3.75h12.6V0ZM99.54,0H91.31V10.23h8.23a12.94,12.94,0,0,1,4.9,1A13.16,13.16,0,0,1,108.61,14l.35.36h0a13.07,13.07,0,0,1,2.45,3.82,12.67,12.67,0,0,1,1,4.89V38.64h10.23V23.07a22.95,22.95,0,0,0-6.42-15.93h0l-.37-.37a23.16,23.16,0,0,0-7.49-5A22.77,22.77,0,0,0,99.54,0Zm23.07,99.81V82.52H112.38V99.81a12.67,12.67,0,0,1-1,4.89,13.08,13.08,0,0,1-2.8,4.17,12.8,12.8,0,0,1-9.06,3.78H91.31v10.23h8.23a23,23,0,0,0,16.29-6.78,23.34,23.34,0,0,0,5-7.49,23,23,0,0,0,1.75-8.8ZM23.07,122.88h12.6V112.65H23.07A12.8,12.8,0,0,1,14,108.87l-.26-.24a12.83,12.83,0,0,1-2.61-4.08,12.7,12.7,0,0,1-.91-4.74V82.52H0V99.81a22.64,22.64,0,0,0,1.67,8.57,22.86,22.86,0,0,0,4.79,7.38l.31.35a23.2,23.2,0,0,0,7.5,5,22.84,22.84,0,0,0,8.8,1.75Zm66.52-33.1H96v6.33H89.59V89.78Zm-12.36,0h6.44v6H70.8V83.47H77V77.22h6.34V64.76H89.8v6.12h6.12v6.33H89.8v6.33H77.23v6.23ZM58.14,77.12h6.23V70.79h-6V64.46h6V58.13H58.24v6.33H51.8V58.13h6.33V39.33h6.43V58.12h6.23v6.33h6.13V58.12h6.43v6.33H77.23v6.33H70.8V83.24H64.57V95.81H58.14V77.12Zm31.35-19h6.43v6.33H89.49V58.12Zm-50.24,0h6.43v6.33H39.25V58.12Zm-12.57,0h6.43v6.33H26.68V58.12ZM58.14,26.77h6.43V33.1H58.14V26.77ZM26.58,70.88H51.8V96H26.58V70.88ZM32.71,77h13V89.91h-13V77Zm38-50.22H95.92V51.89H70.7V26.77Zm6.13,6.1h13V45.79h-13V32.87Zm-44,0h13V45.79h-13V32.87Z"/></svg>
                </div>
            </div>
            <div class="flex items-center justify-center ">
                <input type="text" wire:model.debounce.700ms="barcode" autofocus   class="w-6/12 rounded">
            </div>
          
            <div class="flex items-center justify-center mt-4">
                <input type="checkbox" wire:model="isManualInputBarCode" class="mr-2 focus:outline-none focus:ring-0 focus:bg-transparent focus:border-accent-green hover:bg-accent-green hover:border-green checked:bg-green-400 checked:hover:bg-green-500 checked:active:bg-green-500">
                <label for="vehicle1" class="text-gray-100  text-lg "> Input Barcode Manually </label>       
            </div>
         
            <div class="flex items-center justify-center mt-10 h-5">
               @if($isManualInputBarCode)
               <x-button class="w-6/12"  positive label="Read Bar Code" wire:click="readBarCodeManually" spinner="readBarCodeManually"  /> 
               @endif
            </div>
           

        </div>
          </div>
    </div>


    <x-modal.card align="center" max-width="6xl" blur="false" wire:model.defer="isSuccess">

        @if($student != null && $todayRecord != null)



        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-1 bg-red-400 " style="height:500px">
                <img class="h-full bg-gray-50 object-cover  lg:inset-y-0 lg:left-0  lg:w-1/2"
                    src="{{ asset('images/girl.jpg') }}" alt="" style="width:100%">

            </div>


            <div class="col-span-1 h-full">
                <div class="text-center">
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl capitalize">
                        {{ $student->first_name }} {{ $student->last_name }} </p>
                    <p class="mt-0.5 mr-2 text-lg leading-8 text-gray-900 capitalize"> {{$student->course}} 
                    </p>
                </div>




                <div class="mt-4">

                    <x-details-card :title="'ID NO.'" :body="$student->id_number" />
                    <x-details-card :title="'Year'" :body="$student->year" />
                        

                    


                    @if($studentLoginRecord =  $this->student->logins()->latest()->first())
                     <div class="shadow rounded py-3 px-6 mt-1 bg-green-100">
                          <div class="text-center">
                         <div class="text-md leading-6 text-green-900">Time in</div>
                         <div class="order-first text-2xl text-green-900 font-semibold tracking-tight">
                          {{ $studentLoginRecord->created_at->timezone('Asia/Manila')->format('h:i:s A - l')}}</div>
                             
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
                                    {{$logoutrecord->updated_at->timezone('Asia/Manila')->format('h:i:s A - l') }}</div>
                        </div>
                    </div>
                        @endif
                    @endif
                
                  

              
                <div class="px-6 py-2 flex items-center justify-center mt-4 ">
                    <svg width="40" height="40" viewBox="0 0 168 133" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M141.995 0L63 80.969L25.998 45.892L0 71.904L63 133L168 26.005L141.995 0Z"
                            fill="#4FA65B" />
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



    {{-- <x-dialog /> --}}


    <x-modal.card align="center" blur wire:model="hasError">




        @if($errorType == 'not-found')
        <x-error-content :image="'not-found.png'" :message="$errorMessage"/>
        @endif
        @if($errorType == 'exception')
        <x-error-content :image="'error.png'" :message="$errorMessage"/>
        @endif
        {{-- <div class="flex items-center justify-center flex-col ">
            <img src="{{asset('images/not-found.png')}}" alt="" height="300" width="300">
            @endif
        </div>

        <div class="text-center mt-8 tex-lg">
            Please register first your barcode to the admin. 
        </div> --}}
     

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                

                <div class="flex">
                  
                    <x-button positive label="I Understand"  x-on:click="close" />
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
  
      setTimeout(function () {
        textElement.textContent = sentences[currentIndex];
        currentIndex = (currentIndex + 1) % sentences.length;
  
        textElement.classList.remove("fade-out");
        textElement.classList.add("fade-in");
      }, 500); // Delay before fading in the next text
    }
  
    updateText();
    setInterval(updateText, 10000);
  </script>