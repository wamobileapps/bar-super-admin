
@extends("include.sidebar")

@section("content")

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Question Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add Questions</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">

							<div class="col-md-12">

								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Add Questions</h3>
									</div>

									<div class="card-body">
										<form action="{{ route('question.store') }}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
												
												<div class="col-md-12">
													<div class="form-group">
														<label class="form-label">Enter Questionnaire Title</label>
														<input type="text" class="form-control" name="questionnaire_title" value="{{old('questionnaire_title')}}" placeholder="Questionnaire Title">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('questionnaire_title'); ?></span>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="form-label">Enter First Question</label>
														<input type="text" class="form-control" name="first_question" value="{{old('first_question')}}" placeholder="First Question">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('first_question'); ?></span>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="form-label">Enter second Question</label>
														<input type="text" class="form-control" name="sec_question" value="{{old('sec_question')}}" placeholder="second Question">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('sec_question'); ?></span>
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
    