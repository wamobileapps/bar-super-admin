@include('include.header')
<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar toggle-sidebar">
					<div class="app-sidebar__user">
						<div class="user-body">
							<span class="avatar avatar-xl brround text-center cover-image" data-image-src="assets/images/users/male/4.jpg"></span>
						</div>
						<div class="user-info">
							<a href="#" class="ml-2"><span class="app-sidebar__user-name font-weight-semibold">Bar Admin</span><br>
								<span class="text-muted app-sidebar__user-name text-sm">{{auth()->user()->full_name}}</span>
							</a>
						</div>
					</div>
				<!-- 	<div class="sidebar-navs">
						<ul class="nav  nav-pills-circle">
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Settings">
								<a class="nav-link border h-6 text-center m-2">
									<i class="fe fe-settings"></i>
								</a>
							</li>
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Chat">
								<a class="nav-link border h-6  m-2">
									<i class="fe fe-mail"></i>
								</a>
							</li>
							<li class="nav-item" data-toggle="tooltip" data-placement="top" title="Followers">
								<a class="nav-link border h-6  m-2">
									<i class="fe fe-user"></i>
								</a>
							</li>
							<li class="nav-item" title="Logout">
								<a class="nav-link border h-6  m-2" href="">
									<i class="fe fe-power"></i>
								</a>
							</li>
						</ul>
					</div> -->
					<ul class="side-menu toggle-menu">
						<!-- <li class="slide">
							<a class="side-menu__item"  data-toggle="slide" href="#"><i class="side-menu__icon typcn typcn-device-laptop"></i><span class="side-menu__label">Dashboard</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item"  href="index.html"><span>Dashboard 01</span></a></li>
								<li><a class="slide-item" href="index2.html"><span>Dashboard 02</span></a></li>
								<li><a class="slide-item" href="index3.html"><span>Dashboard 03</span></a></li>
								<li><a class="slide-item" href="index4.html"><span>Dashboard 04</span></a></li>
								<li><a class="slide-item" href="index5.html"><span>Dashboard 05</span></a></li>
							</ul>
						</li> -->
						<li>
							<a class="side-menu__item" href="{{url('dashboard')}}"><i class="side-menu__icon typcn typcn-device-laptop"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{route('Bar.index')}}"><i class="side-menu__icon typcn typcn-th-small"></i><span class="side-menu__label">Manager Bars</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{route('User.index')}}"><i class="side-menu__icon typcn typcn-group-outline"></i><span class="side-menu__label">Manager Users</span></a>
						</li>
{{--						<li>--}}
{{--							<a class="side-menu__item" href="{{url('Bar/barGame/')}}"><i class="side-menu__icon typcn typcn-group-outline"></i><span class="side-menu__label">Manager Users</span></a>--}}
{{--						</li>--}}
                        <li>
							<a class="side-menu__item" href="{{route('Notification.index')}}"><i class="side-menu__icon typcn typcn-bell"></i><span class="side-menu__label">Send Notification</span></a>
						</li>
						  <li>
							<a class="side-menu__item" href="{{route('activities')}}"><i class="side-menu__icon  typcn typcn-th-menu-outline"></i><span class="side-menu__label">Activities</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{route('reset-password')}}"><i class="side-menu__icon typcn typcn-lock-closed-outline"></i><span class="side-menu__label">Reset Password</span></a>
						</li>
						<li>
							<a class="side-menu__item" href="{{url('logout')}}"><i class="side-menu__icon typcn typcn-power-outline"></i><span class="side-menu__label"> Logout </span></a>
						</li>
						
						
					</ul>
				</aside>
				<!--sidemenu end-->
				@yield("content")
				@include('include.footer')
				