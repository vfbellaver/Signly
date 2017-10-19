@extends('layouts.login')

@section('content')
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form-horizontal" action="{{route('pay')}}" method="post" id="payment-form">
            {{csrf_field()}}

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Select your plan</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">Choose your Plan</label>
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" name="plan" value="{{ old('plan') }}">
                                <option selected disabled>Choose a Plan</option>
                                <option value="small-team">Small Team | $99.00 / Monthly - 14 Day Trial
                                </option>
                                <option value="growing-team">Growing Team | $249.00 / Monthly - 14 Day
                                    Trial
                                </option>
                                <option value="enterprise-team">Entreprise Team | $499.00 / Monthly - 14 Day
                                    Trial
                                </option>
                            </select>
                            @if ($errors->has('plan'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('plan') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile</h5>
                </div>
                <div class="ibox-content">

                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label">Team</label>
                        </div>
                        <div class="col-lg-10">
                            <input name="team" class="form-control" value="{{ old('team') }}">
                            @if ($errors->has('team'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('team') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label">Name</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label">Password</label>
                        </div>
                        <div class="col-lg-10">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-2">
                            <label class="control-label" for="password-confirm">Confirm Password</label>
                        </div>
                        <div class="col-lg-10">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>

                    <div style="clear: both"></div>

                </div>
            </div>

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Billing Information</h5>
                </div>
                <div class="ibox-content">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="form-group">
                            <div class="form-row">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display Element errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <button class="btn btn-success pull-right" style="margin-top: 10px">Submit Payment</button>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </form>
    </div>
@endsection
