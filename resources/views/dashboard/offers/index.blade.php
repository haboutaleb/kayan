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
            <h5 class="panel-title"> {{ trans('dash.offers') }} </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <a class="btn btn-primary" href="{{ route('offer_create') }}"> {{ trans('dash.add_new_category') }} </a>

        <table class="table table-condensed table-hover datatable-highlight">
            <thead>
            <tr>
                <th class="text-center"> {{ trans('dash.form') }} </th>
                <th class="text-center"> {{ trans('dash.to') }} </th>
                <th class="text-center"> {{ trans('dash.contract-type') }} </th>
                <th class="text-center"> {{ trans('dash.service-provider-gender') }} </th>
                <th class="text-center"> {{ trans('dash.note') }} </th>
                <th class="text-center"> {{ trans('dash.user') }} </th>
                <th class="text-center"> {{ trans('dash.category') }} </th>
                <th class="text-center"> {{ trans('dash.created_at') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
            </thead>
            <tbody>
            @forelse($offers as $offer)
                <tr id="row_{{ $offer->id }}">
                    <td> {{ $offer->from }}    </td>
                    <td> {{ $offer->to }}      </td>
                    <td> {{$offer->type }}     </td>
                    <td> {{$offer->gender }}   </td>
                    <td> {{$offer->note }}     </td>
                    <td> {{$offer->user->full_name }}     </td>
                    <td> {{$offer->category->name_ar }} </td>
                    <td> {{$offer->created_at->format('Y-m-d H:i') }} </td>
                    <td class="text-center">
                        <a href="{{ route('offer_edit',['id' => $offer->id ]) }}" class="btn btn-primary"> <i class="icon-pencil3"></i> </a>
                        <a onclick="sweet_delete( ' {{ route('offer_delete').'/'.$offer->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $offer->id }} )" class="btn btn-danger" > <i class="icon-database-remove"></i> </a>
                    </td>
                </tr>

            @empty
            @endforelse

            </tbody>
        </table>
    </div>

    <script>
        function sweet_delete($url,$message,$offer_id)
        {
            $( "#row_"+$offer_id ).css('background-color','#000000').css('color','white');
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
                        $( "#row_"+$offer_id).hide(1000);
                    }else{
                        $( "#row_"+$offer_id ).removeAttr('style');
                    }
                });
        }
    </script>

@endsection
