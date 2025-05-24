@extends('apps::frontend.layouts.app')
@section('title', __("user::frontend.office.title"))
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
                                <li class="breadcrumb-item active" aria-current="page">@lang("user::frontend.office.title")</li>
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
                                <h3>@lang("user::frontend.office.title")</h3>
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

                            
                            <form class="setting-form" method="POST" enctype="multipart/form-data"  action="{{route('frontend.office.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.title")</label>
                                            <input type="text" 
                                                        name="title"
                                                        value="{{optional($office)->title ?? old('title')}}"
                                                        class="form-control  @error('name') is-invalid @enderror" 
                                                        
                                                        placeholder="@lang("user::frontend.office.title")">

                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.description")</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                name="description" 
                                                placeholder="@lang('user::frontend.office.description')">{{optional($office)->description ?? old('description')}}</textarea>
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror       
                                        </div>

                                       
                                        </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.mobile")</label>
                                            <input type="text" 
                                                    class="form-control @error('mobile') is-invalid @enderror" 
                                                    value="{{optional($office)->mobile ?? old('mobile')}}"
                                                    name="mobile"
                                                    placeholder="@lang("user::frontend.office.mobile")">
                                            @error('mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror       
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.country_id")</label>
                                            <select name="country_id" id="office_country" class="form-control selected">
                                                @php($selctedCountryId = optional($office)->country_id ?? old('country_id') )
                                              
                                                @foreach ($countries as $country )
                                                    <option {{$selctedCountryId == $country->id ? "selected" : ""}} value="{{$country->id}}"> {{$country->translateOrDefault(locale())->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror   
                                        </div>
                                        
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.city_id")</label>
                                            <select name="city_id" id="office_city" disabled 
                                                    data-current="{{optional($office)->city_id ?? old('city_id')}}" 
                                                    class="form-control selected">
                                                
                                            </select>
                                            @error('city_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror   
                                        </div>
                                        
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.state_id")</label>
                                            <select name="state_id" id="office_state" disabled 
                                                    data-current="{{optional($office)->state_id ?? old('state_id')}}" class="form-control selected">
                                                
                                            </select>
                                            @error('state_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror   
                                        </div>
                                        
                                    </div>

                                 
                                   <?php
                                       $socials = optional($office)->socials;
                                       $socials = $socials ? collect($socials) : null;
                                   ?>
                        
                                     @foreach (\Modules\User\Enums\SocialType::getConstList() as $scoial)
                                       
                                       
                                        <?php
                                            
                                            $value = $socials ? $socials->firstWhere('key', $scoial) : null;
                                            
                                        ?>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    {{$scoial}}
                                                </label>
                                                <input type="hidden" name="socials[{{$loop->index}}][key]" value="{{$scoial}}" class="form-control" >
                                                <input type="text" name="socials[{{$loop->index}}][link]" value="{{optional($value)['link']}}" 
                                                        class="form-control @error("socials.{$loop->index}.link") is-invalid @enderror" 
                                                        data-name="">
                                                @error("socials.{$loop->index}.link")
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror  
                                            </div>
                                        </div>
                                        
                                    @endforeach

                                    <div class="col-lg-6"></div>
                                    
                                   
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.office.image")</label>
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
                                            <img src="{{url(optional($office)->image ?? $user->image)}}" width="100" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <button class="btn btn-inline">
                                            <i class="fas fa-user-check"></i>
                                            <span>@lang("user::frontend.office.save")</span>
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

@section('scripts')

<script>
    $(function() {
        var office_country  = $("#office_country")
        var office_city     = $("#office_city") 
        var office_state    = $("#office_state")  

        //reset option 
        function resetOpion(_elm){
            _elm.html("");
            _elm.prop('disabled', true);
        }
        // handle address
        function handleCountryChangeData(office_country){
            var value = office_country.val()
            var url   = "{{route('api.areas.cities', ['country_id'=>'xid'])}}"
            
            if(value){
                office_country.prop('disabled', true)
                resetOpion(office_city)
                resetOpion(office_state)
                url = url.replace('xid', value);
            
                $.ajax(
                    {
                        headers: {
                            "lang" : "{{locale()}}" ,
                            'Content-Type':'application/json'
                        },
                        url,
                    success:(data)=>setOptionToCity(data.data),
                    error:(error)=>console.log(error)
                    }
                ).done(()=> office_country.prop('disabled', false) );
            
            }
        }

        office_country.change(function(){
            
          handleCountryChangeData(office_country)
        })

        handleCountryChangeData(office_country)


        function setOptionToCity(data){
            var options = "";
            var selectOption = office_city.data("current")

            for (const option of data) {
                    options += `<option data-states=${JSON.stringify(option.states)} value="${option.id}" ${option.id == selectOption ? "selected" :""} >${option.title}</option>`
            }
           
            office_city.html(options);
            office_city.change()
            office_city.prop('disabled', false);
         }

        function handleCityChange(office_city){
            var optionSelected = office_city.find("option:selected")
            var data   = optionSelected.data("states");
            setOptionToState(data ? data : [] )
        }

        office_city.change(function(){
            handleCityChange(office_city)
        })

        function setOptionToState(data){
            var options = ""; 
            var selectOption = office_state.data("current")

            for (const option of data) {
                    options += `<option  value="${option.id}" ${option.id == selectOption ? "selected" :""} >${option.title}</option>`
            }
            office_state.html(options);
            office_state.change()
            office_state.prop('disabled', false);
        }

    })
</script>

@stop