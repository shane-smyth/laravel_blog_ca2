@extends('layouts.app')

@section('content')

    <h2>Name: {{ $user->name }}</h2>
    <h3>Email: {{ $user->email }}</h3>

    @if ($user->profile_picture)
        <div>
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
        </div>
    @endif

@endsection
