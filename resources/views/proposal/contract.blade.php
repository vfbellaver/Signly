@extends('app')

@section('content')

<div class="container">
    @if(Session::has('success'))
        <div>
            <p class="alert alert-success">{{Session::get('success')}}</p>
        </div>
    @endif
        @if(count($errors->all()) > 0)
            <p class="alert alert-danger">
        @endif

        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach

        @if(count($errors->all()) > 0)
            </p>
        @endif

    <div class="panel panel-default">
        <div class="panel-heading">Contract Signing</div>
        <div class="panel-body">
            
            {!! Form::open(array('route' => 'postproposalcontract', 'method'=> 'POST', 'id'=>'frm_new_billboard', 'name' => 'frm_new_billboard', 'class' => 'form-horizontal', 'role' => 'form' )) !!}

            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    

                    <div class="form-group">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Contract Title</label>
                            <div class="col-md-6">
                                <input type="text" id="contract_title" class="form-control" name="contract_title" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Choose proposal to sign</label>
                        <div class="col-md-6">
                        <select name="clients" class="form-control">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->first_name.' '.$client->first_name }} ( {{ $client->company}}  )</option>
                            @endforeach          
                        </select>    
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Set Timeframe</label>
                        <div class="col-md-6">
                            <div id="cpdaterange" class="btn">
                              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                              <span></span> <b class="caret"></b>
                            </div>
                            <input type="hidden" name="start_date" value="<?php echo date('Y-m-d'); ?>">
                            <input type="hidden" name="end_date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                   <table class="table">
                       <thead>
                           <th>ID</th>
                           <th>Billboard</th>
                           <th>Face</th>
                           <th>Cost</th>
                           <th></th>
                       </thead>
                       <tbody>
                        @foreach($proposal_billboards as $proposal_billboard)
                           <tr>
                               <td>{{$proposal_billboard->unique_id}}</td>
                               <td>{{$proposal_billboard->name}}</td>
                               <td>{{$proposal_billboard->reads.' '.$proposal_billboard->label}}</td>
                               <td>{{$proposal_billboard->hard_cost}}</td>
                               <td></td>
                           </tr>
                        @endforeach
                       </tbody>
                   </table>
                   
                   <div class="panel panel-default">
                       <div class="panel-heading">Email</div>
                       <div class="panel-body">

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">To:</label>
                                    <div class="col-md-8">
                                        <input type="text" id="email_to" class="form-control" name="email_to" value="">
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Cc:</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_cc" class="form-control" name="email_cc" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Subject</label>
                                    <div class="col-md-8">
                                        <input type="text" id="email_subject" class="form-control" name="email_subject" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Message</label>
                                    <div class="col-md-8">
                                        <textarea id="email_message" class="form-control" name="email_message"></textarea>
                                        
                                    </div>
                                </div>
                            </div>

                       </div>
                   </div>
                    
                   
                </div>

            
            </div>

            

            <div class="row">
                <button type="submit" role="submit">Save</button>
            </div>  



            {!! Form::close() !!}

        </div>
    </div>
    
    
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Face</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Unique ID *</strong></label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group row">
                    <label class="col-md-2 control-label" ><strong>Size</strong></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control">
                        <span>height</span>
                    </div>
                    <div class="col-md-1">
                        X
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control">
                        <span>width</span>
                    </div>        
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label" ><strong>Reads</strong></label>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Right
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Cross
                    </div>        
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label"><strong>Label *</strong></label>
                    <div class="col-md-5">
                        <input type="radio" name="label"> North <br/>
                        <input type="radio" name="label"> East <br/>   
                        <input type="radio" name="label"> South <br/>
                        <input type="radio" name="label"> West <br/>
                        <input type="radio" name="label"> <input type="text" placeholder="custom">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><strong>Picture of the Face</strong></label>
                    <div>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </form>                 
                    </div>
                    <div>
                        For best results, include a picture of the billbaord from the street level
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Digital Driveby</strong></label>
                    <div>
                        <input type="checkbox"> Use Main Billboard Driveby
                    </div>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                    <div>
                        After uploading your video to youtube.com, enter that video URL here
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label" ><strong>Sign Type *</strong></label>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Static
                    </div>
                    <div class="col-md-4">
                        <input type="radio" name="reads" > Digital
                    </div>        
                </div>
                <div class="form-group">
                    <label><strong>Your Hard Costs</strong></label>
                    <div>
                        <input type="checkbox"> Use Main Billboard Cost
                    </div>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Monthly Impressions</strong></label>
                    <div>
                        <input type="checkbox"> Use Main Billboard Impressions
                    </div>
                    <div>
                        <input type="text" class="form-control">
                    </div>
                    <div>
                        How many people see this face on a monthly basis. Often called 'DEC'
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Notes</strong> (Clients can see)</label>
                    <div>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add Face</button>
      </div>
    </div>
  </div>
</div>

@endsection
