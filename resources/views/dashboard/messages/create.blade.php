@extends('dashboard.layout')



@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('message_store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ Form::token() }}

                 @include('dashboard.messages.form')

                </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.latest_messages') }} </h5>
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
                            <th> {{ trans('dash.from-user') }} </th>
                            <th> {{ trans('dash.message') }} </th>

                        </tr>
                        @foreach($latest_messages as $message)
                            <tr>
                                <td> {{ $message->sender->full_name  }} </td>
                                <td> {{ $message->message }} </td>

                            </tr>
                        @endforeach
                    </table>
                </div>



            </div>
        </div>
    </div>

    </div>


    <script>

    </script>

@endsection

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/pickers/pickadate/picker.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/pickers/pickadate/picker.date.js"></script>
    <!-- /theme JS files -->
    <script>
            $('.datepicker').pickadate({
                min: true,
                max: false
            })
    </script>
@endsection
