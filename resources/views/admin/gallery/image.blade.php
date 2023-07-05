@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data->foldername}}</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        {{ Breadcrumbs::render('imagegallery') }}

                    </ol>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->


        <form method="POST" action="{{ url('admin/gallery/image', $data->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card">
                                <input type="hidden" name="parent_id" value="{{$data->id}}"/>
                                <input type="hidden" name="foldername" value="{{$data->foldername}}"/>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">


                                            <br />
                                            <h3 align="center" style="color: #4dc0b5"> Drop your image here</h3>
                                            <br />

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                                                        @csrf
                                                    </form>
                                                    <div align="center">
                                                        <button type="button" class="btn btn-success" id="submit-all">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Uploaded Image</h3>
                                                </div>
                                                <div class="panel-body" id="uploaded_image">

                                                </div>
                                            </div>



                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Save</button>
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
