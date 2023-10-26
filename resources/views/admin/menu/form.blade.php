<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <form id="productForm" name="productForm" class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6">

                            {{-- <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Menu Code</label>
                                <input type="text"  class="form-control" name="menu_code" id="menu_code"
                                    placeholder="Menu Code">

                            </div> --}}
                            <div class="form-group required">
                                <label for="exampleInputEmail1" class="control-label">Application</label>
                                <select class="custom-select rounded-0" name="app_id" id="application">
                                    <option value="0" disabled>--Select Site--</option>
                                    @foreach ($app as $item)
                                    <option value="{{$item->id}}">{{$item->app_name}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="hidden" id="app_id" value="app_id" name="app_id"/> --}}
                            </div>
                            <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Menu Title</label>
                                <input type="text" class="form-control" name="menu_title" id="menu_title"
                                    placeholder="Menu Title">
                            </div>
                            <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description"
                                    placeholder="Menu Code">
                            </div>
                            <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Parent Menu</label>
                                <select class="custom-select rounded-0" name="parent_id" id="menu">
                                    <option value="0" disabled>--Select Menu--</option>
                                    <option value="0" >&#xf0aa;</option>
                                    @foreach ($mparent as $item)
                                    <option value="{{$item->id}}">{{$item->menu_title}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="hidden" id="parent_id" value="parent_id" name="parent_id"/> --}}
                            </div>
                        </div>
                        <div class="col-md-6">


                            <div class="form-group">
                                <label for="exampleInputPassword1" class="control-label">Menu Icon</label>
                                <input type="text" class="form-control" name="menu_icon" id="menu_icon"
                                    placeholder="Menu Icon">
                            </div>
                            <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Menu Route</label>
                                <input type="text" class="form-control" name="menu_route" id="menu_route"
                                    placeholder="Menu Route">
                            </div>
                            <div class="form-group required">
                                <label for="exampleInputPassword1" class="control-label">Sort</label>
                                <input type="number" class="form-control" name="sort_order" id="sort_order"
                                    placeholder="Sort">
                            </div>

                            <div class="form-group mb-0">

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_active" id="is_active" value=""
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
