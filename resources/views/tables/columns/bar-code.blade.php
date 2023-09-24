<div>

    <a href="{{route('barcode.download',['idNumber'=> $getRecord()->id_number])}}">
        {{-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(str($getRecord()->id_number), 'S25+')}}" alt="barcode" /> --}}
        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(strval($getRecord()->id_number), 'QRCODE') }}"
        alt="qrcode" class="h-12 w-12" />
    </a>


</div>
