<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    public function run()
    {
        $csvData = array_map('str_getcsv', file(base_path('players.csv'))); // Save CSV as players.csv in project root
        $header = array_shift($csvData); // Remove header row

        foreach ($csvData as $row) {
            $battingStrikeRate = ($row[4] > 0) ? ($row[3] / $row[4]) * 100 : 0;
            $battingAverage = ($row[5] > 0) ? $row[3] / $row[5] : 0;
            $bowlingStrikeRate = ($row[6] > 0) ? ($row[7] * 6 / $row[6]) : 0; // Overs to balls
            $economyRate = ($row[7] > 0) ? ($row[8] / $row[7]) * 6 : 0;

            $points = ($battingStrikeRate / 5 + $battingAverage * 0.8) +
                      (500 / ($bowlingStrikeRate ?: 1) + 140 / ($economyRate ?: 1));
            $value = round((9 * $points + 100) * 1000, -5); // Nearest 50,000

            Player::create([
                'name' => $row[0],
                'university' => $row[1],
                'category' => $row[2],
                'total_runs' => $row[3],
                'balls_faced' => $row[4],
                'innings_played' => $row[5],
                'wickets' => $row[6],
                'overs_bowled' => $row[7],
                'runs_conceded' => $row[8],
                'points' => $points,
                'value' => $value,
            ]);
        }
    }
}