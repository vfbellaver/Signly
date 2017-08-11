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
			<img src="{{ URL::to('/') }}/images/signly-sm.png">	
		</div>
		<div class="col-md-10"></div>
		<div class="col-md-1">
			
		</div>
	</div>

	@foreach($proposal_billboards as $billboard)
	<div class="row">
		<div class="col-md-12">
			<?php 
			  if ($billboard->photo != ''){
		      	echo '<img id="bi_face'.$billboard->pbid.'" class="billboard_images center-block" src="'.URL::to('/images/billboard/') .'/'.$billboard->photo.'" width="50%" style="margin 0 auto;" /> ';
		  	  } else {
		  	  	echo '<img class="billboard_images" src="'.URL::to('/images/').'/no-preview.jpg" />';
		  	  }
			?>
		</div>
	</div>

	<br/>
	
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">{{ $billboard->name }}</div>
			</div>
			<b>Description</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->description }}</div>
			</div>
			<b>Address</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->address }} {{ $billboard->city }} {{ $billboard->state }} {{ $billboard->zipcode }}</div>
			</div>
			<b>Coordinates</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->lat }},{{ $billboard->lng }}</div>
			</div>
			<b>Dimensions</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->height }},{{ $billboard->width }}</div>
			</div>
			<b>Facing</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->label }}</div>
			</div>
			<b>Read</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->reads }}</div>
			</div>
			<b>DEC</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->monthly_impressions }}</div>
			</div>
			<b>MSRP</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->rate }}</div>
			</div>
			<b>Your rate</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->rate }}</div>
			</div>
			<b>CPM</b>
			<div class="row">
				<div class="col-md-12"></div>
			</div>
			<b>Notes</b>
			<div class="row">
				<div class="col-md-12">{{ $billboard->notes }}</div>
			</div>
		</div>
		<div class="col-md-6" style="height:300px;">
			<div id="map_canvas{{ $billboard->pbid }}" style="height:100%; width: 100%;"></div>
		</div>
	</div>
	
	@endforeach
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
		        zoom: 6,
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
