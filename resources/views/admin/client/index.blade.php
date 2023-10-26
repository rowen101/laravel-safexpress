@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        {{ Breadcrumbs::render('client') }}

                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid">

            <div class="card">

                <div class="card-body">
                    <div class="row">
                        @foreach ($images as $item)
                            <div class="col-sm-2">
                                <div class="image-container">
                                    <a href="{{ asset('clients/' . $item->image) }}" data-toggle="lightbox"
                                        data-title="{{ $item->id }}" data-gallery="gallery">
                                        <img src="{{ asset('clients/thumbnail/' . $item->image) }}" class="img-fluid mb-2"
                                            alt="client" />
                                    </a>
                                    <div class="overlay">
                                        <i class="fas fa-times remove_image" id="{{ $item->id }}"></i>
                                        <!-- Add your X icon here -->

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Uploaded Image</h3>&nbsp;
                    <button id="fetchImage" class="float-right btn btn-sm btn-success"><i
                            class="fa fa-refresh"></i></button>
                </div>
                {{-- <div class="panel-body" id="uploaded_image">


                </div> --}}
            </div>
        </div>
        <!--end container-->
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <form id="dropzoneForm" class="dropzone" action="{{ route('client.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="panel panel-default">
                                <div class="panel-body">


                                        {{-- <input type="hidden" name="filename" value="{{$data->filename}}"/> --}}
                                    
                                    <div align="center">
                                        <button type="button" class="btn btn-success" id="submit-all">Upload</button>
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer justify-content-between">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveBtn" value="create-categorie"><i
                                        class="fas fa-save"></i>&nbsp;Save</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <div class="fab-container">
        <div class="button iconbutton">
            <a href="javascript:void(0)" id="createNew"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    @push('head')
        <style type="text/css">
            .image-container {
                position: relative;
                overflow: hidden;
            }

            .overlay {
                position: absolute;
                top: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.5);
                padding: 5px;

            }

            .image-container:hover .overlay {
                display: block;
            }

            .overlay i {
                color: green;
                cursor: pointer;

            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

        <!-- Ekko Lightbox -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
    @endpush

    @push('buttom')
        {{-- Ekko Lightbox --}}
        <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
        <!-- Filterizr-->
        <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>

        <script>
            $(function() {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });

                $('.filter-container').filterizr({
                    gutterPixels: 3
                });
                $('.btn[data-filter]').on('click', function() {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            })
        </script>



        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

        <script type="text/javascript">
            $(function() {
                /*------------------------------------------
                 --------------------------------------------
                 Pass Header Token
                 --------------------------------------------
                 --------------------------------------------*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                /*------------------------------------------
                        --------------------------------------------
                        Click to Button
                        --------------------------------------------
                        --------------------------------------------*/
                $('#createNew').click(function() {
                    $('#saveBtn').val("create");
                    $('#txtid').val('');
                    $('#productForm').trigger("reset");
                    $('#modelHeading').html("Create {{ $title }}");
                    $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Save');
                    $('#ajaxModel').modal('show');
                });



                /*------------------------------------------
                    --------------------------------------------
                    Create Categorie Code
                    --------------------------------------------
                    --------------------------------------------*/
                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('Sending..');
                    var formData = $('#productForm').serialize();
                    $.ajax({
                        data: $('#productForm').serialize(),
                        url: "{{ url('/admin/apps') }}",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        success: function(response) {

                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: response.success

                            })

                        },
                        error: function(response) {
                            console.log('Error:', response);
                            $('#app_codeErrorMsg').text(response.responseJSON.errors.app_code);
                            $('#app_nameErrorMsg').text(response.responseJSON.errors.app_name);
                            $('#descriptionErrorMsg').text(response.responseJSON.errors
                                .description);

                        }
                    });
                });

                $("#is_active").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 1);
                    } else {
                        $(this).attr('value', 0);
                    }

                    //  $('#checkbox-value').text($('#is_active').val());
                });


                /*------------------------------------------
                          --------------------------------------------
                          delete Click Button
                          --------------------------------------------
                          --------------------------------------------*/
                $('body').on('click', '.delete', function() {

                    var id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //AJAX
                            $.ajax({
                                url: "{{ url('admin/apps') }}" + '/' + id,
                                type: 'DELETE',
                                data: id,
                                success: function(response) {
                                    // Handle success, update the DataTable, close the modal, etc.
                                    $('#productForm').trigger("reset");
                                    table.ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: response.success

                                    })

                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: `This Application is use!`,
                                    })
                                    $('#saveBtn').html(
                                        '<i class="fas fa-save"></i>&nbsp;Save');
                                }
                            });
                        }
                    })
                });
            });
        </script>

        {{-- <script type="text/javascript">
            $(function() {
                /*------------------------------------------
                 --------------------------------------------
                 Pass Header Token
                 --------------------------------------------
                 --------------------------------------------*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                /*------------------------------------------
                        --------------------------------------------
                        Click to Button
                        --------------------------------------------
                        --------------------------------------------*/
                    $('#createNew').click(function() {
                    $('#saveBtn').val("create");
                    $('#modelHeading').html("Create {{ $title }}");
                    $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Save');
                    $('#ajaxModel').modal('show');
                });

                Dropzone.options.dropzoneForm = {
                    autoProcessQueue: false,
                    acceptedFiles: ".png, .jpg, .gif, .bmp, .jpeg",

                    init: function() {
                        var submitButton = document.querySelector("#submit-all");
                        myDropzone = this;

                        submitButton.addEventListener('click', function() {
                            myDropzone.processQueue();
                        });

                        this.on("complete", function() {
                            if (this.getQueuedFiles().length === 0 && this.getUploadingFiles()
                                .length === 0) {
                                var _this = this;
                                _this.removeAllFiles();
                            }
                            loadImages();
                        });
                    }
                };

                // Call the loadImages function to load images on page load
                loadImages();
                // Update your JavaScript function to fetch and display images
                function loadImages() {
                    $.ajax({
                        url: "{{ route('client.fetch') }}",
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                            // Data retrieval was successful
                            console.log(data);
                            alert(data.id);
                        },
                        error: function(error) {
                            // Handle any errors here
                            console.log(error);
                            alert('not show client');
                        }
                        success: function(data) {
                            if (data.images) {
                                var output = '<div class="row">';
                                $.each(data.images, function(index, image) {
                                    output +=
                                        '<div class="col-md-2" style="margin-bottom:16px;" align="center">';
                                    output += '<img src="' + '{{ asset('clients/thumbnail') }}/' +
                                        image.image +
                                        '" class="img-thumbnail" width="175" height="175" style="height:175px;" />';
                                    output +=
                                        '<button type="button" class="btn btn-link remove_image" id="' +
                                        image.image + '">Remove</button>';
                                    output += '</div>';
                                });
                                output += '</div>';
                                $('#uploaded_image').html(output);
                                // Console log the retrieved images
                                if (!data) {
                                    console.log(data.image)
                                } else {
                                    console.log('no images retrieved')
                                }
                            }
                        }
                    });
                }
                $(document).on('click', '.remove_image', function() {
                    var name = $(this).attr('id');
                    $.ajax({
                        url: "{{ route('client.delete') }}",
                        type: "DELETE",
                        data: {
                            name: name,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            loadImages();
                        }
                    });
                });

                // Add a click event listener for the "Refresh" button
                $(document).on('click', '#fetchImage', function() {
                    loadImages();
                });

            });
        </script> --}}
    @endpush
@endsection
