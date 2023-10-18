@extends('admin.layout.default')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Logbooks List</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="message">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <p>{{ $message }}</p>
        </div>
        @endif
      </section>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

            <div class="card">
              <div class="card-header">

                <h3 class="card-title">View all logbooks Information</h3>
                {{-- <a href="{{ route('logbooks.create') }}" class="btn btn-primary" style="float: right;"><i class="fas fa-plus"></i> Add New</a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example-logbook" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Date</th>
                    <th>RPA hours in time</th>
                    <th>Maintenance or defect rectification carried out</th>
                    <th>Battery ID</th>
                    <th>Battery Health</th>
                    <th>RPA Registration</th>
                    <th>RPA Type</th>
                    <th>Operation Height </th>
                    <th style="width: 150px;">Launch Point Location</th>
                    <th style="width: 150px;">Recovery Point Location</th>
                    <th>RPA serviceable</th>
                    <th>Note</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $i = 0;
                        @endphp
                        @foreach ($logbooks as $logbook)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $logbook->start_time }}</td>
                            <td>{{ gmdate("H:s:i",  $logbook->flyimgTime) }}</td>
                            <td>{{ $logbook->maintenanceOrDefect }}</td>
                            <td>{{ $logbook->Battery->batteries_id }}</td>
                            <td>{{ $logbook->battery_health }}</td>
                            <td>{{ $logbook->rpa_registration }}</td>
                            <td>{{ $logbook->RPA_type->rpa_model}}</td>
                            <td>{{ $logbook->operation_height }}</td>
                            <td>{{ $logbook->launch_point_location }}</td>
                            <td>{{ $logbook->recovery_point_location }}</td>
                            @if ($logbook->rpa_is_serviceable == '0')
                            <td>Yes</td>
                            @else
                            <td>No</td>
                             @endif
                            <td>{{ $logbook->note }}</td>
                            <td>
                                <form action="{{ route('logbooks.destroy',$logbook->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onClick="return confirm('Are you sure to delete this logbook ?')" class="btn btn-primary delete" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fas fa-trash"></i></button>

                                   {{-- <a href="{{ route('logbooks.show',$logbook->id) }}" class="btn btn-primary logbooks" data-toggle="tooltip" data-placement="left" title="view">
                                    <i class="fas fa-book"></i>
                                   </a> --}}
                                 <!--  <a href="#" class="btn btn-primary edit" data-toggle="tooltip" data-placement="left" title="Edit">
                                    <i class="fas fa-edit"></i>
                                   </a> -->

                                </form>
                            </td>
                        </tr>
                        @endforeach
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
         </div>
    </div>

@endsection
