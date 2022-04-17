<?php

namespace App\Services\League;

use App\Models\League;

class LeagueService
{

    public static function ResetLeague(League $league)
    {
        $standing = $league->standing;
        $leagueMatches = $league->leagueMatches;

        $standing->each->update([
            'played' => 0,
            'won' => 0,
            'drawn' => 0,
            'lost' => 0,
            'goals_for' => 0,
            'goals_against' => 0,
            'goals_difference' => 0,
            'points' => 0
        ]);

        $leagueMatches->each->update([
            'home_team_goal' => 0,
            'away_team_goal' => 0,
            'status' => 0
        ]);

        $league->update(['status' => League::STARTED, 'played_week' => 0]);
    }
}
