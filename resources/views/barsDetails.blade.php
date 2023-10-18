@extends("include.sidebar")

@section("content")
				
<style type="text/css">
	p.card-text.text-muted.mb-1{
		font-size: 13.5px;
	}
</style>
				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('Bar.index')}}">Bar Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Bar Details</li>
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
												<p class="card-text text-muted mb-1">Revenue food & drink</p>
												<h1>{{$bars->totalRevenue}}</h1>
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
												<p class="card-text text-muted mb-1">Total Revenue</p>
												<h1>{{$bars->totalRevenue}}</h1>
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
												<p class="card-text text-muted mb-1">Today Revenue</p>
												<h1>{{$bars->todayRevenue}}</h1>
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
												<p class="card-text text-muted mb-1">Product Sold</p>
												<h1>{{$bars->quantity}}</h1>
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
														
							<!-- <div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title">Banner List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col">Banner</th>
													
												</tr>
											</thead>
											<tbody>
												
												<?php $a = 1; $banners = $bars->banners; ?>
												@if(!empty($banners))
												@foreach($banners->all() as $banner)
												<tr>
													<th scope="row"><?php echo $a; ?></th>
													 @if($banner->banner_image)
															
														<td><img width="100px" height="100px" src="{{$banner->banner_image}}"></td>

													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/event_icon.png') }}"></td>
                                                    @endif
													
													<td>{{$banner->start_date}}</td>
													<td>{{$banner->expiry_date}}</td> -->
													
													<!-- <td>
														<a class="btn btn-sm btn-primary" href="#"><i class="fa fa-edit"></i> Edit</a>
														<a class="btn btn-sm btn-secondary" href="#"><i class="fa fa-info-circle"></i> Details</a>
													</td> -->
											<!-- 	</tr>
												<?php $a++; ?>
												@endforeach
												@endif

												<tr>
													<td class="text-center" colspan="4"><a href="<?php echo url('Bar/barBanner', $bars->bar_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Photo Wall List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col"> Photo</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $photowalls = $bars->photowall; ?>
												@if(!empty($photowalls))
												@foreach($photowalls->all() as $photo)
												<tr>
													<th scope="row"><?php echo $a; ?></th>
													@if ($photo->image)
													     <td><img width="100px" height="100px" src="{{$photo->image}}"></td>
													@else
													     <td><img width="100px" height="100px" src="{{ url('img/bar-default-image.png') }}"></td>
													@endif
													 -->
													<!-- <td>
														<a class="btn btn-sm btn-primary" href="#"><i class="fa fa-edit"></i> Edit</a>
														<a class="btn btn-sm btn-secondary" href="#"><i class="fa fa-info-circle"></i> Details</a>
													</td> -->
											<!-- 	</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
												<tr>
													<td class="text-center" colspan="3"><a href="<?php echo url('Bar/photoWall', $bars->bar_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div> -->
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
												<?php $a = 1; $orders = $bars->orders; ?>
												@if(!empty($orders))
												@foreach($orders->all() as $order)
												<tr>
													<td>{{$a}}</td>
													<td>{{$order->full_name}}</td>
													
													<td>{{$order->price}}</td>
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												
												<tr>
													<td class="text-center" colspan="4"><a href="<?php echo url('Bar/barOrders', $bars->bar_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Menu Category List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">S.No.</th>
													<th scope="col">Type</th>
													<th scope="col">Name</th>
													<th scope="col">Image</th>
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $categories = $bars->categories; ?>
												@foreach($categories->all() as $category)
												<tr>
													<td>{{$a}}</td>
													<td>{{$category->menu_type}}</td>
													<td>{{$category->name}}</td>

													@if($category->image)
															
														<td><img width="80px" height="80" src="{{$category->image}}"></td>
													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/menuCategory.jpeg') }}"></td>
                                                    @endif
												</tr>
												<?php $a++; ?>
												@endforeach
												<tr>
													<td class="text-center" colspan="4"><a href="<?php echo url('Bar/barMenuCategory', $bars->bar_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Menu List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col">Category</th>
													<th scope="col">Name</th>
													<th scope="col">Price</th>
													<th scope="col">Image</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $menus = $bars->menus; ?>
												@if(!empty($menus))
												@foreach($menus->all() as $menu)
												<tr>
													<td>{{$a}}</td>
													<td>{{$menu->categoryName}}</td>
													<td>{{$menu->name}}</td>
													<td>{{$menu->price}}</td>

													@if($menu->image)
															
														<td><img width="80px" height="80" src="{{$menu->image}}"></td>
													@else                                    
                                                    	<td><img width="80px" height="80px" src="{{ url('img/menu.jpg') }}"></td>
                                                    @endif
													
												</tr>
												<?php $a++; ?>
												@endforeach
												@endif
												<tr>
													<td class="text-center" colspan="5"><a href="<?php echo url('Bar/barMenu', $bars->bar_id); ?>">View
													More</a></td>
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
													<th scope="col">ID</th>
													<th scope="col">Name</th>
													<th scope="col">Start date</th>
													<th scope="col">Image</th>
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $events = $bars->events; ?>
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
													<td class="text-center" colspan="4"><a href="<?php echo url('Bar/barEvent', $bars->bar_id); ?>">View More</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-6 text-center">
								<div class="card">
									<div class="card-header ">
										<h3 class="card-title ">Game List</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-hover card-table table-striped table-vcenter table-outline text-nowrap">
											<thead>
												<tr>
													<th scope="col">ID</th>
													<th scope="col"> Name</th>
													<th scope="col"> Image</th>
													
												</tr>
											</thead>
											<tbody>
												<?php $a = 1; $games = $bars->games; ?>
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
													<td class="text-center" colspan="3"><a href="<?php echo url('Bar/barGame', $bars->bar_id); ?>">View More</a></td>
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