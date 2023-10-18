@extends("include.sidebar")

@section("content")	

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">User Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('User.index')}}">User Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit User</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Edit User</h3>
									</div>

									<div class="card-body">
										<form action="{{url('User/userUpdate', $user->user_id)}}" method="post" enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
												<!-- <div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter userName</label>
														<input type="text" class="form-control" name="username" value="<?php //echo empty(old('username'))?$user->username:old('username');?>" placeholder="Username">
														<span class="text-danger pull-left text-left mb-3"><?php //echo $errors->first('username'); ?></span>
													</div>
												</div> -->
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Full Name</label>
														<input type="text" class="form-control" name="full_name" value="<?php echo empty(old('full_name'))?$user->full_name:old('full_name');?>" placeholder="Full Name">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('full_name'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Email</label>
														<input type="email" class="form-control" name="email" value="<?php echo empty(old('email'))?$user->email:old('email');?>" placeholder="Email">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('email'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter DOB</label>
														<input type="date" class="form-control" name="dob" value="<?php echo empty(old('dob'))?$user->dob:old('dob');?>" placeholder="DOB">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('dob'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Age Range</label>
														<?php if(empty(old('ageRange'))){$ageRange = $user->ageRange;}else{$ageRange = old('ageRange');} ?>
														<select name="ageRange" class="form-control">
															<option value="">Select Age Range</option>
															<option value="1" <?php echo $ageRange==1?'selected':''; ?>>+21-25</option>
															<option value="2" <?php echo $ageRange==2?'selected':''; ?>>+26-31</option>
															<option value="3" <?php echo $ageRange==3?'selected':''; ?>>+32-40</option>
															<option value="4" <?php echo $ageRange==4?'selected':''; ?>>+41-55</option>
															<option value="5" <?php echo $ageRange==5?'selected':''; ?>>+56-75</option>
															<option value="6" <?php echo $ageRange==6?'selected':''; ?>>+75-100</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('ageRange'); ?></span>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Gender</label>
														<?php if(empty(old('gender'))){$gender = $user->gender;}else{$gender = old('gender');} ?>
														<select name="gender" class="form-control">
															<option value="0" <?php echo $gender==0?'selected':''; ?>>Female</option>
															<option value="1" <?php echo $gender==1?'selected':''; ?>>Male</option>
															<option value="2" <?php echo $gender==2?'selected':''; ?>>Other</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('gender'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Relationship Status</label>
														<?php if(empty(old('relationship_status'))){$relationship_status = $user->relationship_status;}else{$relationship_status = old('relationship_status');} ?>
														<select name="relationship_status" class="form-control">
															<option value="">Select Relationship Status</option>
															<option value="1" <?php echo $relationship_status==1?'selected':''; ?>>Single</option>
															<option value="2" <?php echo $relationship_status==2?'selected':''; ?>>Committed</option>
															<option value="3" <?php echo $relationship_status==3?'selected':''; ?>>Merried</option>
															<option value="4" <?php echo $relationship_status==4?'selected':''; ?>>Super Available</option>
														</select>
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('gender'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Age</label>
														<input type="number" class="form-control" name="age" value="<?php echo empty(old('age'))?$user->age:old('age');?>" placeholder="Age">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('age'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Favourite Drink</label>
														<input type="text" class="form-control" name="favourite_drink" value="<?php echo empty(old('favourite_drink'))?$user->favourite_drink:old('favourite_drink');?>" placeholder="Favourite Drink">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('favourite_drink'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Interests</label>
														<input type="text" class="form-control" name="interests" value="<?php echo empty(old('interests'))?$user->interests:old('interests');?>" placeholder="Interests">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('interests'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter About</label>
														<input type="text" class="form-control" name="about" value="<?php echo empty(old('about'))?$user->about:old('about');?>" placeholder="About">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('about'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Rating</label>
														<input type="number" class="form-control" name="rating" value="<?php echo empty(old('rating'))?$user->rating:old('rating');?>" placeholder="Rating">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('rating'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Mood At Bar</label>
														<input type="text" class="form-control" name="mood_at_bar" value="<?php echo empty(old('mood_at_bar'))?$user->mood_at_bar:old('mood_at_bar');?>" placeholder="Mood At Bar">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('mood_at_bar'); ?></span>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Orientation</label>
														<input type="text" class="form-control" name="orientation" value="<?php echo empty(old('orientation'))?$user->orientation:old('orientation');?>" placeholder="Orientation">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('orientation'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Profile Completed</label>
														<input type="number" class="form-control" name="profile_completed" value="<?php echo empty(old('profile_completed'))?$user->profile_completed:old('profile_completed');?>" placeholder="Profile Completed">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('profile_completed'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="card">
														<div class="card-header">
															<h3 class="mb-0 card-title">File Upload with Default Image</h3>
														</div>
														<div class="card-body">
															<input type="file" class="dropify" name="profileImage" data-default-file="<?php echo !empty($user->profileImage)?$user->profileImage:url('/').'/assets/images/photos/1.jpg'; ?>"/>
															<span class="text-danger text-left mb-3"><?php echo $errors->first('profileImage'); ?></span>
														</div>
													</div>
												</div>
												<div class="col-md-6"></div>
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
		
		@endsection("content")
<!-- Back to top -->
	