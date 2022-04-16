<?php

namespace App\Http\Controllers\League;

use App\Http\Controllers\Controller;
use App\Models\League;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StartLeagueController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param League $league
     * @return RedirectResponse
     */
    public function __invoke(Request $request, League $league): RedirectResponse
    {
        $league->update(['status' => League::STARTED]);

        return redirect()->route('home');
    }
}
