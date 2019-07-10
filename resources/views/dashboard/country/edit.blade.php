@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>

    <!-- /theme JS files -->

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('country_update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ Form::token() }}
                <input type="hidden" name="country_id" value="{{ $country->id }}" />
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> {{ trans('dash.edit_country') }} </h5>
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
                            <label class="col-lg-3 control-label">{{ trans('dash.name_ar') }}</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="name_ar" placeholder="{{ trans('dash.name_ar') }}" value="{{ $country->name_ar }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.name_en') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="name_en" class="form-control" placeholder="{{ trans('dash.name_en') }}" value="{{ $country->name_en }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.show_key') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="show_key" class="form-control" value="{{ $country->show_key }}" placeholder="{{ trans('dash.show_key') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.show_tel') }}</label>
                            <div class="col-lg-9">
                                <input type="number" name="tel_key" class="form-control" value="{{ $country->tel_key }}" placeholder="{{ trans('dash.show_tel') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block"> {{ trans('dash.country') }} </label>
                            <div class="col-lg-9">
                                <select name="continent" class="select-border-color border-warning" >
                                    <optgroup label="{{ trans('dash.choose_continent') }}">
                                        <option value="Africa" @if($country->continent=='Africa') selected @endif> Africa </option>
                                        <option value="Europe" @if($country->continent=='Europe') selected @endif> Europe </option>
                                        <option value="USA" @if($country->continent=='USA') selected @endif> USA </option>
                                        <option value="Asia" @if($country->continent=='Asia') selected @endif> Asia </option>
                                        <option value="Amirca" @if($country->continent=='Asia') selected @endif> South America </option>
                                    </optgroup>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label"> {{ trans('dash.image') }}</label>
                            <div class="col-lg-9">
                                <input type="file" class="file-styled" name="image">
                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
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
                    <h5 class="panel-title"> {{ trans('dash.image') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body" >
                    <center>
                        <img src="{{ $country->imageurl }}" />
                    </center>
                </div>
            </div>



        </div>
    </div>

@endsection
