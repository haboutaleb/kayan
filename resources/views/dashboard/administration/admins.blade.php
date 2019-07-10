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
        <h5 class="panel-title"> {{ trans('dash.admins') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <a class="btn btn-primary" href="{{ route('admin_create') }}"> {{ trans('dash.add_new_admin') }} </a>

    <table class="table table-condensed table-hover datatable-highlight">
        <thead>
            <tr>
                <th class="text-center"> {{ trans('dash.full_name') }} </th>
                <th class="text-center"> {{ trans('dash.email') }} </th>
                <th class="text-center"> {{ trans('dash.image') }} </th>
                <th class="text-center"> {{ trans('dash.group') }} </th>
                <th class="text-center"> {{ trans('dash.created_at') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $user)
            <tr id="user_{{ $user->id }}">
                <td> {{ $user->full_name }} </td>
                <td> {{ $user->email}} </td>
                <td> <img width="100px" src="{{ $user->imageurl }}" /> </td>
                <td> {{ $user->admin_group->name_ar }} </td>
                <td> {{ $user->created_at->format('Y-m-d H:i') }} </td>
                <td class="text-center">
                    <a href="#" class="btn btn-success" data-popup="tooltip" title="" data-toggle="modal" data-target="#call_{{$user->id}}" data-original-title="Call"><i class="icon-phone2"></i></a>
                    <a href="{{ route('admin_edit',['id' => $user->id ]) }}" class="btn btn-primary"> <i class="icon-pencil3"></i> </a>
                    <a onclick="sweet_delete( ' {{ route('admin_delete').'/'.$user->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $user->id }} )" class="btn btn-danger" > <i class="icon-database-remove"></i> </a>
                    {{--  <a href="{{ route('user_delete',['id' => $user->id ]) }}" class="btn btn-danger"> <i class="icon-database-remove"></i> </a>  --}}
                </td>
            </tr>

            <!-- Phone call modal -->
            <div id="call_{{$user->id}}" class="modal fade">
                <div class="modal-dialog modal-xs">
                    <div class="modal-content">
                        <div class="thumbnail no-border no-margin">
                            <div class="thumb thumb-rounded">
                                <img src="{{ $user->imageurl }}" alt="">
                            </div>
                            <div class="caption text-center">
                                <h6 class="text-semibold no-margin-top content-group"> {{ $user->full_name }} <small class="display-block">  </small></h6>
                                <ul class="list-inline list-inline-condensed no-margin">
                                    <li><a href="tel:{{ $user->mobile }}" class="btn btn-success btn-rounded btn-float"><i class="icon-phone2"></i></a></li>
                                    <li><a href="#" class="btn btn-danger btn-rounded btn-float" data-dismiss="modal"><i class="icon-phone-slash"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /phone call modal -->
            @empty
            @endforelse

        </tbody>
    </table>
</div>

<script>
    function sweet_delete($url,$message,$user_id)
    {
        $( "#user_"+$user_id ).css('background-color','#000000').css('color','white');
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
            $( "#user_"+$user_id ).hide(1000);
        }else{
            $( "#user_"+$user_id ).removeAttr('style');
        }
        });
    }
</script>

@endsection
