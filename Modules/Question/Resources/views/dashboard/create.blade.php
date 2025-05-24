@extends('apps::dashboard.layouts.app')
@section('title', __('question::dashboard.questions.routes.create'))
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
                    <a href="{{ url(route('dashboard.questions.index')) }}">
                        {{__('question::dashboard.questions.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('question::dashboard.questions.routes.create')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="form" role="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.questions.store')}}">
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
                                                    {{ __('question::dashboard.questions.form.tabs.general') }}
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
                                <h3 class="page-title">{{__('question::dashboard.questions.form.tabs.general')}}</h3>
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
                                              {{__('question::dashboard.questions.form.question')}} - {{ $code }}
                                          </label>
                                          <div class="col-md-9">
                                              <input type="text" name="question[{{$code}}]" class="form-control" data-name="question.{{$code}}">
                                              <div class="help-block"></div>
                                          </div>
                                      </div>
                                  

                                   
                                      <div class="form-group">
                                          <label class="col-md-2">
                                              {{__('question::dashboard.questions.form.answer')}} - {{ $code }}
                                          </label>
                                          <div class="col-md-9">
                                              <textarea name="answer[{{$code}}]" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" data-name="answer.{{$code}}"></textarea>
                                              <div class="help-block"></div>
                                          </div>
                                      </div>
                                    </div>
                                    @endforeach
                                    </div>

                                    



                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('question::dashboard.questions.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" checked id="test" data-size="small" name="is_active">
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
                                <a href="{{url(route('dashboard.questions.index')) }}" class="btn btn-lg red">
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
