@extends('dashboard.layout')

@section('script')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>

    <!-- /theme JS files -->

@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('category_store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ Form::token() }}

                 @include('dashboard.category.form') 

                </form>
            <!-- /basic layout -->

        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('dash.latest_categories') }} </h5>
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
                            <th> {{ trans('dash.name_ar') }} </th>
                            <th> {{ trans('dash.name_en') }} </th>
                            
                        </tr>
                        @foreach($latest_categories as $category)
                            <tr>
                                <td> {{ $category->name_ar }} </td>
                                <td> {{ $category->name_en }} </td>
                                
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
