@extends('apps::vendor.layouts.app')
@section('title', __('OnDiet::vendor.vendors.routes.update'))
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('vendor.home')) }}">{{ __('apps::vendor.home.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                
                <li>
                    <a href="#">{{__('OnDiet::vendor.vendors.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" page="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('vendor.update.info',$model->id)}}">
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
                                                    {{ __('OnDiet::vendor.vendors.form.tabs.general') }}
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
                                <h3 class="page-title">{{__('OnDiet::vendor.vendors.form.tabs.general')}}</h3>
                                <div class="col-md-10">

                                     {{--  tab for lang --}}
                                     <ul class="nav nav-tabs">
                                        @foreach (config('translatable.locales') as $code)
                                             <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#first_{{$code}}">{{ $code }}</a></li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">

                                    @foreach (config('translatable.locales') as $code)
                                        <div id="first_{{$code}}" class="tab-pane fade @if($loop->first) in active @endif">

                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{__('OnDiet::vendor.vendors.form.title')}} - {{ $code }}
                                                </label>
                                                <div class="col-md-9">
                                                    <input type="text" name="title[{{$code}}]" class="form-control" data-name="title.{{$code}}" value="{{ optional($model->translate($code))->title }}">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-2">
                                                    {{__('OnDiet::vendor.vendors.form.description')}} - {{ $code }}
                                                </label>
                                                <div class="col-md-9">
                                                    <textarea name="description[{{$code}}]" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" data-name="description.{{$code}}">{{ optional($model->translate($code))->description }}</textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
              
                                        </div>
                                    @endforeach

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('OnDiet::vendor.vendors.form.image')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{__('apps::vendor.buttons.upload')}}
                                                    </a>
                                                </span>
                                                <input name="image" class="form-control image" type="file" >
                                               
                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                                <img src="{{$model->image ? url($model->image) : ''}}" style="height: 15rem;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    


                                   

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('OnDiet::vendor.vendors.form.mobile')}}
                                        </label>
                                        <div class="col-md-9">
                                          <input type="text" name="mobile"  value="{{$model->mobile}}" class="form-control " data-name="mobile">
                                          <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('OnDiet::vendor.vendors.form.currencies')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="currencies[]"  data-tags="true" data-placeholder="{{__('OnDiet::vendor.vendors.form.currencies')}}" data-name="currencies" class="form-control currencies select2" data-allow-clear="true" multiple>
                                              
                                                @foreach ($currencies as $currecny)
                                                    <option value="{{ $currecny['id'] }}" {{ $model->currencies->contains($currecny->id) ? 'selected=""' : ''}} >
                                                        {{ $currecny->code }} - {{ optional($currecny->translateOrDefault(locale()))->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="checkbox" id="selectAll" >Select All
        
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                   

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('OnDiet::vendor.vendors.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="status" {{($model->status == 1) ? ' checked="" ' : ''}}>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    


                                    {{-- @if ($model->trashed())
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('apps::vendor.buttons.restore')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="restore">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    @endif --}}

                                </div>
                            </div>
                            {{-- END UPDATE FORM --}}

                        </div>
                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::vendor.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('apps::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('vendor.home')) }}" class="btn btn-lg red">
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
<script>
$(document).ready(function() {
    var currenciesInput =  $(".currencies");
    var selectAll       = $("#selectAll")
    selectAll.click(function(){
      if(selectAll.is(':checked') ){ //select all
        currenciesInput.find('option').prop("selected",true);
        currenciesInput.trigger('change');
      } else { //deselect all
        currenciesInput.find('option').prop("selected",false);
        currenciesInput.trigger('change');
      }
    });
});
</script> 
@endsection