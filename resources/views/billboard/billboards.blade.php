@extends('app')

@section('content')

<div class="container">
	<div class="panel panel-default">
	 	<div class="panel-heading">Billboards <a href="{{URL::to('/')}}/add-billboard" title="Add new Billboard" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
	 	<div class="panel-body">
	 		<table class="table">
	 			<thead>
	 				<th>ID</th>
	 				<th>Name</th>
	 				<th>Address</th>
	 				<th>Lat/Long</th>
	 				<th>Hard Cost</th>
	 				<th>Monthly Impressions</th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 			</thead>
	 			<tbody>
	 				@foreach($billboards as $billboard)
	 					<tr>
	 						<td>{{ $billboard->id }}</td>
	 						<td>{{ $billboard->name }}</td>
	 						<th>{{ $billboard->address }}</th>
	 						<td>{{ $billboard->lat .','. $billboard->lng}}</td>
	 						<td>{{ $billboard->hard_cost }}</td>
	 						<td>{{ $billboard->monthly_impressions }}</td>
	 						<td><a href="{{URL::to('/')}}/billboards/{{ $billboard->id }}">Edit</a></td>
	 						<td><a href="#">View in Map</a></td>
	 						<td>
	 							{!! Form::open(['method' => 'DELETE', 'route' => ['deletebillboard', $billboard->id],'class'=>'frmDeleteBillboard']) !!}
								   {!! Form::button('Delete', ['class' => 'btn btn-danger btnDeleteBillboard']) !!}
								{!! Form::close() !!}
	 						</td>
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
	 	</div>
		<div class="text-center">
			{{ $billboards->links() }}
		</div>
	</div>
	
    
</div>

@endsection
