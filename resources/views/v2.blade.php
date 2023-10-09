<x-main-layout>
    <style>
        .v2card{
            font-family: 'Inter', sans-serif;
        }

    #show_bg_2 {
        background-image: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(37, 162, 80, 0.90)), url('images/library.jpg');

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
    
            <div class="mx-auto w-9  bg-[#D9D9D9] h-2 mt-5"></div>
    
            <div class="mt-4 max-auto flex items-center  justify-center">
                <div class="bg-[#f6f6f6] p-2">
                    <img src="{{asset('images/qr-transparent.png')}}" alt="" class="w-24 h-24">

                </div>
                <div class="ml-4  p-4">
                    <input type="text" class="rounded-full border-2  focus:border-[#36784D] ring-[#36784D] focus:ring-[#36784D] border-[#36784D] placeholder-[#A7A7A7] w-full placeholder-sm" placeholder="ID Number" autofocus>
                    <div class="flex items-center justify-between mt-0">
                        <p class="text-[#A7A7A7] text-sm p-0 m-0 " >
                            Auto-Trigger: Active by default, Click to Take Control
                        </p>
                        <div class="w-10 h-10 bg-blue-400 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- 
    <div id="modal" class="fixed top-0 left-0 w-full h-full flex  justify-center items-center  z-[1000]" >
        <div class="absolute w-full h-full bg-gray-900 opacity-[30%]"></div>
        <div class="max-w-xl bg-white w-2/3 p-8 rounded shadow-lg z-10 flex flex-col items-center">
            <p class="text-[#36784D] uppercase text-2xl leading-none   ">SKSU LIBRARY SYSTEM</p>
            <p class="mt-8 text-3xl font-bold text-center">DOE, SMITH JOHN, MAKATAGIL MAGBANUA </p>
            <p class="mt-2 text-[#B8B8B8] text-lg">1st Year SECONDARY TEACHER</p>
           
            <p class="text-[#BB0000] mt-4 font-bold">Has Been Logged out</p>
          
        </div>
    </div>
     --}}
    

</x-main-layout>