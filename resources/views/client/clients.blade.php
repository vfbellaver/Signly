@extends('app')

@section('content')

<div class="container">
	<div class="panel panel-default">
	 	<div class="panel-heading">Clients <a href="{{URL::to('/')}}/add-client" title="Add new Client" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
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
	 				@foreach($clients as $client)
	 					<tr>
	 						<td>{{ $client->id }}</td>
	 						<td>{{ $client->company }}</td>
	 						<th>{{ $client->first_name.' '.$client->last_name }}</th>
	 						<td>{{ $client->email }}</td>
	 						<td>{{ $client->phone1 }}</td>
	 						<td>{{ $client->phone2 }}</td>
	 						<td>{{ $client->fax }}</td>
	 						<td>
	 							{!! Form::open(['method' => 'DELETE', 'route' => ['deleteclient', $client->id],'class'=>'frmDeleteClient']) !!}
								   {!! Form::button('Delete', ['class' => 'btn btn-danger btnDeleteClient']) !!}
								{!! Form::close() !!}
	 						</td> 
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
		</div>
		<div class="text-centers">
			{{ $clients->links() }}
		</div>
	</div>

	

</div>

@endsection
