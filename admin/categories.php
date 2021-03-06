<div class="row" class="Refresh">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Categories </h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <i class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;" data-toggle="modal" data-target="#AddCatModal"></i>
                        <i class="mdi mdi-refresh text-secondary pr-1  icon-refresh-tool" style="font-size: 1.7em;cursor:pointer;"></i>
                        <!-- <i class="mdi mdi-delete-variant text-danger pr-1" style="font-size: 1.7em;cursor:pointer;"></i> -->
                    </div>
                </div>

                <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap Cat_Table">
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox"></th> -->
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Disciption</th>
                            <th>Image</th>
                            <th>Sort Order</th>
                            <th>Visibility</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="Table_Data" id="Table_data">
                    </tbody>

                    <tbody class="preloader_refresh" id="preloader_refresh" style="display: none">
                        <tr>
                            <td colspan="7">
                                <div class="d-flex justify-content-center">
                                    <i class="mdi mdi-loading mdi-spin" style="font-size: 2em;"></i>
                                </div>
                            </td>


                        </tr>
                    </tbody>
                </table>
                <!-- Spinner -->
                <!-- e.of.Spinner -->
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<!-- Tost -->
<!-- Then put toasts within -->
<div class="toast fade hide custom-toast slide-in-right" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="position: fixed;bottom:30px;right:20px;z-index:99999!important">
    <div class="toast-header">
        <img src="assets/images/icons/user.png" alt="brand-logo" height="28" class="mr-2 rounded-circle">
        <strong class="mr-auto">
            <?php
            if (isset($_SESSION['A_Name'])) {
                echo ($_SESSION['A_UName']);
            }
            ?>
        </strong>
        <small>Just now</small>
        <button type="button" class="ml-2 mb-1 close custom-toast-dismiss" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">??</span>
        </button>
    </div>
    <div class="toast-body custom-toast-msg">
        Hello, world! This is a toast message.
    </div>
</div>
<!--end toast-->
<!-- end Tost -->
<!-- !!Modals -->
<!-- **Add Modal -->
<div class="modal fade" id="AddCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Insert_Cat_Form" id="Insert_Cat_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="Cat_Name">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" id="Cat_Name" name="Cat_Name" class="form-control" placeholder="Enter the category name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Name.
                                    </div>
                                </div><!-- end col -->

                                <div class="col-6 mb-3 mt-3">
                                    <label for="Cat_Parent">Parent Category</label>
                                    <select class="custom-select" data-toggle="select2" id="Cat_Parent" name="Cat_Parent">
                                        <option value="NULL">None</option>
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="Cat_Order">Sort Order</label>
                                        <input type="number" id="Cat_Order" name="Cat_Order" class="form-control" value="0">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-12">
                                    <input type="file" class="dropify" data-height="300" name="Cat_Img" />
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Cat_Des">Description</label>
                                        <textarea class="form-control" id="Cat_Des" name="Cat_Des" rows="3"></textarea>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-6">
                                    <div class="form-group ">
                                        <label>Visibility</label>
                                        <br>
                                        <input type="checkbox" id="Cat_Status" name="Cat_Status" checked data-toggle="switchery" data-color="#2e7ce4" value="True" />
                                    </div>
                                </div><!-- end col -->
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
<!-- **End Add Modal -->

<!-- **Edit Modal -->
<div class="modal fade" id="EditCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Edit_Cat_Form" id="Edit_Cat_Form" novalidate>
                <input type="hidden" class="Cat-ID" name="Cat-ID">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Category</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="Edit_Cat_Name">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" id="Edit_Cat_Name" name="Cat_Name" class="form-control" placeholder="Enter the category name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a valid Name.
                                    </div>
                                </div><!-- end col -->

                                <div class="col-6 mb-3 mt-3">
                                    <label for="Edit_Cat_Parent">Parent Category</label>
                                    <select class="custom-select" data-toggle="select2" id="Edit_Cat_Parent" name="Cat_Parent">
                                        <option>None</option>
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3">
                                    <div class="form-group">
                                        <label for="Edit_Cat_Order">Sort Order</label>
                                        <input type="number" id="Edit_Cat_Order" name="Cat_Order" class="form-control" value="0">
                                    </div>
                                </div><!-- end col -->

                                <div class="col-12">
                                    <input type="file" class="dropify" data-height="300" name="Cat_Img" />
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Edit_Cat_Des">Description</label>
                                        <textarea class="form-control" id="Edit_Cat_Des" name="Cat_Des" rows="3"></textarea>
                                    </div>
                                </div><!-- end col -->
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
<!-- **End Edit Modal -->


<!-- Delete Modal -->
<div class="modal fade" id="Delete_Cat_Form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Cat_Form" novalidate>
                <input type="hidden" class="Cat-ID" name="Cat-ID">


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