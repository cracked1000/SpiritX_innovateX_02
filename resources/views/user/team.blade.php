@extends('layouts.app')

@section('content')
    <h1>Your Team ({{ count($team) }}/11)</h1>
    <ul>
        @forelse ($team as $player)
            <li>
                {{ $player }}
                <form method="POST" action="{{ route('user.remove-player') }}" style="display:inline;">
                    @csrf
                    <button name="player_id" value="{{ $player }}" type="submit">Remove</button>
                </form>
            </li>
        @empty
            <li>No players selected</li>
        @endforelse
    </ul>
    @if ($totalPoints !== null)
        <p>Total Points: {{ $totalPoints }}</p>
    @endif
@endsection