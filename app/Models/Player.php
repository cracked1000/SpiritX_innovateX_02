<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 'university', 'category', 'total_runs', 'balls_faced', 'innings_played',
        'wickets', 'overs_bowled', 'runs_conceded', 'points', 'value'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_players');
    }
}