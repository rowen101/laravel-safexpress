@extends('layouts.safexpress')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/about-header.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center">

            <h2>{{$title}}</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>{{$title}}</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Team Section ======= -->

    <!-- ======= Team Section ======= -->
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

          <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">

            <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                 <li data-filter="*" class="filter-active">All</li>


              @foreach ($gallery as $item)
                <li data-filter=".filter-{{$item->id}}">{{$item->foldername}}</li>
              @endforeach
              {{-- <li data-filter=".filter-product">Product</li>
              <li data-filter=".filter-branding">Branding</li>
              <li data-filter=".filter-books">Books</li> --}}
            </ul><!-- End Portfolio Filters -->

            <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="300">
                @foreach ($thumbnail as $items)
 <div class="col-lg-4 col-md-6 portfolio-item filter-{{$items->parent_id}}">
    <a href="{{asset('uploads')}}/{{$items->image}}" title="{{$items->filename}}" data-gallery="portfolio-gallery-{{$items->parent_id}}" class="glightbox preview-link">
                <img src="{{asset('thumbnail')}}/{{$items->image}}" class="img-fluid" alt="{{$items->filename}}"></a>
               
              </div><!-- End Portfolio Item -->
                @endforeach


              {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-product">
                <img src="{{asset('img/portfolio/product-1.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/product-1.jpg')}}" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-branding">
                <img src="{{asset('img/portfolio/branding-1.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/branding-1.jpg')}}" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-books">
                <img src="{{asset('img/portfolio/books-1.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/books-1.jpg')}}" title="Branding 1" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <img src="{{asset('img/portfolio/app-2.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/app-2.jpg')}}" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-product">
                <img src="{{asset('img/portfolio/product-2.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/product-2.jpg')}}" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-branding">
                <img src="{{asset('img/portfolio/branding-2.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/branding-2.jpg')}}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-books">
                <img src="{{asset('img/portfolio/books-2.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/books-2.jpg')}}" title="Branding 2" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                <img src="{{asset('img/portfolio/app-3.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/app-3.jpg')}}" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-product">
                <img src="{{asset('img/portfolio/product-3.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/product-3.jpg')}}" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-branding">
                <img src="{{asset('img/portfolio/branding-3.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/branding-3.jpg')}}" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item -->

              <div class="col-lg-4 col-md-6 portfolio-item filter-books">
                <img src="{{asset('img/portfolio/books-3.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="{{asset('img/portfolio/books-3.jpg')}}"" title="Branding 3" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- End Portfolio Item --> --}}

            </div><!-- End Portfolio Container -->

          </div>

        </div>
      </section><!-- End Portfolio Section -->
    <script>
        $(document).ready(function() {

            $("article").AutoLightbox({
                dimBackground: true,
                width: 520,
                height: 440,
                dimBackground: false
            });

        });
    </script>
@endsection
