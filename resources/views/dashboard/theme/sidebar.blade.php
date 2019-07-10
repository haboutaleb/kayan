<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user-material">
			<div class="category-content">
				<div class="sidebar-user-material-content">
					<a href="#"><img src="{{ auth()->user()->image_url }}" class="img-circle img-responsive" alt=""></a>
					<h6> {{ auth()->user()->full_name }} </h6>
					<span class="text-size-small"> {{ auth()->user()->admin_group->name_ar }} </span>
				</div>

				<div class="sidebar-user-material-menu">
					<a href="#user-nav" data-toggle="collapse"><span>{{ trans('dash.my_account') }}</span> <i class="caret"></i></a>
				</div>
			</div>

			<div class="navigation-wrapper collapse" id="user-nav">
				<ul class="navigation">
					<li><a href="{{ route('admin_profile') }}"><i class="icon-user-plus"></i> <span> {{ trans('dash.my_profile') }} </span></a></li>
					<li class="divider"></li>
					<li><a href="{{ route('setting') }}"><i class="icon-cog5"></i> <span> {{ trans('dash.settings') }} </span></a></li>
					<li><a href="{{ route('dashboard_logout') }}"><i class="icon-switch2"></i> <span> {{ trans('dash.logout') }} </span></a></li>
				</ul>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span> {{ trans('dash.main') }} </span> <i class="icon-menu" title="Main pages"></i></li>
					<li {{ request()->route()->getName() === 'dashboard_home' ? ' class=active' : '' }} ><a href="{{ route('dashboard_home') }}"><i class="icon-home4"></i> <span> {{ trans('dash.home') }} </span></a></li>

					<li>
						<a href="#"><i class="icon-people"></i> <span> {{ trans('dash.users') }} </span></a>
						<ul>
							<li {{ request()->route()->getName() === 'user' ? ' class=active' : '' }}><a href="{{ route('user') }}">{{ trans('dash.users') }}</a></li>
							<li {{ request()->route()->getName() === 'user_create' ? ' class=active' : '' }}><a href="{{ route('user_create') }}">{{ trans('dash.add_new_users') }}</a></li>
						</ul>
                    </li>


                    <li>
                        <a href="#"><i class="icon-city"></i> <span> {{ trans('dash.countries') }} </span></a>
                        <ul>
                            <li {{ request()->route()->getName() === 'countries' ? ' class=active' : '' }}><a href=" {{ route('countries') }} " > {{ trans('dash.countries') }} </a></li>
                            <li {{ request()->route()->getName() === 'country_create' ? ' class=active' : '' }}><a href=" {{ route('country_create') }} " > {{ trans('dash.add_new_country') }} </a></li>
                        </ul>
                    </li>

					<li>
						<a href="#"><i class="icon-city"></i> <span> {{ trans('dash.cities') }} </span></a>
						<ul>
							<li {{ request()->route()->getName() === 'cities' ? ' class=active' : '' }}><a href=" {{ route('cities') }} " > {{ trans('dash.cities') }} </a></li>
							<li {{ request()->route()->getName() === 'city_create' ? ' class=active' : '' }}><a href=" {{ route('city_create') }} " > {{ trans('dash.add_new_city') }} </a></li>
						</ul>
					</li>



					<!-- /main -->

					<!-- others -->
					<li class="navigation-header"><span> {{ trans('dash.others') }} </span> <i class="icon-menu" title=" {{ trans('dash.others') }} "></i></li>

                    <li>
						<a href="#"><i class="icon-fire"></i> <span> {{ trans('dash.administration') }} </span></a>
						<ul>
							<li {{ request()->route()->getName() === 'administration_groups' ? ' class=active' : '' }}><a href="{{ route('administration_groups') }}"> {{ trans('dash.administration_groups') }} </a></li>
							<li {{ request()->route()->getName() === 'admins' ? ' class=active' : '' }}><a href="{{ route('admins') }}"> {{ trans('dash.admins') }} </a></li>
						</ul>
					</li>



					<li>
						<a href="#"><i class="icon-rocket"></i> <span> {{ trans('dash.nationalities') }} </span></a>
						<ul>
							<li {{ request()->route()->getName() === 'nationality' ? ' class=active' : '' }}><a href="{{ route('nationality') }}"> {{ trans('dash.nationalities') }} </a></li>
							<li {{ request()->route()->getName() === 'nationality_create' ? ' class=active' : '' }}><a href="{{ route('nationality_create') }}"> {{ trans('dash.create_new_nationalities') }} </a></li>
						</ul>
                    </li>

					<li>
						<a href="#"><i class="icon-trophy3"></i> <span> {{ trans('dash.category') }} </span></a>
						<ul>
							<li {{ request()->route()->getName() === 'category' ? ' class=active' : '' }}><a href="{{ route('category') }}"> {{ trans('dash.category') }} </a></li>
							<li {{ request()->route()->getName() === 'category_create' ? ' class=active' : '' }}><a href="{{ route('category_create') }}"> {{ trans('dash.create_new_category') }} </a></li>
						</ul>
                    </li>

					<li>
						<a href="#"><i class="icon-paperplane"></i> <span> {{ trans('dash.offer') }} </span></a>
						<ul>
							<li {{ request()->route()->getName() === 'offer' ? ' class=active' : '' }}><a href="{{ route('offer') }}"> {{ trans('dash.offer') }} </a></li>
							<li {{ request()->route()->getName() === 'offer_create' ? ' class=active' : '' }}><a href="{{ route('offer_create') }}"> {{ trans('dash.create_new_offer') }} </a></li>
						</ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-diamond"></i> <span> {{ trans('dash.useroffer') }} </span></a>
                        <ul>
                            <li {{ request()->route()->getName() === 'useroffer' ? ' class=active' : '' }}><a href="{{ route('useroffer') }}"> {{ trans('dash.useroffer') }} </a></li>
                            <li {{ request()->route()->getName() === 'useroffer_create' ? ' class=active' : '' }}><a href="{{ route('useroffer_create') }}"> {{ trans('dash.create_new_useroffer') }} </a></li>
                        </ul>
                    </li>

					<li>
                        <a href="#"><i class="icon-balance"></i> <span> {{ trans('dash.messages') }} </span></a>
                        <ul>
                            <li {{ request()->route()->getName() === 'message' ? ' class=active' : '' }}><a href="{{ route('message') }}"> {{ trans('dash.message') }} </a></li>
                            <li {{ request()->route()->getName() === 'message_create' ? ' class=active' : '' }}><a href="{{ route('message_create') }}"> {{ trans('dash.create_new_message') }} </a></li>
                        </ul>
                    </li>

					<li>
                        <a href="#"><i class="icon-ticket"></i> <span> {{ trans('dash.contacts') }} </span></a>
                        <ul>
                            <li {{ request()->route()->getName() === 'contact' ? ' class=active' : '' }}><a href="{{ route('contact') }}"> {{ trans('dash.contact') }} </a></li>
                            <li {{ request()->route()->getName() === 'contact_create' ? ' class=active' : '' }}><a href="{{ route('contact_create') }}"> {{ trans('dash.create_new_contact') }} </a></li>
                        </ul>
                    </li>


					<li>
                        <a href="#"><i class="icon-ticket"></i> <span> {{ trans('dash.reviews') }} </span></a>
                        <ul>
                            <li {{ request()->route()->getName() === 'review' ? ' class=active' : '' }}><a href="{{ route('review') }}"> {{ trans('dash.review') }} </a></li>
                            <li {{ request()->route()->getName() === 'review_create' ? ' class=active' : '' }}><a href="{{ route('review_create') }}"> {{ trans('dash.create_new_review') }} </a></li>
                        </ul>
                    </li>

					<li>
                        <a href="#"><i class="icon-ticket"></i> <span> {{ trans('dash.comments') }} </span></a>
                        <ul>
                            <li {{ request()->route()->getName() === 'comment' ? ' class=active' : '' }}><a href="{{ route('comment') }}"> {{ trans('dash.comment') }} </a></li>
                            <li {{ request()->route()->getName() === 'comment_create' ? ' class=active' : '' }}><a href="{{ route('comment_create') }}"> {{ trans('dash.create_new_comment') }} </a></li>
                        </ul>
                    </li>


						<li {{ request()->route()->getName() === 'setting' ? ' class=active' : '' }} ><a href="{{ route('setting') }}"><i class="icon-wrench3"></i> <span> {{ trans('dash.settings') }} </span></a></li>



					<!-- /others -->

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
<!-- /main sidebar -->
