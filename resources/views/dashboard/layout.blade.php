<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> {{ SETTING_VALUE('APP_NAME_AR') }}  </title>

    <!-- live-search stylesheets -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
	<link href="{{ url('public/dashboard_assets') }}/css/live-search.css" rel="stylesheet" type="text/css">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/colors.css" rel="stylesheet" type="text/css">


	<link href="{{ url('public/dashboard_assets') }}/css/style-rtl.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/responsive-style.css" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->

    @yield('style')

	<!-- Core JS files -->

	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

    @yield('pickers')

	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/moment.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
	<!-- live-search JS files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/live-search.js"></script>



	<script>
		$(document).ready(function(){
			$('.ui.search').search({
				apiSettings: {
					url: '{{ url("dashboard/user/live_search_4_driver") }}/{query}'
				},

				fields: {
					results: 'items',
					title: 'full_name',
					url: "dashboardurl",
					image: 'imageurl'
				},
				error: {
					noResults: 'لا توجد نتيجة'
				},
				minCharacters: 1
			});
		});
	</script>

</head>

<body>

    @include('dashboard.theme.navbar')

	<!-- Page container -->
	<div class="page-container">

        <!-- Page content -->
		<div class="page-content">


            @include('dashboard.theme.sidebar')


			<!-- Main content -->
			<div class="content-wrapper">

			@if(isset($page_header))
			@include($page_header)
			@else
			@include('dashboard.theme.page_header')
			@endif

            @if (session('message') && session('class') )
            <div style="padding: 5px 25px;direction: rtl;">
				<div class="{{  session('class') }}">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('message') }}
                </div>
            </div>
			@endif

			@if(session('swal') && session('icon'))
			<script>
				swal({
					title: "{{ trans('alert') }}",
					text: "{{ session('swal') }}",
					icon: "{{ session('icon') }}",
					timer:2000
				});
			</script>
			@endif

			@forelse($errors->all() as $message)
			<div style="padding: 0px 20px">
				<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ $message }}
				</div>
			</div>
			@empty
			@endforelse


				<!-- Content area -->
				<div class="content">

                    @yield('content')

					@include('dashboard.theme.footer')
				</div>

				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
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
@yield('script')
</body>
</html>

