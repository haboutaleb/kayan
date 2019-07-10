@extends('dashboard.layout')

@section('script')
	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/visualization/echarts/echarts.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/user_pages_profile.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->
@endsection

@section('content')

<!-- User profile -->
<div class="row">
    <div class="col-lg-9">
        <div class="tabbable">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="settings">


                    <!-- Profile info -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Profile information</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form method="post" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                                {{ Form::token() }}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Full Name</label>
                                            <input type="text" value="{{ auth()->user()->full_name }}" name="full_name" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email Address</label>
                                            <input type="text" value="{{ auth()->user()->email }}" name="email" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Mobile</label>
                                            <input type="text" value="{{ auth()->user()->mobile }}" name="mobile" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label> Administration Group </label>
                                            <input type="text" value=" {{ auth()->user()->admin_group->name_ar }} " class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Address</label>
                                            <input type="text" value="{{ auth()->user()->address }}" name="address" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Your City</label>
                                            <select class="select" name="city">
                                                @forelse($cities as $city)
                                                <option value="{{ $city->id }}" @if($city->id == auth()->user()->city_id)selected="selected" @endif> {{ $city->name }} </option>
                                                @empty
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Created At </label>
                                            <input type="text" value="{{ auth()->user()->created_at->format('Y-m-d H:i') }}" class="form-control" readonly="readonly">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="display-block">Upload profile image</label>
                                            <input type="file" name="image" class="file-styled">
                                            <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"> Update Information <i class="icon-arrow-left13 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /profile info -->




                </div>


                <div class="tab-pane fade" id="schedule">

                    <!-- Account settings -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title"> {{ trans('dash.change_password') }} </h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form action="{{ route('update_password') }}" method="post" >
                                {{ Form::token() }}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label> {{ trans('dash.old_password') }} </label>
                                            <input type="password"  name="old_password" class="form-control" placeholder="{{ trans('dash.old_password') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label> {{ trans('dash.new_password') }} </label>
                                            <input type="password" name="password" placeholder="{{ trans('dash.new_password') }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label> {{ trans('dash.confirm_new_password') }} </label>
                                            <input type="password" name="password_confirmation" placeholder="{{ trans('dash.confirm_new_password') }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"> {{ trans('dash.yalla_change_password') }} <i class="icon-arrow-left13 position-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /account settings -->

                </div>


                <div class="tab-pane fade" id="activity">


                    <!-- Timeline -->
                    <div class="timeline timeline-left content-group">
                        <div class="timeline-container">

                            <div class="timeline-row">
                                <div class="timeline-icon">
                                    <a href="#"><img src="{{ url('public/dashboard_assets/material') }}/assets/images/placeholder.jpg" alt=""></a>
                                </div>

                                <div class="panel panel-flat timeline-content">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Daily statistics</h6>
                                        <div class="heading-elements">
                                            <span class="heading-text"><i class="icon-history position-left text-success"></i> Updated 3 hours ago</span>

                                            <ul class="icons-list">
                                                <li><a data-action="reload"></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="chart-container">
                                            <div class="chart has-fixed-height" id="sales"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /timeline -->

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">

        <!-- User thumbnail -->
        <div class="thumbnail">
            <div class="thumb thumb-rounded ">
                <img src="{{ auth()->user()->imageurl }}" alt="">

            </div>

            <div class="caption text-center">
                <h6 class="text-semibold no-margin"> {{ auth()->user()->full_name }} <small class="display-block"> {{ auth()->user()->admin_group->name_ar }} </small></h6>
                <ul class="icons-list mt-15">
                    <li><a href="#" data-popup="tooltip" title="Google Drive"><i class="icon-google-drive"></i></a></li>
                    <li><a href="#" data-popup="tooltip" title="Twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="#" data-popup="tooltip" title="Github"><i class="icon-github"></i></a></li>
                    <li><a href="#" data-popup="tooltip" title="Facebook"><i class="icon-facebook"></i></a></li>
                </ul>
            </div>
        </div>
        <!-- /user thumbnail -->

        <!-- Connections -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title"> {{ trans('dash.group_admins') }} </h6>
                <div class="heading-elements">
                    <span class="badge badge-success heading-text"> {{ count($group_admins) }} </span>
                </div>
            </div>

            <ul class="media-list media-list-linked pb-5">

                  @forelse($group_admins as $group)
                    <li class="media-header"> {{ $group->name_ar." - ".$group->name_en }} </li>
                    @forelse($group->admins as $admin)
                    <li class="media">
                        <a href="#" class="media-link">
                            <div class="media-left"><img src="{{ $admin->imageurl }}" class="img-circle" alt=""></div>
                            <div class="media-body">
                                <span class="media-heading text-semibold"> {{ $admin->full_name }} </span>
                                <span class="media-annotation"> {{ $admin->email }} </span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark bg-success"></span>
                            </div>
                        </a>
                    </li>

                    @empty
                    @endforelse
                @empty
                @endforelse

            </ul>
        </div>
        <!-- /connections -->

    </div>
</div>
<!-- /user profile -->

@endsection

