@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.companies.routes.update'))
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
          <a href="{{ url(route('dashboard.companies.index')) }}">
            {{ __('user::dashboard.companies.routes.index') }}
          </a>
          <i class="fa fa-circle"></i>
        </li>
        <li>
          <a href="#">{{ __('user::dashboard.companies.routes.update') }}</a>
        </li>
      </ul>
    </div>

    <h1 class="page-title"></h1>

    <div class="row">
      <form id="updateForm"
        user="form"
        class="form-horizontal form-row-seperated"
        method="post"
        enctype="multipart/form-data"
        action="{{ route('dashboard.companies.update', $user->id) }}">
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
                          {{ __('user::dashboard.companies.form.general') }}
                        </a>
                      </li>
                      <li class="">
                        <a href="#company"
                          data-toggle="tab">
                          {{ __('user::dashboard.companies.form.company') }}
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
              <div class="tab-pane active fade in"
                id="global_setting">
                <h3 class="page-title">{{ __('user::dashboard.companies.form.general') }}</h3>
                <div class="col-md-10">


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.name') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="name"
                        value="{{ $user->name }}"
                        class="form-control"
                        data-name="name">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.code') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="code"
                        value="{{ $user->company->code }}"
                        class="form-control"
                        data-name="code">
                      <div class="help-block"></div>
                    </div>
                  </div>



                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.email') }}
                    </label>
                    <div class="col-md-9">
                      <input type="email"
                        name="email"
                        value="{{ $user->email }}"
                        class="form-control"
                        data-name="email">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.mobile') }}
                    </label>
                    <div class="col-md-3">
                      <select name="phone_code"
                        class="form-control select2"
                        data-name="phone_code">
                        <option value=""></option>
                        @foreach ($phoneCodes as $phoneCode)
                        @if (!empty($phoneCode['calling_code'][0]))
                        <option value="{{ $phoneCode['calling_code'][0] }}"
                          @if($user->phone_code == $phoneCode['calling_code'][0]) selected
                          @endif>
                          {{ $phoneCode['flag'] . ' ' . $phoneCode['code'] . ' +' .
                          $phoneCode['calling_code'][0] }}
                        </option>
                        @endif
                        @endforeach
                      </select>
                      <div class="help-block"></div>
                    </div>
                    <div class="col-md-6">
                      <input type="text"
                        name="mobile"
                        value="{{ $user->mobile }}"
                        class="form-control"
                        data-name="mobile">
                      <div class="help-block"></div>
                    </div>
                  </div>





                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.password') }}
                    </label>
                    <div class="col-md-9">
                      <input type="password"
                        name="password"
                        autocomplete="new-password"
                        class="form-control"
                        data-name="password">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.confirm_password') }}
                    </label>
                    <div class="col-md-9">
                      <input type="password"
                        name="confirm_password"
                        class="form-control"
                        data-name="confirm_password">
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
                      {{ __('user::dashboard.companies.form.image') }}
                    </label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image"
                            data-preview="holder"
                            class="btn btn-primary">
                            <i class="fa fa-image"></i>
                            {{ __('apps::dashboard.buttons.upload') }}
                          </a>
                        </span>
                        <input name="image"
                          class="form-control image"
                          type="file">

                      </div>
                      <span class="holder"
                        style="margin-top:15px;max-height:100px;">
                        <img src="{{ url($user->image) }}"
                          style="height: 15rem;max-width:100%">
                      </span>
                      <input type="hidden"
                        data-name="image">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  
                {{-- tab categories --}}
                <div class="tab-pane fade in" id="categories">
                  <h3 class="page-title">
                      {{ __('qsale::dashboard.ads.form.tabs.categories') }}
                  </h3>
                  <div id="jstree">

                    @include("user::dashboard.tree.companies.edit",['mainCategories' => $companyCategories,"companycats" => $user->company->categories->pluck('id')->toArray()])
                  </div>
                  <div class="form-group">
                      <input type="hidden" name="categories[]" id="root_category" value="" data-name="categories">
                      <div class="help-block"></div>
                  </div>
                </div>
                {{-- end --}}


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.status') }}
                    </label>
                    <div class="col-md-9">
                      <input type="checkbox"
                        class="make-switch"
                        @if($user->is_active) checked @endif id="test"
                      data-size="small" name="is_active">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.is_verified') }}
                    </label>
                    <div class="col-md-9">
                      <input type="checkbox"
                        class="make-switch"
                        @if($user->is_verified) checked @endif id="is_verified"
                      data-size="small" name="is_verified">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  @if (!$user->admin_verified)
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.admin_verified') }}
                    </label>
                    <div class="col-md-9">
                      <input type="checkbox"
                        class="make-switch"
                        id="admin_verified"
                        value="1"
                        data-size="small"
                        name="admin_verified">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  @endif










                  @if ($user->trashed())
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.users.create.form.restore') }}
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



                </div>
              </div>
              @php
              $company = $user->company;
              @endphp
              {{-- CREATE FORM --}}
              <div class="tab-pane office-data fade in"
                id="company">
                <h3 class="page-title">{{ __('user::dashboard.companies.form.company') }}</h3>
                <div class="col-md-10">


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.title') }}
                    </label>
                    <div class="col-md-9">
                      <input type="text"
                        name="title"
                        value="{{ optional($company)->title }}"
                        class="form-control"
                        data-name="title">
                      <div class="help-block"></div>
                    </div>
                  </div>



                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.description_work') }}
                    </label>
                    <div class="col-md-9">
                      <textarea name="description_work"
                        class="form-control"
                        data-name="description_work">{{ optional($company)->description_work }}</textarea>
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.address') }}
                    </label>
                    <div class="col-md-9">
                      <input name="address"
                        class="form-control"
                        value="{{  optional($company)->address  }}"
                        data-name="address" />
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group"
                    style="display: block">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.country_id') }}
                    </label>
                    <div class="col-md-9">
                      <select name="country_id"
                        id="office_country"
                        class="form-control selected"
                        data-name="country_id">
                        @foreach ($countries as $country)
                          <option value="{{ $country->id }}" {{$company->user->country_id == $country->id ? 'selected' : ''}}> {{
                            $country->translateOrDefault(locale())->title }}
                          </option>
                        @endforeach
                      </select>
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.city_id') }}
                    </label>
                    <div class="col-md-9">
                      <select name="city_id"
                        id="office_city"
                        disabled
                        data-current="{{ optional($company)->city_id }}"
                        class="form-control"
                        data-name="city_id">

                      </select>
                      <div class="help-block"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.state_id') }}
                    </label>
                    <div class="col-md-9">
                      <select name="state_id"
                        id="office_state"
                        disabled
                        data-current="{{ optional($company)->state_id }}"
                        class="form-control"
                        data-name="state_id">

                      </select>
                      <div class="help-block"></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.document') }}
                    </label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image"
                            data-preview="holder"
                            class="btn btn-primary">
                            <i class="fa fa-file-o"></i>
                            {{-- {{__('apps::dashboard.buttons.upload')}} --}}
                          </a>
                        </span>
                        <input name="document"
                          class="form-control image"
                          type="file">

                      </div>
                      <input type="hidden"
                        data-name="document">
                      <div class="help-block"></div>

                      <div class="holder"
                        style="margin-top:15px;max-height:100px;margin-top: 20px">
                        @if ($company->document)
                        @php
                        $s = $company->document;
                        $n = strrpos($s, '.');
                        $ext = $n === false ? '' : substr($s, $n + 1);
                        $name = Illuminate\Support\Str::slug($company->title ?? 'company-' .
                        $user->id, '-');
                        $name .= '.' . $ext;

                        @endphp
                        <a href="{{ url($company->document) }}"
                          download="{{ $name ?? '' }}"
                          class="btn btn-primary">
                          <i class="fa fa-download"></i>
                        </a>
                        @endif
                      </div>


                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.cover') }}
                    </label>
                    <div class="col-md-9">
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image"
                            data-preview="holder"
                            class="btn btn-primary">
                            <i class="fa fa-image"></i>
                            {{-- {{__('apps::dashboard.buttons.upload')}} --}}
                          </a>
                        </span>
                        <input name="cover"
                          class="form-control image"
                          type="file">

                      </div>

                      @if ($company->cover)
                      <span class="holder"
                        style="margin-top:15px;max-height:100px;">
                        <img src="{{ url($company->cover) }}"
                          style="height: 15rem;max-width:100%">
                      </span>
                      @endif
                      <input type="hidden"
                        data-name="cover">
                      <div class="help-block"></div>
                    </div>
                  </div>

                  @php
                  $socials = optional($company)->socials;
                  $socials = $socials ? collect($socials) : null;

                  @endphp

                  @foreach (\Modules\User\Enums\SocialType::getConstList() as $scoial)
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ $scoial }}
                    </label>
                    @php

                    $value = $socials ? $socials->firstWhere('key', $scoial) : null;

                    @endphp
                    <div class="col-md-9">
                      <input type="hidden"
                        name="socials[{{ $loop->index }}][key]"
                        value="{{ $scoial }}"
                        class="form-control">
                      <input type="text"
                        name="socials[{{ $loop->index }}][link]"
                        value="{{ optional($value)['link'] }}"
                        class="form-control"
                        data-name="office.socials.{{ $loop->index }}.link">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  @endforeach


                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('user::dashboard.companies.form.delivery_receive') }}
                    </label>
                    <div class="col-md-9">
                      <input type="checkbox"
                        class="make-switch"
                        value="1"
                        @if($company->delivery_receive) checked @endif
                      data-size="small" name="delivery_receive">
                      <div class="help-block"></div>
                    </div>
                  </div>






                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('lat') }}
                    </label>
                    <div class="col-md-9">
                      <input type="string"
                        name="lat"
                        class="form-control"
                        data-name="lat"
                        value="{{ $user->lat }}">
                      <div class="help-block"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2">
                      {{ __('long') }}
                    </label>
                    <div class="col-md-9">
                      <input type="string"
                        name="long"
                        class="form-control"
                        data-name="long"
                        value="{{ $user->long }}">
                      <div class="help-block"></div>
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
                <button type="submit"
                  id="submit"
                  class="btn btn-lg blue">
                  {{ __('apps::dashboard.buttons.add') }}
                </button>
                <a href="{{ url(route('dashboard.companies.index')) }}"
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
      var typeOfUser = $("#userType")
      var officeContainer = $(".office-data")
      var office_country = $("#office_country")
      var office_city = $("#office_city")
      var office_state = $("#office_state")
      var use_pakcage_info = $("#use_pakcage_info")
      var currentSubscription = $("#currentSubscription")
      var subscriptionData = $(".sub-data")

      // handle the type of user
      function handleUserTypeData(_elm) {
        handleCountryChangeData(office_country)
        handleEditSubscription()
      }

      //hande if use_package_info_check
      use_pakcage_info.change(function() {
        handleEditSubscription()
      })

      function handleEditSubscription() {
        if (use_pakcage_info.is(":checked")) {
          subscriptionData.find("input , textarea, .selected, select").prop('disabled', true);
          subscriptionData.hide();
        } else {
          subscriptionData.find("input , textarea, .selected, select").prop('disabled', false);
          subscriptionData.show()
        }
      }



      // handle chnage of type
      typeOfUser.change(function() {
        handleUserTypeData(typeOfUser)
      })
      handleUserTypeData(typeOfUser)

      // handle address
      function handleCountryChangeData(office_country) {
        var value = office_country.val()
        var url = "{{ route('api.areas.cities', ['country_id' => 'xid']) }}"

        if (value) {
          office_country.prop('disabled', true)
          resetOpion(office_city)
          resetOpion(office_state)
          url = url.replace('xid', value);

          $.ajax({
            headers: {
              "lang": "{{ locale() }}",
              'Content-Type': 'application/json'
            },
            url,
            success: (data) => setOptionToCity(data.data),
            error: (error) => console.log(error)
          }).done(() => office_country.prop('disabled', false));

        }
      }

      office_country.change(function() {

        handleCountryChangeData(office_country)
      })

      if (typeOfUser.val() != "user")
        handleCountryChangeData(office_country)

      function resetOpion(_elm) {
        _elm.html("");
        _elm.prop('disabled', true);
      }
    $('#jstree').jstree();
    $('#jstree').on("changed.jstree", function(e, data) {
            $('#root_category').val(data.selected);
            if(count > 0) handleCategoryAttrbiute(data.selected)
            count++;
    });

      function setOptionToCity(data) {
        var options = "";
        var selectOption = office_city.data("current")

        for (const option of data) {
          options +=
            `<option data-states='${JSON.stringify(option.states)}'   value="${option.id}" ${option.id == selectOption ? "selected" :""} >${option.title}</option>`
        }
        //    console.log(data)
        office_city.html(options);
        office_city.change()
        office_city.prop('disabled', false);
      }

      function handleCityChange(office_city) {
        var optionSelected = office_city.find("option:selected")
        var data = optionSelected.data("states");
        setOptionToState(data ? data : [])
      }

      office_city.change(function() {
        handleCityChange(office_city)
      })

      function setOptionToState(data) {
        var options = "";
        var selectOption = office_state.data("current")

        for (const option of data) {
          options +=
            `<option  value="${option.id}" ${option.id == selectOption ? "selected" :""} >${option.title}</option>`
        }
        office_state.html(options);
        office_state.change()
        office_state.prop('disabled', false);
      }




    });
</script>

@stop
