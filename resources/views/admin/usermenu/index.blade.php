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
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Created</th>
                                        <th>Active</th>
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

                            @include('admin.usermenu.form')

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
                    ajax: "{{ route('usermenu.index') }}",
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
                            data: 'email',
                            name: 'email'
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



                $('.menu-checkbox').on('change', function() {
                    var menuId = $(this).val();
                    var checkboxValue = $(`#checkbox-value_${menuId}`);
                    var menuTitle = $(`label[for="menu_id_${menuId}"]`).text();

                    if ($(this).is(':checked')) {
                        checkboxValue.text(menuTitle);
                    } else {
                        checkboxValue.text('');
                    }
                });

                /*------------------------------------------
                --------------------------------------------
                Create  Code
                --------------------------------------------
                --------------------------------------------*/
                $('#saveBtn').click(function(e) {
                    e.preventDefault();
                    $(this).html('Sending..');

                    // Collect the user ID
                    var userId = $('#txtid').val();

                    // Collect the selected menu IDs
                    var menuIds = [];

                    // Iterate through the checkboxes to find the checked ones
                    $('input[name="menu_id[]"]:checked').each(function() {
                        // Parse the value to an integer and then push it to the array
                        var menuId = parseInt($(this).val());
                        menuIds.push(menuId);
                    });

                    // Display the user_id and menu_id pairs in an alert
                    // var alertMessage = 'User ID: ' + userId + '\nMenu IDs: ' + menuIds.join(', ');

                    //  alert(alertMessage); // Show the alert

                    // Create the data object to send in the AJAX request
                    var data = {
                        user_id: userId,
                        menu_id: menuIds, // Use "menu_ids" to pass an array
                    };



                    $.ajax({
                        data: data,
                        url: "{{ url('/admin/usermenu') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            $('#productForm')[0].reset();
                            $('#ajaxModel').modal('hide');
                            table.ajax.reload();

                            Swal.fire({
                                icon: 'success',
                                title: 'Save Complete',
                                text: response.success
                            });
                        },
                        error: function(response) {
                            console.error('Error:', response);
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
                        $('#modelHeading').html("{{ $title }} Maintenance");
                        $('#saveBtn').val("edit-categorie");
                        $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Update');
                        $('#ajaxModel').modal('show');
                        $('#txtid').val(data[0].id);
                        $('#txtid').prop('readonly', true);
                        $('#name').val(data[0].name);
                        $('#is_active').val(data[0].is_active);
                        $('#is_active').prop("checked", (data[0].is_active == 1 ? true : false));
                        label.style.display = 'inline';

                        //hide span alert
                        document.getElementById('nameErrorMsg').style.visibility = 'hidden';
                    })


                });


                // $("#menu_id").on('change', function() {
                //     if ($(this).is(':checked')) {
                //         $('#checkbox-value').text($(this).val());
                //     } else {
                //         $('#checkbox-value').text('');
                //     }
                // });



                //is active
                $("#is_active").on('change', function() {
                    if ($(this).is(':checked')) {
                        $(this).attr('value', 1);
                    } else {
                        $(this).attr('value', 0);
                    }

                    //  $('#checkbox-value').text($('#is_active').val());
                });

                // Assuming you have an array to store the selected menu items
                var selectedMenus = [];

                // Assuming a checkbox click event
                $('input[name="menu_id"]').on('change', function() {
                    var menuId = $(this).val();

                    if ($(this).is(':checked')) {
                        // If checkbox is checked and not already in the array, add it
                        if (!selectedMenus.includes(menuId)) {
                            selectedMenus.push(menuId);
                        }
                        // Log the menuId when a checkbox is checked
                        console.log('Checkbox with menu_id ' + selectedMenus + ' is checked and user_id');
                    } else {
                        // If checkbox is unchecked and in the array, remove it
                        var index = selectedMenus.indexOf(menuId);
                        if (index !== -1) {
                            selectedMenus.splice(index, 1);
                        }
                        //console.log('Checkbox with menu_id ' + selectedMenus + ' is unchecked user_id');
                    }
                });

            });
        </script>
    @endpush
@endsection
