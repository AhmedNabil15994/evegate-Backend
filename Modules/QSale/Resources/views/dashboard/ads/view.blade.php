@extends('apps::dashboard.layouts.app')
@section('title', __('qsale::dashboard.ads.routes.show') )
@section('content')
  <style type="text/css" media="print">
  	@page {
  		size  : auto;
  		margin: 0;
  	}
  	@media print {
  		a[href]:after {
  		content: none !important;
  	}
  	.contentPrint{
  			width: 100%;
  		}
  		.no-print, .no-print *{
  			display: none !important;
  		}
  	}
  </style>
  @php
      $user = $model->user;
      $adsOrder = $model->adsOrders;
  @endphp
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ url(route('dashboard.ads.index')) }}">
                        {{__('qsale::dashboard.ads.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('qsale::dashboard.ads.routes.show')}}</a>
                </li>
            </ul>
        </div>
 
        <h1 class="page-title"></h1>

        <div class="row">
            <div class="col-md-12">
                <div class="no-print">
                    <div class="col-md-3">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">

                                <a data-toggle="tab" href="#general">
                                    <i class="fa fa-cog"></i> {{ __('qsale::dashboard.ads.form.tabs.general') }}
                                </a>

                            
                                <span class="after"></span>
                            </li>

                            <li class="attachs">

                                <a data-toggle="tab" href="#attachs">
                                    <i class="fa fa-cog"></i> {{ __('qsale::dashboard.ads.form.tabs.attachs') }}
                                </a>

                            
                                <span class="after"></span>
                            </li>

                            @if($model->payment)
                            <li >
                                <a data-toggle="tab" href="#payment">
                                    <i class="fa fa-cog"></i>{{ __('qsale::dashboard.ads.form.tabs.payment') }}
                                </a>
                                <span class="after"></span>
                            </li>
                            @endif

                            @if($adsOrder->count() > 0)
                            <li >
                                <a data-toggle="tab" href="#adsOrder">
                                    <i class="fa fa-cog"></i>{{ __('qsale::dashboard.ads.form.tabs.adsOrder') }}
                                </a>
                                <span class="after"></span>
                            </li>
                            @endif

                            @if($user)
                            <li >
                                <a data-toggle="tab" href="#user">
                                    <i class="fa fa-cog"></i> {{__('qsale::dashboard.ads.datatable.user_id')}}
                                </a>
                                <span class="after"></span>
                            </li>
                            @endif

                            <li class="complaints">

                                <a data-toggle="tab" href="#complaints">
                                    <i class="fa fa-cog"></i> {{ __('qsale::dashboard.ads.form.tabs.complaints') }}
                                </a>

                            
                                <span class="after"></span>
                            </li>
                           
                           

                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 contentPrint">
                    @include('apps::dashboard.layouts._msg')
                    <div class="tab-content">
                        {{-- start --}}
                        <div class="tab-pane active" id="general">
                            <div class="invoice-content-2 bqsaleed">
                                <div class="row invoice-head">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="row invoice-logo">
                                            <div class="col-xs-6">
                                                <img src="{{ optional($model->getFirstMedia("default_image"))->getUrl() ?? url('/uploads/uploads/default.png')}}" class="img-responsive" style="width:40%" />
                                                <span>
                                                    {{$model->name  }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="company-address">
                                            <h6 class="uppercase">#{{$model['id'] }}</h6>
                                            <h6 class="uppercase">{{date('Y-m-d / H:i:s' , strtotime($model->created_at))}}</h6>
                                            <span>{{__('qsale::dashboard.ads.datatable.is_publish')}}</span> 
                                            @if ($model->checkIsPublish())
                                                  <span class="badge badge-success"> {{__('apps::dashboard.datatable.yes')}} </span>
                                                @else
                                                <span class="badge badge-warning"> {{__('apps::dashboard.datatable.no')}} </span>
                                            @endif
                                            <br />
                                        </div>
                                    </div>
                                    <div class="row invoice-body" >
                                        <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                            <table class="table table-bordered ">
                                               
                                                <tbody>
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.title')}}
                                                        </td>
                                                        <td>
                                                            {{$model->title ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.description')}}
                                                        </td>
                                                        <td>
                                                            {{$model->description ?? '-----' }}
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.category_id')}}
                                                        </td>

                                                        <td>
                                                            @if($model->category)
                                                            {{ optional($model->category)->translateOrDefault(locale())->title ?? '-----' }}
                                                            @endif
                                                        </td>
                                                    </tr>
    

                                                
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.status')}}
                                                        </td>
                                                        <td>
                                                         
                                                            <span class="badge badge-info"> {{__('qsale::dashboard.ads.datatable.status_enum.'.$model->status)}} </span>
                                                               
                                                           
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.total')}}
                                                        </td>
                                                        <td>
                                                            {{$model->total ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.is_paid')}}
                                                        </td>
                                                        <td>
                                                         
                                                            @if ($model->is_paid == 1) 
                                                                 <span class="badge badge-success"> {{__('apps::dashboard.datatable.yes')}} </span>
                                                                @else
                                                                <span class="badge badge-danger"> {{__('apps::dashboard.datatable.no')}} </span>
                                                              @endif  
                                                           
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.addation_total')}}
                                                        </td>
                                                        <td>
                                                            {{$model->addation_total ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    @if($model->subscription)

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.subscription_id')}}
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-info">{{__('apps::dashboard.datatable.yes')}}</span> - 
                                                            <span>{{optional($model->subscription->package)->title}}</span>

                                                        </td>
                                                    </tr>
                                                    @endif
                                                    
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.ads_price')}}
                                                        </td>
                                                        <td>
                                                            {{$model->ads_price ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.duration')}}
                                                        </td>
                                                        <td>
                                                            {{$model->duration ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                     
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.start_at')}}
                                                        </td>
                                                        <td>
                                                            {{$model->start_at ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.end_at')}}
                                                        </td>
                                                        <td>
                                                            {{$model->end_at ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.type')}}
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-info"> {{ $model->type }} </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.hide_private_number')}}
                                                        </td>
                                                      
                                                        <td>
                                                         
                                                            @if ($model->hide_private_number == 1) 
                                                                 <span class="badge badge-success"> {{__('apps::dashboard.datatable.yes')}} </span>
                                                                @else
                                                                <span class="badge badge-danger"> {{__('apps::dashboard.datatable.no')}} </span>
                                                              @endif  
                                                           
                                                        </td>
                                                    </tr>

                                                  

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.mobile')}}
                                                        </td>
                                                        <td>
                                                            {{$model->mobile ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.user_id')}}
                                                        </td>
                                                        <td>
                                                            {{ optional($model->user)->name ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.office_id')}}
                                                        </td>
                                                        <td>
                                                            {{ optional($model->office)->title ?? '-----' }}
                                                        </td>
                                                    </tr>

                                                    {{-- <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.country_id')}}
                                                        </td>

                                                        <td>
                                                            @if($model->country)
                                                            {{ optional($model->country)->translateOrDefault(locale())->title ?? '-----' }}
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.city_id')}}
                                                        </td>

                                                        <td>
                                                            @if($model->city)
                                                            {{ optional($model->city)->translateOrDefault(locale())->title ?? '-----' }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                   

                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.state_id')}}
                                                        </td>

                                                        <td>
                                                            @if($model->state)
                                                            {{ optional($model->state)->translateOrDefault(locale())->title ?? '-----' }}
                                                            @endif
                                                        </td>
                                                    </tr> --}}

                                                    @if($model->address->count()> 0)
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.address')}}
                                                        </td>

                                                        <td>
                                                            @foreach ($model->address as $address)
                                                                <p>
                                                                    {{ $address->getAddress()}}
                                                                </p>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    @endif


                                                    @if($model->attributes->count() > 0)
                                                        @foreach ($model->attributes as $attribute)
                                                            <tr>
                                                                <td class="invoice-title uppercase" style="width: 200px">
                                                                    {{$attribute->attribute->name}}
                                                                </td>
                                                                <td>
                                                                    @if ($attribute->option)
                                                                        {{$attribute->option->value}}
                                                                        @else
                                                                        @if($attribute->attribute->type == "boolean")
                                                                                @if ($attribute->value == 1) 
                                                                                <span class="badge badge-success"> {{__('apps::dashboard.datatable.yes')}} </span>
                                                                                @else
                                                                                <span class="badge badge-danger"> {{__('apps::dashboard.datatable.no')}} </span>
                                                                                @endif  
                                                                        @else
                                                                        {{$attribute->value ?? "------------"}}
                                                                        @endif

                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            
                                                        @endforeach

                                                    @endif  
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            {{__('qsale::dashboard.ads.datatable.addations')}}
                                                        </td>
                                                        <td>
                                                            @forelse ($model->addations as $addation)
                                                                <span class="badge badge-success">{{$addation->addation->name}}</span>
                                                            @empty
                                                                ---------------------
                                                            @endforelse
                                                        </td>
                                                    </tr>
                                                    
                                               
    

                                                </tbody>
                                                <thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}

                         {{-- start --}}
                         <div class="tab-pane " id="attachs">
                            <div class="invoice-content-2 bqsaleed">
                                <div class="row invoice-head">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="row invoice-logo">
                                            <div class="col-xs-12">
                                                <h3 class="h1">{{ __('qsale::dashboard.ads.form.tabs.attachs') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row invoice-body" >
                                        <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                            <table class="table table-bordered ">
                                                @foreach ($model->getMedia("attachs") as $attach)
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            <span> {{$attach->file_name}}</span> -  <span class="badge badge-info"> {{$attach->mime_type}}</span>
                                                        </td>
                                                        <td class="invoice-title uppercase">
                                                            <a download href="{{$attach->getUrl()}}">
                                                                @if (strpos($attach->mime_type, "image") !== false)
                                                                    <img src="{{$attach->getUrl()}}" width="200" />
                                                                @else
                                                                {{ $attach->name}}
                                                                @endif

                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($model->getMedia("video") as $video)
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            <span> {{$video->file_name}}</span> -  <span class="badge badge-info"> {{$video->mime_type}}</span>
                                                        </td>
                                                        <td class="invoice-title uppercase">
                                                           
                                                            <video width="320" height="240" controls>
                                                                <source src="{{$video->getUrl()}}" type=video/mp4>
                                                            </video>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}

                          {{-- start --}}
                          <div class="tab-pane " id="complaints">
                            <div class="invoice-content-2 bqsaleed">
                                <div class="row invoice-head">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="row invoice-logo">
                                            <div class="col-xs-12">
                                                <h3 class="h1">{{ __('qsale::dashboard.ads.form.tabs.complaints') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row invoice-body" >
                                        <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                            <table class="table table-striped table-bordered table-hover" id="dataTable" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th >#</th>
                                                        <th >{{__('qsale::dashboard.ads.datatable.complaints.name')}}</th>
                                                        <th>{{__('qsale::dashboard.ads.datatable.complaints.message')}}</th>
                                                        <th >{{__('qsale::dashboard.ads.datatable.created_at')}}</th>
                                                    </tr>
                                                </thead>
            
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}

                        @if($model->payment)
                        {{-- start --}}
                        <div class="tab-pane " id="payment">
                            <div class="invoice-content-2 blearned">
                                <div class="row invoice-head">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="row invoice-logo">
                                            <h3>{{ __('qsale::dashboard.ads.form.tabs.payment') }}</h3>
                                        </div>
                                    </div>
                                    
                                    <div class="row invoice-body" >
                                        <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                            <table class="table table-bordered ">
                                                
                                                <tbody>
                                                    <tr>
                                                        <td class="invoice-title uppercase" style="width: 200px">
                                                            #
                                                        </td>
                                                        <td>
                                                            {{ $model->payment->id }}
                                                        </td>
                                                    </tr>
                                                
                                                @if($model->payment->transaction && is_array($model->payment->transaction))
                                                        @foreach ($model->payment->transaction as $key=> $value)
                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{ $key}}
                                                            </td>
                                                            <td>
                                                                @if (is_array($value))
                                                                    <ul>
                                                                        @foreach ($value as $title=> $item)
                                                                            @if(is_array($item))
                                                                            @foreach($item as $suTtitle => $subItem )
                                                                            <li> {{$suTtitle}} :   {{$subItem}}</li>
                                                                            @endforeach
                                                                            @else
                                                                                 <li> {{$title}} :   {{$item}}</li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                   
                                                                    @else
                                                                    {{ $value }}
                                                                @endif
                                                               
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                @endif

                                                    


                                                

                                                </tbody>
                                                <thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                        @endif

                        @if($adsOrder->count() > 0)
                        {{-- start --}}
                        <div class="tab-pane " id="adsOrder">
                            <div class="invoice-content-2 blearned">
                                <div class="row invoice-head">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="row invoice-logo">
                                            <h3>{{ __('qsale::dashboard.ads.form.tabs.adsOrder') }}</h3>
                                        </div>
                                    </div>
                                    
                                    <div class="row invoice-body" >
                                        <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                            <table class="table table-bordered ">

                                                <thead>
                                                    <tr>
                                                        <th class="invoice-title uppercase text-center">
                                                            #
                                                        </th>

                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('qsale::dashboard.ads.datatable.total')}}
                                                        </th>
                                                        
                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('qsale::dashboard.ads.datatable.addations')}}
                                                        </th>
                                                        

                                                        <th class="invoice-title uppercase text-center">
                                                            {{__('qsale::dashboard.ads.datatable.is_paid')}}
                                                        </th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    @foreach ($adsOrder as $item)
                                                   

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{ $item->id }}
                                                            </td>
                                                            <td>
                                                                {{ $item->total }}
                                                            </td>
                                                            <td>
                                                               
                                                                @if($item->addations)
                                                               
                                                                    @foreach ($item->addations as $addaiton)
                                                                    
                                                                        <span class="badge badge-info">{{$addaiton->addation->name}}</span>
                                                                    @endforeach
                                                                @endif
                                                                
                                                            </td>
                                                            <td>
                                                                @if ($model->is_paid)
                                                                        <span class="badge badge-success"> {{__('apps::dashboard.datatable.yes')}} </span>
                                                                        @else
                                                                        <span class="badge badge-warning"> {{__('apps::dashboard.datatable.no')}} </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                
                                               
                                                    


                                                

                                                </tbody>
                                                <thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end --}}
                        @endif

                          @if($user)
                            {{-- start --}}
                            <div class="tab-pane " id="user">
                                <div class="invoice-content-2 blearned">
                                    <div class="row invoice-head">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="row invoice-logo">
                                                <h3> {{__('qsale::dashboard.ads.datatable.user_id')}}</h3>
                                            </div>
                                        </div>
                                        
                                        <div class="row invoice-body" >
                                            <div class="col-xs-12 table-responsive" style="margin-top: 20px">
                                                <table class="table table-bordered ">
                                                    
                                                    <tbody>
                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.users.datatable.image')}}
                                                            </td>
                                                            <td>
                                                                <img src="{{ url($user->image ??  setting('favicon') ) }}" class="img-responsive" style="width:40%;max-height: 200px" />
                                                            </td>
                                                        </tr>
                                                       
                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.users.datatable.name')}}
                                                            </td>
                                                            <td>
                                                                {{ $user->name ?? '-----' }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.users.datatable.email')}}
                                                            </td>
                                                            <td>
                                                                {{ $user->email ?? '-----' }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.users.datatable.mobile')}}
                                                            </td>
                                                            <td>
                                                                
                                                                    @if(locale() != "ar")
                                                                        {{ '+'.$user->phone_code.$user->mobile }}
                                                                        @else
                                                                            {{ $user->phone_code.$user->mobile."+"  }}
                                                                    @endif
                                                               
                                                            </td>
                                                        </tr>

                                                        

                                                        <tr>
                                                            <td class="invoice-title uppercase" style="width: 200px">
                                                                {{__('user::dashboard.users.datatable.created_at')}}
                                                            </td>
                                                            <td>
                                                                
                                                                {{ $user->created_at->format("d-m-Y h:i a")}}
                                                            </td>
                                                        </tr>

                                                        


                                                      

                                                    </tbody>
                                                    <thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end --}}
                        @endif

                      
                       

                      

                        
                    </div>

                </div>
            </div>

            <div class="col-md-12 hidden-print">
                <div class="col-xs-4">
                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
                        {{__('apps::dashboard.buttons.print')}}
                        <i class="fa fa-print"></i>
                    </a>
                    <a href="{{url(route('dashboard.ads.index')) }}" class="btn btn-lg red">
                        {{__('apps::dashboard.buttons.back')}}
                    </a>
                </div>
                
            </div>

         

        </div>
    </div>
</div>

@stop

@section('scripts')

  <script>
       function tableGenerate(data='') {
    var url = "{{ url(route('dashboard.ads.complaints', ['id'=>':id'])) }}" 
    url = url.replace(':id', "{{$model->id}}");

var dataTable =
$('#dataTable').DataTable({
    ajax : {
        url   : url,
        type  : "GET",
        data  : {
            req : data,
        },
    },
    language: {
        url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
    },
    stateSave: true,
    processing: true,
    serverSide: true,
    responsive: !0,
    order     : [[ 3 , "desc" ]],
    columns: [
      {data: 'id' 		 	        , className: 'dt-center'},    
      {data: 'name' 	        , className: 'dt-center'},
      {data: 'message' 	        , className: 'dt-center'},
      {data: 'created_at' 		  , className: 'dt-center'},
        ],
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50 , 100 , 500 ],
        [ '10', '25', '50', '100' , '500']
    ],
            buttons:[
                {
                      extend: "pageLength",
          className: "btn blue btn-outline",
          text: "{{__('apps::dashboard.datatable.pageLength')}}",
          exportOptions: {
              stripHtml : false,
              columns: ':visible',
              columns: [ 1 , 2 , 3 , 4 , 5, 6]
          }
                },
                {
                      extend: "print",
          className: "btn blue btn-outline" ,
          text: "{{__('apps::dashboard.datatable.print')}}",
          exportOptions: {
              stripHtml : false,
              columns: ':visible',
              columns: [ 1 , 2 , 3 , 4 , 5, 6]
          }
                },
                {
                        extend: "pdf",
          className: "btn blue btn-outline" ,
          text: "{{__('apps::dashboard.datatable.pdf')}}",
          exportOptions: {
              stripHtml : false,
              columns: ':visible',
              columns: [ 1 , 2 , 3 , 4 , 5, 6]
          }
                },
                {
                        extend: "excel",
          className: "btn blue btn-outline " ,
          text: "{{__('apps::dashboard.datatable.excel')}}",
          exportOptions: {
              stripHtml : false,
              columns: ':visible',
              columns: [ 1 , 2 , 3 , 4 , 5, 6]
          }
                },
                {
                        extend: "colvis",
          className: "btn blue btn-outline",
          text: "{{__('apps::dashboard.datatable.colvis')}}",
          exportOptions: {
              stripHtml : false,
              columns: ':visible',
              columns: [ 1 , 2 , 3 , 4 , 5, 6]
          }
                }
            ]
});
}

jQuery(document).ready(function() {
tableGenerate();
});
  </script>

@stop
