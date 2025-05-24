 @php
     $request = request();
 @endphp
 <!--=====================================
                    HEADER PART START
        =======================================-->
        <header class="header-part">
            <div class="container">
                <div class="header-content">
                    <div class="header-left">
                        <button type="button" class="header-widget sidebar-btn">
                            <i class="fas fa-align-right"></i>
                        </button>
                        <a href="/" class="header-logo">
                            <img src="{{ url( setting('logo') ??  '/frontend/images/logo.png' ) }}" alt="logo">
                        </a>
                        @guest
                        <a href="{{route('frontend.login')}}" class="header-widget header-user">
                           
                                <img src="/frontend/images/user.png" alt="user">
                                <span>@lang("apps::frontend.layout.header.join_now")</span>
                           
                           
                        </a>
                        @else
                        <a href="{{route('frontend.user.my-profile')}}" class="header-widget header-user">
                                    <img src="{{url(auth()->user()->image)}}" alt="user">
                                    <span>{{auth()->user()->name}}</span>

                            </a>
                        @endguest
                        <button type="button" class="header-widget search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <form class="header-form" action="{{route('frontend.ads.index')}}">
                        <div class="header-search">
                            <button type="submit" title="Search Submit "><i class="fas fa-search"></i></button>
                            <input type="text" name="search" value="{{$request->search}}"  placeholder="@lang('apps::frontend.layout.header.search')">
                            <button type="button" title="Search Option" class="option-btn"><i class="fas fa-sliders-h"></i></button>
                        </div>
                        <div class="header-option">
                            <div class="option-grid">
                                <div class="option-group">
                                    <select name="address[city_id]" data-selected="{{$request->input('address.city_id')}}" data-target="#city-header" class="custom-select filter-select city-select">
                                        <option value="">@lang("qsale::frontend.index.city")</option>
                                       

                                    </select>
                                </div>
                                <div class="option-group">
                                    <select name="address[state_id]" data-selected="{{$request->input('address.state_id')}}" id="city-header" class="custom-select filter-select ">
                                        <option value="">@lang("qsale::frontend.index.state")</option>
                        

                                    </select>
                                </div>
                                <div class="option-group"><input type="text" value="{{$request->input("price.min")}}"  name="price[min]" placeholder="Min Price"></div>
                                <div class="option-group"><input type="text"  value="{{$request->input("price.max")}}"  name="price[max]" placeholder="Max Price"></div>
                                <button type="submit"><i class="fas fa-search"></i><span>@lang("apps::frontend.layout.header.search")</span></button>
                            </div>
                        </div>
                    </form>
                    <div class="header-right">
                        <ul class="header-list">
                            {{-- favourit --}}
                            <li class="header-item">
                                <a href="{{route('frontend.user.my_favorites')}}" class="header-widget">
                                    <i class="fas fa-heart"></i>
                                    <sup class="container_favourit">{{$favoritesCount}}</sup>
                                </a>
                            </li>

                        </ul>
                        <a href="{{route('frontend.user.create_ad')}}" class="btn btn-inline post-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>@lang("apps::frontend.layout.header.post_ads")</span>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <!--=====================================
                    HEADER PART END
        =======================================-->
{{--  --}}