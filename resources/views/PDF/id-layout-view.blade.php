{{-- <img style="width: 120px; height: 120px" src="{{ public_path('images/girl.jpg') }}"> --}}

{{-- <img style="width: 120px; height: 120px" src="{{ public_path('storage/users-profile/f9WgazUX0Q5I3w2Fz2KKC6nQP5nGG2-metaMzc5OTcwNzM1XzEwMjY4Njg0NTE3NzM1NzVfMjkzNjYxMTE1MTI0MDUyMjg2N19uLnBuZw==-.png') }}"> --}}
{{-- <h1>{{ $title }}</h1>
<p>{{ $date }}</p>
<p>This is the result of my PDF</p>
<div class="grid grid-cols-3 gap-4">
    <div class="h-24 w-24 bg-red-600"></div>
    <div class="h-24 w-24 bg-blue-600"></div>
    <div class="h-24 w-24 bg-green-600"></div>
</div>
<table class="table" border>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    @foreach ($students as $student)
        <tr>
            <td>
                @if (!empty($student->profile))
                    <img style="width: 120px; height: 120px" src="{{ Storage::disk('public')->url($student->profile)}}">
                @endif
            </td>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
        </tr>
    @endforeach
</table> --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
 

    html,
    body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        margin: 0;
       
        margin: 0 auto;

    }

    .card {
        display: flex;
        width: 384px;
        height: 288px;
        border: 1px solid gray;
        @isset($id_data->bg)
            background-image: url('{{ Storage::disk('public')->url($id_data->bg) }}');
            background-size: cover;
        @else
            background: #D8EDDE;
        @endisset

    }

    .card-content {
        flex: 2;
        padding-top: 8px;

    }

    .graduate-school {
        max-width: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: darkgreen;
        padding: 6px 0px;
    }

    .graduate-school p {
        font-size: 15px;
        font-weight: bolder;
        text-transform: uppercase;
        color: gold;
        writing-mode: vertical-rl;
        text-orientation: upright;
    }


    .image-box img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .qr-container img {
        width: 40px;
        height: 40px;
        background: white;
    }

    .qr-container{

    }

    .card-header-logo {
        display: grid;
        grid-template: 'box box box';
    }

    .sultan-kudarat {
        font-size: 12px;
        text-transform: uppercase;
        color: darkgreen;
        font-weight: bold;

    }

    .image-box {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box-1 img {}

    .card-header-text p {
        font-size: 12px;
        line-height: 1.2;
        padding: 0;
        margin: 0;
        text-align: center;
    }

    .learning {
      
        padding: 8px 0px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .learning p {

        max-width: 300px;
        color: #002060;
        font-size: 12px;
        font-weight: bold;
        padding: 0;
        margin: 0;

    }

    .learning-text {
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        max-width: 500px;
    }

    .student-information {
        min-height: 108px;
        display: flex;
        justify-content: space-around;

    }

    .id-container {
        
        width: 80px;
        height: 80px;
        /* border: 2px solid gray;
        border-style: dashed; */
        border-radius: 8px;

    }

    .dotted-border{
        border: 2px solid gray;
        border-style: dashed;
    }

    .id-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block; /* Show the img element */
}

    .student-box {
        height: 100%;
    }

    .student-box p {
        font-size: 12px;
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    .sb1 {
        padding: 8px;
        margin-left: 4px;

    }

    .sb2 {
        flex-grow: 1;

        padding: 8px;
    }

    .student-name {
        text-transform: capitalize;
        font-size: 14px !important;
        padding: 0;
        margin: 0;
        line-height: 1.2 !important;
        font-weight: bolder;
        font-size: 18px;

    }

    .course {
        line-height: 1.2;
        padding: 0;
        margin: 0;
        font-weight: bold;
    }
    .place{

        text-transform: uppercase;
    }
    .signature-and-line {
        display: flex;
    }

    .signature-and-line p {
        font-weight: bold;
    }

    .signature-line {
        border-bottom: 1px solid black;
        width: 100%;
    }


    .bar-code-area {
        display: grid;
        grid-template: 'b a a';
    }

    .d-text {

        font-style: italic;
        grid-area: 'b';
        max-width: 200px;
        font-size: 12px;
        display: flex;
        padding: 8px;
        align-items: flex-end;
    }

    .d-text p {
        padding: 0;
        margin: 0;
    }
    .this-text{
        font-size: 12px;
    }

    

    .qr-container {
        grid-area: 'a';
        display: flex;
        justify-content: center;
        align-items: center;
    }


    /* // back card */
    .back-card {
        margin-top: 4px;
        width: 384px;
        height: 288px;
        background: #F9F9F9;
        border: 1px solid gray;
        display: flex;
        flex-flow: column;
    }

    .validity {
        background: darkgreen;
        padding: 6px 0px;

    }

    .validity p {
        font-weight: bold;
        font-size: 18px;
        text-align: center;
        padding: 0;
        color: gold;
        margin: 0;
    }

    .box-content {
        text-align: center;
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        margin: 10px;
        border: 1px solid black;
    }

    .box-content-child {
        padding: 8px 4px;   
            flex-grow: 1;

            display: flex;
            flex-flow: column;

    }

    .incase {
        font-size: 12px;
        font-style: italic;
    }

    .back-studen-information p {
        
        padding: 0;
        margin: 0 auto;
        font-weight: bold;
    }

    .back-studen-information{
        max-width: 300px;
        flex-grow: 1;
       
    }


    .signature-space {
        min-height: 50px;
    }

    .director-information {
        max-width: 300px;
    }

    .director-information p {
        padding: 0;
        margin: 0;
    }

    .guardian{
        text-transform: capitalize;
        margin-bottom:4px !important;
    }

    .director-name {
        font-weight: bold;
    }




    .layout {
        display: flex;
        flex-wrap: wrap;

    }

    .gb{
        margin-right:6px;
        margin-bottom:6px;
        page-break-inside: avoid;

    }
    
    .gbs {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .button-container {
        display: flex;
        align-items: center;
    }

    .g-button,
    .k-button {
        font-size: 18px;
        padding: 8px 12px;
        border: none;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .g-button {
        background-color: #36784D;
        margin-right: 10px;
    }

    .g-button:hover {
        background-color: #3c975c;
    }

    .k-button {
        background-color: #36784D;
        display: flex;
        align-items: center;
    }

    .k-button:hover {
        background-color: #3c975c;
    }

    .k-button svg {
        margin-right: 8px;
    }

    .instruction {
        font-size: 18px;
        font-weight: bold;
        color: #666;
        margin-left: 10px;
    }
    .k{
        margin-right: 4px;
    }

    @media print {
        html {
            padding: 10px !important;
        }

        .gb {
            /* Your print-specific styles here */
            page-break-inside: avoid !important; /* Avoid slicing content across pages */
        }

        .gbs {
            display: none !important;
        }
    }
</style>

<body>

    
{{-- 
    @php
    if (!empty($students)) {
        $studentIds = $students->pluck('id')->toArray();
        $url = route('generate-student-id', ['records' => implode(',', $studentIds)]);
    } else {
        $url = null; // or provide a default URL if needed
    }
@endphp

@if ($url)
    <a href="{{ $url }}" class="g-button">GENERATE PDF</a>
    @endif --}}
    <div class="gbs">
        <div class="button-container">
            <button onclick="window.print()" class="k-button k">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="print-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
                PRINT
            </button>
            <p class="instruction">or Ctrl + P to print</p>
        </div>
        <div class="button-container">
            <a href="{{ route('filament.resources.students.index') }}" class="g-button">BACK</a>
          
        </div>
    </div>

    <div class="layout">
        @foreach ($students as $student)
        <div class="gb">

            <div class="card">
                <div class="graduate-school">
                    <p>

                        Graduate School
                    </p>
                </div>
                <div class="card-content">


                    <div class="card-header-logo">
                        <div class="image-box box-1">
                            <img src="{{ asset('images/sksulogo.png') }}" alt="sksu-logo">
                        </div>
                        <div class="card-header-text">
                            <p class="republic">Republic of the Philippines</p>
                            <p class="sultan-kudarat">Sultan Kudarat State Unversity</p>
                            <p class="access">Access, EJC Montilla, 9800 City of Tacurong</p>
                            <p class="province">Province of Sultan Kudarat</p>
                        </div>
                        <div class="image-box box-2">
                            @if(!empty($id_data->logo))
                            <img src="{{ Storage::disk('public')->url($id_data->logo) }}" alt="sksu-logo">
                            @else
                            
                            <img src="{{ asset('images/sksulogo.png') }}" alt="sksu-logo">
                            @endif
                        </div>
                    </div>

                    <div class="learning">
                        <p class="learning-text">
                            University Learning Resource Center (ULRC) Card Access Campus
                        </p>
                    </div>
                    <div class="student-information">
                        <div class="student-box sb1">
                            @if(!empty($student->profile))
                            <div class="id-container ">
                                <img src="{{Storage::disk('public')->url($student->profile)}}" alt="image">
                            </div>

                            @else
                            <div class="id-container dotted-border">
                                {{-- <img src="{{asset('images/girl.jpg')}}" alt="image"> --}}
                            </div>
                            @endif
                            {{-- @if(!empty($student->profile))
                            <div class="id-container ">
                                
                            </div>

                            @else
                           
                            @endif --}}

                            
                        </div>
                        <div class="student-box sb2">
                            <p class="student-name"> 
                            {{ $student->last_name ?? '' }},
                            {{ $student->first_name ?? ''}} {{ $student->middle_name?? '' }}
                            </p>
                            <p class="course">
                                @if ($student->course)
                                {{ $student->course->name }}
                                @endif
                            </p>
                            <p class="student-id-number">
                                ID NO: {{$student->id}}
                            </p>
                            <div class="signature-and-line">
                                <p>Signature:</p>
                                <div class="signature-line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bar-code-area">
                        <div class="d-text">

                            <p class="this-text"> This ID is NON-TRANSFERABLE</p>
                        </div>
                        <div class="qr-container">

                         @php
                            $filename = strtoupper($student->last_name . '-' . $student->first_name . '-' . $student->id_number . '.png');
                            $filePath = 'qrcodes/' . $filename;
                        @endphp
                        
                        @if (Storage::disk('public')->exists($filePath))
                            <img src="{{ asset('storage/' . $filePath) }}" alt="QR Code">
                        @endif
                        
                        
                            {{-- <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG(strval($student->id_number), 'QRCODE') }}"/> --}}
                            
                            {{-- <img src="{{ asset('images/qr.png') }}" alt="qr"> --}}
                        </div>
                    </div>
                </div>



            </div>

            <div class="back-card">
                <div class="validity">
                    <p> VALID UNTIL: {{$id_data->valid_from ?? ''}}- {{$id_data->valid_until ?? ''}} </p>
                </div>
                <div class="box-content">
                    <div class="box-content-child">

                        <p class="incase"> In case of Emergency, Please Notify</p>


                        <div class="back-studen-information">
                            <p class="guardian">
                                {{$student->guardian ?? ''}}

                            </p>
                            <p class="place">
                                {{$student->barangay ?? ''}} , {{$student->city ?? '' }}, {{$student->province ?? ''}}
                                {{-- Sulta Kudarat Sout Cotabto Marbel Center --}}
                            </p>
                            <p>
                                {{$student->guardian_contact_number ?? ''}}
                            </p>
                        </div>

                        <div class="signature-space">

                        </div>

                        <div class="director-information">
                            <p class="director-name">
                                {{-- {{$id_data}} --}}
                                @if($id_data)
                                {{$id_data->director ?? 'No Person was Assigned'}}
                                @else
                                ALNE D. QUINOVERA, Phd
                                @endif

                            </p>
                            <p class="director-title">
                                @if($id_data)
                                {{$id_data->title ?? ' Director, Library Service & Museum'}}
                                @else
                                Director, Library Service & Museum
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>


</body>

</html>
