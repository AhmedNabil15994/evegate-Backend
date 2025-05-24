@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.addations.routes.update'))
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
          <a href="{{ url(route('dashboard.addations.index')) }}">
            {{ __('qsale::dashboard.addations.routes.index') }}
          </a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <a href="#">{{ __('qsale::dashboard.addations.routes.update') }}</a>
        </li>
      </ul>
    </div>

    <h1 class="page-title"></h1>

    <div class="row">
      <form id="updateForm"
        page="form"
        class="form-horizontal form-row-seperated"
        method="post"
        enctype="multipart/form-data"
        action="{{ route('dashboard.addations.update', $model->id) }}">
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
                        <a href="#general"
                          data-toggle="tab">
                          {{ __('qsale::dashboard.addations.form.tabs.general') }}
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
                <h3 class="page-title">{{ __('qsale::dashboard.addations.form.tabs.general') }}</h3>
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
                          {{ __('qsale::dashboard.addations.form.name') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                          <input type="text"
                            name="name[{{ $code }}]"
                            value="{{ $model->translate('name', $code) }}"
                            class="form-control"
                            data-name="name.{{ $code }}">
                          <div class="help-block"></div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-2">
                          {{ __('qsale::dashboard.addations.form.description') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                          <textarea type="text"
                            name="description[{{ $code }}]"
                            rows="8"
                            cols="80"
                            class="form-control"
                            data-name="description.{{ $code }}"
                            data-name="description.{{ $code }}">{{ $model->translate('description', $code) }}</textarea>
                          <div class="help-block"></div>
                        </div>
                      </div>

                    </div>
                    @endforeach
                  </div>



                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.addations.form.price') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="price"
                        min="0"
                        value="{{ $model->price }}"
                        id="price"
                        class="form-control"
                        data-name="price">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.addations.form.type') }}
                    </label>
                    <div class="col-md-9">
                      <select class="form-control select2"
                        name="type"
                        data-name="type">
                        @foreach (Modules\QSale\Enum\AddationType::getConstList() as $type)
                        <option value="{{ $type }}"
                          {{$type==$model->type ? 'selected' : '' }}>
                          {{ __('qsale::dashboard.addations.form.types.' . $type) }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.ads.datatable.user_type') }}
                    </label>
                    <div class="col-md-9">
                      <select class="form-control"
                        name="user_type"
                        id="user_type">
                        @foreach (Modules\User\Enums\UserType::getConstList() as $type)
                        @if ($type != Modules\User\Enums\UserType::ADMIN)
                        <option {{
                          $model->type == $type ? 'selected' : '' }}
                          data-url="{{ Modules\User\Enums\UserType::routeSelect2($type) }}" value="{{ $type }}">
                          {{ ucfirst(str_replace('_', ' ', $type)) }}
                        </option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.addations.form.days') }}
                    </label>
                    <div class="col-md-9">
                      <input type="number"
                        min="1"
                        class="form-control"
                        cldata-size="small"
                        name="days"
                        value="{{ $model->days }}">
                      <div class="help-block">
                      </div>
                    </div>
                  </div>




                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.addations.form.icon') }}
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
                        <input name="icon"
                          class="form-control image"
                          type="file">

                      </div>
                      <span class="holder"
                        style="margin-top:15px;max-height:100px;">
                        <img src="{{ url($model->icon) }}"
                          style="height: 15rem;">
                      </span>
                      <input type="hidden"
                        data-name="icon">
                      <div class="help-block"></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('qsale::dashboard.addations.form.status') }}
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
                  class="btn btn-lg green">
                  {{ __('apps::dashboard.buttons.edit') }}
                </button>
                <a href="{{ url(route('dashboard.addations.index')) }}"
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


@section('scripts')
<script>
  $(function() {
      var isFixed = $("#is_free")
      var maxInput = $("#price")

      function handleItem(_elm) {

        if (_elm.is(':checked')) {
          maxInput.prop('readonly', true)
          maxInput.val(0)
        } else {
          maxInput.prop('readonly', false)
        }
      }

      isFixed.on('switchChange.bootstrapSwitch', function() {
        handleItem(isFixed)
      })

      handleItem(isFixed)
    })
</script>
@stop
