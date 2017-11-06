@extends('layouts.app')

@section('content')
        <proposal-form></proposal-form>
        <main-map :user="user"></main-map>
@endsection