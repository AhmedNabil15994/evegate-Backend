@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.workers.update.title'))
@section('css')
    <style>
        .display-none{
            display: none !important;
        }
    </style>
@endsection
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
                    <a href="{{ url(route('dashboard.workers.index')) }}">
                        {{__('user::dashboard.workers.index.title')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('user::dashboard.workers.update.title')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            <form id="updateForm" user="form" class="form-horizontal form-row-seperated" method="post" enctype="multipart/form-data" action="{{route('dashboard.workers.update',$user->id)}}">
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
                                                    {{ __('user::dashboard.workers.create.form.general') }}
                                                </a>
                                            </li>

                                            <li class="">
                                                <a href="#worker" data-toggle="tab">
                                                    {{ __('user::dashboard.workers.create.form.worker') }}
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
                                <h3 class="page-title">{{__('user::dashboard.workers.create.form.general')}}</h3>
                                <div class="col-md-10">

                                    
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.workers.create.form.name')}}
                                        </label>
                                        <div class="col-md-9">
                                             <input type="text" name="name" value="{{$user->name}}" class="form-control" data-name="name">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                 


                                 
                                  
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.workers.create.form.email')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="email" name="email" value="{{$user->email}}" class="form-control" data-name="email">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    

                                  

                                   
                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.workers.create.form.mobile')}}
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
                                            {{__('user::dashboard.workers.update.form.password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" autocomplete="off" name="password" class="form-control" data-name="password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.workers.create.form.confirm_password')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="password" name="confirm_password" class="form-control" data-name="confirm_password">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.workers.create.form.image')}}
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
                                                <img src="{{url($user->image)}}" style="height: 15rem;">
                                            </span>
                                            <input type="hidden" data-name="image">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    

                                    
                                    
                                   

                                    <div class="form-group">
                                        <label class="col-md-2">

                                            {{__('user::dashboard.workers.create.form.status')}}
                                        </label>
                                        <div class="col-md-9">
                                            <input type="checkbox" class="make-switch" @if($user->is_active) checked @endif   id="test" data-size="small" name="is_active">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                  

                                  
                                    @if ($user->trashed())
                                      <div class="form-group">
                                          <label class="col-md-2">
                                            {{__('user::dashboard.workers.create.form.restore')}}
                                          </label>
                                          <div class="col-md-9">
                                              <input type="checkbox" class="make-switch" id="test" data-size="small" name="restore">
                                              <div class="help-block"></div>
                                          </div>
                                      </div>
                                    @endif




                                </div>
                            </div>


                            {{-- == --}}
                            <div class="tab-pane fade in" id="worker">
                                <h3 class="page-title">
                                    {{__('user::dashboard.workers.create.form.worker')}}
                                </h3>
                                <div class="col-md-10">

                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('user::dashboard.workers.create.form.vendor_id')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="vendor_id" id="vendors" data-name="vendor_id" class="form-control select2-allow-clear" >
                                              
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor['id'] }}"
                                                             {{ $user->workerProfile &&  $user->workerProfile->vendor_id == $vendor->id ? "selected" :""}}>
                                                        {{ $vendor->translateOrDefault(locale())->title }}
                                                    </option>
                                                @endforeach
                                            </select>
        
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                          {{__('user::dashboard.workers.create.form.branch_id')}}
                                        </label>
                                        <div class="col-md-9">
                                            <select name="branch_id" id="branches" data-old="{{ optional($user->workerProfile)->branch_id }}" data-name="branch_id" class="form-control select2-allow-clear" >
                                              
                                                
                                            </select>
        
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2">
                                            {{__('user::dashboard.admins.update.form.roles')}}
                                        </label>
                                        <div class="col-md-9">
                                            <div class="mt-checkbox-list">
                                                @forelse ($roles as $role)
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}" {{ $user->roles->contains($role->id) ? 'checked=""' : ''}}>
                                                    {{$role->translateOrDefault(locale())->display_name}}
                                                    <span></span>
                                                </label>
                                                @empty
                                                <p> {{__('user::dashboard.admins.create.form.not_roles')}} </p>
                                                @endforelse
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
                                    {{__('apps::dashboard.buttons.edit')}}
                                </button>
                                <a href="{{url(route('dashboard.workers.index')) }}" class="btn btn-lg red">
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
       var brancheSelect = $("#branches") ,
            vendorSelect = $("#vendors");
       $("body").on("change", "#vendors", function(){
           var _elm = $(this)
           changeBranches(_elm)           
       })

      

       function changeBranches(elment) {
           var value = elment.val();
           if(value){
            let url  = '{{ route("dashboard.vendors.branches", ":id") }}';
            url = url.replace(':id', value);
            brancheSelect.prop('disabled', 'disabled');
            $.ajax(
                {
                    url,
                   success:(data)=>setBranches(data.data) ,
                   error:(error)=>console.log(error)
                }
            ).done(()=> brancheSelect.prop('disabled', false) );
           }
       }

       function setBranches(data){
           var options = "";
           selectBranch = brancheSelect.data("old")
           for (const branche of data) {
                options += `<option value="${branche.id}" ${branche.id == selectBranch ? "selected" :""} >${branche.title}</option>`
           }
           brancheSelect.html(options);
       }

       changeBranches(vendorSelect)
    
    
    });
</script>





@stop