@extends('app')

@section('content')

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Clients <a href="{{URL::to('/')}}/add-client" title="Add new Client" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
			<div class="panel-body">
				<table class="table">
					<thead>
					<th>ID</th>
					<th>Logo</th>
					<th>Company Name</th>
					<th>Contact Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Mobile</th>
					<th>Fax</th>
					<th>Delete</th>

					</thead>
					<tbody>
					@foreach($clients as $client)
						<tr>
							<td id="aligntd">{{ $client->id }}</td>
							<td id="aligntd"><img height="50" src="{{ asset('storage/clients_logo/'.$client->id.'/'.$client->logo) }}"></td>
							<td id="aligntd">{{ $client->company }}</td>
							<td id="aligntd">{{ $client->first_name.' '.$client->last_name }}</td>
							<td id="aligntd">{{ $client->email }}</td>
							<td id="aligntd">{{ $client->phone1 }}</td>
							<td id="aligntd">{{ $client->phone2 }}</td>
							<td id="aligntd">{{ $client->fax }}</td>
							<td id="aligntd">
								{!! Form::open(array('method' => 'POST', 'route' => array('deleteclient', $client->id),'class'=>'frmDeleteClient')) !!}
								    <input type="hidden" value="DELETE">
                                {!! Form::button('Delete', array('class' => 'btn btn-danger btnDeleteClient', 'type'=>'submit')) !!}
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{{ $clients->links() }}
			</div>
		</div>



	</div>

@endsection
