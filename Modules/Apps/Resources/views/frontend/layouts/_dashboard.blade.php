@php
$user = auth()->user();
$user->loadCount("ads");
@endphp
<!--=====================================
                DASHBOARD HEADER PART START
        =======================================-->
        <section class="dash-header-part">
            <div class="container">
                <div class="dash-header-card">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="dash-header-left">
                                <div class="dash-avatar">
                                    <a href="#"><img src="{{url($user->image)}}" alt="avatar"></a>
                                </div>
                                <div class="dash-intro">
                                    <h4><a href="#">{{$user->name}}</a></h4>
                                    <h5>
                                        @if($user->type == "office")
                                        @lang("qsale::frontend.show.types.office")
                                        @else
                                        @lang("qsale::frontend.show.types.personal")
                                        @endif
                                    </h5>
                                    <ul class="dash-meta">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span>({{$user->phone_code ?? "‎+965"}}) {{$user->mobile}}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <span>{{$user->email}}</span>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="dash-header-right">
                                <div class="dash-focus dash-list">
                                    <h2>{{$user->ads_count}}</h2>
                                    <p>@lang("user::frontend.profile.list_ads")</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-header-alert alert fade show">
                                <p>@lang("user::frontend.profile.msg_header")</p>
                                <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-menu-list">
                                <ul>
                                    {{-- <li><a class="{{$active == 'dashboard' ? 'active' : ''}}" href="dashboard.html">@lang("user::frontend.profile.dashboard")</a></li> --}}
                                    <li><a class="{{$active == 'profile' ? 'active' : ''}}" href="{{route('frontend.user.my-profile')}}">@lang("user::frontend.profile.title")</a></li>
                                    <li><a class="{{$active == 'ads_post' ? 'active' : ''}}" href="{{route('frontend.user.create_ad')}}">@lang("user::frontend.profile.ad_post")</a></li>
                                    <li><a class="{{$active == 'ads' ? 'active' :''}}" href="{{route('frontend.user.my_ads')}}">@lang("user::frontend.profile.my_ads")</a></li>
                                    {{-- <li><a class="{{$active == 'settings' ? 'active':''}}" href="setting.html">settings</a></li> --}}
                                    <li><a class="{{$active == 'favorites' ? 'active':''}}" href="{{route('frontend.user.my_favorites')}}">@lang("user::frontend.profile.favorites")</a></li>
    
                                    <li><a  href="{{route('frontend.logout')}}">@lang("apps::frontend.layout.aside.logout")</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                DASHBOARD HEADER PART END
        =======================================-->
        <div class="container">

            @include("apps::frontend.layouts._message")

            


        </div>
      