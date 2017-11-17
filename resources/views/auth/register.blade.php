@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('head-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('base-content')
    <register></register>
@endsection
