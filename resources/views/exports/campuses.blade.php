








<table>
    <thead>
    <tr style="background-color: #D6EEEE">
        <th>Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td width="50">{{ $item->name }}</td>
           
        </tr>
    @endforeach
    </tbody>
</table>