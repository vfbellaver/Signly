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
            <img width="96%" class="text-center" src="/images/pov_img.png">
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
            <h3 class="text-center">Billboard Faces</h3>
            <hr/>
        </div>

        <!-- BILLBOARD FACES -->

        @foreach($billboard->billboardFaces as $face)
            <div class="row col-md-12">
                <div class="col-md-6">
                    <img alt="Face" class="img-responsive" src="{{$face->photo}}" width="100%">
                </div>
                <div class="col-md-6">
                    <div class="label-inline">
                        <h3>Billboard Face {{$face->label}}</h3>
                    </div>
                    <div class="ibox-content">
                        <div class="row  m-t-sm">
                            <div class="col-sm-6">
                                <p>Hard Cost</p>
                                <h2 class="font-bold">$ {{$face->hard_cost}}</h2>
                            </div>
                            <div class="col-sm-6">
                                <p>Montlhy Impressions</p>
                                <h2 class="font-bold">{{$face->monthly_impressions}}</h2>
                            </div>
                        </div>


                        <hr style="margin-top: 5px; margin-bottom: 5px">
                        <table class="table">
                            <thead>
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
            </div>
            <div class="col-md-12">
                <div class="well m-t"><strong>Note:</strong>
                    {{$face->notes}}
                </div>
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
        @endforeach
        <div style="clear: both"></div>
    </div>
@endsection

