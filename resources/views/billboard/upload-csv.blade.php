@extends('layouts.app')

@section('content')
    {{--@component('components.default-page')--}}
        {{--<csv-upload-billboard-list></csv-upload-billboard-list>--}}
    {{--@endcomponent--}}

    <div class="container">
        <div class="panel">
            <div class="panel-title">
                Import CSV Billboards
            </div>
            <div class="panel-body">
                <form action="{{route('csv.upload')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group col-md-4">
                        <label for="file"> Select file:</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary">
                            <i class="fa fa-upload"></i> Upload
                        </button>
                    </div>
                </form>
                <div class="divider"></div>
                <div class="box">

                </div>
            </div>
        </div>
    </div>
@endsection