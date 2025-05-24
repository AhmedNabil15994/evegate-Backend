@extends('apps::frontend.layouts.app')
@section('title', __('authentication::frontend.reset.title') )
@section('content')
<div class="banner-home library-head-banner page-head " >
    <div class="container">
        <div class="library-header ">
           <h1> {{ setting('app_name',locale()) }} </h1>
        </div>
    </div>
</div>

<div class="inner-page login-page" style="min-height: 500px">
    <div class="container" style="margin-top: 5%">
        <div class="text-center " >
            <img src="{{url("uploads/success.png")}}" style="margin: 20px auto "  class="img-responsive" width="400px"/>
        </div>
        <p class="lead text-center">
            {{$status}}
        </p>
    </div>
</div>
@stop
