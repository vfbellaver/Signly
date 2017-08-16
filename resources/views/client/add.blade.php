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
			{!! Form::open(array('route' => 'postclient', 'method'=> 'POST', 'id'=>'frm_new_client', 'name' => 'frm_new_client', 'class' => 'form-horizontal', 'role' => 'form','enctype="multipart/form-data"' )) !!}
			<div class="col-md-6">
				<div class="panel text-center"><label><h4>Customer Information</h4></label></div>

				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<div class="form-group">
					<label class="col-md-3 control-label">Company</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="company" value="{{ old('company') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Contact Person First Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Contact Person Last Name</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Email</label>
					<div class="col-md-9">
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Phone</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="phone1" value="{{ old('phone1') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Mobile</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="phone2" value="{{ old('phone2') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Fax</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="fax" value="{{ old('fax') }}">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel text-center"><label><h4>Address Information</h4></label></div>
				<div class="form-group">
					<label class="col-md-2 control-label">Billing Address</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="billing_address" value="{{ old('billing_address') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Billing City</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="billing_city" value="{{ old('billing_address') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Billing State</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="billing_state" value="{{ old('billing_address') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Billing Zipcode</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="billing_zipcode" value="{{ old('billing_address') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Logo</label>
					<div class="col-md-10">
						<input type="file" name="logo" value="{{ old('logo') }}">
					</div>
				</div>

			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div class="col-md-6 text-center">
						<button style="width: 20%" type="submit" role="submit">Save</button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
	 	</div>
	</div>


</div>
@endsection
