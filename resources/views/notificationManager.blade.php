
@extends("include.sidebar")

@section("content")				

				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Notification Manager</h4>
							<ol class="breadcrumb">
								<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
								<li class="breadcrumb-item active" aria-current="page">Notification Manager</li>
							</ol>
						</div>

						
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<h3 class="card-title" style="float: left;">Notification</h3>
								<h3 style="float: right;"><a  class="btn btn-md btn-success" href="{{route('Notification.create')}}">Send Notification</a></h3>
							</div>
							<div class="card">
								<div class="col-sm-12 col-lg-12 col-xl-12">
									@if(Session::has('Error'))
			                                <div class="alert alert-danger">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('Error')}}
			                                </div>
			                        @endif

			                        @if(Session::has('Success'))
			                                <div class="alert alert-success">
			                                    <div class="close" data-dismiss="alert">X</div>
			                                    {{Session('Success')}}
			                                </div>
			                        @endif
                                    <table id="example" class="table display table-bordered" style="width:100%">
										        <thead>
										            <tr>
										                
										                <th>S. No.</th>
										                <th>Notification</th>
										                <th>Action</th>
										                
										            </tr>
										        </thead>
                                                <tbody>
													@php
														$i = 1;
													@endphp
													@foreach ($notifications as $item)
														<tr>
															<td>{{$i++}}</td>	
															<td>{{$item->notification}}</td>	
															<td><a class="delete_resource btn btn-sm btn-danger" onclick="$('#deleteForm-{{$item->id}}').submit();"><i class="fa fa-trash"></i></a>
																<form method="POST" id="deleteForm-{{$item->id}}" action="{{route('Notification.destroy', $item->id)}}" style="display: none;">
																	{{ method_field('DELETE') }}
																	{{ csrf_field() }}
																</form>
															</td>
														</tr>	
													@endforeach
                                                <tbody>
										        
										        
									</table>
									
								</div>
							</div>			
						</div> 

					<!-- 	<footer class="footer">
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
<script>
function formSubmit(id){
	event.preventDefault();
	if ( confirm("Are you sure you wish to delete?") == false ) {
		return false ;
	} else {
		document.getElementById('delete-form-'+id).submit();
	}
	 
}
</script>
@endsection("content")