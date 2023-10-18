@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Event</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('Bar/barsDetails', $data->bar_id); ?>">Bar Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Event</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Add Bar Event</h3>
									</div>

									<div class="card-body">
										<form action="{{url('barEventSave')}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="bar_id" value="{{ $data->bar_id }}">
											<div class="row">
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Name</label>
														<input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Color</label>
														<input type="text" class="form-control" name="color" value="{{old('color')}}" placeholder="Color">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('color'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Event Type</label>
														<input type="text" class="form-control" name="event_type" value="{{old('event_type')}}" placeholder="Event Type">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('event_type'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Date of Event</label>
														<input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" placeholder="Start Date">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('start_date'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Start Time</label>
														<input type="time" class="form-control" name="start_time" value="{{old('start_time')}}" placeholder="Start Time">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('start_time'); ?></span>
													</div>
												</div>

												<!-- <div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter End Date</label>
														<input type="date" class="form-control" name="end_date" value="{{old('end_date')}}" placeholder="End Date">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('end_date'); ?></span>
													</div>
												</div> -->

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter End Time</label>
														<input type="time" class="form-control" name="end_time" value="{{old('end_time')}}" placeholder="End Time">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('end_time'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Description</label>
														<textarea class="form-control" name="description" placeholder="Description">{{old('description')}}</textarea>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('description'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Icon</label>
														<input type="file" class="form-control" name="icon" value="{{old('icon')}}" placeholder="Icon">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('icon'); ?></span>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Image</label>
														<input type="file" class="form-control" name="image" value="{{old('image')}}" placeholder="Image">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('image'); ?></span>
													</div>
												</div>
												
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