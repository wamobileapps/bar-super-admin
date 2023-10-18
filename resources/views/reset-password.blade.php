@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Reset Password</h4>
							<ol class="breadcrumb">
								
								<li class="breadcrumb-item active" aria-current="page">Reset Password</li>
							</ol>
						</div>
							<div class="row3">
                                       
	                        @if(Session::has('Error'))
			                                <div class="alert alert-danger">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('Error')}}
			                                </div>
			                            @endif
			                @if(Session::has('Success'))
			                               <div class="alert alert-success">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('Success')}}
			                                </div>
			                            @endif
			                </div>            
						             <div class="row1">
                                       

										<form action="{{route('reset')}}" method="post">
											{{ csrf_field() }}
										
											<div class="card-body">

												<div class="input-group mb-3">
													<span class="input-group-addon "><i class="fa fa-user"></i></span>
													<input type="password" class="form-control" name="current_password" placeholder="Current Password">
												
												</div>
												<span class="text-danger text-left mb-3"><?php echo $errors->first('current_password'); ?></span>
												<div class="input-group mb-3">
													<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
													<input type="password" class="form-control" name="password" placeholder="New Password"><br>
													
													
												</div>
												<span class="text-danger text-left mb-3" ><?php echo $errors->first('password'); ?></span>
												<div class="input-group mb-3">
                                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password"><br>  
                                                </div>
												<div class="clearfix"></div>
												<div class="row">
													<div class="col-12">
														<button type="submit" class="btn btn-primary btn-block">Reset</button>
													</div>
                      
												</div>


											</div>
										</form>
					  		
						</div>
								


					</div>
				</div>	
					
@endsection("content")