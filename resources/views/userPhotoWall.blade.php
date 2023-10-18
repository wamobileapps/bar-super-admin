
@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bars PhotoWall Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('User/userDetails', $data->user_id); ?>">User Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Bar PhotoWall</li>
							</ol>
						</div>

						
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<!-- <h3 class="card-title" style="float: left;">Bar Order</h3> -->
								<!-- <h3 style="float: right;"><a  class="btn btn-md btn-success" href="addBar.php">Add</a></h3> -->
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
											                <th>Photo Wall</th>
											                <th>Created At</th>
											                <th>Action</th>
											            </tr>
											        </thead>
											        <tbody>
											        	<?php $a = 1; $photowalls = $data->photowalls; ?>
														@if(!empty($photowalls))
														@foreach($photowalls->all() as $photowall)
											            <tr>
											            	<td>{{$a}}</td>
											                <td><img width="150px" height="100px" src="{{$photowall->image}}"></td>
											                <td>{{$photowall->created_at}}</td>
											           
											                <td><a onclick="return confirm('Are you sure delete this data')" href="<?php echo url('User/deleteUserPhotoWall', $photowall->id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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