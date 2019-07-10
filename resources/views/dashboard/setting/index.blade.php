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

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.app_setting_details') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal form-validate-jquery" action="{{ route('setting_update') }}" method="POST">
            {{ Form::token() }}
            <fieldset class="content-group">
                <legend class="text-bold"></legend>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.app_name_ar') }} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('APP_NAME_AR') }}" name="APP_NAME_AR" class="form-control" required="required" placeholder="{{ trans('dash.app_name_ar') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.app_name_en') }} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('APP_NAME_EN') }}" name="APP_NAME_EN" class="form-control" required="required" placeholder="{{ trans('dash.app_name_en') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.app_desc_ar') }} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <textarea rows="5" cols="5" name="APP_DESC_AR" class="form-control" required="required" placeholder="{{ trans('dash.app_desc_ar') }}"> {{ SETTING_VALUE('APP_DESC_AR') }} </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.app_desc_en') }} <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <textarea rows="5" cols="5" name="APP_DESC_EN" class="form-control" required="required" placeholder="{{ trans('dash.app_desc_en') }}"> {{ SETTING_VALUE('APP_DESC_EN') }} </textarea>
                    </div>
                </div>

            </fieldset>



            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
            </div>
        </form>
    </div>
</div>


<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.social_media') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal form-validate-jquery" action="{{ route('setting_update') }}" method="POST">
            {{ Form::token() }}
            <fieldset class="content-group">
                <legend class="text-bold"></legend>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.facebook') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('FACEBOOK_URL') }}" name="FACEBOOK_URL" class="form-control" placeholder="{{ trans('dash.facebook') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.twitter') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('TWITTER_URL') }}" name="TWITTER_URL" class="form-control" placeholder="{{ trans('dash.twitter') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.instagram') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('INSTAGRAM_URL') }}" name="INSTAGRAM_URL" class="form-control" placeholder="{{ trans('dash.instagram') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.snapchat') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SNAPCHAT_URL') }}" name="SNAPCHAT_URL" class="form-control" placeholder="{{ trans('dash.snapchat') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.mobile') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('MOBILE') }}" name="MOBILE" class="form-control" placeholder="{{ trans('dash.mobile') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.email') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('FORMAL_EMAIL') }}" name="FORMAL_EMAIL" class="form-control" placeholder="{{ trans('dash.email') }}">
                    </div>
                </div>



            </fieldset>



            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.mail_conf') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal form-validate-jquery" action="{{ route('setting_update') }}" method="POST">
            {{ Form::token() }}
            <fieldset class="content-group">
                <legend class="text-bold"></legend>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.smtp_host') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SMTP_HOST') }}" name="SMTP_HOST" class="form-control" placeholder="{{ trans('dash.smtp_host') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.smtp_port') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SMTP_PORT') }}" name="SMTP_PORT" class="form-control" placeholder="{{ trans('dash.smtp_port') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.smtp_mail') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SMTP_EMAIL') }}" name="SMTP_EMAIL" class="form-control" placeholder="{{ trans('dash.smtp_mail') }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.smtp_password') }}  </label>
                    <div class="col-lg-9">
                        <input type="password" value="{{ SETTING_VALUE('SMTP_PASSWORD') }}" name="SMTP_PASSWORD" class="form-control" placeholder="{{ trans('dash.smtp_password') }}">
                    </div>
                </div>


            </fieldset>



            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
            </div>
        </form>
    </div>
</div>


<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.sms_config') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">

        <form class="form-horizontal form-validate-jquery" action="{{ route('setting_update') }}" method="POST">
            {{ Form::token() }}

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.mobile') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SMS_PROVIDER_MOBILE') }}" name="SMS_PROVIDER_MOBILE" class="form-control" placeholder="{{ trans('dash.mobile') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.sender') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SMS_PROVIDER_SENDER') }}" name="SMS_PROVIDER_SENDER" class="form-control" placeholder="{{ trans('dash.sender') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-3"> {{ trans('dash.password') }}  </label>
                    <div class="col-lg-9">
                        <input type="text" value="{{ SETTING_VALUE('SMS_PROVIDER_PASSWORD') }}" name="SMS_PROVIDER_PASSWORD" class="form-control" placeholder="{{ trans('dash.password') }}">
                    </div>
                </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-left13 position-right"></i></button>
            </div>
        </form>


    </div>
</div>



@endsection
