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
	 	<div class="panel-heading">Upload Billboards</div>
	 	<div class="panel-body">
	 		
	 		{!! Form::open(array('route' => 'postbillboarduploads', 'method'=> 'POST', 'id'=>'frm_new_billboard', 'name' => 'frm_new_billboard', 'class' => 'form-horizontal', 'role' => 'form','files' => true )) !!}

		    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			
		    <div class="row">
		    	<div class="col-md-6">
		    		<div class="form-group">
						<div class="form-group">
							<label class="col-md-6 control-label">Billboard File Upload</label>
							<div class="col-md-6">
								{!! Form::file('billboard_file', null) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-group">
							<label class="col-md-6 control-label">Billboard Face File Upload</label>
							<div class="col-md-6">
								{!! Form::file('billboard_face_file', null) !!}
							</div>
						</div>
					</div>
		    	</div>
		    </div>
			<div>
				<button type="submit" role="submit">Save</button>
			</div>	



			{!! Form::close() !!}

	 	</div>
	</div>
	
    
</div>

@endsection
