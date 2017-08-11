@extends('app')

@section('content')

<div class="container">
	<div class="panel panel-default">
	 	<div class="panel-heading">Proposals <a href="{{URL::to('/')}}/add-proposal" title="Add new Proposal" class="pull-right"><i style="color:#2fcc3e;" class="fa fa-plus-circle fa-lg"></i></a></div>
	 	<div class="panel-body">
	 		<table class="table">
	 			<thead>
	 				<th>ID</th>
	 				<th>Name</th>
	 				<th>Budget</th>
	 				<th>From</th>
	 				<th>To</th>
	 				<th>Lat / Long</th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 				<th></th>
	 			</thead>
	 			<tbody>
	 				@foreach($proposals as $proposal)
	 					<tr>
	 						<td>{{ $proposal->id }}</td>
	 						<td>@if($proposal->booked == 1) <span style="color:green;">[Booked]</span> @endif{{ $proposal->name }}</td>
	 						<th>${{ number_format($proposal->budget,2) }}</th>
	 						<!-- <td></td> -->
	 						<td>{{ $proposal->start_date }}</td>
	 						<td>{{ $proposal->end_date }}</td>
	 						<td>{{ $proposal->map_area_lat.' '.$proposal->map_area_long  }}</td>
	 						<!-- <td><a href="{{ URL::to('/') }}/proposals/{{ $proposal->id }}">View</a></td> -->
	 						
	 						<td>
	 							@if($proposal->booked == 0)
	 							{!! Form::open(['method' => 'DELETE', 'route' => ['deleteproposal', $proposal->id],'class'=>'frmDeleteProposal']) !!}
								   {!! Form::button('Delete', ['class' => 'btn btn-danger btnDeleteProposal']) !!}
								{!! Form::close() !!}
								@endif
	 						</td>

	 						<td>
	 							@if($proposal->booked == 0)
	 							<a id="edit_proposal" class="btn btn-info" data-id="{{ $proposal->id }}" href="{{ URL::to('/') }}/edit-proposal-billboards/{{ $proposal->id }}">Edit</a>
	 							@endif
 							</td>

 							<td>
	 							@if($proposal->booked == 0)
	 							<a id="make_contract" class="btn btn-info" href="{{ URL::to('/') }}/proposal/make-contract/{{ $proposal->id }}">Make Contract</a>
	 							@endif
 							</td>
	 						<!-- <td>
	 						@if($proposal->accepted == 1 && $proposal->booked == 0)
	 						<a href="{{ URL::to('/') }}/proposals/book/{{ $proposal->id }}" data-confirm="Book this proposal in the scheduler?">Book Proposal</a>
	 						@endif
	 						</td> -->
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
	 	</div>
	</div>
	
    
</div>

@endsection
