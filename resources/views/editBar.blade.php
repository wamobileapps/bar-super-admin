@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Bar Manager</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('Bar.index')}}">Bar Manager</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Bar</li>
							</ol>
						</div>

						<div class="row clearfix"></div>
						<div class="row">
							
							<div class="col-md-12">
								<!-- <div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Default forms</h3>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" name="input" placeholder="Enter Your Name" value="Enter Your Name">
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="example-disabled-input" placeholder="Read Only Text area." value="Read Only Text area. " readonly="">
												</div>
												<div class="form-group">
													<input type="text" class="form-control" name="example-disabled-input" placeholder="Disabled text area.." value="" disabled="">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group has-success">
													<input type="text" class="form-control is-valid state-valid" name="example-text-input-valid" placeholder="Valid Email..">
												</div>
												<div class="form-group  has-danger">
													<input type="text" class="form-control is-invalid state-invalid" name="example-text-input-invalid" placeholder="Invalid feedback">
												</div>
												<div class="form-group">
													<input type="password" class="form-control" name="example-password-input" placeholder="Password..">
												</div>
											</div>
											<div class="col-md-12">
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write a large text here ..."></textarea>
											</div>
										</div>
									</div>
								</div> -->
								<div class="card">
									<div class="card-header">
										<h3 class="mb-0 card-title">Edit Bar</h3>
									</div>
									@if(Session::has('BarError'))
			                                <div class="alert alert-danger">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('BarError')}}
			                                </div>
			                        @endif

			                        @if(Session::has('BarSuccess'))
			                                <div class="alert alert-success">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('BarSuccess')}}
			                                </div>
			                        @endif

									<div class="card-body">
										<form action="{{url('Bar/barUpdate', $bar->bar_id)}}" method="post" enctype="multipart/form-data">
											<!-- <input type="hidden" name="_method" value="PUT"> -->
                                			<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Bar Name</label>
														<input type="text" class="form-control" name="name" placeholder="Bar Name" value="<?php echo empty(old('name'))?$bar->name:old('name');?>">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('name'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Email</label>
														<input type="email" class="form-control" name="email" value="<?php echo empty(old('email'))?$bar->email:old('email');?>" placeholder="Email">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('email'); ?></span>
													</div>
												</div>
												<!----<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter People In</label>
														<input type="number" class="form-control" value="<?php echo empty(old('people_in'))?$bar->people_in:old('people_in');?>" name="people_in" placeholder="People In">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('people_in'); ?></span>
													</div>
												</div>--->
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Password</label>
														<input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="password">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('password'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Address</label>
														<input type="text" class="form-control" value="<?php echo empty(old('address'))?$bar->address:old('address');?>" name="address" placeholder="Address">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('address'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Latitude</label>
														<input type="number" class="form-control" value="<?php echo empty(old('latitude'))?$bar->latitude:old('latitude');?>" name="latitude" placeholder="Latitude" step="0.000001">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('latitude'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Longitude</label>
														<input type="number" class="form-control" value="<?php echo empty(old('longitude'))?$bar->longitude:old('longitude');?>" name="longitude" placeholder="Longitude" step="0.000001">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('longitude'); ?></span>
													</div>
												</div>

											<!---<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Open Time</label>
														<input type="time" class="form-control" value="<?php echo empty(old('open_time'))?$bar->open_time:old('open_time');?>" name="open_time" placeholder="Open Time">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('open_time'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Close Time</label>
														<input type="time" class="form-control" value="<?php echo empty(old('close_time'))?$bar->close_time:old('close_time');?>" name="close_time" placeholder="Close Time">
														<span class="text-danger pull-left text-left mb-3"><?php echo $errors->first('close_time'); ?></span>
													</div>
												</div>--->
													<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Name</label>
														<input type="text" class="form-control" name="bank_account_name" value="<?php echo empty(old('bank_account_name'))?$bar->bank_account_name:old('bank_account_name');?>"  placeholder="Name of account Holder ">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('bank_account_name'); ?></span>
													</div>
												</div>
												
												<!---<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Account Number</label>
														<input type="text" class="form-control" name="account_number" value="<?php echo empty(old('account_number'))?$bar->account_number:old('account_number');?>" placeholder="Account Number">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('account_number'); ?></span>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="form-label">Enter Routing Number</label>
														<input type="text" class="form-control" name="routing_number" value="<?php echo empty(old('routing_number'))?$bar->routing_number:old('routing_number');?>" placeholder="Routing Number">
														<span class="text-danger text-left mb-3"><?php echo $errors->first('routing_number'); ?></span>
													</div>
												</div>--->



												<div class="col-md-6">
													<div class="card">
														<div class="card-header">
															<h3 class="mb-0 card-title">File Upload with Default Image</h3>
														</div>
														<div class="card-body">
															<input type="file" class="dropify" name="cover_image" data-default-file="<?php echo !empty($bar->cover_image)?$bar->cover_image:url('/').'/assets/images/photos/1.jpg'; ?>"  />
														</div>
													</div>
												</div>

												<div class="col-md-12">
													<div class="card">
														<div class="card-header">
															<h3 class="mb-0 card-title">Hours of Operation</h3>
														</div>
														<div class="card-body">
															<table  class="table display table-bordered" style="width:100%">
																<thead>
																<tr>
																	<th>Regular Day</th>
																	<th>Open</th>
																	<th>Close</th>
																	<th>Close next-day</th>
																	<th>Closed</th>
																</tr>
																</thead>
																<tbody>
																@foreach($data as $value)
																<tr>
                                                                <td>{{$value->day}}</td>
                                                                <td><input type="time" name="open_time" id="{{$value->day}}open_time" onchange="changetime('{{$value->day}}','open_time')" value="{{$value->open_time}}" {{$value->is_closed == 1 ? 'disabled' :''}}></td>
                                                                <td><input type="time" name="close_time" id="{{$value->day}}close_time" onchange="changetime('{{$value->day}}','close_time')" value="{{$value->close_time}}"  {{$value->is_closed == 1 ? 'disabled' :''}}></td>
                                                                <td><input type="checkbox" name="close_next_day" id="{{$value->day}}close_next_day"  onchange="changetime('{{$value->day}}','close_next_day','checked')"  id="{{$value->day}}close_time"  value="{{$value->is_closed}}" {{$value->close_next_day == 1 ? 'checked' :''}}></td>
                                                                <td><input type="checkbox" name="is_closed" id="{{$value->day}}is_closed" onchange="changetime('{{$value->day}}','is_closed','checked')" value="{{$value->is_closed}}" {{$value->is_closed == 1 ? 'checked' :''}}></td>

																</tr>
																@endforeach
																</tbody>

															</table>


														</div>
													</div>
												</div>
												<div class="col-md-6"></div>
												<div class="col-md-2 text-left">
													<div class="form-group">
														<input type="submit" class="form-control btn-success" name="submit" value="Update">
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
	<script>
		function changetime(day,param,checked){
			var openingHoursData = <?php echo json_encode($data); ?>;

			if (document.getElementById(day+param).checked) {
				document.getElementById(day+'open_time').disabled = true;
				document.getElementById(day+'close_time').disabled = true;

		}
		else{
				document.getElementById(day+'open_time').disabled = false;
				document.getElementById(day+'close_time').disabled = false;
		}

			var value = document.getElementById(day+param).value;
			console.log(value)

			var obj ={
				day:"",
				name:"",
				value:""
			}
			if(checked){
				obj ={
					day:day,
					name:param,
					value :document.getElementById(day+param).checked?1:0
				}
			}
			else{
				obj ={
					day:day,
					name:param,
					value :value
				}


			}
			console.log(obj)
			var a= openingHoursData
			for(let i=0;i<a.length;i++){
				if (obj.day==a[i].day){

					a[i][param]=obj.value
				}
				console.log(a)
			openingHoursData=a
				var objdata={
					data:openingHoursData,
					barid:<?php echo  $bar->bar_id?>
				}

			}

			$.ajax({
				url: '/api/update_time',
				method: 'POST',
				data: objdata,
				success: function(response) {
					// Handle the server response
				},
				error: function(jqXHR, textStatus, errorThrown) {
					// Handle any errors that occur
				}
			});
		}
	</script>
		@endsection("content")