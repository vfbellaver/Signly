<!DOCTYPE html>
<html lang="en">
<head>
	<base href="https://www.signly.com/app">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Billboard Planner</title>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/scheduler_8.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/daterangepicker-bs3.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/jquery.qtip.min.css" rel="stylesheet">

	<!-- dropzone js -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css" rel="stylesheet">

	<link href="{{ URL::to('/') }}/css/magnific-popup.css" rel="stylesheet">
	

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<link rel="stylesheet" href="{{ URL::to('/') }}/css/jquery.light.min.css">

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5P2KSHJ');</script>
	<!-- End Google Tag Manager -->
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5P2KSHJ"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ URL::to('/') }}/images/signly-sm.png"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Billboard <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ URL::to('/') }}">Billboard Map</a></li>
							<li><a href="{{ URL::to('/') }}/billboards">Billboard List</a></li>
							<li><a href="{{ URL::to('/') }}/billboard-booking">Billboard Booking</a></li>
							<!-- <li><a href="{{ URL::to('/') }}/billboard-booking-vendor">Billboard Booking List (By Vendor)</a></li> -->
							<li><a href="{{ URL::to('/') }}/add-billboard">Add New Billboard</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Proposal <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ URL::to('/') }}/add-proposal">Add New Proposal</a></li>
							<li><a href="{{ URL::to('/') }}/proposals">Proposals</a></li>
							<!-- proposals-settings -->
							<li><a href="{{ URL::to('/') }}/proposals-settings">Settings</a></li>
							<!-- <li><a href="{{ URL::to('/') }}/proposal-signature">Sign Proposal</a></li> -->
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Clients <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ URL::to('/') }}/clients">Clients List</a></li>
							<li><a href="{{ URL::to('/') }}/add-client">Add New Client</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Owners <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ URL::to('/') }}/owners">Owners List</a></li>
							<li><a href="{{ URL::to('/') }}/add-owner">Add New Owner</a></li>
						</ul>
					</li>

					<?php 
						$founder = \Auth::user();

						if($founder->is_founder == 1){ ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Instances <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ URL::to('/') }}/instances">Instances</a></li>
						</ul>
					</li>
					<?php } ?>
					
				</ul>
				<form class="navbar-form navbar-left">
					<div class="form-group">
						<button type="button" id="active-proposal" class="btn btn-default">Show/Hide Proposal</button>
					</div>
				</form>
				<div class="pull-right">
					<!-- <idv id="daterange" class="btn">
	                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
	                  <span></span> <b class="caret"></b>
	               	</div> -->

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href="{{ URL::to('/') }}/auth/login">Login</a></li>
							<li><a href="{{ URL::to('/') }}/auth/register">Register</a></li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img width="25" height="25" src="{{URL::to('/') }}/images/billboard/user-image.png"/><span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ URL::to('/') }}/account">My Account</a></li>
									<li><a href="{{ URL::to('/') }}/auth/logout">Logout</a></li>
								</ul>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#bugReport" title="Report Bug"><i class="fa fa-bug"></i></a>
							</li>
						@endif
					</ul>	
				</div>
				

			</div>
		</div>
	</nav>

<!-- Modal Create Proposal-->
<div class="modal fade" id="bugReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Report Bug</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'postbugreport', 'method'=> 'POST', 'id'=>'frm_new_bug', 'name' => 'frm_new_bug', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

			<div class="form-group" style="padding:20px;">
				<div>
					<label class="control-label">Short description of the bug</label>
				</div>
				<div>
					<textarea class="form-control" name="bugdescription"></textarea>
				</div>
			</div>

	  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Send Report</button>
		  </div>
       {!! Form::close() !!}
    </div>
  </div>
