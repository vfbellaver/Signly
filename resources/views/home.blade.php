@extends('app')

@section('content')
<div id="panel">
	<!-- <input type="textbox" name="searchTeid" id="searchText" placeholder="Address"> -->
	<input type="textbox" name="searchBillboard" id="searchBillboard" class="form-control" placeholder="Search">
	<!-- <input type="button" value="Search" onclick="codeAddress()"> -->

  <ul class="searchfilter">
  <form id="dashboard_filter" name="dashboard_filter">
    <li><input type="checkbox" class="filter_check" name="show_all" value="1" <?php if(Session::get('show_all') == '1')  {echo 'checked="checked"';} ?> > Show All</li>
    <li><input type="checkbox" class="filter_check" name="left_read" value="1" <?php if(Session::get('left_read') == '1')  {echo 'checked="checked"';} ?> > Left Read</li>
    <li><input type="checkbox" class="filter_check" name="right_read" value="1" <?php if(Session::get('right_read') == '1')  {echo 'checked="checked"';} ?> > Right Read</li>
    <li><input type="checkbox" class="filter_check" name="north_facing" value="1" <?php if(Session::get('north_facing') == '1')  {echo 'checked="checked"';} ?> > North Facing</li>
    <li><input type="checkbox" class="filter_check" name="south_facing" value="1" <?php if(Session::get('south_facing') == '1')  {echo 'checked="checked"';} ?> > South Facing</li>
    <li><input type="checkbox" class="filter_check" name="east_facing" value="1" <?php if(Session::get('east_facing') == '1')  {echo 'checked="checked"';} ?> > East Facing</li>
    <li><input type="checkbox" class="filter_check" name="west_facing" value="1" <?php if(Session::get('west_facing') == '1')  {echo 'checked="checked"';} ?> > West Facing</li>
    <li><input type="checkbox" class="filter_check" name="digital" value="1" <?php if(Session::get('digital') == '1')  {echo 'checked="checked"';} ?> > Digital Board</li>
    <li><input type="checkbox" class="filter_check" name="static" value="1" <?php if(Session::get('static') == '1')  {echo 'checked="checked"';} ?> > Static Board</li>
  </form>
  </ul>
  
  

</div>

<div id="create-proposal">
	<input type="button" value="Create Proposal" data-toggle="modal" data-target="#createProposal">
</div>

<!-- <idv id="key-legend">
	<input type="button" value="Keys" data-toggle="modal" data-target="#keyLegend">
</div> -->


<div style="height:100%; width:100%;">
<div class="parent-container">
  
