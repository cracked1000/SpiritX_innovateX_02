@extends('layouts.app')

@section('content')
    <h1>Players</h1>
    <ul>
        @forelse ($players as $player)
            <li>{{ $player['name'] }} - {{ $player['university'] }}</li>
        @empty
            <li>No players available</li>
        @endforelse
    </ul>
    <a href="{{ route('user.select-team') }}">Select Team</a>
    <a href="{{ route('user.team') }}">View Team</a>
    <a href="{{ route('user.budget') }}">Budget</a>
    <a href="{{ route('user.leaderboard') }}">Leaderboard</a>
@endsection