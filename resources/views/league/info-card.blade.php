@inject('leagueModel', 'App\Models\League')
<div class="{{ $class ?? 'col-md-4' }}">
    <div class="card">
        @if($header ?? true)
            <div class="card-header">
                {{ $league->name }}
                <a href="{{route('league.show', $league)}}" class="btn btn-primary float-end pe-auto p-0 px-2">Details</a>
            </div>
        @endif
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Team Count
                    <span class="badge bg-primary rounded-pill">{{ $league->teams->count() }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match Count
                    <span class="badge bg-primary rounded-pill">{{ $league->LeagueMatches->count() }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Remind Match Count
                    <span class="badge bg-primary rounded-pill">{{ $league->LeagueMatches->where('status', 0)->count() }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Remind Week Count
                    <span class="badge bg-primary rounded-pill">{{ $league->total_week - $league->played_week}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Status
                    <span class="badge bg-{{$league->status_css_class}} rounded-pill">{{ $league->status }}</span>
                </li>
            </ul>
            @if($leagueModel::NOT_STARTED === $league->status)
                <div class="d-grid mt-2">
                    <a href="{{ url()->signedRoute('league.start', $league) }}" class="btn btn-{{$league->status_css_class}} btn">
                        Start League And Run Fixtures
                    </a>
                    <small class="text-secondary"><sup>*</sup>Team Count Will be Random number (max: team conut)</small>
                </div>
            @endif
            @if($leagueModel::STARTED === $league->status)
                <div class="d-grid mt-2">
                    <a class="btn btn-{{$league->status_css_class}} mt-2 w-100" href="{{ url()->signedRoute('league.simulate', [$league])  }}">
                        Simulate All Weeks
                    </a>
                </div>
            @endif
            @if($leagueModel::NOT_STARTED !== $league->status)
                <div class="d-grid mt-2">
                    <a class="btn btn-danger mt-2 w-100" href="{{ url()->signedRoute('league.reset', [$league])  }}">
                        Reset League
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
