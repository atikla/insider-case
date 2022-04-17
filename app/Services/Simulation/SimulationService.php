<?php

namespace App\Services\Simulation;

use App\Contracts\Repositories\LeagueMatchRepositoryContract;
use App\Models\League;
use App\Models\LeagueMatch;
use App\Models\LeagueTeamStanding;
use App\Models\Team;
use Illuminate\Support\Collection;

class SimulationService
{
    /**
     * @var League
     */
    private League $league;

    /**
     * @var int|null
     */
    private ?int $week = null;

    /**
     * @var Team
     */
    private Team $homeTeam;

    /**
     * @var Team
     */
    private Team $awayTeam;

    /**
     * @var LeagueTeamStanding
     */
    private LeagueTeamStanding $homeTeamStanding;

    /**
     * @var LeagueTeamStanding
     */
    private LeagueTeamStanding $awayTeamStanding;

    /**
     * @var Team|null
     */
    private ?Team $winner = null;

    /**
     * @var int
     */
    private int $homeTeamScore;

    /**
     * @var int
     */
    private int $awayTeamScore;

    /**
     * @var LeagueMatchRepositoryContract
     */
    private LeagueMatchRepositoryContract $leagueMatchRepository;

    /**
     * @param LeagueMatchRepositoryContract $leagueMatchRepository
     */
    public function __construct(LeagueMatchRepositoryContract $leagueMatchRepository)
    {
        $this->leagueMatchRepository = $leagueMatchRepository;
    }


    public function simulate()
    {
        $matches = $this->getMatchList();
        foreach ($matches as $match) {
            $this->homeTeam = $match->homeTeam;
            $this->awayTeam = $match->awayTeam;
            $this->homeTeamStanding = $this->homeTeam->standing()->where('league_id', $this->league->id)->first();
            $this->awayTeamStanding = $this->awayTeam->standing()->where('league_id', $this->league->id)->first();
            $this->simulateMatch(match: $match);
        }

        $this->week = null;
        if ($this->getMatchList()->isEmpty()) {
            $this->league->status = League::ENDED;
            $this->league->save();
        }
    }

    /**
     * @param LeagueMatch $match
     * @return void
     */
    private function simulateMatch(LeagueMatch $match)
    {
        $this->homeTeamScore = $this->generateScore(home: true, strength: $this->homeTeam->strength);
        $this->awayTeamScore = $this->generateScore(home: false, strength: $this->awayTeam->strength);
        $this->decideWinner();

        $match->home_team_goal = $this->homeTeamScore;
        $match->away_team_goal = $this->awayTeamScore;
        $match->status = true;
        $match->save();
    }

    private function updateStanding()
    {
        $this->homeTeamStanding->played++;
        $this->homeTeamStanding->goals_for = $this->homeTeamStanding->goals_for + $this->homeTeamScore;
        $this->homeTeamStanding->goals_against = $this->homeTeamStanding->goals_against + $this->awayTeamScore;
        $this->homeTeamStanding->goals_difference = $this->homeTeamStanding->goals_for - $this->homeTeamStanding->goals_against;

        $this->awayTeamStanding->played++;
        $this->awayTeamStanding->goals_for = $this->awayTeamStanding->goals_for + $this->awayTeamScore;
        $this->awayTeamStanding->goals_against = $this->awayTeamStanding->goals_against + $this->homeTeamScore;
        $this->awayTeamStanding->goals_difference = $this->awayTeamStanding->goals_for - $this->awayTeamStanding->goals_against;

        $this->homeTeamStanding->save();
        $this->awayTeamStanding->save();
    }

    /**
     * @return void
     */
    // TODO refactoring this function
    private function decideWinner()
    {
        if ($this->homeTeamScore > $this->awayTeamScore) {
            $this->winner = $this->homeTeam;
            $this->homeTeamStanding->won++;
            $this->homeTeamStanding->points = $this->homeTeamStanding->points + LeagueTeamStanding::WON_POINT;
            $this->awayTeamStanding->lost++;
        } elseif ($this->homeTeamScore < $this->awayTeamScore) {
            $this->winner = $this->awayTeam;
            $this->awayTeamStanding->won++;
            $this->awayTeamStanding->points = $this->awayTeamStanding->points + LeagueTeamStanding::WON_POINT;
            $this->homeTeamStanding->lost++;
        } else {
            $this->awayTeamStanding->drawn++;
            $this->homeTeamStanding->drawn++;

            $this->homeTeamStanding->points = $this->homeTeamStanding->points + LeagueTeamStanding::DRAWN_POINT;
            $this->awayTeamStanding->points = $this->awayTeamStanding->points + LeagueTeamStanding::DRAWN_POINT;
        }

        $this->updateStanding();
    }

    /**
     * @param bool $home
     * @param float $strength
     * @return int
     */
    private function generateScore(bool $home, float $strength): int
    {
        $score = round(rand(0, 5) * $strength);

        return $home ? ++$score : $score;
    }

    /**
     * @return Collection
     */
    private function getMatchList(): Collection
    {
        return $this->leagueMatchRepository->getNotStartedMatchByLeagueAndWeek($this->league->id, $this->week);
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
     * @return SimulationService
     */
    public function setLeague(League $league): self
    {
        $this->league = $league;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeek(): ?int
    {
        return $this->week;
    }

    /**
     * @param int|null $week
     * @return SimulationService
     */
    public function setWeek(?int $week): self
    {
        $this->week = $week;

        return $this;
    }
}
