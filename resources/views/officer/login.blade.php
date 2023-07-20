


<x-que-layout>

    <form method="POST" action="{{route('officer.login')}}">
        @csrf

        <input type="text" name="login_id">

        <button type="submit"> Login</button>
    </form>

</x-que-layout>