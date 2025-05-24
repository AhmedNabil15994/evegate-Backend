@extends('apps::dashboard.layouts.app')
@section('title', __('offer::dashboard.offers.routes.create'))
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
            <a href="{{ url(route('dashboard.offers.index')) }}">
              {{ __('offer::dashboard.offers.routes.index') }}
            </a>
            <i class="fa fa-circle"></i>
          </li>
          <li>
            <a href="#">{{ __('offer::dashboard.offers.routes.create') }}</a>
          </li>
        </ul>
      </div>

      <h1 class="page-title"></h1>

      <div class="row">
        <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data"
          action="{{ route('dashboard.offers.store') }}">
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
                          <a href="#global_setting" data-toggle="tab">
                            {{ __('offer::dashboard.offers.form.tabs.general') }}
                          </a>
                        </li>
                        <li class="">
                          <a href="#categories" data-toggle="tab">
                            {{ __('offer::dashboard.offers.form.tabs.categories') }}
                          </a>
                        </li>
                        <li class="">
                          <a href="#attachs" data-toggle="tab">
                            {{ __('qsale::dashboard.ads.form.tabs.attachs') }}
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
                <div class="tab-pane active fade in" id="global_setting">
                  <h3 class="page-title">{{ __('offer::dashboard.offers.form.tabs.general') }}</h3>
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
                        <div id="first_{{ $code }}" class="tab-pane fade @if ($loop->first) in active @endif">

                          <div class="form-group">
                            <label class="col-md-2">
                              {{ __('offer::dashboard.offers.form.title') }} - {{ $code }}
                            </label>
                            <div class="col-md-9">
                              <input type="text" name="title[{{ $code }}]" class="form-control"
                                data-name="title.{{ $code }}">
                              <div class="help-block"></div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-md-2">
                              {{ __('offer::dashboard.offers.form.description') }} - {{ $code }}
                            </label>
                            <div class="col-md-9">
                              <textarea type="text" name="description[{{ $code }}]" rows="8" cols="80" class="form-control {{ is_rtl($code) }}Editor"
                                data-name="description.{{ $code }}" data-name="description.{{ $code }}">
                                                        </textarea>
                              <div class="help-block"></div>
                            </div>
                          </div>





                        </div>
                      @endforeach

                    </div>





                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('offer::dashboard.offers.form.image') }}
                      </label>
                      <div class="col-md-9">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a data-input="image" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i>
                              {{ __('apps::dashboard.buttons.upload') }}
                            </a>
                          </span>
                          <input name="image" class="form-control image" type="file">

                        </div>
                        <span class="holder" style="margin-top:15px;max-height:100px;">
                        </span>
                        <input type="hidden" data-name="image">
                        <div class="help-block"></div>
                      </div>
                    </div>

                    {{-- <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('offer::dashboard.offers.form.percent')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" min="0" max="100" autocomplete="off" data-name="percent" name="percent">
                                            <div class="help-block"></div>
                                        </div>
                                    </div> --}}


                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('offer::dashboard.offers.form.price_after') }}
                      </label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" autocomplete="off" data-name="price_after" name="price_after">
                        <div class="help-block"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('offer::dashboard.offers.form.price_before') }}
                      </label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" autocomplete="off" data-name="price_after" name="price_before">
                        <div class="help-block"></div>
                      </div>
                    </div>



                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('offer::dashboard.offers.form.phone_number') }}
                      </label>
                      <div class="col-md-9">
                        <input type="text" name="phone_number" class="form-control" data-name="phone_number">
                        <div class="help-block"></div>
                      </div>
                    </div>



                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('offer::dashboard.offers.form.phone_whatsapp') }}
                      </label>
                      <div class="col-md-9">
                        <input type="text" name="phone_whatsapp" class="form-control" data-name="phone_whatsapp">
                        <div class="help-block"></div>
                      </div>
                    </div>






                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('offer::dashboard.offers.form.start_at') }}
                      </label>
                      <div class="col-md-9">
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                          <input type="text" class="form-control out_item" name="start_at">
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
                        {{ __('offer::dashboard.offers.form.end_at') }}
                      </label>
                      <div class="col-md-9">
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                          <input type="text" class="form-control out_item" name="end_at">
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
                        {{ __('offer::dashboard.offers.form.status') }}
                      </label>
                      <div class="col-md-9">
                        <input type="checkbox" checked class="make-switch" id="test" data-size="small" name="status">
                        <div class="help-block"></div>
                      </div>
                    </div>

                  </div>
                </div>

                {{-- END CREATE FORM --}}

                {{-- CREATE FORM --}}
                <div class="tab-pane fade in" id="attachs">
                  <h3 class="page-title">{{ __('qsale::dashboard.ads.form.tabs.attachs') }}</h3>
                  <div class="col-md-10">

                    <div class="form-group">
                      <label class="col-md-2">
                        {{ __('qsale::dashboard.ads.form.attachs') }}
                      </label>
                      <div class="col-md-9">
                        <div class="input-group">
                          <span class="input-group-btn">
                            <a data-input="image" data-preview="holder" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i>
                              {{ __('qsale::dashboard.ads.form.attachs') }}
                            </a>
                          </span>
                          <input name="attachs[]" multiple class="form-control image" type="file">

                        </div>
                        <span class="holder" style="margin-top:15px;max-height:100px;">
                        </span>
                        <input type="hidden" data-name="image">
                        <div class="help-block"></div>
                      </div>

                    </div>
                  </div>
                </div>
                {{-- END CREATE FORM --}}

                {{-- tab categories --}}
                <div class="tab-pane fade in" id="categories">
                  <h3 class="page-title">
                    {{ __('offer::dashboard.offers.form.category_id') }}
                  </h3>
                  <div id="jstree" class="handleCategories">
                    @include('offer::tree.offers.view', ['mainCategories' => $offerCategories])
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="category_id" id="root_category" value="" data-name="category_id">
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
                  <button type="submit" id="submit" class="btn btn-lg blue">
                    {{ __('apps::dashboard.buttons.add') }}
                  </button>
                  <a href="{{ url(route('dashboard.offers.index')) }}" class="btn btn-lg red">
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
      var categories = $(".handleCategories")
      $('#jstree').jstree({
        "core": {
          "multiple": false,
          "animation": 0
        }
      });
      $('#jstree').on("changed.jstree", function(e, data) {
        $('#root_category').val(data.selected);
      });






    });
  </script>

  <script type="text/javascript"></script>

@stop
