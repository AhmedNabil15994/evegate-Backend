
@extends('apps::frontend.layouts.app')
@section('title', __("user::frontend.create_ads.title"))
@section("custom_css")
<link rel="stylesheet" href="/frontend/css/custom/ad-post.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

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
                    <h2>@lang("user::frontend.my_ads.title")</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('frontend.home') }}">
                                <i class="ti-home"></i> {{ __('apps::frontend.home.route') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">@lang("user::frontend.create_ads.title")</li>
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

@include("apps::frontend.layouts._dashboard",["active"=>'ads_post'])

    <form action={{route('frontend.ads.save_ad')}} method="POST" enctype="multipart/form-data">
        @csrf
  <!--=====================================
                    ADPOST PART START
        =======================================-->
        <section class="adpost-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="adpost-form" >
                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>@lang("user::frontend.create_ads.ad_info")</h3>
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


                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.create_ads.title")</label>
                                            <input type="text" name="title"
                                                value="{{old('title')}}"
                                                class="form-control  @error('title') is-invalid @enderror"
                                              placeholder="@lang("user::frontend.create_ads.ad_info")">
                                              @error('title')
                                                    <div class="text-danger">{{ $message }}</div>
                                              @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.create_ads.description")</label>
                                            <textarea
                                            name="description"
                                            class="form-control  @error('description') is-invalid @enderror"
                                            >{{ old('description')}}</textarea>
                                            @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                          
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.create_ads.price")</label>
                                            <input type="text" name="price"
                                                value="{{old('price')}}"
                                                class="form-control  @error('price') is-invalid @enderror"
                                              placeholder="@lang("user::frontend.create_ads.price")">
                                              @error('price')
                                                    <div class="text-danger">{{ $message }}</div>
                                              @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.create_ads.mobile")</label>
                                            <input type="text" name="mobile"
                                                value="{{old('mobile')}}"
                                                class="form-control  @error('mobile') is-invalid @enderror"
                                              placeholder="@lang("user::frontend.create_ads.mobile")">
                                              @error('mobile')
                                                    <div class="text-danger">{{ $message }}</div>
                                              @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.create_ads.hide_private_number")</label>
                                            <input type="checkbox" name="hide_private_number"
                                                value="1"
                                                @if(old("hide_private_number")) checked @endif
                                                class="form-check  @error('hide_private_number') is-invalid @enderror"
                                              placeholder="@lang("user::frontend.create_ads.ad_info")">
                                              @error('hide_private_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                              @enderror
                                        </div>
                                    </div>



                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">@lang("user::frontend.create_ads.image")</label>
                                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">
                                            @error('hide_private_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Product Category</label>
                                            <select class="form-control custom-select">
                                                <option selected>Select Category</option>
                                                <option value="1">property</option>
                                                <option value="2">electronics</option>
                                                <option value="3">automobiles</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" placeholder="Enter your pricing amount">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">@lang("user::frontend.create_ads.addations")</label>
                                                </li>

                                                
                                                @foreach ($addations as $addation )
                                                    <li>
                                                        <input type="checkbox" 
                                                            name="addations[]" 
                                                            value="{{$addation->id}}" 
                                                         
                                                            class="form-check" id="fix-check-{{$addation->id}}">
                                                        <label for="fix-check-{{$addation->id}}" class="form-check-text">{{$addation->name}}</label>
                                                    </li>
                                                @endforeach
                                               
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <ul class="form-check-list">
                                                <li>
                                                    <label class="form-label">@lang("user::frontend.create_ads.ad_types")</label>
                                                </li>

                                                
                                                @foreach ($ad_types as $adType )
                                                    <li>
                                                        <input type="checkbox" 
                                                            name="ad_types[]" 
                                                            value="{{$adType->id}}" 
                                                         
                                                            class="form-check" id="fix-check-{{$adType->id}}">
                                                        <label for="fix-check-{{$adType->id}}" class="form-check-text">{{$adType->name}}</label>
                                                    </li>
                                                @endforeach
                                               
                                            </ul>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                            </div>


                            <div class="adpost-card py-2">
                                <div class="adpost-title">
                                    <h3>@lang("user::frontend.create_ads.attaches")</h3>
                                </div>
                                <div class="row">

                                    @error('hide_private_number')
                                            <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-12 col-lg-12" id="cloneFrom">
                                        <div class="form-group">
                                            <input type="file" name="attachs[]" class="form-control  @error('attachs') is-invalid @enderror">
                                        </div>
                                    </div>

                                    <div id="add_more" class="col-md-12 col-lg-12">

                                    </div>

                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-success add-attachs"> + </button>
                                    </div>
                                    

                                </div>
                            </div>



                            <div class="adpost-card">
                                <div class="adpost-title">
                                    <h3>@lang("user::frontend.create_ads.address")</h3>
                                </div>


                                @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="" id="contianer-address">

                                    @error('address.*')
                                       <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="row group_address"  >
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label class="">
                                                    {{ __('user::frontend.create_ads.country_id') }}
                                                </label>
                                                <div class="">
                                                    <select name="address[0][country_id]"  class="form-control select2 country-address">
                                                        @foreach ($countries as $country )
                                                            <option 
                                                            {{$country->id == old("address.0.country_id") ? "selected" : "" }}
                                                            value="{{$country->id}}"> {{$country->translateOrDefault(locale())->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            

                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="">
                                                    {{ __('qsale::dashboard.ads.form.city_id') }}
                                                </label>
                                                <div class="">
                                                    <select name="address[0][city_id]" id="city" disabled data-current="{{old("address.0.city_id")}}" class="form-control city-address" >
                                                    
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="">
                                                    {{ __('qsale::dashboard.ads.form.state_id') }}
                                                </label>
                                                <div class="">
                                                    <select name="address[0][state_id]" id="state" disabled data-current="{{old("address.0.state_id")}}" class="form-control state-address">
                                                    
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>

                                        

                                    </div>

                                </div>

                                <div class="text-center p-2">
                                    <button class="btn btn-success" id="addAddress"> + </button>
                                   
                                  
                                </div>


                                {{-- ============ --}}

                                <div class="d-none " id="copyCounty" style="display: none">
                                    <div class="row group_address"  >
            
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="">
                                                    {{ __('qsale::dashboard.ads.form.country_id') }}
                                                </label>
                                                <div class="">
                                                    <select name="address[:id_stub][country_id]"  class="form-control  country-address" >
                                                        @foreach ($countries as $country )
                                                            <option value="{{$country->id}}"> {{$country->translateOrDefault(locale())->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="">
                                                    {{ __('qsale::dashboard.ads.form.city_id') }}
                                                </label>
                                                <div class="col-md-9">
                                                    <select name="address[:id_stub][city_id]"  disabled data-current="" class="form-control city-address" >
                                                       
                                                    </select>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-md-3">
            
                                            <div class="form-group">
                                                    <label class="">
                                                        {{ __('qsale::dashboard.ads.form.state_id') }}
                                                    </label>
                                                    <div class="">
                                                        <select name="address[:id_stub][state_id]"  disabled data-current="" class="form-control state-address" >
                                                        
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-danger delete-address" >X</button>
                                        </div>
            
            
                                    </div>
                                </div>

                                {{-- =============== --}}

                                    
                            </div>
                            <div class="adpost-card pb-2">
                                
                                <div class="form-group text-right">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>@lang("user::frontend.create_ads.published_ads")</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>@lang("user::frontend.create_ads.category")</h3>
                                {{-- <button data-dismiss="alert">close</button> --}}
                            </div>
                            <ul class="account-card-text">
                                <input type="hidden" id="category_id" name="category_id">
                                <div id="jstree">
                                    @include('qsale::frontend.tree.create',
                                        ['mainCategories' => $mainCategories , "selected"=> [old("category_id")]])
                                </div>
                                @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </ul>
                        </div>
                        <div class="account-card alert fade show">
                            <div class="account-title">
                                <h3>@lang("user::frontend.create_ads.custom_attribute")</h3>
                                {{-- <button data-dismiss="alert">close</button> --}}
                            </div>

                            @error('adsAttributes.*')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="account-card-form" id="attrbiutes">
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================
                    ADPOST PART END
        =======================================-->
    </form>

@stop

@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
    $(function(){
        var attachsAddButton = $(".add-attachs")
        var attachsContainer = $("#add_more")


        //============ ====== ========  handle attach added =========
        attachsAddButton.click(function(event){
            event.preventDefault();
           
            var template = `
            <div class="col-md-12 col-lg-12 clone-add" >
                       <div class="row no-gutters ">
                           
                            <div class="form-group col-md-10">
                                <input type="file" name="attachs[]" class="form-control ">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger deleteAttach">X</button>
                            </div>
                       </div>
            </div>
            `
            attachsContainer.append(template)
        })

        $("body").on("click",".deleteAttach", function(){
            event.preventDefault();
            $(this).parents(".clone-add").remove()
        })
        // ===================== ============== ==========

        // handle tree
         $('#jstree').jstree({
            "core" : {
                "multiple" : false,
                
            },
            "plugins" : [ "search" ]
        });

        $('#jstree').on("changed.jstree", function(e, data) {
                $("#category_id").val(data.selected);
                handleCategoryAttrbiute(data.selected)
        });

        //handle attribute
        var attributes = $("#attrbiutes")

        function handleCategoryAttrbiute(categroy_id){
        attributes.html("");
        if(categroy_id){
            var url   = "{{route('api.attributes',['category_id'=>'xid'])}}"
            url = url.replace('xid', categroy_id);
            $.ajax(
                {
                    method:"GET",
                    headers: {
                        "lang" : "{{locale()}}" ,
                        'Content-Type':'application/json'
                    },
                    url,
                   success:(data)=>handleCategoryAttrbiuteDraw(data.data),
                   error:(error)=>console.log(error)
                }
            );
        }
    }

    function handleCategoryAttrbiuteDraw(data){
        var attrbitueinput = ""
        console.log(data)
        var key = 0
        for (const attribute of data) {
           
            attrbitueinput += drawAttrbiute(attribute, key)
            key++
        }
       
        attributes.html(attrbitueinput);
    }

    function drawAttrbiute(data ,key = 0){
       
        var input = inputDraw(data, key )
        
       
        var html = `
        <div class="form-group">
            <label >
                ${data.name}
                
            </label>
             <div >
                <input type="hidden" name="adsAttributes[${key}][attribute_id]" value="${data.id}"/>
                 ${input}
               <div class="help-block"></div>
             </div>
            </div>
        `;
        return html;
    }

    function inputDraw(data, key = 0){
        var input = "";
        
        if(data.type == "drop_down"){
              var options = "";
              for (const option of data.options) {
                  options += `<option value="${option.id}">${option.value}</option>`
              }
              input = `<select class="form-control" ${data.validation.required  == 1 ? 'required' : ''}  name="adsAttributes[${key}][option_id]">
                    ${options}
                </select>`
        }
        else if(data.type == "radio"){
           
           let radio = `<div class"row">`
           for (const option of data.options) {
                radio += `
                   <div class="col-md-4">
                       <label for="radi_${option.id}">${option.value}</label>
                       <input type="radio" name="adsAttributes[${key}][option_id]" id="radi_${option.id}" value="${option.id}">
                   </div>
                `
           }
           input += radio + "</div>"
        }
        else if(data.type == "boolean"){
           
            input = `<input type="checkbox"   class="" value="1"  checked name="adsAttributes[${key}][value]" >`
        }
        else{
            input = `<input type="${data.type}" ${data.validation.required  == 1 ? 'required' : ''}  class="form-control"  name="adsAttributes[${key}][value]" >`
        }
       
        return input 
    }

    // handle the address

     // ================================ address ======================
     var copyCounty = $("#copyCounty");
    copyCounty = copyCounty.html()
    $("#copyCounty").remove();
    var contianerAddress = $("#contianer-address")
    var addAddress       = $("#addAddress")
    var addressIncrement = 1;
    // handle country address
    $("body").on("change",".country-address", function(){
        var _elment = $(this)
        var _contianter = _elment.parents("div.group_address");
        var _city = _contianter.find(".city-address")
        var _state = _contianter.find(".state-address")
       
        handleCountryChangeData(_elment, _city, _state)
        
        // var cittElment = 
        
    })

    $("body").on("change",".city-address", function(){
        var _elment = $(this)
        var _contianter = _elment.parents("div.group_address");
        var _state = _contianter.find(".state-address")
        handleCityChange(_elment, _state)
    
    })

    $("body").on("click",".delete-address", function(event){
        event.preventDefault();
        var _elment = $(this)
        var _contianter = _elment.parents("div.group_address");
       
        _contianter.remove();
    
    })
    addAddress.click(function(event){
        event.preventDefault();
        var html = copyCounty;
        html = $(html.replace(/:id_stub/gi , addressIncrement))

        var _elment = html.find(".country-address").last()
        var _contianter = _elment.parents("div.group_address");
        var _city = _contianter.find(".city-address")
        var _state = _contianter.find(".state-address")
        // console.log(html)
        contianerAddress.append(html)
        handleCountryChangeData(_elment, _city, _state)
        addressIncrement ++

    
    })

    $(".country-address").each(function(){
      
        var _elment = $(this)
        var _contianter = _elment.parents("div.group_address");
        var _city = _contianter.find(".city-address")
        var _state = _contianter.find(".state-address")

       
        handleCountryChangeData(_elment, _city, _state)
    })

    // =================== =================== ================= =============

    // method and event for country
    function handleCountryChangeData(country, cityElment=null, stateElment=null)
    {
        var value = country.val()
        var url   = "{{route('api.areas.cities', ['country_id'=>'xid'])}}"
        cityElment = cityElment? cityElment : city;
        stateElment = stateElment ? stateElment : state;
        
        if(value){
            country.prop('disabled', true)
            resetOpion(cityElment)
            resetOpion(cityElment)
            url = url.replace('xid', value);
           
            $.ajax(
                {
                    headers: {
                        "lang" : "{{locale()}}" ,
                        'Content-Type':'application/json'
                    },
                    url,
                   success:(data)=>setOptionToCity(data.data, cityElment),
                   error:(error)=>console.log(error)
                }
            ).done(()=> country.prop('disabled', false) );
           
        }
    }

    
    

      // hande city
    function resetOpion(_elm){
           _elm.html("");
           _elm.prop('disabled', true);
    }

    function setOptionToCity(data, elment= null){
          var options = "";
          elment = elment? elment : city          
          var selectOption = elment.data("current")
           
           for (const option of data) {
                options += `<option data-states='${JSON.stringify(option.states)}' value="${option.id}" ${option.id == selectOption ? "selected" :""} >${option.title}</option>`
           }
           elment.html(options);
           elment.change()
           elment.prop('disabled', false);
    }

    function handleCityChange(city, elment = null)
    {
          var optionSelected = city.find("option:selected")
          var data   = optionSelected.data("states");
          
          setOptionToState(data ? data : [] , elment)
    }

   

    function setOptionToState(data, elment= null){
          
          var options = ""; 
          elment = elment ? elment : state
          var selectOption = elment.data("current")
        
          for (let index = 0; index < data.length; index++) {
              const object = data[index];
             
              options += `<option  value="${object.id}" ${object.id == selectOption ? "selected" :""} >${object.title}</option>`
           
              
          }
               
          elment.html(options);
          elment.change()
          elment.prop('disabled', false);
     }

    //  end handle country 



    //==================================


    })
</script>
@stop