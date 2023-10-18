
@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">User Order Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('User/userDetails', $data->user_id); ?>">User Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">User Orders</li>
							</ol>
						</div>

						
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
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
									                
									                <th>User</th>
									                <th>Establishment Name</th>
									                <th>Menu Type</th>
									                <th>Item Name</th>
									                <th>Item Id</th>
									                <th>Category</th>
									                <th>Price</th>
									                <th>Payment Id</th>
									                <th>Purchase Date</th>
									                <th>Regift To</th>
									                <th>Regift Sent</th>
									                <th>Regift Recieved</th> 
									                <th>Redeem Date</th>
									                <th>Action</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php $a = 1; $orders = $data->orders; ?>
												@if(!empty($orders))
												@foreach($orders->all() as $order)
									            <tr>
									            	<th>{{$a}}</th>
									            	<td>{{$order->full_name}}</td> 

													<td>{{$order->nameBar}}</td> 
													 <td>{{$order->menu_type}}</td> 
									            	<td>{{$order->drink_name}}</td>
									            	<td>{{$order->item_id}}</td>
									                <td>{{$order->category_name}}</td>
													<!-- <td>{{$order->quantity}}</td>  -->
													<td>{{$order->price}}</td>
									            	<td>{{$order->payments_id}}</td>
									            	
									                <td>{{date('d/m/y h:i a',strtotime($order->purchase_date))}}</td>

									                <td>{{$order->regift_to}}</td>
									                
                                                    
                                                    @if($order->regift_send_date!=null)
									                <td>{{date('d/m/y h:i a',strtotime($order->regift_send_date))}}</td>
									                @else
									                <td>{{$order->regift_send_date}}</td>
                                                     @endif



                                                    @if($order->regift_recieved_date!=null)
									                <td>{{date('d/m/y h:i a',strtotime($order->regift_recieved_date))}}</td>
									                @else
									                <td>{{$order->regift_recieved_date}}</td>
                                                     @endif

                                                     @if($order->redeem_date!=null||$order->redeem_date!='')
									                <td>{{date('d/m/y h:i a',strtotime($order->redeem_date))}}</td>
									                @else
									                <td>{{$order->redeem_date}}</td>
                                                     @endif
									                
									                <td><a onclick="return confirm('Are you sure delete this data')" href="<?php echo url('Bar/deleteBarOrder', $order->order_id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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