@extends('layouts.app')

@section('content')
    @if(auth()->user()->is_team_owner)
        <team-settings></team-settings>
    @endif
@endsection