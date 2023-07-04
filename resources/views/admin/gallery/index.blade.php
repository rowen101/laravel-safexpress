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

                        {{ Breadcrumbs::render('gallery') }}

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
                            <table id="example1" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <th>Folder Name</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gallery as $index => $item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{ $item->foldername }}</td>

                                            <td><i
                                                    class="{{ $item->is_active = 1 ? 'fas fa-check-circle ' : 'fas fa fa-circle' }}"></i>
                                            </td>
                                            <td><button type="button" class="btn btn-sm bg-gradient-secondary"><a href="/admin/gallery/{{$item->id}}/edit"><i
                                                        class="fas fa-edit"></i></a></button>&nbsp;
                                                <button type="button" class="btn btn-sm bg-gradient-danger"><i
                                                        class="fas fa-trash"></i></button>&nbsp;
                                                        <button type="button" class="btn btn-sm bg-gradient-success"><a href="/admin/gallery/{{$item->id}}/image"><i class="fas fa-file-image"></i> </a></button>
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

                <a href="{{ url('admin/gallery/create')}}"><i class="fas fa-plus"></i></a>

            </div>

        </div>
    </div>
@endsection
