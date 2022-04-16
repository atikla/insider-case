<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\TeamRepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AppMainController extends Controller
{
    /**
     * @var TeamRepositoryContract
     */
    private TeamRepositoryContract $teamRepository;

    public function __construct(TeamRepositoryContract $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('home', [
            'teams' => $this->teamRepository->all()->shuffle()
        ]);
    }
}
