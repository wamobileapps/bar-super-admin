@extends("include.sidebar")

@section("content")	

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('Bar.index')}}">Bar Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Bar</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Add Bar</h3>
									</div>
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
									<div class="card-body">
										<form action="{{url('barSave')}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Bar Name</label>
														<input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Bar Name">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Email</label>
														<input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('email'); ?></span>
													</div>
												</div>
											<!---	<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter People In</label>
														<input type="number" class="form-control" name="people_in" value="{{old('people_in')}}" placeholder="People In">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('people_in'); ?></span>
													</div>
												</div>--->
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Password</label>
														<input type="password" class="form-control" name="password" value="" placeholder="Password">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('password'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Address</label>
														<input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Address">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('address'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Latitude</label>
														<input type="number" class="form-control" name="latitude" value="{{old('latitude')}}" placeholder="Latitude" step="0.000001">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('latitude'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Longitude</label>
														<input type="number" class="form-control" name="longitude" value="{{old('longitude')}}" placeholder="Longitude" step="0.000001">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('longitude'); ?></span>
													</div>
												</div>
												
												<!---<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Open Time</label>
														<input type="time" class="form-control" name="open_time" value="{{old('open_time')}}" placeholder="Open Time">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('open_time'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Close Time</label>
														<input type="time" class="form-control" name="close_time" value="{{old('close_time')}}" placeholder="Close Time">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('close_time'); ?></span>
													</div>
												</div>--->
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Name</label>
														<input type="text" class="form-control" name="bank_account_name" value="{{old('bank_account_name')}}" placeholder="Name of account Holder ">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('bank_account_name'); ?></span>
													</div>
												</div>
												
												<!------<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Account Number</label>
														<input type="text" class="form-control" name="account_number" value="{{old('account_number')}}" placeholder="Account Number">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('account_number'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Routing Number</label>
														<input type="text" class="form-control" name="routing_number" value="{{old('routing_number')}}" placeholder="Routing Number">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('routing_number'); ?></span>
													</div>
												</div>---->
												<div class="col-md-6">
													<div class="card">
														<div class="card-header">
															<h3 class="mb-0 card-title">File Upload with Default Image</h3>
														</div>
														<div class="card-body">
															<input type="file" class="dropify" name="cover_image" data-default-file="<?php echo url('/'); ?>/assets/images/photos/1.jpg"  />
															<span class="text-danger text-left mb-3"><?php echo $errors->first('cover_image'); ?></span>
														</div>
													</div>
												</div>
												<div class="col-md-6"></div>
												<div class="col-md-2 text-left">
													<div class="form-group">
														
														<input type="submit" class="form-control btn-success" name="submit" value="Submit">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					

					</div>

			
				</div>
			</div>
		</div>
		@endsection("content")