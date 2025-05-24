@if(session()->has("success"))
<div class="dash-header-alert alert fade show mb-2">
    <p> {{session("success")}} </p>
    <button data-dismiss="alert"><i class="fas fa-times"></i></button>
</div>
@endif

@if(session()->has("error"))
<div class="dash-header-alert alert fade show mb-2" style="border-right-color:red">
    <p> {{session("error")}} </p>
    <button data-dismiss="alert"><i class="fas fa-times" style="color: red!important"></i></button>
</div>
@endif

@if(config("app.have_sms") && request()->route()->getName() != "frontend.user.verify" &&  auth()->check() && !auth()->user()->is_verified)
<div class="dash-header-alert alert fade show mb-2" style="border-right-color:red">
    <p> @lang("user::frontend.verified.must_verified") <a href="{{route('frontend.user.verify')}}">
        @lang("user::frontend.verified.verified")
    </a> </p>
    <button data-dismiss="alert"><i class="fas fa-times" style="color: red!important"></i></button>
</div>
@endif



