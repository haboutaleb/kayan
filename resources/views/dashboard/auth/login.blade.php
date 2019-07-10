@extends('dashboard.layout_custom')

@section('content')

    <!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content pb-20">


					<!-- Form with validation -->
					<form action="{{ url('dashboard/login_post') }}" method="post" class="form-validate">
                        {{ Form::token() }}
						<div class="panel panel-body login-form">

							@forelse($errors->all() as $message)
							<div class="alert alert-danger" style="direction: rtl;">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								{{ $message }}
							</div>
							@empty
							@endforelse

							@if (session('message') && session('class') )
							<div style="padding: 5px 25px;direction: rtl;">
								<div class="{{  session('class') }}">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									{{ session('message') }}
								</div>
							</div>
							@endif

							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group"> {{ trans('dash.login_from_title') }} <small class="display-block"> {{ trans('dash.admin') }} </small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="email" class="form-control" placeholder="{{ trans('dash.email') }}" name="identify" required="required">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="{{ trans('dash.password') }}" name="password" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="remember">
											{{ trans('dash.remember') }}
										</label>
									</div>

									<div class="col-sm-6 text-right">
										<a href="#">{{ trans('dash.forgot_password') }}  </a>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-pink-400 btn-block"> {{ trans('dash.login') }} <i class="icon-arrow-left13 position-right"></i></button>
							</div>





					</form>
					<!-- /form with validation -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

@endsection
