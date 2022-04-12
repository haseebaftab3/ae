<div class="row" class="Refresh">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Shipping Methods</h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <!-- <i class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;" data-toggle="modal" data-target="#AddCatModal"></i> -->
                        <i class="mdi mdi-refresh text-secondary pr-1  icon-refresh-tool" style="font-size: 1.7em;cursor:pointer;"></i>
                    </div>
                </div>

                <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p>

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap Ship_Table">
                    <thead>
                        <tr>
                            <!-- <th><input type="checkbox"></th> -->
                            <th>#</th>
                            <th>Type</th>
                            <th>Rate</th>
                            <th>Fule Tax</th>
                            <th>Sales Tex</th>
                            <!-- <th>Visibility</th> -->
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="Table_ShipMethod" id="Table_data">
                    </tbody>

                    <tbody class="preloader_refresh" id="preloader_refresh" style="display: none">
                        <tr>
                            <td colspan="6">
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


<!-- **Edit Modal -->
<div class="modal fade" id="EditShipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation UpdateRateData" id="UpdateRateData" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Shipping Rate</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ShipUpdtae_Alert"></div>
                    <input type="hidden" class="ShipOptionid" name="id">
                    <input type="hidden" class="ShipOptionType" name="type">
                    <div class="row">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active  FlatRatePanel" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Flat Rate</span>
                                </a>
                                <a class="nav-link TableRatePanel active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                    <span class="d-none d-lg-block">Table Rate</span>
                                </a>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-9">
                            <div class="tab-content " id="v-pills-tabContent">
                                <div class="tab-pane fade FlatRatePanel" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="col-6 ">
                                        <label for="Product_Order">
                                            Rate (in Rupees)
                                        </label>
                                        <input type="number" name="flat_rate" class="form-control FlateRateFeild" required>
                                    </div>
                                </div>
                                <!-- Table Rate -->
                                <div class="tab-pane fade TableRatePanel" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <label for="Product_Order">
                                                Fuel Tax %
                                            </label>
                                            <input type="number" name="fule_tax" class="form-control TableFuleFeild" required>
                                        </div>
                                        <div class="col-6 ">
                                            <label for="Product_Order">
                                                Sales Tax %
                                            </label>
                                            <input type="number" name="sales_tax" class="form-control TableSaleFeild" required>
                                        </div>
                                        <div class="col-6 ">
                                            <label for="Product_Order">
                                                Rate Per KG. (in Rupees)
                                            </label>
                                            <input type="number" name="table_rate" class="form-control TableRateFeild" required>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end tab-content-->
                        </div> <!-- end col-->
                    </div>
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
<div class="modal fade" id="DeleteCatRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Property_Form" id="Delete_Property_Form" novalidate>
                <input type="hidden" class="ShipOptionid" name="id">

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