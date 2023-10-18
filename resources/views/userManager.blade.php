@extends("include.sidebar")

@section("content")	
<style type="text/css">
	div#example_wrapper{
		overflow: auto;
	}
</style>				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Users Manager</h4>
							<ol class="breadcrumb">
								<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
								<li class="breadcrumb-item active" aria-current="page">Users</li>
							</ol>
						</div>

						<div class="row">
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-primary">
													<i class="si si si-docs"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Total Users</p>
												<h1>{{count($users)}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-up-circle text-success mr-1" aria-hidden="true"></i> 12% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							 
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-success">
													<i class="si si-compass"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Top Revenue Bars</p>
												<h1>{{$users->totalRevenue}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-up-circle text-success mr-1" aria-hidden="true"></i>24% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-danger">
													<i class="si si-shield"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Today Revenue</p>
												<h1>{{$users->todayRevenue}}</h1>
											</div>
										</div>
										<!-- <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-warning mr-1" aria-hidden="true"></i>06% this month</p>
										</div> -->
									</div>
								</div>
							</div>
							<!-- <div class="col-sm-12 col-lg-6 col-xl-3">
								<div class="card card-img-holder">
									<div class="card-body list-icons pb-4">
										<div class="clearfix">
											<div class="float-left  mt-2">
												<span class="text-danger">
													<i class="si si-shield"></i>
												</span>
											</div>
											<div class="float-right text-right">
												<p class="card-text text-muted mb-1">Today Revenue</p>
												<h1>2,567</h1>
											</div>
										</div>
										 <div class="card-footer p-0 pt-4">
											<p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-warning mr-1" aria-hidden="true"></i>06% this month</p>
										</div> 
									</div>
								</div>
							</div> -->
						</div>
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h3 class="card-title" style="float: left;">Users</h3>
								<h3 style="float: right;"><a  class="btn btn-md btn-success" href="{{url('addUser')}}">Add</a></h3>
							</div>
							<div class="card">
								<div class="col-sm-12 col-lg-12 col-xl-12">
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
									<table id="example" class="table display table-bordered" style="width:100%">
										        <thead>
										            <tr>
										                <th>S.No</th>
														<th><?php echo ucfirst('username'); ?></th>
														<th><?php echo ucfirst('full name'); ?></th>
														<th><?php echo ucfirst('email'); ?></th>
														<th><?php echo ucfirst('status'); ?></th>
														<th><?php echo ucfirst('dob'); ?></th>
														<th><?php echo ucfirst('ageRange'); ?></th>
														<th><?php echo ucfirst('gender'); ?></th>
														<th><?php echo ucfirst('relationshipStatus'); ?></th>
														<th><?php echo ucfirst('age'); ?></th>
														<th><?php echo ucfirst('profileImage'); ?></th>
														<th><?php echo ucfirst('favourite drink'); ?></th>
														<th><?php echo ucfirst('interests'); ?></th>
														<th><?php echo ucfirst('about'); ?></th>
														
														<th><?php echo ucfirst('rating'); ?></th>
														<th><?php echo ucfirst('moodAtBar'); ?></th>
														<th><?php echo ucfirst('orientation'); ?></th>
														<th><?php echo ucfirst('created at'); ?></th>
										                <th>Action</th>
										            </tr>
										        </thead>
										        <tbody>
													<?php $a = 1;  ?>
													@if(!empty($users))
													@foreach($users->all() as $user)
										            <tr>
										            	<td>{{$a}}</td> 
														<td>{{$user->username}}</td> 
														<td>{{$user->full_name}}</td> 
														<td>{{$user->email}}</td>
														<td>
															@if($user->status == 0)
															<a href="<?php echo url('User/userChangeStatus', $user->user_id); ?>" class="mb-2 btn btn-sm btn-info">Active</a>
															@else
															<a href="<?php echo url('User/userChangeStatus', $user->user_id); ?>" class="mb-2 btn btn-sm btn-danger">Suspended</a>
															@endif

														</td>

														<td>{{$user->dob}}</td> 
														<td>
															@if($user->ageRange == 1)
															+21-25
															@elseif($user->ageRange == 2)
															+26-31
															@elseif($user->ageRange == 3)
															+32-40
															@elseif($user->ageRange == 4)
															+41-55
															@elseif($user->ageRange == 5)
															+56-75
															@else
															+75-100
															@endif
														</td>  
														<td>
															@if($user->gender == 0)
															Male
															@elseif($user->gender == 1)
															Female
															@else
															Other
															@endif
														</td> 
														<td>
															@if($user->relationship_status == 1)
															Single
															@elseif($user->relationship_status == 2)
															Committed
															@elseif($user->relationship_status == 3)
															Merried
															@else
															Super Available														
															@endif
														</td> 
														<td>{{$user->age}}</td> 
														<td style="text-align:center;">



														@if(!empty($user->profileImage))
                                                           
																<img width="80px" height="80px" id="image{{$user->id}}" src="{{$user->profileImage}}">
																
                                                              <!-- <button type="button" id="add_back{{$user->id}}" class="mb-2 btn btn-sm btn-info add_back" data-id="{{$user->id}}" >Add Back</button> -->
                                                               <button type="button" id="remove{{$user->id}}" class="mb-2 btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal{{$user->id}}" >Edit Photo</button>
                                                             
                               @elseif($user->imageStatus=='1') 
                               
                               <img width="80px" height="80px" src="{{ url('img/user-icon.jpg') }}">
                               <button type="button" id="remove{{$user->id}}" class="mb-2 btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal{{$user->id}}" >Edit Photo</button>                                
  
															@else                                    
                                                            	<img width="80px" height="80px" src="{{ url('img/user-icon.jpg') }}">
                                              	
                              @endif
                                                             
														</td> 
														<td>{{$user->favourite_drink}}</td> 
														 
														<td>{{$user->interests}}</td> 
														<td>{{$user->about}}</td> 
														 
														
														<td>{{$user->rating}}</td> 
														<td>{{$user->mood_at_bar}}</td> 
														<td>{{$user->orientation}}</td> 
														 
														<td>{{$user->created_at}}</td>
										                <td><a href="<?php echo url('User/userDetails', $user->user_id); ?>" class="mb-2 btn btn-sm btn-info"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;<a href="<?php echo url('User/editUser', $user->user_id); ?>" class=" mb-2 btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;<a onclick="return confirm('Are you sure delete this data')" href="<?php echo url('User/deleteUser', $user->id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
										            </tr>


<div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!--  <form action="<?php echo url('User/removeImage', $user->id); ?>" method="post"> -->
        <input type="hidden" value="{{$user->id}}" >
         
				@if(!empty($user->profileImage))
                                                           
											<img width="80px" height="80px" src="{{$user->profileImage}}">
																
                     <!--   <button type="button" id="remove{{$user->id}}" class="mb-2 btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal{{$user->id}}" >Edit Photo</button>
                                        -->                         
                                                     
                                                              <!-- <button type="button" id="add_back{{$user->id}}" class="mb-2 btn btn-sm btn-info add_back" data-id="{{$user->id}}" >Add Back</button> -->
                                                             
                                                             
  
					@else 
					<img width="80px" height="80px" src="{{ url('img/user-icon.jpg') }}">
          @endif             

         <label id="text-label{{$user->id}}" style="display:none;">Why we are removing this photo</label>
         <textarea name="reason" id="reason{{$user->id}}" required style="display:none;"> </textarea>
        
         <button type="submit" class="mb-2 btn btn-sm btn-info RemoveAlert" id="remove{{$user->id}}" data-id="{{$user->id}}">Remove</button>

         <button type="submit" class="mb-2 btn btn-sm btn-info imageRemove" id="saveChange{{$user->id}}" data-id="{{$user->id}}" style="display:none;">Remove</button>

        <button type="button" id="add_back{{$user->id}}" class="mb-2 btn btn-sm btn-info add_back" data-id="{{$user->id}}" >Add Back</button>
       
       <!--  </form>	 -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close{{$user->id}}" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

													<?php $a++; ?>
													@endforeach
													@endif
										        </tbody>
										        
									</table>
								</div>
							</div>			
						</div> 

						<!-- <footer class="footer">
							<div class="container">
								<div class="row align-items-center flex-row-reverse">
									<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
										Copyright ©  <?php echo date('Y'); ?> <a href="#">Barconnex</a>. Designed by <a href="#">Canopus Info Systems</a> All rights reserved.
									</div>
								</div>
							</div>
						</footer> -->
					<!-- End Footer-->
					</div>
				</div>
		</div>
	</div>
@endsection("content")
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$('.default_image').hide();


 $(".RemoveAlert").click(function(){
    var user_id=$(this).attr('data-id');
   $('#text-label'+user_id).show();
   $('#reason'+user_id).show();
   $('#remove'+user_id).hide();
   $('#saveChange'+user_id).show();

});



  $(".imageRemove").click(function(){
    var user_id=$(this).attr('data-id');
  
    var reason =$('#reason'+user_id).val();
    console.log(reason);

$.ajax({
      url:'{{route('remove.image')}}',
      type:'POST',
      data:{
        "_token": "{{ csrf_token() }}",
          'user_id':user_id,'reason':reason,
      },
      success:function(response){
       
       console.log(response);
    if(response.status==200)
    {
     // $('#image'+user_id).attr('src','img/user-icon.jpg');
     // $('#remove'+user_id).attr('data-id',user_id);
     //  $('#remove'+user_id).attr('data-id',user_id);
     //  $('#remove'+user_id).addClass('add_back');
     //  $('#remove'+user_id).html('Add Back');
     //  $('#remove'+user_id).removeAttr('data-toggle');
     //  $('#remove'+user_id).removeAttr('data-target');
     //  $('#remove'+user_id).attr('id','add_back'+user_id);
     $('#close'+user_id).click();
     alert(response.message)

    }
    
}
  });
});
  $(".add_back").click(function(){
    var user_id=$(this).attr('data-id');
     $('#text-label'+user_id).hide();
     $('#reason'+user_id).hide();

$.ajax({
      url:'{{route('add.back.image')}}',
      type:'POST',
      data:{
        "_token": "{{ csrf_token() }}",
          'user_id':user_id,
      },
      success:function(response){
       
       console.log(response);
    if(response.status==200)
    {

     $('#image'+user_id).attr('src',response.user.profileImage);
      $('#imageModal'+user_id).attr('src',response.user.profileImage);
      
     // $('#default_image'+user_id).show();
     $('#close'+user_id).click();
     alert(response.message)
    }
    
}
  });
});
});



</script>