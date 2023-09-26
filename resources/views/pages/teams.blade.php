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

    <!-- ======= Team Section ======= -->

    <!-- ======= Team Section ======= -->
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">

            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                data-portfolio-sort="original-order">

                <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>


                    @foreach ($gallery as $item)
                        <li data-filter=".filter-{{ $item->id }}">{{ $item->foldername }}</li>
                    @endforeach

                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="300">
                    @foreach ($thumbnail as $items)
                        <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $items->parent_id }}">
                            <a href="{{ asset('uploads') }}/{{ $items->image }}" title="{{ $items->filename }}"
                                data-gallery="portfolio-gallery-{{ $items->parent_id }}" class="glightbox preview-link">
                                <img src="{{ asset('thumbnail') }}/{{ $items->image }}" class="img-fluid"
                                    alt="{{ $items->filename }}"></a>

                        </div><!-- End Portfolio Item -->
                    @endforeach




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
