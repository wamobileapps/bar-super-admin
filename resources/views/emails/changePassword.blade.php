<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <title>Bar Restaurant App</title>
      <style type="text/css">
        body{
      background: #CED4DA;
      }
      .form-row {
      display: -ms-flexbox;
      display: flex;    
      place-content: center;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
      margin-top: 10%;
      }
      div#Sucesss_msg {
      box-shadow: 0px 0px 13px 0px;            
      padding: 20px;
      background: white;
      }
      .alert.alert-danger.alert-dismissible.bg-success.text-light {
      padding: 15px;
      }
      .error{
      color: red;
      }
      </style>
      <!-- <link rel="icon" href="<?php //echo base_url('assets/image/favicon.ico'); ?>" type="" sizes="16x16"> -->
   </head>
   <body>
      <div class="container">
        <div class="row form-row">
        <div class="col-md-6 col-lg-4 col-sm-12 col-md-offset-6 col-lg-offset-4">
          <div class="login-logo">
            <!-- <img style="height: 10%;width:100%;" src="<?php //echo base_url('assets/image/lumwear_logo01.png');?>">   -->  
          </div>
          <div id="Sucesss_msg">
            <div class="panel panel-default text-secondary">
              <div class="panel-body" >
                <h3 class="text-center ">Reset Password</h3>
                <p class="text-center">You can reset your password here.</p>
                <?php print_r($response); ?>
                  <form role="form" autocomplete="off"  method="post" action="<?php echo url('/updatePassword'); ?>" id="resetPassword">
                    <input type="hidden" name="forgetpassword_link" value="<?php echo $forgetpassword_link ?>">
                   <!--  <input type="hidden" name="_method" value="PUT"> -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <!-- <label for="new_password">New Password</label> -->
                        <input type="password" name="new_password" class="form-control {{ $errors->has('new_password') ? ' is-invalid' : '' }}" placeholder="Enter New Password" value="" id="new_password">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <!-- <label for="confirm_password">Confirm Password</label> -->
                        <input type="password" name="confirm_password" class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" placeholder="Enter Confirm Password" value="">
                        <span class="text-danger"></span>
                    </div>
					<div class="form-group">
						<input type="submit" class="btn  btn-block" value="Reset Password" style="background-color: #3271A4; color: #fff;">
					</div>                      
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <?php 
       
        if (!empty($success))
        { ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#Sucesss_msg').html("");
        $('#Sucesss_msg').html('<div class="panel panel-default text-secondary"><div class="panel-body" ><h3 class="text-center">Reset Password</h3><p class="text-center">You can reset your password here.</p><div class="alert alert-danger alert-dismissible bg-success text-light " ><?= $success; ?></div></div></div>');
        $('#response_msg').removeClass("d-none");
      });
    </script>
    <?php }
      ?>
    <?php 
      
        if (!empty($response)) 
        { ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#Sucesss_msg').html("");
        $('#Sucesss_msg').html('<div class="panel panel-default text-secondary"><div class="panel-body" ><h3 class="text-center">Reset Password</h3><p class="text-center">You can reset your password here.</p><div class="alert alert-danger alert-dismissible bg-danger text-center font-weight-bold text-light " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $response; ?></div></div></div>');
        $('#response_msg').removeClass("d-none");
      });
    </script>
    <?php }
      ?>
    <script type="text/javascript">
      $( "#resetPassword" ).validate({  
      rules: {
        new_password : {
           required : {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
            },
            minlength:6
        },
        confirm_password : {
           required : {
                          depends:function(){
                              $(this).val($.trim($(this).val()));
                              return true;
                          }
          
        },
        equalTo:"#new_password"
      }
      },
      messages : {
        new_password :
        {
          required: "Please enter password.",
          minlength:"Password length should be 6 digits."
        },
        confirm_password:
        {
          required: "Please enter confirm password.",
          equalTo: "Confirm password does not match."
        }
      }
      });
    </script>    
  </body>
</html>