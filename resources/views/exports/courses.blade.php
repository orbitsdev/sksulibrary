<table>
    <thead>
        <tr style="background-color: #D6EEEE">
            <th style="background-color: #D6EEEE" >Course Name</th>
            <th style="background-color: #D6EEEE" >Prefix </th>
            <th style="background-color: #D6EEEE" >Course Id</th>
            <th style="background-color: #D6EEEE" >Campus Id</th>
            {{-- <th style="background-color: #D6EEEE" >Course Reference (BASIS FOR COURSE NAME)</th>
            <th style="background-color: #D6EEEE" >Campus Reference (BASIS FOR CAMPUS NAME)</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td align="left" width="50">{{ $item->name ?? '' }}</td>
            <td align="left" width="50">{{ $item->sub_name ?? '' }}</td>
            <td align="left" width="50">{{ $item->id ?? '' }}</td>
            <td align="left" width="50">{{ $item->campus->id ?? '' }}</td>
            {{-- <td align="left" width="50">{{ $item->name ?? '' }} = {{ $item->id ?? '' }}</td>
            <td align="left" width="50">
                @if (!empty($item->campus))
                {{ $item->campus->name ?? '' }} = {{ $item->campus->id ?? '' }}
                @endif
            </td> --}}
        </tr>
        @endforeach
        
    </tbody>
</table>
