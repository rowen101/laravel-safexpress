@extends('layouts.safexpress')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('img/about-header.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center">

            <h2>{{ $title }}</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>{{ $title }}</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <section id="warehouse" class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>UNPARALLELED WAREHOUSE MANAGEMENT</h2>

              </div>
            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                data-portfolio-sort="original-order">


                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="300">



                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('img/warehouse/transport.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Transport Services and Management</h4>

                            <a href="{{ asset('img/warehouse/transport.jpg') }}" title="Transport Services and Management"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('img/warehouse/warehouse-management.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Warehouse Management (Cold & Dry)</h4>

                            <a href="{{ asset('img/warehouse/warehouse-management.jpg') }}" title="Warehouse Management (Cold & Dry)"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('img/warehouse/reverse-logistics.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Reverse Logistics</h4>

                            <a href="{{ asset('img/warehouse/reverse-logistics.jpg') }}" title="Reverse Logistics"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('img/warehouse/distribution.jpg') }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Distribution Management(FG & RM)</h4>

                            <a href="{{ asset('img/warehouse/distribution.jpg') }}" title="Distribution Management(FG & RM)"
                                data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('img/warehouse/MHE-rental.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>MHE Rentals</h4>

                          <a href="{{ asset('img/warehouse/MHE-rental.jpg')}}" title="MHE Rentals" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                      </div>

                      <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ asset('img/warehouse/build-to-suit-warehouse.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Built-to-Suit Warehouse Facilities</h4>

                          <a href="{{ asset('img/warehouse/build-to-suit-warehouse.jpg')}}" title="Built-to-Suit Warehouse Facilities" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>

                        </div>
                      </div>



                </div>

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
