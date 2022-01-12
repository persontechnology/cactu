@foreach ($ar->users_m as $user)
    <span>{{ $user->name }} <i>{{ $user->email }}</i></span><br>
@endforeach