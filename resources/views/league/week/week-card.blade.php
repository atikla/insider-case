<div class="card mb-4">
    <div class="card-header">{{$week->first()->week}} Week Matches</div>
    <div class="card-body">
        @foreach($week as $match)
            <div class="row justify-content-between">
                <div class="col-4 text-center">
                    <div>
                        <img width="50" height="50" src="{{$match->homeTeam->logo}}" alt="{{$match->homeTeam->name}}">
                        <p>{{$match->homeTeam->name}}</p>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <span class="position-relative top-50">
                        {{ $match->home_team_goal }} - {{ $match->away_team_goal }}
                    </span>
                </div>
                <div class="col-4 text-center">
                    <div>
                        <img width="50" height="50" src="{{$match->awayTeam->logo}}" alt="{{$match->homeTeam->name}}">
                        <p>{{$match->awayTeam->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($week->firstWhere('status', 0))
        <div class="card-footer text-center">
            <a href="{{ url()->signedRoute('league.simulate', [$match->league, $week->first()->week])  }}" class="btn btn-success">Simulate {{$week->first()->week}} Week Matches</a>
        </div>
    @endif
</div>
