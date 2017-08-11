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
        <div class="panel-heading">Add New Billboard</div>
        <div class="panel-body">
            
            {!! Form::open(array('route' => 'postbillboard', 'method'=> 'POST', 'id'=>'frm_new_billboard', 'name' => 'frm_new_billboard', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Name this Billboard *</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $billboard->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Address</label>
                            <div class="col-md-6">
                                <input type="text" id="billboard_address" class="form-control" name="address" value="{{ $billboard->address }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Lat</label>
                            <div class="col-md-6">
                                <input type="text" id="lat" class="form-control" name="lat" value="{{ $billboard->lat }}" readonly="readonly">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Long</label>
                            <div class="col-md-6">
                                <input type="text" id="long" class="form-control" name="long" value="{{ $billboard->lng }}" readonly="readonly">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Hard Cost</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="hard_cost" value="{{ $billboard->hard_cost }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Monthly Impressions</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="monthly_impressions" value="{{ $billboard->monthly_impressions }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Digital Driveby</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="digital_driveby" value="{{ $billboard->digital_driveby }}">
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" data-toggle="modal" data-target="#myModal">Add a Face (You must have at least one)</a>

                </div>

                <div class="col-md-6">
                    <div id="map_canvas" class="small-map"></div>
                    <div class="well well-sm" id="geocode_message"></div>
                    
                </div>

            </div>

            

            <div class="row">
                <button type="submit" role="submit">Save</button>
            </div>  



            {!! Form::close() !!}

        </div>
    </div>
    
    
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Face</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Unique ID *</strong></label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" ><strong>Size</strong></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control">
                        <span>height</span>
                    </div>
                    <div class="col-md-1">
                        X
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control">
                        <span>width</span>
                    </div>        
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label" ><strong>Reads</strong></label>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Right
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Cross
                    </div>        
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label"><strong>Label *</strong></label>
                    <div class="col-md-5">
                        <input type="radio" name="label"> North <br/>
                        <input type="radio" name="label"> East <br/>   
                        <input type="radio" name="label"> South <br/>
                        <input type="radio" name="label"> West <br/>
                        <input type="radio" name="label"> <input type="text" placeholder="custom">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><strong>Picture of the Face</strong></label>
                    <div>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </form>                 
                    </div>
                    <div>
                        For best results, include a picture of the billbaord from the street level
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Digital Driveby</strong></label>
                    <div>
                        <input type="checkbox"> Use Main Billboard Driveby
                    </div>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                    <div>
                        After uploading your video to youtube.com, enter that video URL here
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label" ><strong>Sign Type *</strong></label>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Static
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Digital
                    </div>        
                </div>
                <div class="form-group">
                    <label><strong>Your Hard Costs</strong></label>
                    <div>
                        <input type="checkbox"> Use Main Billboard Cost
                    </div>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Monthly Impressions</strong></label>
                    <div>
                        <input type="checkbox"> Use Main Billboard Impressions
                    </div>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                    <div>
                        How many people see this face on a monthly basis. Often called 'DEC'
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Notes</strong> (Clients can see)</label>
                    <div>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add Face</button>
      </div>
    </div>
  </div>
</div>

@endsection
