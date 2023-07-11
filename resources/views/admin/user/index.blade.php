@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{ Breadcrumbs::render('user') }}
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="container-fluid">

            <div class="row">
          <div class="col-12">


            <div class="card">

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped small">
                  <thead>
                  <tr>
                    <td>No.</td>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $index =>$item)


                  <tr >
                    <td>{{$index+1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}
                    </td>
                    <td>{{$item->user_type}}</td>
                    <td> {{$item->first_name}}</td>
                    <td> {{$item->last_name}}</td>
                    <td><i class="{{$item->is_active  = 1 ? 'fas fa-check-circle ' : 'fas fa fa-circle'}}"></i></td>
                    <td><a href="/admin/user/{{$item->id}}/edit"><button type="button" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-edit"></i></button></a>&nbsp;
                        <button type="button" class="btn btn-sm bg-gradient-danger"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  @endforeach

                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div class="fab-container">

            <div class="button iconbutton">
             <a href="{{ url('admin/user/create')}}"><i class="fas fa-plus"></i></a>


            </div>

            </div>

    </div>

</div>

@endsection
