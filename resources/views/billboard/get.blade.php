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
            <div class="panel-heading">Billboard Face</div>
            <div class="panel-body">

                <form class="form-horizontal">

                    <input type="hidden" id="main-digital-driveby" name="digital_driveby" value="">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="panel text-center"><label><h4>Bilboard Information</h4></label></div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><b>Billboard Owner :</b></label>
                                <label class="control-label">
                                    {{ $owner->company }} ({{ $owner->first_name.' '.$owner->last_name }})
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><b>Name this Billboard :</b></label>
                                <label class="control-label">
                                    {{ $billboard->name }}
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><b>Address :</b></label>
                                <label class="control-label">
                                    {{ $billboard->address }}
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><b>Lat :</b></label>
                                <label class="control-label">
                                    {{ $billboard->lat }}
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><b>Long :</b></label>
                                <label class="control-label">
                                    {{ $billboard->lng }}
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><b>Rate Card :</b></label>
                                <label class="control-label">
                                    {{ $billboard->hard_cost }}
                                </label>
                            </div>

                        <!-- <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Digital Driveby</label>
                            <div class="col-md-6">
                                <input type="text" class="form-contrid" id="main-digital-driveby" name="digital_driveby" value="{{ $billboard->digital_driveby }}">
                            </div>
                        </div>
                    </div> -->
                            <div class="form-group col-md-12">
                                <div class="col-md-4">
                                    <a href="{{route('editBillboard',$billboard->id)}}"
                                       class="btn btn-primary pull-right">Edit Billboard</a>
                                </div>
                                <div class="col-md-8">
                                    <a href="#" data-toggle="modal" data-target="#myModal">
                                        <button class=" btn btn-primary pull-right">Add a Face (You must have at least
                                            one)
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="map_canvas" class="small-map"></div>
                            <div class="well well-sm" id="geocode_message"></div>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <?php $first_tab = 1; ?>
                                @foreach($billboard_faces as $billboard_face)
                                    <li class="@if($first_tab) {{ 'active' }} @endif"><a
                                                href="#face_{{ $billboard_face->label }}" role="tab"
                                                data-toggle="tab">{{ $billboard_face->label }}</a></li>
                                    <?php $first_tab = 0; ?>
                                @endforeach
                            </ul>

                            <div id="my-tab-content" class="tab-content">
                                <?php $first_tab = 1; ?>
                                @foreach($billboard_faces as $billboard_face)
                                    <div class="tab-pane @if($first_tab) {{ 'active' }} @endif"
                                         id="face_{{ $billboard_face->label }}">
                                        <br>
                                        <div class="col-md-6">
                                            <div class="panel-title">Image Face Billboard</div>
                                            <div>
                                                @if (isset($billboard_face->photo))
                                                    <img src="{{ asset('storage/billboard_images/'.$billboard->id.'/'.$billboard_face->photo) }}"
                                                         style="height: auto; width:100%;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class=" panel-title text-center">Billboard Faces Informations</div>
                                            <table class="table table-stripped table-hover">
                                                <tr>
                                                    <td><b>Height</b></td>
                                                    <td>
                                                    {{$billboard_face->height}}<!-- <input tyid="text" class="form-control" id="height{{ $billboard_face->id }}" name="hard_cost" value="{{$billboard_face->height}}"> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Width</b></td>
                                                    <td>
                                                    {{$billboard_face->width}}<!-- <input tyid="text" class="form-control" id="height{{ $billboard_face->id }}" name="hard_cost" value="{{$billboard_face->height}}"> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Reads</b></td>
                                                    <td>
                                                    {{$billboard_face->reads}}<!-- <input tyid="text" class="form-control" id="height{{ $billboard_face->id }}" name="hard_cost" value="{{$billboard_face->height}}"> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Illuminated</b></td>
                                                    <td>
                                                    {{$billboard_face->reads}}<!-- <input tyid="text" class="form-control" id="height{{ $billboard_face->id }}" name="hard_cost" value="{{$billboard_face->height}}"> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Type</b></td>
                                                    <td>
                                                    {{$billboard_face->sign_type}}<!-- <input tyid="text" class="form-control" id="height{{ $billboard_face->id }}" name="hard_cost" value="{{$billboard_face->height}}"> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Rate Card</b></td>
                                                    <td>{{$billboard_face->hard_cost}}</td>
                                                </tr>
                                                <tr>
                                                    <td nowrap="1"><b>Monthly Impressions</b></td>
                                                    <td>{{$billboard_face->monthly_impressions}}</td>
                                                </tr>
                                                <td><b>Notes</b></td>
                                                <td width="400px" class="text-justify">{{$billboard_face->notes}}</td>
                                                </tr>


                                            </table>
                                        </div>

                                    </div>
                                    <?php $first_tab = 0; ?>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-10"">
                        <div class="form-group">
                                <a class="btn btn-default pull-right" href="#" data-toggle="modal"
                                   data-target="#dlgEditBillboardFace"
                                   data-id="{{ $billboard_face->id }}">Edit Billboard Face</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-right">
                                <a href="{{url('/')}}" class="btn btn-primary">
                                    Return Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


    </div>

    <!-- Modal add Billboard Face-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add a New Billboard Face</h4>
                </div>
                {!! Form::open(array('route' => array('postbillboardface',$billboard->id ), 'method'=> 'POST', 'id'=>'frm_new_billboardface', 'name' => 'frm_new_billboardface', 'role' => 'form', 'files' => true )) !!}
                <div class="modal-body">

                    @if(count($errors->all()) > 0)
                        <p class="alert alert-danger">
                            @endif

                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach

                            @if(count($errors->all()) > 0)
                        </p>
                    @endif

                    <input type="hidden" name="billboard_id" value="{{ $billboard->id }}">
                    <input type="hidden" id="face-digital-driveby" name="digital_driveby">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Unique ID *</strong></label>
                                <input type="text" class="form-control" name="unique_id">
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label"><strong>Size</strong></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="height">
                                    <span>height</span>
                                </div>
                                <div class="col-md-1">
                                    X
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="width">
                                    <span>width</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Reads</strong></label>
                                <div class="col-md-4">
                                    <input type="radio" name="reads" value="right"> Right
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" name="reads" value="cross"> Cross
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Label *</strong></label>
                                <div class="col-md-5">
                                    <input type="radio" name="label" value="north"> North <br/>
                                    <input type="radio" name="label" value="east"> East <br/>
                                    <input type="radio" name="label" value="south"> South <br/>
                                    <input type="radio" name="label" value="west"> West <br/>
                                    <input type="radio" name="label">
                                    <input type="text" placeholder="custom">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><strong>Picture of the Face</strong></label>
                                <div>
                                    <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="fileToUploid" id="fileToUpload">
                                    </form>   -->
                                    {!! Form::file('image') !!}
                                </div>
                                <div>
                                    For best results, include a picture of the billbaord from the street level
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label><strong>Digital Driveby</strong></label>
                                <!-- <div>
                                    <input type="checkbox" name="use-main-driveby" value="1"> Use Main Billboard Driveby
                                </div>
                                <div>
                                    <input type="text" class="form-contrid" id="face-digital-driveby" name="digital_driveby">
                                </div>
                                <div>
                                    After uploading your video to youtube.com, enter that video URL here
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-6">

                            <div class="form-group row">
                                <label class="col-md-5 control-label"><strong>Illuminated? *</strong></label>
                                <div class="col-md-1">
                                    <input type="checkbox" name="illuminated" value="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label"><strong>From</strong></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="illuminated_from">
                                </div>
                                <label class="col-md-2 control-label"><strong>To</strong></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="illuminated_to">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Sign Type *</strong></label>
                                <div class="col-md-4">
                                    <input type="radio" name="sign_type" value="static"> Static
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" name="sign_type" value="digital"> Digital
                                </div>
                            </div>

                            <div id="digital-info" style="display:none;">
                                <label class="control-label"><strong>Rotation Information</strong></label>
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="max_ads">
                                        <span>Max # of ads</span>
                                    </div>
                                    <div class="col-md-1">
                                        X
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="duration">
                                        <span>seconds</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Your Rate Cards</strong></label>
                                <div>
                                    <input type="checkbox" name="use-main-cost" value="1"> Use Main Billboard Cost
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="face-hard-cost" name="hard_cost">
                                </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Monthly Impressions</strong></label>
                                <div>
                                    <input type="checkbox" name="use-main-impressions" value="1"> Use Main Billboard
                                    Impressions
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="face-monthly-impressions"
                                           name="monthly_impressions">
                                </div>
                                <div>
                                    How many people see this face on a monthly basis. Often called 'DEC'
                                </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Notes</strong> (Clients can see)</label>
                                <div>
                                    <textarea class="form-control" name="notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-primary" onclick="$('#frm_new_billboardface').submit();"
                           value="Add Face">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-- Modal Edit Billboard Face-->
    <div class="modal fade" id="dlgEditBillboardFace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Billboard Face</h4>
                </div>
                {!! Form::open(array('route' => array('postbillboardfaceupdate',$billboard->id ), 'method'=> 'POST', 'id'=>'frm_edit_billboardface', 'name' => 'frm_edit_billboardface', 'role' => 'form', 'files' => true )) !!}
                <div class="modal-body">

                    @if(count($errors->all()) > 0)
                        <p class="alert alert-danger">
                            @endif

                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach

                            @if(count($errors->all()) > 0)
                        </p>
                    @endif

                    <input type="hidden" name="billboard_id" value="{{ $billboard->id }}">
                    <input type="hidden" id="billboard_face_id" name="billboard_face_id" value="">
                    <input type="hidden" id="face-digital-driveby" name="digital_driveby">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Unique ID *</strong></label>
                                <input type="text" class="form-control" name="unique_id">
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label"><strong>Size</strong></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="height">
                                    <span>height</span>
                                </div>
                                <div class="col-md-1">
                                    X
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="width">
                                    <span>width</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Reads</strong></label>
                                <div class="col-md-4">
                                    <input type="radio" class="reads" name="reads" value="right"> Right
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" class="reads" name="reads" value="cross"> Cross
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Label *</strong></label>
                                <div class="col-md-5">
                                    <input class="blabel" type="radio" name="label" value="north"> North <br/>
                                    <input class="blabel" type="radio" name="label" value="east"> East <br/>
                                    <input class="blabel" type="radio" name="label" value="south"> South <br/>
                                    <input class="blabel" type="radio" name="label" value="west"> West <br/>
                                    <input class="blabel" type="radio" name="label">
                                    <input class="blabeltxt" type="text" placeholder="custom">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><strong>Picture of the Face</strong></label>
                                <div>
                                    <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <input type="file" name="fileToUploid" id="fileToUpload">
                                    </form>   -->
                                    {!! Form::file('image')!!}
                                </div>
                                <div>
                                    For best results, include a picture of the billbaord from the street level
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label><strong>Digital Driveby</strong></label>
                                <!-- <div>
                                    <input type="checkbox" name="use-main-driveby" value="1"> Use Main Billboard Driveby
                                </div>
                                <div>
                                    <input type="text" class="form-contrid" id="face-digital-driveby" name="digital_driveby">
                                </div>
                                <div>
                                    After uploading your video to youtube.com, enter that video URL here
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-md-5 control-label"><strong>Illuminated? *</strong></label>
                                <div class="col-md-1">
                                    <input type="checkbox" name="illuminated" value="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label"><strong>From</strong></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="illuminated_from">
                                </div>
                                <label class="col-md-2 control-label"><strong>To</strong></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="illuminated_to">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 control-label"><strong>Sign Type *</strong></label>
                                <div class="col-md-4">
                                    <input class="sign_type" type="radio" name="sign_type" value="static"> Static
                                </div>
                                <div class="col-md-4">
                                    <input class="sign_type" type="radio" name="sign_type" value="digital"> Digital
                                </div>
                            </div>

                            <div id="digital-info" style="display:none;">
                                <label class="control-label"><strong>Rotation Information</strong></label>
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="max_ads">
                                        <span>Max # of ads</span>
                                    </div>
                                    <div class="col-md-1">
                                        X
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="duration">
                                        <span>seconds</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Your Rate Cards</strong></label>
                                <div>
                                    <input type="checkbox" name="use-main-cost" value="1"> Use Main Billboard Cost
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="face-hard-cost" name="hard_cost">
                                </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Monthly Impressions</strong></label>
                                <div>
                                    <input type="checkbox" name="use-main-impressions" value="1"> Use Main Billboard
                                    Impressions
                                </div>
                                <div>
                                    <input type="text" class="form-control" id="face-monthly-impressions"
                                           name="monthly_impressions">
                                </div>
                                <div>
                                    How many people see this face on a monthly basis. Often called 'DEC'
                                </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Notes</strong> (Clients can see)</label>
                                <div>
                                    <textarea class="form-control" name="notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="button" class="btn btn-primary" onclick="$('#frm_edit_billboardface').submit();"
                           value="Update Face">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
