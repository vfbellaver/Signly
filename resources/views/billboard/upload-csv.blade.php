@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <csv-upload-billboard-list></csv-upload-billboard-list>
    @endcomponent
@endsection