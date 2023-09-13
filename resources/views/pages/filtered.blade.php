@foreach($branches as $branch)
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
                            <img
                            src="{{ asset('/storage/img/' . $branch->image) }}"
                            class="img-fluid" alt="{{ $branch->name }}" width="250" height="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
<script>
    // Remove query parameters from the URL
    var newURL = window.location.pathname;
    history.pushState({}, '', newURL);
</script>
