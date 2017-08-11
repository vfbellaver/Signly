<!DOCTYPE html>
<html lang="en">
<head>
	<base href="http://www.signly.com/app">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous"> -->

	

	

	<title>Billboard Proposal</title>

	
</head>
<body>

		

	@foreach($proposal_billboards as $billboard)
	<div style="page-break-after: always; ">

	<div class="row">
		<div class="col-md-1">
			<img src="{{ URL::to('/') }}/images/reagan-logo-sm.png">	
		</div>
		<div class="col-md-10"></div>
		<div class="col-md-1">
			
		</div>
	</div>

	<div style="padding:20px;">

			<table style="width:100%;border:3px solid black !important; padding:30px;">
				<tr>
					<td style="text-align:center;" colspan="2">
							<?php 
							  if ($billboard->photo != ''){
						      	echo '<img id="bi_face'.$billboard->pbid.'" class="" src="'.URL::to('/images/billboard/') .'/'.$billboard->photo.'" style="margin 0 auto;width:600px;height:300px;" /> ';
						  	  } else {
						  	  	echo '<img class="" src="'.URL::to('/images/').'/no-preview.jpg" style="margin 0 auto;width:100%;" />';
						  	  }
							?>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="font-size:42px; font-weight:bold; padding-left:10px;">{{ $billboard->name }}</td>
				</tr>
				<tr>
					<!-- details area -->
					<td>
						<table>
							<tr>
								<td><b>Description</b></td>
								<td>{{ $billboard->description }}</td>
							</tr>
							<tr>
								<td><b>Address</b></td>
								<td>{{ $billboard->address }} {{ $billboard->city }} {{ $billboard->state }} {{ $billboard->zipcode }}</td>
							</tr>
							<tr>
								<td><b>Coordinates</b></td>
								<td>{{ $billboard->lat }},{{ $billboard->lng }}</td>
							</tr>
							<tr>
								<td><b>Dimensions</b></td>
								<td>{{ $billboard->height }},{{ $billboard->width }}</td>
							</tr>
							<tr>
								<td><b>Facing</b></td>
								<td>{{ $billboard->label }}</td>
							</tr>
							<tr>
								<td><b>Reads</b></td>
								<td>{{ $billboard->reads }}</td>
							</tr>
							<tr>
								<td><b>DEC</b></td>
								<td>{{ $billboard->monthly_impressions }}</td>
							</tr>
							<tr>
								<td><b>MSRP</b></td>
								<td>{{ $billboard->rate }}</td>
							</tr>
							<tr>
								<td><b>Your rate</b></td>
								<td>{{ $billboard->rate }}</td>
							</tr>
							<tr>
								<td><b>CPM</b></td>
								<td></td>
							</tr>
							<tr>
								<td><b>Notes</b></td>
								<td>{{ $billboard->notes }}</td>
							</tr>
						</table>
					</td>
					<td>
						<!-- <div style="height:300px;width:100%;" id="map_canvas{{ $billboard->pbid }}"></div> -->
						<div style=""><img src="http://maps.googleapis.com/maps/api/staticmap?center={{$billboard->lat}},{{$billboard->lng}}&zoom=12&size=150x150&scale=2&markers=color:blue%7Clabel:B%7C{{$billboard->lat}},{{$billboard->lng}}" /></div>
					</td>

				</tr>
				
			</table>
	</div>
	
	</div>
	@endforeach

<script src="{{ URL::to('/') }}/js/jquery-1.9.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>



</body>
</html>
