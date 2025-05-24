@extends('apps::frontend.layouts.app')
@section('title', __("category::frontend.routes.index"))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/category-list.css">
@stop

@section("banner-content")
<!--=====================================
                  SINGLE BANNER PART START
=======================================-->
<section class="inner-section single-banner">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="single-content">
                <h2>@lang("category::frontend.routes.index")</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">@lang("apps::frontend.home.route")</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang("category::frontend.routes.index")</li>
                </ol>
            </div>
        </div>
    </div>
</div>
</section>
<!--=====================================
@stop

@section('content')
 <!--=====================================
                    CATEGORY PART START
        =======================================-->
        <section class="inner-section category-part">
            <div class="container">
                <h1 class="text-center mb-5" style="color:var(--primary)">@lang("category::frontend.routes.index") </h1>
                <div class="row">
                    @forelse ($categories as $item)
                                 @php
                                    $url = "#";
                                    if($item->is_end_category || $item->children_count == 0)
                                        $url = route("frontend.ads.index", ["category"=>$item->translateOrDefault(locale())->slug]);
                                    if($item->children_count > 0) $url = route("frontend.categories.show", $item->translateOrDefault(locale())->slug );
                                @endphp
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <div class="category-card">
                                    <div class="category-head">
                                        <img src="{{url($item->image)}}" style="height: 250px" alt="{{$item->translateOrDefault(locale())->title}}">
                                        <a href="{{$url}}" class="category-content">
                                            <h4>{{$item->translateOrDefault(locale())->title}}</h4>
                                            @if($item->is_end_category)
                                            <p>({{$item->ads_count}}) <i class="fas fa-ad"></i> </p>
                                            @else
                                            <p>({{$item->children_count}}) <i class="fas fa-arrow-alt-circle-right"></i></p>
                                            @endif
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                    @empty
                        
                    @endforelse
                   
                  
                </div>
              
            </div>
        </section>
        <!--=====================================
                    CATEGORY PART END
        =======================================-->
@stop