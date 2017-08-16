@extends('app')

@section('content')

    <div class="container">
        @if(Session::has('success'))
            <div>
                <p class="alert alert-success">{{Session::get('success')}}</p>
            </div>
        @endif
        @if(count($errors->all()) > 0)
            <p class="alert alert-danger">
                @endif

                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach

                @if(count($errors->all()) > 0)
            </p>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">Add New Client</div>
            <div class="panel-body">
                <!-- -----------  ----------- -->
                <div>
                    {!! Form::open(array('route' => 'postclient', 'method'=> 'POST', 'id'=>'frm_new_client', 'name' => 'frm_new_client', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Company</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="company" value="{{ old('company') }}">
                        </div>

                        <label class="col-md-2 control-label">Billing Address</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="billing_address" value="{{ old('billing_address') }}">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Contact Person First Name</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        <label class="col-md-2 control-label">Billing City</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="billing_city" value="{{ old('billing_address') }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Contact Person Last Name</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            </div>
                            <label class="col-md-2 control-label">Billing State</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="billing_state" value="{{ old('billing_address') }}">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-3">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            <label class="col-md-2 control-label">Billing Zipcode</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="billing_zipcode" value="{{ old('billing_address') }}">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Phone</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="phone1" value="{{ old('phone1') }}">
                            </div>


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Mobile</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="phone2" value="{{ old('phone2') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Fax</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="fax" value="{{ old('fax') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 text-center">
                            <button type="submit" role="submit">Save</button>
                        </div>
                    </div>



                    {!! Form::close() !!}

                </div>
            </div>


        </div>

@endsection
