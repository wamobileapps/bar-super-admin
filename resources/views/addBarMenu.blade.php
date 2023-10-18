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
										<form action="{{url('barMenuSave')}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="bar_id" value="{{ $data->bar_id }}">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Category</label>
														<select name="category_id" class="form-control">
															<option value="">Select Category</option>
															<?php $categories = $data->categories; ?>
															@if(!empty($categories))
															@foreach($categories as $category)
																<option value="{{$category->id}}" <?php echo old('category_id')==$category->id?'selected':''; ?>>{{$category->name}}</option>
															@endforeach
															@endif
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('category_id'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Menu Name</label>
														<input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Menu Name">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
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
														<label class="form-label">Upload Image</label>
														<input type="file" class="form-control" name="image" value="{{old('image')}}" placeholder="Upload Image">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Amount </label>
														<input type="number" class="form-control" name="price" step=".01" placeholder="Amount">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('price'); ?></span>
													</div>
												</div>
												
												
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
<!-- Back to top -->
@endsection("content")