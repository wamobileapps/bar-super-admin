
@extends("include.sidebar")

@section("content")	
				

				<div class="app-content  toggle-content">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Activities</h4>
							
						</div>

            <div class="page-header">
							<h6 class="page-title add-button-topright"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add</button></h6>
							
						</div>
						
						
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">

							</div>
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
								
											       
											           
	       <div class="card">
								<div class="card-body">
                  <div class="col-md-12 mb-5">
                  	  <div class="row">
 	<?php $a = 1; $games = $data->games; ?>
														@if(!empty($games))
														@foreach($games->all() as $game)
                  	  	 
                  	  	  <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                  	  	  	 <div class="show-card-fl">
                  	  	  	 	  <div class="img-block-show">
                  	  	  	 	  	<img src="{{$game->image}}" />
                  	  	  	 	  </div>
                  	  	  	 	  <h3>{{$game->name}}</h3>
                  	  	  	 	  <span class="btm-links-icon">
                  	  	  	 	  	<button><i class="fa fa-trash"><a onclick="return confirm('Are you sure delete this data')" href="<?php echo url('/deleteActivity', $game->id); ?>" >Delete</a></i></button>
                  	  	  	 	  	<button <button data-toggle="modal" data-target="#Modal{{$game->id}}"><i class="fa fa-edit"></i> Edit</button>
                  	  	  	 	  </span>
                  	  	  	 </div>
                  	  	  </div>


<div id="Modal{{$game->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     <!--  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div> -->
      <div class="modal-body">
      
      <form action="{{route('activity-update', $game->id)}}" method="post" enctype="multipart/form-data">

        <div class="modal-card-show-o">
        	<div class="show-card-fl">
            <div class="img-block-show">
            	 @if($game->image)
              <img src="{{$game->image}}" />
              @else                                    
		          <img src="{{ url('img/game-icon.jpg') }}" />
		          @endif
            </div>
              <h3 id="editname{{$game->id}}">{{$game->name}}</h3>
          </div>
        </div>

        <div class="modal-card-btm-cnt">
        	<span>
        			<input type="hidden" id="name" name="_token" value="{{ csrf_token() }}" />
	            <input type="text" name="name" value="{{$game->name}}" class="NameEdit" data-id="{{$game->id}}" placeholder="add name here" required>
        	</span>

          <span>
	            <input type="file" name="image" id="editimage" value="{{$game->image}}" placeholder="Upload Photo" > 
	        </span>
 
          <span>
	           <button type="submit" class="btn btn-default">Complete</button>
	        </span>
        </div>
        
     </form>
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>
											 <?php $a++; ?>

											@endforeach
														@endif

                   	  </div>
                  </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     <!--  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div> -->
      <div class="modal-body">
      
      <form action="{{route('activity-save')}}" method="post" enctype="multipart/form-data">

      	<div class="modal-card-show-o">
        	<div class="show-card-fl">
            <div class="img-block-show">
              <img id="uploadImage" src="" />
            </div>
              <h3 id="saveName">Name</h3>
          </div>
        </div>

        <div class="modal-card-btm-cnt">
        	<span>
        		  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <input type="text" id="savenames" name="name" placeholder="add name here" required>
        	</span>

        	<span>
        		  <input type="file" name="image" id="image" placeholder="Upload Photo" required>
        	</span>

        	<span>
        		  <button type="submit" class="btn btn-default">Complete</button>
        	</span>

      </div>
     </form>
      </div>
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('change', '#image', function() {
  
 // var image=$(this).val();

 var fileInput = document.getElementById('image');
 var image = fileInput.files[0];
 console.log(image);
 var formData = new FormData()
  formData.append('image', image,'myimage.jpeg')

$.ajax({
      type: "POST",
      url: "/saveImage",
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      data: formData
       
      ,
      success: function (result) {
         if (result['status'] == 'success') {

         	$('#UploadImage').attr('src',result['image']);


           

        }
         
      }
    });

});

$(document).on('change', '#savenames', function() {
  
  var name=$(this).val();
  console.log(name);
 $('#saveName').text(name);

});
$(document).on('change', '.NameEdit', function() {
  
  var id=$(this).attr('data-id');
 
  var nameval=$(this).val();
 $('#editname'+id).text(nameval);

});
</script>

@endsection("content")