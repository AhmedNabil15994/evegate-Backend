@extends('apps::frontend.layouts.app')
@section('title', __("user::frontend.verified.title"))
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

               
                    <div class="container">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                            
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="p-2">{{ $error }}</li>
                                    @endforeach
                                </ul>
                                
                            </div>
                        @endif


                        <div class="">
                            <form  action="{{route("frontend.user.verified")}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">@lang("user::frontend.verified.code_verified")</label>
                                    <input type="text" name="code"
                                        value=""
                                        class="form-control  @error('code') is-invalid @enderror"
                                    placeholder="@lang('user::frontend.verified.code_verified')">
                                        @error('code')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div>
                                    <span class="time"></span>
                                    <button  class="resend  btn-link">@lang("user::frontend.verified.resend")</button>
                                </div>
                                

                                <div>
                                    <button class="btn btn-success btn-block">@lang("user::frontend.verified.verified")</button>
                                </div>
                            </form>
                        </div>
                    </div>


                
                <form>

                </form>
            </div>
        </section>
        <!--=====================================
                    PROFILE PART END
        =======================================-->
@stop

@section("scripts")
<script>
    $(function(){
        var resend      = $(".resend")
        var time        = $(".time")
        var disabled   = 0
        var count       = 0
        var interval    = null
        
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
            var _elm = $(this)
            let url = "{{route('api.auth.password.resend')}}"
            _elm.prop('disabled', true);

            $.ajax(
                    {url: url, 
                    method:"post",
                    data:{  
                        "phone_code":"{{$user->phone_code ?? '965'}}" ,
                        "mobile": "{{$user->mobile }}"
                    },
                    error:function(error){
                        console.log(error)
                        $alert(error.statusText, "error")
                        _elm.prop('disabled', false);
                    },    
                    success: function(result){
                        
                        $alert("success", result.data.message)

                        timer()
                        _elm.prop('disabled', false);

                    }}
                   
                )
            
        })
    })
</script>
@stop