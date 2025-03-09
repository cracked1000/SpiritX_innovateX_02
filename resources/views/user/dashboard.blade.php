@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Your Dashboard</h1>

        <!-- Display success message only once -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-4">Your Team ({{ $selectedPlayers->count() }} Players)</h2>
            @if ($selectedPlayers->count())
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
                        @foreach ($selectedPlayers as $player)
                            <tr class="hover:bg-gray-100">
                                <td class="p-2 border">{{ $player->name }}</td>
                                <td class="p-2 border">{{ $player->category }}</td>
                                <td class="p-2 border">{{ $player->university }}</td>
                                <td class="p-2 border">{{ number_format($player->value) }}</td>
                                <td class="p-2 border">{{ $player->total_runs }}</td>
                                <td class="p-2 border">{{ $player->wickets }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No players selected yet.</p>
            @endif
        </div>

        <!-- Ensure no additional success message blocks -->
    </div>
@endsection