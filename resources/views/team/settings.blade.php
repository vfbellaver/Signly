@extends('layouts.app')
@section('head-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')
    @if(auth()->user()->is_team_owner)
        <team-settings></team-settings>
    @endif
@endsection

