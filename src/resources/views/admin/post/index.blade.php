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

                        {{ Breadcrumbs::render('post') }}

                    </ol>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid">
            {{-- @if (count($posts) > 0)
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
                        <a href="{{ url('admin/post/create') }}" class="btn btn-primary btn-block mb-3">Compose Post</a>

                        @include('admin.post.partial.postfolder')

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Post</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" placeholder="Search Mail">
                                        <div class="input-group-append">
                                            <div class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i
                                            class="far fa-square"></i>
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
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            @if (count($posts) > 0)
                                                @foreach ($posts as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="icheck-primary">
                                                                <input type="checkbox" value="" id="check1">
                                                                <label for="check1"></label>
                                                            </div>
                                                        </td>

                                                        <td class="mailbox-name">{{ $item->title }}</td>

                                                        {{-- <td class="mailbox-attachment"><i class="fas fa-paperclip"></i></td> --}}
                                                        <td class="mailbox-date">{{$item->created_at}}</td>
                                                        <td class="mailbox-date">
                                                            <form action={{ url('admin/post-publish', $item->id) }} method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                    <button type="submit" class="btn btn-sm {{$item->is_publish = 1 ? 'btn-success' : 'btn-danger'}}">

                                                                <i
                                                                class="{{$item->is_publish = 1 ? 'fas fa-eye' : 'fas fa-eye-slash'}}"></i></button>
                                                                &nbsp;<a href="/admin/post/{{$item->id}}/edit"><button type="button" class="btn btn-sm btn-primary"><i
                                                                    class="fas fa-edit"></i></button></a></td>
                                                            </form>


                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <p class="text-center">No Data..</p>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
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
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
        </div>
    </div>

@endsection
