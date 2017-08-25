@extends('app')

@section('content')

<div class="container">
	<div class="panel panel-default">
	 	<div class="panel-heading">Owners <a href="{{URL::to('/')}}/add-owner" title="Add new Owner" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
	 	<div class="panel-body">
	 		<table class="table">
	 			<thead>
	 				<th>ID</th>
	 				<th>Company Name</th>
	 				<th>Contact Name</th>
	 				<th>Email</th>
	 				<th>Phone</th>
	 				<th>Mobile</th>
	 				<th>Fax</th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 			</thead>
	 			<tbody>
	 				@foreach($owners as $owner)
	 					<tr>
	 						<td>{{ $owner->id }}</td>
	 						<td>{{ $owner->company }}</td>
	 						<th>{{ $owner->first_name.' '.$owner->last_name }}</th>
	 						<td>{{ $owner->email }}</td>
	 						<td>{{ $owner->phone1 }}</td>
	 						<td>{{ $owner->phone2 }}</td>
	 						<td>{{ $owner->fax }}</td>
	 						<td>
	 							{!! Form::open(['method' => 'DELETE', 'route' => ['deleteowner', $owner->id],'class'=>'frmDeleteOwner']) !!}
								   {!! Form::button('Delete', ['class' => 'btn btn-danger btnDeleteOwner']) !!}
								{!! Form::close() !!}
	 						</td> 
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
	 	</div>
		<div class="text-center">
			{{ $owners->links() }}
		</div>
	</div>
	
    
</div>

@endsection
