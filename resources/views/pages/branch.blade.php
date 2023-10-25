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

    <!-- ======= Branch Section ======= -->
    <section id="contact" class="contact">
        <div class="container position-relative" data-aos="fade-up">

            <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="300">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="250">

                    <div class="form-group">
                        <label for="region">Select Region:</label>
                        <select id="region" class="form-control">
                            <option value="">All</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}">{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                        @foreach ($branches as $branch)
                        <div class="col-lg-6">
                            <div class="branch card" data-region="{{ $branch->region }}">


                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <!-- left column -->
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Display branch details here -->
                                                        <p>Region: {{ $branch->region }}</p>
                                                        <p>Site: {{ $branch->site }}</p>
                                                        <p>Site Head: {{ $branch->sitehead }}</p>
                                                        <p>Location: {{ $branch->location }}</p>
                                                        <p>Email: <a href="mailto:{{ $branch->email }}">{{ $branch->email }}</a></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($branch->image)
                                                            <a href="{{ asset('/storage/img/Branch/') }}/{{ $branch->image }}"
                                                                class="example-image-link"
                                                                data-lightbox="{{ $branch->id }}"
                                                                data-title="{{ $branch->site }}">
                                                                <img src="{{ asset('/storage/img/Branch/thumbnail/thumbnail_' . $branch->image) }}"
                                                                    alt="{{ $branch->name }}"
                                                                    class="img-fluid"></a>
                                                        @else
                                                            <!-- Display a temporary image when no image is available -->
                                                            <img src="{{ asset('/img/warehouse-logo.png') }}"
                                                                class="img-fluid" alt="Temporary Image" width="250"
                                                                height="100">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="toggle-map-btn btn btn-primary btn-sm mt-2" id="toggle-map" data-target="geo-map{{$branch->id}}">Map&nbsp;<i class="fa fa-eye"></i></button>
                                    <div id="geo-map{{$branch->id}}" style="display: none" class="mt-2">
                                        <!-- Add your map content here -->
                                        <div class="container-iframe">
                                            {!!$branch->geomap!!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="pagination">
                            {{ $branches->links() }}
                        </div>

                </div>

            </div>

        </div>
    </section>

    <!-- End Contact Section -->

    <script>
        $(document).ready(function() {
            // Listen for changes in the region selection
            $('#region').on('change', function() {
                var selectedRegion = $(this).val();

                // Hide all branches
                $('.branch').hide();

                if (selectedRegion === 'Luzon Operation') {

                    $('.branch[data-region="Luzon Operation"]').show();
                }
                else if (selectedRegion === 'Visayas Operation') {

                    $('.branch[data-region="Visayas Operation"]').show();
                }
                else if (selectedRegion === 'Mindanao Operation') {

                    $('.branch[data-region="Mindanao Operation"]').show();
                }
                 else {

                    $('.branch').show();
                }
            });
        });

        $('.toggle-map-btn').click(function() {
        var target = $(this).data('target');
        var mapSection = $('#' + target);
        mapSection.slideToggle(); // Toggle the visibility of the specified map section

        // Toggle the button text
        var button = $(this);
                var icon = button.find('i');
                if (icon.hasClass('fa-eye')) {
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
    });
    </script>
@endsection
