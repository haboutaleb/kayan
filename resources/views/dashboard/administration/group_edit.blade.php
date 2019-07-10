@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->

    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/switch.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_validation.js"></script>

    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>

    <!-- /theme JS files -->

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">

        <!-- Basic layout-->
        <form action="{{ route('administration_group_update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			{{ Form::token() }}
			<input type="hidden" name="administration_group_id" value="{{$group->id}}" />
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.add_new_category') }} </h5>
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
                        <label class="col-lg-3 control-label"> {{ trans('dash.name_ar') }} </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name_ar" value="{{ $group->name_ar }}" placeholder="{{ trans('dash.name_ar') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"> {{ trans('dash.name_en') }} </label>
                        <div class="col-lg-9">
                            <input type="text" name="name_en" class="form-control" value="{{ $group->name_en }}" placeholder="{{ trans('dash.name_en') }}" required>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-lg-3 control-label"> {{ trans('dash.short_desc_ar') }} </label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="short_desc_ar" placeholder="{{ trans('dash.short_desc_ar') }}">{{ $group->description }}</textarea>
                        </div>
                    </div>



                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> {{ trans('dash.cities') }} </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-3">
								<div class="form-group">
									<label class="control-label col-lg-3"> {{ trans('dash.cities') }} </label>
									<div class="col-lg-9">
										<div class="checkbox checkbox-switchery switchery-xs">
											<label>
												<input type="checkbox" name="perms[]" class="switchery" value="cities" @if(in_array('cities',$perms)) checked @endif>
											</label>
										</div>
									</div>
								</div>
                            </div>
                            <div class="col-lg-3">
								<div class="form-group">
									<label class="control-label col-lg-3"> {{ trans('dash.create') }} </label>
									<div class="col-lg-9">
										<div class="checkbox checkbox-switchery switchery-xs">
											<label>
												<input type="checkbox" name="perms[]" class="switchery" value="city_create" @if(in_array('city_create',$perms)) checked @endif>
											</label>
										</div>
									</div>
								</div>
                            </div>
                            <div class="col-lg-3">
								<div class="form-group">
									<label class="control-label col-lg-3"> {{ trans('dash.edit') }} </label>
									<div class="col-lg-9">
										<div class="checkbox checkbox-switchery switchery-xs">
											<label>
												<input type="checkbox" name="perms[]" class="switchery" value="city_edit" @if(in_array('city_edit',$perms)) checked @endif>
											</label>
										</div>
									</div>
								</div>
                            </div>
                            <div class="col-lg-3">
								<div class="form-group">
									<label class="control-label col-lg-3"> {{ trans('dash.delete') }} </label>
									<div class="col-lg-9">
										<div class="checkbox checkbox-switchery switchery-xs">
											<label>
												<input type="checkbox" name="perms[]" class="switchery" value="city_delete" @if(in_array('city_delete',$perms)) checked @endif>
											</label>
										</div>
									</div>
								</div>
                            </div>

                        </div>

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

</div>


@endsection
