@extends('apps::dashboard.layouts.app')
@section('title', __('question::dashboard.questions.routes.update'))
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
                    <a href="#">{{__('question::dashboard.questions.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.questions.update',$question->id)}}">
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
                                                <a href="#global_setting" data-toggle="tab">
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

                            {{-- UPDATE FORM --}}
                            <div class="tab-pane active fade in" id="global_setting">
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
                                            <input type="text" name="question[{{$code}}]" class="form-control" data-name="question.{{$code}}" value="{{ $question->translate($code)->question }}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                  
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('question::dashboard.questions.form.answer')}} - {{ $code }}
                                        </label>
                                        <div class="col-md-9">
                                            <textarea name="answer[{{$code}}]" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" data-name="answer.{{$code}}">{{ $question->translate($code)->answer }}</textarea>
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
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="is_active" {{($question->is_active == 1) ? ' checked="" ' : ''}}>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                   


                                    @if ($question->trashed())
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('question::dashboard.questions.form.restore')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="restore">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    @endif

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
