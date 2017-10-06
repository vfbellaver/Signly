@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <billboard-show id="{{$billboard->id}}"></billboard-show>
    @endcomponent
@endsection