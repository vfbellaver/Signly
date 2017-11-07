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
        <div class="row">
            <div class="col-md-6">
                <img width="100%" class="text-center" src="/images/pov_img.png">
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
        </div>

        <div class="col-md-12">
            <hr/>
        </div>

        <!-- BILLBOARD FACES -->
        <h3 class="text-center">Billboard Faces</h3>
        @foreach($billboard->billboardFaces as $face)

            <div class="row col-md-12">
                <hr/>
                <div class="col-md-6">
                    <img alt="Face" class="img-responsive" src="{{$face->photo}}" width="100%">
                </div>
                <div class="col-md-6">
                    <p> {{$face->code}}</p>
                    <p> {{$face->label}}</p>
                    <p> {{$face->hard_cost}}</p>
                    <p> {{$face->duration}}</p>
                    <p> {{$face->height}}</p>
                    <p> {{$face->width}}</p>
                    <p> {{$face->reads}}</p>
                    <p> {{$face->notes}}</p>
                    <p> {{$face->monthly_impressions}}</p>
                    <p> {{$face->max_ads}}</p>
                    <table class="table">
                        <thead style="font-size: 10px">
                        <tr>
                            <th>Illuminated</th>
                            <th>Lights on</th>
                            <th>Lights off</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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

