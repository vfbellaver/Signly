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
	 	<div class="panel-heading">Add New Proposal</div>
	 	<div class="panel-body">
	 		
	 		        {!! Form::open(array('route' => 'postproposal', 'method'=> 'POST', 'id'=>'frm_new_proposal', 'name' => 'frm_new_proposal', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

        <div class="form-group">
			<label class="col-md-3 control-label">1. Set Timeframe</label>
			<div class="col-md-6">
				<div id="cpdaterange" class="btn">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span></span> <b class="caret"></b>
               	</div>
               	<input type="hidden" name="start_date" value="<?php echo date('Y-m-d'); ?>">
               	<input type="hidden" name="end_date" value="<?php echo date('Y-m-d'); ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">2. Choose Client</label>
			<div class="col-md-6">
				<select class="form-control" name="client_id">
				@foreach($clients as $client)
					<option value="{{ $client->id }}">{{ $client->company }}</option>
				@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">3. Set Budget</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="budget">
			</div>
			<!-- <div class="col-md-3"> -->
				<select class="form-control" name="budget_validity" style="display:none;">
					<option>Week</option>
					<option>Month</option>
					<option>Year</option>
				</select>
			<!-- </div> -->
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">4. Proposal Name</label>
			<div class="col-md-6">
				<input type="text" name="name" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">5. Set as Active Proposal</label>
			<div class="col-md-6">
				<select name="setasactive" class="form-control">
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select> (Note: this will overwrite any existing active proposal)
			</div>
		</div>
       
     		<div>
				<button type="submit" role="submit">Save</button>
			</div>
      </div>
       {!! Form::close() !!}

	 	</div>
	</div>
	
    
</div>

@endsection
