@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('head-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('base-content')
    <div id="register-page" class="container">
        <form id="register-form" class="form-horizontal" method="POST" action="{{ route('register-post') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Subscription
                        </div>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('plan') ? ' has-error' : '' }}">
                                <div class="col-md-8 col-md-offset-4">
                                    @if ($errors->has('plan'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('plan') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <table class="table table-borderless m-b-none" v-cloak="true">
                                <tbody>
                                <tr v-for="plan in plans">
                                    <td><strong>@{{plan.name}}</strong></td>
                                    <td>
                                        <button class="btn btn-default" type="button" @click="showPlanFeatures(plan)">
                                            <i class="fa fa-btn fa-star-o"></i>
                                            Plan Features
                                        </button>
                                    </td>
                                    <td>@{{plan.price}} / @{{plan.interval}}</td>
                                    <td>@{{ plan.trial_days }} Day Trial</td>
                                    <td class="text-right" style="width: 134px;">
                                        <button
                                                class="select btn btn-primary btn-outline"
                                                :class="{'active': chosenPlan && chosenPlan.id == plan.id}"
                                                type="button" @click="choosePlan(plan)">
                                            <i v-if="chosenPlan && chosenPlan.id == plan.id" class="fa fa-check"></i>
                                            Select
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <input ref="selectedPlan" type="hidden" name="plan"/>
                        </div>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">Profile</div>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Company</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="company"
                                           value="{{ old('company') }}" autofocus>

                                    @if ($errors->has('company'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('company') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm
                                    Password</label>
                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Billing Information
                        </div>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
                                <label for="owner" class="col-md-4 control-label">Cardholder's Name</label>

                                <div class="col-md-8">
                                    <input id="owner" type="text" class="form-control" name="owner"
                                           value="{{ old('owner') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <div class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="card-group" class="form-group{{ $errors->has('card') ? ' has-error' : '' }}">
                                <label for="card-element" class="col-md-4 control-label">Credit or debit card</label>
                                <div class="col-md-8">
                                    <div id="card-element" class="form-control"></div>
                                    <input id="card" type="hidden" name="card"/>

                                    <div id="card-error" class="help-block">
                                        @if ($errors->has('card'))
                                            <strong>{{ $errors->first('card') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group{{ $errors->has('terms_of_service') ? ' has-error' : '' }}">
                                <div class="checkbox">
                                    <label class="col-md-8 col-md-offset-4 control-label">
                                        <input name="terms_of_service" type="checkbox"/>
                                        I Accept The <a href="{{route('terms-of-service')}}" target="_blank">Terms Of
                                            Service</a>
                                    </label>
                                    <div class="help-block col-md-8 col-md-offset-4">
                                        @if ($errors->has('terms_of_service'))
                                            <strong>{{ $errors->first('terms_of_service') }}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="button" class="btn btn-primary"
                                            onclick="registerFormHandler.submit()">
                                        Register
                                    </button>
                                    <a class="btn btn-default" href="{{route('login')}}">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <div ref="featuresModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" v-if="selectedPlan">
                    <div class="modal-header">
                        <h4 class="modal-title">@{{ selectedPlan.name }}</h4>
                    </div>

                    <div class="modal-body">
                            <ul>
                                <li><strong>Users</strong>@{{" " + feature.users}}</li>
                                <li><strong>Billboards</strong>@{{" " + feature.billboards}}</li>
                                <li><strong>Pdf's</strong>@{{" " + feature.pdfs}}</li>
                                <li><strong>Proposals</strong>@{{" " + feature.proposals}}</li>
                                <li><strong>Contracts</strong>@{{" " + feature.contracts}}</li>
                                <li><strong>Scheduler</strong>@{{" " + feature.scheduler}}</li>
                                <li><strong>White Label</strong>@{{" " + feature.whiteLabel}}</li>
                                <li><strong>Value Monthly</strong>@{{" " + feature.valueMonthly}}</li>
                                <li><strong>Value Annual</strong>@{{" " + feature.valueAnnual}}</li>
                            </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-scripts')
    <script>
        var registerFormHandler = function () {
            var $form = $('#register-form');
            var $plan = $("#plan");
            var $card = $("#card");
            var $cardGroup = $('#card-group');
            var $cardError = $("#card-error");
            var stripe = Stripe(window.Slc.stripeKey);
            var elements = stripe.elements();
            var card = elements.create('card', {style: {base: {lineHeight: '1.429'}}});

            function stripeTokenHandler(token) {
                console.log("Token", token);
                $card.val(token.id);
                $form.submit();
            }

            return {
                init: function () {
                    card.mount('#card-element');
                    card.addEventListener('change', function (event) {
                        if (event.error) {
                            $cardGroup.addClass('has-error');
                            $cardError.append("<strong>" + event.error.message + "</strong>");
                            return;
                        }
                        $cardGroup.removeClass('has-error');
                        $cardError.html('');
                    });
                },
                submit: function () {
                    stripe.createToken(card).then(function (result) {
                        $cardGroup.removeClass('has-error');
                        $cardError.html('');

                        if (result.error) {
                            $cardGroup.addClass('has-error');
                            $cardError.append("<strong>" + result.error.message + "</strong>");
                            return;
                        }
                        $cardGroup.removeClass('has-error');
                        $cardError.html('');
                        stripeTokenHandler(result.token);
                    });
                }
            }
        }();

        $(document).ready(function () {
            registerFormHandler.init();
        });
    </script>
@endsection