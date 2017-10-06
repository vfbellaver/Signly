@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <client-edit id="{{$client->id}}"></client-edit>
    @endcomponent
@endsection