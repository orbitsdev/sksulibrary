








<table>
    <thead>
    <tr style="background-color: #D6EEEE">
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td width="50">{{ $user->name }}</td>
            <td width="50">{{ $user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>