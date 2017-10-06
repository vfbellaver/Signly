@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <billboard-create :map-center="settings.map_center"></billboard-create>
    @endcomponent
@endsection