<div id="active-proposal-window" style="display:none;">
   
  <div class="proposal-container" style="padding-left:0px !important;">
    <!-- Proposal Window -->
      <div id="proposal_window">
        
        <div class="proposal-top">
          <ul class="proposal-menu">
            <!-- <li class="proposal-save"ida id="save_proposal" title="Save Proposal" style="cursor:pointer;"><img src="{{URL::to('/')}}/images/save.png"></a></li> -->
            <!-- <li class="proposal-pdf"ida id="generate_pdf" title="Generate PDF" style="cursor:pointer;"><img src="{{URL::to('/')}}/images/pdf.png"></a></li> -->
            <!-- <li class="proposal-send"ida id="send_proposal" title="Send Proposal to Client" style="cursor:pointer;"><img src="{{URL::to('/')}}/images/emailicon.png"></a></li> -->
            <!-- <li class="proposal-print"ida id="print_proposal" title="Print Preview of proposal" style="cursor:pointer;"><img src="{{URL::to('/')}}/images/printer-icon.jpg"></a></li> -->
            <!-- <li class="proposal-minimize"><a href="#" title="Minimize Window"><img src="{{URL::to('/')}}/images/proposal-minimize.png"></a></li>
            <li class="proposal-maximize"><a href="#" title="Maximize Window"><img src="{{URL::to('/')}}/images/proposal-maximize.png"></a></li> 
            <li class="proposal-close"><a id="close_proposal" href="#">Close</a></li>-->
          </ul>

          <?php 
            $days_between = 0;
            $months_between = 0; 
          ?>
          @if(isset($active_proposal))

            <?php

              $total_budget = 0;
              $date1 = new DateTime($active_proposal->start_date);
              $date2 = new DateTime($active_proposal->end_date);

              $diff =  $date1->diff($date2);
              $months_between = round($diff->y * 12 + $diff->m + $diff->d / 30);
              $days_between = (int)$date2->diff($date1)->format("%a") + 2;

              if ($months_between < 1){
                $months_between = 1;
              }

              if ($days_between < 1){
                $days_between = 1;
              }
            ?>
            <strong>{{ $active_proposal->name }}</strong>
            <input type="hidden" id="proposal_id" name="proposal_id" value="{{ $active_proposal->id }}">
          @else
            <?php
              $total_budget = 0;
            ?>
            <strong>No Active Proposal</strong>
          @endif
          <br/>
          @if(isset($active_proposal))
          <strong>Date Covered:</strong> {{ $date1->format('m/d/Y') }} - {{ $date2->format('m/d/Y') }}
          <?php $total_budget = $active_proposal->budget; ?>
          @endif
          <div id="proposalBillboards">
            <table class="table">
              <?php $counter = 1; ?>
              <?php 
                $cpm_total = 0;
                $impressions_total = 0;
                $quoted_cost = 0;
                $overall_cost = 0;
                $final_savings = 0;
                $cpm_final = 0;

              ?>

              @if(count($active_proposal_billboards))
                @foreach($active_proposal_billboards as $active_proposal_billboard)
                <?php 
                  $cpm_total += ($active_proposal_billboard->monthly_price * $months_between) / (($active_proposal_billboard->monthly_impressions * $days_between)/1000);
                  $impressions_total += $active_proposal_billboard->monthly_impressions;
                  $quoted_cost += $active_proposal_billboard->monthly_price;
                  $overall_cost += $active_proposal_billboard->monthly_price * $months_between;
                  $final_savings += $cpm_total;

                 

                  if ($overall_cost > 0 && $impressions_total > 0){
                    $cpm_final = $overall_cost/(($impressions_total * $days_between)/1000);  
                  }
                  
                ?>
                <tr>
                  <td><?php echo $counter++; ?><input type="text" class="billboard_text_box" name="proposal_billboards[]" style="display:none;" value="{{ $active_proposal_billboard->id }}"></td>
                  <td><img width="30" src="{{URL::to('/')}}/images/billboard.jpg"></td>
                  <td><a href="#" class="billboard_link" billboardfaceid="{{ $active_proposal_billboard->billboard_face_id.$active_proposal_billboard->label }}" billboardid="{{ $active_proposal_billboard->id }}" billboardLat="{{ $active_proposal_billboard->lat }}" billboardLng="{{ $active_proposal_billboard->lng }}"><?php echo $active_proposal_billboard->name; ?></a></td>
                  <td>$<?php echo number_format($active_proposal_billboard->monthly_price,2); ?></td>
                  <td><a href="{{ URL::to('/') }}/active-proposal/remove-billboard/<?php echo $active_proposal_billboard->apbid; ?>" data-confirm="Are you sure you want to remove this billboard?">Remove</a></td>
                </tr>
                @endforeach
              @endif
            </table>
          </div>

          <div id="proposal_totals">
            <table class="table">
              <tr>
                <td>CPM</td>
                <td><div id="proposal_cpm">${{ number_format($cpm_final,2) }}</div></td>
              </tr>
              
              <tr>
                <td>DEC Impressions</td>
                <td><div id="proposal_impressions">{{ number_format($impressions_total) }}</div></td>
              </tr>

              <tr>
                <td>DEC Total</td>
                <td><div id="proposal_impressions">{{ number_format($impressions_total*$days_between) }}</div></td>
              </tr>

              <tr>
                <td>Monthly Cost</td>
                <td><div id="proposal_quoted_cost">${{ number_format($quoted_cost,2) }}</div></td>
              </tr>
              <tr>
                <td>Overall Cost</td>
                <td><div id="proposal_overall_cost">${{ number_format($overall_cost,2) }}</div></td>
              </tr>
              <tr>
                <td>Monthly Budget</td>
                <td><div id="proposal_final_savings">${{ number_format($total_budget,2) }}</div></td>
              </tr>
              <tr>
                <td>Available Budget</td>
                <td>
                  <div id="proposal_monthly_cost">
                    @if(isset($active_proposal))
                    <?php 
                      $available_budget = $active_proposal->budget - $quoted_cost;
                      if ($available_budget > 0) {
                        echo '<font style="color:green;font-weight:bold;">$'.number_format($available_budget ,2).'</font>';
                      } else {
                        echo '<font style="color:red;font-weight:bold;">$'.number_format($available_budget ,2).'</font>';
                      }
                    ?>
                    @endif
                  </div>
                </td>
              </tr>
            </table>

          </div>

        </div>
        <div>
          
        </div>
        <div>
          <input id="proposal_link" style="display:none;" value="@if(isset($active_proposal)) {{URL::to('/').'/clientview/'.$active_proposal->hash}} @endif">
        </div>
        <div style="text-align:right;">
          <a id="copy_link" title="Copy Link" style="cursor:pointer;" class="copy_link btn btn-success">Copy Link</a>
          <a id="generate_pdf" title="Generate PDF" style="cursor:pointer;" class="generate_pdf btn btn-primary">Generate Proposal</a>
          <a id="save_proposal" title="Save Current Proposal" style="cursor:pointer;" class="btn btn-info">Save</a>

        </div>
        <div class="clear"></div>

         <hr/>
        
        <div class="clear"></div>
        

      </div>

      <div id="proposal-comments-window">
