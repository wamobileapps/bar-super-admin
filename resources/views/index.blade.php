@extends("include.sidebar")

@section("content")				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Dashboard</h4>
							<ol class="breadcrumb">
								<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</div>

						<div class="row">
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-primary">
													<i class="si si si-docs"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total Bars</p>
												<h1>{{$dash->totalBar}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-up-circle text-success mr-1" aria-hidden="true"></i> 12% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-secondary">
													<i class="si si-people"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total Users</p>
												<h1>{{$dash->totalUser}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-danger mr-1" aria-hidden="true"></i>02% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-success">
													<i class="si si-compass"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total Revenue</p>
												<h1>{{$dash->totalRevenue}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-up-circle text-success mr-1" aria-hidden="true"></i>24% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-danger">
													<i class="si si-shield"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Today Revenue</p>
												<h1>{{$dash->todayRevenue}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-warning mr-1" aria-hidden="true"></i>06% this month</p>
										</div> -->
									</div>
								</div>
							</div>
						</div>

						<div class="row">	
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card overflow-hidden">
									<div id="chartContainer" style="height: 370px; width: 100%;"></div>
								</div>
							</div>
							<!-- <div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
								</div>
							</div> -->
							<!-- <div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
								</div>
							</div> -->
							<!-- <div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div id="chartContainer3" style="height: 370px; width: 100%;"></div>
								</div>
							</div> -->
							<!-- <div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card">
									<div id="chartContainer4" style="height: 370px; width: 100%;"></div>
								</div> -->
							<!-- </div> -->
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-primary">
													<i class="si si si-chart"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total Revenue</p>
												<h1>{{$dash->totalRevenue}}</h1>
											</div>
										</div>
										<div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 text-center ">
											<a href="#">View More</a></p>
										</div>
									</div>
								</div>
							</div>
						</div> 
						<div class="row">	
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card-header">
									<h3 class="card-title">New Bars</h3>
								</div>
								<div class="card">
									<table class="table table-striped">
										<thead>
											<tr>
											  <th scope="col">S.No</th>
											  <th scope="col">Name</th>
										
											  
											  <th scope="col">Created at</th>
											</tr>
										</thead>
										<tbody>
											<?php $a = 1; $bars = $dash->bars; ?>
												@if(!empty($bars))
												@foreach($bars->all() as $bar)
									            <tr>
									            	<td>{{$a}}</td>
									                <td>{{$bar->name}}</td>
									                
									                <!-- <td>{{$bar->people_in}}</td> -->
									                <!-- <td>{{$bar->open_time}}</td> -->
									                <!-- <td>{{$bar->close_time}}</td> -->
									                <td>{{$bar->created_at}}</td>
									                
									            </tr>
									            <?php $a++; ?>
												@endforeach
												@endif
										</tbody>
									</table>
									@if ($dash->barCount >= 5)
										<div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 text-center">
											<a href="{{route('Bar.index')}}">View More</a></p>
										</div>
									@endif
								</div>
								
							</div>
							<div class="col-xl-6 col-lg-12 col-md-12">
								<div class="card-header">
									<h3 class="card-title">New Users</h3>
								</div>
								<div class="card">
									<table class="table table-striped">
										<thead>
											<tr>
											  <th scope="col">S.No</th>
											  <th scope="col">Name</th>
											 
											  <!-- <th scope="col">DOB</th> -->
											  <th scope="col">Created at</th>
											</tr>
										</thead>
										<tbody>
											<?php $a = 1; $users = $dash->users; ?>
												@if(!empty($users))
												@foreach($users->all() as $user)
									            <tr>
									            	<td>{{$a}}</td>
									                <td>{{$user->full_name}}</td>
									                
									                <!-- <td>{{$user->dob}}</td> -->
									                <td>{{$user->created_at}}</td>

									            </tr>
									            <?php $a++; ?>
												@endforeach
												@endif
										</tbody>
									</table>
									@if ($dash->userCount >= 5)
										<div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 text-center ">
											<a href="{{route('User.index')}}">View More</a></p>
										</div>
									@endif
								</div>
								
							</div>	
						</div>

					

						

					</div>

					

					<!--footer-->
					<!-- <footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
									Copyright ©  <?php echo date('Y'); ?> <a href="#">Barconnex</a>. Designed by <a href="#">Canopus Info Systems</a> All rights reserved.
								</div>
							</div>
						</div>
					</footer> -->
					<!-- End Footer-->
				</div>
			</div>
		</div>

@endsection("content")