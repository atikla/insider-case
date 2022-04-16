<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            {{ $league->name }}
            <a class="btn btn-primary float-end pe-auto p-0 px-2">Details</a>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Match Count
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Remind Match Count
                    <span class="badge bg-primary rounded-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Status
                    <span class="badge bg-{{$league->status_css_class}} rounded-pill">{{ $league->status }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
