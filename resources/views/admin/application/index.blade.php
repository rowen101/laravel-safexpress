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

                            {{ Breadcrumbs::render('apps') }}

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
                <table id="datatable" class="table table-bordered table-striped small">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>AppCode</th>
                    <th>AppName</th>
                    <th>Discription</th>
                    <th>Status Message</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $index => $item)


                  <tr >
                    <td>{{ $index+1}}</td>
                    <td>{{$item->app_code}}</td>
                    <td>{{$item->app_name}}
                    </td>
                    <td>{{$item->description}}</td>
                    <td> {{$item->status_message}}</td>
                    <td><i class="{{$item->status   ? 'fas fa-check-circle ' : 'fas fa fa-circle'}}"></i></td>
                    {{-- <td><button type="button" class="btn btn-sm bg-gradient-secondary"><a href="/admin/apps/{{$item->id}}/edit"><i class="fas fa-edit"></i></a></button>&nbsp; --}}
                        <td>
                            <button type="button" class="btn btn-sm bg-gradient-secondary edit"><a href="/admin/apps/{{$item->id}}/edit"><i class="fas fa-edit"></i></a></button>&nbsp;
                        <button type="button" class="btn btn-sm bg-gradient-danger"><a href="{{url('admin/apps',[$item->id])}}"><i class="fas fa-trash"></i></a></button>
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

                <a href="{{ url('admin/apps/create')}}"><i class="fas fa-plus"></i></a>

            </div>

            </div>

    </div>
    <div class="modal fade" id="editModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add +</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="admin/app" method="POST" id="editForm">
                {{ csrf_field()}}
                {{ method_field('PUT')}}
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</div>

@endsection
