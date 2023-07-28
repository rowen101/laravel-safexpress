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
                    <div class="card-header">

                        <div class="card-tools">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success" href="javascript:void(0)"
                                    id="createNewCategory"><i class="fas fa-plus"></i></button>
                            </div>

                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th></th>
                                    <th>Categorie</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                        </div>
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
        <div class="modal-dialog modal-sm">

            <div class="modal-content">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">

                            <!-- Hidden field to store the user ID for update -->
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Categorie">
                        </div>
                        <input type="hidden" id="txtcat_id" name="id" value="id">


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
    @push('buttom')
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
                            data: 'name',
                            name: 'name'
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
                    $('#txtcat_id').val('');
                    $('#productForm').trigger("reset");
                    $('#modelHeading').html("Create New Categorie");
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

                        },
                        error: function(data) {
                            console.log('Error:', data);

                        }
                    });
                });
                /*------------------------------------------
                      --------------------------------------------
                      Click to Edit Button
                      --------------------------------------------
                      --------------------------------------------*/
                $('body').on('click', '.editCategorie', function() {
                    var id = $(this).data('id');
                    $.get("{{ url('admin/branch') }}" + '/' + id + '/edit', function(data) {
                        $('#modelHeading').html("Edit Categorie");
                        $('#saveBtn').val("edit-categorie");
                        $('#saveBtn').html('<i class="fas fa-save"></i>&nbsp;Update');
                        $('#ajaxModel').modal('show');
                        $('#txtcat_id').val(data.id);
                        $('#name').val(data.name);
                    })


                });


                /*------------------------------------------
                  --------------------------------------------
                  delete Click Button
                  --------------------------------------------
                  --------------------------------------------*/
                $('body').on('click', '.deleteCategorie', function() {
                    var id = $(this).data('id');
                    var deleteConfirm = confirm("Are you sure?");

                    if (deleteConfirm == true) {

                        //AJAX
                        $.ajax({
                            url: "{{ url('admin/branch') }}" + '/' + id,
                            type: 'DELETE',
                            data: id,
                            success: function(response) {
                                // Handle success, update the DataTable, close the modal, etc.
                                $('#productForm').trigger("reset");
                                table.ajax.reload();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                                $('#saveBtn').html('Update Changes');
                            }
                        });
                    }
                });


            });
        </script>
    @endpush
@endsection
