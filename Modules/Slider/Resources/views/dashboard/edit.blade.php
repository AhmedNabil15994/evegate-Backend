@extends('apps::dashboard.layouts.app')
@section('title', __('slider::dashboard.slider.routes.update'))
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
                    <a href="{{ url(route('dashboard.slider.index')) }}">
                        {{__('slider::dashboard.slider.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('slider::dashboard.slider.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.slider.update',$slider->id)}}">
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
                                                    {{ __('slider::dashboard.slider.form.tabs.general') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#categories" data-toggle="tab">
                                                    {{ __('slider::dashboard.slider.form.tabs.categories') }}
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

                            {{-- UPDATE FORM --}}
                            <div class="tab-pane active fade in" id="general">
                                <h3 class="page-title">{{ __('slider::dashboard.slider.form.tabs.general') }}</h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('slider::dashboard.slider.form.type') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type" id="type_advertising" data-name="type">
                                                    @foreach (["in", "out"] as $item)
                                                            <option value="{{$item}}" {{ $item == $slider->type  ? "selected" : ""}}>  {{ __("slider::dashboard.slider.form.$item") }}</option>
                                                    @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('slider::dashboard.slider.form.position')}}    
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="position" name="position" data-name="position">
                                                @foreach (\Modules\Slider\Enum\Position::getConstList() as $type)
                                                 <option value="{{$type}}" {{$slider->position === $type ? "selected" :""}}
                                                 >@lang("slider::dashboard.slider.form.positions.$type")</option>
                                                @endforeach
                                         
                                             </select>
                                          <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('slider::dashboard.slider.form.link') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="link" class="form-control out_item" data-name="link" value="{{ $slider->link }}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('slider::dashboard.slider.form.start_at') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                <input type="text" class="form-control out_item" name="start_at" value="{{ $slider->start_at }}">
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
                                            {{ __('slider::dashboard.slider.form.end_at') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                <input type="text" class="form-control out_item" name="end_at" value="{{ $slider->end_at }}">
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
                                            {{ __('slider::dashboard.slider.form.ads_id') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control in_item select2" name="ads_id" id="" data-name="ads_id">
                                                @if($ads = $slider->ads)
                                                <option value="{{$ads->id}}" 
                                                   selected>  {{ $ads->title }}</option>
                                               @endif
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('slider::dashboard.slider.form.status') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($slider->status == 1) ? ' checked="" ' : ''}}>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('slider::dashboard.slider.form.image') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary lfm">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{__('apps::dashboard.buttons.upload')}}
                                                    </a>
                                                </span>
                                                <input name="image"  class="form-control image" type="file" >
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-danger delete">
                                                        <i class="glyphicon glyphicon-remove"></i>
                                                    </a>
                                                </span>
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                                <img src="{{url($slider->image)}}" style="height: 15rem; max-width:100%">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- END UPDATE FORM --}}

                             {{-- tab categories --}}
                             <div class="tab-pane fade in" id="categories">
                                <h3 class="page-title">
                                    {{ __('slider::dashboard.slider.form.tabs.categories') }}
                                </h3>
                               

                                <div  class="normal jstree handleCategories">
                                    @include('slider::tree.slider.edit',
                                    ['mainCategories' => $normalCategories, "model"=>$slider])
                                </div>

                                <div  class="company jstree handleCategories">
                                    @include('slider::tree.slider.edit',
                                    ['mainCategories' => $companyCategories,  "model"=>$slider])
                                </div>

                                <div  class="technical jstree handleCategories">
                                    @include('slider::tree.slider.edit',
                                    ['mainCategories' => $technicalCategories,  "model"=>$slider])
                                </div>
                               

                                <div class="form-group">
                                    <input type="hidden" name="categories" id="root_category" value="" data-name="category_id">
                                    <div class="help-block"></div>
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
                                <a href="{{url(route('dashboard.slider.index')) }}" class="btn btn-lg red">
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
    $(function(){
        
        var outItem = $(".out_item")
        var inItem = $(".in_item")
        var selectType = $("#type_advertising")


      // handle postion 
      var position = $("#position")
        var selectAds = $(".selectAds")
        var jstree    = $(".jstree")
        function handleType(){
            var value = position.val()
            handleAds(value)
            handleCategoryType(value)
        }
        position.change(function(){
            handleType()
            selectAds.empty().trigger('change')
        })

        function handleCategoryType(val){  
            jstree.hide();
            $('#root_category').val('');
            $(`.${val}`).show();
        }



        function handleAds(postion){
            selectAds.select2({
                        ajax: {
                            url:"{{route('dashboard.ads.select2')}}",
                            dataType: 'json',
                            cache: true,
                            data: function (params) {
                                var query = {
                                    search: params.term,
                                    page: params.page || 1 ,
                                    user_type:postion
                                }

                                // Query parameters will be ?search=[term]&page=[page]
                                return query;
                            },
                            processResults: function (data, params) {

                                return {
                                    results: data.data,
                                    pagination: {
                                        more: data.next_page_url ?  true  : false
                                    }
                                };
                            }
                        }
            });
        }

        handleType()


        //==============================
       


        function handleItem(_elm){
            var value = _elm.val()
            
            if(value){
                if(value == "out"){
                    outItem.prop('disabled', false)
                    inItem.prop('disabled', true)
                }else{
                    // alert("hi")
                    console.log(outItem, inItem)
                    outItem.attr('disabled', true)
                    inItem.attr('disabled', false)
                }
            }
        }
        selectType.change(function(){
            handleItem(selectType)
        })

        handleItem(selectType)

         // categories
         var categories  = $(".handleCategories")
        $('.jstree').jstree({
            "core" : {
                "multiple" : true,
                "animation" : 0
            }
        });
        $('.jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
        });
    })
</script>
@stop