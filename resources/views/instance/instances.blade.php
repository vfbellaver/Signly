@extends('app')

@section('content')

<div class="container">
	<div class="panel panel-default">
	 	<div class="panel-heading">Instances <a href="{{URL::to('/')}}/add-instance" title="Add new Instance" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
	 	<div class="panel-body">
	 		<table class="table">
	 			<thead>
	 				<th>ID</th>
	 				<th>Name</th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 			</thead>
	 			<tbody>
	 				@foreach($instances as $instance)
	 					<tr>
	 						<td>{{ $instance->id }}</td>
	 						<td>{{ $instance->instance }}</td>
	 						
	 						<td><a href="{{URL::to('/')}}/instance/{{ $instance->id }}">Edit</a></td>
	 						<td><a href="{{URL::to('/')}}/instance-users/{{ $instance->id }}">Users</a></td>
	 						<td>
	 							@if($instance->id != 1)
	 							{!! Form::open(['method' => 'DELETE', 'route' => ['deletebillboard', $instance->id],'class'=>'frmDeleteBillboard']) !!}
								   {!! Form::button('Delete', ['class' => 'btn btn-danger btnDeleteBillboard']) !!}
								{!! Form::close() !!}
								@endif
	 						</td>
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
	 	</div>
	</div>
	
    
</div>

@endsection
