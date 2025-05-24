@extends('apps::frontend.layouts.app')
@section('title', __("qsale::frontend.routes.index"))


@section("custom_css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

@stop

@section("banner-content")
 <!--=====================================
                  SINGLE BANNER PART START
=======================================-->
<section class="inner-section  single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>@lang("qsale::frontend.routes.index")</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">@lang("apps::frontend.home.route")</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> @lang("qsale::frontend.routes.index")</li>
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
                    AD LIST PART START
        =======================================-->
        <form action="{{route('frontend.ads.index')}}" id="searchForm" >
            <section class="inner-section ad-list-part">
                <div class="container">
                    <div class="row content-reverse">
                        <div class="col-lg-4 col-xl-3">

                            {{-- side  --}}
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="product-widget">
                                        <h6 class="product-widget-title">@lang("qsale::frontend.index.filter_price")</h6>
                                        <form class="product-widget-form">
                                            <div class="product-widget-group">
                                                <input type="text" value="{{$request->input("price.min")}}"  name="price[min]" placeholder="min - 00">
                                                <input type="text" value="{{$request->input("price.max")}}"  name="price[max]"  placeholder="max - 1B">
                                            </div>
                                            <button type="submit" class="product-widget-btn">
                                                <i class="fas fa-search"></i>
                                                <span>@lang("qsale::frontend.index.search")</span>
                                            </button>
                                        </form>
                                    </div> 
                                </div>
                            
                                <div class="col-md-6 col-lg-12">
                                    <div class="product-widget">
                                        <h6 class="product-widget-title">@lang("qsale::frontend.index.filter_by_address")</h6>
                                        <div class="product-widget-form">


                                            <div  class="product-widget-list">
                                                <select name="address[city_id]" data-selected="{{$request->input('address.city_id')}}" data-target="#city-search" class="custom-select filter-select city-select">
                                                    <option value="">@lang("qsale::frontend.index.city")</option>
                                                   
            
                                                </select>
                                            </div>
                                           

                                            <div  class="product-widget-list">
                                                <select name="address[state_id]" data-selected="{{$request->input('address.state_id')}}" id="city-search" class="custom-select filter-select ">
                                                    <option value="">@lang("qsale::frontend.index.state")</option>
                                                    
                                    
            
                                                </select>
                                            </div>
                                        
                                            <button type="submit" class="product-widget-btn form-button-submit">
                                                <i class="fas fa-broom"></i>
                                                <span>@lang("qsale::frontend.index.search")</span>
                                            </button>  
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-6 col-lg-12">
                                    <div class="product-widget">
                                        <h6 class="product-widget-title">@lang("qsale::frontend.index.filter_category")</h6>
                                        <div class="product-widget-form">
                                            <div class="product-widget-search">
                                                <input type="text" id="search_tree" placeholder="search">
                                                <input type="hidden" id="category_input" name="category"  >
                                            </div>
                                            <ul class="product-widget-list product-widget-scroll">
                                                <div id="jstree">
                                                    @include('qsale::frontend.tree.view',
                                                        ['mainCategories' => $mainCategories , "selected"=> [$request->category]])
                                                </div>
                                            </ul>
                                            <button type="submit" class="product-widget-btn clear_filter_category">
                                                <i class="fas fa-broom"></i>
                                                <span>@lang("qsale::frontend.index.clear_filter")</span>
                                            </button>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- container --}}

                        <div class="col-lg-8 col-xl-9">

                            <div  >
                                <input type="hidden" name="grid" value="{{$grid}}" >
                                <div class="row">

                                    {{-- controlle panel --}}
                                    <div class="col-lg-12">
                                        <div class="header-filter">
                                            <div class="filter-show">
                                                <label class="filter-label">@lang("qsale::frontend.index.show") :</label>
                                                <select class="custom-select filter-select form-select-submit " name="page_count">
                                                    <option value="15"
                                                    {{ $request->input('page_count') == 15 ||   !$request->input('page_count') ? 'selected' :'' }}
                                                    >15</option>
                                                    <option value="24" {{ $request->input('page_count') == 24 ? 'selected' :'' }}>24</option>
                                                    <option value="36" {{ $request->input('page_count') == 36 ? 'selected' :'' }} >36</option>
                                                </select>
                                            </div>
                                            <div class="filter-short">
                                                <label class="filter-label">@lang("qsale::frontend.index.show") :</label>
                                                <select class="custom-select filter-select form-select-submit" name="sorted_by">
                                                    <option value="latest" {{ $request->input('sorted_by') == 'latest' ? 'selected' :''}} >@lang("user::frontend.my_favorites.latest")</option>
                                                </select>
                                            </div>
                                            <div class="filter-action">
                                                <a href="{{route('frontend.ads.index', ['grid'=>'one_colum'])}}" title="Three Column" 
                                                    class="{{ $grid=== 'one_colum' ? 'active' :''}}"><i class="fas fa-th"></i></a>
                                                <a href="{{route('frontend.ads.index', ['grid'=>'two_colum'])}}" title="Two Column"
                                                    class="{{ $grid=== 'two_colum' ? 'active' :''}}"
                                                    ><i class="fas fa-th-large"></i></a>
                                                <a href="{{route('frontend.ads.index', ['grid'=>'three_colum'])}}" title="One Column"
                                                    class="{{ $grid=== 'three_colum' ? 'active' :''}}"
                                                    ><i class="fas fa-th-list"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    {{-- slider  --}}
                                    <div class="col-lg-12">
                                        <div class="ad-feature-slider slider-arrow">
                                            @foreach ($slider as $item)
                                            <div class="feature-card ">
                                                <a href="{{$item->type == 'out' || !$item->ads ? $item->url  : route('frontend.ads.show', optional($item->ads)->slug)}}" class="feature-img">
                                                    <img src="{{url($item->image)}}" alt="feature">
                                                </a>

                                                <div class="cross-inline-badge feature-badge">
                                                    <span>{{$item->type}}</span>
            
                                                    @if($item->type === "out")
                                                        <i class="fas fa-external-link"></i>
                                                    @else
                                                        <i class="fab fa-buysellads"></i>
                                                    @endif
                                                </div>

                                            
                                            
                                                <div class="feature-content">
                                                    
                                                    @if($item->ads)
                                                        <h3 class="feature-title"><a href="{{route('frontend.ads.show', optional($item->ads)->slug)}}">{{optional($item->ads)->title}}</a></h3>
                                                    @endif

                                                    <div class="feature-meta text-center">
                                                        <a href="{{$item->type == 'out' || !$item->ads ? $item->url  : route('frontend.ads.show', optional($item->ads)->slug)}}"
                                                            style="color: var(--primary)"
                                                            >
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                        
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                
                                    @forelse ($ads as $ad)
                                    <div class="{{$classAds}}">
                                        <div class="product-card {{$grid === 'one_colum' ? 'standard' : '' }}">
                                            
                                            <div class="product-media">
                                                <div class="product-img">
                                                    <img 
                                                    class="custom-img"
                                                    src="{{$ad->getFirstMediaUrl("default_image") ?  $ad->getFirstMediaUrl("default_image") : url('/uploads/default.png') }}" height="200" alt="product">
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
                                    </div>
                                    @empty
                                        <div class="col-sm-12 ">
                                            <div class="dash-header-alert alert fade show mb-2 ">
                                                <p class="text-center"> @lang("user::frontend.my_ads.empty")  <i class="fas fa-sad-tear"></i> </p>
                                                <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    @endforelse
                                    
                                
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="footer-pagection">
                                        <p class="page-info">@lang("user::frontend.my_ads.pagination", ["count"=> $ads->count() , "total"=> $ads->total()])</p>
                                        {{ $ads->appends($request->query())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
      </form>
        <!--=====================================
                    AD LIST PART END
        =======================================-->

@stop

@section("scripts")
{{-- scripts addd --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
    $(function(){
        var formElmentSelect = $(".form-select-submit")
        var formElmentButton = $(".form-button-submit")
        var formSearch       = $("#searchForm")
        var category_input   = $("#category_input")
        var laoding          =  @json($request->category ? false : true);

        // handle select submit
        formElmentSelect.change(function(){
            $(this).parents("form").submit()
            formSearch.submit()
        })

        // handle button filter
        formElmentButton.change(function(){
            formSearch.submit()
        })

        // handle tree
        $('#jstree').jstree({
            "core" : {
                "multiple" : false,
                
            },
            "plugins" : [ "search" ]
        });

        var toSearchJstreee = false;

        $('#search_tree').keyup(function () {
                if(toSearchJstreee) { clearTimeout(toSearchJstreee); }
                toSearchJstreee = setTimeout( () =>{
                    var v = $(this).val();
                    $('#jstree').jstree(true).search(v);
                }, 250);
        });


        $('#jstree').on("changed.jstree", function(e, data) {
                category_input.val(data.selected);
                if(laoding)
                    formSearch.submit()
                laoding = true   
                // alert(data.selected)
                // handleCategoryAttrbiute(data.selected)
        });

        $(".clear_filter_category").click(function(){
            event.preventDefault()
            category_input.val("")
            formSearch.submit()
            $('#jstree').jstree(true)
                       .deselect_all(true);
        })


    })
</script>
@stop