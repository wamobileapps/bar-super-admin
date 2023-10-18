@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bars Banner Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('Bar/barsDetails', $data->bar_id); ?>">Bar Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Bar Banner</li>
							</ol>
						</div>

						
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h3 class="card-title" style="float: left;"></h3>
								<h3 style="float: right;"><a  class="btn btn-md btn-success" href="<?php echo url('Bar/addBarMenuCategory', $data->bar_id); ?>">Add</a></h3>
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
											                <th>Menu type</th>
											                <th>Name</th>
											                <th>Image</th>
											                <!-- <th>Remark</th> -->
											                <!-- <th>Status</th> -->
											                <th>Created At</th>
											                <!-- <th>Updated At</th> -->
											                <th>Action</th>
											            </tr>
											        </thead>
											        <tbody>
														<?php $a = 1; $categories = $data->categories; ?>
														@if(!empty($categories))
														@foreach($categories->all() as $category)
											            <tr>
											            	<td>{{$a}}</td>
											                <td>{{ucfirst($category->menu_type)}}</td>
											                <td>{{$category->name}}</td>
											                <!-- <td><img width="80px" height="80px" src="{{$category->image}}"></td>
 -->
                                                             @if($category->image)
															
																<td><img width="80px" height="80" src="{{$category->image}}"></td>
															@else                                    
		                                                    	<td><img width="80px" height="80px" src="{{ url('img/menuCategory.jpeg') }}"></td>
		                                                    @endif

											                <!-- <td>{{$category->status}}</td> -->
											                <td>{{$category->created_at}}</td>
											                <td><a href="<?php echo url('Bar/editBarMenuCategory', $category->id); ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp; <a onclick="return confirm('Are you sure delete this data')" href="<?php echo url('Bar/deleteBarcategory', $category->id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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

					<!-- 	<footer class="footer">
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
	</div>
@endsection("content")