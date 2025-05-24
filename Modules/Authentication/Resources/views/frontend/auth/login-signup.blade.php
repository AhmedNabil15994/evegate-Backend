
<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">
    @php
        $tab = old("tab") ?? "login";
    @endphp
    <head>
        <!--=====================================
                    META-TAG PART START
        =======================================-->
        <!-- REQUIRE META -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- AUTHOR META -->


        <!-- TEMPLATE META -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keywords" content="classicads, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
        <meta name="description" content="{{ strip_tags(setting('how_its_work', locale() ) )}}">
        <link rel="canonical" href="{{url()->current()}}"/>
        <!--=====================================
                    META-TAG PART END
        =======================================-->

        <!-- FOR WEBPAGE TITLE -->
        <title>{{__("authentication::frontend.login.title")}} - {{ setting('app_name',locale()) }}</title>

        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE TITLE ICON -->
        <!-- FAVICON -->
        <link rel="icon" href="{{url(setting('favicon') ?? '/frontend/images/logo.png' )}}">

        <!-- FOR FONTAWESOME -->
        <link rel="stylesheet" href="/frontend/fonts/font-awesome/fontawesome.css">

        <!-- FOR BOOTSTRAP -->
        <link rel="stylesheet" href="/frontend/css/vendor/bootstrap.min.css">

        <!-- FOR COMMON STYLE -->
        <link rel="stylesheet" href="/frontend/css/custom/main-{{is_rtl()}}.css">

        <!-- FOR USER FORM PAGE STYLE -->
        <link rel="stylesheet" href="/frontend/css/custom/user-form.css">
        <!--=====================================
                    CSS LINK PART END
        =======================================-->
    </head>
    <body>
        <!--=====================================
                    USER-FORM PART START
        =======================================-->
        <section class="user-form-part">
            <div class="user-form-banner">
                <div class="user-form-content">
                    <a href="#"><img src="{{ asset(setting('logo')) ?? '/frontend/images/logo.png' }}" alt="logo"></a>
                    <h1>@lang("authentication::frontend.login.content.msg_side_head") .</h1>
                    <p>@lang("authentication::frontend.login.content.msg_side_content") .</p>
                </div>
            </div>

            <div class="user-form-category">
                <div class="user-form-header">
                    <a href="#"><img src="/frontend/images/logo.png" alt="logo"></a>
                    <a href="{{route('frontend.home')}}"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="user-form-category-btn">
                    <ul class="nav nav-tabs">
                        <li><a href="#login-tab" class="nav-link {{$tab =='login' ? 'active' : ''}}" data-toggle="tab">@lang("authentication::frontend.login.title")</a></li>
                        <li><a href="#register-tab" class="nav-link {{$tab =='register' ? 'active' : ''}}" data-toggle="tab">@lang("authentication::frontend.register.title")</a></li>
                    </ul>
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


                @if (session()->has('message'))
                    <div class="dash-header-alert alert fade show mb-2">
                        <p> {{session("message")}} </p>
                        <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                    </div>
                @endif

                <div class="tab-pane {{$tab =='login' ? 'active' : ''}}" id="login-tab">
                    <div class="user-form-title">
                        <h2>@lang("authentication::frontend.login.form.msg")</h2>
                        <p>@lang("authentication::frontend.login.form.desc")</p>
                    </div>
                    <form action="{{route('frontend.post_login')}}" method="POST">
                        @csrf
                        <input type="hidden" name="tab" value="login" >
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <input type="hidden" name="phone_code" value="965" />
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="@lang('authentication::frontend.login.form.mobile')">
                                    <small class="form-alert">@lang('authentication::frontend.login.form.mobile')</small>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="pass" placeholder="@lang('authentication::frontend.login.form.password')">
                                    <button type="button" class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">@lang('authentication::frontend.login.form.password')</small>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" id="signin-check">
                                        <label class="custom-control-label" for="signin-check">@lang("authentication::frontend.login.form.remember_me")</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-right">
                                    <a href="{{route('frontend.forget')}}" class="form-forgot">@lang("authentication::frontend.login.form.btn.forget_password")</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-unlock"></i>
                                        <span>@lang("authentication::frontend.login.form.btn.login")</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="user-form-direction">
                        <p> @lang("authentication::frontend.login.form.footer_note")<span>(@lang("authentication::frontend.register.title"))</span> @lang("authentication::frontend.login.form.footer_note2")</p>
                    </div>
                </div>


                {{-- ========== register ======== --}}

                <div class="tab-pane {{$tab =='register' ? 'active' : ''}} " id="register-tab">
                    <div class="user-form-title">
                        <h2>@lang("authentication::frontend.register.title")</h2>
                        <p>@lang("authentication::frontend.register.form.msg")</p>
                    </div>

                    <form method="POST" action="{{route('frontend.register')}}">
                        @csrf
                        <input type="hidden" name="tab" value="register" />
                        <div class="row">


                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                             value="{{old('name')}}"
                                             name="name"
                                             placeholder="@lang('authentication::frontend.register.form.name')">
                                    <small class="form-alert">@lang('authentication::frontend.register.form.name')</small>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" name="phone_code" value="965" />
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                             value="{{old('mobile')}}"
                                             name="mobile"
                                             placeholder="@lang('authentication::frontend.register.form.mobile')">
                                    <small class="form-alert">@lang('authentication::frontend.register.form.mobile')</small>
                                    @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                            value="{{old('email')}}"
                                            name="email"
                                            placeholder="@lang('authentication::frontend.register.form.email')">
                                    <small class="form-alert">@lang('authentication::frontend.register.form.email')</small>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password"
                                    autocomplete="new-password"
                                    class="form-control
                                      @error('password') is-invalid @enderror "
                                      name="password"
                                       placeholder="@lang('authentication::frontend.register.form.password')">
                                    <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">@lang('authentication::frontend.register.form.password')</small>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password"
                                     name="password_confirmation"
                                     class="form-control  @error('password_confirmation') is-invalid @enderror" placeholder="@lang('authentication::frontend.register.form.password_confirmation')">
                                    <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">@lang('authentication::frontend.register.form.password_confirmation')</small>
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree_policy" class="custom-control-input @error('agree_policy') is-invalid @enderror" id="signup-check">
                                        <label class="custom-control-label" for="signup-check">@lang("authentication::frontend.register.form.agree") <a target="_blank" href="{{route('frontend.pages.index', $term->translateOrDefault(locale())->slug)}}">@lang("authentication::frontend.register.btn.policy_privacy")</a> </label>
                                        @error('agree_policy')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-user-check"></i>
                                        <span>@lang("authentication::frontend.register.title")</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="user-form-direction">
                        <p>@lang("authentication::frontend.register.form.footer_note")<span>(@lang("authentication::frontend.login.title"))</span> @lang("authentication::frontend.register.form.footer_note2").</p>
                    </div>
                </div>

                {{-- ============= --}}


            </div>
        </section>
        <!--=====================================
                    USER-FORM PART END
        =======================================-->


        <!--=====================================
                    JS LINK PART START
        =======================================-->
        <!-- FOR BOOTSTRAP -->
        <script src="/frontend/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="/frontend/js/vendor/popper.min.js"></script>
        <script src="/frontend/js/vendor/bootstrap.min.js"></script>

        <!-- FOR INTERACTION -->
        <script src="/frontend/js/custom/main.js"></script>
        <!--=====================================
                    JS LINK PART END
        =======================================-->
    </body>
</html>






