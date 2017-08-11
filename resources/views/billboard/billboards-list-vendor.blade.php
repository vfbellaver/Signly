@extends('app')

@section('content')

<div class="container-fluid outer">
	Start date: <span id="start"></span> <a href="#" onclick="window.picker.show(); return false;"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></a>
	Time range: 
    <select id="timerange">
        <option value="week">Week</option>
        <option value="2weeks">2 Weeks</option>
        <option value="month" selected>Month</option>
        <option value="2months">2 Months</option>
    </select>
	<div>
 		<div id="billboardListvendor"></div>
	</div>
	
    
</div>

@endsection
