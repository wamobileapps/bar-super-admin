
@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Menu Category</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo url('Bar/barsDetails', $data->bar_id); ?>">Bar Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Bar Menu Category</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Edit Bar Menu Category</h3>
									</div>

									<div class="card-body">
										<form action="{{url('Bar/BarMenuCategoryUpdate', $data->id)}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="bar_id" value="{{ $data->bar_id }}">
											<div class="row">
												<?php if(empty(old('menu_type'))){$menu_type = $data->menu_type;}else{$menu_type = old('menu_type');} ?>
												<div class="col-md-4">
													<div class="form-group">
														<label class="form-label">Menu Type</label>
														<select name="menu_type" class="form-control">
															<option value="">Select Menu Type</option>
															<option value="food" <?php echo $menu_type=='food'?'selected':''; ?>>Food</option>
															<option value="drink" <?php echo $menu_type=='drink'?'selected':''; ?>>Drink</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('menu_type'); ?></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="form-label">Enter Menu Category</label>
														<input type="text" class="form-control" value="<?php echo empty(old('name'))?$data->name:old('name');?>" name="name" placeholder="Menu Category">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label class="form-label">Upload Image</label>
														<input type="file" class="form-control" name="image" placeholder="Upload Image">
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