<!--        <div style="text-align:right;">
              <input type="button" value="Add Comment" data-toggle="modal" class="btn btn-info" data-target="#proposalComment">
            </div>
            <div style="text-align:left;">
              <strong>Comments</strong>
            </div>-->
            <div id="proposalComments">
            @if(count($comments))
              @foreach($comments as $comment)

                @if($comment->message_from == 'client')
                <div class="client_message" style="float:left;border-radius: 8px;
        border: 1px solid #73AD21;margin:2px;padding:5px; background-color:#a1dba1;width:50%;">
                  {{$comment->message}}
                  
                </div>
                @endif
                @if($comment->message_from == 'admin')
                <div class="admin_message" style="float:right;border-radius: 8px;
        border: 1px solid #73AD21;margin:2px;padding:5px; background-color:#5bc0de;width:50%;">
                  {{$comment->message}}
                  
                </div>
                @endif
              @endforeach
            @endif
            </div>
            <div class="comments-wrapper">
              <form method="POST" id="frm_comments" name="frm_comments">
                <div class="comments-wrapper-contents">

                    @if(count($active_proposal))
                    <input type="hidden" id="c_proposal_id" name="proposal_id" value="{{ $active_proposal->id }}">
                    <input type="hidden" id="c_user_id" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" id="c_client_id" name="client_id" value="{{ $active_proposal->client_id }}">
                    @endif

                      <div class="form-group" style="padding:20px;">
                          <div>
                            <textarea id="adminTextArea" class="form-control" name="proposalComment"></textarea>
                            <button type="submit" id="submitAdminMessage" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                          </div>
                      </div>
                </div>
              </form>
            </div>
      </div>
      <!-- Proposal Window -->
  </div>

  </div>

  <div id="proposal-comments-window" style="display:none;">
    <div style="text-align:right;">
          <input type="button" value="Add Comment" data-toggle="modal" class="btn btn-info" data-target="#proposalComment">
        </div>
        <div style="text-align:left;">
          <strong>Comments</strong>
        </div>
        <div id="proposalComments">
        @if(count($comments))
          @foreach($comments as $comment)

            @if($comment->message_from == 'client')
            <div  style="float:left;border-radius: 8px;
    border: 1px solid #73AD21;margin:2px;padding:5px; background-color:#a1dba1;width:50%;">
              {{$comment->message}}
            </div>
            @endif
            @if($comment->message_from == 'admin')
            <div style="float:right;border-radius: 8px;
    border: 1px solid #73AD21;margin:2px;padding:5px; background-color:#5bc0de;width:50%;">
              {{$comment->message}}  
            </div>
            @endif
          @endforeach
        @endif
        </div>
  </div>

  <div class="map-container" style="height:100%;">
    <div id="map_canvas" style="width:100%; height:100%"> </div>    
  </div>

</div>
</div>

<div id="test"></div>


<!-- Modal Add Proposal Comment-->
<!--<div class="modal faid" id="proposalComment" tabiidex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Comment</h4>
            </div>

            {!! Form::open(array('route' => 'postproposalcomment', 'method'=> 'POST', 'id'=>'frm_new_proposal_billboard_comment', 'name' => 'frm_new_proposal_billboard', 'class' => 'form-horizontal', 'role' => 'form' )) !!}



            
            <div class="modal-body">
              
            @if(count($active_proposal))
            <input type="hidden" name="proposal_id" value="{{ $active_proposal->id }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="client_id" value="{{ $active_proposal->client_id }}">
            @endif

              <div class="form-group" style="padding:20px;">
                  <div>
                <label class="control-label">Comment</label>
              </div>
              <div>
                <textarea class="form-control" name="proposalComment"></textarea>
              </div>
            </div>

                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Comment</button>
            </div>
            {!! Form::close() !!}
    </div>
  </div>
</div>-->

<!-- Modal Add Proposal Billboard-->
<div class="modal fade" id="proposalBillboard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add This Billboard</h4>
            </div>
            {!! Form::open(array('route' => 'postproposalbillboard', 'method'=> 'POST', 'id'=>'frm_new_proposal_billboard', 'name' => 'frm_new_proposal_billboard', 'class' => 'form-horizontal', 'role' => 'form' )) !!}
            <div class="modal-body">
            

              <div class="form-group">
                <label class="col-md-3 control-label">Billboard</label>
                <div class="col-md-6">
                  <div id="billboardtobeadded" style="font-weight:bold; font-size:16px;"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Price Per Month</label>
                <div class="col-md-6">
                  <input type="text" name="pb_price_per_month" class="form-control">
                  <input type="hidden" name="pb_billboard_id" id="pb_billboard_id" class="form-control">
                  <input type="hidden" name="pb_face_id" id="pb_face_id" class="form-control">
                </div>
              </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Billboard</button>
            </div>
            {!! Form::close() !!}
    </div>
  </div>
