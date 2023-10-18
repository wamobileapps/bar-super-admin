@extends("include.sidebar")

@section("content")	
<style type="text/css">
	div#example_wrapper{
		overflow: auto;
	}
</style>				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bars Events Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('Bar/barsDetails', $data->bar_id); ?>">Bar Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Bar Events</li>
							</ol>
						</div>

				
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h3 class="card-title" style="float: left;"></h3>
								<h3 style="float: right;"><a  class="btn btn-md btn-success" href="<?php echo url('Bar/addBarEvent', $data->bar_id); ?>">Add</a></h3>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="col-sm-12 col-lg-12 col-xl-12">
										@if(Session::has('BarError'))
			                                <div class="alert alert-danger">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('BarError')}}
			                                </div>
				                        @endif

				                        @if(Session::has('BarSuccess'))
				                                <div class="alert alert-success">
				                                    <div class="close" data-dismiss="alert">X</div>
				                                    {{Session('BarSuccess')}}
				                                </div>
				                        @endif
										<table id="example" class="table display table-bordered" style="width:100%">
											        <thead>
											            <tr>
															<th>S.No</th> 
															<th><?php echo ucfirst('name'); ?></th> 
															<th><?php echo ucfirst('description'); ?></th> 
															
															<th><?php echo ucfirst('image'); ?></th> 
															
															<th><?php echo ucfirst('event type'); ?></th> 
															<th><?php echo ucfirst('date of event'); ?></th> 
															<!-- <th><?php //echo ucfirst('status'); ?></th> -->
															<th><?php echo ucfirst('created at'); ?></th>
											                <th>Action</th>
											            </tr>
											        </thead>
											        <tbody>
											        	<?php $a = 1; $events = $data->events; ?>
														@if(!empty($events))
														@foreach($events->all() as $event)
											            <tr>
											            	<th>{{$a}}</th> 
															<td>{{$event->name}}</td> 
															<td>{{$event->description}}</td> 
															<!-- @if($event->icon)
															
																<td><img width="80px" height="80px" src="{{$event->icon}}"></td>
															@else                                    
                                                            	<td><img width="80px" height="80px" src="{{ url('img/event_icon.png') }}"></td>
                                                            @endif -->

                                                            @if($event->image)
															
																<td><img width="80px" height="80px" src="{{$event->image}}"></td> 
															@else                                    
                                                            	<td><img width="80px" height="80px" src="{{ url('img/event.jpeg') }}"></td>
                                                            @endif

															<!-- <td>{{$event->color}}</td>  -->
															<td>{{$event->event_type}}</td> 
															<td>{{$event->start_date}}</td> 
															<td>{{$event->end_date}}</td>
											                <td>{{$event->created_at}}</td>
											                <!-- <td>2020-02-22 12:22:00</td> -->
											                <td><a href="<?php echo url('Bar/editBarEvent', $event->event_id); ?>" class="btn btn-sm btn-warning mb-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp; </a> &nbsp;&nbsp; <!-- <a onclick="return confirm('Are you sure delete this data')" href="<?php echo url('Bar/deleteBarEvent', $event->event_id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> --></td>
											            </tr>
											            <?php $a++; ?>
														@endforeach
														@endif
											        </tbody>
										</table>
									</div>
								</div>
							</div>			
						</div> 

						<footer class="footer">
							<div class="container">
								<div class="row align-items-center flex-row-reverse">
									<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
										Copyright ©  <?php echo date('Y'); ?> <a href="#">Barconnex</a>. Designed by <a href="#">Canopus Info Systems</a> All rights reserved.
									</div>
								</div>
							</div>
						</footer>
					<!-- End Footer-->
					</div>
				</div>
		</div>
	</div>
@endsection("content")