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

                        {{ Breadcrumbs::render('createmenu') }}

                    </ol>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->


        <form method="POST" action="{{ url('admin/menu') }}">
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

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Menu Code</label>
                                                <input type="text" class="form-control"  name="menu_code"
                                                    placeholder="Menu Code">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Application</label>
                                                <select class="custom-select rounded-0" name="app_id" id="app_id">
                                                    <option value="option_select" disabled>application</option>
                                                    @foreach ($app as $item)
                                                         <option value="{{ $item->id}}">{{ $item->app_name}}</option>
                                                    @endforeach

                                                  </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Menu Title</label>
                                                <input type="text" class="form-control" name="menu_title"
                                                    placeholder="Menu Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Description</label>
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Menu Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Parent Menu</label>
                                                <select class="custom-select rounded-0" name="parent_id" id="parent_id" >
                                                <option value="option_select" disabled>Menu</option>
                                                <option value="0" >&#xf0aa;</option>
                                                @foreach ($mparent as $item)
                                                     <option name="parent_id" value="{{ $item->id}}">{{ $item->menu_title}}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Menu Icon</label>
                                                <input type="text" class="form-control" name="menu_icon"
                                                    placeholder="Menu Icon">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Menu Route</label>
                                                <input type="text" class="form-control" name="menu_route"
                                                    placeholder="Menu Route">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Sort</label>
                                                <input type="number" class="form-control" name="sort_order"
                                                    placeholder="Sort">
                                            </div>

                                            <input type="hidden" name="is_active" value="0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="is_active" id="is_active" value="1"

                                                    class="custom-control-input" id="is_active" aria-describedby="terms-error"
                                                    aria-invalid="true" />

                                                <label class="custom-control-label" name="is_active" value="1" for="is_active">Active</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Create</button>
                                  </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </section>
        </form>
    </div>
@endsection
