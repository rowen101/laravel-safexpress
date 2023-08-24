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

                        {{ Breadcrumbs::render('creategallery') }}

                    </ol>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->


        <form method="POST" action="{{ url('admin/gallery/sub-gallery', $gallery->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
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
                                                <input type="hidden" value="{{$gallery->id}}"/>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Folder Name</label>
                                                <input type="text" class="form-control"  name="filename"
                                                    placeholder="Filename">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Upload image</label>
                                                <div class="input-group">
                                                  {{-- <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="cover_image" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                  </div> --}}
                                                  <input type="file" name="image">
                                                </div>
                                              </div>
                                              {{-- <div class="form-group">
                                                <label for="exampleInputPassword1">Cover Image</label>
                                                <input type="text" class="form-control"  name="cover_image"
                                                    placeholder="Cover Image">
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="exampleInputPassword1">ID</label>
                                                <input type="text" class="form-control"  name="parent_id"
                                                    placeholder="parent_id">
                                            </div> --}}

                                        </div>
                                        <div class="col-md-6">
                                            {{-- <div class="form-group">
                                                <label for="exampleInputPassword1">File name</label>
                                                <input type="text" class="form-control"  name="filename"
                                                    placeholder="filename">
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="exampleInputPassword1">image</label>
                                                <input type="text" class="form-control"  name="image"
                                                    placeholder="image">
                                            </div> --}}

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
