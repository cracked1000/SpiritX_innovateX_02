@extends('layouts.app')

@section('content')
    <h1>Players</h1>
    <ul>
        @forelse ($players as $player)
            <li>{{ $player['name'] }}</li>
        @empty
            <li>No players available</li>
        @endforelse
    </ul>
@endsection