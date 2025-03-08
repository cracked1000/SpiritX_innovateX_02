<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function players()
    {
        // Placeholder: Replace with DB data later
        $players = [];
        return view('admin.players', compact('players'));
    }

    public function playerStats()
    {
        // Placeholder: Replace with DB data later
        $player = null;
        return view('admin.player-stats', compact('player'));
    }

    public function tournamentSummary()
    {
        // Placeholder: Replace with DB data later
        $summary = [
            'total_runs' => 0,
            'total_wickets' => 0,
            'highest_scorer' => 'N/A',
            'highest_wicket_taker' => 'N/A',
        ];
        return view('admin.tournament-summary', compact('summary'));
    }
}