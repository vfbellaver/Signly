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
	 	<div class="panel-heading">Add An Instance</div>
	 	<div class="panel-body">
	 		
	 		{!! Form::open(array('route' => 'postinstance', 'method'=> 'POST', 'id'=>'frm_new_instance', 'name' => 'frm_new_instance', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

		    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		
			<div class="form-group">
				<div class="form-group">
					<label class="col-md-2 control-label">Instance Name</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="instance" value="{{ old('instance') }}">
					</div>
				</div>
			</div>
			

			<div class="form-group">
				<div class="form-group">
					<label class="col-md-2 control-label">Instance Notes</label>
					<div class="col-md-3">
						<textarea class="form-control" name="notes">{{ old('notes') }}</textarea>
					</div>
				</div>
			</div>

			<div class="form-group">
				<button type="submit" role="submit">Save</button>
			</div>	



			{!! Form::close() !!}

	 	</div>
	</div>
	
    
</div>

@endsection
