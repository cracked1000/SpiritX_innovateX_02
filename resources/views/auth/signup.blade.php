@extends('layouts.app')

@section('content')
    <h1>Sign Up</h1>
    @if ($errors->any())
        <div>{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('signup') }}">
        @csrf
        <div>
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Sign Up</button>
    </form>
@endsection