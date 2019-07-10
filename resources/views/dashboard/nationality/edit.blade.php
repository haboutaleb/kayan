@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
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
            <form action="{{ route('nationality_update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ Form::token() }}
                <input type="hidden" name="city_id" value="{{ $nationality->id }}" />
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> {{ trans('dash.edit_nationalities') }} </h5>
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
                                <input type="text" class="form-control" name="name_ar" placeholder="{{ trans('dash.name_ar') }}" value="{{ $nationality->name_ar }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.name_en') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="name_en" class="form-control" placeholder="{{ trans('dash.name_en') }}" value="{{ $nationality->name_en }}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-3 control-label display-block"> {{ trans('dash.country') }} </label>
                            <div class="col-lg-9">
                                <select name="country_id" class="select-border-color border-warning" >
                                    <optgroup label="{{ trans('dash.choose_country') }}">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" @if($nationality->country_id == $country->id) selected @endif> {{ $country->name_ar.' - '.$country->name_en }} </option>
                                        @endforeach
                                    </optgroup>
                                </select>
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
                    <h5 class="panel-title"> {{ trans('dash.last_nationalities') }} </h5>
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
                        @foreach($latest_nationalities as $nationality)
                            <tr>
                                <td> {{ $nationality->name_ar }} </td>
                                <td> {{ $nationality->name_en }} </td>
                                <td> {{ $nationality->country->name_ar }} </td>
                            </tr>
                        @endforeach
                    </table>
                </div>



            </div>
        </div>
    </div>



    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>

@endsection
