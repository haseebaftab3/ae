<div class="row" class="Refresh">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Order/Dicount</h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <!-- <i class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;" data-toggle="modal" data-target="#AddOrderrModal"></i>
                        <i class="mdi mdi-refresh text-secondary pr-1  icon-refresh-tool" style="font-size: 1.7em;cursor:pointer;"></i> -->
                        <!-- <i class="mdi mdi-delete-variant text-danger pr-1" style="font-size: 1.7em;cursor:pointer;"></i> -->
                    </div>
                </div>

                <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p>
                <div id="UserAccount-Alert"></div>
                <table id="datatable-buttons" class="table Order-Table activate-select dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Product Detail</th>
                            <th>Total </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>

                            <th>Type</th>

                            <th>Bank Payment Status</th>
                            <th>Status</th>
                            <th>Consignment No.</th>
                            <th>Shipping Vendrr </th>

                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody id="Order-Table-Data"></tbody>
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
<div class="modal fade" id="ViewOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form class="needs-validation Insert_Orderr_Form" id="Insert_Order_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">See Order Detail</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center ">
                                <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                                    <div class="row">
                                        <div class="col-lg-5 d-none d-lg-block bg-register rounded-left"></div>
                                        <div class="col-lg-7">
                                            <div class="p-5">
                                                <!-- <div class="text-center mb-5">
                                                    <a href="index.html" class="text-dark font-size-22 font-family-secondary">
                                                        <i class="mdi mdi-album"></i> <b>SCOXE</b>
                                                    </a>
                                                </div> -->

                                                <div class="text-center">
                                                    <!-- <img src="assets/images/500-error.svg" alt="error" height="140"> -->
                                                    <h1 class="h4 mb-3 mt-4">Order Detail Detail</h1>
                                                    <p class="text-muted mb-4 w-75 m-auto">We are experiencing an internal server problem, please try back later.</p>
                                                    <ul class="list-group">

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Product Details:</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderPName"></p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Order Number:</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderNo">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Order's Total:</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderToal">N/A</p>
                                                        </li>

                                                        <!-- <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Product Price</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderPprice">N/A</p>
                                                        </li> -->

                                                        <!-- <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Quantity</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderPquantity">N/A</p>
                                                        </li> -->

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Customer Name</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderCname">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  ">
                                                            <h5 class="m-0">Customer Email</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderCEmail">N/A</p>
                                                        </li>

                                                        <li class="list-group-item ">
                                                            <h5 class="m-0">Customer No</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderCPhone">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Customer City</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderCCity">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Customer Address</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderCAdd">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Customer Postel Code</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderPPcode">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Shipping Method</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderSMethod">N/A</p>
                                                        </li>

                                                        <li class="list-group-item  disabled">
                                                            <h5 class="m-0">Shipping Price</h5>
                                                            <p class="pl-1 m-0 text-primary VOrderSSPrice">N/A</p>
                                                        </li>

                                                    </ul>
                                                </div>

                                                <div class="row mt-4">
                                                    <!-- <div class="col-12 text-center">
                                                        <a href="index.html" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-home mr-2"></i>Back to Home </a>
                                                    </div> -->

                                                    <!-- end col -->
                                                </div>
                                                <!-- end row -->
                                            </div> <!-- end .padding-5 -->
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div> <!-- end .w-100 -->
                            </div> <!-- end .d-flex -->
                        </div> <!-- end col-->
                    </div> <!-- end row -->
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

<div class="modal fade" id="EditOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form class="needs-validation ChangeOrderFormm" novalidate>
                <input type="hidden" name="COrderNo" class="CorderNumber">
                <input type="hidden" class="user-hidden-id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Order Status</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3 mt-3">
                                    <label for="Orderr_Parent">Category</label>
                                    <select class="custom-select OrderCrrStatus" data-toggle="select2" name="CStatuts">
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Shipped">Shipped</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Canceled">Canceled</option>
                                        <option value="Returned">Returned</option>
                                        <option value="Pending">Pending</option>
                                    </select><!-- end Select -->
                                </div>
                                <div class="col-6 mb-3 mt-3 ShowShipOpt" style="display: none;">
                                    <label>Shipping Vendor:</label>
                                    <select class="custom-select" data-toggle="select2" name="Ship_Vendor">
                                        <option value="TCS">TCS</option>
                                        <option value="Leopards">Leopards</option>
                                        <option value="Builtee">Builtee</option>
                                    </select><!-- end Select -->
                                </div>

                                <div class="col-6 mb-3 mt-3 ShowShipOpt" style="display: none;">
                                    <div class="form-group">
                                        <label>Consignment#: <span class="text-danger">*</span></label>
                                        <input type="text" name="Consignment" required class="form-control">
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
<div class="modal fade" id="ChangeShipPaidStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation ShipPaidStatusForm" novalidate>
                <input type="hidden" class="user-hidden-id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Paid Status</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3 mt-3">
                                    <label for="Orderr_Parent">Category</label>
                                    <select class="custom-select" data-toggle="select2" name="CStatuts">
                                        <option value="Paid">Paid</option>
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