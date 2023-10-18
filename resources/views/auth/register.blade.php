<!doctype html>
<html lang="en" dir="ltr">
<head>
        <!--Meta data-->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta content="" name="description">
        <meta content="" name="author">
        <meta name="keywords" content=""/>

        <!--Favicon -->
        <link rel="icon" href="{{ asset('assets/images/brand/favicon.ico') }}" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/brand/favicon.ico') }}" />

        <!-- Title -->
        <title>Barconnex</title>

        <!-- Dashboard css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

        <!-- C3 Charts css -->
        <link href="{{ asset('assets/plugins/charts-c3/c3-chart.css') }}" rel="stylesheet" />

        <!--  Table css -->
        <link href="{{ asset('assets/plugins/tables/style.css') }}" rel="stylesheet" />

        <!-- Custom scroll bar css-->
        <link href="{{ asset('assets/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />

        <!-- Sidemenu css -->
        <link href="{{ asset('assets/plugins/toggle-sidemenu/fullwidth/fullwidth-sidemenu.css') }}" rel="stylesheet" />

        <!---Font icons css-->
        <link  href="{{ asset('assets/fonts/fonts/font-awesome.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/web-fonts/plugin.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/web-fonts/icons.css') }}" rel="stylesheet" />

        
    </head>
    <body class="bg-account bg-primary">


        <div class="page">
            <div class="page-content">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-lg-4 d-block mx-auto">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-md-12">
                                    <div class="text-center mb-6">
                                        <h2 style="color: #fff">Barconnex</h2>
                                        <!-- <img src="<?php //xxecho url('/') ?>/{{ asset('public/admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}assets/images/brand/logo-light.png" class="" alt=""> -->
                                    </div>
                                    <div class="card">

                                        @if(Session::has('LoginError'))
                                            <div class="alert alert-danger">
                                                <div class="close" data-dismiss="alert">X</div>
                                                {{Session('LoginError')}}
                                            </div>
                                        @endif

                                        <form action="{{ route('register') }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="card-body">
                                                <h3>Register</h3>
                                                <p class="text-muted">Sign up for new account</p>

                                                <div class="input-group mb-2">
                                                    <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                                    
                                                    
                                                </div>
                                                <span class="text-danger text-left mb-3"  style="float: left;"><?php echo $errors->first('name'); ?></span>

                                                <div class="input-group mb-2">
                                                    <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                                    
                                                    
                                                </div>
                                                <span class="text-danger text-left mb-3"  style="float: left;"><?php echo $errors->first('email'); ?></span>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                                    <input type="password" class="form-control" name="password" placeholder="Password"><br>
                                                    
                                                    
                                                </div>
                                                <span class="text-danger text-left mb-3" style="float: left;"><?php echo $errors->first('password'); ?></span>
                                                 <div class="input-group mb-2">
                                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                                    <input type="password" class="form-control" name="password_confirmation" placeholder=" Confirm Password"><br>  
                                                </div>
                                                
                                                <div class="clearfix"></div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                                    </div>
                                                    <!-- <div class="col-12">
                                                        <a href="#" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                                                    </div> -->
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
    </body>
</html>
