@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>

    <!-- /theme JS files -->

@endsection

@section('content')

<div class="row">
    <div class="col-md-6">

        <!-- Basic layout-->
        <form action="{{ route('admin_update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{ Form::token() }}
            <input type="hidden" name="admin_id" value="{{ $admin->id }}" />
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.edit_admin') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>


                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-lg-3 control-label display-block"> {{ trans('dash.group') }} </label>
                        <div class="col-lg-9">
                            <select name="administration_group_id" class="select-border-color border-warning" required>
                                <optgroup label="{{ trans('dash.choose_administration_group') }}">
                                @foreach ($administration_groups as $group)
                                    <option value="{{ $group->id }}" @if($group->id == $admin->administration_group_id) selected @endif> {{ $group->name_ar.' - '.$group->name_en }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{ trans('dash.full_name') }}</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="full_name" value="{{ $admin->full_name }}" placeholder="{{ trans('dash.full_name') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{ trans('dash.email') }}</label>
                        <div class="col-lg-9">
                            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" placeholder="{{ trans('dash.email') }}" required >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{ trans('dash.mobile') }}</label>
                        <div class="col-lg-9">
                            <input type="text" name="mobile" value="{{ $admin->mobile }}" class="form-control" placeholder="{{ trans('dash.mobile') }}" >
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label"> {{ trans('dash.image') }}</label>
                        <div class="col-lg-9">
                            <input type="file" class="file-styled" name="image">
                            <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label display-block"> {{ trans('dash.city') }} </label>
                        <div class="col-lg-9">
                            <select name="city_id" class="select-border-color border-warning" >
                            @forelse($countries as $country)
                            <optgroup label="{{ $country->name_ar }}">
                                @foreach ($country->cities as $city)
                                    <option value="{{ $city->id }}" @if($admin->city_id == $city->id) selected @endif> {{ $city->name_ar }} </option>
                                @endforeach
                            </optgroup>
                            @empty
                            @endforelse
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"> {{ trans('dash.password') }} </label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="password" placeholder=" {{ trans('dash.password') }} "  />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"> {{ trans('dash.confirm_password') }} </label>
                        <div class="col-lg-9">
                            <input type="password" class="form-control" name="confirm_password" placeholder=" {{ trans('dash.confirm_password') }} "  />
                        </div>
                    </div>


                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('dash.update_and_forword_2_list') }} " />
                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('dash.update_and_come_back') }} " />
                    </div>
                </div>
            </div>
        </form>
        <!-- /basic layout -->

    </div>


    <div class="col-md-6">
        <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.other_admins') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">

                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('dash.name_ar') }} </th>
                            <th> {{ trans('dash.name_en') }} </th>
                            <th> {{ trans('dash.country') }} </th>
                        </tr>
                        @foreach($other_admins as $admin)
                        <tr>
                            <td> {{ $admin->full_name }} </td>
                            <td> {{ $admin->email }} </td>
                            <td> {{ $admin->mobile }} </td>
                        </tr>
                        @endforeach
                    </table>
                </div>



                </div>
        </div>
    </div>

</div>



@endsection
