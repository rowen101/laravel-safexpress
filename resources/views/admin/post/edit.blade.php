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

                            {{ Breadcrumbs::render('editpost') }}

                </ol>
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="container-fluid">

    <section class="content">
        <div class="row">
          <div class="col-md-3">
            <a href="{{url('admin/post')}}" class="btn btn-primary btn-block mb-3"> <i class="fa fa-arrow-left"></i> Back to Post</a>

            @include('admin.post.partial.postfolder')

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
                <form method="POST" action="{{ url('admin/post', $post->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')
              <div class="card-header">
                <h3 class="card-title">Post</h3>
                <div class="card-tools">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit Post</button>&nbsp; <a href="/admin/post/{{$post->id}}" id="trash" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                      </div>

                  </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                  <input class="form-control" name="title" value="{{$post->title}}" placeholder="Your Post">
                </div>
                <div class="form-group">

                    <label for="photo">Select a image:</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Categorie</label>
                    <select class="custom-select rounded-0"  name="category_id" id="category_id">
                        <option value="option_select" disabled>Categorie</option>
                        @foreach ($categorie as $item)
                             <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach

                      </select>
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="body"  class="form-control" style="height: 300px; display: none;">
{{$post->body}}
                    </textarea>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer p-0">
                <div class="mailbox-controls">
                  <!-- Check all button -->
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                    <i class="far fa-square"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="far fa-trash-alt"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-reply"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm">
                      <i class="fas fa-share"></i>
                    </button>
                  </div>
                  <!-- /.btn-group -->
                  <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <div class="float-right">
                    1-50/200
                    <div class="btn-group">
                      <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-chevron-left"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-chevron-right"></i>
                      </button>
                    </div>
                    <!-- /.btn-group -->
                  </div>
                  <!-- /.float-right -->
                </div>
              </div>
                </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    </div>
</div>
@push('head')
 <!-- summernote -->
 <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
@endpush
@push('buttom')
<!-- Summernote -->
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Add text editor
    $('#compose-textarea').summernote()
  })


</script>
@endpush
@endsection
