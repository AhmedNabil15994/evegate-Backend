@php($request = request())
@extends('apps::frontend.layouts.app')
@section('title', __("user::frontend.my_ads.title"))
@section("custom_css")

<link rel="stylesheet" href="/frontend/css/custom/my-ads.css">
@stop

@section("banner-content")
<!--=====================================
                  SINGLE BANNER PART START
=======================================-->
<section class="single-banner dashboard-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>@lang("user::frontend.my_ads.title")</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('frontend.home') }}">
                                <i class="ti-home"></i> {{ __('apps::frontend.home.route') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@lang("user::frontend.my_ads.title")</li>
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

@include("apps::frontend.layouts._dashboard",["active"=>'ads'])

<!--=====================================
            MY ADS PART START
=======================================-->
<section class="myads-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form id="formFilter">
                    <div class="header-filter">
                        <div class="filter-show">
                            <label class="filter-label">@lang("user::frontend.my_ads.show") :</label>
                            <select name="page_count" class="custom-select filter-select formItems">
                                <option value="15" {{ $request->input('page_count') == 15 ||   !$request->input('page_count') ? 'selected' :'' }}>15</option>
                                <option value="24" {{ $request->input('page_count') == 24 ? 'selected' :'' }}>24</option>
                                <option value="36" {{ $request->input('page_count') == 36 ? 'selected' :'' }} >36</option>
                            </select>
                        </div>
                        <div class="filter-short">
                            <label class="filter-label"># @lang("user::frontend.my_ads.sort_by") :</label>
                            <select class="custom-select filter-select formItems" name="sorted_by">
                                <option value="latest" {{ $request->input('sorted_by') == 'latest' ? 'selected' :''}} >@lang("user::frontend.my_ads.latest")</option>
                                
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ads --}}
        <div class="row">
            @forelse ($ads as $ad)
                
            

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="product-card">
                    <div class="product-media">
                        <div class="product-img">
                            <img class="custom-img" height="250" src="{{$ad->getFirstMediaUrl("default_image") ?  $ad->getFirstMediaUrl("default_image") : url('/uploads/default.png')}}" height="150'" alt="product">
                        </div>
                        {{-- <div class="cross-vertical-badge product-badge">
                            <i class="fas fa-fire"></i>
                            <span>top niche</span>
                        </div> --}}
                        <div class="product-type">
                            <span class="flat-badge booking">{{$ad->status}}</span>
                        </div>
                        <ul class="product-action">
                            <li class="view"><i class="fas fa-eye"></i><span>{{$ad->view}}</span></li>
                           
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
                            <a href="#">{{$ad->title}}</a>
                        </h5>
                        <div class="product-meta">
                            @if($address = $ad->address->first())
                            <span><i class="fas fa-map-marker-alt"></i> {{$address->getAddress()}}</span>
                            @endif
                            @php(\Carbon\Carbon::setLocale(locale()))
                           
                            <span><i class="fas fa-clock"></i> {{$ad->published_at->diffForHumans()}}</span>
                        </div>
                        <div class="product-info">
                            
                                @if(!$ad->is_paid)
                                 <a href="{{route('frontend.ads.preview_payment', $ad->id)}}">@lang("qsale::frontend.preview_payment.paid")</a>
                                @endif

                                @if(!$ad->checkIsPublish() && $ad->status != "wait")
                                 <a href="{{route('frontend.ads.republished', $ad->id)}}">@lang("user::frontend.my_ads.republish")</a>
                                @endif
                            
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-sm-12 ">
                <div class="dash-header-alert alert fade show mb-2 ">
                    <p class="text-center"> @lang("user::frontend.my_ads.empty")  <i class="fas fa-sad-tear"></i> </p>
                    <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                </div>
            </div>
            @endforelse
          
            
        </div>

        {{-- pagantion --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-pagection">
                    <p class="page-info">@lang("user::frontend.my_ads.pagination", ["count"=> $ads->count() , "total"=> $ads->total()])</p>
                    {{-- <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fas fa-long-arrow-alt-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">...</li>
                        <li class="page-item"><a class="page-link" href="#">67</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </li>
                    </ul> --}}
                    {{ $ads->appends($request->query())->links() }}
                </div>
            </div>
        </div>

    </div>
</section>
<!--=====================================
            MY ADS PART END
=======================================-->


@stop

@section("scripts")
<script>
    $(function(){
        var formFilter = $("#formFilter") ,
            formItems  = $(".formItems");
        
        formItems.change(function(){
            $(this).parents("form").submit()
        })    
    
    })
</script>
@stop