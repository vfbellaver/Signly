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
	<div style="page-break-after: always; border:3px solid black !important; padding-bottom: 50px; padding-top: 10px; background-color:#fef200">

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

	<div style="padding: 20px; border: 2px solid #000000; background-color: #ffffff; width: 90%; margin: 0 auto;">
		<?php 
		  if ($billboard->photo != ''){
	      	echo '<img id="bi_face'.$billboard->pbid.'" class="" src="'.URL::to('/images/billboard/') .'/'.$billboard->photo.'" style="width:100%; max-height: 350px;" /> ';
	  	  } else {
	  	  	echo '<img class="" src="'.URL::to('/images/').'/no-preview.jpg" style="margin 0 auto; width:100%; max-height: 350px;" />';
	  	  }
	  	  //echo '<img class="" src="'.URL::to('/images/').'/no-preview.jpg" style="margin 0 auto;width:100%;" />';
		?>
	</div>
	<div style="padding:5px; font-size:18px; color:#060000; font-weight:bold;">
	 <table style="width:100%;">
	 	<tr>
	 		<td style="width: 80%">
	 			<div>
	 				<font style="padding-right:5px;">Location: {{ $billboard->address }} {{ $billboard->city }} {{ $billboard->state }} {{ $billboard->zipcode }}</font>
	 			</div>
	 			<div>
	 				<font style="padding-right:5px;">{{ $billboard->lat }} - {{ $billboard->lng }}</font>
	 			</div>
	 			<div>
	 				<font style="padding-right:5px;">Description: {{ strtoupper($billboard->label) }} FACE {{ strtoupper($billboard->reads) }} READ </font>
	 			</div>
	 			<div>
	 				<font style="padding-right:5px;">Dimensions: {{ $billboard->height }}' X {{ $billboard->width }}' </font>
	 			</div>
	 		</td>
	 		<td style="width: 20%">
	 			<div>
	 			<font style="padding-right:5px;font-size:42px;">#{{ $billboard->unique_id }}</font>
	 			</div>
	 			<div>
	 			@if($billboard->sign_type == 0)
	 			<font style="padding-right:5px;font-size:22px;">STATIC</font>
	 			@else
	 			<font style="padding-right:5px;font-size:22px;">DIGITAL</font>
	 			@endif
	 			</div>
	 		</td>
	 	</tr>
	 </table>
	 
	</div>


	<div style="width:100%; padding:10px; background-color: #f9f400; margin:0 auto;">
		<img src="{{ URL::to('/') }}/images/mammoth-pdf-footer.jpg" style="width:90%;">	
	</div>
	
	</div>
	@endforeach

<script src="{{ URL::to('/') }}/js/jquery-1.9.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>



</body>
</html>
