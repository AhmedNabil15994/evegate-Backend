@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.packages.routes.create'))
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
                    <a href="{{ url(route('dashboard.packages.index')) }}">
                        {{__('qsale::dashboard.packages.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('qsale::dashboard.packages.routes.create')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.packages.store')}}">
                @csrf
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
                                                    {{ __('qsale::dashboard.packages.form.tabs.general') }}
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
                                <h3 class="page-title">{{ __('qsale::dashboard.packages.form.tabs.general') }}</h3>
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
                                                        {{ __('qsale::dashboard.packages.form.title') }} - {{ $code }}
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title[{{$code}}]" class="form-control" data-name="title.{{$code}}">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2">
                                                        {{ __('qsale::dashboard.packages.form.description') }} - {{ $code }}
                                                    </label>
                                                    <div class="col-md-9">
                                                        <textarea type="text" name="description[{{$code}}]" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" data-name="description.{{$code}}" data-name="description.{{$code}}">
                                                        </textarea>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>

                                               

                                             

                                            </div>
                                        @endforeach

                                     </div>
                                   

                                     <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.is_free') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"  id="is_free" value="1" data-size="small" name="is_free">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.first_time') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"  id="first_time" value="1" data-size="small" name="first_time">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('qsale::dashboard.packages.form.type')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" id="categoryType" name="type" data-name="type">
                                                @foreach (\Modules\QSale\Enum\PackageType::getConstList() as $type)
                                                    <option value="{{$type}}">@lang("qsale::dashboard.packages.form.types.$type")</option>
                                                @endforeach
                                            
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.price') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="price" id="price" class="form-control " data-name="price">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.duration') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="duration" min="1" class="form-control " data-name="duration">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                   

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.number_of_ads') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="number_of_ads" min="1" class="form-control " data-name="number_of_ads">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.number_of_image') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="number_of_image" class="form-control " data-name="number_of_ads">
                                            <div class="help-block"></div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.duration_of_ads') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="duration_of_ads" min="1" class="form-control " data-name="duration_of_ads">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.sort') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control select" name="sort">
                                                @foreach (range(1,10) as $item)
                                                        <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                  

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.packages.form.status') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" checked id="test" data-size="small" name="status">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
 
                                   
                                </div>
                            </div>
                            {{-- END CREATE FORM --}}

                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.packages.index')) }}" class="btn btn-lg red">
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
        
        var isFixed = $("#is_free")
        var maxInput = $("#price")
      
       


        function handleItem(_elm){
            
            if(_elm.is(':checked')){
                maxInput.prop('readonly', true)  
                maxInput.val(0)
            }else{
                maxInput.prop('readonly', false)  
            }
        }
        isFixed.on('switchChange.bootstrapSwitch', function(){
            handleItem(isFixed)
        })

        handleItem(isFixed)
    })
</script>
@stop