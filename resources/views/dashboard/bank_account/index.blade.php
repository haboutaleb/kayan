@extends('dashboard.layout')

@section('script')
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/user_pages_team.js"></script>

    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/datatables_advanced.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>
@endsection

@section('content')


<div class="panel panel-flat tb_padd">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.banks_accounts') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <a class="btn btn-primary" href="{{ route('bank_account_create') }}"> {{ trans('dash.add_new_bank_account') }} </a>

    <table class="table table-condensed table-hover datatable-highlight">
        <thead>
            <tr>
                <th class="text-center"> # </th>
                <th class="text-center"> {{ trans('dash.benift_name') }} </th>
                <th class="text-center"> {{ trans('dash.account_number') }} </th>
                <th class="text-center"> {{ trans('dash.ipan_number') }} </th>
                <th class="text-center"> {{ trans('dash.bank_name') }} </th>
                <th class="text-center"> {{ trans('dash.image') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
        </thead>
        <tbody>
            @forelse($banks as $bank)
            <tr id="row_{{ $bank->id }}">
                <td> {{ $bank->id }} </td>
                <td> {{ $bank->benif_name }} </td>
                <td> {{ $bank->account_number }} </td>
                <td> {{ $bank->ipan_number }} </td>
                <td> {{ $bank->bank_name }} </td>
                <td>
                    <a href="{{ $bank->imageurlorg }}" data-popup="lightbox">
                        <img src="{{ $bank->imageurl }}" height="100" width="100" />
                    </a>
                </td>
                <td class="text-center">
                    <a href="{{ route('bank_account_edit',['id' => $bank->id ]) }}" class="btn btn-primary"> <i class="icon-pencil3"></i> </a>
                    <a onclick="sweet_delete( ' {{ route('bank_account_delete').'/'.$bank->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $bank->id }} )" class="btn btn-danger" > <i class="icon-database-remove"></i> </a>
                </td>
            </tr>

            @empty
            @endforelse

        </tbody>
    </table>
</div>

@endsection
