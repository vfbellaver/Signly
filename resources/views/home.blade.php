@extends('layouts.app')

@section('content')
    <div class="divproposal">
        <proposal :team_id="user.team.id"></proposal>
    </div>
    <main-map :user="user"></main-map>
@endsection