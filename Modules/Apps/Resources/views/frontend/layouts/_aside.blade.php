 <!--=====================================
                    SIDEBAR PART START
        =======================================-->
        <aside class="sidebar-part">
            <div class="sidebar-body">
                <div class="sidebar-header">
                    <a href="{{route('frontend.home')}}" class="sidebar-logo"><img src="/frontend/images/logo.png" alt="logo"></a>
                    <button class="sidebar-cross"><i class="fas fa-times"></i></button>
                </div>
                <div class="sidebar-content">
                    <div class="sidebar-profile">
                        @auth
                                <a href="#" class="sidebar-avatar"><img src="{{url(auth()->user()->image)}}" alt="avatar"></a>
                                <h4><a href="#" class="sidebar-name">{{auth()->user()->name}}</a></h4>
                        @endauth
                     
                        <a href="ad-post.html" class="btn btn-inline sidebar-post">
                            <i class="fas fa-plus-circle"></i>
                            <span>@lang("apps::frontend.layout.aside.post_ads")</span>
                        </a>
                    </div>
                    <div class="sidebar-menu">
                        <ul class="nav nav-tabs">
                            <li><a href="#main-menu" class="nav-link active" data-toggle="tab">@lang("apps::frontend.layout.aside.main_menu")</a></li>
                            @auth
                            <li><a href="#author-menu" class="nav-link" data-toggle="tab">@lang("apps::frontend.layout.aside.author_menu")</a></li>
                            @endauth
                        </ul>

                        <div class="tab-pane active" id="main-menu">
                            <ul class="navbar-list">
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.home')}}">@lang("apps::frontend.home.route")</a></li>
                                <li class="navbar-item navbar-dropdown">
                                    <a class="navbar-link" href="#">
                                        <span>@lang("apps::frontend.layout.aside.category_list")</span>
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <ul class="dropdown-list">
                                        @forelse ($mainCategories as $category)
                                            @php
                                                    $url = "#";
                                                    if($category->is_end_category || $category->children_count == 0)
                                                        $url = route("frontend.ads.index", ["category"=>$category->translateOrDefault(locale())->slug]);
                                                    if($category->children_count > 0) $url = route("frontend.categories.show", $category->translateOrDefault(locale())->slug );
                                                @endphp
                                               <li><a class="dropdown-link" href="{{$url}}">{{$category->translateOrDefault(locale())->title}}</a></li>
                                        @empty

                                        @endforelse
                                     
                                        
                                    </ul>
                                </li>
                               
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.ads.index')}}">
                                    @lang("apps::frontend.layout.aside.ads_list")
                                </a></li>
                              
                                
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.contact_us')}}">
                                    @lang("apps::frontend.layout.aside.contact_us")
                                </a></li>
                            </ul>
                        </div>

                        @auth
                        <div class="tab-pane" id="author-menu">
                            <ul class="navbar-list">
                                {{-- <li class="navbar-item"><a class="navbar-link" href="dashboard.html">Dashboard</a></li> --}}
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.user.my-profile')}}">@lang("apps::frontend.layout.aside.profile")</a></li>
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.user.create_ad')}}">@lang("apps::frontend.layout.aside.post_ads")</a></li>
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.user.my_ads')}}">@lang("apps::frontend.layout.aside.my_ads")</a></li>
                                <li class="navbar-item"><a class="navbar-link" href="{{route('frontend.user.my_favorites')}}">@lang("apps::frontend.layout.aside.favorite")</a></li>
                               
                                <li class="navbar-item">
                                    <a class="navbar-link"  href="{{route('frontend.logout')}}">@lang("apps::frontend.layout.aside.logout")</a>
                                   
                                </li>
                            </ul>
                        </div>
                        @endauth
                    </div>

                    <div class="sidebar-footer">
                        <p>@lang("apps::frontend.layout.footer.copyrights") <a href="#">Tocaan</a></p>
                        <p>@lang("apps::frontend.layout.footer.developed_by")<a href="#">Tocaan</a></p>
                    </div>
                </div>
            </div>
        </aside> 
        <!--=====================================
                    SIDEBAR PART END
        =======================================-->


        <!--=====================================
                    MOBILE-NAV PART START
        =======================================-->
        <nav class="mobile-nav">
            <div class="container">
                <div class="mobile-group">
                    <a href="index.html" class="mobile-widget">
                        <i class="fas fa-home"></i>
                        <span>home</span>
                    </a>
                    <a href="user-form.html" class="mobile-widget">
                        <i class="fas fa-user"></i>
                        <span>@lang("apps::frontend.layout.header.join_now")</span>
                    </a>
                    <a href="ad-post.html" class="mobile-widget plus-btn">
                        <i class="fas fa-plus"></i>
                        <span>@lang("apps::frontend.layout.aside.post_ads")</span>
                    </a>
                  
                </div>
            </div>
        </nav>
        <!--=====================================
                    MOBILE-NAV PART END
        =======================================-->