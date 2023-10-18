@extends("include.sidebar")

@section("content")

    <div class="app-content  toggle-content">
        <div class="side-app">
            <div class="page-header">
                <h4 class="page-title">Bars Manager</h4>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">Bars Manager</li>
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
                                    <p class="card-text text-muted mb-1">Total Bars</p>
                                    <h1>{{count($bars)}}</h1>
                                </div>
                            </div>
                            <!-- <div class="card-footer p-0 pt-4">
                                <p class="text-muted mb-0 "><i class="si si-arrow-up-circle text-success mr-1" aria-hidden="true"></i> 12% this month</p>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-12 col-lg-6 col-xl-3">
                    <div class="card card-img-holder">
                        <div class="card-body list-icons pb-4">
                            <div class="clearfix">
                                <div class="float-left  mt-2">
                                    <span class="text-secondary">
                                        <i class="si si-people"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-muted mb-1">Total Users</p>
                                    <h1>4,678</h1>
                                </div>
                            </div>
                          <div class="card-footer p-0 pt-4">
                                <p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-danger mr-1" aria-hidden="true"></i>02% this month</p>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                                    <h1>{{$bars->totalRevenue}}</h1>
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
                                    <h1>{{$bars->todayRevenue}}</h1>
                                </div>
                            </div>
                            <!-- <div class="card-footer p-0 pt-4">
                                <p class="text-muted mb-0 "><i class="si si-arrow-down-circle text-warning mr-1" aria-hidden="true"></i>06% this month</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="card-title" style="float: left;">Bars</h3>
                    <h3 style="float: right;"><a class="btn btn-md btn-success" href="{{url('addBar')}}">Add</a></h3>
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

                                <th>Bar Name</th>
                                <th>Address</th>
                                <!--  <th>Latitude</th>
                                 <th>Longitude</th> -->
                                <th>Status</th>
                                <th>Image</th>
                                <th>PeopleIn</th>
                                <th>Open</th>
                                <th>Close</th>
                                <th>Total Revenue</th>
                                <th>Today Revenue</th>
                                <th>Created At</th>
                                <!-- <th>Updated At</th> -->
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($bars))
                                @foreach($bars as $bar)
                                    <tr>

                                        <td>{{$bar->name}}</td>
                                        <td>{{$bar->address}}</td>
                                        <!-- <td>123423</td>
                                        <td>12345</td> -->
                                        <td>

                                            @if($bar->status == 1)
                                                <a href="<?php echo url('Bar/barChangeStatus', $bar->bar_id); ?>"
                                                   class="mb-2 btn btn-sm btn-info">Active</a>
                                            @else
                                                <a href="<?php echo url('Bar/barChangeStatus', $bar->bar_id); ?>"
                                                   class="mb-2 btn btn-sm btn-danger">Suspended</a>
                                            @endif

                                        </td>
                                        <td>
{{--                                            @if(!empty($bar->cover_image))--}}
{{--                                                <img width="80px" height="80px" src="{{$bar->cover_image}}">--}}
{{--                                            @else--}}
{{--                                                <img width="80px" height="80px"--}}
{{--                                                     src="{{ url('img/bar-default-image.png') }}">--}}
{{--                                            @endif--}}
                                        </td>
                                        <td>{{$bar->people_in}}</td>
                                        <td>{{$bar->open_time}}</td>
                                        <td>{{$bar->close_time}}</td>
                                        <td>{{$bar->totalRevenue}}</td>
                                        <td>{{$bar->todayRevenue}}</td>
                                        <td>{{$bar->created_at}}</td>
                                        <!-- <td>2020-02-22 12:22:00</td> -->
                                        <td><a href="<?php echo url('Bar/barsDetails', $bar->bar_id); ?>"
                                               class="mb-2 btn btn-sm btn-info"><i class="fa fa-eye"></i></a><a
                                                    href="<?php echo url('Bar/editBar', $bar->bar_id); ?>"
                                                    class=" mb-2 btn btn-sm btn-warning"><i
                                                        class="fa fa-pencil-square-o"
                                                        aria-hidden="true"></i></a>&nbsp;<a
                                                    onclick="return confirm('Are you sure delete this data')"
                                                    href="<?php echo url('Bar/deleteBar', $bar->bar_id); ?>"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="9">Data not found</td>
                                </tr>
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

@endsection