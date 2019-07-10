@extends('dashboard.layout')

@section('script')
	<!-- Theme JS files -->

    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/user_pages_team.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/') }}/js/core/app.js"></script>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
	<!-- /theme JS files -->
@endsection

@section('content')



<!-- Dashboard content -->
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-flat cards" style="">

                <div class="panel-heading">
                    <h5 class="panel-title"> <u> {{ trans('dash.statics_speed') }} </u> </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body" >
                    <!-- Quick stats boxes -->
                    <div class="row">


                        <div>
                            <div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>

                            <script>
                                Highcharts.chart('container', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: '{{ trans("dash.statics_yearly") }}'
                                },
                                subtitle: {
                                    text: 'Devloped By : Mohamed Elsherbiny'
                                },
                                xAxis: {
                                    categories: [
                                        '{{ $sub_11_month }}',
                                        '{{ $sub_10_month }}',
                                        '{{ $sub_9_month }}',
                                        '{{ $sub_8_month }}',
                                        '{{ $sub_7_month }}',
                                        '{{ $sub_6_month }}',
                                        '{{ $sub_5_month }}',
                                        '{{ $sub_4_month }}',
                                        '{{ $sub_3_month }}',
                                        '{{ $sub_2_month }}',
                                        '{{ $sub_1_month }}',
                                        '{{ $current_month }}'
                                    ],
                                    crosshair: true
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Count'
                                    }
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: '{{ trans("dash.delivered_order_counter") }}',
                                    data: [
                                        {{ $normal_user_count_sub_11_month }},
                                        {{ $normal_user_count_sub_10_month }},
                                        {{ $normal_user_count_sub_9_month }},
                                        {{ $normal_user_count_sub_8_month }},
                                        {{ $normal_user_count_sub_7_month }},
                                        {{ $normal_user_count_sub_6_month }},
                                        {{ $normal_user_count_sub_5_month }},
                                        {{ $normal_user_count_sub_4_month }},
                                        {{ $normal_user_count_sub_3_month }},
                                        {{ $normal_user_count_sub_2_month }},
                                        {{ $normal_user_count_sub_1_month }},
                                        {{ $normal_user_count_current_month }},
                                        ]

                                }, {
                                    name: '{{ trans("dash.profit") }}',
                                    data: [
                                        {{ $fitness_expert_count_sub_11_month }},
                                        {{ $fitness_expert_count_sub_10_month }},
                                        {{ $fitness_expert_count_sub_9_month }},
                                        {{ $fitness_expert_count_sub_8_month }},
                                        {{ $fitness_expert_count_sub_7_month }},
                                        {{ $fitness_expert_count_sub_6_month }},
                                        {{ $fitness_expert_count_sub_5_month }},
                                        {{ $fitness_expert_count_sub_4_month }},
                                        {{ $fitness_expert_count_sub_3_month }},
                                        {{ $fitness_expert_count_sub_1_month }},
                                        {{ $fitness_expert_count_sub_2_month }},
                                        {{ $fitness_expert_count_current_month }},
                                        ]

                                }, {
                                    name: '{{ trans("dash.client") }}',
                                    data: [
                                        {{ $client_count_sub_11_month }},
                                        {{ $client_count_sub_10_month }},
                                        {{ $client_count_sub_9_month }},
                                        {{ $client_count_sub_8_month }},
                                        {{ $client_count_sub_7_month }},
                                        {{ $client_count_sub_6_month }},
                                        {{ $client_count_sub_5_month }},
                                        {{ $client_count_sub_4_month }},
                                        {{ $client_count_sub_3_month }},
                                        {{ $client_count_sub_2_month }},
                                        {{ $client_count_sub_1_month }},
                                        {{ $client_count_current_month }},
                                    ]

                                }, {
                                    name: '{{ trans("dash.providers") }}',
                                    data: [
                                        {{ $provider_count_sub_11_month }},
                                        {{ $provider_count_sub_10_month }},
                                        {{ $provider_count_sub_9_month }},
                                        {{ $provider_count_sub_8_month }},
                                        {{ $provider_count_sub_7_month }},
                                        {{ $provider_count_sub_6_month }},
                                        {{ $provider_count_sub_5_month }},
                                        {{ $provider_count_sub_4_month }},
                                        {{ $provider_count_sub_3_month }},
                                        {{ $provider_count_sub_2_month }},
                                        {{ $provider_count_sub_1_month }},
                                        {{ $provider_count_current_month }},
                                    ]

                                }]
                            });
                            </script>
                        </div>


                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-blue-400">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.active') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $cities_counter }} </h3>
                                        <h5> {{ trans('dash.cities_count') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-grey-400" style="background-color: #9b59b6;color: #fff;">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.active') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $order_deliverd_counter }} </h3>
                                        <h5> {{ trans('dash.delivered_order_counter') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-pink-400" style="background-color: #3498db;color: #fff;">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.active') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $order_active_counter }} </h3>
                                        <h5> {{ trans('dash.active_order_counter') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-blue-400" style="background-color: #e67e22;color: #fff;">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.active') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $users_active_counter }} </h3>
                                        <h5> {{ trans('dash.active_users_counter') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-grey-400" style="background-color: #e74c3c;color: #fff;">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.active') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $provider_active_counter }} </h3>
                                        <h5> {{ trans('dash.driver_active_counter') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-pink-400" style="background-color: #c0392b;color: #fff;">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.deactive') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $users_deactive_counter }} </h3>
                                        <h5> {{ trans('dash.users_deactive_counter') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-4">
                            <a href="#">
                                <div class="panel bg-blue-400" style="background-color: #f1c40f;color: #fff;">
                                    <div class="panel-body">
                                        <div class="heading-elements">
                                            <span class="heading-text badge bg-grey-800"> {{ trans('dash.deactive') }} </span>
                                        </div>
                                        <h3 class="no-margin"> {{ $provider_deactive_counter }} </h3>
                                        <h5> {{ trans('dash.driver_deactive_counter') }} </h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                    <!-- /quick stats boxes -->
                </div>
        </div>


    </div>

    <div class="col-lg-12">


        <!-- My messages -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title"> {{ trans('dash.last_activities') }} </h6>
                <div class="heading-elements">
                    <span class="heading-text"><i class="icon-history text-warning position-left"></i> {{ date('M-d') }} , {{ date('H:i:s') }}</span>
                    <span class="label bg-success heading-text">Online</span>
                </div>
            </div>


            <!-- Tabs -->
            <ul class="nav nav-lg nav-tabs nav-justified no-margin no-border-radius bg-indigo-400 border-top border-top-indigo-300">
                <li class="active">
                    <a href="#last_finished_orders" class="text-size-small text-uppercase" data-toggle="tab">
                        {{ trans('dash.last_finished_orders') }}
                    </a>
                </li>

                <li>
                    <a href="#last_delivery_registered" class="text-size-small text-uppercase" data-toggle="tab">
                        {{ trans('dash.last_delivery_registered') }}
                    </a>
                </li>

                <li>
                    <a href="#last_client_registered" class="text-size-small text-uppercase" data-toggle="tab">
                        {{ trans('dash.last_client_registered') }}
                    </a>
                </li>
            </ul>
            <!-- /tabs -->


            <!-- Tabs content -->
            <div class="tab-content">
                <div class="tab-pane active fade in has-padding" id="last_finished_orders">
                    <ul class="media-list">
                        @forelse($last_5_orders as $order)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ $order->imageurlorg }}" data-popup="lightbox">
                                    <img src=" {{ $order->imageurl }} " class="img-circle img-lg" alt="">
                                </a>
                            </div>

                            <div class="media-body">
                                <a href="{{ route('order_show',['id' => $order->id ]) }}" target="_blank">
                                    {{ $order->place_name }}
                                    <span class="media-annotation pull-right"> {{ $order->created_at->format('M-d , H:i') }} </span>
                                </a>
                                <br>
                                {{ trans('dash.delivery') }} : @if($order->delivery) <a href="{{ route('user_profile_driver',['id' => $order->delivery_id ]) }}" target="_blank"> {{ $order->delivery->full_name }} </a> @endif <br>
                                {{ trans('dash.client') }} : @if($order->user) {{ $order->user->full_name }} @endif
                                <span class="display-block text-muted"> {{ str_limit($order->content,100,'...') }} -- {{ $order->price }} {{ trans('dash.sr') }}  </span>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>

                <div class="tab-pane fade has-padding" id="last_delivery_registered">
                    <ul class="media-list">
                        @forelse($last_5_deliveries as $delivery)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ $delivery->imageurlorg }}" data-popup="lightbox">
                                    <img src=" {{ $delivery->imageurl }} " class="img-circle img-lg" alt="">
                                </a>
                            </div>

                            <div class="media-body">
                                <a href="{{ route('user_profile_driver',['id' => $delivery->id ]) }}" target="_blank">
                                    {{ $delivery->full_name }}
                                    <span class="media-annotation pull-right"> {{ $delivery->created_at->format('M-d , H:i') }} </span>
                                </a>

                                <span class="display-block text-muted"> {{ $delivery->email }} - {{ $delivery->mobile }} </span>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>

                <div class="tab-pane fade has-padding" id="last_client_registered">
                    <ul class="media-list">
                        @forelse($last_5_users as $user)
                        <li class="media">
                            <div class="media-left">
                                <a href="{{ $user->imageurlorg }}" data-popup="lightbox">
                                    <img src=" {{ $user->imageurl }} " class="img-circle img-lg" alt="">
                                </a>
                            </div>

                            <div class="media-body">
                                <a href="#">
                                    {{ $user->full_name }}
                                    <span class="media-annotation pull-right"> {{ $user->created_at->format('M-d , H:i') }} </span>
                                </a>

                                <span class="display-block text-muted"> {{ $user->mobile }} </span>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
            <!-- /tabs content -->

        </div>
        <!-- /my messages -->



    </div>
</div>
<!-- /dashboard content -->


@endsection

