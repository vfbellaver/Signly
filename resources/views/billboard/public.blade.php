@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('base-content')
    <div id="public-billboard">
        <div class="row">
            <div class="col-md-2" style="padding-right: 0">
                <img alt="Company" src="{{$team->logo}}" width="100%">
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <h3><strong>Company {{$team->name}}</strong></h3>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong> <i class="fa fa-send"></i> Email:</strong><br>
                        {{$team->email}}
                    </div>
                    <div class="col-md-3">
                        <strong> <i class="fa fa-phone"></i> Phones:</strong><br>
                       {{$team->phone1}}<br>
                       {{$team->phone2}}<br>

                    </div>
                    <div class="col-md-5">
                        <address>
                            <strong> <i class="fa fa-map-marker"></i> Address:</strong><br>
                            {{$team->address_line1}} <br>
                            {{$team->city}} , {{$team->state}}
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- BILLBOARD FACES -->
        <div class="row">
            <div class="col-md-6">
                <img alt="Face" class="img-responsive" src="{{$faces->photo_url}}" width="100%">
            </div>
            <div class="col-md-6">
                <div class="label-inline">
                    <h3>Billboard Face {{$faces->label}}</h3>
                </div>
                <div class="ibox-content">
                    <div class="row  m-t-sm">
                        <div class="col-sm-6">
                            <p>Montlhy Impressions</p>
                            <h2 class="font-bold">{{$faces->monthly_impressions}}</h2>
                        </div>
                        <div class="col-sm-6">
                            <p>Rate Card</p>
                            <h2 class="font-bold">$ {{$faces->rate_card}}</h2>
                        </div>
                    </div>
                    <hr style="margin-top: 5px; margin-bottom: 15px">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Type</th>
                            <th>Duration</th>
                            <th>Reads</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{($faces->width ? 'Yes' : 'No')}}</td>
                            <td>{{$faces->height}}</td>
                            <td>{{$faces->type}}</td>
                            <td>{{$faces->duration}}</td>
                            <td>{{$faces->reads}}</td>
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
                    @endif

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="well m-t"><strong>Note:</strong>
                    {{$faces->notes}}
                </div>
            </div>
        </div>

        <div style="clear: both"></div>
    </div>
@endsection

