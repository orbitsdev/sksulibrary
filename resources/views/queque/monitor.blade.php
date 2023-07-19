

<x-que-layout>
    <div class="flex h-screen bg-[#103f20]">
        <div class="bg-[#0d3119] w-1/3 p-8">
            <div class="flex">
                <h2 class="text-6xl font-semibold text-gray-100 mb-4 mr-4">SKSU QMS</h2>
                <img src="{{asset('images/logo.png')}}" class="w-16 h-16" alt="sksu.png">
            </div>
            <p class="text-gray-200 text-3xl">Please bee patient while waiting..</p>

            
            <div class="mt-8">
              <h3 class="text-xl font-semibold text-gray-100 mb-2">Ongoing Transactions:</h3>
              <ul class="text-gray-100 divide-y divide-gray-200">
                <li class="flex items-center py-2">
                  <span class="text-gray-800 p-6 inline-flex items-center justify-center bg-white font-bolder text-4xl font-weight-bolder rounded-r-md mr-4">1</span>
                  <span class="text-lg">Transaction #1</span>
                </li>
                <li class="flex items-center py-2">
                  <span class="text-gray-800 p-6 inline-flex items-center justify-center bg-white font-bolder text-4xl font-weight-bolder rounded-r-md mr-4">2</span>
                  <span class="text-lg">Transaction #2</span>
                </li>
                <li class="flex items-center py-2">
                  <span class="text-gray-800 p-6 inline-flex items-center justify-center bg-white font-bolder text-4xl font-weight-bolder rounded-r-md mr-4">3</span>
                  <span class="text-lg">Transaction #3</span>
                </li>
              </ul>
            </div>
          </div>
          
      
        <div class="flex-1 bg-gray-50">
          <div class="p-8 flex flex-col justify-center items-center h-full">
            <h1 class="text-5xl font-bold uppercase text-[#103f20] text-center mb-8">Now Serving</h1>
            <div class="w-full h-full grid grid-cols-2 gap-4">
              <div class="flex flex-col items-center justify-center bg-[#103f20] rounded-lg shadow-lg py-8">
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
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      
      
</x-que-layout>
