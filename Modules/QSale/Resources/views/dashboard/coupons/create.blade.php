@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.coupons.routes.create'))
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
                    <a href="{{ url(route('dashboard.coupons.index')) }}">
                        {{__('qsale::dashboard.coupons.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('qsale::dashboard.coupons.routes.create')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form"
                role="form"
                class="form-horizontal form-row-seperated"
                method="post"
                enctype="multipart/form-data"
                action="{{route('dashboard.coupons.store')}}">
                @csrf
                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable"
                            id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                </div>
                                <div id="collapse_2_1"
                                    class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#general"
                                                    data-toggle="tab">
                                                    {{ __('qsale::dashboard.coupons.form.tabs.general') }}
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
                            <div class="tab-pane active fade in"
                                id="general">
                                <h3 class="page-title">{{ __('qsale::dashboard.coupons.form.tabs.general') }}</h3>
                                <div class="col-md-10">



                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.code') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="code"
                                                class="form-control "
                                                data-name="code">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.amount') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="amount"
                                                class="form-control "
                                                data-name="amount">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.is_fixed') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox"
                                                class="make-switch"
                                                checked
                                                id="is_fixed"
                                                data-size="small"
                                                name="is_fixed">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.min') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="min"
                                                class="form-control "
                                                data-name="min">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.max') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="max"
                                                class="form-control max-fixed"
                                                id=""
                                                data-name="max">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.max_use') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="max_use"
                                                class="form-control "
                                                data-name="max_use">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.max_use_user') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text"
                                                name="max_use_user"
                                                class="form-control "
                                                data-name="max_use_user">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.expired_at') }}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-medium date date-picker"
                                                data-date-format="yyyy-mm-dd"
                                                data-date-start-date="+0d">
                                                <input type="text"
                                                    class="form-control"
                                                    name="expired_at">
                                                <span class="input-group-btn">
                                                    <button class="btn default"
                                                        type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{ __('qsale::dashboard.coupons.form.status') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox"
                                                class="make-switch"
                                                id="test"
                                                data-size="small"
                                                name="status">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('qsale::dashboard.coupons.form.packages')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="packages[]"
                                                data-tags="true"
                                                data-placeholder="{{__('qsale::dashboard.coupons.form.packages')}}"
                                                data-name="packages"
                                                class="form-control packages select2"
                                                data-allow-clear="true"
                                                multiple>

                                                @foreach ($packages as $package)
                                                <option value="{{ $package->id }}">
                                                    {{$package->title }}
                                                </option>
                                                @endforeach
                                            </select>
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
                                <button type="submit"
                                    id="submit"
                                    class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.coupons.index')) }}"
                                    class="btn btn-lg red">
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

        var isFixed = $("#is_fixed")
        var maxInput = $(".max-fixed")




        function handleItem(_elm){
            console.log(_elm.is(':checked'))
            if(_elm.is(':checked')){
                maxInput.prop('disabled', true)
            }else{
                maxInput.prop('disabled', false)
            }
        }
        isFixed.on('switchChange.bootstrapSwitch', function(){
            handleItem(isFixed)
        })

        handleItem(isFixed)
    })
</script>
@stop
