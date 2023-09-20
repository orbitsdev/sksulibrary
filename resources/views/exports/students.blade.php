<table align="left">
    <thead>
        <tr style="background-color: #D6EEEE">
            <th>Id Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Middle Name</th>
            <th>Sex</th>
            <th>Phone Number</th>
            <th>Street Address</th>
            <th>City</th>
            <th>Country</th>
            <th>Postal Code</th>
         
            <th>Year</th>
            <th>Campus Id</th>
            <th>Course Id</th>
            {{-- <th>Course Reference</th>
            <th>Campus Reference</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td align="left"width="40">{{ $item?->id_number }}</td>
            <td align="left" width="40">{{ $item?->first_name }}</td>
            <td align="left" width="40">{{ $item?->last_name }}</td>
            <td align="left" width="40">{{ $item?->middle_name }}</td>
            <td align="left" width="40">{{ $item?->sex }}</td>
            <td align="left" width="40">{{ $item?->contact_number }}</td>
            <td align="left" width="40">{{ $item?->street_address }}</td>
            <td align="left" width="40">{{ $item?->city }}</td>
            <td align="left" width="40">{{ $item?->country }}</td>
            <td align="left" width="40">{{ $item?->postal_code }}</td>
            <td align="left" width="40">{{ $item?->year }}</td>
            <td align="left" width="40">{{ empty($item->course) ? '' : $item->course->id }}</td>
            <td align="left" width="40">{{ empty($item->course) || empty($item->course->campus) ? '' : $item->course->campus->id }}</td>
            {{-- <td align="left" width="40">
                @if (empty($item->course) || empty($item->course->campus))
                    {{ '' }}
                @else
                    {{ $item->course->campus->name }}
                @endif
            </td> --}}
            

            
            
        </tr>
        @endforeach
    </tbody>
</table>
