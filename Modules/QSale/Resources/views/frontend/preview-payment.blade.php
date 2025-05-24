@extends('apps::frontend.layouts.app')
@section('title', $ads->title)


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
                    <h2>{{$ads->title}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">@lang("apps::frontend.home.route")</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$ads->title}} - {{__("qsale::frontend.routes.preview_payment")}}</li>
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

<div class="inner-section ad-details-part ">
    <div class="container">
        <div class="row">
                <div class="col-md-6">
                    <div class="account-card">

                        <div class="account-title">
                            <h3>@lang("qsale::frontend.preview_payment.ads_info")</h3>
                        
                        </div>
        
                        <ul class="account-card-list">
                          
                            <li><h5>@lang("qsale::frontend.show.price") : </h5><p>{{ $ads->price ?? "0" }} {{currency()}}</p></li>
                            <li><h5>@lang("user::frontend.create_ads.title") : </h5> <p>{{ $ads->title ?? "---" }} </p></li>
                            <li><h5>@lang("user::frontend.create_ads.description") : </h5> <p>{{ $ads->description ?? "---" }} </p></li>
                            <li><h5>@lang("user::frontend.create_ads.mobile") : </h5> <p>{{ $ads->mobile ?? "---" }} </p></li>
                            <li><h5>@lang("qsale::frontend.preview_payment.type") : </h5>  <p> {{ $ads->type ?? "---" }}</li>
                            @if($subscription = $ads->subscription)    
                            <li><h5>@lang("qsale::frontend.preview_payment.subscription") : </h5>  <p> {{ $subscription->package->title ?? "---" }}</li>  
                            @endif       

                            <li><h5>@lang("qsale::frontend.preview_payment.start_at") : </h5>  <p> {{ $ads->start_at ?? "---" }}</li>
                            <li><h5>@lang("qsale::frontend.preview_payment.end_at") : </h5>  <p> {{ $ads->start_at ?? "---" }}</li>
                            <li><h5>@lang("qsale::frontend.preview_payment.is_paid") : </h5> 
                                <p>
                                    @if($ads->is_paid)
                                        <span class="badge badge-danger">@lang("qsale::frontend.preview_payment.yes")</span>
                                    @else
                                    <span class="badge badge-success">@lang("qsale::frontend.preview_payment.no")</span>
                                    @endif
                                </p>
                                </li>
                        </ul>
        
                    
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="account-card">

                        <div class="account-title">
                            <h3>@lang("user::frontend.create_ads.addations")</h3>
                        
                        </div>
        
                        <ul class="account-card-list">
                          
                            @forelse ($ads->addationsModel as $addation)
                                 <li><h5> {{$addation->name}} : </h5><p>{{ $addation->pivot->price ?? "---" }} {{currency()}}</p></li>
                            @empty
                                
                            @endforelse
                           
                            <li><h5>@lang("qsale::frontend.preview_payment.total") : </h5> <p>{{ $ads->addation_total ?? "---" }} </p></li>
                           
                        </ul>



                        <div class="account-title">
                            <h3>@lang("user::frontend.create_ads.address")</h3>
                        
                        </div>
        
                        <ul class="account-card-list">
                          
                            @forelse ($ads->address as $address)
                                 <li><h5> <i class="fas fa-map"></i> </h5><p> {{$address->getAddress()}}</p></li>
                            @empty
                                
                            @endforelse
                           
                            
                           
                        </ul>
        
                    
                    </div>
                </div>

                <div class="col-md-12">
                    <p></p>
                    <div>
                        @if($url)
                        <p class="text-danger">@lang("qsale::frontend.preview_payment.paid_msg")</p>
                        <a  class="btn btn-success btn-block" href="{{$url}}">@lang("qsale::frontend.preview_payment.paid") <span class="text-danger">( {{$ads->total}} {{currency()}} )</span> </a>
                        @else
                        <a  class="btn btn-success btn-block" href="{{$url}}">@lang("qsale::frontend.preview_payment.total") {{$ads->total}} {{currency()}}</a>

                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>

     
      

@stop