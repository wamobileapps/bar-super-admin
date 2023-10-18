@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Menu</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('Bar/barsDetails', 1); ?>">Bar Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Bar Menu</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Add Bar Menu</h3>
									</div>

									<div class="card-body">
										<form action="{{url('barBannerSave')}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="bar_id" value="{{ $data->bar_id }}">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Start Date</label>
														<input type="date" class="form-control" name="start_date" placeholder="Start Date">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('start_date'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Expaire Date</label>
														<input type="date" class="form-control" name="expiry_date" placeholder="Expaire Date">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('expiry_date'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Upload Image</label>
														<input type="file" class="form-control" name="banner_image" placeholder="Upload Image">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('banner_image'); ?></span>
													</div>
												</div>
												<div class="col-md-6"></div>
												
												<div class="col-md-2 text-left">
													<div class="form-group">
														<input type="submit" class="form-control btn-success" value="Submit">
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
<!-- Back to top -->
@endsection("content")