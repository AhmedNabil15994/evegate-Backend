@extends('apps::dashboard.layouts.app')
@section('title', __('advertisement::dashboard.advertisement.routes.update'))
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
                    <a href="{{ url(route('dashboard.advertisement.index')) }}">
                        {{__('advertisement::dashboard.advertisement.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('advertisement::dashboard.advertisement.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.advertisement.update',$advertisement->id)}}">
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
                                                    {{ __('advertisement::dashboard.advertisement.form.tabs.general') }}
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
                                <h3 class="page-title">{{ __('advertisement::dashboard.advertisement.form.tabs.general') }}</h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('advertisement::dashboard.advertisement.form.type') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type" id="type_advertising" data-name="type">
                                                    @foreach (["in", "out"] as $item)
                                                            <option value="{{$item}}" {{ $item == $advertisement->type  ? "selected" : ""}}>  {{ __("advertisement::dashboard.advertisement.form.$item") }}</option>
                                                    @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('advertisement::dashboard.advertisement.form.link') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="link" class="form-control out_item" data-name="link" value="{{ $advertisement->link }}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('advertisement::dashboard.advertisement.form.start_at') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                <input type="text" class="form-control out_item" name="start_at" value="{{ $advertisement->start_at }}">
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
                                            {{ __('advertisement::dashboard.advertisement.form.end_at') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                <input type="text" class="form-control out_item" name="end_at" value="{{ $advertisement->end_at }}">
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
                                            {{ __('advertisement::dashboard.advertisement.form.ads_id') }}
                                        </label>
                                        <div class="col-md-9">
                                            <select class="form-control in_item select2" name="ads_id" id="" data-name="ads_id">
                                                    @foreach ($ads as $item)
                                                            <option value="{{$item->id}}" 
                                                                    {{ $item->id == $advertisement->ads_id ? "selected" : ""}}>  {{ $item->title }}</option>
                                                    @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('advertisement::dashboard.advertisement.form.status') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($advertisement->status == 1) ? ' checked="" ' : ''}}>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('advertisement::dashboard.advertisement.form.image') }}
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
                                                <img src="{{url($advertisement->image)}}" style="height: 15rem;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- END UPDATE FORM --}}

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
                                <a href="{{url(route('dashboard.advertisement.index')) }}" class="btn btn-lg red">
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
    })
</script>
@stop