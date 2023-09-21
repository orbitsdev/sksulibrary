<div>

    <a href="{{route('barcode.download',['idNumber'=> 111])}}">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(str($getRecord()->id_number), 'S25+')}}" alt="barcode" />
    </a>


</div>
