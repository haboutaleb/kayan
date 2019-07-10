@extends('dashboard.layout')

@section('script')
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/pages/user_pages_team.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/ui/ripple.min.js"></script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="active"><a href="#details-tab" data-toggle="tab"><i class="icon-menu7 position-left"></i> {{ trans('dash.bill') }} </a></li>
                    <li><a href="#confirmed_bills" data-toggle="tab"><i class="icon-mention position-left"></i> {{ trans('dash.Confirmed_bills') }} </a></li>
                </ul>
                <div class="tabbable nav-tabs-vertical nav-tabs-left">

                    <div class="tab-content">

                        <div class="tab-pane active has-padding" id="details-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h5 class="panel-title"> {{ trans('dash.bill_details') }} </h5>
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="collapse"></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                            <table class="table table-hover table-bordered table-hover">
                                                <tr class="active">
                                                    <td> {{ trans('dash.bill_status') }} </td>
                                                    <td> {{ $bill->status_value }} </td>
                                                </tr>
                                                <tr class="success">
                                                    <td> {{ trans('dash.bank_name') }} </td>
                                                    <td> {{ $bill->bank_name }} </td>
                                                </tr>
                                                <tr class="warning">
                                                    <td> {{ trans('dash.user_name_transfer') }} </td>
                                                    <td>{{ $bill->user_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td> {{ trans('dash.account_number') }} </td>
                                                    <td> {{$bill->account_number}} </td>
                                                </tr>
                                                <tr class="success">
                                                    <td> {{ trans('dash.price') }} </td>
                                                    <td> {{$bill->price}} {{ trans('dash.sr') }} </td>
                                                </tr>
                                                <tr class="danger">
                                                    <td> {{ trans('dash.transfer_image') }} </td>
                                                    <td>
                                                        <a href="{{ $bill->imageurlorg }}" data-popup="lightbox">
                                                            <img src="{{ $bill->imageurl }}" height="100" width="100" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <td> {{ trans('dash.date') }} </td>
                                                    <td> {{ $bill->created_at->format('Y-m-d') }} </td>
                                                </tr>
                                                <tr class="success">
                                                    <td> {{ trans('dash.time') }} </td>
                                                    <td> {{ $bill->created_at->format('H:i') }} </td>
                                                </tr>
                                            </table>
                                            <br>
                                            @if($bill->status == "wait")
                                            <center>
                                                <a onclick="sweet_confirm_pay()" id="confirm_pay_btn" href="#" class="btn btn-success"> {{ trans('dash.do_bill_confirm') }} </a>
                                            </center>
                                            <br> <br>
                                            <center>
                                                <a onclick="sweet_confirm_refuse()" id="confirm_refuse_btn" href="#" class="btn btn-danger"> {{ trans('dash.do_bill_refuse') }} </a>
                                            </center>
                                            <br>
                                            @endif

                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="content-group">
                                        <div class="panel-body bg-blue border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                                            <div class="content-group-sm">
                                                <h5 class="text-semibold no-margin-bottom">
                                                    {{ $user->full_name }}
                                                </h5>
                                                <span class="display-block"> {{ trans('dash.delivery') }} </span>
                                            </div>
                                            <a href="{{ $user->imageurlorg }}" data-popup="lightbox">
                                                <img src=" {{ $user->imageurl }} " class="img-circle" alt="">
                                            </a>

                                            <ul class="list-inline no-margin-bottom">
                                                <li><a href="tel:{{$user->mobile}}" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-mobile3"></i></a></li>
                                                <li><a href="mailto:{{ $user->email }}" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-envelop4"></i></a></li>
                                            </ul>
                                        </div>

                                        <div class="panel panel-body no-border-top no-border-radius-top">
                                            <div class="form-group mt-5">
                                                <label class="text-semibold"> {{ trans('dash.full_name') }} </label>
                                                <span class="pull-right-sm"> {{ $user->full_name }} </span>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-semibold"> {{ trans('dash.email') }} </label>
                                                <span class="pull-right-sm"><a href="mailto:{{$user->email}}"> {{$user->email }} </a></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-semibold"> {{ trans('dash.mobile') }} </label>
                                                <span class="pull-right-sm"> <a href="tel:{{$user->mobile}}"> {{$user->mobile}} </a> </span>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-semibold"> {{ trans('dash.wallet') }} </label>
                                                <span class="pull-right-sm"> {{$user->wallet}} {{ trans('dash.sr') }} </span>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-semibold"> {{ trans('dash.national_id') }} </label>
                                                <span class="pull-right-sm"> @if(isset($user->delegate_info->national_id)) {{ $user->delegate_info->national_id }} @endif </span>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-semibold"> {{ trans('dash.nationality') }} </label>
                                                <span class="pull-right-sm"> @if(isset($user->delegate_info->nationality)) {{ $user->delegate_info->nationality->name_ar }} @endif</span>
                                            </div>

                                            <div class="form-group">
                                                <label class="text-semibold"> {{ trans('dash.created_at') }} </label>
                                                <span class="pull-right-sm"> {{ $user->created_at->format('Y-m-d') }} </span>
                                            </div>

                                            <div class="form-group no-margin-bottom">
                                                <label class="text-semibold"> {{ trans('dash.time') }} </label>
                                                <span class="pull-right-sm"> {{ $user->created_at->format('H:i') }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane has-padding" id="confirmed_bills">
                            <div class="row">

                                  @forelse($confirmed_bills as $old_bill)
                                    <div class="col-lg-6">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading">
                                            <h5 class="panel-title"> {{ trans('dash.bill_details') }} </h5>
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li><a data-action="collapse"></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">
                                            <table class="table table-hover table-bordered table-hover">
                                                <tr class="active">
                                                    <td> {{ trans('dash.bill_status') }} </td>
                                                    <td> {{ $old_bill->status_value }} </td>
                                                </tr>
                                                <tr class="success">
                                                    <td> {{ trans('dash.bank_name') }} </td>
                                                    <td> {{ $old_bill->bank_name }} </td>
                                                </tr>
                                                <tr class="warning">
                                                    <td> {{ trans('dash.user_name_transfer') }} </td>
                                                    <td>{{ $old_bill->user_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td> {{ trans('dash.account_number') }} </td>
                                                    <td> {{$old_bill->account_number}} </td>
                                                </tr>
                                                <tr class="success">
                                                    <td> {{ trans('dash.price') }} </td>
                                                    <td> {{$old_bill->price}} {{ trans('dash.sr') }} </td>
                                                </tr>
                                                <tr class="danger">
                                                    <td> {{ trans('dash.transfer_image') }} </td>
                                                    <td>
                                                        <a href="{{ $old_bill->imageurlorg }}" data-popup="lightbox">
                                                            <img src="{{ $old_bill->imageurl }}" height="100" width="100" />
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr class="active">
                                                    <td> {{ trans('dash.date') }} </td>
                                                    <td> {{ $old_bill->created_at->format('Y-m-d') }} </td>
                                                </tr>
                                                <tr class="success">
                                                    <td> {{ trans('dash.time') }} </td>
                                                    <td> {{ $old_bill->created_at->format('H:i') }} </td>
                                                </tr>
                                            </table>
                                            <br>
                                            @if($old_bill->status == "wait")
                                            <center>
                                                <a onclick="sweet_confirm_pay()" id="confirm_pay_btn" href="#" class="btn btn-success"> {{ trans('dash.do_bill_confirm') }} </a>
                                            </center>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                                  @empty
                                  @include('dashboard.theme.no_data')
                                  @endforelse
                            </div>

                        </div>

                        <div class="tab-pane has-padding" id="prices">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="panel panel-body ">
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



<script>
    function sweet_confirm_pay()
    {
        swal({
        title: "{{ trans('dash.pay_confirm_message') }}",
        {{--  text: "Once deleted, you will not be able to recover this imaginary file!",  --}}
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:"{{route('bill_do_confirm').'/'.$bill->id}}"
            });
            swal({
                title: "{{ trans('dash.success_process') }}",
                text: '',
                icon: "success",
                timer:1000
            });
            $("#confirm_pay_btn").hide();
            setTimeout(function(){
                location.reload();
            },2000);
        }else{

        }
        });
    }

    function sweet_confirm_refuse()
    {
        swal({
        title: "{{ trans('dash.pay_refuse_message') }}",
        {{--  text: "Once deleted, you will not be able to recover this imaginary file!",  --}}
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:"{{route('bill_do_refuse').'/'.$bill->id}}"
            });
            swal({
                title: "{{ trans('dash.success_process') }}",
                text: '',
                icon: "success",
                timer:1000
            });
            $("#confirm_refuse_btn").hide();
            setTimeout(function(){
                location.reload();
            },2000);
        }else{

        }
        });
    }
</script>

@endsection
