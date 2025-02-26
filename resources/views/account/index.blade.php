@extends('layouts.app')

@section('content')

    <h2>Name: {{ $user->name }}</h2>
    <h3>Email: {{ $user->email }}</h3>

    <form action="{{ route('account.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="profile_picture">Upload Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture">
        </div>
        <button type="submit">Upload</button>
    </form>

    @if ($user->profile_picture)
        <div>
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture">
        </div>
    @endif

@endsection
