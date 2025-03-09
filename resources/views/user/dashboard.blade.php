@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Your Dashboard</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-xl font-semibold mb-4 text-gray-700">Your Team (11 Players)</h3>

        <!-- Empty Team Case -->
        @if($selectedPlayers->isEmpty())
            <p class="text-gray-600">No players selected yet. <a href="{{ route('user.select-team') }}" class="text-blue-600 hover:underline">Select your team now!</a></p>
        @else
            <!-- Players Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Category</th>
                            <th class="p-2 border">University</th>
                            <th class="p-2 border">Value (Rs.)</th>
                            <th class="p-2 border">Runs</th>
                            <th class="p-2 border">Wickets</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedPlayers as $player)
                            <tr class="hover:bg-gray-100">
                                <td class="p-2 border">{{ $player->name }}</td>
                                <td class="p-2 border">{{ ucfirst($player->category) }}</td>
                                <td class="p-2 border">{{ $player->university }}</td>
                                <td class="p-2 border">{{ number_format($player->value, 0, '.', ',') }}</td>
                                <td class="p-2 border">{{ $player->total_runs ?? 0 }}</td>
                                <td class="p-2 border">{{ $player->wickets ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Team Summary -->
            <p class="mt-2 text-gray-600">Total Players: {{ $selectedPlayers->count() }}/11</p>

            <!-- Team Completeness Check -->
            @if($selectedPlayers->count() !== 11)
                <p class="text-red-600 mt-2 font-semibold">Warning: Your team should have exactly 11 players!</p>
            @else
                <p class="mt-2 text-gray-600 font-semibold">Total Points: {{ number_format($totalPoints, 2) }}</p>
            @endif
        @endif
    </div>
@endsection