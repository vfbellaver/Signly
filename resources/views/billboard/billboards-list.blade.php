@extends('app')

@section('content')

<div class="container-fluid outer">
    <div>
        @if($errors->any())
        <p style="color:red;">{{$errors->first()}}</p>
        @endif
    </div>
	<!-- Start date: <sidn id="start"></span> <a href="#" onclick="window.picker.show(); return false;"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></a>
	Time range: 
    <selidt id="timerange">
        <option value="week">Week</option>
        <option value="2weeks">2 Weeks</option>
        <option value="month" selected>Month</option>
        <option value="2months">2 Months</option>
    </select> -->
	<div>
 		<div id="billboardList"></div>
	</div>
	
    
</div>

<div class="modal fade" id="newSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Book Billboard</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'postbookbillboard', 'method'=> 'POST', 'id'=>'frm_new_booking', 'name' => 'frm_new_booking', 'class' => 'form-horizontal', 'role' => 'form', 'files'=>true )) !!}
        <input type="hidden" id="billboard_id" name="billboard_id" value="">
        <input type="hidden" id="billboard_face_id" name="billboard_face_id" value="">

        <div class="form-group">
            <label class="col-md-4 control-label">1. Date Range</label>
            <div class="col-md-6">

            <div id="nsbdaterange" class="btn">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span></span> <b class="caret"></b>
                </div>
                <input type="hidden" id="bstart_date" name="bstart_date" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" id="bend_date" name="bend_date" value="<?php echo date('Y-m-d'); ?>">
            </div>

        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">2. Client</label>
            <div class="col-md-6">
                <select class="form-control" name="client">
                @if(isset($clients))
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->company }}</option>
                    @endforeach
                @endif
                </select>
            </div>
        </div>

        

        <!-- <div class="form-group">
            <label class="col-md-4 control-label">3. Set Price</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="set_price">
            </div>
        </div> -->

        <div class="form-group">
          <label class="col-md-4 control-label">3. Description</label>
          <div class="col-md-6">
            <textarea class="form-control" name="description"></textarea>
          </div>
        </div>

        <!-- <div class="form-group">
            <label class="col-md-3 control-label">5. Upload Billboard Photo</label>
            <div class="col-md-6">
                {!! Form::file('image') !!}
            </div>
        </div> -->

         {!! Form::close() !!}
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="$('#frm_new_booking').submit();" class="btn btn-primary">Save Booking</button>
      </div>
      
    </div>
  </div>
</div>

@endsection
