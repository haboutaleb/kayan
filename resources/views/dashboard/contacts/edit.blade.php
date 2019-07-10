@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
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

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('contact_update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ Form::token() }}
                <input type="hidden" name="contact_id" value="{{ $contact->id }}" />
                @include('dashboard.contacts.form')
            </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">



            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.contact') }} </h5>
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
                            <th> {{ trans('dash.subject') }} </th>
                            <th> {{ trans('dash.message') }} </th>

                        </tr>
                        <tr>
                            <td> {{ $contact->subject }} </td>
                            <td> {{ $contact->message }} </td>
                        </tr>
                    </table>
                </div>
            </div>






        </div>
    </div>

@endsection
