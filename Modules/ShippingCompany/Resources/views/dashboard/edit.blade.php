@extends('apps::dashboard.layouts.app')
@section('title', __('shipping_company::dashboard.shipping_companies.routes.update'))
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
          <a href="{{ url(route('dashboard.shipping_companies.index')) }}">
            {{ __('shipping_company::dashboard.shipping_companies.routes.index') }}
          </a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <a href="#">{{ __('shipping_company::dashboard.shipping_companies.routes.update') }}</a>
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
        action="{{ route('dashboard.shipping_companies.update', ['id' => $model->id]) }}">
        @csrf
        @method('PUT')
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
                        <a href="#global_setting"
                          data-toggle="tab">
                          {{ __('shipping_company::dashboard.shipping_companies.form.tabs.general') }}
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
                id="global_setting">
                <h3 class="page-title">{{ __('shipping_company::dashboard.shipping_companies.form.tabs.general') }}</h3>
                <div class="col-md-10">
                  {{-- tab for lang --}}
                  <ul class="nav nav-tabs">
                    @foreach (config('translatable.locales') as $code)
                    <li class="@if ($loop->first) active @endif"><a data-toggle="tab"
                        href="#first_{{ $code }}">{{ $code }}</a></li>
                    @endforeach
                  </ul>
                  {{-- tab for content --}}
                  <div class="tab-content">
                    @foreach (config('translatable.locales') as $code)
                    <div id="first_{{ $code }}"
                      class="tab-pane fade @if ($loop->first) in active @endif">
                      <div class="form-group">
                        <label class="col-md-2">
                          {{ __('shipping_company::dashboard.shipping_companies.form.name') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                          <input type="text"
                            name="title[{{ $code }}]"
                            value="{{ $model->translate('title', $code) }}"
                            class="form-control"
                            data-name="title.{{ $code }}">
                          <div class="help-block"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2">
                          {{ __('shipping_company::dashboard.shipping_companies.form.address') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                          <input type="text"
                            name="address[{{ $code }}]"
                            value="{{ $model->translate('address', $code) }}"
                            class="form-control"
                            data-name="address.{{ $code }}">
                          <div class="help-block"></div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>


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
                                  {{ $model->country_id == $country->id ? "selected" : ""}}>
                                  {{ optional($country->translateOrDefault(locale()))->title }}
                              </option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('shipping_company::dashboard.shipping_companies.form.image') }}
                    </label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image"
                            data-preview="holder"
                            class="btn btn-primary">
                            <i class="fa fa-picture-o"></i>
                            {{ __('apps::dashboard.buttons.upload') }}
                          </a>
                        </span>
                        <input name="image"
                          class="form-control image"
                          type="file">
                      </div>
                      <span class="holder"
                        style="margin-top:15px;max-height:100px;">
                        <img src="{{ url($model->image) }}"
                          style="height: 15rem;">
                      </span>
                      <input type="hidden"
                        data-name="image">
                      <div class="help-block"></div>
                    </div>
                  </div>



                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('shipping_company::dashboard.shipping_companies.form.phone_number') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="phone_number"
                        value="{{ $model->phone_number }}"
                        class="form-control"
                        data-name="phone_number">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('shipping_company::dashboard.shipping_companies.form.phone_whatsapp') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="phone_whatsapp"
                        value="{{ $model->phone_whatsapp }}"
                        class="form-control"
                        data-name="phone_whatsapp">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  @if ($model->trashed())
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('apps::dashboard.buttons.restore') }}
                    </label>
                    <div class="col-md-9">
                      <input type="checkbox"
                        class="make-switch"
                        id="test"
                        data-size="small"
                        name="restore">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  @endif
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.packages.form.status') }}
                    </label>
                    <div class="col-md-9">
                      <input type="checkbox"
                        class="make-switch"
                        {{
                        $model->status ? 'checked' : '' }} id="test" data-size="small"
                      name="status">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('lat') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="lat"
                        class="form-control"
                        data-name="lat"
                        value="{{ $model->lat }}">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('long') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="long"
                        class="form-control"
                        data-name="long"
                        value="{{ $model->long }}">
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
                  {{ __('apps::dashboard.buttons.edit') }}
                </button>
                <a href="{{ url(route('dashboard.shipping_companies.index')) }}"
                  class="btn btn-lg red">
                  {{ __('apps::dashboard.buttons.back') }}
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
