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

				{!! Form::open(array('route' => 'postbillboard', 'method'=> 'POST', 'id'=>'frm_new_billboard', 'name' => 'frm_new_billboard', 'class' => 'form-horizontal', 'role' => 'form','enctype="multipart/form-data"' )) !!}

				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<input type="hidden" name="digital_driveby" value="">

				<div class="row">
					<div class="col-md-12">
						<div class="panel text-center"><h4>Billboard Information</h4></div>
					</div>

					<!-- Start of billboard information -->
					<div class="col-md-6">

						<div class="form-group">
							<label class="col-md-4 control-label">Billboard Owner *</label>
							<div class="col-md-8">
								<select class="form-control" name="billboard_owner">
									<option value=""> ---</option>
									@foreach($owners as $owner)
										<option value="{{ $owner->id }}">{{ $owner->company }}
											({{ $owner->first_name.' '.$owner->last_name }})
										</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-4 control-label">Name this Billboard *</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="name" value="{{ old('name') }}">
								</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Address</label>
							<div class="col-md-8">
								<input type="text" id="billboard_address" class="form-control" name="address"
									   value="{{ old('address') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Lat</label>
							<div class="col-md-8">
								<input type="text" id="lat" class="form-control" name="lat" value="{{ old('lat') }}"
									   readonly="readonly">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Long</label>
							<div class="col-md-8">
								<input type="text" id="long" class="form-control" name="long" value="{{ old('long') }}"
									   readonly="readonly">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-8">
								<input type="checkbox" id="havelatlong" name="havelatlong"> I have the Lat/Long numbers
								<button id="generate_address" disabled="disabled" class="pull-right">Generate Address</button>
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-4 control-label">Rate Card</label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="hard_cost" value="{{ old('hard_cost') }}">
								</div>
						</div>


					<!-- <div class="form-group">
						<div class="form-group">
							<label class="col-md-6 control-label">Digital Driveby</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="digital_driveby" value="{{ old('digital_driveby') }}">
							</div>
						</div>
					</div> -->
						<div class="col-md-12">
							<div class="row text-center">
								<button type="submit" role="submit" class="btn-primary pull-right">Save and add Billboard Faces</button>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div id="map_canvas" class="small-map col-md-12"></div>
						<div class="well well-sm col-md-11" id="geocode_message"></div>

						</div>
					</div>
				<!-- Finish of billboard information -->




				{!! Form::close() !!}

			</div>
		</div>


	</div>

@endsection