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

                        {{ Breadcrumbs::render('carousel') }}

                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid">

            <div class="card card-primary card-outline">
                <div class="card-header">

                    <div class="card-tools">
                        <div class="input-group-append">
                            <button id="fetchImage" class="float-right btn btn-sm btn-success"><i
                                    class="fa fa-refresh"></i></button>
                        </div>

                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">
                    <div class="row">
                         @foreach ($carousel as $item)
                            <div class="col-sm-2">

                                <div class="image-container">

                                    <div class="pencil">
                                        <button id="edit-client" class="btn btn-sm btn-primary pencil-button"
                                            style="background: transparent; border: none;"><i
                                                class="fas fa-pencil-alt pencil-icon" data-id="{{ $item->id }}"
                                                data-caption="{{ $item->caption }}"></i></button>
                                    </div>

                                    <a href="{{ asset('carousel/' . $item->image) }}" data-toggle="lightbox"
                                        data-title="{{ $item->caption }}" data-gallery="gallery">
                                        <img src="{{ asset('carousel/thumbnail/' . $item->image) }}" class="img-fluid mb-2"
                                            alt="client" />
                                    </a>
                                    <!-- Add X icon -->
                                    <div class="xclient">
                                        <button id="del-client" class="btn btn-sm btn-danger x-button"
                                            style="background: transparent; border: none;">
                                            <i class="fas fa-times x-icon" data-id="{{ $item->id }}"></i>
                                        </button>

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>


            <br />

        </div>
        <!--end container-->
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="dropzoneForm" class="dropzone" action="{{ route('carousel.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="panel panel-default bg-primary">
                            </div>
                        </form>
                        <div class="modal-footer justify-content-between">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            {{-- <button type="button" class="btn btn-primary" id="saveBtn" value="create-categorie"><i
                                    class="fas fa-save"></i>&nbsp;Save</button> --}}
                        </div>
                    </div>


                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        {{-- Example modal dialog structure --}}
        <div class="modal fade" id="editFilenameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Filename</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add input fields and form for editing the filename here -->
                        <form id="clientForm">
                            @csrf
                            <input type="hidden" class="form-control" id="filename-id" name="id" value="" />
                            <input type="text" id="caption" name="caption" class="form-control" value=""
                                placeholder="Edit the caption" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="saveClient" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
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

            .pencil,
            .xclient {
                display: none;
            }

            .pencil {
                position: absolute;
                top: 0;
                left: 0;
                cursor: pointer;
                transition: all 0.3s ease;
                /* Adding a transition for animation */
            }

            .xclient {
                position: absolute;
                top: 0;
                right: 0;
                cursor: pointer;

            }

            .x-button .x-icon {
                color: red;
                /* Change the X icon color to red, or customize as needed */
            }

            .pencil-button .pencil-icon {
                color: green;

            }


            .image-container:hover .pencil,
            .image-container:hover .xclient {
                display: inline-block;
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
        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

                //delete client image
                document.querySelectorAll('.x-button').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var data = this.querySelector('.x-icon');
                        var id = data.getAttribute('data-id');
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
                                    url: "{{ url('admin/carousel') }}" + '/' +
                                    id, // Ensure this URL is correctly configured in your routes
                                    type: 'DELETE',
                                    success: function(response) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: response.success

                                        })
                                        location
                                    .reload(); // This will refresh the current page.
                                    },
                                    error: function(data) {
                                        console.log('Error:', data);
                                        Swal.fire({
                                            icon: 'warning',
                                            title: data.response,
                                        })
                                        $('#saveBtn').html(
                                            '<i class="fas fa-save"></i>&nbsp;Save'
                                        );
                                    }
                                });
                            }
                        })

                    });
                });
                // JavaScript to handle the click event on the pencil icon

                document.querySelectorAll('.pencil-button').forEach(function(button) {
                    button.addEventListener('click', function() {
                        var data = this.querySelector('.pencil-icon');
                        var id = data.getAttribute('data-id');
                        var caption = data.getAttribute('data-caption');

                        $('#editFilenameModal').modal('show');
                        $('#filename-id').val(id);
                        $('#caption').val(caption);
                        // You can use the 'id' variable to perform actions with the ID data.
                    });
                });

                //save cliet filename
                $('#saveClient').click(function() {
                    var formData = $('#clientForm').serialize();
                    $.ajax({
                        url: '{{ route('carousel.filename') }}',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Handle the success response here, e.g., show a success message
                            alert(response.success);
                            // Reload the index page after a successful update
                            location.reload(); // This will refresh the current page.
                        },
                        error: function(error) {
                            // Handle errors here
                            alert('An error occurred. Please try again.');
                        }
                    });
                });

                /*
                Reload
                */
                $(document).ready(function() {
                    // Add a click event handler to the .fa-refresh element
                    $('.fa-refresh').click(function() {
                        location.reload();
                    });
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


                $("#is_active").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 1);
                    } else {
                        $(this).attr('value', 0);
                    }

                    //  $('#checkbox-value').text($('#is_active').val());
                });




            });



            // Fetch and display images on page load
            // $(document).ready(function() {

            //     $.ajax({
            //         url: '{{ route('client.fetch') }}',
            //         type: 'GET',
            //         success: function(data) {
            //             var imageContainer = $('#image-container');
            //             imageContainer.empty(); // Clear the container

            //             data.images.forEach(function(image) {
            //                 var imageElement = $('<div class="col-sm-2"> \
            //                 <div class="image-container"> \
            //                     <div class="pencil"> \
            //                         <button id="edit-client" class="btn btn-sm btn-primary pencil-button" \
            //                             style="background: transparent; border: none;"> \
            //                             <i class="fas fa-pencil-alt pencil-icon" data-id="' + image.id + '" \
            //                             data-filename="' + image.filename + '"></i> \
            //                         </button> \
            //                     </div> \
            //                     <a href="' + image.image_url + '" data-toggle="lightbox" \
            //                         data-title="' + image.filename + '" data-gallery="gallery"> \
            //                         <img src="' + image.thumbnail_url + '" class="img-fluid mb-2" alt="client" /> \
            //                     </a> \
            //                     <div class="xclient"> \
            //                         <button id="del-client" class="btn btn-sm btn-danger x-button" \
            //                             style="background: transparent; border: none;"> \
            //                             <i class="fas fa-times x-icon" data-id="' + image.id + '"></i> \
            //                         </button> \
            //                     </div> \
            //                 </div> \
            //             </div>');
            //                 imageContainer.append(imageElement);
            //             });
            //         },
            //         error: function(error) {
            //             console.log('Error:', error);
            //         }
            //     });
            // });


        </script>
    @endpush
@endsection
