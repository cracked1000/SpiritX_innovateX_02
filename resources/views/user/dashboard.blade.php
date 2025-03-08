<h1>Your Dashboard</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<h3>Your Team (11 Players)</h3>
@if($selectedPlayers->isEmpty())
    <p>No players selected yet.</p>
@else
    <ul>
        @foreach($selectedPlayers as $player)
            <li>{{ $player->name }} ({{ $player->category }}) - {{ $player->university }} - Value: {{ $player->value }}</li>
        @endforeach
    </ul>
    <p>Total Players: {{ $selectedPlayers->count() }}</p>
    @if($selectedPlayers->count() !== 11)
        <p style="color: red;">Warning: Your team should have exactly 11 players!</p>
    @endif
@endif

<p>Remaining Budget: {{ $user->budget }}</p>

<a href="{{ route('user.select-team') }}">Change Team</a>
<a href="{{ route('logout') }}">Logout</a>