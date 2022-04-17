<div class="card" style="margin-top:39px">
    <div class="card-header" >
        {{ $league->played_week }} Week champion prediction
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($predictions as $logo => $prediction)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <img src="{{$prediction['logo']}}" width="35" height="35">
                    <span class="badge bg-primary rounded-pill">{{ $prediction['rate'] }}%</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
