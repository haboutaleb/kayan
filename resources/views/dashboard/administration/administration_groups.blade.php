@extends('dashboard.layout')

@section('script')
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/datatables_advanced.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>
@endsection

@section('content')

<div class="panel panel-flat tb_padd">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ $table_name }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <a class="btn btn-primary" href="{{ route('administration_group_create') }}"> {{ trans('dash.add_new_administration_groups') }} </a>


    <table class="table table-bordered table-hover datatable-highlight">
        <thead>
            <tr>
                <th class="text-center"> # </th>
                <th class="text-center"> {{ trans('dash.name_ar') }} </th>
                <th class="text-center"> {{ trans('dash.name_en') }} </th>
                <th class="text-center"> {{ trans('dash.short_desc_ar') }} </th>
                <th class="text-center"> {{ trans('dash.created_at') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
        </thead>
        <tbody>
            @forelse($administration_groups as $group)
            <tr id="row_{{ $group->id }}">
                <td> {{ $group->id }} </td>
                <td> {{ $group->name_ar }} </td>
                <td> {{ $group->name_en }} </td>
                <td> {{ $group->description }} </td>
				<td> {{ $group->created_at->format('Y-m-d H:i') }} </td>
                <td class="text-center">
                    <a href="{{ route('administration_group_edit',['id' => $group->id ]) }}" class="btn btn-info"> <i class="icon-pencil3"></i> </a>
                    <a onclick="sweet_delete( ' {{ route('administration_group_delete').'/'.$group->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $group->id }} )"  class="btn btn-danger"> <i class="icon-database-remove"></i> </a>
                </td>
            </tr>
            @empty
            @endforelse

        </tbody>
    </table>
</div>

<script>
    function sweet_delete($url,$message,$row_id)
    {
        $( "#row_"+$row_id ).css('background-color','#000000').css('color','white');
        swal({
        title: $message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url:$url
            });
            swal({
                title: "{{ trans('alert') }}",
                text: "{{ trans('dash.deleted_successfully') }}",
                icon: "success",
                timer:1000
            });
            $( "#row_"+$row_id ).hide(1000);
        }else{
            $( "#row_"+$row_id ).removeAttr('style');
        }
        });
    }
</script>
@endsection
