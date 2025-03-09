@extends('layouts.app')

@section('title', 'Edit Team')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Your Team</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.save-team') }}" id="teamForm">
            @csrf
            <!-- Reuse select-team logic with pre-selected values -->
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Batsmen (Select 1)</h3>
            <select name="batsman_1" id="batsman_1" required class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Batsman</option>
                @foreach($batsmen as $player)
                    <option value="{{ $player->id }}" data-value="{{ $player->value }}" {{ $selectedPlayers->where('category', 'batsman')->first()->id == $player->id ? 'selected' : '' }}>
                        {{ $player->name }} ({{ $player->university }}) - {{ $player->value }}
                    </option>
                @endforeach
            </select>

            <!-- Repeat for bowlers and all-rounders with pre-selection -->
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Bowlers (Select 6)</h3>
            <select name="bowler_1" id="bowler_1" required class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Bowler 1</option>
                @foreach($bowlers as $player)
                    <option value="{{ $player->id }}" data-value="{{ $player->value }}">
                        {{ $player->name }} ({{ $player->university }}) - {{ $player->value }}
                    </option>
                @endforeach
            </select>
            <!-- Add more bowler selects similarly -->

            <h3 class="text-xl font-semibold mb-4 text-gray-700">All-Rounders (Select 4)</h3>
            <select name="all_rounder_1" id="all_rounder_1" required class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select All-Rounder 1</option>
                @foreach($allRounders as $player)
                    <option value="{{ $player->id }}" data-value="{{ $player->value }}">
                        {{ $player->name }} ({{ $player->university }}) - {{ $player->value }}
                    </option>
                @endforeach
            </select>
            <!-- Add more all-rounder selects similarly -->

            <button type="submit" id="saveTeamBtn" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Save Changes
            </button>
        </form>

        <h3 class="text-xl font-semibold mt-6 mb-4 text-gray-700">Remove Players</h3>
        @if($selectedPlayers->isNotEmpty())
            <ul class="list-disc pl-5 space-y-2">
                @foreach($selectedPlayers as $player)
                    <li class="text-gray-800">
                        {{ $player->name }} ({{ $player->category }}) - {{ $player->value }}
                        <form method="POST" action="{{ route('user.remove-player') }}" class="inline">
                            @csrf
                            <input type="hidden" name="player_id" value="{{ $player->id }}">
                            <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">No players to remove.</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let totalValue = 0;
            const MAX_BUDGET = 100;

            function updateOptions() {
                const selectedIds = [];
                $('select[required]').each(function() {
                    const val = $(this).val();
                    if (val) selectedIds.push(val);
                });

                $('select[required] option').prop('disabled', false);
                $('select[required]').each(function() {
                    const currentVal = $(this).val();
                    $(this).find('option').each(function() {
                        if (selectedIds.includes($(this).val()) && $(this).val() !== currentVal) {
                            $(this).prop('disabled', true);
                        }
                    });
                });
            }

            function updateBudget() {
                const selectedIds = [];
                let totalSelected = 0;
                totalValue = 0;

                $('select[required]').each(function() {
                    const val = $(this).val();
                    if (val) {
                        selectedIds.push(val);
                        totalSelected++;
                        const value = $(this).find(`option[value="${val}"]`).data('value') || 0;
                        totalValue += parseInt(value);
                    }
                });

                $('#total-value').text(totalValue);
                $('#budget-error').toggleClass('hidden', totalValue <= MAX_BUDGET);

                const isValidSelection = totalSelected === 11;
                const isWithinBudget = totalValue <= MAX_BUDGET;

                $('#saveTeamBtn').prop('disabled', !isValidSelection || !isWithinBudget);
                if (totalSelected !== 11) {
                    $('#saveTeamBtn').prop('title', 'Must select exactly 11 players');
                } else if (!isWithinBudget) {
                    $('#saveTeamBtn').prop('title', 'Total value exceeds budget of 100!');
                } else {
                    $('#saveTeamBtn').prop('title', '');
                }

                updateOptions();
            }

            $('select[required]').on('change', updateBudget);
            updateBudget();
        });
    </script>
@endsection