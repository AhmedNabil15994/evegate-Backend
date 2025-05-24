@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.ads.routes.update'))
@section('css')
    <style>
        .image-content{
            position: relative;
            height: 150px;
            margin-bottom: 10px;
        }
        .image-elment{
            position: absolute;

        }
        .image-head{
            top: 0;
            left: 0px;
            width: 100%;
            height: 100%;;
        }
        .danger{
            background: red;
        }
    </style>
@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('dashboard.ads.index')) }}">
                        {{__('qsale::dashboard.ads.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('qsale::dashboard.ads.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.ads.update',$model->id)}}">
                @csrf
                @method('PUT')
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">

                                            <li class="active">

                                                <a href="#general" data-toggle="tab">
                                                    {{ __('qsale::dashboard.ads.form.tabs.general') }}
                                                </a>
                                            </li>

                                              <li class="">
                                                <a href="#user" data-toggle="tab">
                                                    {{ __('qsale::dashboard.ads.form.tabs.user') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#attachs" data-toggle="tab">
                                                    {{ __('qsale::dashboard.ads.form.tabs.attachs') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#categories" data-toggle="tab">
                                                    {{ __('qsale::dashboard.ads.form.tabs.categories') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#attrbiutes" data-toggle="tab">
                                                    {{ __('qsale::dashboard.ads.form.tabs.attrbiutes') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                            {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- CREATE FORM --}}
                            <div class="tab-pane active fade in" id="general">
                                <h3 class="page-title">{{ __('qsale::dashboard.ads.form.tabs.general') }}</h3>
                                <div class="col-md-10">




                                     <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.title') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="title" value="{{$model->title}}" class="form-control" data-name="title">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.description') }}
                                        </label>
                                        <div class="col-md-9">
                                            <textarea type="text" name="description" rows="8" cols="80" class="form-control " data-name="description">{{$model->description}} </textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.sort') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" min="0" name="sort" id="sort" class="form-control " data-name="sort" value="{{$model->sort}}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.price') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" min="0" value="{{$model->price}}" name="price" id="price" class="form-control " data-name="price">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.mobile') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="mobile" value="{{$model->mobile}}"  id="mobile" class="form-control " data-name="mobile">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.hide_private_number') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" @if($model->hide_private_number) checked @endif value="1"  id="hide_private_number" data-size="small" name="hide_private_number">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                        {{ __('qsale::dashboard.ads.datatable.user_type') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" disabled value="{{$model->user_type}}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.country_id') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="country_id"  class="form-control select2 country-address">
                                                @foreach ($countries as $country )
                                                    <option value="{{$country->id}}"
                                                         {{$model->country_id == $country->id ? 'selected' : ''}}> {{$country->translateOrDefault(locale())->title}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.image') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{__('apps::dashboard.buttons.upload')}}
                                                    </a>
                                                </span>
                                                <input name="image" class="form-control image" type="file" >

                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                                <img src="{{optional($model->getFirstMedia("default_image"))->getUrl()}}" style="height: 15rem;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.status') }}
                                        </label>
                                       <div class="col-md-9">
                                            <select class="form-control select2" name="status">

                                                @foreach (Modules\QSale\Enum\AdsStatus::getConstList() as $status )
                                                    @if(!in_array($status, ["wait"]))
                                                      <option value="{{$status}}" {{$model->status == $status ? "selected" : ""}} >{{$status}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                       </div>
                                    </div>




                                    {{-- <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.addations') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="addations[]" id="addations" class="form-control select2" multiple data-name="addations.*" >
                                                @foreach ($addations as $addation )
                                                    <option value="{{$addation->id}}"
                                                        {{$model->addations->contains("addation_id", $addation->id) ? "selected" : ""}}
                                                        > {{$addation->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.ad_types') }}
                                        </label>


                                        <div class="col-md-9">
                                            <select name="ad_types[]" id="ad_types" class="form-control select2" multiple data-name="ad_types.*" >
                                                @foreach ($ad_types as $ad_type )
                                                    <option value="{{$ad_type->id}}"
                                                        {{$model->adTypes->contains("id", $ad_type->id) ? "selected" : ""}}
                                                        > {{$ad_type->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    @if ($model->trashed())
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('apps::dashboard.buttons.restore')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="restore">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    @endif


                                </div>
                            </div>
                            {{-- END CREATE FORM --}}

                            {{-- CREATE FORM --}}
                            <div class="tab-pane  fade in" id="user">
                                <h3 class="page-title">{{ __('qsale::dashboard.ads.form.tabs.user') }}</h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.user_id') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="user_id" id="user_id" disabled class="form-control select2" data-name="user_id">
                                                @foreach ($users as $user )
                                                    <option value="{{$user->id}}"
                                                        {{$model->user_id == $user->id ? "selected" : ""}}
                                                        > {{$user->name}}  @if($user->type == "office" && $user->office)
                                                           -<span style="color: red">  ({{optional($user->office)->title}}) </span>
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('qsale::dashboard.ads.form.start_at')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                                <input type="text" class="form-control out_item" value="{{$model->start_at}}" name="start_at">
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('qsale::dashboard.ads.form.end_at')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                                <input type="text" class="form-control out_item" value="{{$model->end_at}}" name="end_at">
                                                <span class="input-group-btn">
                                                    <button class="btn default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($model->status == "wait")
                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{ __('qsale::dashboard.ads.datatable.is_paid') }}
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" class="make-switch" @if($model->is_paid) checked @endif value="1"  id="" data-size="small" name="is_paid">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                    @endif


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('qsale::dashboard.ads.form.ads_price')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" min="0" class="form-control" cldata-size="small" value="{{$model->ads_price}}" name="ads_price" >
                                            <div class="help-block"></div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                            {{-- END CREATE FORM --}}
                             {{-- CREATE FORM --}}
                             <div class="tab-pane  fade in" id="attachs">
                                <h3 class="page-title">{{ __('qsale::dashboard.ads.form.tabs.attachs') }}</h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.ads.form.attachs') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{ __('qsale::dashboard.ads.form.attachs') }}
                                                    </a>
                                                </span>
                                                <input name="attachs[]" multiple class="form-control image" type="file" >

                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>

                                    </div>
                                    <div class="deleteImages" style="display: none">

                                    </div>

                                    <div class="form-group">


                                        @forelse ($model->getMedia("attachs") as $image)
                                            <div class="col-md-3" style="margin-bottom: 20px">
                                                <div class="image-content">
                                                    <div class="image-head image-elment">

                                                        <a download href="{{$image->getUrl()}}">
                                                            @if (strpos($image->mime_type, "image") !== false)
                                                                 <img src="{{$image->getUrl()}}" style="width: 100%"  height="170px" class="responsive">
                                                            @else
                                                            {{ $image->name}}
                                                            @endif

                                                        </a>
                                                    </div>
                                                    <div class="image-actions image-elment">
                                                        <button class="btn btn-danger delete-image" data-id="{{$image->id}}" type="button">X</button>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty

                                        @endforelse


                                    </div>






                                </div>
                            </div>
                            {{-- END CREATE FORM --}}
                              {{-- tab categories --}}
                              <div class="tab-pane fade in" id="categories">
                                <h3 class="page-title">
                                    {{ __('qsale::dashboard.ads.form.tabs.categories') }}
                                </h3>
                                <div id="jstree">
                                    @include('qsale::dashboard.tree.ads.edit',
                                    ['mainCategories' => $mainCategories, "model" => $model]
                                    )
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="category_id" id="root_category" value="" data-name="category_id">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            {{-- end --}}

                            {{-- tab categories --}}
                            <div class="tab-pane fade in" id="attrbiutes">
                                <h3 class="page-title">
                                    {{ __('qsale::dashboard.ads.form.tabs.attrbiutes') }}
                                </h3>
                                <div class="row" id="attrbiutes">
                                        @forelse ($model->attributes as $key=> $attribute)
                                            <div class="form-group">
                                                <label class="col-md-2">
                                                   {{ $attribute->attribute->name }}

                                                </label>
                                                <div class="col-md-9">
                                                    <input type="hidden" name="adsAttributes[{{$key}}][attribute_id]" value="{{$attribute->attribute_id}}"/>
                                                    @if ($attribute->attribute->type == "drop_down")
                                                            <select class="form-control" name="adsAttributes[{{$key}}][option_id]">
                                                                @forelse ($attribute->attribute->options as $option)
                                                                    <option value="{{$option->id}}" {{$option->id == $attribute->option_id ? "selected" : ""}}>{{$option->value}}</option>
                                                                @empty

                                                                @endforelse
                                                            </select>
                                                    @elseif ($attribute->attribute->type == "radio")
                                                            <div class="row">
                                                                @forelse ($attribute->attribute->options as $option)
                                                                <div class="col-md-4">
                                                                    <label for="radi_{{$option->id}}">{{$option->value}}</label>
                                                                    <input type="radio" name="adsAttributes[{{$key}}][option_id]" {{$option->id == $attribute->option_id ? "checked" : ""}} id="radi_{{$option->id}}"  value="{{$option->id}}">
                                                                </div>
                                                                @empty
                                                                @endforelse
                                                            </div>
                                                    @elseif($attribute->attribute->type == "boolean")
                                                              <input type="checkbox" class="" name="adsAttributes[{{$key}}][value]" {{$attribute->value ? "checked" : ""}} />
                                                    @else
                                                        <input type="{{$attribute->attribute->type}}" class="form-control" name="adsAttributes[{{$key}}][value]" value="{{$attribute->value}}" />
                                                    @endif
                                                <div class="help-block"></div>
                                                </div>
                                            </div>
                                        @empty

                                        @endforelse
                                </div>
                            </div>
                            {{-- end --}}
                        </div>
                    </div>
                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('apps::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('dashboard.ads.index')) }}" class="btn btn-lg red">
                                    {{__('apps::dashboard.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop


@section("scripts")
<script>
   // loading
$(function(){

    // variable
    var country  = $("#country")
    var city     = $("#city")
    var state    = $("#state")

    var count = 0;
    // method and event for country
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

    country.change(function(){
        handleCountryChangeData(country)
    })

    // handleCountryChangeData(country)

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





    city.change(function(){
        handleCityChange(city)
    })

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

    // hnadle category
    var attributes = $("#attrbiutes")
    $('#jstree').jstree();
    $('#jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
            if(count > 0) handleCategoryAttrbiute(data.selected)
            count++;
    });

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
            <label class="col-md-2">
                ${data.name}

            </label>
            <div class="col-md-9">
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
                       <input type="radio" name="adsAttributes[${key}][option_id]" id="radi_${option.id}" name="fav_language" value="${option.id}">
                   </div>
                `
           }
           input += radio + "</div>"
        }
        else if(data.type == "boolean"){

            input = `<input type="checkbox"   class="" value="1"  name="adsAttributes[${key}][value]" >`
        }
        else{
            input = `<input type="${data.type}" ${data.validation.required  == 1 ? 'required' : ''}  class="form-control"  name="adsAttributes[${key}][value]" >`
        }

        return input
    }

        // delete attachs
           var deleteImagesContainer = $(".deleteImages")
           $("body").on("click", ".delete-image", function(){

                if(confirm("Are you sure")){
                    var elm = $(this);
                    // alert(elm.data("id"))
                    delteImage(elm.data("id"))

                    elm.parents(".image-content").hide();

                }
            })

            function delteImage(id){
                deleteImagesContainer.append(`<input type="hidden" name="deleteAttachs[]" value="${id}" />`)
            }




    // ================================ address ======================
    var copyCounty = $("#copyCounty");
    copyCounty = copyCounty.html()
    $("#copyCounty").remove();
    var contianerAddress = $("#contianer-address")
    var addAddress       = $("#addAddress")
    var addressIncrement = "{{$model->address->count()}}";
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

    // set
    $(".country-address").each(function(){

        var _elment = $(this)
        var _contianter = _elment.parents("div.group_address");
        var _city = _contianter.find(".city-address")
        var _state = _contianter.find(".state-address")

        handleCountryChangeData(_elment, _city, _state)
    })



})
</script>
@stop
