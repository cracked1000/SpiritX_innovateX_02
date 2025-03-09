@extends('layouts.app')

@section('title', 'Admin - Players')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Manage Players</h1>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Category</th>
                    <th class="p-2 border">University</th>
                    <th class="p-2 border">Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $player->name }}</td>
                        <td class="p-2 border">{{ $player->category }}</td>
                        <td class="p-2 border">{{ $player->university }}</td>
                        <td class="p-2 border">{{ $player->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection