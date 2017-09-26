@extends('layouts.app')

@section('content')
    @component('components.default-page')

       <billboard-dashboard id="{{$billboard->id}}"></billboard-dashboard>

    @endcomponent
@endsection