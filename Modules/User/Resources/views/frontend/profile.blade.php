@extends('apps::frontend.layouts.app')
@section('title', __("user::frontend.profile.title"))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/profile.css">
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
                            <h2>@lang("user::frontend.profile.title")</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontend.home') }}">
                                        <i class="ti-home"></i> {{ __('apps::frontend.home.route') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang("user::frontend.profile.title")</li>
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

@include("apps::frontend.layouts._dashboard",["active"=>'profile'])

<!--=====================================
                    PROFILE PART START
        =======================================-->
        <section class="profile-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h3>@lang("user::frontend.profile.info")</h3>
                                <a href="{{route('frontend.user.edit_info')}}">@lang("user::frontend.profile.edit")</a>
                            </div>
                            <ul class="account-card-list">
                                <li><h5>@lang("user::frontend.profile.name")</h5><p>{{$userProfile->name}}</p></li>
                                <li><h5>@lang("user::frontend.profile.joined")</h5><p>{{ $userProfile->created_at->format("d-m-Y h:i a") }}</p></li>
                                <li><h5>@lang("user::frontend.profile.status")</h5><p>
                                    @if($userProfile->is_active)
                                        <i class="fas fa-thumbs-up"></i>
                                    @else
                                         <i class="fas fa-thumbs-down"></i>
                                    @endif
                                </p></li>
                                <li><h5>@lang("user::frontend.profile.verify")</h5><p>
                                    @if($userProfile->is_active)
                                        <i class="fas fa-user-check"></i>
                                   @else
                                            <i class="fas fa-user-lock"></i>
                                    @endif
                                    </p></li>
                            </ul>
                        </div>
                        @if($office =$userProfile->office)
                        <div class="account-card">
                            <div class="account-title">
                                <h3>@lang("user::frontend.profile.office")</h3>
                                <a href="{{route('frontend.office.create')}}">@lang("user::frontend.profile.edit")</a>
                            </div>
                            <ul class="account-card-list">
                                <li><h5>@lang("user::frontend.profile.office_title") :</h5><p>{{$office->title}}</p></li>
                                <li><h5>@lang("user::frontend.profile.description") :</h5><p>{{$office->description}}</p></li>
                                <li><h5>@lang("user::frontend.profile.mobile"):</h5><p>{{$office->mobile}}</p></li>
                                <li><h5>@lang("user::frontend.profile.status")</h5><p>
                                    @if($userProfile->is_active)
                                        <i class="fas fa-thumbs-up"></i>
                                    @else
                                         <i class="fas fa-thumbs-down"></i>
                                    @endif
                                </p></li>
                            </ul>
                        </div>
                        @else
                        <div class="account-card">
                            <div class="account-title">
                                <h3>@lang("user::frontend.profile.office")</h3>
                                <a href="{{route('frontend.office.create')}}">@lang("user::frontend.profile.create")</a>
                            </div>
                            
                        </div>
                        @endif
                    </div>

                    @if($currentSubscription = $userProfile->currentSubscription)
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h3>@lang("user::frontend.profile.subscription")</h3>
                                {{-- <a href="setting.html">@lang("user::frontend.profile.edit")</a> --}}
                            </div>
                            <ul class="account-card-list">
                                <li><h5>@lang("user::frontend.profile.package_id")</h5><p>{{$currentSubscription->package->title}}</p></li>
                                <li><h5>@lang("user::frontend.profile.start_at"):</h5><p>{{$currentSubscription->start_at}}</p></li>
                                <li><h5>@lang("user::frontend.profile.end_at"):</h5><p>{{$currentSubscription->end_at}}</p></li>
                                <li><h5>@lang("user::frontend.profile.current_use"):</h5><p>{{$currentSubscription->current_use}}</p></li>
                                <li><h5>@lang("user::frontend.profile.max_use"):</h5><p>{{$currentSubscription->max_use}}</p></li>

                            </ul>
                        </div>
                        
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!--=====================================
                    PROFILE PART END
        =======================================-->
@stop