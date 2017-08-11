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
		<table style="width:100%;">
			<tr>
				<td>
					<img src="{{ URL::to('/') }}/images/kennedy_outdoor_advertising_logo.jpg">	
				</td>
				<td style="text-align:right;">
					Richard Kennedy<br/>
					(740) 258-7083<br/>
					www.kennedyoutdoor.com<br/>
				</td>
			</tr>
		</table>
	</div>

	<div style="padding:10px; border:3px solid black !important; height: 900px;">

			<table style="width:100%;">
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
							
							<tr style="height: 30px;">
								<td><b>Address</b><br/><br/></td>
								<td>{{ $billboard->address }} {{ $billboard->city }} {{ $billboard->state }} {{ $billboard->zipcode }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>Coordinates</b><br/><br/></td>
								<td>{{ $billboard->lat }},{{ $billboard->lng }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>Dimensions</b><br/><br/></td>
								<td>{{ $billboard->height }},{{ $billboard->width }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>Facing</b><br/><br/></td>
								<td>{{ $billboard->label }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>Reads</b><br/><br/></td>
								<td>{{ $billboard->reads }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>DEC</b><br/><br/></td>
								<td>{{ $billboard->monthly_impressions }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>MSRP</b><br/><br/></td>
								<td>{{ $billboard->rate }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>Your rate</b><br/><br/></td>
								<td>{{ $billboard->rate }}<br/><br/></td>
							</tr>
							<tr style="height: 30px;">
								<td><b>CPM</b><br/><br/></td>
								<td><br/><br/></td>
							</tr>
							<tr style="height: 60px;">
								<td><b>Notes</b><br/><br/></td>
								<td>{{ $billboard->notes }}<br/><br/></td>
							</tr>
						</table>
					</td>
					<td>
						<!-- <div style="height:300px;width:100%;" id="map_canvas{{ $billboard->pbid }}"></div> -->
						<div style="border: 1px solid #000000;"><img src="http://maps.googleapis.com/maps/api/staticmap?center={{ urlencode($billboard->address) }}+{{ urlencode($billboard->city) }}+{{ urlencode($billboard->state) }}+{{ urlencode($billboard->zipcode) }}&zoom=15&size=150x200&format=jpg&maptype=roadmap&scale=4&markers=color:blue%7Clabel:A%7C{{$billboard->lat}},{{$billboard->lng}}" /></div>

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
