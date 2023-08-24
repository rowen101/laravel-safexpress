<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <form id="productForm" name="productForm" class="form-horizontal">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Site</label>
                                            <input type="text" class="form-control" name="site" id="site"
                                                placeholder="Site">
                                        </div>
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Site Head</label>
                                            <input type="text" class="form-control" name="sitehead" id="sitehead"
                                                placeholder="Site Head">
                                        </div>
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Phone no.</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                placeholder="Phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1" class="control-label">Map</label>
                                            <input type="text" class="form-control" name="maps" id="maps"
                                                placeholder="Maps">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Branch</label>
                                            <input type="text" class="form-control" name="branch" id="branch"
                                                placeholder="Branch">
                                        </div>
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Address</label>
                                            <input type="text" class="form-control" name="location" id="location"
                                                placeholder="Address">
                                        </div>
                                        <div class="form-group required">
                                            <label for="exampleInputPassword1" class="control-label">Email</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group mb-0">

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="is_active" id="is_active" value=""
                                                    class="custom-control-input" aria-invalid="true" />

                                                <label class="custom-control-label" name="is_active" for="is_active">Active <div
                                                        id="is_active"></div></label>
                                            </div>

                                        </div>
                                    </div>
                                    <input type="hidden" id="txtid" name="id" value="id">



                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveBtn"
                            value="create-categorie"><i class="fas fa-save"></i>&nbsp;Save</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
