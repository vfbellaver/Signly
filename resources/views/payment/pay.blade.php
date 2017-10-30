@extends('layouts.login')

@section('content')
    @component('components.payment-page')
        <div class="row animated fadeInRight">
            <div class="col-md-">
                <div class="ibox float-e-margins">
                    <register></register>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