</div>



<!-- Modal Create Proposal-->
<div class="modal fade" id="createProposal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Let's Get Started</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'postproposal', 'method'=> 'POST', 'id'=>'frm_new_proposal', 'name' => 'frm_new_proposal', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

        <div class="form-group">
    			<label class="col-md-3 control-label">1. Set Timeframe</label>
    			<div class="col-md-6">
    				<div id="cpdaterange" class="btn">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span></span> <b class="caret"></b>
                   	</div>
                   	<input type="hidden" name="start_date" value="<?php echo date('Y-m-d'); ?>">
                   	<input type="hidden" name="end_date" value="<?php echo date('Y-m-d'); ?>">
    			</div>
    		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">2. Choose Client</label>
			<div class="col-md-6">
				<select class="form-control" name="client_id">
				@if(isset($clients))
					@foreach($clients as $client)
						<option value="{{ $client->id }}">{{ $client->first_name.' '.$client->last_name }}</option>
					@endforeach
				@endif
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">3. Set Budget</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="budget">
			</div>
			<!-- <div class="col-md-3"> -->
				<select class="form-control" name="budget_validity" style="display:none;">
					<option>Week</option>
					<option>Month</option>
					<option>Year</option>
				</select>
			<!-- </div> -->
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">4. Proposal Name</label>
			<div class="col-md-6">
				<input type="text" name="name" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">5. Set as Active Proposal</label>
			<div class="col-md-6">
				<select name="setasactive" class="form-control">
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select> (Note: this will overwrite any existing active proposal)
			</div>
		</div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Now</button>
      </div>
       {!! Form::close() !!}
    </div>
  </div>
</div>



<!-- Modal Book Billboard-->
<div class="modal fade" id="instantBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Book Billboard</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'postbookbillboard', 'method'=> 'POST', 'id'=>'frm_book_billboard', 'name' => 'frm_book_billboard', 'class' => 'form-horizontal', 'role' => 'form', 'files'=>true )) !!}
        <input type="hidden" id="billboard_id" name="billboard_id" value="">
        <input type="hidden" id="billboard_face_id" name="billboard_face_id" value="">


      <div class="form-group">
  			<label class="col-md-4 control-label">1. Client</label>
  			<div class="col-md-6">
  				<select class="form-control" name="client">
  				@if(isset($clients))
  					@foreach($clients as $client)
  						<option value="{{ $client->id }}">{{ $client->company }}</option>
  					@endforeach
  				@endif
  				</select>
  			</div>
  		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">2. Date Range</label>
			<div class="col-md-6">
			<div id="bdaterange" class="btn">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span></span> <b class="caret"></b>
               	</div>
               	<input type="hidden" name="bstart_date" value="<?php echo date('Y-m-d'); ?>">
               	<input type="hidden" name="bend_date" value="<?php echo date('Y-m-d'); ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">3. Set Price</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="set_price">
			</div>
		</div>

    <div class="form-group">
      <label class="col-md-4 control-label">4. Description</label>
      <div class="col-md-6">
        <textarea class="form-control" name="description"></textarea>
      </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">5. Upload Billboard Photo</label>
        <div class="col-md-6">
            {!! Form::file('image') !!}
        </div>
    </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hold</button>
        <button type="button" onclick="$('#frm_book_billboard').submit();" class="btn btn-primary">Book Now</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


<!-- Modal Create Proposal-->
<div class="modal fade" id="digitalDriveby" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Digital Driveby Video</h4>
      </div>
      <div class="modal-body">
     
  
      <iframe id="videoFrame" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Keys-->
<div class="modal fade" id="keyLegend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Key Legend</h4>
      </div>
      <div class="modal-body">
       
      <table class="table">
			<tr>
				<td><img width="30" src="{{URL::to('/')}}/images/digital-board.png"></td>
				<td><span>Digital</span></td>
			</tr>
			<tr>
				<td><img width="30" src="{{URL::to('/')}}/images/static-board.png"></td>
				<td><span>Static</span></td>
			</tr>
		</table>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Create Proposal-->
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Delete</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
      <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
    </div>
  </div>
</div>


<!-- Modal View/Create Booking-->
<div class="modal fade" id="billboardBooking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Billboard Booking</h4>
      </div>
      <div class="modal-body">
     
        <div id="dp"></div>
   
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
