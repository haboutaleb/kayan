@extends('dashboard.layout')

@section('script')

    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/pages/user_pages_team.js"></script>

    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/pages/datatables_advanced.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets/material') }}/assets/js/plugins/ui/ripple.min.js"></script>
@endsection

@section('content')


    <div class="panel panel-flat tb_padd">
        <div class="panel-heading">
            <h5 class="panel-title"> {{$title}} </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <center>
            {{ $bills->links() }}
        </center>
        <table class="table table-condensed table-hover datatable-highlight">
            <thead>
            <tr>
                <th class="text-center"> # </th>
                <th class="text-center"> {{ trans('dash.full_name') }} </th>
                <th class="text-center"> {{ trans('dash.wallet') }} </th>
                <th class="text-center"> {{ trans('dash.bank_name') }} </th>
                <th class="text-center"> {{ trans('dash.user_name_bill') }} </th>
                <th class="text-center"> {{ trans('dash.account_number') }} </th>
                <th class="text-center"> {{ trans('dash.price') }} </th>
                <th class="text-center"> {{ trans('dash.created_at') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
            </thead>
            <tbody>
            @forelse($bills as $bill)
                <tr id="row_{{ $bill->id }}">
                    <td> {{ $bill->id }} </td>
                    <td> <a target="_blank" href="{{ route('user_profile',['id' => $bill->user->uuid ]) }}">{{ $bill->user->full_name }}</a></td>
                    <td> {{ $bill->user->wallet }} </td>
                    <td> {{ $bill->bank_name }} </td>
                    <td>  {{ $bill->user_name }}  </td>
                    <td>  {{ $bill->account_number }}  </td>
                    <td>  {{$bill->price}} </td>
                    <td> {{ $bill->created_at->format('Y-m-d H:i') }} </td>
                    <td class="text-center">
                        <a title="{{ trans('dash.open') }}" href="{{ route('bill_view',['id' => $bill->id ]) }}" class="btn btn-primary"> <i class="icon-touch"></i> </a>
                        <a onclick="sweet_delete( ' {{ route('bill_delete').'/'.$bill->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $bill->id }} )" class="btn btn-danger" > <i class="icon-database-remove"></i> </a>
                    </td>
                </tr>
            @empty
            @endforelse

            </tbody>
        </table>
        <center>
            {{ $bills->links() }}
        </center>
        <br>
    </div>


@endsection
