@extends('layouts.app')

@section('content')
    @component('components.default-page')

       <billboard-edit id="{{$billboard->id}}"></billboard-edit>

    @endcomponent
@endsection