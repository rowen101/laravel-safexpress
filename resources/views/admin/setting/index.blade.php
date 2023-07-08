@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ $title }}
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">


          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>MenuCode</th>
                  <th>Menu Title</th>
                  <th>Description</th>
                  <th>Perent Id</th>
                  <th>Menu Icon</th>
                  <th>Menu Route</th>
                  <th>Sort</th>
                  <th>Active</th>
                </tr>
                </thead>
                <tbody>



                <tr >
                  <td>sfds</td>
                  <td>sfds</td>
                  <td>sfds</td>
                  <td>sfds</td>
                  <td>sfds</td>
                  <td>sfds</td>
                  <td>sfds</td>
                  <td>sfds</td>
                </tr>

                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>

</div><!--end container-->
</div>
@endsection
