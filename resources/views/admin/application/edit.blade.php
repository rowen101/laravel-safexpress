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




        <form method="POST" action="{{ url('admin/apps', $data->id) }}">
            {{ csrf_field() }}
            @method('PUT')

            <div class="card-body">
                <input type="hidden" name="status" value="0" />
                <div class="form-group">
                    <label for="exampleInputEmail1">App Code</label>
                    <input type="text" name="app_code" value="{{ $data->app_code }}" class="form-control"
                        id="exampleInputEmail1" placeholder="App Code" aria-describedby="exampleInputEmail1-error"
                        aria-invalid="true">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Application Name</label>
                    <input type="text" name="app_name" value="{{ $data->app_name }}"class="form-control"
                        id="exampleInputPassword1" placeholder="Application Name"
                        aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input type="text" name="description" value="{{ $data->description }}"class="form-control"
                        id="exampleInputPassword1" placeholder="Description" aria-describedby="exampleInputPassword1-error"
                        aria-invalid="true">
                </div>
                <div class="form-group mb-0">
                    <input type="hidden" name="status" value="0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="status" id="status" value="1"
                            {{ $data->status || old('status', 0) === 1 ? 'checked' : '' }}
                            class="custom-control-input" id="status" aria-describedby="terms-error"
                            aria-invalid="true" />

                        <label class="custom-control-label" name="status" value="1" for="status">Active</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Create</button>
            </div>
            <!-- /.card-body -->
        </form>

    </div>
@endsection
