<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <form id="productForm" name="productForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Folder Name</label><span class="text-danger" id="foldernameErrorMsg"></span>
                                <input type="text" class="form-control" name="foldername" id="foldername"
                                    placeholder="Folder Name">
                            </div>
                            <div class="form-group mb-0">

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_active" id="is_active" value="0"
                                        class="custom-control-input" aria-invalid="true" />

                                    <label class="custom-control-label" name="is_active" for="is_active">Active<div
                                            id="is_active"></div></label>
                                </div>

                            </div>
                            <!-- Hidden field to store the user ID for update -->
                            <input type="hidden" id="txtid" name="id" value="id">
                        </div>

                    </div>
                </form>
            </div>
            <!--/.col (left) -->
            <!-- right column -->
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (right) -->
</section>




<div class="modal-footer justify-content-between">

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="saveBtn" value="create-categorie"><i
            class="fas fa-save"></i>&nbsp;Save</button>
</div>
