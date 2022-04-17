@inject('leagueModel', 'App\Models\League')
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            {{ $league->name }}
            <a class="btn btn-primary float-end pe-auto p-0 px-2">Details</a>
        </div>
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
                    Status
                    <span class="badge bg-{{$league->status_css_class}} rounded-pill">{{ $league->status }}</span>
                </li>
            </ul>
            @if($leagueModel::NOT_STARTED === $league->status)
                <div class="d-grid mt-2">
                    <a href="{{ url()->signedRoute('league.start', $league) }}" class="btn btn-success btn">
                        Start League And Run Fixtures
                    </a>
                    <small class="text-secondary"><sup>*</sup>Team Count Will be Random even number</small>
                </div>
            @endif
        </div>
    </div>
</div>
