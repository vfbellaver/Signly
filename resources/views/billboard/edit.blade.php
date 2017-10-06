@extends('layouts.app')

@section('content')
    @component('components.default-page')
       <billboard-edit id="{{$billboard->id}}" :map-center="settings.map_center"></billboard-edit>
    @endcomponent
@endsection