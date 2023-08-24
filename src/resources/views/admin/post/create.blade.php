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

                            {{ Breadcrumbs::render('createpost') }}

                </ol>
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="container-fluid">
        {{-- @if(count($posts) > 0)
        @foreach ($posts as $item)

            <div class="card mt-1">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                            <a href="posts/{{$item->id
                            }}">
                    <img style="width: 100%" src="/storage/cover_image/{{$item->cover_image}}"></a>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a href="posts/{{$item->id
                          }}">
                            <h3>{{$item->title}}</h3></a>
                              <small>Written on {{$item->created_at}} by {{$item->user->name}}</small>
                    </div>
                </div>


            </div>
        @endforeach
        {{$posts->links()}}
    @else
    <p>No Post</p>
    @endif --}}
    <section class="content">
        <div class="row">
          <div class="col-md-3">
            <a href="{{url('admin/post')}}" class="btn btn-primary btn-block mb-3"> <i class="fa fa-arrow-left"></i> Back to Post</a>

        @include('admin.post.partial.postfolder')

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary card-outline">
                <form method="POST" action="{{ url('admin/post') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
              <div class="card-header">
                <h3 class="card-title">Post</h3>
                <div class="card-tools">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Create Post</button>
                      </div>

                  </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="form-group">
                  <input class="form-control" name="title" placeholder="Your Post">
                </div>
                <div class="form-group">
                    
                    <label for="photo">Select a image:</label>
                    <input class="form-control" type="file" id="photo" name="photo">
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Categorie</label>
                    <select class="custom-select rounded-0"  name="app_id" id="app_id">
                        <option value="option_select" disabled>Categorie</option>
                        @foreach ($categorie as $item)
                             <option value="{{ $item->id}}">{{ $item->name}}</option>
                        @endforeach

                      </select>
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="body" class="form-control" style="height: 300px; display: none;">
                    </textarea>
                </div>
                {{-- <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div> --}}
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
