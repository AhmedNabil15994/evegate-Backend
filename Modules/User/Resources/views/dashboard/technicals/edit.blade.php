@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.technicals.routes.create'))
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
                    <a href="{{ url(route('dashboard.technicals.index')) }}">
                        {{__('user::dashboard.technicals.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::dashboard.technicals.routes.create')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" user="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.technicals.update',$user->id)}}">
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
                                                    {{ __('user::dashboard.technicals.form.general') }}
                                                </a>
                                            </li>


                                            <li class="">
                                                <a href="#currentSubscription" data-toggle="tab">
                                                    {{ __('user::dashboard.technicals.form.currentSubscription.tab') }}
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

                            {{-- CREATE office --}}
                            <div class="tab-pane  active fade in" id="global_setting">
                                <h3 class="page-title">{{__('user::dashboard.technicals.form.general')}}</h3>
                                <div class="col-md-10">


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.name')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" value="{{$user->name}}" class="form-control" data-name="name">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.email')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="{{$user->email}}" class="form-control" data-name="email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.mobile')}}
                                        </label>
                                        <div class="col-md-3">
                                            <select name="phone_code" class="form-control select2" data-name="phone_code" >
                                                <option value=""></option>
                                                @foreach ($phoneCodes as $phoneCode)
                                                @if (!empty($phoneCode['calling_code'][0]))
                                                <option value="{{ $phoneCode['calling_code'][0] }}"  @if($user->phone_code == $phoneCode['calling_code'][0] ) selected @endif>
                                                    {{ $phoneCode['flag'] .' '.$phoneCode['code'] . ' +' . $phoneCode['calling_code'][0] }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" data-name="mobile">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="password" autocomplete="off" class="form-control" data-name="password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.confirm_password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="confirm_password" class="form-control" data-name="confirm_password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.image')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                                        <i class="fa fa-image"></i>
                                                        {{__('apps::dashboard.buttons.upload')}}
                                                    </a>
                                                </span>
                                                <input name="image" class="form-control image" type="file" >

                                            </div>
                                            <span class="holder" style="margin-top:15px;max-height:100px;">
                                                <img src="{{url($user->image)}}" style="height: 15rem;max-width:100%">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" @if($user->is_active) checked @endif id="test" data-size="small" name="is_active">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.is_verified')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"
                                            @if($user->is_verified) checked @endif  id="is_verified" data-size="small" name="is_verified">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    @if(!$user->admin_verified)
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.admin_verified')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"
                                              id="admin_verified" value="1" data-size="small" name="admin_verified">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($user->trashed())
                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('user::dashboard.users.create.form.restore')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" id="test" data-size="small" name="restore">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                  @endif



                                </div>
                            </div>


                             @php
                                $currentSubscription = $user->currentSubscription;
                            @endphp
                            <div class="tab-pane  fade in office-data" id="currentSubscription">
                                <h3 class="page-title">{{ __('user::dashboard.technicals.form.currentSubscription.tab') }}</h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.technicals.form.package_id')}}
                                        </label>
                                        <div class="col-md-9">

                                            <select name="package_id" class="form-control selected" data-name="package_id">
                                                @foreach ($packages as $package )
                                                    <option value="{{$package->id}}"
                                                        {{ optional($user->currentSubscription)->package_id == $package->id ? "selected" : ""}}
                                                             > {{$package->title}}</option>
                                                @endforeach
                                            </select>

                                            <div class="help-block"></div>
                                        </div>
                                        <label>{{ __('user::dashboard.technicals.form.currentSubscription.use_pakcage_info') }}</label>
                                        <input type="checkbox" id="use_pakcage_info"  value="1" name="use_pakcage_info" />
                                    </div>

                                    <div class="sub-data" style="display: none">
                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('user::dashboard.technicals.form.currentSubscription.current_use') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" name="subscription[current_use]"  class="form-control" value="{{optional($currentSubscription)->current_use}}"  data-name="subscription.current_use">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('user::dashboard.technicals.form.currentSubscription.max_use') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" name="subscription[max_use]" value="{{optional($currentSubscription)->max_use}}"  class="form-control" data-name="subscription.max_use">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('user::dashboard.technicals.form.currentSubscription.duration_of_ads') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="number" name="subscription[duration_of_ads]" value="{{optional($currentSubscription)->duration_of_ads}}"  class="form-control" data-name="subscription.duration_of_ads">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('user::dashboard.technicals.form.currentSubscription.start_at') }}
                                            </label>

                                            <div class="col-md-9">
                                                <div class="input-group input-medium date date-picker" data-name="subscription.start_at" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                    <input type="text" class="form-control"
                                                            name="subscription[start_at]"
                                                            value="{{optional($currentSubscription)->start_at}}" >
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('user::dashboard.technicals.form.currentSubscription.end_at') }}
                                            </label>

                                            <div class="col-md-9">
                                                <div class="input-group input-medium date date-picker" data-name="subscription.end_at" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                                    <input type="text" class="form-control"
                                                            name="subscription[end_at]"
                                                            value="{{optional($currentSubscription)->end_at}}" >
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2">
                                                {{ __('user::dashboard.technicals.form.currentSubscription.money') }}
                                            </label>
                                            <div class="col-md-9">
                                                <input type="text" name="subscription[money]"  min="0"  value="{{optional($currentSubscription)->money}}" class="form-control" data-name="office.money">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>


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
                                <a href="{{url(route('dashboard.technicals.index')) }}" class="btn btn-lg red">
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
    $(function() {
      var typeOfUser = $("#userType")
      var officeContainer = $(".office-data")
      var office_country  = $("#office_country")
      var office_city     = $("#office_city")
      var office_state    = $("#office_state")
      var use_pakcage_info = $("#use_pakcage_info")
      var currentSubscription = $("#currentSubscription")
      var subscriptionData    = $(".sub-data")


       //hande if use_package_info_check
      use_pakcage_info.change(function(){
          handleEditSubscription()
      })

      handleEditSubscription()

      function handleEditSubscription(){
        if(use_pakcage_info.is(":checked")){
            subscriptionData.find("input , textarea, .selected, select").prop('disabled', true);
            subscriptionData.hide();
          }else{
            subscriptionData.find("input , textarea, .selected, select").prop('disabled', false);
            subscriptionData.show()
          }
      }






    });


</script>

@stop
