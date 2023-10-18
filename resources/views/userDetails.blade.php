@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">User Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('User.index')}}">User Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">User Details</li>
							</ol>
						</div>

						<div class="row">
							<div class="col-sm-12 col-lg-6 col-xl-4">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-primary">
													<i class="si si si-docs"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Order</p>
												<h1>{{count($user->orders)}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-up-circle text-success mr-1" aria-hidden="true"></i> 12% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-4">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-secondary">
													<i class="si si-people"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total Purchasing</p>
												<h1>{{$user->totalAmount}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-danger mr-1" aria-hidden="true"></i>02% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							
							<div class="col-sm-12 col-lg-6 col-xl-4">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-danger">
													<i class="si si-shield"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total friends</p>
												<h1>{{count($user->fusers)}}</h1>
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
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Latest order List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col">Name</th>
													
													<th scope="col">Price</th>
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $orders = $user->orders; ?>
												@if(!empty($orders))
												@foreach($orders->all() as $order)
												<tr>
													<td>{{$a}}</td>
													<td>{{$order->name}}</td>
													
													<td>{{$order->price}}</td>
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												
												<tr>
													<td class="text-center" colspan="4"><a href="<?php echo url('User/userOrders', $user->user_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Photo Wall List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col"> Photo</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $photowalls = $user->photowall; ?>
												@if(!empty($photowalls))
												@foreach($photowalls->all() as $photo)
												<tr>
													<th scope="row"><?php echo $a; ?></th>
													<td><img width="80px" height="80px" src="{{$photo->image}}"></td>
													
													<!-- <td>
														<a class="btn btn-sm btn-primary" href="#"><i class="fa fa-edit"></i> Edit</a>
														<a class="btn btn-sm btn-secondary" href="#"><i class="fa fa-info-circle"></i> Details</a>
													</td> -->
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
												<tr>
													<td class="text-center" colspan="3"><a href="<?php echo url('User/userPhotoWall', $user->user_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Event List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col">Name</th>
													<th scope="col">Start date</th>
													<th scope="col">Image</th>
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $events = $user->events; ?>
												@if(!empty($events))
												@foreach($events->all() as $event)
												<tr>
													<td>{{$a}}</td>
													<td>{{$event->name}}</td>
													<td>{{$event->start_date}} {{$event->start_time}}</td>
													@if($event->image)
													
														<td><img width="80px" height="80px" src="{{$event->image}}"></td> 
													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/event.jpeg') }}"></td>
                                                    @endif
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
													<td class="text-center" colspan="4"><a href="<?php echo url('User/userEvents', $user->user_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Favourite Game List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col"> Name</th>
													<th scope="col"> Image</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $games = $user->games; ?>
												@if(!empty($games))
												@foreach($games->all() as $game)
												<tr>
													<td>{{$a}}</td>
													<td>{{$game->name}}</td>
													@if($game->image)
															
														<td><img width="80px" height="80px" src="{{$game->image}}"></td> 
													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/game-icon.jpg') }}"></td>
                                                    @endif
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
													<td class="text-center" colspan="3"><a href="<?php echo url('User/userGames', $user->user_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Friends List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col"> Name</th>
													<th scope="col"> Image</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $fusers = $user->fusers; ?>
												@if(!empty($fusers))
												@foreach($fusers->all() as $fuser)
												<tr>
													<td>{{$a}}</td>
													<td>{{$fuser->full_name}}</td>
													@if($fuser->profileImage)
															
														<td><img width="80px" height="80px" src="{{$fuser->profileImage}}"></td> 
													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/user-icon.jpg') }}"></td>
                                                    @endif
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
													<td class="text-center" colspan="3"><a href="<?php echo url('User/userFriends', $user->user_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Block users List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col"> Name</th>
													<th scope="col"> Image</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $busers = $user->busers; ?>
												@if(!empty($busers))
												@foreach($busers->all() as $buser)
												<tr>
													<td>{{$a}}</td>
													<td>{{$buser->full_name}}</td>
													@if($fuser->profileImage)
															
														<td><img width="80px" height="80px" src="{{$fuser->profileImage}}"></td> 
													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/user-icon.jpg') }}"></td>
                                                    @endif
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
													<td class="text-center" colspan="3"><a href="<?php echo url('User/userblock', $user->user_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection("content")