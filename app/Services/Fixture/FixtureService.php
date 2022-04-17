<?php

namespace App\Services\Fixture;

use App\Models\League;
use App\Services\LeagueTeamStanding\LeagueTeamStandingService;
use App\Services\RoundRobinScheduler\RoundRobinSchedulerAlgorithm;
use Illuminate\Support\Collection;

class FixtureService
{
    /**
     * @var Collection
     */
    private Collection $teams;

    /**
     * @var int
     */
    private int $teamCount;

    /**
     * @var int
     */
    private int $weekCount;

    /**
     * @var int
     */
    private int $nextWeek = 1;

    /**
     * @var League
     */
    private League $league;

    /**
     * @var LeagueTeamStandingService
     */
    private LeagueTeamStandingService $leagueTeamStandingService;

    /**
     * @param LeagueTeamStandingService $leagueTeamStandingService
     */
    public function __construct(LeagueTeamStandingService $leagueTeamStandingService)
    {
        $this->leagueTeamStandingService = $leagueTeamStandingService;
    }


    /**
     * @return bool
     */
    public function build(): bool
    {
        $calendar = RoundRobinSchedulerAlgorithm::run($this->teams->pluck('id')->toArray());

        $this->createLeagueTeamStanding();
        $this->createLeagueMatches($calendar);

        return true;
    }

    /**
     * @return void
     */
    private function createLeagueTeamStanding()
    {
        foreach ($this->teams as $team) {
            $this->leagueTeamStandingService->createLeagueTeamStanding(league:$this->league, team: $team);
        }
    }

    /**
     * @param array $calendar
     * @return void
     */
    private function createLeagueMatches(array $calendar)
    {
        for ($this->nextWeek; $this->nextWeek <= $this->weekCount; $this->nextWeek++) {
            foreach ($calendar[$this->nextWeek - 1] as $match) {
                $this->league->leagueMatches()->create([
                    'home_team' => $this->teams->firstWhere('id', $match[0])->id,
                    'away_team' => $this->teams->firstWhere('id', $match[1])->id,
                    'week' => $this->nextWeek,
                ]);
            }
        }
    }

    /**
     * @return Collection
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    /**
     * @param Collection $teams
     * @return FixtureService
     */
    public function setTeams(Collection $teams): self
    {
        $this->teams = $teams;
        $this->teamCount = $this->teams->count();
        $this->weekCount = ($this->teamCount - 1) * 2;
        $this->nextWeek = 1;

        return $this;
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
     * @return FixtureService
     */
    public function setLeague(League $league): self
    {
        $this->league = $league;

        return $this;
    }
}
