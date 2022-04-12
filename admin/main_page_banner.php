<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Main Page Banner</h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <i data-toggle="modal" data-target="#AddBannerRecord" class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;"></i>
                    </div>
                </div>

                <p class="card-subtitle mb-4">
                    Main Page Banner
                </p>
                <div class="m-3" id="Banner-Delete-Alert"></div>
                <table id="datatable-buttons" class="table Banner-Table activate-select dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Image</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody id="Banner-Table-Data"></tbody>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>



<!-- Insert Modal -->
<div class="modal fade" id="AddBannerRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Insert_Banner_Form" id="Insert_Banner_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Banner</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="mr-3 ml-3" id="Insert-Banner-Alert"> </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-12 mb-3">
                                    <label>Image<span class="text-danger">*</span></label>
                                    <input type="file" class="dropify" data-height="300" name="image" />
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div><!-- end row -->
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn  btn-outline-warning waves-effect waves-light">Reset</button>
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Create</button>
                </div>
            </form><!-- end form -->
        </div>
    </div>
</div>





<!-- Edit Modal -->
<div class="modal fade" id="EditBannerRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Edit_Banner_Form" id="Edit_Banner_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="mr-3 ml-3" id="Edit-Banner-Alert"> </div>
                        <input type="hidden" class="Banner-Common-ID" name="id">
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-12 mb-3">
                                    <label>Image<span class="text-danger">*</span></label>
                                    <input type="file" id="EBanner_Image" class="dropify" data-height="300" name="image" />
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                    </div><!-- end row -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light">Save changes</button>
                </div>
            </form><!-- end form -->
        </div>
    </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="DeleteBannerRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Banner_Form" id="Delete_Banner_Form" novalidate>
                <input type="hidden" class="Banner-Common-ID" name="id">
                <input type="hidden" class="Banner-Common-Image" name="image">
                <div class="modal-body p-3">
                    <div class="col-12 m-3">
                        <i class="mdi mdi-bell-alert-outline d-flex justify-content-center text-warning" style="font-size: 5em;"></i>
                    </div>
                    <div class="col-12 m-3">
                        <h1 class=" text-center">Are you sure?</h1>
                        <p class=" text-center">You won't be able to revert this!</p>
                    </div>
                    <div class="col-12  d-flex justify-content-center m-3">
                        <button type="button" class="btn btn-outline-secondary waves-effect waves-light mr-1 btn-lg" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-lg waves-effect waves-light">Delete</button>
                    </div>
                </div>
            </form><!-- end form -->
        </div>
    </div>
</div>