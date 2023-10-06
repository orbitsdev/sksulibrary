{{-- <img style="width: 120px; height: 120px" src="{{ public_path('images/girl.jpg') }}"> --}}

{{-- <img style="width: 120px; height: 120px" src="{{ public_path('storage/users-profile/f9WgazUX0Q5I3w2Fz2KKC6nQP5nGG2-metaMzc5OTcwNzM1XzEwMjY4Njg0NTE3NzM1NzVfMjkzNjYxMTE1MTI0MDUyMjg2N19uLnBuZw==-.png') }}"> --}}
<img style="width: 120px; height: 120px" src="{{ public_path('storage/users-profile/f9WgazUX0Q5I3w2Fz2KKC6nQP5nGG2-metaMzc5OTcwNzM1XzEwMjY4Njg0NTE3NzM1NzVfMjkzNjYxMTE1MTI0MDUyMjg2N19uLnBuZw==-.png') }}">
<h1>{{ $title }}</h1>
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
    @foreach($students as $user)
        <tr>
            <td>
                @if(!empty($user->profile))
                    <img style="width: 120px; height: 120px" src="{{ public_path('storage/'.$user->profile) }}">
                @endif
            </td>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    @endforeach
</table>
