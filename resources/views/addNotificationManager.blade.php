@extends("include.sidebar")

@section("content")	

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Notification Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('Bar.index')}}">Notification Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Send Notification</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Send Notification</h3>
									</div>

									<div class="card-body">
										<form action="{{route('Notification.store')}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
                                                <div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Notification</label>
                                                        <textarea name="notification" class="form-control" id="" cols="30" rows="5"></textarea>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('notification'); ?></span>
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