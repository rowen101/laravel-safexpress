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
                                        <th>Region</th>
                                        <th>Site</th>
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
                            data: 'region',
                            name: 'region'
                        },
                        {
                            data: 'site',
                            name: 'site'
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
                    $('#imgwarehouse').attr('src', '');
                    $('#image').val('');
                });




                /*------------------------------------------
                --------------------------------------------
                Create branch Code
                --------------------------------------------
                --------------------------------------------*/
                $("#productForm").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#saveBtn").text('Sending...');
                    var formData = $('#productForm').serialize();
                    $.ajax({
                        url: "{{ url('/admin/branch') }}",
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

                            // Clear the file input
                            $('#image').val('');
                           $('#imgwarehouse').attr('src', '');
                            $('#productForm').trigger("reset");
                            $('#ajaxModel').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(data) {
                            Swal.fire({
                                icon: 'warning',
                                title: `Oop Something wrong!`,
                                text: data.responseJSON.errors

                            })
                            console.log('Error:', data);
                            // $('#nameErrorMsg').text(data.responseJSON.errors.name);
                            // $('#positionErrorMsg').text(data.responseJSON.errors.position);
                            // $('#aboutErrorMsg').text(data.responseJSON.errors.about);
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
                        $('#sitehead').val(data.sitehead);
                        $('#location').val(data.location);
                        $('#phone').val(data.phone);
                         $('#geomap').val(data.geomap);
                        $('#email').val(data.email);
                        $('#region').val(data.region);
                        $('#imgwarehouse').attr('src',"{{ asset('storage/img/Branch/thumbnail') }}" + '/thumbnail_' + data.image);
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
