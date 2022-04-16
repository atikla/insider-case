<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LeagueTeamStanding extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'played',
        'won',
        'drawn',
        'lost',
        'goals_for',
        'goals_against',
        'goals_difference',
        'points',
    ];
}
