@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('base-content')
    <div id="public-billboard">
        <div class="col-md-2">
            <img alt="Company" src="https://lorempixel.com/640/480/?88914" width="100%">
        </div>
        <div class="col-md-10">
            <div class="col-md-12">
                <h3><strong>Company {{$billboard->team->name}}</strong></h3>
            </div>
            <div class="col-md-4">
                <strong> <i class="fa fa-send"></i> Email:</strong><br>
                {{$billboard->name}}
            </div>
            <div class="col-md-3">
                <strong> <i class="fa fa-phone"></i> Phones:</strong><br>
                (xxx) xxx-xxxx
            </div>
            <div class="col-md-5">
                <address>
                    <strong> <i class="fa fa-map-marker"></i> Address:</strong><br>
                    {{$billboard->address}}
                </address>
            </div>
        </div>
        <div class="col-md-12">
            <hr/>
        </div>
        <div class="col-md-6">
            <gmap-map
                    :center="{{json_encode(['lat'=> $billboard->lat,'lng'=>$billboard->lng])}}"
                    :zoom="7"
                    style="width: 95%; min-height: 250px">
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
            <h2 class="text-center"><strong>{{$billboard->name}}</strong></h2>
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
        <div class="col-md-12">
            <div class="billboard-faces row">
                <h3 class="text-center">Billboard Faces</h3>
                @foreach($billboard->billboardFaces as $face)
                    <div class="billboard-face col-md-6">
                        {{$face->code}} - {{$face->label}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

