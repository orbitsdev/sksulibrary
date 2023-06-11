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

<div class="b"></div>
{{ $this->form }}

<div class="p-10 flex justify-end w-full b">
  <x-button rose spinner="print" wire:click="print" style="background: #006516">Print</x-button>
</div>

<div class="print-container bg-white w-full">
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

  <table class="w-full divide-y divide-gray-300">
    @if (count($logins) > 0)
    <thead>
      <tr>
        <th scope="col" class="py-2 pr-3 text-left text-sm font-semibold sm:pl-6  " style="padding-left: 16px;">Name</th>
        <th scope="col" class="px-3 py-2 text-center text-sm font-semibold">Course</th>
        <th scope="col" class="px-3 py-2 text-center text-sm font-semibold">Year</th>
        <th scope="col" class="px-3 py-2 text-center text-sm font-semibold">Time In</th>
        <th scope="col" class="px-3 py-2 text-center text-sm font-semibold">Time Out</th>
      </tr>
    </thead>
    @endif
    <tbody class="divide-y divide-gray-200">
      @forelse ($logins as $item)
      <tr>
        <td class="whitespace-normal py-2 pr-3 text-left text-sm font-medium  "  style="padding-left: 16px;">{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
        <td class="whitespace-normal px-3 py-2 text-center text-sm">{{ $item->student->course->name }}</td>
        <td class="whitespace-normal px-3 py-2 text-center text-sm">{{ $item->student->year }}</td>
        <td class="whitespace-normal px-3 py-2 text-center text-sm">{{ $item->created_at->format('g:i A') }}</td>
        <td class="whitespace-normal px-3 py-2 text-center text-sm">{{ $item->logout->updated_at->format('g:i A') }}</td>
      </tr>
      @empty
      <div class="text-center flex justify-center w-full" style="padding: 20px 20px 50px 20px">
        {{-- <p class="text-lg font-bold text-center" style="padding: 20px"> No Record Found </p> --}}
        {{ $this->table }}
      </div>
      @endforelse
    </tbody>
  </table>
</div>

<script>
  window.addEventListener('printTable', event => {
    window.print();
  });
</script>
</x-filament::page>
