@extends('apps::frontend.layouts.app')
@section('title', __("qsale::frontend.routes.republished_package") . " | " .$ad->title)

@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/ad-details.css">

@stop

@section("banner-content")
 <!--=====================================
                  SINGLE BANNER PART START
=======================================-->
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>{{$ad->title}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">@lang("apps::frontend.home.route")</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang("qsale::frontend.routes.republished_package") | {{$ad->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            SINGLE BANNER PART END
=======================================-->
@stop

@section('content')
@include("apps::frontend.layouts._message")
<section class="myads-part">
    <div class="container py-2">
        <div class="row mt-4">
            @forelse ($packages as $package)
                
            
           
            <div class="col-md-4">
                <form action="{{route('frontend.ads.save_republished', $ad->id)}}" method="POST">
                    @csrf
                    <input type="hidden" name="package_id" value="{{$package->id}}">
                    <div class="package common-card" style="border:2px solid var(--primary) ">
                        <div class="card-header">
                            <h5 class="card-title">{{ $package->title }}</h5>
                        </div>
                        <div>
                            <ul class="ad-details-specific">
                                <li>
                                    <h6>@lang("qsale::frontend.republished_package.price") :</h6>
                                    <p>{{ $package->price ?? "---" }} {{currency()}}</p>
                                </li>

                                <li>
                                    <h6>@lang("qsale::frontend.republished_package.duration") :</h6>
                                    <p>{{ $package->duration ?? "---" }} @lang("qsale::frontend.republished_package.day")</p>
                                </li>
                
                            
                            </ul>
                            <p class="text-center">
                                <button class="btn btn-success">@lang("qsale::frontend.republished_package.pay")</button>
                            </p>
                        </div>
                    </div>
                </form>

            </div>
            @empty
                
            @endforelse
        </div>
    </div>
</section>


@stop