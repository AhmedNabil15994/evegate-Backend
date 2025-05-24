@extends('apps::frontend.layouts.app')
@section('title', __("apps::frontend.home.route"))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/index.css">
@stop

@section("banner-content")
<section class="banner-part" style="background: url('/frontend/images/bg/01.jpg')!important;">
    <div class="container">
        <div class="banner-content">
            <h1>@lang("apps::frontend.home.header_msg")</h1>
            <p>@lang("apps::frontend.home.header_content")</p>
            <a href="ad-list-column3.html" class="btn btn-outline">
                <i class="fas fa-eye"></i>
                <span>@lang("apps::frontend.home.button_all")</span>
            </a>
        </div>
    </div>
</section>
@stop

@section('content')

<!--=====================================
            SUGGEST PART START
=======================================-->
<section class="suggest-part">
    <div class="container">
        <div class="suggest-slider slider-arrow">
            @forelse ($mainCategories as $category)
                @php
                    $url = "#";
                    if($category->is_end_category || $category->children_count == 0)
                         $url = route("frontend.ads.index", ["category"=>$category->translateOrDefault(locale())->slug]);
                    if($category->children_count > 0) $url = route("frontend.categories.show", $category->translateOrDefault(locale())->slug );
                @endphp
                <a href="{{$url}}" class="suggest-card">
                    <img class="custom-img-cover" src="{{url($category->image)}}" alt="{{$category->translateOrDefault(locale())->title}}">
                    <h6>{{$category->translateOrDefault(locale())->title}}</h6>
                    {{-- <p>(4,521) ads</p> --}}
                </a>
            @empty
                
            @endforelse
            
           
        </div>
    </div>
</section>
<!--=====================================
            SUGGEST PART END
=======================================-->

<!--=====================================
                    RECOMEND PART START
=======================================-->
<section class="section recomend-part">


    
    <div class="container">


        @include("apps::frontend.layouts._message")

        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>@lang("apps::frontend.home.recommend") <span>@lang("apps::frontend.home.ads")</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="recomend-slider slider-arrow">

                    @forelse ($adsRecommend as $ad)
                      
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                    <img class="custom-img" src="{{$ad->getFirstMediaUrl("default_image") ?  $ad->getFirstMediaUrl("default_image") : url('/uploads/default.png')}}" height="100" alt="product">
                                </div>

                                @if($speical = $ad->checkIsType(\Modules\QSale\Enum\AddationType::NORMAL))
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-clipboard-check"></i>
                                        <span>{{$speical->name}}</span>
                                    </div>
                                @endif
                                
                                <ul class="product-action">
                                    <li class="view"><i class="fas fa-eye"></i><span>{{$ad->view}}</span></li>
                                    {{-- <li class="click"><i class="fas fa-mouse"></i><span>134</span></li>
                                    <li class="rating"><i class="fas fa-star"></i><span>4.5/7</span></li> --}}
                                </ul>
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    @foreach ($ad->category->ancestors as $ancestor)
                                    <li class="breadcrumb-item"><a href="#">{{$ancestor->translateOrDefault(locale())->title}}</a></li>
                                    @endforeach
                                    
                                    <li class="breadcrumb-item active" aria-current="page">{{$ad->category->translateOrDefault(locale())->title}}</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('frontend.ads.show', $ad->slug ?? $ad->id )}}">{{$ad->title}}</a>
                                </h5>
                                <div class="product-meta">
                                    @if($address = $ad->address->first())
                                    <span><i class="fas fa-map-marker-alt"></i> {{$address->getAddress()}}</span>
                                    @endif
                                    @php(\Carbon\Carbon::setLocale(locale()))
                                    <span><i class="fas fa-clock"></i> {{$ad->published_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    @if($ad->price)
                                    <h5 class="product-price">{{$ad->price}}<span>{{currency()}}</span></h5>
                                    @endif
                                    <div class="product-btn">
                                        <a href="{{route('frontend.ads.show', $ad->slug ?? $ad->id )}}" title="view" class="fas fa-compress"></a>
                                        <button type="button" 
                                                        data-auth_check="{{auth()->check()}}"
                                                        data-id="{{$ad->id}}"
                                                        title="Wishlist" class="far fa-heart make-favourit {{$ad->is_favorite == 1 ? 'fas' :''}}"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                    
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="center-50">
                    <a href="{{route("frontend.ads.index")}}" class="btn btn-inline">
                        <i class="fas fa-eye"></i>
                        <span>@lang("apps::frontend.home.all")</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            RECOMEND PART START
=======================================-->

@stop