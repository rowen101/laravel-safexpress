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




    <form  method="POST" action="{{ url('admin/apps') }}">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group required">
            <label for="exampleInputEmail1" class="control-label">App Code</label>
            <input type="text" name="app_code" class="form-control" id="exampleInputEmail1" placeholder="App Code" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
          </div>
          <div class="form-group required">
            <label for="exampleInputPassword1" class="control-label">Application Name</label>
            <input type="text" name="app_name" class="form-control" id="exampleInputPassword1" placeholder="Application Name" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
          </div>
          <div class="form-group required">
            <label for="exampleInputPassword1" class="control-label">Description</label>
            <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Description" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
          </div>
          <div class="form-group mb-0">

            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="status" class="custom-control-input" id="exampleCheck1" aria-describedby="terms-error" aria-invalid="true">
              <label class="custom-control-label" name="is_active" value="1" for="exampleCheck1">Active</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Create</button>
        </div>
        <!-- /.card-body -->
      </form>

</div>
@endsection
