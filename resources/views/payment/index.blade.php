@extends('layouts.app')

@section('content')
    @component('components.default-page')
        <div class="row animated fadeInRight">
            <form class="form-horizontal" action="{{route('pay')}}" method="post" id="payment-form">
                <div class="col-md-">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h2><strong>Choose Your Plan</strong></h2>
                        </div>
                        <plan></plan>
                    </div>
                </div>
            </form>
        </div>
    @endcomponent
@endsection

