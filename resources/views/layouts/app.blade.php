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
</head>
<body class="top-navigation">
<div id="app">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar"
                                data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="{{route('home')}}" class="navbar-brand">{{env('APP_NAME')}}</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            @include('layouts._menu')
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            @if(isset(auth()->user()->name))
                                <li>
                                    <button class="btn btn-sm btn-primary">
                                        Proposal Generator <i class="fa fa-bars"></i>
                                    </button>
                                </li>
                                <li>
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                                        {{ auth()->user()->name }}
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li><a href="#">Your Settings</a></li>
                                        @if(auth()->user()->is_team_owner)
                                            <li><a href="#">Team Settings</a></li>
                                        @endif
                                        <li class="divider"></li>
                                        <li><a href="javascript:;"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >Logout</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Log out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('payment')}}"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                        Register
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('login') }}">
                                        <i class="fa fa-sign-in"></i> Login
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="divproposal">
                <proposal></proposal>
            </div>
            @yield('content')
            <div class="footer">
                <div>
                    <strong>Copyright</strong> Slc DevShop &copy; 2014-2017
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $("button").click(function () {
            $(".divproposal").toggle("slow");
        });
    });
</script>

</body>
</html>
