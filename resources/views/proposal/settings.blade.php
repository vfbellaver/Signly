<?php
 if (isset($customer))
    {
      $disabled = '';
    }
 else
     {
       $disabled = 'disabled';
     }
?>
@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>
                <div class="panel-body">

                        <div class="col-lg-4">

                        </div>

                        <div class="col-lg-8">
                            <form action="{{route('get.client')}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('POST')}}
                                <div class="form-group">
                                    <div class="col-lg-3">
                                        <label class="control-label">Chose a Customer</label>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="client_id" class="form-control">
                                            @foreach($clients as $client)
                                                <option value="{{$client->id}}">{{$client->first_name.' '.$client->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-success">SEND</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form class="form-horizontal" method="POST" action="{{route('logo.upload')}}" enctype="multipart/form-data">
                            <div class="col-lg-4">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top" src="{{asset('/images/file.png')}}" alt="Your Logo Here" style="margin-left:20%">
                                    <div class="card-body">
                                        <p class="card-text">
                                            Click here to upload your logo
                                        </p>
                                        <input {{$disabled}}  type="file" name="file" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-8">
                                <h3>{{ isset($customer)? $customer->first_name.' '.$customer->last_name : 'Personal Configurations' }}</h3>
                                <hr>
                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>Email</strong></label>
                                    </div>
                                    <div class="col-lg-11">

                                        <input name="email" value="{{ isset($customer)? $customer->email : '' }}" class="form-control" {{$disabled}}>
                                    </div>
                                </div>
                                <h3>Address Configurations</h3>
                                <hr>
                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>Address</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="billing_address" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control" {{$disabled}}>
                                    </div>

                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>City</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="billing_city" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control" {{$disabled}}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>State</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="billing_state" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control" {{$disabled}}>
                                    </div>

                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Zip Code</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="billing_zipcode" value="{{ isset($customer)? $customer->billing_address : '' }}" class="form-control" {{$disabled}}>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Contact Name</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="contact_name" value="{{ isset($customer)? $customer->contact_name : '' }}" class="form-control" {{$disabled}}>
                                    </div>

                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Company</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="company" value="{{ isset($customer)? $customer->company : '' }}" class="form-control" {{$disabled}}>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@stop