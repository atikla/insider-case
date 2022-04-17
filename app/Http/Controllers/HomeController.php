<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\LeagueRepositoryContract;
use App\Contracts\Repositories\TeamRepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * @var TeamRepositoryContract
     */
    private TeamRepositoryContract $teamRepository;

    /**
     * @var LeagueRepositoryContract
     */
    private LeagueRepositoryContract $leagueRepository;

    public function __construct(
        TeamRepositoryContract $teamRepository,
        LeagueRepositoryContract $leagueRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->leagueRepository = $leagueRepository;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('home', [
            'leagues' => $this->leagueRepository->all(),
            'teams' => $this->teamRepository->all()
        ]);
    }
}
