<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    // Define fillable fields for mass assignment
    protected $fillable = [
        'name', 'university', 'category', 'total_runs', 'balls_faced', 'innings_played',
        'wickets', 'overs_bowled', 'runs_conceded'
    ];

    // Relationship with User model (if applicable)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_players');
    }

    // Corrected method to calculate points
    public function getPointsAttribute()
    {
        $battingStrikeRate = $this->balls_faced > 0 ? ($this->total_runs / $this->balls_faced) * 100 : 0;
        $battingAverage = $this->innings_played > 0 ? $this->total_runs / $this->innings_played : 0;
        $bowlingPoints = 0;

        if ($this->overs_bowled > 0 && $this->wickets > 0) {
            $totalBallsBowled = $this->overs_bowled * 6; // Convert overs to balls
            $bowlingStrikeRate = $totalBallsBowled / $this->wickets;
            $economyRate = $totalBallsBowled > 0 ? ($this->runs_conceded / $totalBallsBowled) * 6 : 0;
            $bowlingPoints = (500 / $bowlingStrikeRate) + ($economyRate > 0 ? 140 / $economyRate : 0);
        }

        return ($battingStrikeRate / 5 + $battingAverage * 0.8) + $bowlingPoints;
    }

    // Optional: Value attribute if needed elsewhere in your application
    public function getValueAttribute()
    {
        $points = $this->points;
        $value = (9 * $points + 100) * 1000;
        return round($value / 50000) * 50000;
    }
}