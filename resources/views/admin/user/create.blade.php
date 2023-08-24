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
                    {{ Breadcrumbs::render('createuser') }}
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->



    <form  method="POST" action="{{ url('admin/user') }}">
        {{ csrf_field() }}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label for="exampleInputEmail1" class="control-label">User Name</label>
                                            <input type="text"  class="form-control" name="name" id="exampleInputEmail1" placeholder="User Name" aria-describedby="exampleInputEmail1-error" aria-invalid="true">
                                          </div>
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">First Name</label>
                                            <input type="text"  class="form-control" name="first_name"    placeholder="First Name" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                          </div>
                                          <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Last Name</label>
                                            <input type="text" class="form-control" name="last_name"    placeholder="Last Name" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                          </div>


                                          <div class="form-group required">
                                            <label for="exampleInputEmail1" class="control-label">Role</label>
                                            <select class="custom-select rounded-0" name="role_id" id="role_id">
                                                <option value="option_select" disabled>Role</option>
                                                @foreach ($role as $item)
                                                     <option value="{{ $item->id}}">{{ $item->role_code}}</option>
                                                @endforeach

                                              </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">User Type</label>
                                            <input type="text"class="form-control" name="user_type"    placeholder="User type" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                          </div>
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Email</label>
                                            <input type="text"class="form-control" name="email"    placeholder="Email" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                          </div>
                                          <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Password</label>
                                            <input type="password"  class="form-control" name="password"    placeholder="Password" aria-describedby="exampleInputPassword1-error" aria-invalid="true">
                                          </div>

                                          <div class="form-group mb-0">

                                            <div class="custom-control custom-checkbox">
                                              <input type="checkbox" name="is_status" class="custom-control-input" id="exampleCheck1" aria-describedby="terms-error" aria-invalid="true">
                                              <label class="custom-control-label" name="is_status" value="1" for="exampleCheck1">Active</label>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






      </form>

</div>

@endsection
