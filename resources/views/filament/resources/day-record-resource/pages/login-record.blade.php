<x-filament::page>
<div>

    <p class="font-simibold text-lg " style="padding-bottom: 10px">{{ $dayData->created_at->format('F d, Y - l')}}  </p>

    {{ $this->table }}
</div>
</x-filament::page>
