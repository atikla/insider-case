@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            @foreach($leagues as $league)
                @include('league.info-card', $league)
            @endforeach
        </div>
        <div class="row">
            <h4>All Teams</h4>
            @foreach($teams as $team)
                @include('team.logo-card', $team)
            @endforeach
        </div>
    </div>
@endsection
