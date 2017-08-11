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
	<div style="page-break-after: always; border:3px solid black !important; padding-bottom: 50px;">

	<!-- <div class="row">
		<div class="col-md-2">
			<img src="{{ URL::to('/') }}/images/reagan-logo-sm.png" style="padding:20px;">	
		</div>
		<div class="col-md-5"></div>
		<div class="col-md-5">
			<div style="text-align:right;font-size:9px;">1775 N. Warm Springs Road · Salt Lake City, UT 84116</div>
			<div style="text-align:right;font-size:9px;">P (801) 521.1775 F (801) 521.9741</div>
			<div style="text-align:right;font-size:9px;">www.reaganoutdoor.com</div>
		</div>
	</div> -->

	<div style="width:100%; padding:10px; background-color: #f9f400; ">
		<img src="{{ URL::to('/') }}/images/mammoth-pdf-header.jpg">	
	</div>
	<div>
		<?php 
		  if ($billboard->photo != ''){
	      	echo '<img id="bi_face'.$billboard->pbid.'" class="" src="'.URL::to('/images/billboard/') .'/'.$billboard->photo.'" style="margin 0 auto;width:100%;" /> ';
	  	  } else {
	  	  	echo '<img class="" src="'.URL::to('/images/').'/no-preview.jpg" style="margin 0 auto;width:100%;" />';
	  	  }
	  	  //echo '<img class="" src="'.URL::to('/images/').'/no-preview.jpg" style="margin 0 auto;width:100%;" />';
		?>
	</div>
	<div style="padding:5px; font-size:18px; color:#060000; font-weight:bold;">
	 <font style="padding-right:5px;">#{{ $billboard->pbid }}</font>	{{ $billboard->name }} . {{ $billboard->address }} {{ $billboard->city }} {{ $billboard->state }} {{ $billboard->zipcode }}
	</div>
	<div style="padding:5px;">

			<table style="width:100%;">
				<tr>
					<td width="50%">
						<table>
							<tr>
								<td><b>Facing Direction</b></td>
								<td>{{ $billboard->label }}</td>
							</tr>
							<tr>
								<td><b>Reads</b></td>
								<td>{{ $billboard->reads }}</td>
							</tr>
							<tr>
								<td><b>Size</b></td>
								<td>{{ $billboard->height }} X {{ $billboard->width }}</td>
							</tr>
							<tr>
								<td><b>DEC</b></td>
								<td>{{ $billboard->monthly_impressions }}</td>
							</tr>
							<tr>
								<td><b>Latitude</b></td>
								<td>{{ $billboard->lat }}</td>
							</tr>
							<tr>
								<td><b>Longtitude</b></td>
								<td>{{ $billboard->lng }}</td>
							</tr>
						</table>

					</td>
					<td colspan="2"  width="50%">
						<font style="font-size:25px;">OUTDOOR SOLUTIONS</font>
						<p>Allow us to do the work for you...</p>
						<p>We have the outdoor advertising you need
						and the experience to help.</p>
						<p>We have Static and Digital Billboards and
						On Premise Digital LED sign</p>
					</td>
				</tr>
				
				
			</table>

			<div>
				<table style="width:50%; text-align:center;">
					<tr><td><font style="font-size:18px;">Supplying Solutions</font></td></tr>
					<tr><td><font style="font-size:18px;">Call Us!</font></td></tr>
				</table>
			</div>

			<table style="width:100%;">
				<tr>
					<td width="50%">
						<table>
							<tr>
								<td><font style="font-size:18px; font-weight:bold;">Matt</font></td>	
							</tr>
							<tr>
								<td>801-898-2420</td>
							</tr>
							<tr>
								<td>matt@mammothbillboards.com</td>
							</tr>
						</table>
						
					</td>
					<td  colspan="2"  width="50%">
						<table>
							<tr>
								<td><font style="font-size:18px;font-weight:bold;">Terry</font></td>
							</tr>
							<tr>
								<td>801-898-2430</td>
							</tr>
							<tr>
								<td>terry@mammothbillboards.com</td>
							</tr>
						</table>
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
