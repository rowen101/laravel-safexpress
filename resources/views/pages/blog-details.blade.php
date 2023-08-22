@extends('layouts.safexpress')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/about-header.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center">

            <h2>{{ $posts->title }}</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>{{ $posts->title }}</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Our Services Section ======= -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">



                        <article class="blog-details">




                            <div class="post-img">
                                <img src="{{asset('uploads')}}/{{$posts->photo}}" class="img-fluid" alt="{{$posts->photo}}">
                            </div>

                            <h2 class="title">{{ $posts->title }}</h2>

                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person">
                                        </i> {{ $user->name}}</li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                        <time datetime="2020-01-01">{{$posts->created_at}}</time></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots">
                                        </i>{{ $commentCount}}</li>

                                </ul>
                            </div><!-- End meta top -->

                            <div class="content">
                                {!! $posts->body !!}

                            </div><!-- End post content -->

                        </article><!-- End blog post -->



                        {{-- <div class="post-author d-flex align-items-center">
                        <img src="assets/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0" alt="">
                        <div>
                        <h4>Jane Smith</h4>
                        <div class="social-links">
                            <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                            <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                            <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                        </div>
                        <p>
                            Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                        </p>
                        </div>
                        </div> --}}
                        <!-- End post author -->

                        <div class="comments">

                            {{-- <h4 class="comments-count">{{$commentCount}} Comments</h4> --}}

                            @if (count($posts->comments) > 0)


                            @foreach ($posts->comments as $comment)
                            <div class="comment">
                                <div class="d-flex">
                                    <div class="comment-img">
                                        <img src="{{asset('uploads')}}/{{$comment->photo}}" class="img-fluid" alt="{{$comment->photo}}">
                                    </div>
                                    <div>
                                        <h5><a href="">{{$comment->name}}</a> <a href="#" class="reply"><i
                                                    class="bi bi-reply-fill"></i> Reply</a></h5>
                                        <time datetime="2020-01-01">{{$comment->created_at}}</time>
                                        <p>
                                           {{$comment->comment}}
                                        </p>
                                    </div>
                                </div>
                            </div><!-- End comment #1 -->
                            @endforeach
                            @else
                            <center>no comment</center>
                            @endif


                            <div class="reply-form">

                                <h4>Leave a Reply</h4>
                                <p>Your email address will not be published. Required fields are marked * </p>
                                <form action="{{url('/comment')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <input name="name" type="text" class="form-control"
                                                placeholder="Your Name*">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <input name="email" type="text" class="form-control"
                                                placeholder="Your Email*">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col form-group">
                                            <input name="website" type="text" class="form-control"
                                                placeholder="Your Website">
                                        </div>
                                    </div>
                                    <input type="hidden" name="posts_id" value="{{$posts->id}}">
                                    <div class="row">
                                        <div class="col form-group">
                                            <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>

                                </form>

                            </div>

                        </div><!-- End blog comments -->

                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">

                    <div class="sidebar ps-lg-4">

                        <div class="sidebar-item search-form">
                            <h3 class="sidebar-title">Search</h3>
                            <form action="" class="mt-3">
                                <input type="text">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->

                        {{-- <div class="sidebar-item categories">
                            <h3 class="sidebar-title">Categories</h3>
                            <ul class="mt-3">
                                @if (count($category) > 0)
                                    @foreach ($category as $item)
                                        <li><a href="#">{{ $item->name }} <span>(25)</span></a></li>
                                    @endforeach
                                @else
                                    <center>no category</center>
                                @endif

                            </ul>
                        </div><!-- End sidebar categories--> --}}

                        {{-- <div class="sidebar-item recent-posts">
                            <h3 class="sidebar-title">Recent Posts</h3>

                            <div class="mt-3">

                                <div class="post-item mt-3">
                                    <img src="assets/img/blog/blog-recent-1.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Nihil blanditiis at in nihil autem</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-2.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Quidem autem et impedit</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-3.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Id quia et et ut maxime similique occaecati ut</a>
                                        </h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-4.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Laborum corporis quo dara net para</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                                <div class="post-item">
                                    <img src="assets/img/blog/blog-recent-5.jpg" alt="" class="flex-shrink-0">
                                    <div>
                                        <h4><a href="blog-post.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                        <time datetime="2020-01-01">Jan 1, 2020</time>
                                    </div>
                                </div><!-- End recent post item-->

                            </div>

                        </div><!-- End sidebar recent posts--> --}}

                        <div class="sidebar-item tags">
                            <h3 class="sidebar-title">Tags</h3>
                            <ul class="mt-3">
                                <li><a href="#">Team</a></li>

                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End Blog Sidebar -->

                </div>
            </div>

        </div>
    </section><!-- End Blog Details Section -->


@endsection
