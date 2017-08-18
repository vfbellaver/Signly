
@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>
                <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('setthings')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('POST')}}
                            <input  type="hidden" name="customer_id" value="{{Auth::user()->id}}">
                            <input  type="hidden" name="proposal_settings_id"
                                    value="{{@$settings->id}}">

                            <div class="col-lg-4">
                                <div class="card" style="width: 20rem;">
                                    <img class="card-img-top"
                                         src="{{@$settings->path_image ?asset('/storage/'.$settings->path_image): asset('/images/file.png')}}"
                                         alt="Your Logo Here"
                                         style="margin-left:20%">
                                    <div class="card-body text-center">
                                        <p class="card-text" style="margin-top: 5px">
                                            Click here to upload your logo
                                        </p>
                                        <input type="file" name="path_image"  value="{{@$settings->path_image ? true :''}}" class="form-control">

                                        <div class="help-block">
                                            @if ($errors->has('path_image'))
                                                {{$errors->first('path_image')}}
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">

                                <h3>Personal Configurations</h3>
                                <hr>
                                <div class="form-group">
                                    <!-- Email -->
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>Email</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <h4>{{ Auth::user()->email }}</h4>
                                        <input name="email" type="hidden" value="{{ Auth::user()->email }}" class="form-control">

                                        <div class="help-block">
                                            @if ($errors->has('email'))
                                                {{$errors->first('email')}}
                                            @endif
                                        </div>

                                    </div>


                                    <!-- web site -->
                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Web Site</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="website" value="{{@$settings->website}}" class="form-control">

                                        <div class="help-block">
                                            @if ($errors->has('website'))
                                                {{$errors->first('website')}}
                                            @endif
                                        </div>

                                    </div>
                                </div>


                                <h3>Address Configurations</h3>
                                <hr>
                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>Street</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="user_street" value="{{@$settings->user_street}}" class="form-control">

                                        <div class="help-block">
                                            @if ($errors->has('user_street'))
                                                {{$errors->first('user_street')}}
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>City</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="user_city" value="{{@$settings->user_city}}" class="form-control">

                                        <div class="help-block">
                                            @if ($errors->has('user_city'))
                                                {{$errors->first('user_city')}}
                                            @endif
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-1">
                                        <label class="control-label"><strong>State</strong></label>
                                    </div>
                                    <div class="col-lg-5">
                                        <input name="user_state" value="{{@$settings->user_state}}" class="form-control" >

                                        <div class="help-block">
                                            @if ($errors->has('user_state'))
                                                {{$errors->first('user_state')}}
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-lg-2">
                                        <label class="control-label"><strong>Zip Code</strong></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <input name="user_zipcode" value="{{@$settings->user_zipcode}}" class="form-control">

                                        <div class="help-block">
                                            @if ($errors->has('user_zipcode'))
                                                {{$errors->first('user_zipcode')}}
                                            @endif
                                        </div>

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