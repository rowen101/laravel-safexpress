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

    <!-- ======= brach Section ======= -->
    <section id="contact" class="contact">
        <div class="container position-relative" data-aos="fade-up">

            <div class="row gy-4 d-flex justify-content-end">
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="250">
                    {{-- <div>
                <label for="region-filter">Filter by Region:</label>
                <select id="region-filter">
                    <option value="">All</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region }}">{{ $region }}</option>
                    @endforeach
                </select>
            </div>

            <table id="branch-table" class="table table-sm table-responsive">
                <thead>
                    <tr>
                        <th>Region</th>
                        <th>Site</th>
                        <th>SHead</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Warehouse</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->region }}</td>
                            <td>{{ $branch->site }}</td>
                            <td>{{ $branch->sitehead }}</td>
                            <td>{{ $branch->phone }}</td>
                            <td>{{ $branch->location }}</td>
                            <td> <img src="{{ asset('/storage/img/' . $branch->image) }}" class="img-fluid" alt="{{$branch->name}}" width="250" height="100"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}

                    <div class="form-group">
                        <label for="region">Select Region:</label>
                        <select id="region" class="form-control">
                            <option value="">All</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region }}">{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="filtered-branches">
                        @foreach ($branches as $branch)
                            <div class="branch card mt-2">
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
                                                        <p>Email: {{ $branch->email }}</p>
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img src="{{ asset('/storage/img/' . $branch->image) }}"
                                                            class="img-fluid" alt="{{ $branch->name }}" width="250"
                                                            height="100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->


    <script>
        $(document).ready(function() {
            $('#region').change(function() {
                var selectedRegion = $(this).val();

                if (selectedRegion === "") {
                    // If "All" is selected, reset the display to show all branches.
                    $('#filtered-branches').html(`@include('pages.filtered', ['branches' => $branches])`);
                } else {
                    // Filter branches based on the selected region.
                    $.ajax({
                        url: '/filter-branches',
                        method: 'POST',
                        data: {
                            region: selectedRegion,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#filtered-branches').html(data);
                        }
                    });
                }
            });
        });
    </script>
@endsection
