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

                        {{ Breadcrumbs::render('gallery') }}

                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">

                        <div class="card-body">

                            <table class="table table-bordered data-table table-hover table-striped small " width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                        <th>Folder Name</th>
                                        <th>Active</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </div>
        <!--end container-->
        <div class="modal fade" id="ajaxModel" aria-hidden="true">
            <div class=" modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('admin.gallery.form')
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="ajaxModelAddimage" aria-hidden="true">
            <div class=" modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeadingImage"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('admin.gallery.form-gallery')
                    </div>

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
        <link rel='stylesheet' href='{{ asset('css/sweetalert2.min.css') }}'>
    @endpush

    @push('buttom')
        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

        <script type="text/javascript">
            $(function() {


                const textbox = document.getElementById('foldername');
                const form = document.getElementById('productForm');
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
                Render DataTable
                --------------------------------------------*/
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('gallery.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'id',
                            name: 'id',
                            searchable: true,
                            visible: false
                        },
                        {
                            data: 'foldername',
                            name: 'foldername'
                        },

                        {
                            data: 'is_active',
                            name: 'is_active'

                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
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
                    $('#menu_code').prop('disabled', false);
                });




                /*------------------------------------------
                --------------------------------------------
                Create Categorie Code
                --------------------------------------------
                --------------------------------------------*/
                function handleSaveButtonClick(e) {
                    e.preventDefault();
                    $(this).html('Sending..');
                    var formData = $('#productForm').serialize();
                    $.ajax({
                        data: $('#productForm').serialize(),
                        url: "{{ url('/admin/gallery') }}",
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

                            Swal.fire({
                                icon: 'warning',
                                title: response.success
                            })
                        }
                    });
                }
                $('#saveBtn').click(handleSaveButtonClick);
                /*------------------------------------------
                      --------------------------------------------
                      Click to Edit Button
                      --------------------------------------------
                      --------------------------------------------*/
                $('body').on('click', '.edit', function() {
                    var id = $(this).data('id');
                    $.get("{{ url('/admin/gallery') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeading').html("Edit {{ $title }}");
                        $('#saveBtn').val("edit");
                        $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Update');
                        $('#ajaxModel').modal('show');
                        $('#txtid').val(data.id);
                        $('#foldername').val(data.foldername);
                        //$('#gurec').prop('readonly',true);
                        $('#is_active').val(data.is_active);
                        $('#is_active').prop("checked", (data.is_active == 1 ? true : false));

                        //hide span alert
                        document.getElementById('foldernameErrorMsg').style.visibility = 'hidden';

                    })

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
                                url: "{{ url('admin/gallery') }}" + '/' + id,
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
                                    console.log(response.responseJSON)

                                },
                                error: function(data) {
                                    console.log('Error:', data.message);
                                    Swal.fire({
                                        icon: 'warning',
                                        text: data.message,
                                    })
                                    $('#saveBtn').html(
                                        '<i class="fas fa-save"></i>&nbsp;Save');
                                }
                            });


                        }
                    })


                });

                /*------------------------------------------
                  --------------------------------------------
                  delete Click Button
                  --------------------------------------------
                  --------------------------------------------*/
                $('body').on('click', '.addimage', function() {
                    var id = $(this).data('id');

                    function loadimage() {
                        $.ajax({
                            url: "{{ url('dropzone/fetch') }}" + '/' + id + '/image',
                            success: function(data) {
                                $('#uploaded_image').html(data);
                            }
                        })
                    }
                    var title = $(this).data('foldername');
                    $.get("{{ url('/admin/gallery') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeadingImage').html(data.foldername);
                        $('#saveBtnImage').val("edit");
                        $('#saveBtnImage').html('<i class="fas fa-save"></i>&nbsp;Add Image');
                        $('#ajaxModelAddimage').modal('show');
                        $('#parent_id').val(data.id);
                        $('#foldername').val(data.foldername);

                        $('#is_active').val(data.is_active);
                        $('#is_active').prop("checked", (data.is_active == 1 ? true : false));

                        //hide span alert
                        document.getElementById('foldernameErrorMsg').style.visibility = 'hidden';

                        loadimage()
                        $('#dropzoneForm').trigger("reset");
                    })




                });
                //refresh
                $(document).on('click', '#fethimage', function() {
                    $.ajax({
                        url: "{{ url('dropzone/fetch') }}" + '/' + id +
                            '/image',
                        success: function(data) {
                            $('#uploaded_image').html(data);
                        }
                    })
                });
                //image delete
                $(document).on('click', '.remove_image', function() {
                    var name = $(this).attr('id');
                    $.ajax({
                        url: "{{ route('dropzone.delete') }}",
                        data: {
                            name: name
                        },
                        success: function(data) {
                            $.ajax({
                                url: "{{ url('dropzone/fetch') }}" + '/' + id +
                                    '/image',
                                success: function(data) {
                                    $('#uploaded_image').html(data);
                                }
                            })
                        }
                    })
                });

                // Add keydown event listener to the textbox
                textbox.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Prevent the default Enter key behavior (form submission)
                        // form.dispatchEvent(new Event('submit')); // Trigger the form's submit event
                        handleSaveButtonClick();
                    }
                });

                //drop image
                Dropzone.options.dropzoneForm = {
                    autoProcessQueue: false,
                    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",

                    init: function() {
                        var submitButton = document.querySelector("#submit-all");
                        myDropzone = this;

                        submitButton.addEventListener('click', function() {
                            myDropzone.processQueue();
                        });

                        this.on("complete", function() {
                            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length ==
                                0) {
                                var _this = this;
                                _this.removeAllFiles();
                            }
                            load_images();
                        });

                    }

                };


            });
        </script>
    @endpush
@endsection
