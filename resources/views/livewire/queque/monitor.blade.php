<div>
    <div class="flex h-screen bg-[#103f20]" wire:poll.1s>
        <div class="bg-[#0d3119] w-1/3 py-7 px-6">
            <div class="flex justify-center items-center">
                <h2 class="text-6xl font-extrabold text-gray-100 mb-4 mr-4">SKSU ICT</h2>
                <img src="{{asset('images/logo.png')}}" class="w-16 h-16" alt="sksu.png">
            </div>

            <div class="mt-4 border-green-400 border-t-8 rounded shadow " >
              <h2 class="xl:text-5xl lg:2xl  font-extrabold  py-6  text-center mb-8 bg-black text-white uppercase  rounded   ">NOW SERVING</h2>
              <ul class="text-gray-800 ">


                @foreach($currentTransactions as $item)
                <li class="flex items-center justify-between bg-green-500 border-b mb-6  rounded animate-linear-progress animate-pulse ">
                  <span class="font-extrabold font-sans xl:text-6xl lg:4xl font-weight-bolder p-4 text-black capitalize">Teller {{$item->transaction?->teller?->teller_letter}}</span>
                  <span class="font-extrabold font-sans xl:text-6xl lg:4xl font-weight-bolder px-6 py-4  bg-black text-green-400 capitalize inline-block min-w-[221px] text-center ">{{$item->number}}</span>

                  {{-- <span class="bg-green-300 font-extrabold font-sans text-8xl font-weight-bolder rounded-r-md px-6 py-2 capitalize"> {{$item->number}}</span>
                  <span class="font-bold text-green-200 font-sans text-7xl py-2 font-weight-bolder capitalize">Teller {{$item->transaction->teller->teller_letter}}</span> --}}
                </li>
                @endforeach


              </ul>
            </div>
              {{-- <div class="min-h-24  flex items-center justify-center mt-8">

              <p class="text-gray-200 text-7xl font-bold  text-center">Please be patient while waiting..</p>

            </div> --}}

          </div>


        <div class="flex-1 bg-green-500">
          <div class="p-8
           flex flex-col justify-center items-center h-full">
            <h1 class="text-8xl font-extrabold uppercase bg-[#103f20] text-white px-8  rounded py-6 text-center mb-8 w-full">NEXT NUMBERS</h1>
            <div class="w-full h-full grid grid-cols-2 gap-8">

                @forelse($waitingTransactions as $item)
                @if(count($waitingTransactions) == 1)
                <div class="flex flex-col col-span-2 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[28.5rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}}</span>

                </div>
                @elseif(count($waitingTransactions) ==2  )
                <div class="flex flex-col col-span-1 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[15.2rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}}</span>

                </div>

                @elseif(count($waitingTransactions) ==3  )
                <div class="flex flex-col col-span-1 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[15.2rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}} </span>

                </div>

                @elseif(count($waitingTransactions) ==4  )
                <div class="flex flex-col col-span-1 items-center font-sans justify-center bg-[#103f20] rounded-lg shadow-lg p-2">
                    <span class="text-[15.2rem] leading-[1] cursor-vertical-text font-extrabold text-gray-100 ">{{$item->number}} </span>

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
