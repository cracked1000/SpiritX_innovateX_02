<h1>Select Your Team (11 Players)</h1>

<form method="POST" action="{{ route('user.save-team') }}" id="teamForm">
    @csrf

    <div id="budget-container">
        <p>Current Budget: <span id="remaining-budget">{{ auth()->user()->budget }}</span> (Original: 9,000,000)</p>
        <p>Total Selected Value: <span id="total-value">0</span></p>
    </div>

    <h3>Batsmen (Select 1)</h3>
    <select name="batsman_1" id="batsman_1" required>
        <option value="">Select Batsman</option>
        @foreach($batsmen as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>

    <h3>Bowlers (Select 6)</h3>
    <select name="bowler_1" id="bowler_1" required>
        <option value="">Select Bowler 1</option>
        @foreach($bowlers as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="bowler_2" id="bowler_2" required>
        <option value="">Select Bowler 2</option>
        @foreach($bowlers as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="bowler_3" id="bowler_3" required>
        <option value="">Select Bowler 3</option>
        @foreach($bowlers as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="bowler_4" id="bowler_4" required>
        <option value="">Select Bowler 4</option>
        @foreach($bowlers as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="bowler_5" id="bowler_5" required>
        <option value="">Select Bowler 5</option>
        @foreach($bowlers as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="bowler_6" id="bowler_6" required>
        <option value="">Select Bowler 6</option>
        @foreach($bowlers as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>

    <h3>All-Rounders (Select 4)</h3>
    <select name="all_rounder_1" id="all_rounder_1" required>
        <option value="">Select All-Rounder 1</option>
        @foreach($allRounders as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="all_rounder_2" id="all_rounder_2" required>
        <option value="">Select All-Rounder 2</option>
        @foreach($allRounders as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="all_rounder_3" id="all_rounder_3" required>
        <option value="">Select All-Rounder 3</option>
        @foreach($allRounders as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>
    <select name="all_rounder_4" id="all_rounder_4" required>
        <option value="">Select All-Rounder 4</option>
        @foreach($allRounders as $player)
            <option value="{{ $player->id }}" data-value="{{ $player->value }}">{{ $player->name }} ({{ $player->university }}) - {{ $player->value }}</option>
        @endforeach
    </select>

    <p>Total players selected must be exactly 11 (1 Batsman, 6 Bowlers, 4 All-Rounders).</p>
    <br><br>
    <button type="submit" id="saveTeamBtn">Save Team</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const initialBudget = {{ auth()->user()->budget }};
        let remainingBudget = initialBudget;
        let totalValue = 0;

        function updateOptions() {
            const selectedIds = [];
            $('select[required]').each(function() {
                const val = $(this).val();
                if (val) selectedIds.push(val);
            });

            $('select[required] option').prop('disabled', false); // Reset all options
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

            remainingBudget = initialBudget - totalValue;
            $('#remaining-budget').text(remainingBudget);
            $('#total-value').text(totalValue);

            // Validate selection (1 Batsman, 6 Bowlers, 4 All-Rounders)
            const batsmenCount = $('select[id^="batsman_"]').filter(function() { return $(this).val() !== ""; }).length;
            const bowlersCount = $('select[id^="bowler_"]').filter(function() { return $(this).val() !== ""; }).length;
            const allRoundersCount = $('select[id^="all_rounder_"]').filter(function() { return $(this).val() !== ""; }).length;
            const isValidSelection = batsmenCount === 1 && bowlersCount === 6 && allRoundersCount === 4 && remainingBudget >= 0;

            $('#saveTeamBtn').prop('disabled', !isValidSelection);
            if (batsmenCount !== 1 || bowlersCount !== 6 || allRoundersCount !== 4) {
                $('#saveTeamBtn').prop('title', 'Must select exactly 1 Batsman, 6 Bowlers, and 4 All-Rounders');
            } else if (remainingBudget < 0) {
                $('#saveTeamBtn').prop('title', 'Budget exceeded');
            } else {
                $('#saveTeamBtn').prop('title', '');
            }

            updateOptions(); // Update disabled options after each change
        }

        $('select[required]').on('change', updateBudget);
        updateBudget(); // Initial call

        // Debug: Log counts on change
        $('select[required]').on('change', function() {
            const batsmenCount = $('select[id^="batsman_"]').filter(function() { return $(this).val() !== ""; }).length;
            const bowlersCount = $('select[id^="bowler_"]').filter(function() { return $(this).val() !== ""; }).length;
            const allRoundersCount = $('select[id^="all_rounder_"]').filter(function() { return $(this).val() !== ""; }).length;
            console.log('Batsmen:', batsmenCount, 'Bowlers:', bowlersCount, 'All-Rounders:', allRoundersCount);
        });
    });
</script>

<style>
    select {
        width: 300px;
        margin-bottom: 10px;
    }
    #budget-container {
        margin-bottom: 20px;
        font-weight: bold;
    }
    #saveTeamBtn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }
    option:disabled {
        color: #ccc;
    }
</style>