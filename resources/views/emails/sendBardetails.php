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
      .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

      </style>
      <!-- <link rel="icon" href="<?php //echo base_url('assets/image/favicon.ico'); ?>" type="" sizes="16x16"> -->
   </head>
   
       <body style="-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;margin:0;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;font-size:100%;line-height:1.6">
        New Bar Details
        <br>
      <table style=" background: #F5F6F7;" width="100%" cellpadding="0" cellspacing="0">
         <tbody>
            <tr>
               <td>
       
                   <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
   <tbody>
                                                     
                                  <tr class="success">
                                  <th>Name</th>
                                  <td><?php echo $details['name'] ?></td>
                                </tr>
                                <tr class="danger">
                                  <th>Location</th>
                                  <td><?php echo $details['location'] ?></td>
                                </tr>
                                <tr class="info">
                                  <th>Email</th>
                                  <td><?php echo $details['email'] ?></td>
                                </tr>
                                <tr class="warning">
                                  <th>Phone number</th>
                                  <td><?php echo $details['phone_number'] ?></td>
                                </tr>
                                <tr class="active">
                                  <th>Name of owner</th>
                                  <td><?php echo $details['name_of_owner'] ?></td>
                                </tr>
                                <tr class="primary">
                                  <th>Hours of opration</th>
                                  <td><?php echo $details['hours_of_opration'] ?></td>
                                </tr>

                     </tbody>
                  </table>
 
<p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E">Cheers,<br>
                                    The Bar Restaurant App Team
                                 </p>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <div class="footer" style="padding-top:30px;padding-bottom:55px;width:100%;text-align:center;clear:both !important">
                     <p style="font-weight:normal;padding:0;font-family:&quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;line-height:1.7;margin-bottom:1.3em;font-size:15px;color:#47505E;font-size:12px;color:#666;margin-top:0px">© <?php echo date('Y'); ?> Bar Restaurant App</p>
                  </div>
    </td>
            </tr>
         </tbody>
      </table> 
  </body>
</html>