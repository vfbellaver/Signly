<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Billboard Planner</title>

	<link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/daterangepicker-bs3.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				
				<a class="navbar-brand" href="/"><img src="{{ URL::to('/') }}/images/signly-sm.png"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ URL::to('/') }}/auth/login">Login</a></li>
						
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ URL::to('/') }}/js/moment.min.js"></script>
	<script src="{{ URL::to('/') }}/js/daterangepicker.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		  $('#daterange').daterangepicker(
				{
					ranges: {
			           'Today': [new Date(), new Date()],
			           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
			           'Last 7 Days': [moment().subtract('days', 6), new Date()],
			           'Last 30 Days': [moment().subtract('days', 29), new Date()],
			           'This Month': [moment().startOf('month'), moment().endOf('month')],
			           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
					},
					opens: 'left',
					format: 'YYYY-MM-DD',
					startDate: '2015-01-23',
					endDate: '2015-02-21'
							}, 
				function(start, end) {
					$('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
					getTable(start.format("YYYY-MM-DD"), end.format("YYYY-MM-DD"), selected_goal);
					getGraph(start.format("YYYY-MM-DD"), end.format("YYYY-MM-DD"), selected_goal);
				}
			);
		});
	</script>
</body>
</html>
