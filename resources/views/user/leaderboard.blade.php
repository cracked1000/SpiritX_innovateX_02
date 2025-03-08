@extends('layouts.app')

@section('content')
    <h1>Leaderboard</h1>
    <ul>
        @forelse ($leaderboard as $entry)
            <li class="{{ auth()->user()->username === $entry['username'] ? 'highlight' : '' }}">
                {{ $entry['username'] }} - {{ $entry['points'] }}
            </li>
        @empty
            <li>No entries yet</li>
        @endforelse
    </ul>
@endsection