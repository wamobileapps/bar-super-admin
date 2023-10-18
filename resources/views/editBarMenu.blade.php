@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Menu</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('Bar/barsDetails', $data->bar_id); ?>">Bar Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Bar Menu</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Edit Bar Menu</h3>
									</div>

									<div class="card-body">
										<form action="{{url('Bar/BarMenuUpdate', $data->menu_id)}}" method="post" enctype="multipart/form-data">
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
															@foreach($categories->all() as $category)
															<?php $category_id = !empty(old('category_id'))?old('category_id'):$data->category_id; ?>
																<option value="{{$category->id}}" <?php echo $category->id==$category_id?'selected':''; ?>>{{$category->name}}</option>
															@endforeach
															@endif
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('category_id'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Menu Name</label>
														<input type="text" class="form-control" name="name" value="<?php echo empty(old('name'))?$data->name:old('name');?>" placeholder="Menu Name">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Description</label>
														<textarea class="form-control" name="description" placeholder="Description"><?php echo empty(old('description'))?$data->description:old('description');?></textarea>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('description'); ?></span>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Upload Image</label>
														<input type="file" class="form-control" name="image" value="" placeholder="Upload Image">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>
												<div class="form-group">
													<label class="form-label">Amount </label>
													<input type="number" class="form-control" name ="price"  value="<?php echo empty(old('price'))?$data->price:old('price');?>" name="price"  step=".01" placeholder="Amount">
													<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('price'); ?></span>
												</div>
											</div>
												
												<div class="col-md-2 text-left">
													<div class="form-group">
														<input type="submit" class="form-control btn-success" value="Update">
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