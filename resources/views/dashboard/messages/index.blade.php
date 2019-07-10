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
            <h5 class="panel-title"> {{ trans('dash.message') }} </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <a class="btn btn-primary" href="{{ route('message_create') }}"> {{ trans('dash.add_new_message') }} </a>

        <table class="table table-condensed table-hover datatable-highlight">
            <thead>
            <tr>
                <th class="text-center"> {{ trans('dash.message-from') }} </th>
                <th class="text-center"> {{ trans('dash.message-to') }} </th>
                <th class="text-center"> {{ trans('dash.message') }} </th>
                <th class="text-center"> {{ trans('dash.created_at') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
            </thead>
            <tbody>
            @forelse($messages as $message)
                <tr id="row_{{ $message->id }}">
                    <td> {{ $message->sender->full_name }}    </td>
                    <td> {{ $message->recvier->full_name }}      </td>
                    <td> {{$message->message }}     </td>

                    <td> {{$message->created_at->format('Y-m-d H:i') }} </td>
                    <td class="text-center">
                        <a href="{{ route('message_edit',['id' => $message->id ]) }}" class="btn btn-primary"> <i class="icon-pencil3"></i> </a>
                        <a onclick="sweet_delete( ' {{ route('message_delete').'/'.$message->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $message->id }} )" class="btn btn-danger" > <i class="icon-database-remove"></i> </a>
                    </td>
                </tr>

            @empty
            @endforelse

            </tbody>
        </table>
    </div>

    <script>
        function sweet_delete($url,$message,$message_id)
        {
            $( "#row_"+$message_id ).css('background-color','#000000').css('color','white');
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
                        $( "#row_"+$message_id).hide(1000);
                    }else{
                        $( "#row_"+$message_id ).removeAttr('style');
                    }
                });
        }
    </script>

@endsection
