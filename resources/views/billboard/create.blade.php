@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <billboard-create :map-center="{lat: user.lat, lng: user.lng, zoom: user.zoom}"></billboard-create>
    @endcomponent
@endsection