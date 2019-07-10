@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/assets/js/pages/user_pages_team.js"></script>

    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/assets/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>

    <!-- /theme JS files -->

@endsection

@section('content')

<div class="row">
    <div class="col-md-6">

        <!-- Basic layout-->
        <form action="{{ route('bank_account_update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{ Form::token() }}
            <input type="hidden" name="bank_account_id" value="{{ $bank->id }}" />
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.edit_bank_account') }} </h5>
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
                        <label class="col-lg-3 control-label">{{ trans('dash.bank_name') }}</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="bank_name" value="{{ $bank->bank_name }}" placeholder="{{ trans('dash.bank_name') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{ trans('dash.benift_name') }}</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="benif_name" value="{{ $bank->benif_name }}" placeholder="{{ trans('dash.benift_name') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{ trans('dash.account_number') }}</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="account_number" value="{{ $bank->account_number }}" placeholder="{{ trans('dash.account_number') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">{{ trans('dash.ipan_number') }}</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="ipan_number" value="{{ $bank->ipan_number }}" placeholder="{{ trans('dash.ipan_number') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"> {{ trans('dash.image') }}</label>
                        <div class="col-lg-6">
                            <input type="file" class="file-styled" name="image" >
                        </div>
                        <div class="col-lg-3">
                            <a href="{{ $bank->imageurlorg }}" data-popup="lightbox">
                                <img src="{{ $bank->imageurl }}" height="80" width="90" />
                            </a>
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
                <h5 class="panel-title"> {{ trans('dash.latest_banks') }} </h5>
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
                        <th> {{ trans('dash.benift_name') }} </th>
                        <th> {{ trans('dash.bank_name') }} </th>
                        <th> {{ trans('dash.account_number') }} </th>
                    </tr>
                    @foreach($banks as $bank)
                    <tr>
                        <td> {{ $bank->benif_name }} </td>
                        <td> {{ $bank->bank_name }} </td>
                        <td> {{ $bank->account_number }} </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

</div>

@endsection
