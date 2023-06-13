<x-filament::page>

@if($latestRecord)
<p class=""> {{$latestRecord->created_at->format('F d, Y - l')}}</p>
@endif

    <div>
        {{ $this->table }}
    </div>
</x-filament::page>
