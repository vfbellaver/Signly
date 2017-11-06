@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('base-content')
    <div id="public-billboard">
        <div class="col-md-2">
            <img alt="Company" src="{{$billboard->team->logo}}" width="100%">
        </div>
        <div class="col-md-10">
            <div class="col-md-12">
                <h3><strong>Company {{$billboard->team->name}}</strong></h3>
            </div>
            <div class="col-md-4">
                <strong> <i class="fa fa-send"></i> Email:</strong><br>
                {{$owner->email}}
            </div>
            <div class="col-md-3">
                <strong> <i class="fa fa-phone"></i> Phones:</strong><br>
                (xxx) xxx-xxxx
            </div>
            <div class="col-md-5">
                <address>
                    <strong> <i class="fa fa-map-marker"></i> Address:</strong><br>
                    {{$owner->address}}
                </address>
            </div>
        </div>
        <div class="col-md-12">
            <hr/>
        </div>
        <div class="col-md-6">
            <gmap-street-view-panorama
                    class="pano"
                    :position="{{json_encode(['lat'=> $billboard->lat,'lng'=>$billboard->lng])}}"
                    :pov="{{json_encode(array('heading'=>$billboard->heading,'pitch'=>$billboard->pitch))}}"
                    :zoom="1">
            </gmap-street-view-panorama>
        </div>
        <div class="col-md-6">
            <h3 class="text-center"><strong>{{$billboard->name}}</strong></h3>
            <address>
                <strong> <i class="fa fa-map-marker"></i> Address:</strong><br>
                {{$billboard->address}}
            </address>
            <strong> <i class="fa fa-edit"></i> Description:</strong><br>
            <p class="text-justify">{{$billboard->description}}</p>
        </div>

        <div class="col-md-12">
            <hr/>
        </div>

        <!-- BILLBOARD FACES -->
        @foreach($billboard->billboardFaces as $face)
            <div class="billboard-face col-md-6">
            <div class="row">
                <hr/>
                <div class="col-md-5">

                        <img alt="Face" class="img-responsive" src="{{$face->photo}}" width="100%">

                </div>
                <div class="col-md-7">
                    <h5><strong> {{$face->code}} - {{$face->label}}</strong></h5>
                    <small><strong>Hard Cost:</strong></small>
                    <p><i class="fa fa-dollar"></i> {{$face->hard_cost}}</p>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead style="font-size: 10px">
                        <tr>
                            <th>Type</th>
                            <th>Illuminated</th>
                            <th>Lights on</th>
                            <th>Lights off</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            <td>{{$face->type}}</td>
                            <td>{{($face->is_illuminated ? 'Yes' : 'No')}}</td>
                            <td>{{$face->lights_on}}</td>
                            <td>{{$face->lights_off}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            </div>
        @endforeach
        <div style="clear: both"></div>
    </div>
@endsection

