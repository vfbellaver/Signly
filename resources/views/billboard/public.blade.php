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
            <hr style="border-bottom: 2px solid #00A5E3"/>
        </div>
        <div class="col-md-6">
            <gmap-map
                    :center="{{json_encode(['lat'=> $billboard->lat,'lng'=>$billboard->lng])}}"
                    :zoom="7"
                    style="width: 95%; min-height: 185px">
                <gmap-marker
                        :position="{{json_encode(['lat'=> $billboard->lat,'lng'=>$billboard->lng])}}"
                        :icon="{{
                        json_encode([
                                    'url'=> '/images/pin.png',
                                    'size'=> ['width'=> 48, 'height'=> 48, 'f'=>'px', 'b'=> 'px'],
                                    'scaledSize'=> ['width'=> 48, 'height'=> 48, 'f'=>'px', 'b'=> 'px'],
                                    ])
                                }}"
                        :clickable="false"
                        :draggable="false"
                ></gmap-marker>
            </gmap-map>
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
            <hr style="border-bottom: 2px solid #00A5E3"/>
        </div>

        <!-- BILLBOARD FACES -->
        <div class="col-md-12 text-center">
            <h4 style="margin-top: 0">Billboard Faces</h4>
        </div>
        @foreach($billboard->billboardFaces as $face)
            <div class="billboard-face col-md-6">
                <hr style="border-bottom: 2px solid #00A5E3; margin-top: 0"/>
                <div class="col-md-5">

                        <img alt="Face" class="img-responsive" src="{{$face->photo}}">

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
        @endforeach
        <div style="clear: both"></div>
    </div>
@endsection

