<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function team()
{
    $user = Auth::user();
    $team = $user->players;
    $totalPoints = $team->count() === 11 ? $team->sum('points') : null;
    return view('user.team', compact('team', 'totalPoints'));
}

public function leaderboard()
    {
        // Fetch users with their players, eager load the relationship
        $users = User::with('players')
            ->get()
            ->map(function ($user) {
                // Calculate total points only if the user has exactly 11 players, then round it
                $user->total_points = $user->players->count() === 11 
                    ? round($user->players->sum('points')) 
                    : 0;
                return $user;
            })
            ->sortByDesc('total_points')
            ->values(); // Reset keys after sorting for clean indexing

        return view('user.leaderboard', compact('users'));
    }
    public function editTeam()
    {
        $user = Auth::user();
        $selectedPlayers = $user->players;
        $batsmen = Player::where('category', 'batsman')->whereNotIn('id', $selectedPlayers->pluck('id'))->get();
        $bowlers = Player::where('category', 'bowler')->whereNotIn('id', $selectedPlayers->pluck('id'))->get();
        $allRounders = Player::where('category', 'all-rounder')->whereNotIn('id', $selectedPlayers->pluck('id'))->get();

        return view('edit-team', compact('selectedPlayers', 'batsmen', 'bowlers', 'allRounders'));
    }

  
    public function removePlayer(Request $request)
{
    $request->validate(['player_id' => 'required|exists:players,id']);
    $user = Auth::user();
    $player = Player::find($request->input('player_id'));
    $user->players()->detach($player->id);
    $user->budget += $player->value;
    $user->save();
    return redirect()->route('user.dashboard')->with('success', 'Player removed successfully!');
}

    public function budget()
    {
        $user = Auth::user();
        $teamCost = $user->players->sum('value');
        $remainingBudget = 9000000 - $teamCost; // Assuming initial budget of Rs.9,000,000
        return view('user.budget', compact('remainingBudget', 'teamCost'));
    }

    public function selectTeam()
    {
        $user = Auth::user();
        $selectedPlayers = $user->players;
        $totalSpent = $selectedPlayers->sum('value');
        $initialBudget = 9000000; // Initial budget of Rs. 9,000,000
        $remainingBudget = $initialBudget - $totalSpent;

        // If user has a team, don't reset it here; just show the current state
        $batsmen = Player::where('category', 'batsman')->get();
        $bowlers = Player::where('category', 'bowler')->get();
        $allRounders = Player::where('category', 'all-rounder')->get();

        return view('user.select-team', compact('batsmen', 'bowlers', 'allRounders', 'remainingBudget', 'selectedPlayers'));
    }

    /**
     * Save the selected team with budget validation.
     */
    public function saveTeam(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'batsman_1' => 'required|exists:players,id',
            'bowler_1' => 'required|exists:players,id',
            'bowler_2' => 'required|exists:players,id',
            'bowler_3' => 'required|exists:players,id',
            'bowler_4' => 'required|exists:players,id',
            'bowler_5' => 'required|exists:players,id',
            'bowler_6' => 'required|exists:players,id',
            'all_rounder_1' => 'required|exists:players,id',
            'all_rounder_2' => 'required|exists:players,id',
            'all_rounder_3' => 'required|exists:players,id',
            'all_rounder_4' => 'required|exists:players,id',
        ]);

        $selectedPlayerIds = [
            $request->input('batsman_1'),
            $request->input('bowler_1'),
            $request->input('bowler_2'),
            $request->input('bowler_3'),
            $request->input('bowler_4'),
            $request->input('bowler_5'),
            $request->input('bowler_6'),
            $request->input('all_rounder_1'),
            $request->input('all_rounder_2'),
            $request->input('all_rounder_3'),
            $request->input('all_rounder_4'),
        ];

        // Check for duplicate players
        if (count(array_unique($selectedPlayerIds)) !== 11) {
            return redirect()->back()->withErrors(['team' => 'Cannot select the same player twice.']);
        }

        $selectedPlayers = Player::findMany($selectedPlayerIds);
        $totalValue = $selectedPlayers->sum('value');
        $initialBudget = 9000000;

        // Check if total value exceeds remaining budget
        if ($totalValue > $initialBudget) {
            return redirect()->back()->withErrors(['team' => 'Total player value exceeds the budget of Rs. 9,000,000!']);
        }

        // Sync players and update budget
        $user->players()->sync($selectedPlayerIds);
        $user->budget = $initialBudget - $totalValue; // Update budget
        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Team saved successfully!');
    }

    // Other methods remain unchanged for this correction


    /**
     * Display the user's dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $selectedPlayers = $user->players; // Assumes a many-to-many relationship with Player model
        $totalPoints = $selectedPlayers->count() === 11 ? $selectedPlayers->sum('points') : null;

        return view('user.dashboard', compact('selectedPlayers', 'totalPoints'));
    }

    /**
     * Display the list of all players for users.
     */
    public function players()
    {
        $players = Player::select('id', 'name', 'category', 'value')->get(); // Exclude points
        return view('user.players', compact('players'));
    }

    /**
     * Display the user's profile.
     */
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'password' => 'nullable|min:8|regex:/[A-Z]/|regex:/[0-9]/|confirmed',
        ]);

        $user->username = $request->input('username');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}
