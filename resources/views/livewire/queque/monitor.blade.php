<div>
    <div class="flex h-screen bg-[#103f20]" wire:poll.1s>
        <div class="bg-[#0d3119] w-1/3 p-8">
            <div class="flex justify-center">
                <h2 class="text-6xl font-semibold text-gray-100 mb-4 mr-4">SKSU ICT</h2>
                <img src="{{asset('images/logo.png')}}" class="w-16 h-16" alt="sksu.png">
            </div>
            <div class="h-24  flex items-center justify-center">

              <p class="text-gray-200 text-4xl mt-3 text-center">Please be patient while waiting..</p>
              
            </div>
            
            <div class="mt-8">
              <h3 class="text-4xl font-extrabold mb-4 text-gray-200  uppercase ">Being Serve </h3>
              <ul class="text-gray-100 divide-y divide-gray-200">

            
                @foreach($currentTransactions as $item)
                <li class="flex items-center justify-between py-2">
                  <span class="text-gray-800 p-6 inline-flex items-center  bg-yellow-300 font-extrabold font-sans text-4xl font-weight-bolder rounded-r-md mr-8 capitalize"> {{$item->number}}  </span>
                  <span class=" font-semibold text-yellow-200 font-sans text-4xl py-6  font-weight-bolder capitalize">Teller {{$item->transaction->teller->teller_letter}}  </span>
                </li>

                @endforeach

              
              </ul>
            </div>
          </div>
          
      
        <div class="flex-1 bg-gray-50">
          <div class="p-8 flex flex-col justify-center items-center h-full">
            <h1 class="text-5xl font-bold uppercase text-[#103f20] text-center mb-8">NEXT NUMBERS</h1>
            <div class="w-full h-full grid grid-cols-2 gap-4">

                @forelse($waitingTransactions as $item)
                @if(count($waitingTransactions) == 1)
                <div class="flex flex-col col-span-2 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[28.5rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}}</span>
                    
                </div>
                @elseif(count($waitingTransactions) ==2  )
                <div class="flex flex-col col-span-1 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[16.5rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}}</span>
                    
                </div>

                @elseif(count($waitingTransactions) == 3)
                <div class="flex flex-col col-span-1 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[16.5rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}} </span>
                    
                </div>

                @endif

                @empty
                <div class="col-span-2 flex flex-col items-center justify-center bg-[#103f20] rounded-lg shadow-lg  pb-8 pt-0 ">
                    <p class="text-[10.5rem] font-extrabold text-gray-100 leading-1 uppercase leading-none text-center">No </p>
                    <p class="text-[4.5rem] font-extrabold text-gray-100 leading-1 uppercase leading-none text-center">Number was called</p>
                    <p class="text-4xl  text-gray-200 uppercase mt-8 text-center mx-10"> Wait for your number to be displayed by an available teller </p>
                  </div>
                  

                @endforelse
              {{-- <div class="flex flex-col items-center justify-center bg-[#103f20] rounded-lg shadow-lg py-8">
                <p class="text-[8.5rem] font-semibold text-gray-100 ">1</p>
                <p class="text-2xl font-medium text-gray-200 uppercase ">Teller  A</p>
              </div>
              <div class="flex flex-col items-center justify-center bg-[#103f20] rounded-lg shadow-lg py-8">
                <p class="text-[8.5rem] font-semibold text-gray-100 ">2</p>
                <p class="text-2xl font-medium text-gray-200 uppercase ">Teller  B</p>
              </div>
              <div class="flex flex-col items-center justify-center bg-[#103f20] rounded-lg shadow-lg py-8">
                <p class="text-[8.5rem] font-semibold text-gray-100 ">3</p>
                <p class="text-2xl font-medium text-gray-200 uppercase ">Teller  C</p>
              </div>
              <div class="flex flex-col items-center justify-center bg-[#103f20] rounded-lg shadow-lg py-8">

                <p class="text-[8.5rem] font-semibold text-gray-100 ">4</p>
                <p class="text-2xl font-medium text-gray-200 uppercase">Teller  D</p>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
      
</div>
