<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{route('slc.js')}}" type="text/javascript"></script>
    @yield('head-scripts')
</head>
<body class="{{$bodyClass}}">

<div id="app">
    @yield('base-content')
</div>

<script src="{{ mix('js/app.js') }}"></script>

@yield('body-scripts')

</body>
</html>
