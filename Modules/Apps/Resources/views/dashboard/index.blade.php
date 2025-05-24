@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.index.title'))
@section('content')

@section('css')
    @livewireStyles

    <style>
        .box-shadow {
            /* -webkit-box-shadow: 20px 5px 14px -8px rgba(199,181,199,1);
            -moz-box-shadow: 20px 5px 14px -8px rgba(199,181,199,1);
            box-shadow: 20px 5px 14px -8px rgba(199,181,199,1); */
            padding: 10px;
            margin-top: 15px
        }
    </style>
@endsection

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ url(route('dashboard.home')) }}">
                        {{ __('apps::dashboard.index.title') }}
                    </a>
                </li>
            </ul>
        </div>
        <h1 class="page-title"> {{ __('apps::dashboard.index.welcome') }} ,
            <small><b style="color:red">{{ Auth::user()->name }} </b></small>
        </h1>


       

          


            

            
        <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 yellow" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$userData['count']}}">0</span> 
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.users_count') }}</div>
                    </div>
                </a>
            </div>

           
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 yellow-lemon" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$companyData['count']}}">0</span> 
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.companies_count') }}</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$points_count}}">0</span> 
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.points_count') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red-haze" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$addationData['count']}}">0</span> 
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.addations_count') }}</div>
                    </div>
                </a>
            </div>

            

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red-pink" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$categoryData['count']}}">0</span> 
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.category_count') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$adsData['count']}}">0</span> 
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.ads_count') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue-steel" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$adsData['count_free']}}">0</span>  
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.ads_free_count') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue-ebonyclay" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{$adsData['total']}}">0</span> {{setting('default_currency') ?? 'KWD'}}
                        </div>
                        <div class="desc">{{ __('apps::dashboard.index.statistics.ads_total') }}</div>
                    </div>
                </a>
            </div>

           
         


            

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">
                                {{ __('apps::dashboard.index.statistics.title') }}
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="mt-element-card mt-card-round mt-element-overlay">
                            <div class="row">
                                <div class="general-item-list">

                                    <div class="col-md-6">
                                        <b class="page-title">
                                          {{ __('apps::dashboard.index.statistics.users_created_at') }}
                                        </b>
                                        <canvas id="myChart2" width="540" height="270"></canvas>
                                    </div>

                                    <div class="col-md-6">
                                        <b class="page-title">
                                            {{ __('apps::dashboard.index.statistics.ads_created_monthly') }}
                                           
                                        </b>    
                                        <canvas id="count_ads_month" width="540" height="270"></canvas>
                                    </div>

                                   

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@stop


{{-- JQUERY++ --}}
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>


<script>
   function shuffleArray(array2) {
        let array = JSON.parse(JSON.stringify(array2))
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
        return array
    }

    // USERS COUNT BY DATE
    var ctx = document.getElementById("myChart2").getContext('2d');
    var backgroundColor = [
                    "#2ea0ee",
                    "#34495e",
                    "#f2c500",
                    "#2ac6d4",
                    "#e74c3c",
                    "#65334D" ,
                    "#2D1115" ,
                    "#8A817C",
                    "#E0AFA0",
                    "#62A8AC",
                    "#7D938A" ,
                    "#55286F"
    ]
    var labels = {!!$userCreated['userDate'] !!};
    var countDate = {!!$userCreated['countDate'] !!};
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '{{ __('apps::dashboard.index.statistics.users_created_at') }}',
                data: countDate,
                backgroundColor: shuffleArray(backgroundColor),
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54 , 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75 , 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


    var ctx3= document.getElementById("count_ads_month").getContext('2d');
  
    var labels2 = {!!$adsData['graph_count']['transform_dates'] !!};
    var transformPaided = {!!$adsData['graph_count']['transformPaided'] !!};
    var transformFree = {!!$adsData['graph_count']['transformFree'] !!};
    var myChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels2,
            datasets: [{
                label: '{{ __('apps::dashboard.index.statistics.ads_paied_count') }}',
                data: transformPaided,
                backgroundColor:shuffleArray(backgroundColor),
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54 , 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75 , 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: '{{ __('apps::dashboard.index.statistics.ads_free_count') }}',
                data: transformFree,
                backgroundColor: shuffleArray(backgroundColor)  ,
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54 , 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75 , 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }
        ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

   



   

   


   

  
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>



@permission('statistics')
@endpermission
@stop