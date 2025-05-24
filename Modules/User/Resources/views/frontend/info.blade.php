@extends('apps::frontend.layouts.app')
@section('title', __("user::frontend.info.title"))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/setting.css">
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
                            <h2>@lang("user::frontend.info.title")</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontend.home') }}">
                                        <i class="ti-home"></i> {{ __('apps::frontend.home.route') }}</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontend.user.my-profile') }}">
                                        <i class="ti-home"></i>@lang("user::frontend.profile.title")</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang("user::frontend.info.title")</li>
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
                    SETTING PART START
        =======================================-->
        <div class="setting-part">
            <div class="container">
                @include("apps::frontend.layouts._message")
                <div class="row">



                    <div class="col-lg-12">
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>@lang("user::frontend.info.title")</h3>
                                {{-- <button data-dismiss="alert">close</button> --}}
                            </div>

                            @if ($errors->any())
                                <div class="container">
                                    <div class="alert alert-danger alert-dismissible fade show">

                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="p-2">{{ $error }}</li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            @endif


                            <form class="setting-form" method="POST" enctype="multipart/form-data"  action="{{route('frontend.user.edit_info.save')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.info.name")</label>
                                            <input type="text"
                                                        name="name"
                                                        value="{{$user->name}}"
                                                        class="form-control  @error('name') is-invalid @enderror"

                                                        placeholder="@lang("user::frontend.info.name")">

                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.info.email")</label>
                                            <input type="email"
                                                    autocomplete="off"
                                                    name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{$user->email}}"
                                                    placeholder="@lang("user::frontend.info.email")">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.info.mobile")</label>
                                            <input type="text"
                                                    class="form-control @error('mobile') is-invalid @enderror"
                                                    value="{{$user->mobile}}"
                                                    name="mobile"
                                                    placeholder="@lang("user::frontend.info.mobile")">
                                            @error('mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.info.password")</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                    name="password"
                                            
                                                    autocomplete="new-password"
                                                    placeholder="@lang("user::frontend.info.password").">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.info.password_confirmation")</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="@lang("user::frontend.info.password_confirmation")."
                                                    name="password_confirmation"
                                                    >
                                            @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.info.image")</label>
                                            <input type="file"
                                                    name="image"
                                                     class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <img src="{{url($user->image)}}" width="100" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button class="btn btn-inline">
                                            <i class="fas fa-user-check"></i>
                                            <span>@lang("user::frontend.info.title")</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--=====================================
                    SETTING PART END
        =======================================-->

@stop
