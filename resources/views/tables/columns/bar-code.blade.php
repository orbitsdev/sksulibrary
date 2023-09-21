<div>
    {{-- {{ $getRecord()->first_name }}
    @if( $getRecord()->id_number) --}}
    <a href="/download-barcode/{{$getRecord()->id_number}}"  target="_blank">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(str($getRecord()->id_number), 'S25+')}}" alt="barcode" />
    </a>
    {{-- <a href="{{ route('barcode.download', ['idNumber' => $getRecord()->id_number]) }}" target="_blank">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(str($getRecord()->id_number), 'S25+')}}" alt="barcode" />
    </a>
     --}}
</div>
