<div>

    <a href="{{route('barcode.download',['idNumber'=> $getRecord()->id_number])}}">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(str($getRecord()->id_number), 'S25+')}}" alt="barcode" />
    </a>


</div>
