@extends('app')

@section('content')

<div class="container-fluid outer">
	<div class="inner">
		
 		<table class="table table-striped table-bordered table-hover table-condensed" id="tblBillboardlist">
	 			<thead>
	 				<th class="fixed-column-id" style="border: 1px solid #dddddd;">ID</th>
	 				<th class="fixed-column-name" style="border: 1px solid #dddddd;">Name</th>
	 				
	 				<?php
	 					$current_month = 0;
		 				$d1 = strtotime(str_replace('-','/',Session('start_date')));
						$d2 = strtotime(str_replace('-','/',Session('end_date')));
						$min_date = min($d1, $d2);
						$max_date = max($d1, $d2);
						$i = 0;
						$has_booking = 0;
						$months = array();

						echo '<th colspan="2" class="month-col">'.date('M',$min_date).'</th>'; 
						$months[] = date('n',$min_date);
						while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
						    echo '<th colspan="2" class="month-col">'.date('M',$min_date).'</th>';
						   	$months[] = date('n',$min_date);
						}
					
	 				?>
	 			</thead>
	 			<tbody>
	 				<?php
	 							$d1 = strtotime(Session('start_date'));
								$d2 = strtotime(Session('end_date'));
								$min_date = min($d1, $d2);
								$max_date = max($d1, $d2);
								$i = 0;
								$current_month = date("m", $d1);
	 				?>
	 				@foreach($billboards as $billboard)
	 					<tr>
	 						<td class="fixed-column-id">{{ $billboard->id }}</td>
	 						<td class="fixed-column-name">{{ $billboard->name }}</td>
	 						
	 						<?php

	 							foreach ($months as $month) {
	 								$billboard_found = 0;
		 							foreach ($billboard_bookings as $billboard_booking ) {
										if($billboard_booking->billboard_id == $billboard->id && 
											$month == date("n",strtotime($billboard_booking->book_start_date))){
											$billboard_found = 1;
											echo '<td><a class="billboard-tip" href="#" data-id="'.$billboard_booking->billboard_id.'">'.$billboard_booking->first_name.'</a></td>';
											echo '<td><a>'.$billboard_booking->set_price.'</td>';
										}
									}
									if ($billboard_found == 0 ){
										echo '<td>N/A</td><td>0</td>';
									}
	 							}
		 						

								// if (date("m",$d1) == date("m",$d2)){
									
								// 	foreach ($billboard_bookings as $billboard_booking ) {
								// 		if($current_month == date("m",strtotime($billboard_booking->book_start_date))){
								// 			echo '<td>'.$billboard_booking->first_name.'</td>';
								// 			echo '<td>'.$billboard_booking->set_price.'</td>';
								// 		}
								// 	}

								// } elseif(date("m",$d1) < date("m",$d2)) {

								// 	foreach ($billboard_bookings as $billboard_booking ) {
								// 		if($current_month == date("m",strtotime($billboard_booking->book_start_date))){
								// 			echo '<td>'.$billboard_booking->first_name.'</td>';
								// 			echo '<td>'.$billboard_booking->set_price.'</td>';
								// 		}
								// 	}

								// 	//$min_date = strtotime("+1 MONTH", $min_date);
								// 	//echo date('m',strtotime("+1 MONTH", $min_date)) .'<='. date('m',$d2) ;
								// 	while ( date('m',strtotime("+1 MONTH", $min_date)) <= (int)date('m',$d2) ) {
								// 		echo 'while';
								// 		foreach ($billboard_bookings as $billboard_booking ) {

								// 			if($current_month == date("m",strtotime($billboard_booking->book_start_date))){
								// 				echo '<td>'.$billboard_booking->first_name.'</td>';
								// 				echo '<td>'.$billboard_booking->set_price.'</td>';
								// 			}
								// 		}
								// 		$min_date = strtotime("+1 MONTH", $min_date);
								// 		$current_month = strtotime("m", $min_date);
									    
								// 	}
								// }
			 				?>
	 					</tr>
	 				@endforeach
	 			</tbody>
	 		</table>
	</div>
	
    
</div>

@endsection
