








<table>
    <thead>
    <tr style="background-color: #D6EEEE">
        <th>Course Name</th>
        <th>Campus Id</th>        
        <th>Course Refference (BASIS FOR COURSE NAME)</th>
        <th>Campus Refference (BASIC FOR CAMPUS NAME)</th>

    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td align="left"  width="50">{{ $item?->name }}</td>
            <td align="left"  width="50">{{ $item?->campus?->id }}</td>
            <td align="left"  width="50">{{$item?->name}} = {{ $item?->id }} </td>
            <td align="left"  width="50">{{$item?->campus?->name}} = {{ $item?->campus?->id }} </td>
        </tr>
    @endforeach
    </tbody>
</table>