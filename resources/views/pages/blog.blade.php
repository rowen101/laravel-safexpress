@extends('layouts.safexpress')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center);" style="background-image: url('img/about-header.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center">

            <h2>{{ $title }}</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>{{ $title }}</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Our Services Section ======= -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200" >
                    <div class="row gy-5 posts-list">
                        @if (count($posts) > 0)
                        @foreach ($posts as $item)
                        <div class="col-lg-6">
                            <article class="d-flex flex-column">
                                <div class="post-img">
                                    <img src="{{asset('thumbnail')}}/{{$item->photo}}" class="img-fluid" alt="{{$item->photo}}" >
                                </div>
                                <h2 class="title">
                                <a href="{{url('/blog-details',$item->id)}}">{{$item->title}}</a>
                                </h2>
                                <div class="meta-top">
                                    <ul>
                                      <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{$item->fname}}</a></li>
                                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="2022-01-01">Jan 1, 2022</time></a></li>
                                      <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="#"> Comments</a></li>
                                    </ul>
                                  </div>
                                  <div class="content">
                                    <p>
                                        {!!$item->body!!}
                                    </p>
                                  </div>
                                  <div class="read-more mt-auto align-self-end">
                                    <a href="{{url('/blog-details',$item->id)}}">Read More <i class="bi bi-arrow-right"></i></a>
                                  </div>
                            </article>
                        </div>
                        @endforeach
                        @else
                        <center><p>no post</p></center>
                    @endif
                    </div>

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

                        <div class="sidebar-item categories">
                            <h3 class="sidebar-title">Categories</h3>
                            <ul class="mt-3">

                        <li><a href="#">sfds <span>(25)</span></a></li>



                            </ul>
                        </div><!-- End sidebar categories-->

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
                                {{-- <li><a href="#">Team</a></li> --}}

                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End Blog Sidebar -->

                </div>
            </div>

        </div>
    </section><!-- End Blog Details Section -->


@endsection
