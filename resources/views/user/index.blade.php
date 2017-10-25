@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <!--<user-settings :user="user" :settings="settings"></user-settings>-->
        <user-profile></user-profile>
    @endcomponent
@endsection