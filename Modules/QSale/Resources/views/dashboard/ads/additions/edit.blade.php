@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.ads.routes.addations.update'))
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
          <a href="#">{{__('qsale::dashboard.ads.routes.addations.update')}}</a>
        </li>
      </ul>
    </div>

    <h1 class="page-title"></h1>

    <div class="row">
      <form id="updateForm"
        role="form"
        class="form-horizontal form-row-seperated"
        method="post"
        enctype="multipart/form-data"
        action="{{route('dashboard.ads.update.additions',['ads'=>$ads->id])}}">
        @csrf
        @method('put')
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
                          {{ __('qsale::dashboard.ads.form.tabs.general') }}
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
                <h3 class="page-title">{{ __('qsale::dashboard.ads.form.tabs.general') }}</h3>
                <div class="col-md-10">
                  @foreach ($ads->addations as $key=>$addation )
                  <div class="row">
                    <div class="col-md-3">
                      <h5>{{ $addation->addation->name }}</h5>
                      <input type="hidden"
                        name="addations[{{ $key }}][addation_id]"
                        class="form-control"
                        value="{{ $addation->addation_id }}">
                    </div>
                    <div class="col-md-9">
                      <div class="form-group">
                        <label class="col-md-2">
                          {{ __('start_date') }}
                        </label>
                        <div class="col-md-9">
                          <input type="date"
                            name="addations[{{ $key }}][start_date]"
                            class="form-control"
                            value="{{ $addation->start_date }}">
                          <div class="help-block"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2">
                          {{ __('expire date') }}
                        </label>
                        <div class="col-md-9">
                          <input type="date"
                            name="addations[{{ $key }}][expire_date]"
                            class="form-control"
                            value="{{ $addation->expire_date }}">
                          <div class="help-block"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          {{-- END CREATE FORM --}}
        </div>

        {{-- PAGE ACTION --}}
     <div class="col-md-12">
        <div class="form-actions">
          @include('apps::dashboard.layouts._ajax-msg')
          <div class="form-group">
            <button type="submit"
              id="submit"
              class="btn btn-lg green">
              {{__('apps::dashboard.buttons.edit')}}
            </button>
            <a href="{{url(route('dashboard.ads.index')) }}"
              class="btn btn-lg red">
              {{__('apps::dashboard.buttons.back')}}
            </a>
          </div>
        </div>
      </div>







      </form>
    </div>
  </div>
</div>
@stop
