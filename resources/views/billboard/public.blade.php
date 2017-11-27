@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('base-content')
    <div id="public-billboard">
        <div class="row">
            <div class="col-xs-2 col-md-2" style="padding-right: 0">
                <img alt="Company" src="{{$team->logo}}" width="100%">
            </div>
            <div class="col-xs-10 col-md-10">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h3><strong>{{$team->name}}</strong></h3>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <strong> <i class="fa fa-send"></i> Email:</strong><br>
                        {{$team->email}}
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <strong> <i class="fa fa-phone"></i> Phones:</strong><br>
                        {{$team->phone}}<br>
                        {{$team->fax}}
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <address>
                            <strong> <i class="fa fa-map-marker"></i> Address:</strong><br>
                            {{$team->address}} <br>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-6 col-md-6">
                <img alt="Face" class="img-responsive" src="{{$faces->photo_url}}" width="100%">
            </div>
            <div class="col-xs-6 col-md-6">
                <div class="label-inline">
                    <h3>{{$faces->billboard->address}}</h3>
                </div>
                <div class="ibox-content">
                    <div class="row  m-t-sm">
                        <div class="col-xs-6 col-sm-6">
                            <p>Monthly Impressions</p>
                            <h2 class="font-bold">{{number_format($faces->monthly_impressions,0)}}</h2>
                        </div>
                    </div>
                    <hr style="margin-top: 5px; margin-bottom: 15px">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Dimensions</th>
                            <th>Reads</th>
                            <th>Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$faces->width}} x {{$faces->height}}</td>
                            <td>{{$faces->reads}}</td>
                            <td><span class="label">{{$faces->type}}</span></td>
                        </tr>
                        </tbody>
                    </table>

                    @if($faces->type == 'Static')
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
                                <td>{{($faces->is_illuminated ? 'Yes' : 'No')}}</td>
                                <td>{{$faces->lights_on}}</td>
                                <td>{{$faces->lights_off}}</td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Max Ads</th>
                                <th>Duration</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$faces->max_ads}}</td>
                                <td>{{$faces->duration}}</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="well m-t"><strong>Note:</strong>
                    {{$faces->notes}}
                </div>
            </div>
        </div>

        <div style="clear: both"></div>
    </div>
@endsection

