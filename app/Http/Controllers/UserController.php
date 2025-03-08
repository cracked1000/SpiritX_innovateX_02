<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;


class UserController extends Controller
{

    public function team()
    {
        $team = session('team', []);
        $totalPoints = count($team) === 11 ? 0 : null; // Placeholder
        return view('user.team', compact('team', 'totalPoints'));
    }

    public function removePlayer(Request $request)
    {
        $playerId = $request->input('player_id');
        $team = session('team', []);
        if (($key = array_search($playerId, $team)) !== false) {
            unset($team[$key]);
            session(['team' => array_values($team)]);
        }
        return redirect()->route('user.team');
    }

    public function budget()
    {
        $user = Auth::user();
        $team = session('team', []);
        $budget = $user->budget; // Placeholder
        return view('user.budget', compact('budget', 'team'));
    }

    public function leaderboard()
    {
        // Placeholder: Replace with DB data later
        $leaderboard = [];
        return view('user.leaderboard', compact('leaderboard'));
    }

    public function selectTeam()
{
    /** @var \App\Models\User $user */
    $user = auth()->user();

    // Reset budget and team if needed
    if ($user->players()->count() > 0) {
        $user->players()->detach(); // Clear existing team
        $user->budget = 9000000; // Reset budget to initial value
        $user->save();
    }

    $batsmen = Player::where('category', 'Batsman')->get();
    $bowlers = Player::where('category', 'Bowler')->get();
    $allRounders = Player::where('category', 'All-Rounder')->get();

    return view('user.select-team', compact('batsmen', 'bowlers', 'allRounders'));
}

public function saveTeam(Request $request)
{
    /** @var \App\Models\User $user */
    $user = auth()->user();

    // Validate the selected player IDs
    $validated = $request->validate([
        'batsman_1' => 'required|exists:players,id',
        'bowler_1' => 'required|exists:players,id',
        'bowler_2' => 'required|exists:players,id',
        'bowler_3' => 'required|exists:players,id',
        'bowler_4' => 'required|exists:players,id',
        'all_rounder_1' => 'required|exists:players,id',
        'all_rounder_2' => 'required|exists:players,id',
        'all_rounder_3' => 'required|exists:players,id',
        'all_rounder_4' => 'required|exists:players,id',
        'all_rounder_5' => 'required|exists:players,id',
        'all_rounder_6' => 'required|exists:players,id',
    ]);

    // Collect all selected player IDs
    $selectedPlayerIds = [
        $request->input('batsman_1'),
        $request->input('bowler_1'),
        $request->input('bowler_2'),
        $request->input('bowler_3'),
        $request->input('bowler_4'),
        $request->input('all_rounder_1'),
        $request->input('all_rounder_2'),
        $request->input('all_rounder_3'),
        $request->input('all_rounder_4'),
        $request->input('all_rounder_5'),
        $request->input('all_rounder_6'),
    ];

    // Check for duplicates
    if (count(array_unique($selectedPlayerIds)) !== 11) {
        return redirect()->back()->withErrors(['team' => 'Cannot select the same player twice. Please choose unique players for all positions.']);
    }

    // Calculate total value of selected players
    $selectedPlayers = Player::whereIn('id', $selectedPlayerIds)->get();
    $totalValue = $selectedPlayers->sum('value');

    // Check if user has enough budget
    if ($totalValue > $user->budget) {
        return redirect()->back()->withErrors(['budget' => 'Selected players exceed your budget of ' . $user->budget]);
    }

    // Save the team to user_players pivot table
    $user->players()->sync($selectedPlayerIds);

    // Deduct the total value from the user's budget
    $user->budget -= $totalValue;
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Team successfully saved with 11 unique players!');
}
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $selectedPlayers = $user->players;

        return view('user.dashboard', compact('user', 'selectedPlayers'));
    }
    public function players()
{
    // Placeholder: Replace with DB data later
    $players = [];
    return view('user.players', compact('players'));
}
}
