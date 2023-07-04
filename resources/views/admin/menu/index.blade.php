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

                        {{ Breadcrumbs::render('menu') }}

                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <div class="container-flueid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped small">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <th>App</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Parent</th>
                                        <th>Icon</th>
                                        <th>Route</th>
                                        <th>Sort</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $index =>$item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{ $item->app_name }}</td>
                                            <td>{{ $item->menu_code }}</td>
                                            <td>{{ $item->menu_title }}
                                            </td>
                                            <td>{{ $item->description }}</td>
                                            <td> {{ $item->parent_id }}</td>
                                            <td><i class="{{ $item->menu_icon }}"></i></td>
                                            <td>{{ $item->menu_route }}</td>
                                            <td>{{ $item->sort_order }}</td>
                                            <td><i
                                                    class="{{ $item->is_active = 1 ? 'fas fa-check-circle ' : 'fas fa fa-circle' }}"></i>
                                            </td>

                                            <td><button type="button" class="btn btn-sm bg-gradient-secondary"><a href="/admin/menu/{{$item->id}}/edit"><i
                                                        class="fas fa-edit"></i></a></button>&nbsp;
                                                <button type="button" class="btn btn-sm bg-gradient-danger"><i
                                                        class="fas fa-trash"></i></button>
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
        </div>

        <div class="fab-container">

            <div class="button iconbutton">

                <a href="{{ url('admin/menu/create')}}"><i class="fas fa-plus"></i></a>

            </div>

        </div>
    </div>
@endsection
