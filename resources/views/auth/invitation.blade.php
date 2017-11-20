@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('base-content')
    <div class="middle-box text-center loginscreen">
        <div>
            <h3>Welcome to</h3>
            <div>
                <h1 class="logo-name">{{env('APP_NAME')}}</h1>
            </div>
            <br/>
            @if(!$isValid)
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> This invitation is no longer valid.
                </div>
            @else
                <div class="alert alert-success">
                    Thank you for accepting our invitation.
                </div>
                <form class="m-t" role="form" method="POST" action="{{ route('register-invitation') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="invitation_token" value="{{ $token }}"/>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="name" type="name" class="form-control" name="name" required
                               placeholder="Name">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required
                               placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password_confirmation" type="password"
                               class="form-control" name="password_confirmation" required
                               placeholder="Confirm your password">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">
                        Register
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
