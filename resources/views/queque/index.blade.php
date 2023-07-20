

<x-que-layout>

    
    <div class="mx-auto flex flex-col items-center justify-center h-screen bg-gradient-to-r from-[#072510] to-[#072510]">
        <h2 class="text-4xl font-semibold text-white mb-8">Teller A</h2>
        
        <div class="bg-[#0d3119] w-2/3 p-8 rounded-lg shadow-lg grid grid-cols-1 gap-8">
          
          <div class="grid grid-cols-3 gap-8">
            <div class="flex flex-col items-center justify-start p-8 rounded bg-[#103f20]">
              <h3 class="text-xl font-semibold text-white mb-2">Current Queue Number</h3>
              <p class="text-6xl font-semibold text-gray-100">A4</p>
            </div>
            
            <div class="flex flex-col items-center justify-start p-8 rounded bg-[#103f20]">
              <h3 class="text-xl font-semibold text-white mb-2">Transaction Status</h3>
              <p class="text-3xl font-semibold text-gray-100">In Progress</p>
            </div>
            
            <div class="flex flex-col items-center justify-start p-8 rounded bg-[#103f20]">
              <h3 class="text-xl font-semibold text-white mb-2">Next Queue Number</h3>
              <p class="text-6xl font-semibold text-gray-100">A5</p>
            </div>
          </div>
          
         
          
          <div class="grid grid-cols-2 gap-4">
            <button class="bg-[#103f20] text-white text-lg py-3 rounded hover:scale-95 transition-all px-4 hover:bg-[#154d28]">Complete Transaction</button>
            <button class="bg-[#103f20] text-white text-lg py-3 rounded hover:scale-95 transition-all px-4 hover:bg-[#154d28]">Cancel Transaction</button>
          </div>
          
          <div class="grid grid-cols-2 gap-4 mt-4">
            <button class="bg-[#103f20] text-white text-lg py-3 rounded hover:scale-95 transition-all px-4 hover:bg-[#154d28]">Next Customer</button>
            <button class="bg-[#103f20] text-white text-lg py-3 rounded hover:scale-95 transition-all px-4 hover:bg-[#154d28]">Skip Customer</button>
          </div>
        </div>
      </div>
      
      
    {{-- <div class="flex flex-col items-center justify-center h-screen bg-[#103f20]">
        <h2 class="text-4xl font-semibold text-white mb-4">Teller Interface</h2>
        
        <div class="bg-[#0d3119] w-2/3 p-8 rounded-lg shadow-lg grid grid-cols-1 gap-6">
            <div class="grid grid-cols-3">

                <div class="flex flex-col items-center justify-center">
                    <h3 class="text-xl font-semibold text-white mb-2">Current Queue Number</h3>
            <p class="text-6xl font-semibold text-gray-100">A4</p>
          </div>
          
          <div class="flex flex-col items-center justify-center">
            <h3 class="text-xl font-semibold text-white mb-2">Transaction Status</h3>
            <p class="text-2xl font-medium text-gray-200">In Progress</p>
          </div>
          
          <div class="flex flex-col items-center justify-center">
            <h3 class="text-xl font-semibold text-white mb-2">Next Queue Number</h3>
            <p class="text-6xl font-semibold text-gray-100">A5</p>
        </div>
    </div>
        
        
          
          <div class="mb-6">
            <h3 class="text-xl font-semibold text-white mb-2">Transaction Details</h3>
            <div class="bg-white text-[#103f20] rounded-lg p-4">
              <div class="mb-4">
                <label class="block text-sm font-medium">Customer Name:</label>
                <input type="text" class="border border-gray-300 p-2 rounded w-full">
              </div>
              <div class="mb-4">
                <label class="block text-sm font-medium">Transaction Type:</label>
                <select class="border border-gray-300 p-2 rounded w-full">
                  <option value="deposit">Deposit</option>
                  <option value="withdraw">Withdraw</option>
                  <option value="transfer">Transfer</option>
                </select>
              </div>
              <!-- Add more input fields or selects as needed -->
            </div>
          </div>
          
          <div class="flex justify-between">
            <button class="bg-[#103f20] text-white text-lg py-2 px-4  hover:bg-[#0d3119] w-1/2">Complete Transaction</button>
            <button class="bg-[#103f20] text-white text-lg py-2 px-4  hover:bg-[#0d3119] w-1/2">Cancel Transaction</button>
          </div>
          
          <div class="mt-4 flex justify-between">
            <button class="bg-[#103f20] text-white text-lg py-2 px-4  hover:bg-[#0d3119] w-1/2">Next Customer</button>
            <button class="bg-[#103f20] text-white text-lg py-2 px-4  hover:bg-[#0d3119] w-1/2">Skip Customer</button>
          </div>
        </div>
      </div> --}}
      
            
    {{-- <div class="flex flex-col items-center justify-center h-screen bg-[#103f20]">
        <h2 class="text-4xl font-semibold text-white mb-4">Teller Interface</h2>
        
        <div class="bg-[#0d3119] w-1/3 p-8 rounded-lg shadow-lg">
          <h3 class="text-xl font-semibold text-white mb-2">Current Queue Number</h3>
          <p class="text-6xl font-semibold text-gray-100 mb-4">A4</p>
          
          <h3 class="text-xl font-semibold text-white mb-2">Transaction Status</h3>
          <p class="text-2xl font-medium text-gray-200 mb-4">In Progress</p>
          
          <h3 class="text-xl font-semibold text-white mb-2">Next Queue Number</h3>
          <p class="text-6xl font-semibold text-gray-100 mb-4">A5</p>
          
          <button class="bg-[#103f20] text-white text-lg py-2 px-4 rounded-full mb-4 hover:bg-[#0d3119]">Call Next</button>
          
          <h3 class="text-xl font-semibold text-white mb-2">Transaction Details</h3>
          <div class="bg-white text-[#103f20] rounded-lg p-4 mb-4">
            <label class="block text-sm font-medium mb-1">Customer Name:</label>
            <input type="text" class="border border-gray-300 p-2 rounded">
            
            <!-- Add more input fields as needed -->
          </div>
          
          <div class="flex justify-between">
            <button class="bg-[#103f20] text-white text-lg py-2 px-4 rounded-full hover:bg-[#0d3119]">Complete</button>
            <button class="bg-[#103f20] text-white text-lg py-2 px-4 rounded-full hover:bg-[#0d3119]">Cancel</button>
          </div>
        </div>
      </div>
       --}}
</x-que-layout>
