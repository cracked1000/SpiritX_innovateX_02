<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Apply the 'admin' middleware to ensure only admins can access these methods.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of all players.
     */
    public function players()
    {
        $players = Player::paginate(10); // Paginate for better performance
        return view('admin.players', compact('players'));
    }

    /**
     * Show the form for creating a new player.
     */
    public function createPlayer()
    {
        return view('admin.create-player');
    }

    /**
     * Store a newly created player in the database.
     */
    public function storePlayer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:batsman,bowler,all-rounder',
            'value' => 'required|numeric|min:0',
            // Add other necessary fields
        ]);

        Player::create($request->all());
        return redirect()->route('admin.players')->with('success', 'Player added successfully!');
    }

    /**
     * Show the form for editing an existing player.
     */
    public function editPlayer($id)
    {
        $player = Player::findOrFail($id);
        return view('admin.edit-player', compact('player'));
    }

    /**
     * Update the specified player in the database.
     */
    public function updatePlayer(Request $request, $id)
    {
        $player = Player::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:batsman,bowler,all-rounder',
            'value' => 'required|numeric|min:0',
            // Add other necessary fields
        ]);

        $player->update($request->all());
        return redirect()->route('admin.players')->with('success', 'Player updated successfully!');
    }

    /**
     * Remove the specified player from the database.
     */
    public function destroyPlayer($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();
        return redirect()->route('admin.players')->with('success', 'Player deleted successfully!');
    }

    /**
     * Display detailed statistics for a specific player or all players.
     */
    public function playerStats($playerId = null)
    {
        if ($playerId) {
            $player = Player::with('stats')->findOrFail($playerId); // Assuming a stats relationship
            return view('admin.player-stats', compact('player'));
        }
        $players = Player::all();
        return view('admin.player-stats', compact('players'));
    }

    /**
     * Display the tournament summary with overall statistics.
     */
    public function tournamentSummary()
{
    $summary = [
        'total_runs' => Player::sum('total_runs'),
        'total_wickets' => Player::sum('wickets'),
        'highest_scorer' => Player::orderBy('total_runs', 'desc')->first()->name ?? 'N/A',
        'highest_wicket_taker' => Player::orderBy('wickets', 'desc')->first()->name ?? 'N/A',
    ];
    return view('admin.tournament-summary', compact('summary'));
}
}