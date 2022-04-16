@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-around">
        <h4>All Teams</h4>
        @foreach($teams as $team)
            @include('team.logo-card', $team)
        @endforeach
    </div>
</div>
@endsection
