@extends('apps::dashboard.layouts.app')
@section('title', __('category::dashboard.categories.routes.update'))
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
                    <a href="#">{{__('category::dashboard.categories.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.categories.update',$category->id)}}">
                @csrf
                @method('PUT')
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
                                                <a href="#category_level" data-toggle="tab">
                                                    {{ __('category::dashboard.categories.form.tabs.category_level') }}
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('category::dashboard.categories.form.tabs.general') }}
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
                            <div class="tab-pane active fade in" id="category_level">
                                <h3 class="page-title">{{ __('category::dashboard.categories.form.tabs.category_level') }}</h3>
                                <div id="jstree">
                                    <ul>
                                        <li id="null"
                                          @if ($category->parent_id == null)
                                            data-jstree='{"selected":true}'
                                          @endif>
                                          {{ __('category::dashboard.categories.form.main_category') }}
                                        </li>
                                    </ul>
                                    @include('category::dashboard.tree.categories.edit',['mainCategories' => $mainCategories, "category"=> $category])
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="global_setting">
                                <h3 class="page-title">{{__('category::dashboard.categories.form.tabs.general')}}</h3>
                                <div class="col-md-10">

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
                                                <input type="text" name="title[{{$code}}]" class="form-control" data-name="title.{{$code}}" value="{{optional($category->translate($code))->title}}">
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
                                                <option value="{{ $country->id }}" 
                                                    {{ $category->country_id == $country->id ? "selected" : ""}}>
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
                                          <input type="text" name="color" id="hue-demo" class="form-control demo" data-control="hue" data-name="color" value="{{$category->color}}">
                                          <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.sort')}}
                                        </label>
                                        <div class="col-md-9">
                                          <input type="number" min="1" name="sort" class="form-control " value="{{$category->sort}}" data-name="sort">
                                          <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.is_end_category')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"
                                                  {{( $category->is_end_category == 1 ) ? ' checked="" ' : ''}}
                                                  id="is_end_category" data-size="small" name="is_end_category">
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
                                                  
                                                    <option value="{{ $attibute->id}}" 
                                                    {{ $category->attributes->contains('id',$attibute->id) ? "selected" : ""}}>
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
                                                
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                              <img src="{{url($category->image)}}" style="height: 15rem;">
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
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($category->status == 1) ? ' checked="" ' : ''}}>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('category::dashboard.categories.form.slim_details')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="slim_details" data-size="small" name="slim_details" {{($category->slim_details == 1) ? ' checked="" ' : ''}}>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>



                                    @if ($category->trashed())
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

                                    <input type="hidden" name="parent_id" id="root_category" value="">
                                </div>
                            </div>
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
    $(function() {
        var attributes = $("#attributes")
        var is_end_category = $("#is_end_category");

        $('#jstree').jstree({
            core: {
                multiple: false
            }
        });

        $('#jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
            handleMainCategory((data.selected[0] == "null") )
        });

        is_end_category.on('switchChange.bootstrapSwitch', function(e) {
            handleAddationAllow(!e.target.checked);
        });

        function handleAddationAllow(disabled=true){
            
            if(!is_end_category.hasClass("has-main")){
                attributes.prop("disabled",disabled )
            }
          
        }

        handleAddationAllow(!is_end_category[0].checked)

        function  handleMainCategory(is_main){
            if(is_main){
                // is_end_category.bootstrapSwitch("state", false);
                // is_end_category.parents(".form-group").hide()
                attributes.prop("disabled",false )
                is_end_category.addClass("has-main");
            }else{
                attributes.prop("disabled",false )
                is_end_category.bootstrapSwitch("state", true);
                // is_end_category.parents(".form-group").show()
                is_end_category.removeClass("has-main");
            }
        }

    });
</script>

@endsection
