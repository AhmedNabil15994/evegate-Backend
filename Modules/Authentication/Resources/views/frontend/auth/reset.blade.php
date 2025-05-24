
<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">

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
        <title>{{__("authentication::frontend.reset.title")}} - {{ setting('app_name',locale()) }}</title>

        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FOR PAGE TITLE ICON -->
        <!-- FAVICON -->
        <link rel="icon" href="{{url(setting('favicon'))}}">

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

        <link rel="stylesheet" href="/admin/assets/global/plugins/bootstrap-toastr/toastr.min.css">

        @if(locale() == "ar")
            <link rel="stylesheet" href="/admin/assets/global/plugins/bootstrap-toastr/toastr-rtl.min.css">

        @endif

    </head>
    <body>
        <!--=====================================
                    USER-FORM PART START
        =======================================-->
        <section class="user-form-part">
            <div class="user-form-banner">
                <div class="user-form-content">
                    <a href="#"><img src="{{ url(setting('logo') ?? '/frontend/images/logo.png')  }}" alt="logo"></a>
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


                <div>
                    <h2 class="text-center">
                        @lang("authentication::frontend.reset.title")
                    </h2>

                    <form class="mt-4" action="{{route('frontend.post_forget')}}" method="POST">

                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" name="phone_code" id="phone_code" value="965" />
                                <input type="text" class="form-control mobile @error('mobile') is-invalid @enderror"
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
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="time text-danger"></span>
                                    <button  class="resend  btn-link">@lang("authentication::frontend.forget.resend")</button>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="number" class="form-control @error('code') is-invalid @enderror"
                                                 value=""
                                                 name="code"
                                                 autocomplete="off"
                                                 placeholder="@lang('authentication::frontend.forget.code')">
                                        <small class="form-alert">@lang('authentication::frontend.forget.code')</small>
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
                                <button type="submit" class="btn btn-inline">
                                    <i class="fas fa-user-check"></i>
                                    <span>@lang('authentication::frontend.forget.reset')</span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>



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
        <script src="/admin/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>

        <!--=====================================
                    JS LINK PART END
        =======================================-->
        @include('apps::frontend.layouts._js')
        <script>
            $(function(){
                var resend      = $(".resend")
                var time        = $(".time")
                var disabled   = 0
                var count       = 0
                var interval    = null
                var phone_code  = $("#phone_code")
                var mobile      = $(".mobile")

                if(disabled){
                    timer()
                }

                function timer(){
                    count = 10
                    time.html(count)
                    resend.prop("disabled", true );
                    resend.hide()
                    time.show()

                    interval  = setInterval(function(){
                        count--;
                        time.html(count)
                        if(count == 0 ){
                            clearInterval(interval)
                            resend.prop( "disabled", false );
                            time.hide()
                            resend.show()
                        }
                    }, 1000)

                }

                resend.click(function(event){

                    event.preventDefault();
                    if(mobile.val().length == 0){
                        $alert("{{__('authentication::frontend.forget.mobile_required')}}", "error")
                        return
                    }
                    var _elm = $(this)
                    let url = "{{route('api.auth.password.resend')}}"
                    _elm.prop('disabled', true);



                    $.ajax(
                            {
                            url: url,
                            method:"post",
                            headers: {
                                "lang" : "{{locale()}}"
                            },
                            data:{
                                "phone_code":phone_code.val() ,
                                "mobile": mobile.val(),
                            },
                            error:function(error){
                                var msg = error.statusText
                                if(error.responseJSON.errors.mobile){
                                    msg = error.responseJSON.errors.mobile[0]
                                }

                                $alert(msg, "error")
                                _elm.prop('disabled', false);
                            },
                            success: function(result){

                                $alert("success", result.data.message)

                                timer()
                                _elm.prop('disabled', false)

                            }}

                        )

                })
            })
        </script>
    </body>
</html>






