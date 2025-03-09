@extends('layouts.app')

@section('title', 'Select Team')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Select Your Team (11 Players)</h1>

        <div class="mb-6">
            <p class="text-lg font-semibold">Remaining Budget: Rs. <span id="remaining-budget">{{ number_format($remainingBudget, 0, '.', ',') }}</span></p>
            <p id="budget-error" class="text-red-600 hidden">Total value exceeds budget of Rs. 9,000,000!</p>
        </div>

        <form method="POST" action="{{ route('user.save-team') }}" id="teamForm">
            @csrf

            <h3 class="text-xl font-semibold mb-4 text-gray-700">Batsmen (Select 1)</h3>
            <select name="batsman_1" id="batsman_1" required class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Batsman</option>
                @foreach($batsmen as $player)
                    <option value="{{ $player->id }}" data-value="{{ $player->value }}" {{ $selectedPlayers->contains('id', $player->id) ? 'selected' : '' }}>
                        {{ $player->name }} ({{ $player->university }}) - Rs. {{ number_format($player->value, 0, '.', ',') }}
                    </option>
                @endforeach
            </select>

            <h3 class="text-xl font-semibold mb-4 text-gray-700">Bowlers (Select 6)</h3>
            @for($i = 1; $i <= 6; $i++)
                <select name="bowler_{{ $i }}" id="bowler_{{ $i }}" required class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Bowler {{ $i }}</option>
                    @foreach($bowlers as $player)
                        <option value="{{ $player->id }}" data-value="{{ $player->value }}" {{ $selectedPlayers->contains('id', $player->id) ? 'selected' : '' }}>
                            {{ $player->name }} ({{ $player->university }}) - Rs. {{ number_format($player->value, 0, '.', ',') }}
                        </option>
                    @endforeach
                </select>
            @endfor

            <h3 class="text-xl font-semibold mb-4 text-gray-700">All-Rounders (Select 4)</h3>
            @for($i = 1; $i <= 4; $i++)
                <select name="all_rounder_{{ $i }}" id="all_rounder_{{ $i }}" required class="w-full p-2 mb-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select All-Rounder {{ $i }}</option>
                    @foreach($allRounders as $player)
                        <option value="{{ $player->id }}" data-value="{{ $player->value }}" {{ $selectedPlayers->contains('id', $player->id) ? 'selected' : '' }}>
                            {{ $player->name }} ({{ $player->university }}) - Rs. {{ number_format($player->value, 0, '.', ',') }}
                        </option>
                    @endforeach
                </select>
            @endfor

            <p class="text-gray-600 mb-4">Total players selected must be exactly 11 (1 Batsman, 6 Bowlers, 4 All-Rounders). Budget limit: Rs. 9,000,000.</p>

            <button type="submit" id="saveTeamBtn" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:bg-gray-400 disabled:cursor-not-allowed">
                Save Team
            </button>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                const MAX_BUDGET = 9000000;
                let totalValue = 0;

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
                    totalValue = 0;
                    $('select[required]').each(function() {
                        const val = $(this).val();
                        if (val) {
                            const value = parseInt($(this).find(`option[value="${val}"]`).data('value')) || 0;
                            totalValue += value;
                        }
                    });

                    const remainingBudget = MAX_BUDGET - totalValue;
                    $('#remaining-budget').text(remainingBudget.toLocaleString());
                    $('#budget-error').toggleClass('hidden', totalValue <= MAX_BUDGET);

                    const batsmenCount = $('select[id^="batsman_"]').filter(function() { return $(this).val() !== ""; }).length;
                    const bowlersCount = $('select[id^="bowler_"]').filter(function() { return $(this).val() !== ""; }).length;
                    const allRoundersCount = $('select[id^="all_rounder_"]').filter(function() { return $(this).val() !== ""; }).length;
                    const isValidSelection = batsmenCount === 1 && bowlersCount === 6 && allRoundersCount === 4;
                    const isWithinBudget = totalValue <= MAX_BUDGET;

                    $('#saveTeamBtn').prop('disabled', !isValidSelection || !isWithinBudget);
                    if (!isValidSelection) {
                        $('#saveTeamBtn').prop('title', 'Must select exactly 1 Batsman, 6 Bowlers, and 4 All-Rounders');
                    } else if (!isWithinBudget) {
                        $('#saveTeamBtn').prop('title', 'Total value exceeds budget of Rs. 9,000,000!');
                    } else {
                        $('#saveTeamBtn').prop('title', '');
                    }

                    updateOptions();
                }

                $('select[required]').on('change', updateBudget);
                updateBudget();
            });
        </script>
    </div>
@endsection