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

                        {{ Breadcrumbs::render('categorie') }}

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
                        <button type="submit" class="btn btn-primary" href="javascript:void(0)" id="createNewProduct"><i class="fas fa-plus"></i></button>
                      </div>

                  </div>
                <!-- /.card-tools -->
              </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Categorie</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                        <tbody>

                        </tbody>
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

</div><!--end container-->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-sm">

      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modelHeading"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
    <form id="productForm" name="productForm" class="form-horizontal">
          <div class="form-group">
            <input type="hidden" id="id" name="id"> <!-- Hidden field to store the user ID for update -->
            <input type="text" class="form-control" id="name" name="name" placeholder="Categorie">
          </div>
</form>
<div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveBtn"><i class="fas fa-save"></i>&nbsp;Save</button>
        </div>
        </div>


      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
@push('buttom')

 <script type="text/javascript">
    $(function () {

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
        ajax: "{{ url('admin/categorie') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
      $('#createNewProduct').click(function () {
          $('#saveBtn').val("create-product");
          $('#id').val('');
          $('#productForm').trigger("reset");
          $('#modelHeading').html("Create New Product");
          $('#ajaxModel').modal('show');
      });

      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.editProduct', function () {
        var id = $(this).data('id');
        $.get("{{ url('admin/categorie') }}" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Edit Product");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
        })
      });

      /*------------------------------------------
      --------------------------------------------
      Create Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('#saveBtn').click(function (e) {
          e.preventDefault();
          $(this).html('Sending..');

          $.ajax({
            data: $('#productForm').serialize(),
            url: "{{ url('admin/categorie') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {

                $('#productForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                // table.draw();

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
      });

      /*------------------------------------------
      --------------------------------------------
      Delete Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.deleteProduct', function () {

          var id = $(this).data("id");
          confirm("Are You sure want to delete !");

          $.ajax({
              type: "DELETE",
              url: "{{ url('admin/categories') }}"+'/'+id,
              success: function (data) {
                //   table.draw();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
      });

    });
  </script>

@endpush
@endsection
