@extends("include.sidebar")

@section("content")	

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">User Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('User.index')}}">User Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Add User</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Add User</h3>
									</div>

									<div class="card-body">
										<form action="{{url('userSave')}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
												<!-- <div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter userName</label>
														<input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="Username">
														<span class="text-danger pull-left text-left mb-3"><?php //echo $errors->first('username'); ?></span>
													</div>
												</div> -->
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Full Name</label>
														<input type="text" class="form-control" name="full_name" value="{{old('full_name')}}" placeholder="Full Name">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('full_name'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Email</label>
														<input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('email'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter DOB</label>
														<input type="date" class="form-control" name="dob" value="{{old('dob')}}" placeholder="DOB">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('dob'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Age Range</label>
														<select name="ageRange" class="form-control">
															<option value="">Select Age Range</option>
															<option value="1" <?php echo old('ageRange')==1?'selected':''; ?>>+21-25</option>
															<option value="2" <?php echo old('ageRange')==2?'selected':''; ?>>+26-31</option>
															<option value="3" <?php echo old('ageRange')==3?'selected':''; ?>>+32-40</option>
															<option value="4" <?php echo old('ageRange')==4?'selected':''; ?>>+41-55</option>
															<option value="5" <?php echo old('ageRange')==5?'selected':''; ?>>+56-75</option>
															<option value="6" <?php echo old('ageRange')==6?'selected':''; ?>>+75-100</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('ageRange'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Password</label>
														<input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('password'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Gender</label>
														<select name="gender" class="form-control">
															<option value="0" <?php echo old('gender')==0?'selected':''; ?>>Female</option>
															<option value="1" <?php echo old('gender')==1?'selected':''; ?>>Male</option>
															<option value="2" <?php echo old('gender')==2?'selected':''; ?>>Other</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('gender'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Relationship Status</label>
														<select name="relationship_status" class="form-control">
															<option value="">Select Relationship Status</option>
															<option value="1" <?php echo old('relationship_status')==1?'selected':''; ?>>Single</option>
															<option value="2" <?php echo old('relationship_status')==2?'selected':''; ?>>Committed</option>
															<option value="3" <?php echo old('relationship_status')==3?'selected':''; ?>>Merried</option>
															<option value="4" <?php echo old('relationship_status')==4?'selected':''; ?>>Super Available</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('gender'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Age</label>
														<input type="number" class="form-control" name="age" value="{{old('age')}}" placeholder="Age">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('age'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Favourite Drink</label>
														<input type="text" class="form-control" name="favourite_drink" value="{{old('favourite_drink')}}" placeholder="Favourite Drink">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('favourite_drink'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Interests</label>
														<input type="text" class="form-control" name="interests" value="{{old('interests')}}" placeholder="Interests">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('interests'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter About</label>
														<input type="text" class="form-control" name="about" value="{{old('about')}}" placeholder="About">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('about'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Rating</label>
														<input type="number" class="form-control" name="rating" value="{{old('rating')}}" placeholder="Rating">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('rating'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Mood At Bar</label>
														<input type="text" class="form-control" name="mood_at_bar" value="{{old('mood_at_bar')}}" placeholder="Mood At Bar">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('mood_at_bar'); ?></span>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Orientation</label>
														<input type="text" class="form-control" name="orientation" value="{{old('orientation')}}" placeholder="Orientation">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('orientation'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Profile Completed</label>
														<input type="number" class="form-control" name="profile_completed" value="{{old('profile_completed')}}" placeholder="Profile Completed">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('profile_completed'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card">
														<div class="card-header">
															<h3 class="mb-0 card-title">File Upload with Default Image</h3>
														</div>
														<div class="card-body">
															<input type="file" class="dropify" name="profileImage" data-default-file="<?php echo url('/'); ?>/assets/images/photos/1.jpg"  />
															<span class="text-danger text-left mb-3"><?php echo $errors->first('profileImage'); ?></span>
														</div>
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
		@endsection("content")