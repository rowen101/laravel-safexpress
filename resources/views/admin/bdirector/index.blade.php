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

                        {{ Breadcrumbs::render('board') }}

                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th><i class="fas fa fa-facebook-f"></i></th>
                                    <th><i class="fas fa fa-twitter-square"></i></th>
                                    <th><i class="fas fa fa-instagram"></i></th>
                                    <th><i class="fas fa fa-linkedin"></i></th>
                                    <th>Active</th>
                                    <th>CreateAt</th>
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
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="container">
                                        <div class="row justify-content-center align-items-center">

                                            <div class="col-md-6 text-center">
                                                <div class="my-2">
                                                    <img src="" id="profile" alt="" alt="Profile Image" class="img-fluid"/>
                                                    <input type="file" name="image" id="image"
                                                        class="form-control" accept="image/*">
                                                        
                                                </div>
                                                <div class="mt-2" id="avatar"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- left column -->
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="form-group required">
                                                    <label class="control-label">Name</label>
                                                    <!-- Hidden field to store the user ID for update -->
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="Name">
                                                    <span class="text-danger" id="nameErrorMsg"></span>
                                                </div>
                                                <div class="form-group required">
                                                    <label class="control-label">Position</label>
                                                    <!-- Hidden field to store the user ID for update -->
                                                    <input type="text" class="form-control" id="position"
                                                        name="position" placeholder="Position">
                                                    <span class="text-danger" id="positionErrorMsg"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">About</label>

                                                    <!-- Hidden field to store the user ID for update -->
                                                    <input type="text" name="about" id="about"
                                                        class="form-control">
                                                    <span class="text-danger" id="aboutErrorMsg"></span>
                                                </div>
                                                <div class="form-group required">
                                                    <label for="exampleInputEmail1" class="control-label">Oraganization Type</label>
                                                    <select class="custom-select rounded-0" name="org_type" id="org_type">
                                                        <option value="0" disabled>--Select Organization--</option>
                                                        <option value="board">Board</option>
                                                        <option value="mancom">Mancom</option>
                                                    </select>
                                                    {{-- <input type="hidden" id="app_id" value="app_id" name="app_id"/> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" id="txt_id" name="id" value="id">
                                                <fieldset class="form-group border p-3">
                                                    <legend class="w-auto px-1">
                                                        <input type="checkbox" id="is_social" name="is_social" value=""/>
                                                        Show Social Media
                                                    </legend>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="checkbox" name="fb" id="fb"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <input type="text" name="fb_url" id="fb_url" value=""
                                                            class="form-control" placeholder="Facebook url">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="checkbox" name="tw" id="tw"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <input type="text" name="tw_url" id="tw_url"
                                                            value="" class="form-control"
                                                            placeholder="Twetter url">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="checkbox" name="linkin" id="linkin"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <input type="text" name="linkin_url" value=""
                                                            id="linkin_url" class="form-control"
                                                            placeholder="Linkin url">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <input type="checkbox" name="instagram" id="instagram"
                                                                    value="">
                                                            </div>
                                                        </div>
                                                        <input type="text" name="instagram_url" value=""
                                                            id="instagram_url" class="form-control"
                                                            placeholder="Instagram url" />
                                                    </div>
                                                </fieldset>
                                                <div class="d-flex justify-content-end">

                                                    <div class="form-group mb-0 ">

                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="is_active" id="is_active"
                                                                value="" class="custom-control-input"
                                                                aria-invalid="true" />

                                                            <label class="custom-control-label" name="is_active"
                                                                for="is_active">Active</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create-categorie"><i
                                class="fas fa-save"></i>&nbsp;Save</button>
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

            <a href="javascript:void(0)" id="createNewCategory"><i class="fas fa-plus"></i></a>

        </div>

    </div>

    @push('head')
        <link rel='stylesheet' href='{{ asset('css/sweetalert2.min.css') }}'>
    @endpush

    @push('buttom')
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
                Render DataTable
                --------------------------------------------*/
                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('bdirector.index') }}",
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
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'position',
                            name: 'position'
                        },
                        {
                            data: 'fb',
                            name: 'fb',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'tw',
                            name: 'tw',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'linkin',
                            name: 'linkin',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'instagram',
                            name: 'instagram',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'is_active',
                            name: 'is_active',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                /*------------------------------------------
                --------------------------------------------
                Click to Button
                --------------------------------------------
                --------------------------------------------*/
                $('#createNewCategory').click(function() {
                    $('#saveBtn').val("create");
                    $('#txt_id').val('');
                    $('#productForm').trigger("reset");
                    $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Save');
                    $('#modelHeading').html("Create {{ $title }}");
                    $('#ajaxModel').modal('show');
                    $('#image').val('');
                    $('#profile').attr('src', '');
                });


                /*------------------------------------------
                --------------------------------------------
                Create directory Code
                --------------------------------------------
                --------------------------------------------*/

                $("#productForm").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#saveBtn").text('Sending...');
                    var formData = $('#productForm').serialize();
                    $.ajax({
                        url: "{{ url('/admin/bdirector') }}",
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {

                             Swal.fire({
                                icon: 'success',
                                title: response.success

                            })
                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');

                             // Clear the file input
                           $('#image').val('');
                           $('#profile').attr('src', '');
                            table.ajax.reload();
                        },
                        error: function(data) {
                            Swal.fire({
                                icon: 'warning',
                                title: `Oop Something wrong!`,
                                text: data.responseJSON.errors

                            })
                            console.log('Error:', data);
                            $('#nameErrorMsg').text(data.responseJSON.errors.name);
                            $('#positionErrorMsg').text(data.responseJSON.errors.position);
                            $('#aboutErrorMsg').text(data.responseJSON.errors.about);
                        }
                    });
                });


                /*------------------------------------------
                      --------------------------------------------
                      Click to Edit Button
                      --------------------------------------------
                      --------------------------------------------*/
                $('body').on('click', '.edit', function() {
                    var id = $(this).data('id');
                    $.get("{{ url('admin/bdirector') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeading').html("Edit {{ $title }}");
                        $('#saveBtn').val("edit");
                        $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Update');
                        $('#ajaxModel').modal('show');
                        $('#txt_id').val(data.id);
                        $('#name').val(data.name);
                        $('#position').val(data.position);
                        $('#about').val(data.about);
                        $('#org_type').val(data.org_type);
                        $('#fb_url').val(data.fb_url);
                        $('#tw_url').val(data.tw_url);
                        $('#linkin_url').val(data.linkin_url);
                        $('#instagram_url').val(data.instagram_url);
                        $('#is_active').val(data.is_active);
                        $('#profile').attr('src',"{{ asset('storage/img/') }}" + '/' + data.image);
                        $('#is_active').prop("checked", (data.is_active == 1 ? true : false));
                        $('#is_social').val(data.is_social);
                        $('#is_social').prop("checked", (data.is_social == 1 ? true : false));
                        //social media
                        if (data.fb == 0) {
                            $('#fb').prop("checked", true);
                            $("#fb_url").prop("disabled", true);
                        } else {
                            $('#fb').prop("checked", false);
                            $("#fb_url").prop("disabled", false);
                        }

                        if (data.tw == 0) {
                            $('#tw').prop("checked", true);
                            $("#tw_url").prop("disabled", true);
                        } else {
                            $('#tw').prop("checked", false);
                            $("#tw_url").prop("disabled", false);
                        }

                        if (data.linkin == 0) {
                            $('#linkin').prop("checked", true);
                            $("#linkin_url").prop("disabled", true);
                        } else {
                            $('#linkin').prop("checked", false);
                            $("#linkin_url").prop("disabled", false);
                        }

                        if (data.instagram == 0) {
                            $('#instagram').prop("checked", true);
                            $("#instagram_url").prop("disabled", true);
                        } else {
                            $('#instagram').prop("checked", false);
                            $("instagram").prop("disabled", false);
                        }

                        //hide span alert
                        document.getElementById('nameErrorMsg').style.visibility = 'hidden';
                        document.getElementById('postionErrorMsg').style.visibility = 'hidden';
                        document.getElementById('AboutErrorMsg').style.visibility = 'hidden';
                    })


                });

                $("#is_social").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 1);
                    } else {
                        $(this).attr('value', 0);
                    }

                    //  $('#checkbox-value').text($('#is_active').val());
                });


                $("#is_active").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 1);
                    } else {
                        $(this).attr('value', 0);
                    }

                    //  $('#checkbox-value').text($('#is_active').val());
                });

                ///social media checkbox

                $("#fb").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 0);
                        $("#fb_url").prop("disabled", true);
                    } else {
                        $(this).attr('value', 1);
                        $("#fb_url").prop("disabled", false);
                    }


                });

                $("#tw").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 0);
                        $("#tw_url").prop("disabled", true);
                    } else {
                        $(this).attr('value', 1);
                        $("#tw_url").prop("disabled", false);
                    }


                });

                $("#linkin").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 0);
                        $("#linkin_url").prop("disabled", true);
                    } else {
                        $(this).attr('value', 1);
                        $("#linkin_url").prop("disabled", false);
                    }


                });

                $("#instagram").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 0);
                        $("#instagram_url").prop("disabled", true);
                    } else {
                        $(this).attr('value', 1);
                        $("#instagram_url").prop("disabled", false);
                    }


                });
                //end social media chekbox
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
                                url: "{{ url('admin/bdirector') }}" + '/' + id,
                                type: 'DELETE',
                                data: id,
                                success: function(response) {
                                    // Handle success, update the DataTable, close the modal, etc.
                                    $('#productForm').trigger("reset");
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )

                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    $('#saveBtn').html(
                                        '<i class="fas fa-save"></i>&nbsp;Save');
                                }
                            });


                        }
                    })


                });
            });
        </script>
    @endpush
@endsection
