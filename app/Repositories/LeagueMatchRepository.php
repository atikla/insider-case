<?php

namespace App\Repositories;

use App\Contracts\Repositories\LeagueMatchRepositoryContract;
use App\Models\LeagueMatch;

class LeagueMatchRepository extends BaseRepository implements LeagueMatchRepositoryContract
{
    /**
     * @param LeagueMatch $leagueMatch
     */
    public function __construct(LeagueMatch $leagueMatch)
    {
       parent::__construct($leagueMatch);
    }
}
