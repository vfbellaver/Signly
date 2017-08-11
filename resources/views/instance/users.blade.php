@extends('app')

@section('content')

<div class="container">
	<div class="panel panel-default">
	 	<div class="panel-heading">Instance Users <a href="{{URL::to('/')}}/add-instance-user/{{$instance_id}}" title="Add new User" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
	 	<div class="panel-body">
	 		<table class="table">
	 			<thead>
	 				<th>ID</th>
	 				<th>Email</th>
	 				<th>Name</th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 			</thead>
	 			<tbody>
	 				@foreach($instance_users as $user)
	 					<tr>
	 						<td>{{ $user->id }}</td>
	 						<td>{{ $user->email }}</td>
	 						<td>{{ $user->first_name.' '.$user->last_name }}</td>
	 						<td><a href="{{URL::to('/')}}/instance/{{ $user->id }}">Edit</a></td>
	 						<td><a href="{{URL::to('/')}}/instance-users/{{ $user->id }}">Move</a></td>
	 						<td>
	 							{!! Form::open(['method' => 'DELETE', 'route' => ['deleteuser', $user->id],'class'=>'frmDeleteBillboard']) !!}
								   {!! Form::button('Delete', ['class' => 'btn btn-danger btnDeleteBillboard']) !!}
								{!! Form::close() !!}
	 						</td>
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
	 	</div>
	</div>
	
    
</div>

@endsection
