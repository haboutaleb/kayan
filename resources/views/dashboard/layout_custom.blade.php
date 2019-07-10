<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ SETTING_VALUE('APP_NAME_AR') }} </title>

    <!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/core.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/components.css" rel="stylesheet" type="text/css">
	<link href="{{ url('public/dashboard_assets') }}/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/core/app.js"></script>
	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/pages/login_validation.js"></script>

	<script type="text/javascript" src="{{ url('public/dashboard_assets') }}/js/plugins/ui/ripple.min.js"></script>
	<!-- /Theme JS files -->

</head>
<body class="login-container login-cover">

	<!-- Page container -->
	<div class="page-container">

    @yield('content')

	</div>

</body>
</html>
