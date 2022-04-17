<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ShowLeagueController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param League $league
     * @return Application|Factory|View
     */
    public function __invoke(League $league): View|Factory|Application
    {
        return view('league.show', [
            'league' => $league
        ]);
    }
}
