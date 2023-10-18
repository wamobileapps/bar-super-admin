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
                <h3 class="text-center "><?php echo $details['name'] ?></h3>
                 <table style=" background: #F5F6F7;" width="100%" cellpadding="0" cellspacing="0">
         <tbody>
            <tr>
               <td>
       
                   <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                        <tbody>
                                                     
                                  <tr class="success">
                                  <td><?php echo $details['message'] ?></td>
                                </tr>
                     </tbody>
                  </table>
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
   
  </body>
</html>