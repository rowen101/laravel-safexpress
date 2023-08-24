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

                        {{ Breadcrumbs::render('branch') }}

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



                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table table-bordered data-table table-hover table-striped small " width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                        <th>Site</th>
                                        <th>Branch</th>
                                        <th>SiteHead</th>
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
    @include('admin.branch.form')
    <div class="fab-container">
        <div class="button iconbutton">
            <a href="javascript:void(0)" id="createNew"><i class="fas fa-plus"></i></a>
        </div>
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
                    ajax: "{{ route('branch.index') }}",
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
                            data: 'site',
                            name: 'site'
                        },
                        {
                            data: 'branch',
                            name: 'branch'
                        },
                        {
                            data: 'sitehead',
                            name: 'sitehead'
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
                    $('#modelHeading').html("Create New {{ $title }}");
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
                        url: "{{ url('/admin/branch') }}",
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        success: function(data) {

                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Save');
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: response.success

                            })

                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#app_codeErrorMsg').text(response.responseJSON.errors.app_code);
                            $('#app_nameErrorMsg').text(response.responseJSON.errors.app_name);
                            $('#descriptionErrorMsg').text(response.responseJSON.errors
                                .description);
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
                    $.get("{{ url('admin/branch') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeading').html("Edit {{$title}}");
                        $('#saveBtn').val("edit");
                        $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Update');
                        $('#ajaxModel').modal('show');
                        $('#txtid').val(data.id);
                        $('#site').val(data.site);
                        $('#branch').val(data.branch);
                        $('#sitehead').val(data.sitehead);
                        $('#location').val(data.location);
                        $('#phone').val(data.phone);
                        $('#email').val(data.email);
                        $('#maps').val(data.maps);
                        $('#is_active').prop("checked", (data.is_active == 1 ? true : false));
                        //hide span alert
                        document.getElementById('app_codeErrorMsg').style.visibility = 'hidden';
                        document.getElementById('app_nameErrorMsg').style.visibility = 'hidden';
                        document.getElementById('descriptionErrorMsg').style.visibility = 'hidden';
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
                                url: "{{ url('admin/branch') }}" + '/' + id,
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
    @endpush
@endsection
