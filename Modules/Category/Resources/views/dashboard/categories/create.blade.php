@extends('apps::dashboard.layouts.app')
@section('title', __('category::dashboard.categories.routes.create'))
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
                    <a href="{{ url(route('dashboard.categories.index')) }}">
                        {{__('category::dashboard.categories.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('category::dashboard.categories.routes.create')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.categories.store')}}">
                @csrf
                <div class="col-md-12">

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
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('category::dashboard.categories.form.tabs.general') }}
                                                </a>
                                            </li>
                                            <li >
                                                <a href="#category_level" data-toggle="tab">
                                                    {{ __('category::dashboard.categories.form.tabs.category_level') }}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane  fade in" id="category_level">
                                <h3 class="page-title">{{ __('category::dashboard.categories.form.tabs.category_level') }}</h3>
                                
                                <div id="jstree" class="user jstree">
                                    <ul>
                                        <li id="null">{{ __('category::dashboard.categories.form.main_category') }}</li>
                                    </ul>
                                    @include('category::dashboard.tree.categories.view',['mainCategories' => $normalCategories])
                                </div>
                                
                                <div id="jstree" class="company jstree">
                                    <ul>
                                        <li id="null">{{ __('category::dashboard.categories.form.main_category') }}</li>
                                    </ul>
                                    @include('category::dashboard.tree.categories.view',['mainCategories' => $companyCategories])
                                </div>

                                <div id="jstree" class="technical jstree">
                                    <ul>
                                        <li id="null">{{ __('category::dashboard.categories.form.main_category') }}</li>
                                    </ul>
                                    @include('category::dashboard.tree.categories.view',['mainCategories' => $technicalCategories])
                                </div>

                                <div id="jstree" class="offer jstree">
                                    <ul>
                                        <li id="null">{{ __('category::dashboard.categories.form.main_category') }}</li>
                                    </ul>
                                    @include('category::dashboard.tree.categories.view',['mainCategories' => $offerCategories])
                                </div>

                            </div>
                            <div class="tab-pane active fade in" id="global_setting">
                                <h3 class="page-title">{{__('category::dashboard.categories.form.tabs.general')}}</h3>
                                <div class="col-md-10">
                                    {{--  tab for lang --}}
                                    <ul class="nav nav-tabs">
                                        @foreach (config('translatable.locales') as $code)
                                               <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#first_{{$code}}">{{ $code }}</a></li>
                                        @endforeach
                                    </ul>

                                    {{--  tab for content --}}
                                    <div class="tab-content">
                                    @foreach (config('translatable.locales') as $code)
                                      <div id="first_{{$code}}" class="tab-pane fade @if($loop->first) in active @endif">
                                   
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{__('category::dashboard.categories.form.title')}} - {{ $code }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" name="title[{{$code}}]" class="form-control" data-name="title.{{$code}}">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                      </div>
                                    @endforeach


                                    @inject("countries","Modules\Area\Entities\Country")
                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('area::dashboard.cities.form.countries')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="country_id" id="single" class="form-control select2">
                                                <option value=""></option>
                                                @foreach ($countries->all() as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ optional($country->translateOrDefault(locale()))->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.color')}}
                                        </label>
                                        <div class="col-md-9">
                                          <input type="text" name="color" id="hue-demo" class="form-control demo" data-control="hue" value="#ff6161" data-name="color">
                                          <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.sort')}}
                                        </label>
                                        <div class="col-md-9">
                                          <input type="number" min="1" name="sort"  class="form-control "  value="999" data-name="sort">
                                          <div class="help-block"></div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <label class="col-md-2">
                                        {{__('category::dashboard.categories.form.type')}}
                                    </label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="categoryType" name="type" data-name="type">
                                            @foreach (\Modules\Category\Enum\CategoryType::getConstList() as $type)
                                                <option value="{{$type}}">@lang("category::dashboard.categories.form.types.$type")</option>
                                            @endforeach
                                        
                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.is_end_category')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="is_end_category" data-size="small" name="is_end_category">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.attributes')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="c_attributes[]"  multiple id="attributes" data-name="c_attributes" class="form-control select2-allow-clear" >
                    
                                                @foreach ($attributes as $attibute)
                                                    <option value="{{ $attibute->id}}">
                                                        {{ $attibute->name}}
                                                    </option>
                                                @endforeach

                                            </select>
        
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('category::dashboard.categories.form.image')}}
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
                                                {{-- <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-danger ">
                                                        <i class="glyphicon glyphicon-remove"></i>
                                                    </a>
                                                </span> --}}
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" checked id="test" data-size="small" name="status">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.slim_details')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" value="1" id="slim_details" data-size="small" name="slim_details">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="parent_id" id="root_category" value="">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.categories.index')) }}" class="btn btn-lg red">
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


@section('scripts')

<script type="text/javascript">
     var afterSucessAjex 
     afterSucessAjex = function(){  
            $("#attributes").change()
     }
     // handel category type
     var categoryType = $("#categoryType")
     var jstree       = $(".jstree")

    function handleCategoryType(){
         jstree.hide();
         $('#root_category').val();
         $(`.${categoryType.val()}`).show();
    }
    categoryType.change(function(){
        handleCategoryType()
    })

    handleCategoryType()

     var attributes = $("#attributes")
     var is_end_category = $("#is_end_category");
    $(function() {

        $('.jstree').jstree({
            core: {
                multiple: false
            }
        });

        $('.jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
            handleMainCategory((data.selected[0] == "null") )
        });

       

    });

    is_end_category.on('switchChange.bootstrapSwitch', function(e) {
        handleAddationAllow(!e.target.checked);
    });

    function handleAddationAllow(disabled=true){
        if(!is_end_category.hasClass("has-main")){
            attributes.prop("disabled",disabled )
        }
        
    }

    handleAddationAllow(!is_end_category.checked)

    function  handleMainCategory(is_main){
        if(is_main){
            is_end_category.bootstrapSwitch("state", false);
            // is_end_category.parents(".form-group").hide()
             is_end_category.addClass("has-main");
            attributes.prop("disabled",false )
        }else{
            attributes.prop("disabled",false )
            is_end_category.bootstrapSwitch("state", true);
            // is_end_category.parents(".form-group").show()
            // is_end_category.prop("readonly", false);
            is_end_category.removeClass("has-main");
        }
    }

</script>

@endsection
