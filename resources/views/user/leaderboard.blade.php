@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Leaderboard</h1>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Rank</th>
                    <th class="p-2 border">Username</th>
                    <th class="p-2 border">Total Points</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $index + 1 }}</td>
                        <td class="p-2 border">{{ $user->username }}</td>
                        <td class="p-2 border">{{ $user->total_points }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2 border text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection