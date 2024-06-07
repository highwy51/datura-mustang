@extends('user.layout')


@section('profile-title')
    {{ $user->name }}'s Herds
@endsection

@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Herds' => $user->url . '/herds']) !!}

    <h1>
        {!! $user->displayName !!}'s Herds
    </h1>

    <div class= "dropdown-divider"></div>

    @foreach ($groupedCharacters as $herd => $characters)
        <h5> {{ $herd }} </h5>
                @include('user._characters', ['characters' => $characters, 'myo' => false])
        <div class="dropdown-divider"></div>
    @endforeach

@endsection
