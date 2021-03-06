@extends('layouts.base', ['bodyClass' => 'top-navigation'])

@section('base-content')
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
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                                        <span v-cloak>
                                            <i v-if="user.impersonated" class="fa fa-user-secret"></i>
                                            @{{user.name}}
                                        </span>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        @impersonating
                                        <li><a href="{{ route('impersonate.leave') }}">Leave impersonation</a></li>
                                        <li class="divider"></li>
                                        @endImpersonating
                                        <li><a href="{{route('user.settings')}}">Your Settings</a></li>
                                        @if(auth()->user()->is_team_owner)
                                            <li><a href="{{route('team.settings')}}">Company Settings</a></li>
                                        @endif
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
            @yield('content')
            <div class="footer">
                <div>
                    <strong>Copyright</strong> Slc DevShop &copy; 2014-2017
                </div>
            </div>
        </div>
    </div>
@endsection