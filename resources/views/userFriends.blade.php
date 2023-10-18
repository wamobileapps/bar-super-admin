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
							<h4 class="page-title">Friends Details</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('User/userDetails', $data->user_id); ?>">User Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Friends</li>
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
											                
											                <th>image</th>
											                <th>fullName</th>
											                <th>email</th>
											                <th>DOB</th>
											                <th>Created At</th>
											                <!-- <th>Action</th> -->
											            </tr>
											        </thead>
											        <tbody>
											        	<?php $a = 1; $friends = $data->friends; ?>
														@if(!empty($friends))
														@foreach($friends->all() as $friend)
											            <tr>
															<td>{{$a}}</td> 
														
															<td>@if(!empty($friend->profileImage))
															<img width="80px" height="80px" src="{{$friend->profileImage}}">
															@else
															  <img width="80px" height="80px" src="{{ url('img/user-icon.jpg') }}">
															@endif
															</td> 
															<td>{{$friend->full_name}}</td> 
															<td>{{$friend->email}}</td> 
															<td>{{$friend->dob}}</td>
															<td>{{$friend->created_at}}</td>  
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