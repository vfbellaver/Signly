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

	<div class="row">
		<div class="col-md-1">
			<img src="{{ URL::to('/') }}/images/reagan-logo-sm.png">	
		</div>
		<div class="col-md-10"></div>
		<div class="col-md-1">
			
		</div>
	</div>

	<div style="padding:20px;">
	

	@foreach($proposal_billboards as $billboard)
	<div style="page-break-after: always;">
	<table style="width:100%; border:3px solid black !important;">
		<tr>
			<td style="text-align:center;">
				<?php 
				  if ($billboard->photo != ''){
			      	echo '<img id="bi_face'.$billboard->pbid.'" class="billboard_images center-block" src="'.URL::to('/images/billboard/') .'/'.$billboard->photo.'" style="margin 0 auto;width:300px;" /> ';
			  	  } else {
			  	  	echo '<img class="billboard_images" src="'.URL::to('/images/').'/no-preview.jpg" />';
			  	  }
				?>
			</td>
			<td>
				<div style="height:300px;width:100%;" id="map_canvas{{ $billboard->pbid }}"></div>
			</td>
		</tr>
		<tr>
			<td colspan="2">{{ $billboard->name }}</td>
		</tr>
		<tr>
			<!-- details area -->
			<td style="width:50%;">
				<table>
					<tr>
						<td>Description</td>
						<td>{{ $billboard->description }}</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>{{ $billboard->address }} {{ $billboard->city }} {{ $billboard->state }} {{ $billboard->zipcode }}</td>
					</tr>
					<tr>
						<td>Coordinates</td>
						<td>{{ $billboard->lat }},{{ $billboard->lng }}</td>
					</tr>
					<tr>
						<td>Dimensions</td>
						<td>{{ $billboard->height }},{{ $billboard->width }}</td>
					</tr>
					<tr>
						<td>Facing</td>
						<td>{{ $billboard->label }}</td>
					</tr>
					<tr>
						<td>Reads</td>
						<td>{{ $billboard->reads }}</td>
					</tr>
					<tr>
						<td>DEC</td>
						<td>{{ $billboard->monthly_impressions }}</td>
					</tr>
					<tr>
						<td>MSRP</td>
						<td>{{ $billboard->rate }}</td>
					</tr>
					<tr>
						<td>Your rate</td>
						<td>{{ $billboard->rate }}</td>
					</tr>
					<tr>
						<td>CPM</td>
						<td></td>
					</tr>
					<tr>
						<td>Notes</td>
						<td>{{ $billboard->notes }}</td>
					</tr>
				</table>
			</td>
			<!-- map area -->
			<td  style="width:50%;">
				
			</td>
		</tr>
	</table>
	</div>
	@endforeach

	</div>
	
<script src="{{ URL::to('/') }}/js/jquery-1.9.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&#038;ver=3.0&key=AIzaSyBUaQHyneq6J_6N8BW5MT50BM9riXkI5oM'>
		<!--<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&#038;ver=3.0'>-->
	</script>
<script type="text/javascript">
	$( document ).ready(function() {
		function initialize() {
		  
		  @foreach($proposal_billboards as $billboard)
		  
		  var map{{ $billboard->pbid }};
		  var latlng{{ $billboard->pbid }} = new google.maps.LatLng({{ $billboard->lat }},{{ $billboard->lng }});
		  var myOptions{{ $billboard->pbid }} = {
		        center: latlng{{ $billboard->pbid }},
		        mapTypeId: google.maps.MapTypeId.ROADMAP,
		        zoom: 12,
  			    zoomControl:true,
				mapTypeControl:false
				
		    }
		  map{{ $billboard->pbid }} = new google.maps.Map(document.getElementById('map_canvas{{ $billboard->pbid }}'), myOptions{{ $billboard->pbid }});
		  var marker{{ $billboard->pbid }} = new google.maps.Marker({
							  position: latlng{{ $billboard->pbid }},
							  map: map{{ $billboard->pbid }},
							  icon: 'http://www.signly.com/app/images/digital-board.png'
							});

		  @endforeach
		}
		initialize();
	});
	</script>
	

</body>
</html>
