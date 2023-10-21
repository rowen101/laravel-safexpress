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
                        {{ Breadcrumbs::render('user') }}
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
                                        <th>username</th>
                                        <th>fname</th>
                                        <th>lname</th>
                                        <th>email</th>
                                        <th>role</th>
                                        <th>created</th>
                                        <th>Acitve</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>

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

                        <div class="modal-header">
                            <h4 class="modal-title" id="modelHeading"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @include('admin.user.form')

                            <div class="modal-footer justify-content-between">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveBtn" value="create-categorie"><i
                                        class="fas fa-save"></i>&nbsp;Save</button>
                            </div>
                        </div>


                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
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
            var label = document.getElementById('clabel');

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
                    ajax: "{{ route('user.index') }}",
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
                            data: 'first_name',
                            name: 'first_name'
                        },
                        {
                            data: 'last_name',
                            name: 'last_name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role_code',
                            name: 'role_code'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'is_active',
                            name: 'is_active'
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
                $('#createNewCategory').click(function() {
                    $('#saveBtn').val("create-categorie");
                    $('#txtid').val('');
                    $('#name').val('');
                    $('#first_name').val('');
                    $('#last_name').val('');
                    $('#role_id').val('');
                    $('#user_type').val('');
                    $('#email').val('');
                    $('#password').val('');
                    $('#productForm').trigger("reset");
                    $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Save');
                    $('#modelHeading').html("Create {{ $title }}");
                    $('#ajaxModel').modal('show');
                    label.style.display = 'none';

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
                        url: "{{ url('/admin/user') }}",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: 'Save Complete',
                                text: response.success

                            })

                        },
                        error: function(response) {
                            console.error('Error:', response);

                            $('#first_nameErrorMsg').text(response.responseJSON.errors.first_name);
                            $('#last_nameErrorMsg').text(response.responseJSON.errors.last_name);

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

                    $.get("{{ url('admin/user') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeading').html("Edit {{ $title }}");
                        $('#saveBtn').val("edit-categorie");
                        $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Update');
                        $('#ajaxModel').modal('show');
                        $('#txtid').val(data[0].id);
                        $('#name').val(data[0].name);
                        $('#first_name').val(data[0].first_name);
                        $('#last_name').val(data[0].last_name);
                        $('#role_id').val(data[0].role_id);
                        $('#user_type').val(data[0].user_type);
                        $('#email').val(data[0].email);
                        $('#password').val(data[0].password);
                        $('#is_active').val(data[0].is_active);
                        $('#is_active').prop("checked", (data[0].is_active == 1 ? true : false));
                        label.style.display = 'inline';

                        //hide span alert
                        document.getElementById('nameErrorMsg').style.visibility = 'hidden';
                    })


                });


                $('#role').change(function() {
                    var id = $(this).val();
                    //empty the dropdown
                    $('#role_id').val(id);
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
                                url: "{{ url('admin/user') }}" + '/' + id,
                                type: 'DELETE',
                                data: id,
                                success: function(response) {
                                    console.log('Success:', response)
                                    // Handle success, update the DataTable, close the modal, etc.
                                    $('#productForm').trigger("reset");
                                    table.ajax.reload();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Delete Complete',
                                        text: response.message

                                    })

                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                    Swal.fire({
                                        icon: 'warning',
                                        title: `This Application is use!`,
                                        text: data.message

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
    @endpush
@endsection
