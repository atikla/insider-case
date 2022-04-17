<?php

namespace App\Services\Prediction;

use App\Models\League;
use App\Models\LeagueTeamStanding;

class PredictionService
{
    /**
     * @var League
     */
    private League $league;

    /**
     * @var int
     */
    private int $remainedPoints;

    /**
     * @var int
     */
    private int $topTeamPoint;

    /**
     * @var array
     */
    private array $prediction = [];


    /**
     * @return array
     */
    public function getPrediction(): array
    {
        if ($this->checkIfPredictionIsNeeded()) {
            return [];
        }

        //get top team current point and number of week remained for each team
        $this->remainedPoints = LeagueTeamStanding::WON_POINT * ($this->league->total_week - $this->league->played_week);
        $this->topTeamPoint = $this->league->standing->first()->points;

        foreach ($this->league->teams as $team) {
            $this->prediction[$team->logo] = $this->calculateTeamChance($team, $team->strength);
        }

        $this->calculateChanceInPercentage();

        return $this->prediction;
    }

    /**
     * before first week and after last week there is no prediction needed
     * @return bool
     */
    private function checkIfPredictionIsNeeded(): bool
    {
        return (
            $this->league->played_week === 0
            || $this->league->played_week === $this->league->total_week
        );
    }

    /**
     * @param $team
     * @param $strength
     * @return float|int
     */
    private function calculateTeamChance($team, $strength): float|int
    {
        /** @var LeagueTeamStanding $teamStanding */
        $teamStanding = $team->standing()->where('league_id', $this->league->id)->first();

        //check if team can be champions if win all future matches due to current top team
        if ($this->remainedPoints + $teamStanding->points < $this->topTeamPoint) {
            return 0;
        }

        $chance = 0;
        $matches = $team->leagueMatches($this->league->id);

        foreach ($matches as $match) {
            if ($match->home_team == $team->id) {
                $chance += 2;
            }

            if ($match->away_team == $team->id) {
                $chance += 1;
            }
        }

        $chance = $chance * $strength - (($this->topTeamPoint - $teamStanding->points) / 2);

        return max($chance, 0);
    }

    /**
     * @return void
     */
    private function calculateChanceInPercentage(): void
    {
        $rawPrediction = $this->prediction;
        $this->prediction = [];

        $onePointPercent = 100 / array_sum($rawPrediction);

        foreach ($rawPrediction as $team => $teamChance) {
            $this->prediction[] = [
                'logo' => $team,
                'rate' => round($teamChance * $onePointPercent, 2)
            ];
        }

        $keys = array_column($this->prediction, 'rate');
        array_multisort($keys, SORT_DESC, $this->prediction);
    }

    /**
     * @return League
     */
    public function getLeague(): League
    {
        return $this->league;
    }

    /**
     * @param League $league
     * @return PredictionService
     */
    public function setLeague(League $league): self
    {
        $this->league = $league;

        return $this;
    }
}
