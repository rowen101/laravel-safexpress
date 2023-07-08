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

                            {{ Breadcrumbs::render('createapps') }}

                </ol>
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->



    <form  method="PUT" action="{{ url('admin/apps/{{$data->id}}') }}">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">App Code</label>
            <input type="text" name="app_code" class="form-control" id="exampleInputEmail1" placeholder="App Code" value="{{$data->app_code}}" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Application Name</label>
            <input type="text" name="app_name" class="form-control" id="exampleInputPassword1" placeholder="Application Name" value="{{$data->app_name}}" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Description" value="{{$data->description}}" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
          </div>
          <div class="form-group mb-0">

            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="status" class="custom-control-input" id="exampleCheck1" aria-describedby="terms-error" aria-invalid="true">

              <label class="custom-control-label" name="status" value="1" for="exampleCheck1">Active</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Create</button>
        </div>
        <!-- /.card-body -->
      </form>

</div>
@endsection
