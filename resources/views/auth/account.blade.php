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
	 	<div class="panel-heading">Update Account</div>
	 	<div class="panel-body">
	 		
	 	{!! Form::open(array('route' => 'postuserupdate', 'method'=> 'POST', 'id'=>'frm_new_proposal', 'name' => 'frm_new_proposal', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

	 	<!-- <div class="form-group">
            <label class="col-md-3 control-label">Account Photo</label>
            <div class="col-md-2">
            	<img src="{{ URL::to('/images/billboard/user-image.png') }}" height="100">
            </div>
            <div class="col-md-3">
            	{!! Form::file('image') !!}
            </div>
        </div> -->

        <div class="form-group">
			<label class="col-md-3 control-label">First Name</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Last Name</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Email</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="email"  value="{{ $user->email }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Password</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="password">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Confirm Password</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="confirm_password">
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
