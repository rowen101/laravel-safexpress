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
                                @if ($branch->image)


                                <a href="{{ asset('/storage/img') }}/{{ $branch->image }}" class="example-image-link" data-lightbox="example" data-title='{{ $branch->site }}'>
                                    <img src="{{ asset('/storage/img/' . $branch->image) }}"
                                        alt="{{ $branch->name }}" width="250" height="100" class="img-fluid"></a>
                                @else
                                    <!-- Display a temporary image when no image is available -->
                                    <img src="{{ asset('/img/warehouse-logo.png') }}" class="img-fluid"
                                        alt="Temporary Image" width="250" height="100">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach
