@extends('layouts.app')

@section('heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Teams board</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a>App views</a>
                </li>
                <li class="active">
                    <strong>Teams board</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
@endsection

@section('content')
    @component('components.fluid-page')
        <billboard-list></billboard-list>
    @endcomponent
@endsection