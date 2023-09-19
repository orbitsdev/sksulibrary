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
                color: black;
                position: absolute;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
 {{-- {{ $this->form }}
 {{$from}}
 {{$to}} --}}

 <div class="grid grid-cols-3 gap-x-6 ">

     
    <div class="">
        <label for="monthInput" class="block text-md font-medium text-gray-700 mb-1">Month</label>
        <input type="month" wire:model="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600">
    </div>
    
    <div class="">
        <label for="courseSelect" class="block text-md font-medium text-gray-700 mb-1">Course</label>
        <select id="courseSelect" wire:model="course_selected" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600">
            <option value="all"> All</option>
           @foreach($courses as $course)
           <option value="{{$course->id}}"> {{$course->name}}</option>

           @endforeach
            
            <!-- Add more options as needed -->
        </select>
    </div>
    <div class="">
        <label for="campuses" class="block text-md font-medium text-gray-700 mb-1">Campus</label>
        <select id="campuses" wire:model="campus_selected" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600">
            <option value="all"> All</option>
           @foreach($campuses as $campus)
           <option value="{{$campus->id}}"> {{$campus->name}}</option>

           @endforeach
            
            <!-- Add more options as needed -->
        </select>
    </div>

    <div class="">
        <label for="monthInput" class="block text-md font-medium text-gray-700 mb-1">List of Top visitors (Default 10)</label>
        <input type="number" wire:model="top" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600">
    
    </div>


        
    

{{-- <input type="month" wire:model="month" class="  rounded focus:border-green-600 focus:ring-green-600 "> --}}


 </div>
    <div class=" flex justify-end w-full b  ">
        <x-button rose spinner="exportToExcel" wire:click="exportToExcel" style="background: #03A340" icon="newspaper" class="mr-4">Export</x-button>
        <x-button rose spinner="print" wire:click="print" style="background: #03A340" icon="printer">Print</x-button>
    </div>

    <div class="print-container dark:bg-gray-800 bg-white w-full ">
        <div class="flex justify-center p-6">
            <div class="mr-10">
                <img src="{{ asset('images/logo.png') }}" alt="" style="width: 60px; height: 60px">
            </div>
            <div class="text-center " style="padding: 0px  20px ">
                <p>Republic of The Philippines</p>
                <p class="uppercase">Sultan Kudarat State University</p>
                <p class="mt-10 " style="padding-top: 20px">Top 10 Visitors of the Month of {{  now()->format('F') }}</p>
            </div>
            <div class="ml-10">
                <img src="{{ asset('images/sksulogo2.png') }}" alt="" style="width: 60px; height: 60px">
            </div>
        </div>

        <table class="w-full divide-y divide-gray-300">
            <thead>
                <tr>
                    <th scope="col" class="py-2 pr-3 text-left text-xs font-semibold sm:pl-6" style="padding-left: 16px;">Name</th>
                    <th scope="col" class="py-2 pr-3 text-left text-xs font-semibold sm:pl-6" style="padding-left: 16px;">Year</th>
                    <th scope="col" class="py-2 pr-3 text-left text-xs font-semibold sm:pl-6" style="padding-left: 16px;">Course</th>
                    <th scope="col" class="py-2 pr-3 text-left text-xs font-semibold sm:pl-6" style="padding-left: 16px;">Campus</th>
                    <th scope="col" class="px-3 py-2 text-left text-xs font-semibold" style="padding-left: 16px;">Total Visits</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

                @forelse($students as $student)
                <tr>
                    <td class="whitespace-normal py-2 pr-3 text-left text-xs font-medium" style="padding-left: 16px;">     {{ !empty($student) ? $student->last_name . ', ' . $student->last_name . ' '.$student->middle_name : '' }}
                    </td>
                   
                    <td class="whitespace-normal px-3 py-2 text-left text-xs" style="padding-left: 16px;">

                        {{ !empty($student) ? $student->year : '' }}
                             
                    </td>
                   
                    <td class="whitespace-normal px-3 py-2 text-left text-xs" style="padding-left: 16px;">

                        {{ !empty($student) && !empty($student->course) ? $student->course->name : '   No Course Assigned' }}

                             
                    </td>
                    <td class="whitespace-normal px-3 py-2 text-left text-xs" style="padding-left: 16px;">

                        {{ !empty($student) && !empty($student->course) && !empty($student->course->campus) ? $student->course->campus->name : 'No Campus Assigned' }}

                    
                    </td>
                    <td class="whitespace-normal px-3 py-2 text-left text-xs" style="padding-left: 16px;">{{count($student->logins)}}</td>
                </tr>
                @empty

                @endforelse
              
               
                <!-- Add more rows with dynamic data here -->
            </tbody>
        </table>

        <!-- You can customize the "No record found" message as needed -->
        <!--
        <div class="text-center flex justify-center w-full" style="padding: 20px 20px 50px 20px">
            <p class="text-lg font-bold text-center" style="padding: 20px">No record found</p>
        </div>
        -->
    </div>
    <script>
        window.addEventListener('printTopVisitors', event => {
            window.print();
        });
    </script>
</x-filament::page>
