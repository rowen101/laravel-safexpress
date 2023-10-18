@extends('layouts.app')

@section('content')
    <div class="content-header">
        <!-- ... Your existing code for the header ... -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Contact Us</h3>
                    </div>
                    <div class="card-body">
                        <form id="settingForm">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id" name="id" value="{{ $setting->id  ?? ''}}">
                                <label for="site_email">Site Email</label>
                                <input class="form-control" type="text" id="site_email" name="site_email" value="{{ $setting->site_email  ?? ''}}">
                            </div>

                            <div class="form-group">
                                <label for="site_phone">Site Phone</label>
                                <input class="form-control" type="number" id="site_phone" name="site_phone" value="{{ $setting->site_phone ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="site_phone">Site Address</label>
                                <input class="form-control" type="text" id="site_address" name="site_address" value="{{ $setting->site_address ?? '' }}">
                            </div>

                            <button type="button" id="saveSettings" class="btn btn-primary">Save Settings</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // JavaScript code for handling the form submission
        $(document).ready(function () {
            $('#saveSettings').click(function () {
                var formData = $('#settingForm').serialize();
                $.ajax({
                    url: '{{ route('setting.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        // Handle the success response here, e.g., show a success message
                        alert(response.success);
                    },
                    error: function (error) {
                        // Handle errors here
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
