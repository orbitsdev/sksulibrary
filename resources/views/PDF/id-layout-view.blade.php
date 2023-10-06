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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body{
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        p {
            padding: 0;
            margin: 0;
        }

        .card {
            display: flex;
            background: #eef1dc;
            width: 3.370in;
            min-height: 2.125in;
            border: 1px solid #000;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .card-header {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .republic,
        .province {
            font-size: 12px;
        }
        .sultan-kudarat{
            font-size: 12px;
        }
        .access {
            font-size: 12px;
            font-weight: bold;
        }

        .card-side-content-text {
            padding: 2px;
            width: 24px;
            height: 100%;
            background: #003200;
            color: #FFC000;
            text-transform: uppercase;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 8px; /* Border radius for top-left corner */
             border-bottom-left-radius: 8px; 
        }

        .card-side-content-text p {
            font-size: 12px;
            font-weight: bold;
            border-radius: 20px;
       
            margin: 0; /* Adjust margin for better spacing */
            padding: 5px; /* Adjust padding for better spacing */
        }

        .university{
            font-size: 12px;
        }

        .image-container{
            width: 60px;
            height: 60px;
            border-radius: 8px;
            border: 2px solid #94a3b8;
            border-style: dashed;
            
        }

        .bar-code{
            font-size: 12px;
            display:flex; 
            justify-content:center; 
            align-items: flex-end;
        }

        .signature-line{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-side-content-text">
            <p>
                G<br>
                r<br>
                a<br>
                d<br>
                u<br>
                a<br>
                t<br>
                e<br>
                &nbsp;<br>
                S<br>
                c<br>
                h<br>
                o<br>
                o<br>
                l<br>
            </p>
        </div>
        <div class="card-side-content">
            <div class="card-header">
                <img style="width: 40px; height: 40px" src="{{ asset('images/sksulogo.png') }}" />
                <div>
                    <p class="republic">Republic of The Philippines</p>
                    <p class="sultan-kudarat">Sultan Kudarat State University</p>
                    <p class="access" style="text-transform: uppercase; color:#009B37">ACCESS, EJC Montilla,
                        9800 City of Tacurong</p>
                    <p class="province">Province of Sultan Kudarat</p>
                </div>
                <img style="width: 40px; height: 40px" src="{{ asset('images/sksulogo.png') }}" />
            </div>

            <div class="card-body">
                <p class="university" style="text-align: center; font-weight: bold; color: #002060">University
                    Learning, Resource Center (ULRC) CARD ACCESS CAMPUS</p>
            </div>

             <div class="bar-code" >
                <div class="image-container" >
                    <!-- Content or image can be added here -->
                </div>
                <div>
                    <p>Kristine Kate Magsaysay</p>
                    <p>Bachelor of Science and Computer Science</p>
                    <p>ID NO.: 20-0634 </p>
                    <div class="signature" style="display: flex; justify-content:space-between; align-items: center">
                        <p>Signature</p>
                        <div  class="signature-line" style="flex:2; background:red; boder-bottom:2px solid black"> </div>
                    </div>
                </div>
                
             <div>

        </div>
    </div>
</body>

</html>
