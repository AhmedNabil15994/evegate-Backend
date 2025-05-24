@extends('apps::frontend.layouts.app')
@section('title', __('authentication::frontend.reset.title') )
@section('content')
<div class="banner-home library-head-banner page-head " >
    <div class="container">
        <div class="library-header ">
           <h1> {{ setting('app_name',locale()) }} </h1>
        </div>
    </div>
</div>

<div class="inner-page login-page">
    <div class="container" style="margin-top: 5%">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login-form">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <center>
                            {{ session('status') }}
                        </center>
                    </div>
                    @endif

                    @error('token')
                        <div class="alert alert-danger" role="alert">
                            <center>
                                {{ $message }}
                            </center>
                        </div>
                    @enderror

                    <div style="margin: 40px 0px">
                        <h2 class="text-muted text-center h1 " >{{ __('authentication::frontend.reset.title') }}</h1>
                    </div>
                  
                    <form class="login" method="POST" action="{{ route('frontend.password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class=" form-group">
                                <div class="row">
                                        <div class="col-md-4">
                                            <label >
                                                {{ __('authentication::frontend.reset.form.email') }}
                                                <span class="note-impor">*</span>
                                            </label>
                                        </div> 
            
                                        <div class="col-md-8">
                                            <input type="email" value="{{ $email ?? old('email') }}" autocomplete="off" name="email" class="input-text @error('email') is-invalid @enderror form-control ">
                                            @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>
                            
                           
                        </div>

                        <div class=" form-group">
                            <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            {{ __('authentication::frontend.reset.form.password') }}
                                            <span class="note-impor">*</span>
                                        </label>
                                    </div> 
        
                                    <div class="col-md-8">
                                        <input type="password" name="password" class="input-text @error('password') is-invalid @enderror form-control " >
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                            </div>
                        
                       
                        </div>


                        <div class=" form-group">
                            <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            {{ __('authentication::frontend.reset.form.password_confirmation') }}
                                            <span class="note-impor">*</span>
                                        </label>
                                    </div> 
        
                                    <div class="col-md-8">
                                        <input type="password" name="password_confirmation" class="input-text  form-control">
                                       
                                    </div>
                            </div>
                        
                       
                        </div>

                        

                        

                        <div class="" style="margin: 40px 0px">
                            <input type="submit" value="{{  __('authentication::frontend.reset.form.btn.reset') }}" class="button-submit btn-block btn-lg btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
