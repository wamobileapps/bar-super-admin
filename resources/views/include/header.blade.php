<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<!--Meta data-->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="" name="description">
		<meta content="" name="author">
		<meta name="keywords" content=""/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!--Favicon -->
		<link rel="icon" href="<?php echo url('/') ?>/assets/images/brand/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href=/assets/images/brand/favicon.ico" />

		<!-- Title -->
		<title>Barconnex</title>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
		<!-- Dashboard css -->
		<link href="<?php echo url('/') ?>/assets/css/style.css" rel="stylesheet" />

		<!-- C3 Charts css -->
		<link href="<?php echo url('/') ?>/assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />

		<!--  Table css -->
		<link href="<?php echo url('/') ?>/assets/plugins/tables/style.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="<?php echo url('/') ?>/assets/plugins/jquery.mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!-- Sidemenu css -->
		<link href="<?php echo url('/') ?>/assets/plugins/toggle-sidemenu/fullwidth/fullwidth-sidemenu.css" rel="stylesheet" />

		<!---Font icons css-->
		<link  href="<?php echo url('/') ?>/assets/fonts/fonts/font-awesome.min.css" rel="stylesheet" />
		<link href="<?php echo url('/') ?>/assets/plugins/web-fonts/plugin.css" rel="stylesheet" />
		<link href="<?php echo url('/') ?>/assets/plugins/web-fonts/icons.css" rel="stylesheet" />
		<!-- Data table  -->
		
		<!-- Siderbar css-->
		<link href="<?php echo url('/') ?>/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- File Uploads css-->
        <link href="<?php echo url('/') ?>/assets/plugins/fileupload/css/fileupload.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
			#container {
    height: 400px; 
}

.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

		</style>
		
	</head>

	<body class="app sidebar-mini rtl">


		<!---Global-loader-->
		<div id="global-loader" >
			<img src="<?php echo url('/') ?>/assets/images/svgs/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">
				<div class="side-header">
					<div class="app-header header d-flex">
						<div class="container-fluid">
							<div class="d-flex">
								<a class="header-brand" href="{{url('dashboard')}}">
									<h2 style="color: #fff">Barconnex</h2>
									<!-- <img alt="logo" class="header-brand-img main-logo" src="<?php echo url('/') ?>/assets/images/brand/logo-light.png">
									<img alt="logo" class="header-brand-img mobile-logo" src="<?php echo url('/') ?>/assets/images/brand/icon-light.png"> -->
								</a>
								<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
								<a href="#" data-toggle="search" class="nav-link icon navsearch"><i class="typcn typcn-zoom-outline"></i></a>
								<div class="header-leftnav">
									<ul class="nav">
										<li class="header-searchinput">
											<form class="form-inline">
												<div class="search-element">
													<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
													<button class="btn btn-primary-color" type="submit"><i class="si si-magnifier"></i></button>
												</div>
											</form>
										</li>
									</ul>
								</div>
								<div class="d-flex order-lg-2 ml-auto header-rightnav">
									<ul class="nav">
										<li>
											<div class="header-full-screen">
												<a  class="nav-link icon full-screen-link" id="fullscreen-button">
													<i class="typcn typcn-arrow-maximise"></i>
												</a>
											</div>
										</li>
										<li>
											<div class="dropdown header-notify">
												<!-- <a class="nav-link icon" data-toggle="dropdown">
													<i class="typcn  typcn-bell"></i>
													<span class="nav-unread bg-warning"></span>
												</a> -->
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
													<div class="drop-heading">
														<div class="d-flex">
															<h5 class="mb-0 text-dark">Notifications</h5>
															<span class="badge badge-danger ml-auto">4</span>
														</div>
													</div>
													<div class="dropdown-divider mt-0"></div>
													<a href="#" class="dropdown-item d-flex pb-3">
														<div class="notifyimg">
															<i class="fa fa-thumbs-o-up"></i>
														</div>
														<div>
															<strong>Someone likes our posts.</strong>
															<div class="small text-muted">3 hours ago</div>
														</div>
													</a>
													<a href="#" class="dropdown-item d-flex pb-3">
														<div class="notifyimg bg-secondary">
															<i class="fa fa-commenting-o"></i>
														</div>
														<div>
															<strong> 3 New Comments</strong>
															<div class="small text-muted">5  hour ago</div>
														</div>
													</a>
													<a href="#" class="dropdown-item d-flex pb-3">
														<div class="notifyimg bg-danger">
															<i class="si si-user"></i>
														</div>
														<div>
															<strong> Adding new Customers</strong>
															<div class="small text-muted">1  hour ago</div>
														</div>
													</a>
													<div class="dropdown-divider"></div>
													<div class="text-center dropdown-btn  pb-3">
														<a href="#" class=" btn btn-primary ">
														View all Notification</a>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
