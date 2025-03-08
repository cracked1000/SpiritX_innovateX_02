@extends('layouts.app')

@section('content')
    <h1>Budget</h1>
    <p>Remaining Budget: Rs. {{ $budget }}</p>
    <ul>
        @forelse ($team as $player)
            <li>{{ $player }} - Rs. X</li> <!-- Replace X with actual value -->
        @empty
            <li>No players selected</li>
        @endforelse
    </ul>
@endsection