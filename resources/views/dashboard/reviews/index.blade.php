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
            <h5 class="panel-title"> {{ trans('dash.review') }} </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <a class="btn btn-primary" href="{{ route('review_create') }}"> {{ trans('dash.add_new_review') }} </a>

        <table class="table table-condensed table-hover datatable-highlight">
            <thead>
            <tr>
                <th class="text-center"> {{ trans('dash.review-form') }} </th>
                <th class="text-center"> {{ trans('dash.review-to') }} </th>
                <th class="text-center"> {{ trans('dash.review') }} </th>
                <th class="text-center"> {{ trans('dash.created_at') }} </th>
                <th class="text-center"> {{ trans('dash.actions') }} </th>
            </tr>
            </thead>
            <tbody>
            @forelse($reviews as $review)
                <tr id="row_{{ $review->id }}">
                    <td> {{ $review->user->full_name }}    </td>
                    <td> {{ $review->reviwer->full_name }}      </td>
                    <td> {{$review->review }}     </td>

                    <td> {{$review->created_at->format('Y-m-d H:i') }} </td>
                    <td class="text-center">
                        <a href="{{ route('review_edit',['id' => $review->id ]) }}" class="btn btn-primary"> <i class="icon-pencil3"></i> </a>
                        <a onclick="sweet_delete( ' {{ route('review_delete').'/'.$review->id }} ' , '{{ trans('dash.deleted_msg_confirm') }}' ,{{ $review->id }} )" class="btn btn-danger" > <i class="icon-database-remove"></i> </a>
                    </td>
                </tr>

            @empty
            @endforelse

            </tbody>
        </table>
    </div>

    <script>
        function sweet_delete($url,$review,$review_id)
        {
            $( "#row_"+$review_id ).css('background-color','#000000').css('color','white');
            swal({
                title: $review,
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
                        $( "#row_"+$review_id).hide(1000);
                    }else{
                        $( "#row_"+$review_id ).removeAttr('style');
                    }
                });
        }
    </script>

@endsection
