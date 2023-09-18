<table>
    <thead>
        <tr style="background-color: #D6EEEE">
            <th>Campus Name</th>
            <th>Campus ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td width="50">{{ $item->name }}</td>
            <td width="50">{{ $item->id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
