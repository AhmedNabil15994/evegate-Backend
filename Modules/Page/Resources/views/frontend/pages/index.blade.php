@extends('apps::frontend.layouts.app')
@section('title', "index")
@section("meta_keywords", strip_tags($page->translateOrDefault(locale())->seo_keywords))
@section("meta_description", strip_tags($page->translateOrDefault(locale())->seo_description))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/about.css">
@stop

@section("banner-content")

<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>{{$page->translateOrDefault(locale())->title}}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">@lang("apps::frontend.home.route")</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$page->translateOrDefault(locale())->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

@stop


@section('content')

<!--=====================================
                RECOMEND PART START
=======================================-->
<section class="section recomend-part">
    <div class="container">
        {!! $page->translateOrDefault(locale())->description !!}
    </div>
</section>
<!--=====================================
            RECOMEND PART START
=======================================-->

@stop