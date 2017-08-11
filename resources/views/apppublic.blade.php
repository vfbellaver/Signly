<!DOCTYPE html>
<html lang="en">
<head>
	<base href="https://www.signly.com/app">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Signly</title>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="{{ URL::to('/') }}/css/app.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/daterangepicker-bs3.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/jquery.qtip.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<link href="{{ URL::to('/') }}/css/magnific-popup.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.sidr.right {
		    left: auto;
		    right: -260px;
		}
		.sidr {
		    display: block;
		    position: fixed;
		    top: 0;
		    height: 100%;
		    z-index: 999999;
		    width: 400px;
		    overflow-x: hidden;
		    overflow-y: auto;
		    font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
		    font-size: 15px;
		    color: #fff;
		    box-shadow: 0 0 5px 5px #222 inset;
		}
	</style>
	<link rel="stylesheet" href="{{ URL::to('/') }}/css/jquery.light.min.css">
</head>
<body>

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
					
				</ul>
				<form class="navbar-form navbar-right" style="margin-right:400px;">
					<div class="form-group">
						<button type="button" id="active-proposal" class="btn btn-default">Show/Hide Proposal</button>
						
					</div>
				</form>
				<!-- <div class="pull-right">
					<div id="daterange" class="btn">
	                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
	                  <span></span> <b class="caret"></b>
	               	</div>

					<ul class="nav navbar-nav navbar-right">
						
					</ul>	
				</div> -->
				

			</div>
		</div>
	</nav>



	@yield('content')



	<!-- Scripts -->
	<!---<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
	<!---<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
	<script src="{{ URL::to('/') }}/js/jquery-1.9.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ URL::to('/') }}/js/moment.min.js"></script>
	<script src="{{ URL::to('/') }}/js/daterangepicker.js"></script>
	<script src="{{ URL::to('/') }}/js/jquery.tabSlideOut.v1.3.js"></script>
	<script src="{{ URL::to('/') }}/js/jquery.qtip.min.js"></script>
	<script src="{{ URL::to('/') }}/js/daypilot/daypilot-all.min.js"></script>

	<script src="{{ URL::to('/') }}/js/jquery.magnific-popup.min.js"></script>

	<script src="https://cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>

	<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&#038;ver=3.0&key=AIzaSyBUaQHyneq6J_6N8BW5MT50BM9riXkI5oM'>
		<!--<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false&#038;ver=3.0'>-->
	</script>

	<script type="text/javascript">

		function getNewMessages(){
			var id = $('#proposal_id').val();
		    
		    if(id != ''){
		    	ajaxurl = "{{URL::to('/')}}/get-comments-client/" + id;
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

			if($('#billboardList').length != 0){


			window.picker = new DayPilot.DatePicker({
                            target: 'start', 
                            pattern: 'M/d/yyyy', 
                            date: new DayPilot.Date().firstDayOfMonth(),
                            onTimeRangeSelected: function(args) { 
                                //dp.startDate = args.start;
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
				
			  currentYearDate = new Date(new Date().getFullYear(), 0, 1);
			  window.dp.startDate = currentYearDate;
			  window.dp.days = 365; //window.dp.startDate.daysInMonth();
			  window.dp.timeHeaders = [
                        { groupBy: "Month", format: "MMMM yyyy" },
                        { groupBy: "Day", format: "d" }
                    ];

              window.dp.eventHeight = 50;
              window.dp.bubble = new DayPilot.Bubble({});
              window.dp.cellDuration = 1440;
              window.dp.cellGroupBy = 'Month';
              window.dp.treeEnabled = true;
              //window.dp.theme = 'scheduler_8';
                    
              window.dp.rowHeaderColumns = [
              	{title: "Billboard", width: 180},
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
                    window.dp.scale = "Manual";
                    window.dp.timeline = [];
                    var start = date.getDatePart().addHours(12);
                    
                    for (var i = 0; i < window.dp.days; i++) {
                        window.dp.timeline.push({start: start.addDays(i), end: start.addDays(i+1)});
                    }
                    window.dp.update();
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

		    $.sidr('open', 'sidr-existing-content');

			$("#filter").change(function() {
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


			initialize();

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

				function initialize() {
					geocoder = new google.maps.Geocoder();
					var latlng = new google.maps.LatLng(40.7607793, -111.89104739999999);
					var myOptions = {
					  zoom: 6,
					  zoomControl:true,
					  mapTypeControl:false,
					  center: latlng,
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map(document.getElementById("map_canvas"),
						myOptions);
					
					globalMap=map;

					$.getJSON( "{{ URL::to('/') }}/clientview/jsonhash/{{$hash}}", function( data ) {
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
										      //'<tr><td>Name</td><td>'+val.billboard.name+'</td></tr>'+
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
										      '<tr><td>Montly Price</td><td>$'+addCommas(faceval.proposal_price)+'</td></tr>'+
										      
										      '</tbody></table>'+
										      //'<a href="#" data-id="'+ faceval.id +'" data-toggle="modal" data-target="#billboardBooking" class="btn btn-success"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i> Billboard Availability</a> '+
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
								      
								      '</div>'+
								      '<div class="col-md-8">'+
								      '<table class="table infoTable"><tbody>'+
								      '<tr><td>Address</td><td>'+val.billboard.address+'</td></tr>'+
								      '<tr><td>Rate Card</td><td>'+val.billboard.hard_cost+'</td></tr>'+
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

				$('#digitalDriveby').on('show.bs.modal', function(e) {
				    var myVideoId = $(e.relatedTarget).data('id');
				    $(".modal-body #videoFrame").attr('src', 'https://www.youtube.com/embed/' + myVideoId );
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

			    $('#generate_pdf').click(function() {
			    	manualPost("{{ URL::to('/') }}/clientview/generate-pdf-proposal",{proposal_id: $('#proposal_id').val(), _token: '{{ csrf_token() }}'});
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

			    $('.sidr-class-btn-primary').addClass('btn');
			    $('.sidr-class-btn-primary').addClass('btn-primary');

			    $('.sidr-class-table').addClass('table');

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

				$('.sidr-class-billboard_link').click(function(ev) {
						globalMap.setCenter(new google.maps.LatLng( $(this).attr('billboardLat'), $(this).attr('billboardLng') ) );
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

			        $.post("{{ URL::to('/') }}/post-proposal-billboard-comment-client", 
					      {
					          proposal_id: $('#sidr-id-c_proposal_id').val(),
					          user_id: $('#sidr-id-c_user_id').val(),
					          client_id: $('#sidr-id-c_client_id').val(),
					          proposalComment: $('#sidr-id-clientTextArea').val(),
			          		  _token: '{{ csrf_token() }}'

					      },
					      function(data) {
					         if (data != ''){
					         	$('#sidr-id-proposalComments').html(data);
					         	$('#sidr-id-clientTextArea').val('');
					         	var divScroll = $('#sidr-id-proposalComments');
    							divScroll.animate({"scrollTop": $('#sidr-id-proposalComments')[0].scrollHeight}, "slow");
					         }
					      }
					  );
			        return false;
			    });	
			    
				$('#sidr-id-clientTextArea').keypress(function(e){
                    if( e.which === 13){
                      $('#sidr-id-frm_comments').submit();
                      //$('#sidr-id-submitAdminMessage').trigger('click');
                    }
                });

                $('#sidr-id-clientTextArea').click(function(){
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
