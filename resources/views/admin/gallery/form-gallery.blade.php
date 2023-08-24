<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="container-fluid">


                    <br />


                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                                @csrf
                               <input type="hidden" name="parent_id"  id="parent_id"/>
                                <input type="hidden" name="foldername" id="foldername"/>
                            </form>
                            {{-- <div align="center">
                                <button type="button" class="btn btn-success" id="submit-all">Upload</button>
                            </div> --}}
                        </div>
                    </div>
                    <br />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Uploaded Image&nbsp;<button id="fethimage" class="float-right btn btn-sm btn-success"><i  class="fa fa-refresh "></i></button>
                            </div></h3>
                        <div class="panel-body" id="uploaded_image">

                        </div>
                    </div>
                </div>
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
    <button type="button" class="btn btn-primary" id="saveBtnImage" value="create-categorie"><i
            class="fas fa-save"></i>&nbsp;Save</button>
</div>