</div>

	@yield('content')


	<!-- Scripts -->
	<!---<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	<!---<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
	<script src="{{ URL::to('/') }}/js/jquery-1.9.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<!-- drop zone -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>

	<script src="{{ URL::to('/') }}/js/moment.min.js"></script>
	<script src="{{ URL::to('/') }}/js/daterangepicker.js"></script>

	<script src="{{ URL::to('/') }}/js/jquery.tabSlideOut.v1.3.js"></script>
	<script src="{{ URL::to('/') }}/js/jquery.qtip.min.js"></script>
	<script src="{{ URL::to('/') }}/js/daypilot/daypilot-all.min.js"></script>

	<script src="{{ URL::to('/') }}/js/jquery.magnific-popup.min.js"></script>
	<script src="{{ URL::to('/') }}/js/jquery.zeroclipboard.min.js"></script>
	
	<script src="https://cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>

	<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&#038;ver=3.0&key=AIzaSyBUaQHyneq6J_6N8BW5MT50BM9riXkI5oM'>
		<!--<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&#038;ver=3.0'>-->
	</script>

	<script type="text/javascript">

		function getNewMessages(){
			var id = $('#proposal_id').val();
		    
		    if(id != ''){
		    	ajaxurl = "{{URL::to('/')}}/get-comments/" + id;
			    $.ajax({
			        url: ajaxurl,
			        type: "GET",
			        success: function(data){
			            $data = $(data); // the HTML content that controller has produced
			            $('#sidr-id-proposalComments').html($data);
			            $('#sidr-id-proposalComments').animate({scrollTop: $('#sidr-id-proposalComments').get(0).scrollHeight}, 2000);
			        }
			    });
		    }
		    
		}

		setInterval(function(){
		   if($('#sidr-id-proposalComments').length != 0){
		    	getNewMessages() // this will run after every 30 seconds
			}
		}, 5000);

			if($('#billboardListvendor').length != 0){

					window.picker = new DayPilot.DatePicker({
		                            target: 'start', 
		                            pattern: 'M/d/yyyy', 
		                            date: new DayPilot.Date().firstDayOfMonth(),
		                            onTimeRangeSelected: function(args) { 
		                                dp.startDate = args.start;
		                                loadTimeline(args.start);
		                                loadEvents();
		                            }
		                        });
						$("#timerange").change(function() {
		                            switch (this.value) {
		                                case "week":
		                                    window.dp.days = 7;
		                                    break;
		                                case "2 weeks":
		                                    window.dp.days = 14;
		                                    break;
		                                case "month":
		                                    window.dp.days = window.dp.startDate.daysInMonth();
		                                    break;
		                                case "2 months":
		                                    window.dp.days = window.dp.startDate.daysInMonth() + window.dp.startDate.addMonths(1).daysInMonth();
		                                    break;
		                            }

		                            loadTimeline(DayPilot.Date.today());
		                            loadEvents();
		                            
		                        });

				 	window.dp = new DayPilot.Scheduler("billboardListvendor");


					window.dp.onBeforeCellRender = function(args) {
						  var dayOfWeek = args.cell.start.getDayOfWeek();
						  if (dayOfWeek === 6 || dayOfWeek === 0) {
						      args.cell.backColor = "#f8f8f8";
						  }
					  };
						
					  currentYearDate = new Date(new Date().getFullYear(), 0, 1);
					  window.dp.startDate = currentYearDate;
					  //window.dp.days = 365; //window.dp.startDate.daysInMonth();
					  // window.dp.timeHeaders = [
		     //                    { groupBy: "Year", format: "yyyy" },
		     //                    { groupBy: "Month", format: "MMMM yyyy" }
		     //                ];

		              window.dp.eventHeight = 50;
		              window.dp.bubble = new DayPilot.Bubble({});
		              window.dp.cellDuration = 1440;
		              window.dp.cellGroupBy = 'Month';
		              window.dp.treeEnabled = true;
		              window.dp.theme = 'scheduler_8';
		                    
		              window.dp.rowHeaderColumns = [
		              	{title: "Client", width: 220},
		              ];

		              window.dp.contextMenu = new DayPilot.Menu({items: [
					        {text:"Edit", onclick: function() { window.events.edit(this.source); } },
					        {text:"View", onclick: function() { window.events.remove(this.source); } },
					        {text:"-"},
					        {text:"Select", onclick: function() { window.multiselect.add(this.source); } },
					    ]});

						window.dp.init();
					


					loadResources();
					loadEvents();
					
					}



					if($('#billboardList').length != 0){


						window.picker = new DayPilot.DatePicker({
		                            target: 'start', 
		                            pattern: 'M/d/yyyy', 
		                            date: new DayPilot.Date().firstDayOfMonth(),
		                            onTimeRangeSelected: function(args) { 
		                                window.dp.startDate = args.start;
		                                loadTimeline(args.start);
		                                loadEvents();
		                            }
		                        });
						$("#timerange").change(function() {
		                            switch (this.value) {
		                                case "week":
		                                    window.dp.days = 7;
		                                    break;
		                                case "2 weeks":
		                                    window.dp.days = 14;
		                                    break;
		                                case "month":
		                                    window.dp.days = window.dp.startDate.daysInMonth();
		                                    break;
		                                case "2 months":
		                                    window.dp.days = window.dp.startDate.daysInMonth() + window.dp.startDate.addMonths(1).daysInMonth();
		                                    break;
		                            }

		                            loadTimeline(DayPilot.Date.today());
		                            loadEvents();
		                            
		                        });

				 	window.dp = new DayPilot.Scheduler("billboardList");

					window.dp.onBeforeCellRender = function(args) {
						  var dayOfWeek = args.cell.start.getDayOfWeek();
						  if (dayOfWeek === 6 || dayOfWeek === 0) {
						      args.cell.backColor = "#f8f8f8";
						  }
					  };
						
					  window.dp.cellWidthSpec = "Auto";
					  //window.dp.scale = "Month";	
					  currentYearDate = new Date(new Date().getFullYear()-3, 0, 1);
					  window.dp.startDate = currentYearDate;
					  window.dp.days = 2556; //window.dp.startDate.daysInMonth();
					  window.dp.timeHeaders = [
					  			{ groupBy: "Year", format: "yyyy" },
		                        { groupBy: "Month", format: "MMM" }
		                    ];

		              window.dp.eventHeight = 32;
		              window.dp.bubble = new DayPilot.Bubble({});
		              window.dp.cellDuration = 1440;
		              //window.dp.cellGroupBy = 'Month';
		              window.dp.rowMinHeight = 32;
		              window.dp.treeEnabled = false;
		              window.dp.theme = 'scheduler_8';
		                    
		              window.dp.rowHeaderColumns = [
		              	{title: "ID", width: 30},
		              	{title: "Name", width: 200},
		              	{title: "Facing", width: 60},
		              	{title: "Reads", width: 60},
		              	{title: "Size", width: 80},
		              	{title: "Rate Card", width: 80},
		              	{title: "DEC", width: 80},
		              ];

		              window.dp.contextMenu = new DayPilot.Menu({items: [
					        {text:"Edit", onclick: function() { 
					        		window.events.edit(this.source); 
					        	} },
					        {text:"Delete", onclick: function() { 
					        		var r = confirm("Delete this booking?");
									if (r == true) {
									    //window.events.remove(this.source); 
									    //alert(this.source.value());
									    manualPost("{{ URL::to('/') }}/billboard-booking/delete/"+this.source.value(),{_token: '{{ csrf_token() }}'});
									} 					        		
					        	} },
					     
					    ]});

						window.dp.init();
					


					loadResources();
					loadEvents();

					window.dp.onTimeRangeSelected = function (args) {
					  // var name = prompt("New Schedule Label", "Event");
					  // window.dp.clearSelection();
					  // if (!name) return;

					  // $.post("backend_create.php", 
					  //     {
					  //         start: args.start.toString(),
					  //         end: args.end.toString(),
					  //         resource: args.resource,
					  //         name: name
					  //     }, 
					  //     function(data) {
					  //         var e = new DayPilot.Event({
					  //             start: args.start,
					  //             end: args.end,
					  //             id: data.id,
					  //             resource: args.resource,
					  //             text: name
					  //         });
					  //         dp.events.add(e);

					  //         dp.message(data.message);
					  //     });
						

						$('#billboard_face_id').val(args.resource);
						//var d = $.datepicker.parseDate("MM-DD-YYYY",  args.start.toString());
						var momentDateStart = moment(args.start, 'YYYY-MM-DD');
						var momentDateEnd = moment(args.end, 'YYYY-MM-DD');
						var momentLastDayDateEnd = moment(args.end, 'YYYY-MM-DD').daysInMonth() ;

						var momentDateStartObject = momentDateStart.toDate();
						var dd = 1;//momentDateStartObject.getDate();
						var mm = momentDateStartObject.getMonth()+1; //January is 0!
						var yyyy = momentDateStartObject.getFullYear();

						if(dd<10) {
						    dd='0'+dd
						} 

						if(mm<10) {
						    mm='0'+mm
						} 

						momentDateStartString = mm+'/'+dd+'/'+yyyy;
						window.momentDateStartStringVal = yyyy+'-'+mm+'-'+dd;

						var momentDateEndObject = momentDateEnd.toDate();
						momentDateEndObject.setDate(momentDateEndObject.getDate()-1);
						var dd = momentLastDayDateEnd;//momentDateEndObject.getDate();
						var mm = momentDateEndObject.getMonth()+1; //January is 0!
						var yyyy = momentDateEndObject.getFullYear();

						if(dd<10) {
						    dd='0'+dd
						} 

						if(mm<10) {
						    mm='0'+mm
						} 

						momentDateEndString = mm+'/'+dd+'/'+yyyy;
						window.momentDateEndStringVal = yyyy+'-'+mm+'-'+dd;

						$('#newSchedule').find('#nsbdaterange').find('span').html('<strong>' + momentDateStartString + ' - ' + momentDateEndString + '</strong>');
						$('#bstart_date').val(momentDateStartString);
						$('#bend_date').val(momentDateEndString);

						$('#nsbdaterange').daterangepicker(
							{ 
								startDate: momentDateStartString, 
								endDate: momentDateEndString
							},
							function(start, end, label) {
								$('#nsbdaterange').find('span').html('<strong>' + start.format('MM-DD-YYYY') + ' - ' + end.format('MM-DD-YYYY') + '</strong>');
								$('#bstart_date').val(start.format('YYYY-MM-DD'));
								$('#bend_date').val(end.format('YYYY-MM-DD'));
							}
						);

						$('#newSchedule').modal('show');
						window.dp.clearSelection();
					};
			
			}

			function loadResources() {
			  $.get("{{ URL::to('/') }}/billboards/daypilot/json", 
			  function(data) {
			      window.dp.resources = data;
			      window.dp.update();
			  });
			}

			function loadEvents() {
			  var start = window.dp.startDate;
			  var end = window.dp.startDate.addDays(window.dp.days);

			  $.post("{{ URL::to('/') }}/billboards/daypilotevents/json", 
			      {
			          start: start.toString(),
			          end: end.toString(),
			          _token: '{{ csrf_token() }}'
			      },
			      function(data) {
			          window.dp.events.list = data;
			          window.dp.update();
			      }
			  );
			}

			function loadTimeline(date) {
                    window.dp.scale = "Day";
                    window.dp.timeline = [];
                    var start = date.getDatePart().addHours(12);
                    
                    for (var i = 0; i < window.dp.days; i++) {
                        window.dp.timeline.push({start: start.addDays(i), end: start.addDays(i+1)});
                    }
                    window.dp.update();
                }

			function manualPost(path, params, method) {
			    method = method || "post"; // Set method to post by default if not specified.

			    // The rest of this code assumes you are not using a library.
			    // It can be made less wordy if you use one.
			    var form = document.createElement("form");
			    form.setAttribute("method", method);
			    form.setAttribute("action", path);

			    for(var key in params) {
			        if(params.hasOwnProperty(key)) {
			            var hiddenField = document.createElement("input");
			            hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", key);
			            hiddenField.setAttribute("value", params[key]);

			            form.appendChild(hiddenField);
			         }
			    }

			    document.body.appendChild(form);
			    form.submit();
			}
			
	 	</script>

	<script type="text/javascript">

		$( document ).ready(function() {


			$('#active-proposal').sidr({
		      name: 'sidr-existing-content',
		      source: '#active-proposal-window',
		      side: 'right',
		      displace: false
		    });

		    if ($('#searchBillboard').length){
		    	$.sidr('open', 'sidr-existing-content');
		    	$('#active-proposal').show();
		    } else {
		    	$('#active-proposal').hide();
		    }

			

		    // $('#active-proposal-comments').sidr({
		    //   name: 'sidr-comments',
		    //   source: '#proposal-comments-window',
		    //   side: 'left',
		    //   displace: false
		    // });

			$("#filter").change(function(){
               loadResources();
            });

			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			window.contentString = '';

			if(dd<10) {
			    dd='0'+dd
			} 

			if(mm<10) {
			    mm='0'+mm
			} 

			today = mm+'/'+dd+'/'+yyyy;

				var geocoder;
				var globalMap;
				var infoWindows = [];
				var markersArray = [];

            <?php if(isset($start_date)){?>
            	jsStart_date = '{{ $start_date }}';
            	jsEnd_date = '{{ $end_date }}';
            <?php } else { ?>
            	jsStart_date = today;
            	jsEnd_date = today;
            <?php } ?>

			
			

						

			$('#bdaterange').find('span').html('<strong>' + today + ' - ' + today + '</strong>');
			
			$('#bdaterange').daterangepicker(
				{ 
					startDate: today, 
					endDate: today
				},
				function(start, end, label) {
					$('#bdaterange').find('span').html('<strong>' + start.format('MM-DD-YYYY') + ' - ' + end.format('MM-DD-YYYY') + '</strong>');
					$('input[name="bstart_date"]').val(start.format('YYYY-MM-DD'));
					$('input[name="bend_date"]').val(end.format('YYYY-MM-DD'));
				}
			);

			$('#cpdaterange').find('span').html('<strong>' + today + ' - ' + today + '</strong>');
			
			$('#cpdaterange').daterangepicker(
				{ 
					startDate: today, 
					endDate: today
				},
				function(start, end, label) {
					$('#cpdaterange').find('span').html('<strong>' + start.format('MM-DD-YYYY') + ' - ' + end.format('MM-DD-YYYY') + '</strong>');
					$('input[name="start_date"]').val(start.format('YYYY-MM-DD'));
					$('input[name="end_date"]').val(end.format('YYYY-MM-DD'));
				}
			);

			//$('#daterange').find('span').html('<strong>' + jsStart_date + ' to ' + jsEnd_date + '</strong>');
			
			// $('#daterange').daterangepicker(
			// 	{ 
			// 		startDate: jsStart_date, 
			// 		endDate: jsEnd_date
			// 	},
			// 	function(start, end, label) {
			// 		$('#daterange').find('span').html('<strong>' + start.format('MM/DD/YYYY') + ' to ' + end.format('MM/DD/YYYY') + '</strong>');
					
			// 		manualPost("{{ URL::to('/') }}/dateset",{start_date: start.format('MM/DD/YYYY'),end_date: end.format('MM/DD/YYYY'),_token: '{{ csrf_token() }}'});
					 
			//         return false;
			// 	}
			// );

		   $(".btnDeleteBillboard").click(function(){
		      if (confirm("Delete this billboard?")){
		         $(this).parent('form').submit();
		      }
		   });

		   $(".btnDeleteProposal").click(function(){
		      if (confirm("Delete this proposal?")){
		         $(this).parent('form').submit();
		      }
		   });

			
			function manualPost(path, params, method) {
			    method = method || "post"; // Set method to post by default if not specified.

			    // The rest of this code assumes you are not using a library.
			    // It can be made less wordy if you use one.
			    var form = document.createElement("form");
			    form.setAttribute("method", method);
			    form.setAttribute("action", path);

			    for(var key in params) {
			        if(params.hasOwnProperty(key)) {
			            var hiddenField = document.createElement("input");
			            hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", key);
			            hiddenField.setAttribute("value", params[key]);

			            form.appendChild(hiddenField);
			         }
			    }

			    document.body.appendChild(form);
			    form.submit();
			}
			
			//tool tip code
			$('.billboard-tip').each(function() {
		         $(this).qtip({
		            content: {
		                text: function(event, api) {
		                    $.ajax({
		                        url: "{{ URL::to('/') }}/billboards/tooltip/" + api.elements.target.attr('data-id') // Use href attribute as URL
		                    })
		                    .then(function(content) {
		                        // Set the tooltip content upon successful retrieval
		                        api.set('content.text', content);
		                    }, function(xhr, status, error) {
		                        // Upon failure... set the tooltip content to error
		                        api.set('content.text', status + ': ' + error);
		                    });
		        
		                    return 'Loading...'; // Set some initial text
		                }
		            },
		            position: {
		                viewport: $(window)
		            },
		            style: 'qtip-wiki'
		         });
		     });
			//tool tip code

			if ($('#map_canvas').length){
				initialize();

			}

			//Add billboard page

			$("input[name=sign_type]:radio").change(function () {
				if ( $(this).val() == 'digital'){
					$('#digital-info').css('display','block');
				} else {
					$('#digital-info').css('display','none');
				}
			});

			$('input[name=use-main-impressions]').change(function() {
		        if($(this).is(":checked")) {
		            $('#face-monthly-impressions').val($('#main-monthly-impressions').val());
		        } else {
		        	$('#face-monthly-impressions').val('');
		        }
		    });

		    $('input[name=use-main-cost]').change(function() {
		        if($(this).is(":checked")) {
		            $('#face-hard-cost').val($('#main-hard-cost').val());
		        } else {
		        	$('#face-hard-cost').val('');
		        }
		    });	

		    $('input[name=use-main-driveby]').change(function() {
		        if($(this).is(":checked")) {
		            $('#face-digital-driveby').val($('#main-digital-driveby').val());
		        } else {
		        	$('#face-digital-driveby').val('');
		        }
		    });			

		    

			$('#billboard_address').blur(function(){
			  	if ( $('#billboard_address').val() != '' ){
				  	var address = $('#billboard_address').val();
				  	geocoder.geocode( { 'address': address}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
							  globalMap.setCenter(results[0].geometry.location);
							  
							  var marker = new google.maps.Marker({
								  map: globalMap,
								  position: results[0].geometry.location
							  });

							  $('#lat').val(results[0].geometry.location.lat());
							  $('#long').val(results[0].geometry.location.lng());

							} else {
							  $('#geocode_message').innerHtml('Geocode was not successful for the following reason: ' + status);
							  $('#lat').val('');
							  $('#long').val('');
							}
					});
			    }
			});


			function capitalizeFirstLetter(string) {
			    return string.charAt(0).toUpperCase() + string.slice(1);
			}

			function addCommas(nStr) {
				nStr += '';
				x = nStr.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';
				var rgx = /(\d+)(\d{3})/;
				while (rgx.test(x1)) {
					x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}
				return x1 + x2;
			}


				function saveMapState() { 
				    var mapZoom = globalMap.getZoom(); 
				    var mapCentre = globalMap.getCenter(); 
				    var mapLat = mapCentre.lat(); 
				    var mapLng = mapCentre.lng(); 
				    var cookiestring=mapLat+"_"+mapLng+"_"+mapZoom; 
				    setCookie("myMapCookie",cookiestring, 30); 
				}

				function loadMapState() { 
				    var gotCookieString=getCookie("myMapCookie"); 
				    var splitStr = gotCookieString.split("_");
				    var savedMapLat = parseFloat(splitStr[0]);
				    var savedMapLng = parseFloat(splitStr[1]);
				    var savedMapZoom = parseFloat(splitStr[2]);
				    if ((!isNaN(savedMapLat)) && (!isNaN(savedMapLng)) && (!isNaN(savedMapZoom))) {
				        globalMap.setCenter(new google.maps.LatLng(savedMapLat,savedMapLng));
				        globalMap.setZoom(savedMapZoom);
				    }
				}

				function setCookie(c_name,value,exdays) {
				    var exdate=new Date();
				    exdate.setDate(exdate.getDate() + exdays);
				    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
				    document.cookie=c_name + "=" + c_value;
				}

				function getCookie(c_name) {
				    var i,x,y,ARRcookies=document.cookie.split(";");
				    for (i=0;i<ARRcookies.length;i++)
				    {
				      x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
				      y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
				      x=x.replace(/^\s+|\s+$/g,"");
				      if (x==c_name)
				        {
				        return unescape(y);
				        }
				      }
				    return "";
				}

				function initialize() {
					geocoder = new google.maps.Geocoder();
					
					var gotCookieString=getCookie("myMapCookie"); 
				    var splitStr = gotCookieString.split("_");
				    var savedMapLat = parseFloat(splitStr[0]);
				    var savedMapLng = parseFloat(splitStr[1]);
				    var savedMapZoom = parseFloat(splitStr[2]);

				    if ((!isNaN(savedMapLat)) && (!isNaN(savedMapLng)) && (!isNaN(savedMapZoom))) {

				        var latlng = new google.maps.LatLng(savedMapLat, savedMapLng);

				        if($('#billboard_address').length!=0){
							var myOptions = {
							  zoom: savedMapZoom,
							  zoomControl:true,
							  mapTypeControl:false,
							  center: latlng,
							  mapTypeId: google.maps.MapTypeId.SATELLITE  
							};
						} else {
							var myOptions = {
							  zoom: savedMapZoom,
							  zoomControl:true,
							  mapTypeControl:false,
							  center: latlng,
							  mapTypeId: google.maps.MapTypeId.ROADMAP
							};	
						}
				    } else {
				    	var latlng = new google.maps.LatLng(40.7607793, -111.89104739999999);

				    	if($('#billboard_address').length!=0){
							var myOptions = {
							  zoom: 6,
							  zoomControl:true,
							  mapTypeControl:false,
							  center: latlng,
							  mapTypeId: google.maps.MapTypeId.SATELLITE  
							};
						} else {
							var myOptions = {
							  zoom: 6,
							  zoomControl:true,
							  mapTypeControl:false,
							  center: latlng,
							  mapTypeId: google.maps.MapTypeId.ROADMAP
							};	
						}
				    }

					
					

					var map = new google.maps.Map(document.getElementById("map_canvas"),
						myOptions);
					
					globalMap = map;

					google.maps.event.addListener(map, 'zoom_changed', saveMapState);

					$.getJSON( "{{ URL::to('/') }}/billboards/json", function( data ) {
						var items = [];
						$.each( data, function( key, val ) {
						    var point = new google.maps.LatLng(val.billboard.lat,val.billboard.lng);
							var marker = null;

							window.contentString = '<div id="content" style="width:550px;">'+
								'<ul id="billboard+'+val.billboard.id+'" class="nav nav-tabs" role="tablist">';
								
								if ( val.faces != null){
									if ( val.faces.length){
										var activeHeader = 1;
										$.each( val.faces, function( facekey, faceval ) {
											window.contentString = window.contentString + '  <li';									
											if (activeHeader){
												window.contentString = window.contentString + ' class="active"';
											} 
											activeHeader = 0;
											window.contentString = window.contentString + '  ><a href="#'+faceval.id+faceval.label+'" role="tab" data-toggle="tab">'+faceval.label+'</a></li>';									
										});	
									} else {
										window.contentString = window.contentString + '  <li class="active"><a href="#'+val.billboard.id+'main" role="tab" data-toggle="tab">Main Billboard</a></li>';	
									}
								}

								window.contentString = window.contentString + '</ul>'+

								// $.getJSON( "{{ URL::to('/') }}/billboard-faces/json/"+val.id, function( data ) {
								// 	window.contentString = data;
								// 	$.each( data, function( key, val ) {
								// 		window.contentString = window.contentString + '  <li><a href="#'+val.id+val.label+'" role="tab" data-toggle="tab">'+val.label+'</a></li>';
								// 	});
								// });
							  
							  '<div class="tab-content">';

						      if ( val.faces != null){
						      		if ( val.faces.length){
						      			
						      			var activeCounter = 1;

										$.each( val.faces, function( facekey, faceval ) {

											window.contentString = window.contentString + '<div class="tab-pane';

											if (activeCounter){
												window.contentString = window.contentString + ' active';
											} 

											var videoIdStr = faceval.digital_driveby;
											var videoIdArr = videoIdStr.split('/');
											var videoId = videoIdArr[videoIdArr.length-1];

											activeCounter = 0;
											
											window.contentString = window.contentString + '" id="'+faceval.id+faceval.label+'" >'+
										      '<div id="siteNotice">'+
										      '</div>'+
										      '<div class="firstHeading">'+val.billboard.name+'</div>'+
										      '<div class="bodyContent">'+
										      
										      '<div class="row">'+
										      '<div class="col-md-4">'+
										      '<a class="billboard_face_image" ';

										      if (faceval.photo != ''){
										      	window.contentString = window.contentString + 'href="{{ URL::to('/images/billboard/') }}/'+ faceval.photo +'"';
										  	  } else {
										  	  	window.contentString = window.contentString + 'href="{{ URL::to('/images/') }}/no-preview.jpg"';
										  	  }

										      window.contentString = window.contentString + ' >'+

										      '<img id="bi_face'+ faceval.id +'" class="billboard_images" ';

										      if (faceval.photo != ''){
										      	window.contentString = window.contentString + 'src="{{ URL::to('/images/billboard/') }}/'+ faceval.photo +'"';
										  	  } else {
										  	  	window.contentString = window.contentString + 'src="{{ URL::to('/images/') }}/no-preview.jpg"';
										  	  }

										      window.contentString = window.contentString + ' width="100%" />'+
										      //'<a class="ddb-link" href="#" data-id="'+ videoId +'" data-toggle="modal" data-target="#digitalDriveby" ><i class="fa fa-youtube-play"></i> Watch Digital Driveby</a>'+
										      
										      '</a><br><p class="center">Click to enlarge</p>'+
										      '</div>'+
										      '<div class="col-md-8">'+
										      '<table class="table infoTable"><tbody>'+
										      '<tr><td>Address</td><td>'+val.billboard.address+'</td></tr>'+
										      '<tr><td>Location</td><td>'+val.billboard.lat+','+val.billboard.lng+'</td></tr>';

										      if (faceval.sign_type){
										      	window.contentString = window.contentString + '<tr><td>Type</td><td>Digital</td></tr>';
											  } else {
											  	window.contentString = window.contentString + '<tr><td>Type</td><td>Static</td></tr>';
											  }
											  
										      window.contentString = window.contentString +'<tr><td>Reads</td><td>'+capitalizeFirstLetter(faceval.reads)+'</td></tr>'+
										      '<tr><td>Dimension</td><td>'+faceval.height+' x '+faceval.width+'</td></tr>'+
										      '<tr><td>DEC</td><td>'+addCommas(val.billboard.monthly_impressions)+'</td></tr>'+
										      '<tr><td>Rate Card</td><td>$'+addCommas(faceval.hard_cost)+'</td></tr>'+
										      
										      '</tbody></table>'+
										      //'<a href="#" data-id="'+ faceval.id +'" data-bid="'+faceval.billboard_id+'" data-toggle="modal" data-target="#instantBook" class="btn btn-success">Instant Book/Hold</a> '+
										      //'<a href="#" data-id="'+ faceval.id +'" data-toggle="modal" data-target="#billboardBooking" class="btn btn-success"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i> Billboard Availability</a> '+
										      '<a href="#" data-id="'+ faceval.id +'" data-bid="'+val.billboard.id+'" data-label="'+ faceval.label +' - '+ faceval.unique_id +'" data-toggle="modal" data-target="#proposalBillboard" title="Add Billboard Face to Active Proposal" class="btn btn-primary pull-right">Add to Proposal</a> '+
										      //'<a href="{{ URL::to('/') }}/active-proposal/add-billboard/'+ val.billboard.id +'/'+ faceval.id +'" title="Add Billboard Face to Active Proposal" class="btn btn-primary"><i class="glyphicon fa fa-plus-square"></i></a> '+
										      '</div>'+
										      '</div>'+

										      '</div>'+

										      '</div>';
										});	
							  		} else {


									  window.contentString = window.contentString + '<div class="tab-pane active" id="'+val.billboard.id+'main" >'+
								      '<div id="siteNotice">'+
								      '</div>'+
								      '<div class="firstHeading">'+val.billboard.name+' <a href="{{ URL::to('/billboards/') }}/'+ val.billboard.id +'">Edit</a> <a>Delete</a></div>'+
								      '<div class="bodyContent">'+
								      
								      '<div class="row">'+
								      '<div class="col-md-4">'+
								      
								      '<img id="bi_'+ val.billboard.id +'" class="billboard_images" src="{{ URL::to('/images/') }}/no-preview.jpg" width="100%" />'+
								      '<a class="ddb-link" href="#" data-toggle="modal" data-target="#digitalDriveby" ><i class="fa fa-youtube-play"></i> Watch Digital Driveby</a>'+
								      //'<a href="{{ URL::to('/') }}/active-proposal/add-billboard/'+ val.billboard.id +'" class="btn btn-primary center-block">Add to Proposal</a> '+
								      '</div>'+
								      '<div class="col-md-8">'+
								      '<table class="table infoTable"><tbody>'+
								      '<tr><td>Address</td><td>'+val.billboard.address+'</td></tr>'+
								      '<tr><td>Monthly Price</td><td>'+val.billboard.hard_cost+'</td></tr>'+
								      '<tr><td>Monthly Impressions</td><td>'+val.billboard.monthly_impressions+'</td></tr>'+
								      '</tbody></table>'+
								      '<a href="{{ URL::to('/billboards/') }}/'+ val.billboard.id +'" class="btn btn-default">Add Billboard Face</a> '+
								      '</div>'+
								      '</div>'+

								      '</div>'+

								      '</div>';

							  		}
							  	}

						   //     $.getJSON( "{{ URL::to('/') }}/billboard-faces/json/"+val.id, function( faces_data ) {
									// $.each( faces_data, function( faces_key, faces_val ) {
									// 	window.contentString = window.contentString +'  <div class="tab-pane" id="'+faces_val.id+faces_val.label+'">...</div>';
									// });
							  //  });

								window.contentString = window.contentString +'</div>'+


						      '</div>';

							var infowindow = new google.maps.InfoWindow({
							    content: window.contentString,
							    maxWidth: 600
							});

							infoWindows.push(infowindow);

							var marker = new google.maps.Marker({
							  position: point,
							  map: globalMap,
							  icon: 'https://www.signly.com/app/images/digital-board.png'
							});

							marker.id = val.billboard.id;

							markersArray.push(marker);

							google.maps.event.addListener(marker, 'click', function() {
							    //map.setZoom(8);

							    map.setCenter(marker.getPosition());
							    for (var i=0;i<infoWindows.length;i++) {
									infoWindows[i].close();
								}
							    infowindow.open(map,marker);

							    $('.billboard_face_image').magnificPopup({
						          type: 'image',
						          closeOnContentClick: true,
						          mainClass: 'mfp-img-mobile',
						          image: {
						            verticalFit: true
						          }
						          
						        }).on('mfpBeforeOpen', function() {
								   $.sidr('close', 'sidr-existing-content');
								}).on('mfpClose', function() {
								   $.sidr('open', 'sidr-existing-content');
								});    

							});

							google.maps.event.addListener(globalMap, 'click', function(e) {
							    var mapLng = e.latLng.lng();
							    var mapLat = e.latLng.lat()
							    if ($('#lat').length!=0){
							    	$('#lat').val(mapLat);
							    	$('#long').val(mapLng);

							    	var latlng = {lat: parseFloat(mapLat), lng: parseFloat(mapLng)};
									  geocoder.geocode({'location': latlng}, function(results, status) {
									    if (status === google.maps.GeocoderStatus.OK) {
									      if (results[1]) {
									       
									       $('#billboard_address').val(results[1].formatted_address);
									       

									      } else {
									        //window.alert('No results found');
									      }
									    } else {
									      //window.alert('Geocoder failed due to: ' + status);
									    }
									  });
							    }
							    
							});

					  });
					});

				  }

				  function codeAddress() {
					  var address = document.getElementById('searchText').value;
					  geocoder.geocode( { 'address': address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
						  globalMap.setCenter(results[0].geometry.location);
						  //alert(results[0].geometry.location);
						  var marker = new google.maps.Marker({
							  map: globalMap,
							  position: results[0].geometry.location
						  });
						} else {
						  alert('Geocode was not successful for the following reason: ' + status);
						}
					  });
					}

				$('#confirmDelete').on('show.bs.modal', function(e) {
				    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				});

				$('#dlgEditBillboardFace').on('show.bs.modal', function(e) {
				    var billboardFaceId = $(e.relatedTarget).data('id');
				    $("#dlgEditBillboardFace #billboard_face_id").val(billboardFaceId);

				    $.getJSON( "{{ URL::to('/') }}/billboard-face/json/" + billboardFaceId, function( data ) {
				    	$("#dlgEditBillboardFace").find("input[name=unique_id]").val(data.unique_id);
				    	$("#dlgEditBillboardFace").find("input[name=height]").val(data.height);
				    	$("#dlgEditBillboardFace").find("input[name=width]").val(data.width);

				    	$('.reads').each(function(){
						     if( $(this).val() == data.reads ) { 
						     	$(this).prop("checked", true)
						     }
						});

				    	var counter = 0;
				    	var blabel = data.label;
						$('.blabel').each(function(){
						     if( $(this).val() == blabel.toLowerCase() ) { 
						     	$(this).prop("checked", true)
						     	counter = 1;
						     }
						});

						if(counter == 0){
							$("#dlgEditBillboardFace .blabeltxt").val(data.label);
						}

						$('.sign_type').each(function(){
						     if( $(this).val() == 'static' && data.sign_type == 0) { 
						     	$(this).prop("checked", true)
						     }
						     if( $(this).val() == 'digital' && data.sign_type == 1) { 
						     	$(this).prop("checked", true)
						     }
						});

				    	$("#dlgEditBillboardFace").find("input[name=max_ads]").val(data.max_ads);
				    	$("#dlgEditBillboardFace").find("input[name=duration]").val(data.duration);
				    	$("#dlgEditBillboardFace").find("input[name=hard_cost]").val(data.hard_cost);
				    	$("#dlgEditBillboardFace").find("input[name=monthly_impressions]").val(data.monthly_impressions);
				    	$("#dlgEditBillboardFace").find("textarea[name=notes]").val(data.notes);
				    });


				});

				$('#confirmDelete').on('show.bs.modal', function(e) {
				    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				});

				$('#instantBook').on('show.bs.modal', function(e) {
				    var face_id = $(e.relatedTarget).data('id');
				    var billboard_id = $(e.relatedTarget).data('bid');
				    $(".modal-body #billboard_face_id").val(face_id);
				    $(".modal-body #billboard_id").val(billboard_id);
				});

				$('#billboardBooking').on('show.bs.modal', function(e) {
				   //  var dp = new DayPilot.Calendar("dp");
					  // dp.scale = "Day";
					  // dp.timeHeaders = [
					  //     { groupBy: "Month", format: "MMMM yyyy" },
					  //     { groupBy: "Day", format: "d" }
					  // ];
					  // dp.days = 30;
					  // dp.init();
				});

				$('#proposalBillboard').on('show.bs.modal', function(e) {
				    var face_id = $(e.relatedTarget).data('id');
				    var billboard_id = $(e.relatedTarget).data('bid');
				    var billboard_label = $(e.relatedTarget).data('label');
				    $(".modal-body #billboardtobeadded").html(billboard_label);
				    $(".modal-body #pb_face_id").val(face_id);
				    $(".modal-body #pb_billboard_id").val(billboard_id);
				});

				$('#save_proposal').click(function() {
			        $.post("{{ URL::to('/') }}/save-active-proposal-billboards", 
					      {
					          proposal_id: $('#proposal_id').val(),
					          proposal_billboards: $("[name^='proposal_billboards[']").serializeArray(),
			          		  _token: '{{ csrf_token() }}'

					      },
					      function(data) {
					         if (data == '1' || data == 1){
					         	alert('Proposal Successfully Saved!');
					         }
					      }
					  );
			        return false;
			    });	

			    $('#sidr-id-save_proposal').click(function() {
			        $.post("{{ URL::to('/') }}/save-active-proposal-billboards", 
					      {
					          proposal_id: $('#proposal_id').val(),
					          proposal_billboards: $("[name^='proposal_billboards[']").serializeArray(),
			          		  _token: '{{ csrf_token() }}'

					      },
					      function(data) {
					         if (data == '1' || data == 1){
					         	alert('Proposal Successfully Saved!');
					         }
					      }
					  );
			        return false;
			    });	

			    

				$('#send_proposal').click(function() {
				    $.post("{{ URL::to('/') }}/send-active-proposal", 
					      {
					          proposal_id: $('#proposal_id').val(),
			          		  _token: '{{ csrf_token() }}'

					      },
					      function(data) {
					         if (data == '1' || data == 1){
					         	alert('Proposal Successfully Sent!');
					         }
					      }
					  );
				    return false;
			    });	
			    				
			    $('#sidr-id-copy_link').addClass('btn');
			    $('#sidr-id-copy_link').addClass('btn-success');
			    $('#sidr-id-generate_pdf').addClass('btn');
			    $('#sidr-id-generate_pdf').addClass('btn-primary');
			    $('#sidr-id-save_proposal').addClass('btn');
			    $('#sidr-id-save_proposal').addClass('btn-primary');
			    $('.sidr-class-table').addClass('table');


				$('#sidr-id-copy_link').click( function() {

					$.ajax({
						 method: "POST",
				         url:"{{ URL::to('/') }}/copy-active-proposal",
				         data:{"proposal_id": $('#proposal_id').val(),"_token": '{{ csrf_token() }}'},
				         success: function(data) {
				                  if(data)
				                    $('#sidr-id-proposal_link').val("{{ URL::to('/')}}/clientview/" + data);
				                  },
				         async:   false
				    });      

				  copyToClipboard($('#sidr-id-proposal_link').val());
				});

				//var copyEmailBtn = document.querySelector('.copy_link');  
				// var copyEmailBtn = document.querySelector('#sidr-id-copy_link');
				

				// copyEmailBtn.addEventListener('click', function(event) {  

				// 	$.ajax({
				// 		 method: "POST",
				//          url:"{{ URL::to('/') }}/copy-active-proposal",
				//          data:{"proposal_id": $('#proposal_id').val(),"_token": '{{ csrf_token() }}'},
				//          success: function(data) {
				//                   if(data)
				//                     $('#proposal_link').val("{{ URL::to('/')}}/clientview/" + data);
				//                   },
				//          async:   false
				//     });      

				//   copyToClipboard($('#proposal_link').val());
				// });

				// $('#copy_link').click(function() {
				//     $.post("{{ URL::to('/') }}/copy-active-proposal", 
				// 	      {
				// 	          proposal_id: $('#proposal_id').val(),
			 //          		  _token: '{{ csrf_token() }}'

				// 	      },
				// 	      function(data) {
				// 	         if (data){
				// 	         	//var clip = new ZeroClipboard('{{ URL::to('/')}}/clientview/' + data);
				// 	         	copyToClipboard("{{ URL::to('/')}}/clientview/" + data);
				// 	         	alert("Link copied to the clipboard");
				// 	         }
				// 	      }
				// 	  );
				//     return false;
			 //    });	

				// $("body")
			 //      .on("copy", "#copy_link", function(/* ClipboardEvent */ e) {
			 //      	e.clipboardData.clearData();
			 //      	$.post("{{ URL::to('/') }}/copy-active-proposal", 
				// 	      {
				// 	          proposal_id: $('#proposal_id').val(),
			 //          		  _token: '{{ csrf_token() }}'

				// 	      },
				// 	      function(data) {
				// 	         if (data){
				// 	         	e.clipboardData.setData("text/plain", '{{ URL::to('/')}}/clientview/' + data);
				// 	         	//var clip = new ZeroClipboard('{{ URL::to('/')}}/clientview/' + data);
				// 	         	alert("{{ URL::to('/') }}/clientview/" + data);
				// 	         }
				// 	      }
				// 	  );
			 //        e.preventDefault();
			 //      });

				function copyToClipboardFF(text) {
				  window.prompt ("Copy to clipboard: Ctrl C, Enter", text);
				}
				
				function copyToClipboard(copyText) {
				  var success   = true,
				      range     = document.createRange(),
				      selection;

				  // For IE.
				  if (window.clipboardData) {
				    window.clipboardData.setData("Text", copyText);        
				  } else {
				    // Create a temporary element off screen.
				    var tmpElem = $('<div>');
				    tmpElem.css({
				      position: "absolute",
				      left:     "-1000px",
				      top:      "-1000px",
				    });
				    // Add the input value to the temp element.
				    tmpElem.text(copyText);
				    $("body").append(tmpElem);
				    // Select temp element.
				    range.selectNodeContents(tmpElem.get(0));
				    selection = window.getSelection();
				    selection.removeAllRanges();
				    selection.addRange(range);
				    // Lets copy.
				    try { 
				      success = document.execCommand("copy", false, null);
				    }
				    catch (e) {
				      copyToClipboardFF(copyText);
				    }
				    if (success) {
				      alert("The text is on the clipboard, try to paste it!");
				      // remove temp element.
				      tmpElem.remove();
				    }
				  }
				}


			    $('#sidr-id-generate_pdf').click(function() {
			    	
			    	$.post("{{ URL::to('/') }}/save-active-proposal-billboards", 
					      {
					          proposal_id: $('#proposal_id').val(),
					          proposal_billboards: $("[name^='proposal_billboards[']").serializeArray(),
			          		  _token: '{{ csrf_token() }}'

					      },
					      function(data) {
					         if (data == '1' || data == 1){
					         	//alert('Proposal Successfully Saved!');
					         }
					      }
					  );
			        
			    	manualPost("{{ URL::to('/') }}/generate-pdf-proposal",{proposal_id: $('#proposal_id').val(), _token: '{{ csrf_token() }}'});
				   	  //  $.post("{{ URL::to('/') }}/generate-pdf-proposal", 
					  //     {
					  //         proposal_id: $('#proposal_id').val(),
			    	  //       	 _token: '{{ csrf_token() }}'
					  //     },
					  //     function(data) {
					  //         window.open(data);
					  //     }
					  // );
				    return false;
			    });	

			    $('#print_proposal').click(function() {
			    	manualPost("{{ URL::to('/') }}/generate-print-proposal",{proposal_id: $('#proposal_id').val(), _token: '{{ csrf_token() }}'});
				   	
				    return false;
			    });	


				$('#close_proposal').click(function() {
				    $('#proposal_window').slideUp();
				    return false;
			    });	

			    $('a[data-confirm]').click(function(ev) {
					var href = $(this).attr('href');
					if (!$('#dataConfirmModal').length) {
						$('body').append('<div id="dataConfirmModal" tabindex="-1"  class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title" id="myModalLabel">Confirm Action</h4><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div></div></div>');
					} 
					$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
					$('#dataConfirmOK').attr('href', href);
					$('#dataConfirmModal').modal({show:true});
					return false;
				});

			    $('#generate_address').click(function(){
			    	if ($('#lat').length!=0 && $('#lat').val()!='' && $('#long').val()!=''){
				    	var mapLat = $('#lat').val();
				    	var mapLng = $('#long').val();

				    	var latlng = {lat: parseFloat(mapLat), lng: parseFloat(mapLng)};
						  geocoder.geocode({'location': latlng}, function(results, status) {
						    if (status === google.maps.GeocoderStatus.OK) {
						      if (results[1]) {
						       
						       $('#billboard_address').val(results[1].formatted_address);
						       globalMap.setCenter(new google.maps.LatLng(mapLat, mapLng));

						      } else {
						        //window.alert('No results found');
						      }
						    } else {
						      //window.alert('Geocoder failed due to: ' + status);
						    }
						  });
				    }
				    return false;
			    });

			    $('#havelatlong').change(function() {
				    if($("#havelatlong").is(':checked')){
				    	$('#billboard_address').attr('readonly','readonly');
				    	$('#lat').removeAttr('readonly','');
				    	$('#long').removeAttr('readonly','');

				    	$('#billboard_address').val('');
				    	$('#lat').val('');
				    	$('#long').val('');
				    } else {
				    	$('#billboard_address').removeAttr('readonly','');
				    	$('#lat').attr('readonly','readonly');
				    	$('#long').attr('readonly','readonly');

				    	$('#billboard_address').val('');
				    	$('#lat').val('');
				    	$('#long').val('');
				    }
				    return false;
			    });

			    $(".filter_check").change(function() {
			    	if(this.name != 'show_all' ){
			    		$("input[name=show_all]").prop('checked', false);
			    	} 

			    	if(this.name == 'show_all' ){
			    		$("input[name=left_read]").prop('checked', false);
			    		$("input[name=right_read]").prop('checked', false);
			    		$("input[name=north_facing]").prop('checked', false);
			    		$("input[name=south_facing]").prop('checked', false);
			    		$("input[name=east_facing]").prop('checked', false);
			    		$("input[name=west_facing]").prop('checked', false);
			    		$("input[name=digital]").prop('checked', false);
			    		$("input[name=static]").prop('checked', false);
			    	}
			    	var str = $( "#dashboard_filter" ).serialize();
			    	window.location.href = '{{ URL::to("/dashboard") }}?'+str;
				});

			    $('.sidr-class-billboard_link').click(function(ev) {
						globalMap.setCenter(new google.maps.LatLng($(this).attr('billboardLat'), $(this).attr('billboardLng')));
						    var billboard_id = $(this).attr('billboardid');
						    var billboard_face_id = $(this).attr('billboardfaceid');
						   	
						   	var closest = 0;

						    for( i=0;i<markersArray.length; i++ ) {  
						        
						        if ( markersArray[i].id == billboard_id ) {
						            closest = i;
						        }
						    }

							google.maps.event.trigger(markersArray[closest], 'click');

							globalMap.panBy(150, -250);

							$('a[href="#' + billboard_face_id + '"]').tab('show');
					    	return false;
				});
			   					
			    $( "#searchBillboard" ).autocomplete({
			      
			      source: function( request, response ) {

			        $.ajax({
			          type: "POST",
			          url: "{{ URL::to('/') }}/billboards/search",
			          data: {
			            q: request.term,
			            _token: '{{ csrf_token() }}'
			          },
			          success: function( data ) {
			            response( data );
			          }
			        });
			       
			      },
			      select: function( event, ui ){

			      // 	for (i = 0; i < availableTags.length; i++) { 
					    // if(availableTags[i]['id'] == ui.item.id){
					    	globalMap.setCenter(new google.maps.LatLng(ui.item.lat, ui.item.lng));
					    	
					    	var pi = Math.PI;
						    var R = 6371; //equatorial radius
						    var distances = [];
						    var closest = -1;
						    var lat1 = ui.item.lat;
						    var lon1 = ui.item.lng;

						    for( i=0;i<markersArray.length; i++ ) {  
						        var lat2 = markersArray[i].position.lat();
						        var lon2 = markersArray[i].position.lng();

						        var chLat = lat2-lat1;
						        var chLon = lon2-lon1;

						        var dLat = chLat*(pi/180);
						        var dLon = chLon*(pi/180);

						        var rLat1 = lat1*(pi/180);
						        var rLat2 = lat2*(pi/180);

						        var a = Math.sin(dLat/2) * Math.sin(dLat/2) + 
						                    Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(rLat1) * Math.cos(rLat2); 
						        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
						        var d = R * c;

						        distances[i] = d;
						        if ( closest == -1 || d < distances[closest] ) {
						            closest = i;
						        }
						    }

							google.maps.event.trigger(markersArray[closest], 'click');

					    	return false;
					//     }
					// }

			      	
			      }
			    });

				
				//AJAX messages

				$('#sidr-id-frm_comments').submit(function(e) {
					e.preventDefault();

			        $.post("{{ URL::to('/') }}/post-proposal-billboard-comment", 
					      {
					          proposal_id: $('#sidr-id-c_proposal_id').val(),
					          user_id: $('#sidr-id-c_user_id').val(),
					          client_id: $('#sidr-id-c_client_id').val(),
					          proposalComment: $('#sidr-id-adminTextArea').val(),
			          		  _token: '{{ csrf_token() }}'

					      },
					      function(data) {
					         if (data != ''){
					         	$('#sidr-id-proposalComments').html(data);
					         	$('#sidr-id-adminTextArea').val('');
					         	var divScroll = $('#sidr-id-proposalComments');
    							divScroll.animate({"scrollTop": $('#sidr-id-proposalComments')[0].scrollHeight}, "slow");
					         }
					      }
					  );
			        return false;
			    });	
			    
				$('#sidr-id-adminTextArea').keypress(function(e){
                    if( e.which === 13){
                      $('#sidr-id-frm_comments').submit();
                      //$('#sidr-id-submitAdminMessage').trigger('click');
                    }
                });
                $('#sidr-id-adminTextArea').click(function(){
                   $('.sidr-class-proposal-container').addClass("chat-box");
                });

                var divScroll = $('#sidr-id-proposalComments');
    			divScroll.animate({"scrollTop": $('#sidr-id-proposalComments')[0].scrollHeight}, "slow");

    			
			   
			  								
		});
		
		$(document).click(function(e){
            if(e.target.className !== "sidr-class-form-control")
            {
                $('.sidr-class-proposal-container').removeClass("chat-box");
                console.log(e);
            }
        });
				
		 //$(function() {
		 // $(".billboard_images").draggable({
		 //        revert: "invalid",
		 //        cursor: "move"
		 //    });
		 //    $( "#proposal-drop" ).droppable({
		 //    	accept: ".billboard_images",
		 //  	tolerance: 'intersect',
		 //      drop: function( event, ui ) {
		 //        $( this )
		 //          .find( "p" )
		 //            .html( "Dropped!" );
		 //     }
		 // });
		 //});



		</script>

	<script type="text/javascript">
		    $(function(){
		    	
		        // $('.slide-out-div').tabSlideOut({
		        //     tabHandle: '.handle',                     //class of the element that will become your tab
		        //     pathToTabImage: 'app/images/proposal-tab.png', //path to the image for the tab //Optionally can be set using css
		        //     imageHeight: '100px',                     //height of tab image           //Optionally can be set using css
		        //     imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
		        //     tabLocation: 'right',                      //side of screen where tab lives, top, right, bottom, or left
		        //     speed: 300,                               //speed of animation
		        //     action: 'click',                          //options: 'click' or 'hover', action to trigger animation
		        //     topPos: '200px',                          //position from the top/ use if tabLocation is left or right
		        //     leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
		        //     fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
		        // });

				
		    });


	    </script>

	    

</body>
</html>
