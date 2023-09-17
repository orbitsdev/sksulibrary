








<table>
    <thead>
    <tr style="background-color: #D6EEEE">
        <th>Id Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Middle Name</th>
        <th>Sex </th>
        <th>Contact Number </th>
        <th>Street Address </th>
        <th>City </th>
        <th>Country </th>
      
        <th>Postal Code </th>
        <th>Campus Name </th>
        <th>Course Name </th>
       
       
        <th>Year</th>
        <th>Campus Id </th>
        <th>Course Id </th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td width="30">{{ $item?->id_number }}</td>
            <td width="40">{{ $item?->first_name }}</td>
            <td width="40">{{ $item?->last_name }}</td>
            <td width="40">{{ $item?->middle_name }}</td>
            <td width="40">{{ $item?->sex }}</td>
            <td width="40">{{ $item?->contact_number }}</td>
            <td width="40">{{ $item?->street_address }}</td>
            <td width="40">{{ $item?->city }}</td>
            <td width="40">{{ $item?->country }}</td>
            <td width="40">{{ $item?->postal_code }}</td>
            <td width="40">{{ $item?->campus?->name }}</td>
            <td width="40">{{ $item?->course?->name }}</td>
           
            <td width="40">{{ $item?->year }}</td>
            <td width="40">{{ $item?->campus?->id }}</td>
            <td width="40">{{ $item?->course?->id }}</td>
           
        </tr>
    @endforeach
    </tbody>
</table>