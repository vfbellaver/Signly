@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Subscription</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" action="{{route('pay')}}" method="post" id="payment-form">
                        {{csrf_field()}}

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label">Choose your Plan</label>
                            </div>
                            <div class="col-lg-10">
                                <select class="form-control" name="plan">
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
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label">Team</label>
                            </div>
                            <div class="col-lg-10">
                                <select class="form-control" name="team">
                                    @foreach($teams as $team)
                                        <option>{{$team->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label">Name</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label">Email</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="email" class="form-control" name="stripeEmail">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label">Password</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-2">
                                <label class="control-label">Confirm Password</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <h3>Payment</h3>
                        <hr>
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

                                <button class="btn btn-success pull-right">Submit Payment</button>
                            </div>
                        </div>
                    </form>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

