@extends('apps::frontend.layouts.app')
@section('title', $ads->title)
@section("meta_description", $ads->description))

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
                        <li class="breadcrumb-item active" aria-current="page">{{$ads->title}}</li>
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


          <!--=====================================
                    AD DETAILS PART START
        =======================================-->
        <section class="inner-section ad-details-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            @if(!is_null($ads->price))
                            <div class="col-md-6 col-lg-6">
                                <!-- PRICE CARD -->
                                <div class="common-card price">
                                    <h3>{{$ads->price}}<span>{{currency()}}</span></h3>
                                    <i class="fas fa-tag"></i>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6 col-lg-6">
                                <!-- NUMBER CARD -->
                                <button type="button" class="common-card number" data-toggle="modal" data-target="#number">
                                <h3>({{$ads->view}})<span>@lang("qsale::frontend.show.click_show")</span></h3>
                                    <i class="fas fa-phone"></i>
                                </button>
                            </div>
                        </div>

                        <!-- AD DETAILS CARD -->
                        <div class="common-card">
                            <ol class="breadcrumb ad-details-breadcrumb">
                                @foreach ($ads->category->ancestors as $ancestor)
                                <li class="breadcrumb-item"><a href="#">{{$ancestor->translateOrDefault(locale())->title}}</a></li>
                                @endforeach
                                <li class="breadcrumb-item active" aria-current="page">{{$ads->category->translateOrDefault(locale())->title}}</li>
                            </ol>
                            @foreach ($ads->address as $address)
                            <h5 class="ad-details-address">{{ $address->getAddress() }}</h5>
                            @endforeach
                            <h3 class="ad-details-title">{{$ads->title}}</h3>
                            <div class="ad-details-meta">
                                <a class="view">
                                    <i class="fas fa-eye"></i>
                                    <span><strong>({{$ads->view}})</strong>preview</span>
                                </a>
                               
                            </div>
                            <div class="ad-details-slider-group">
                                <div class="ad-details-slider slider-arrow">
                                    <div><img src="{{$ads->getFirstMediaUrl("default_image") ?? url('/uploads/default.png')}}" alt="details"></div>
                                    @foreach ($ads->getMedia("attachs") as $media)
                                     <div><img src="{{$media->getUrl()}}" alt="details"></div>
                                        
                                    @endforeach
                                </div>
                                
                                @if($speical = $ads->checkIsType(\Modules\QSale\Enum\AddationType::NORMAL))
                                <div class="cross-vertical-badge ad-details-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>{{$speical->name}}</span>
                                </div>
                                @endif

                            </div>
                            <div class="ad-thumb-slider">
                                <div><img src="{{$ads->getFirstMediaUrl("default_image") ?? url('/uploads/default.png')}}" alt="details"></div>
                                @foreach ($ads->getMedia("attachs") as $media)
                                 <div><img src="{{$media->getUrl()}}" alt="details"></div>
                                    
                                @endforeach
                            </div>
                        <div class=" product-btn ad-details-action">
                                {{-- <button type="button"
                                  data-auth_check="{{auth()->check()}}"
                                  data-id="{{$ads->id}}"
                                 class="wish make-favourit"><i class="far fa-heart  {{$ads->is_favorite == 1 ? 'fas' :''}} "></i></button> --}}
                                {{-- <button type="button"><i class="fas fa-exclamation-triangle"></i>report</button> --}}
                                {{-- <button type="button" data-toggle="modal" data-target="#ad-share">
                                    <i class="fas fa-share-alt"></i>
                                    share
                                </button> --}}
                                <button type="button" 
                                    data-auth_check="{{auth()->check()}}"
                                    data-id="{{$ads->id}}"
                                    data-have_favorite="true"
                                    title="Wishlist" class="far fa-heart make-favourit  {{$ads->
                                    is_favorite == 1 ? 'fas isFavourit' :''}}"></button>
                            </div>
                        </div>

                        <!-- SPECIFICATION CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">@lang("qsale::frontend.show.specification")</h5>
                            </div>
                            <ul class="ad-details-specific">
                                <li>
                                    <h6>@lang("qsale::frontend.show.price") :</h6>
                                    <p>{{ $ads->price ?? "---" }} {{currency()}}</p>
                                </li>
                                <li>
                                    <h6>@lang("qsale::frontend.show.seller_type") :</h6>
                                    <p>@if($ads->office_id)
                                        @lang("qsale::frontend.show.types.office")
                                        @else
                                        @lang("qsale::frontend.show.types.personal")
                                        @endif
                                    </p>
                                </li>
                                <li>
                                    <h6>@lang("qsale::frontend.show.published") :</h6>
                                    <p>{{$ads->start_at}}</p>
                                </li>
                                <li>
                                    <h6>@lang("qsale::frontend.show.location") :</h6>
                                    @foreach ($ads->address as $address)
                                    <p class="ad-details-address">{{ $address->getAddress() }}</p>
                                    @endforeach
                                    
                                </li>
                                <li>
                                    <h6>@lang("qsale::frontend.show.category") :</h6>
                                    <p>{{$ads->category->translateOrDefault(locale())->title}}</p>
                                </li>

                                @foreach ($ads->attributes as $attribute)
                                <li>
                                    <h6>{{$attribute->attribute->name}} :</h6>
                                    <p>
                                        @if($attribute->option)
                                            {{$attribute->option->value}}
                                        @else
                                            {{$attribute->value}}
                                        @endif
                                        
                                    </p>
                                </li>
                                @endforeach
                               
                            </ul>
                        </div>

                        <!-- DESCRIPTION CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">@lang("qsale::frontend.show.description")</h5>
                            </div>
                            <p class="ad-details-desc">{{$ads->description}}</p>
                        </div>

                       

                        <!-- AUTHOR CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title">@lang(("qsale::frontend.show.user_info"))</h5>
                            </div>
                            <div class="ad-details-author">
                                <a href="#" class="author-img active">
                                    <img src="{{url($ads->user->image)}}" alt="avatar">
                                </a>
                                <div class="author-meta">
                                    <h4><a href="#">{{$ads->user->name}}</a></h4>
                                    <h5>@lang("qsale::frontend.show.joined") {{$ads->user->created_at->format("d-m-Y h:i a")}}</h5>
                                  
                                </div>
                              
                                <ul class="author-list">
                                    <li><h6>@lang("qsale::frontend.show.total_ads")</h6><p>{{$ads->user->ads_count}}</p></li>
                                    {{-- <li><h6>total ratings</h6><p>78</p></li> --}}
                                    {{-- <li><h6>total follower</h6><p>56</p></li> --}}
                                </ul>
                            </div>
                        </div>

                      

                        
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    AD DETAILS PART END
        =======================================-->


         <!--=====================================
              PROFILE SHARE MODAL PART END
        =======================================-->


        <!--=====================================
                  NUMBER MODAL PART START
        =======================================-->
        <div class="modal fade" id="number">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>@lang("qsale::frontend.show.contact_number")</h4>
                        <button class="fas fa-times" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="modal-number">
                            @if(!$ads->hide_private_number)
                                ( {{ $ads->phone_code.$ads->user->mobile}})
                            @endif
                            <br/>
                            ( {{$ads->mobile}} )
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!--=====================================
                  NUMBER MODAL PART END
        =======================================-->

@stop