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

    <div class="b"></div>
    {{ $this->form }}

    <div class=" flex justify-end w-full b  ">
        <x-button rose spinner="exportToExcel" wire:click="exportToExcel" style="background: #03A340" icon="newspaper"
            class="mr-4">Export </x-button>
        <x-button rose spinner="print" wire:click="print" style="background: #03A340" icon="printer">Print</x-button>
    </div>

    <div class="print-container  bg-white w-full ">
        <div class="flex justify-center p-6">
            <div class="mr-10">
                <img src="{{ asset('images/logo.png') }}" alt="" style="width: 60px; height: 60px">
            </div>
            <div class="text-center " style="padding: 0px  20px ">
                <p>Republic of The Philippines</p>
                <p class="uppercase">Sultan Kudarat State University</p>
                @if ($dayData)
                    <p class="mt-10 " style="padding-top: 20px"> {{ $dayData->created_at->format('F d, Y - l ') }} </p>
                @else
                    <p class="mt-10 " style="padding-top: 20px"> {{ now()->format('F d, Y - l ') }} </p>
                @endif
            </div>
            <div class="ml-10">
                <img src="{{ asset('images/sksulogo2.png') }}" alt="" style="width: 60px; height: 60px">
            </div>
        </div>

        <table class="w-full divide-y divide-gray-300">
            @if (count($logins) > 0)
                <thead>
                    <tr>
                        <th scope="col" class="py-2 pr-3 text-left text-xs font-semibold sm:pl-6  "
                            style="padding-left: 16px;">Name</th>
                        <th scope="col" class="px-3 py-2 text-left text-xs font-semibold"
                            style="padding-left: 16px;">Course</th>
                        <th scope="col" class="px-3 py-2 text-center text-xs font-semibold">Year</th>
                        <th scope="col" class="px-3 py-2 text-center text-xs font-semibold">Time In</th>
                        <th scope="col" class="px-3 py-2 text-center text-xs font-semibold">Time Out</th>
                        {{-- <th scope="col" class="px-3 py-2 text-center text-xs font-semibold">Time Spend</th> --}}
                        <th scope="col" class="px-3 py-2 text-center text-xs font-semibold">Campus</th>
                    </tr>
                </thead>
            @endif
            <tbody class="divide-y divide-gray-200">
                @forelse ($logins as $item)
                    <tr>
                        <td class="whitespace-normal py-2 pr-3 text-left text-xs font-medium" style="padding-left: 16px;">
                            {{ !empty($item->student) ? $item->student->first_name . ' ' . $item->student->last_name : '' }}
                        </td>
                        <td class="whitespace-normal px-3 py-2 text-left text-xs" style="padding-left: 16px;">
                            {{ !empty($item->student) && !empty($item->student->course) ? $item->student->course->name : '   No Course Assigned' }}
                        </td>
                        <td class="whitespace-normal px-3 py-2 text-center text-xs">
                            {{ !empty($item->student) ? $item->student->year : '' }}
                        </td>
                        <td class="whitespace-normal px-3 py-2 text-center text-xs">
                            {{ !empty($item->created_at) ? $item->created_at->format('g:i A') : '' }}
                        </td>
                        @if (!empty($item->logout) && $item->logout->status == 'Did Not Logout')
                            <td class="whitespace-normal px-3 py-2 text-center text-xs important" style="color: #DC2626">No Logout</td>
                            
                        @else
                            <td class="whitespace-normal px-3 py-2 text-center text-xs">
                                @if (!empty($item->logout))
                                    @if ($item->logout->status == 'Logged out')
                                        {{ $item->logout->updated_at->format('g:i A') }}
                                    @elseif ($item->logout->status == 'Not Logout')
                                        - Currently Inside -
                                    @else
                                        - Did Not Logout -
                                    @endif
                                @endif
                            </td>
                            {{-- <td class="whitespace-normal px-3 py-2 text-center text-xs">
                                @if (!empty($item->logout) && $item->logout->status != 'Did Not Logout')
                                    {{
                                        \Carbon\CarbonInterval::seconds($item->logout->updated_at->diffInSeconds($item->created_at))->cascade()->forHumans(['parts' => 2, 'join' => true])
                                    }}
                                @endif
                            </td> --}}
                            @endif
                            <td class="whitespace-normal px-3 py-2 text-center text-xs">
                                
                                {{ !empty($item->student) && !empty($item->student->course) && !empty($item->student->course->campus) ? $item->student->course->campus->name : 'No Campus Assigned' }}
                            </td>
                            {{-- <td class="whitespace-normal px-3 py-2 text-center text-xs important" style="color: #DC2626">-</td> --}}
                    </tr>
                @empty
                    <div class="text-center flex justify-center w-full" style="padding: 20px 20px 50px 20px">
                        <p class="text-lg font-bold text-center" style="padding: 20px">No record found</p>
                    </div>
                @endforelse
            </tbody>
        </table>
        @if (count($logins) > 0)
            <div class="flex justify-end items-center mt-40 m-10  " style="margin-top: 20px">
                <div class="w-20 pb-8 " style="text-align: center">
                    <p class=" font-bold" style="text-align:center mb-1">{{ count($logins) }}</p>
                    <p class="font-bold border-t border-black pt-1" style="text-align:center">Total</p>
                </div>
            </div>
        @endif
    </div>

    <script>
        window.addEventListener('printTable', event => {
            window.print();
        });
    </script>
</x-filament::page>
