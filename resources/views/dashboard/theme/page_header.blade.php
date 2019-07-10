
<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<img src="{{ url('public/dashboard_assets/images/header.png')   }}" class="img-responsive" />
		</div>
	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="{{ route('dashboard_home') }}"><i class="icon-home2 position-left"></i> {{ trans('dash.home') }} </a></li>
			@if(isset($squence_pages))
				@foreach ($squence_pages as $key => $value )
					<li><a @if(!$loop->last) href="{{ $value }}" @endif ><i class="position-left"></i> {{ $key }} </a></li>
				@endforeach
			@endif
		</ul>

		<ul class="breadcrumb-elements">

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-link position-left"></i>
					{{ trans('dash.quick_links') }}
					<span class="caret"></span>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">

					<li><a href="#"><i class="icon-statistics"></i> {{ trans('dash.add_new_users') }} </a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-statistics"></i> {{ trans('dash.users') }} </a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-accessibility"></i> {{ trans('dash.add_new_city') }} </a></li>
					<li class="divider"></li>
					<li><a href="{{ route('setting') }}"><i class="icon-gear"></i> {{ trans('dash.settings') }} </a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<!-- /page header -->

