<div class="row" class="Refresh">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Sales/Dicount</h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <i class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;" data-toggle="modal" data-target="#AddSalesModal"></i>
                        <i class="mdi mdi-refresh text-secondary pr-1  icon-refresh-tool" style="font-size: 1.7em;cursor:pointer;"></i>
                        <!-- <i class="mdi mdi-delete-variant text-danger pr-1" style="font-size: 1.7em;cursor:pointer;"></i> -->
                    </div>
                </div>

                <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap Sales_Table">
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox"></th> -->
                            <th>#</th>
                            <th>Name</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Off (%)</th>
                            <th>Type</th>

                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="Sales_Table_Data" id="Table_data">
                    </tbody>

                    <tbody class="preloader_refresh" id="preloader_refresh" style="display: none">
                        <tr>
                            <td colspan="8">
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
            <span aria-hidden="true">×</span>
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
<div class="modal fade" id="AddSalesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Insert_Sales_Form" id="Insert_Sales_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Set New Sale </h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div id="Ins_Sales_Alert"></div>
                                </div>
                                <div class="col-12  mt-3">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="Name" required>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-6 mb-3 mt-3">
                                    <label for="Cat_Parent">Parent Category</label>
                                    <select class="custom-select" data-toggle="select2" id="Cat_Parent" name="Category_ID">
                                        <option value="NULL">None</option>
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3">
                                    <label for="Saler_Parent">Product</label>
                                    <select class="custom-select Products_ParentDD" data-toggle="select2" name="Products_ID">
                                        <option value="NULL">None</option>
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3">
                                    <div class="form-group mb-3">
                                        <label>Date (From - To)</label>
                                        <input type="text" class="form-control date" id="daterangetime" data-toggle="daterangepicker" data-time-picker="true" data-locale="{'format': 'DD/MM hh:mm A'}" name="Date" required>
                                    </div>
                                </div><!-- end col -->

                                <div class="col-6 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" placeholder="" data-p-sign="s" class="form-control autonumber" required name="Amount">
                                        <!-- <span class="font-13 text-muted">e.g. "11%"</span> -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-6 mb-3">
                                    <label for="Saler_Parent">Product</label>
                                    <select class="custom-select " data-toggle="select2" name="Sale_Type">
                                        <option value="Normal">Normal</option>
                                        <option value="Alternate">With Price Increase</option>
                                    </select><!-- end Select -->
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
<!-- **End Add Modal -->

<!-- **Edit Modal -->
<div class="modal fade" id="EditSaleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation Update_Saler_Form" novalidate>
                <input type="hidden" class="Sales-Common-ID" name="Sales-Common-ID">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Record </h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div id="Update_Sales_Alert"></div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3 mt-3">
                                    <div class="form-group mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control Sales_Edit_Name" name="Name" required>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-6 mb-3 mt-3">
                                    <label for="Cat_Parent">Parent Category</label>
                                    <select class="custom-select ESale_Parent" data-toggle="select2" name="Category_ID">
                                        <option value="NULL">None</option>
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3">
                                    <label for="Saler_Parent">Product</label>
                                    <select class="custom-select Products_ParentDD ESale_Products" data-toggle="select2" name="Products_ID">
                                        <!-- <option value="NULL">None</option> -->
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control EsalesStartDate" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" name="StartDate">
                                    </div>
                                </div>


                                <div class="col-6 mb-3 mt-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" class="form-control EsalesEndDate" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" name="EndDate">
                                    </div>
                                </div>

                                <div class="col-6 mb-3 ">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" placeholder="" data-p-sign="s" class="form-control autonumber ESale_Values" name="Amount">
                                        <!-- <span class="font-13 text-muted">e.g. "11%"</span> -->
                                    </div>
                                </div><!-- end col -->

                                <div class="col-6 mb-3">
                                    <label for="Saler_Parent ">Type</label>
                                    <select class="custom-select SaleType_Switch" data-toggle="select2" name="Sale_Type">
                                        <option value="Normal">Normal</option>
                                        <option value="Alternate">With Price Increase</option>
                                    </select><!-- end Select -->
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
<!-- **End Edit Modal -->


<!-- Delete Modal -->
<div class="modal fade" id="DeleteSaleRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Sales_Form" id="Delete_Sales_Form" novalidate>
                <input type="hidden" class="Sales-Common-ID" name="Sales-Common-ID">

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