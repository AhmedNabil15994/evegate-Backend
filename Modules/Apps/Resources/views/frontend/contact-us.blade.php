@extends('apps::frontend.layouts.app')
@section('title', __("apps::frontend.contact_us.title"))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/contact.css">
@stop
@section("meta_keywords", "Contact us")

@section("banner-content")
<!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
        <section class="single-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>@lang("apps::frontend.contact_us.title")</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('frontend.home') }}">
                                        <i class="ti-home"></i> {{ __('apps::frontend.home.route') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang("apps::frontend.contact_us.title")</li>
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
            CONTACT PART START
=======================================-->
<section class="contact-part">
    <div class="container">
        <div class="row">
            {{-- <div class="col-lg-4">
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Find us</h3>
                    <p>1Hd- 50, 010 Avenue, NY <span> 90001 United States</span></p>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="contact-info">
                    <i class="fas fa-phone-alt"></i>
                    <h3>@lang("apps::frontend.contact_us.make_call")</h3>
                    <p>{{setting("contact_us", "whatsapp")}}</span></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <h3>@lang("apps::frontend.contact_us.send_email")</h3>
                    <p>{{setting("contact_us", "email")}}</p>
                </div>
            </div>
        </div>
        @include("apps::frontend.layouts._message")
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-map">
                    <iframe src="{{ setting('location') ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3654.3406974350205!2d90.48469931445422!3d23.663771197998262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b0d5983f048d%3A0x754f30c82bcad3cd!2sJalkuri%20Bus%20Stop!5e0!3m2!1sen!2sbd!4v1605354966349!5m2!1sen!2sbd' }}"></iframe>
                </div>
            </div>
            <div class="col-lg-6">
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
               
                <form class="contact-form" method="POST" action="{{route('frontend.send-contact-us')}}" id="demo-form">
                    @csrf
                    <input type="hidden" name="type" value="contact">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                        name="username" 
                                        value="{{old('username')}}"
                                        placeholder="@lang('apps::frontend.contact_us.form.username')"
                                >
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" 
                                        value="{{old('email')}}"
                                        placeholder="@lang('apps::frontend.contact_us.form.email')">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror" 
                                name="mobile" 
                                value="{{old('mobile')}}"
                                placeholder="@lang('apps::frontend.contact_us.form.mobile')"
                                
                                >
                                @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                        name="message" 
                                        placeholder="@lang('apps::frontend.contact_us.form.message')">{{old('message')}}</textarea>
                                @error('message')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror       
                            </div>
                        </div>

                       
                        <div class="col-lg-12 mb-2">
                            <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.sitekey')}}"
                            data-callback="allowSubmit"
                            data-expired-callback="disableSubmit"
                            ></div>
                        </div>

                       
                        <div class="col-lg-12">
                            <div class="form-btn">
                                <button class="btn btn-inline"
                                disabled
                                id="submit"
                                >
                                    <i class="fas fa-paper-plane"></i>
                                    <span>@lang("apps::frontend.contact_us.form.btn.send")</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            CONTACT PART END
=======================================-->
@stop

@section("scripts")
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
      function allowSubmit(){
         document.getElementById("submit").disabled = false
      }
      function disableSubmit(){
         document.getElementById("submit").disabled = true
      }
  </script>
@stop