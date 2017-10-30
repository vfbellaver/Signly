@extends('layouts.base', ['bodyClass' => 'gray-bg'])

@section('base-content')

    <div id="public-billboard">
        <div class="billboard-header">
            {{$billboard->name}}
        </div>
        <hr/>
        <div class="billboard-faces">
            @foreach($billboard->billboardFaces as $face)
                <div class="billboard-face">
                    {{$face->code}} - {{$face->label}}
                </div>
            @endforeach
        </div>
    </div>
@endsection