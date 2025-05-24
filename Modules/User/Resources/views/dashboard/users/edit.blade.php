@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.users.update.title'))
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
                    <a href="{{ url(route('dashboard.users.index')) }}">
                        {{__('user::dashboard.users.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::dashboard.users.update.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" user="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.users.update',$user->id)}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="user">
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
                                                    {{ __('user::dashboard.users.create.form.general') }}
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
                                <h3 class="page-title">{{__('user::dashboard.users.create.form.general')}}</h3>
                                <div class="col-md-10">

                                    
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.name')}}
                                        </label>
                                        <div class="col-md-9">
                                             <input type="text" name="name" value="{{$user->name}}" class="form-control" data-name="name">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
 
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.email')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="{{$user->email}}" class="form-control" data-name="email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.type')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="type" id="userType" class="form-control" data-name="type">
                                                @foreach (config("customs.users") as $type )
                                                    <option value="{{$type}}" 
                                                        {{ $user->type == $type ? "selected" : ""}}> {{__('user::dashboard.users.datatable.'.$type)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
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
                                                    {{ $user->country_id == $country->id ? "selected" : ""}}>
                                                    {{ optional($country->translateOrDefault(locale()))->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.mobile')}}
                                        </label>
                                        <div class="col-md-3">
                                            <select name="phone_code" class="form-control select2" data-name="phone_code" required>
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
                                            {{__('user::dashboard.users.update.form.password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" name="password" class="form-control" data-name="password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.confirm_password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="confirm_password" class="form-control" data-name="confirm_password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('Coins balance')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="number" name="coin_blance" class="form-control" data-name="coin_blance"
                                            value="{{$user->coin_blance}}">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.image')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                                        <i class="fa fa-picture-o"></i>
                                                        {{__('apps::dashboard.buttons.upload')}}
                                                    </a>
                                                </span>
                                                <input name="image" class="form-control image" type="file" >
                                                <span class="input-group-btn">
                                                    <a data-input="image" data-preview="holder" class="btn btn-danger delete">
                                                        <i class="glyphicon glyphicon-remove"></i>
                                                    </a>
                                                </span>
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
                                            
                                            {{__('user::dashboard.users.create.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" @if($user->is_active) checked @endif   id="test" data-size="small" name="is_active">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.users.create.form.is_verified')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch"  
                                                    @if($user->is_verified) checked @endif  id="is_verified" data-size="small" name="is_verified">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                  
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
                            
                        </div>
 

                    </div>

                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('dashboard.users.index')) }}" class="btn btn-lg red">
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
      var have_subscription = $("#have_subscription");
      var use_pakcage_info = $("#use_pakcage_info") 
      var currentSubscription = $("#currentSubscription")
      var subscriptionData    = $(".sub-data")


      //hande if use_package_info_check
      use_pakcage_info.change(function(){
          handleEditSubscription()
      })


      have_subscription.on("switchChange.bootstrapSwitch",function(event, state){
        handlHaveSubscription(state)
      })

      function handlHaveSubscription(have){
        currentSubscription.find("input , textarea, .selected, select").prop('disabled', !have)
        handleEditSubscription()
      }

      handlHaveSubscription(have_subscription.is(":checked"))
      handleEditSubscription()

      function handleEditSubscription(){
        if(use_pakcage_info.is(":checked")  ||  use_pakcage_info.attr("disabled") ){
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