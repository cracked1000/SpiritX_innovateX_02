<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['username', 'password', 'is_admin', 'budget'];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'user_players');
    }
}