
@extends('app')
@section('content')
    @if(count($errors->all()) > 0)
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>
                <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('logo.upload')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('POST')}}
                            <input  type="hidden" name="customer_id"
                                   value="{{Auth::user()->id}}">

                            <div class="col-lg-4">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="{{asset('/images/file.png')}}" alt="Your Logo Here" style="margin-left:20%">
                                    <div class="card-body">
                                        <p class="card-text">
                                            Click here to upload your logo
                                        </p>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">

                                <h3>{{ isset($customer)? $customer->first_name.' '.$customer->last_name : 'Personal Configurations' }}</h3>
                                <hr>
                                <div class="form-group">
                                    <!-- Email -->
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>Email</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="email" value="{{ isset($customer)? $customer->email : '' }}" class="form-control">
                                    </div>


                                    <!-- web site -->
                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Web Site</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="website" value="{{ isset($customer)? $customer->website : '' }}" class="form-control">
                                    </div>
                                </div>


                                <h3>Address Configurations</h3>
                                <hr>
                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>Street</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="billing_address" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control">
                                    </div>
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>City</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="billing_city" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>State</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="billing_state" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control" >
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Zip Code</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="billing_zipcode" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button  class="btn btn-success pull-right"> SAVE </button>
                                    </div>
                                </div>

                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
@stop