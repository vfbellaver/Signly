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
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="top-navigation">
<div id="app">
    <notification
            :type="'{{ session('notification') }}'"
            :message="'{{ addslashes(session('message')) }}'"
    ></notification>

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
                            <li>
                                {{ auth()->user()->name }}
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
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
</div>


<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script>
    var stripe = Stripe('pk_test_o8pMqMjbYJLnpBp28U2ndxlJ');
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            lineHeight: '24px'
        }
    };

    // Create an instance of the card Element
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>
    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    };
</script>
</body>
</html>
