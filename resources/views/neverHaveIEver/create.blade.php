
@extends("include.sidebar")

@section("content")

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Never Have I Ever Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('NeverHaveEver.index')}}">Never Have I Ever Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Never Have I Ever</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">

							<div class="col-md-12">

								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Add Never Have I Ever</h3>
									</div>

									<div class="card-body">
										<form action="{{ route('NeverHaveEver.store') }}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
												
												<div class="col-md-12">
													<div class="form-group">
														<label class="form-label">Enter Never Have I Ever</label>
														<input type="text" class="form-control" name="questions" value="{{old('questions')}}" placeholder="Enter Never Have I Ever">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('questions'); ?></span>
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
@endsection("content")
    