<div class="row" class="Refresh">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-6 pt-3">
                        <h4 class="card-title">Prodcuts </h4>
                    </div>
                    <div class="col-6 text-right mb-3">
                        <i class="mdi mdi-table-row-plus-before text-primary pr-1" style="font-size: 1.7em;cursor:pointer;" data-toggle="modal" data-target="#AddProductModal"></i>
                        <i class="mdi mdi-refresh text-secondary pr-1  icon-refresh-tool" style="font-size: 1.7em;cursor:pointer;"></i>
                        <!-- <i class="mdi mdi-delete-variant text-danger pr-1" style="font-size: 1.7em;cursor:pointer;"></i> -->
                    </div>
                </div>

                <!-- <p class="card-subtitle mb-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, porro at inventore culpa ratione blanditiis asperiores tempore placeat.
                    Esse laborum totam, id nam vitae modi perferendis beatae sed? Culpa, laborum.
                </p> -->

                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap Product_Table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Model</th>
                            <th>Image</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="Product_Table_Data" id="Table_data">
                    </tbody>

                    <tbody class="preloader_refresh" id="preloader_refresh" style="display: none">
                        <tr>
                            <td colspan="5">
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
<div class="modal fade" id="AddProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form class="needs-validation Insert_Product_Form" id="Insert_Product_Form" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div id="Insert-Alert"></div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">General</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">Data</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#SEO" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">SEO</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#settings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">Image</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Options" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">Options</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content pt-3">
                                    <div class="tab-pane fade show active" id="home1">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Product Name <span class="text-danger">*</span></label>
                                                <input type="text" name="Name" class="form-control" placeholder="Product Name" maxlength="255" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Product Name must be greater than 1 and less than 255 characters!
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mt-3">
                                                <label>Model <span class="text-danger">*</span></label>
                                                <input type="text" name="Model" class="form-control" placeholder="Model" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Product Model must be greater than 1 and less than 64 characters!
                                                </div>

                                            </div><!-- end col -->

                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="Product_Order">
                                                        Meta Tag Title <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="MetaTitle" class="form-control" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Meta Title must be greater than 1 and less than 255 characters!
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="Product_Order">
                                                        Shipping Price <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="ShippingPrice" class="form-control" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Shipping Price must be greater than 1 and less than 255 characters!
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-3 mt-3">
                                                <label for="Cat_Parent">Parent Category</label>
                                                <select class="custom-select" data-toggle="select2" id="Cat_Parent" name="Product_Parent">
                                                    <option value="NULL">None</option>
                                                </select><!-- end Select -->
                                            </div>

                                            <div class="col-6 mb-3 mt-3">
                                                <div class="form-group">
                                                    <label>Total Price<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Price In Ruppes" name="Price" required class="form-control">
                                                </div>
                                            </div><!-- end col -->


                                            <!-- Unit Quantity -->
                                            <div class="col-6 mb-3 mt-3">
                                                <div class="form-group">
                                                    <label>Unit Quantity<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Quantity" name="Unit_Quantity" required class="form-control">
                                                </div>
                                            </div><!-- end col -->

                                            <!-- Unit Price -->
                                            <div class="col-6 mb-3 mt-3">
                                                <div class="form-group">
                                                    <label>Unit Price<span class="text-danger">*</span></label>
                                                    <input type="number" placeholder="Unit Price" name="Unit_Price" required class="form-control">
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="Discription" rows="3"></textarea>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6">
                                                <div class="form-group ">
                                                    <label>Status</label>
                                                    <br>
                                                    <input type="checkbox" name="Status" checked data-toggle="switchery" data-color="#2e7ce4" value="1" />
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                    </div>

                                    <!-- Data -->
                                    <div class="tab-pane fade" id="profile1">
                                        <div class="row">

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Manufacturer</label>
                                                    <select class="form-control Manufacture_ParentDD" name="Manufacture" data-toggle="select2" style="width: 100%!important">

                                                    </select>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Sort Order</label>
                                                    <input type="number" name="SortOrder" class="form-control" value="0">
                                                </div>
                                            </div><!-- end col -->

                                            <!-- Quantity -->
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Quantity</label>
                                                    <input type="number" name="Quantity" class="form-control" value="1">
                                                </div>
                                            </div><!-- end col -->

                                            <!-- Min .Quantity -->
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Minimum Quantity <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Force a minimum ordered amount"></i></label>
                                                    <input type="number" name="MinQuantity" class="form-control" value="1">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Subtract Stock</label>
                                                    <div class="mt-1">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="StockRadio" value="Yes" name="SubStock" class="custom-control-input" checked>
                                                            <label class="custom-control-label" for="StockRadio">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="StockRadio1" value="No" name="SubStock" class="custom-control-input">
                                                            <label class="custom-control-label" for="StockRadio1">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Shipping</label>
                                                    <div class="mt-1">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="ShipRadio" value="Yes" name="Shipping" class="custom-control-input" checked>
                                                            <label class="custom-control-label" for="ShipRadio">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="ShipRadio1" value="No" name="Shipping" class="custom-control-input">
                                                            <label class="custom-control-label" for="ShipRadio1">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Out Of Stock Status <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Status shown when a product is out of stock"></i></label>
                                                    <select class="form-control" name="StockStatus">
                                                        <option value="2-3Days">2-3 Days</option>
                                                        <option value="InStock">In Stock</option>
                                                        <option value="OutOfStock">Out Of Stock</option>
                                                        <option value="PreOrder">Pre-Order</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Date Available
                                                    </label>
                                                    <input type="text" name="DateAv" class="form-control" data-provide="datepicker">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-12 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Dimensions (L x W x H)
                                                    </label>
                                                    <div class="form-row align-items-center">
                                                        <div class="col-4">
                                                            <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Length" name="Length">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Width" name="Width">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="height" name="Height">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">
                                                        Length Class
                                                    </label>
                                                    <select name="LengthClass" class="form-control">
                                                        <option value="Centimeter" selected="selected">Centimeter</option>
                                                        <option value="Centimeter">Centimeter</option>
                                                        <option value="Inch">Inch</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Weight
                                                    </label>
                                                    <input type="num" name="Weight" class="form-control">
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-12 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Weight Class
                                                    </label>
                                                    <select name="WeightClass" class="form-control">
                                                        <option value="Kilogram" selected="selected">Kilogram</option>
                                                        <option value="Gram<">Gram</option>
                                                        <option value="Pound">Pound </option>
                                                        <option value="Ounce">Ounce</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->

                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="tab-pane fade" id="settings1">
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Thumbnail</label>
                                                <input type="file" class="dropify" data-height="200" name="Img" />
                                            </div>
                                            <div class="col-6">
                                                <label>Additional Images (Multiple Images)</label>
                                                <input type="file" class="dropify" data-height="200" name="Add_Img[]" multiple />
                                            </div>
                                            <!-- <br />
                                        <div class="card ">
                                            <div class="card-body">
                                                <h4 class="">Additional Images</h4>
                                            </div>
                                            <table class="table-bordered table-hover">
                                                <tr>
                                                    <th class="text-center">Additional Image</th>
                                                    <th class="text-center">Sort Order</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                <tr class="p-3">
                                                    <td>
                                                        <div class="col-12">
                                                            <input type="file" class="dropify" data-default-file="assets/images/media/sm-6.jpg">
                                                        </div>
                                                    </td>
                                                    <th>
                                                        <input type="text" name="Product_Name" class="form-control" placeholder="Model" required>
                                                    </th>
                                                    <th class="">
                                                        <center>
                                                            <a href="#">
                                                                <i class="mdi mdi-image-plus text-info" id="" style="font-size: 2.4em"></i>
                                                            </a>
                                                        </center>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div> -->
                                        </div>
                                    </div>

                                    <!-- SEO -->
                                    <div class="tab-pane fade" id="SEO">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Meta Tag Description</label>
                                                <textarea class="form-control" name="MetaDiscription" rows="3"></textarea>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Meta Tag Keywords</label>
                                                <textarea class="form-control" name="MetaKeywords" rows="3"></textarea>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Product Tags <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Comma separated"></i></label>
                                                <input type="text" name="ProductTag" class="form-control">
                                            </div>
                                        </div><!-- end col -->

                                    </div>

                                    <!-- Options-->
                                    <div class="tab-pane fade" id="Options">
                                        <div class="row">
                                            <div class="col-sm-3 mb-2 mb-sm-0">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                        <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                                        <span class="d-none d-lg-block">Color</span>
                                                    </a>
                                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                        <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                                        <span class="d-none d-lg-block">Size</span>
                                                    </a>
                                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile_main2" role="tab" aria-controls="v-pills-profile_main2" aria-selected="false">
                                                        <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                                        <span class="d-none d-lg-block">Amp</span>
                                                    </a>
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-sm-9">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                        <div class="col-6 ">
                                                            <label for="Product_Order">
                                                                Default Color
                                                            </label>
                                                            <input type="text" name="DefaultColor" class="form-control">
                                                        </div>
                                                        <div class="col-6 ">
                                                            <label for="Product_Order">
                                                                Default Hcode
                                                            </label>
                                                            <input type="text" name="DefaultHcode" class="form-control">
                                                        </div>
                                                        <div class="col-12 text-right mb-1">
                                                            <i class="mdi mdi-plus-circle text-primary pr-1 AddDyColor" style="font-size: 1.7em;cursor:pointer;"></i>
                                                        </div>
                                                        <div class="row Color_InputAdmin">
                                                            <div class="col-12 border p-2">
                                                                <!-- <i class="mdi mdi-minus-circle text-danger pr-1 AddDyColor" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;"></i> -->
                                                                <div class="row">
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Name
                                                                        </label>
                                                                        <input type="text" name="Color[]" class="form-control">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Price (+ / -)
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Color_Value[]" class="form-control ">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Colorcode
                                                                        </label>
                                                                        <input type="text" placeholder="" name="ColorCode[]" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Size -->
                                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                        <div class="col-6 ">
                                                            <label for="Product_Order">
                                                                Default Size
                                                            </label>
                                                            <input type="text" name="DefaultSize" class="form-control" required>
                                                        </div>
                                                        <div class="col-12 text-right mb-1">
                                                            <i class="mdi mdi-plus-circle text-primary pr-1 AddDySize" style="font-size: 1.7em;cursor:pointer;"></i>
                                                        </div>
                                                        <div class="row Size_InputAdmin">
                                                            <div class="col-12 border p-2">
                                                                <!-- <i class="mdi mdi-minus-circle text-danger pr-1 AddDyColor" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;"></i> -->
                                                                <div class="row">
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Name
                                                                        </label>
                                                                        <input type="text" name="Size[]" class="form-control">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Price (+ / -)
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Size_Value[]" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Amp -->
                                                    <div class="tab-pane fade" id="v-pills-profile_main2" role="tabpanel" aria-labelledby="v-pills-profile-tab1">
                                                        <div class="col-6 ">
                                                            <label for="Product_Order">
                                                                Default Amp
                                                            </label>
                                                            <input type="text" name="DefaultAmp" class="form-control" required>
                                                        </div>
                                                        <div class="col-12 text-right mb-1">
                                                            <i class="mdi mdi-plus-circle text-primary pr-1 AddDyAmp" style="font-size: 1.7em;cursor:pointer;"></i>
                                                        </div>
                                                        <div class="row Amp_InputAdmin">
                                                            <div class="col-12 border p-2">
                                                                <!-- <i class="mdi mdi-minus-circle text-danger pr-1 AddDyColor" style="position: absolute;bottom:-12px;left:-12px; font-size: 1.7em;cursor:pointer;"></i> -->
                                                                <div class="row">
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Name
                                                                        </label>
                                                                        <input type="text" name="Amp[]" class="form-control">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Price (Total)
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Amp_Value[]" class="form-control ">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Quantity
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Amp_Quantity[]" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- end tab-content-->
                                            </div> <!-- end col-->
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

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
<div class="modal fade " id="EditProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form class="needs-validation Edit_Product_Form" id="Edit_Product_Form" novalidate>
                <input type="hidden" class="PUse-ID" name="ID">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="col-12">
                        <div id="E-PAlerts"></div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#Ehome1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">General</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Eprofile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">Data</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#ESEO" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">SEO</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#Esettings1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">Image</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#EOptions" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block"></i>
                                            <span class="d-none d-lg-block">Options</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content pt-3">
                                    <div class="tab-pane fade show active" id="Ehome1">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Product Name <span class="text-danger">*</span></label>
                                                <input type="text" name="Name" class="form-control" id="EProductName" placeholder="Product Name" maxlength="255" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Product Name must be greater than 1 and less than 255 characters!
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mt-3">
                                                <label>Model <span class="text-danger">*</span></label>
                                                <input type="text" name="Model" class="form-control" id="EProductModel" placeholder="Model" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Product Model must be greater than 1 and less than 64 characters!
                                                </div>

                                            </div><!-- end col -->

                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="Product_Order">
                                                        Meta Tag Title <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="MetaTitle" id="EProductMetalTitle" class="form-control" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Meta Title must be greater than 1 and less than 255 characters!
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="Product_Order">
                                                        Shipping Price <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="ShippingPrice" class="form-control EShippingPrice" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Shipping Price must be greater than 1 and less than 255 characters!
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-6 mb-3 mt-3">
                                                <label for="Cat_Parent">Parent Category</label>
                                                <select class="custom-select Cat_Parent" data-toggle="select2" id="ECatAppend" name="Product_Parent">
                                                    <!-- <option value="NULL">None</option> -->
                                                </select><!-- end Select -->
                                            </div>
                                            <div class="col-6 mb-3 mt-3">
                                                <div class="form-group">
                                                    <label>Price<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Price In Ruppes" name="Price" id="EProductPrice" required class="form-control ">
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-6 mb-3 mt-3">
                                                <div class="form-group">
                                                    <label>Unit Quantity<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Per Piece Quantity" name="UnitQuantity" id="EUnitQuantity" class="form-control ">
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-6 mb-3 mt-3">
                                                <div class="form-group">
                                                    <label>Unit Price<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Per unit Price" name="UnitPrice" id="EUnitPrice" class="form-control ">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" name="Discription" id="EProductDiscription" rows="3"></textarea>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6">
                                                <div class="form-group ">
                                                    <label>Status</label>
                                                    <br>
                                                    <input type="checkbox" name="Status" checked data-toggle="switchery" id="EProductStatus" data-color="#2e7ce4" value="1" />
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                    </div>

                                    <!-- Data -->
                                    <div class="tab-pane fade" id="Eprofile1">
                                        <div class="row">

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Manufacturer</label>
                                                    <select class="form-control Manufacture_ParentDD EProductManufacture_ParentDD" name="Manufacture" data-toggle="select2" style="width: 100%!important">

                                                    </select>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Sort Order</label>
                                                    <input type="number" name="SortOrder" id="EProduct_SortOrder" class="form-control" value="0">
                                                </div>
                                            </div><!-- end col -->

                                            <!-- Quantity -->
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Quantity</label>
                                                    <input type="number" name="Quantity" id="EProduct_Quantity" class="form-control" value="1">
                                                </div>
                                            </div><!-- end col -->

                                            <!-- Min .Quantity -->
                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Minimum Quantity <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Force a minimum ordered amount"></i></label>
                                                    <input type="number" name="MinQuantity" id="EProduct_MinQuantity" class="form-control" value="1">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Subtract Stock</label>
                                                    <div class="mt-1">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="EStockRadio" value="Yes" name="SubStock" class="custom-control-input" checked>
                                                            <label class="custom-control-label" for="EStockRadio">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="EStockRadio1" value="No" name="SubStock" class="custom-control-input">
                                                            <label class="custom-control-label" for="EStockRadio1">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Shipping</label>
                                                    <div class="mt-1">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="EShipRadio" value="Yes" name="Shipping" class="custom-control-input" checked>
                                                            <label class="custom-control-label" for="ShipRadio">Yes</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="EShipRadio1" value="No" name="Shipping" class="custom-control-input">
                                                            <label class="custom-control-label" for="ShipRadio1">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Out Of Stock Status <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Status shown when a product is out of stock"></i></label>
                                                    <select class="form-control" name="StockStatus" id="EProduct_StockStatus">
                                                        <option value="2-3Days">2-3 Days</option>
                                                        <option value="InStock">In Stock</option>
                                                        <option value="OutOfStock">Out Of Stock</option>
                                                        <option value="PreOrder">Pre-Order</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Date Available
                                                    </label>
                                                    <input type="text" name="DateAv" id="EProduct_DateAv" class="form-control" data-provide="datepicker">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-12 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Dimensions (L x W x H)
                                                    </label>
                                                    <div class="form-row align-items-center">
                                                        <div class="col-4">
                                                            <input type="text" class="form-control mb-2 EProduct_Length" id="inlineFormInput" placeholder="Length" name="Length">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" class="form-control mb-2 EProduct_Width" id="inlineFormInput" placeholder="Width" name="Width">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" class="form-control mb-2 EProduct_height" id="inlineFormInput" placeholder="height" name="Height">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">
                                                        Length Class
                                                    </label>
                                                    <select name="LengthClass" class="form-control" id="EProduct_LengthClass">
                                                        <option value="Centimeter" selected="selected">Centimeter</option>
                                                        <option value="Inch">Inch</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-6 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Weight
                                                    </label>
                                                    <input type="num" name="Weight" id="EProduct_Weight" class="form-control">
                                                </div>
                                            </div><!-- end col -->


                                            <div class="col-12 mb-2 mt-2">
                                                <div class="form-group">
                                                    <label for="Product_Order">Weight Class
                                                    </label>
                                                    <select name="WeightClass" id="WeightClass" class="form-control">
                                                        <option value="Kilogram" selected="selected">Kilogram</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->

                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="tab-pane fade" id="Esettings1">
                                        <div class="row Load_ChangeImage">
                                        </div>
                                    </div>

                                    <!-- SEO -->
                                    <div class="tab-pane fade" id="ESEO">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Meta Tag Description</label>
                                                <textarea class="form-control" name="MetaDiscription" id="EMetaDiscription" rows="3"></textarea>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Meta Tag Keywords</label>
                                                <textarea class="form-control" name="MetaKeywords" id="EMetaKeywords" rows="3"></textarea>
                                            </div>
                                        </div><!-- end col -->

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Product Tags <i class="far fa-question-circle" data-toggle="tooltip" data-placement="right" title="" data-original-title="Comma separated"></i></label>
                                                <input type="text" name="ProductTag" class="form-control" id="EProductTag">
                                            </div>
                                        </div><!-- end col -->

                                    </div>

                                    <!-- Options-->
                                    <div class="tab-pane fade" id="EOptions">
                                        <div class="row">
                                            <div class="col-sm-3 mb-2 mb-sm-0">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home1" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                        <i class="mdi mdi-home-variant d-lg-none d-block"></i>
                                                        <span class="d-none d-lg-block">Color</span>
                                                    </a>
                                                    <a class="nav-link" id="v-pills-profile-tab1" data-toggle="pill" href="#v-pills-profile1" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                        <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                                        <span class="d-none d-lg-block">Size</span>
                                                    </a>
                                                    <a class="nav-link" id="v-pills-profile-tab1" data-toggle="pill" href="#v-pills-profile2" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                        <i class="mdi mdi-account-circle d-lg-none d-block"></i>
                                                        <span class="d-none d-lg-block">Amp</span>
                                                    </a>
                                                </div>
                                            </div> <!-- end col-->

                                            <div class="col-sm-9">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <div class="tab-pane fade active show" id="v-pills-home1" role="tabpanel" aria-labelledby="v-pills-home-tab1">
                                                        <!-- Color -->
                                                        <div class="row">
                                                            <div class="col-6 ">
                                                                <label for="Product_Order">
                                                                    Default Color
                                                                </label>
                                                                <input type="text" name="DefaultColor" class="form-control EDefaultColor">
                                                            </div>
                                                            <div class="col-6 ">
                                                                <label for="Product_Order">
                                                                    Default Color Code
                                                                </label>
                                                                <input type="text" name="DefaultColorHex" class="form-control EDefaultColorHex">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-right mb-1">
                                                            <i class="mdi mdi-plus-circle text-primary pr-1 AddDyColor" style="font-size: 1.7em;cursor:pointer;"></i>
                                                        </div>
                                                        <div class="row EColor_InputAdmin">
                                                            <!-- <div class="col-12 border p-2">
                                                                <div class="row">
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Name
                                                                        </label>
                                                                        <input type="text" name="Color[]" class="form-control">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Price (+ / -)
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Color_Value[]" class="form-control ">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Colorcode
                                                                        </label>
                                                                        <input type="text" placeholder="" name="ColorCode[]" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>

                                                    <!-- Size -->
                                                    <div class="tab-pane fade" id="v-pills-profile1" role="tabpanel" aria-labelledby="v-pills-profile-tab1">
                                                        <div class="col-6 ">
                                                            <label for="Product_Order">
                                                                Default Size
                                                            </label>
                                                            <input type="text" name="DefaultSize" class="form-control EDefaultSize" required>
                                                        </div>
                                                        <div class="col-12 text-right mb-1">
                                                            <i class="mdi mdi-plus-circle text-primary pr-1 AddDySize" style="font-size: 1.7em;cursor:pointer;"></i>
                                                        </div>
                                                        <div class="row ESize_InputAdmin">
                                                            <!-- <div class="col-12 border p-2">
                                                                <div class="row">
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Name
                                                                        </label>
                                                                        <input type="text" name="Size[]" class="form-control">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Price (+ / -)
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Size_Value[]" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>


                                                    <!-- Amp -->
                                                    <div class="tab-pane fade" id="v-pills-profile2" role="tabpanel" aria-labelledby="v-pills-profile-tab1">
                                                        <div class="col-6 ">
                                                            <label for="Product_Order">
                                                                Default Amp
                                                            </label>
                                                            <input type="text" name="DefaultAmp" class="form-control EDefaultAmp" required>
                                                        </div>
                                                        <div class="col-12 text-right mb-1">
                                                            <i class="mdi mdi-plus-circle text-primary pr-1 AddDyAmp" style="font-size: 1.7em;cursor:pointer;"></i>
                                                        </div>
                                                        <div class="row EAmp_InputAdmin">
                                                            <!-- <div class="col-12 border p-2">
                                                                <div class="row">
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Name
                                                                        </label>
                                                                        <input type="text" name="Amp[]" class="form-control">
                                                                    </div>
                                                                    <div class="col-6 ">
                                                                        <label for="Product_Order">
                                                                            Price (+ / -)
                                                                        </label>
                                                                        <input type="text" placeholder="" name="Amp_Value[]" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>

                                                </div> <!-- end tab-content-->
                                            </div> <!-- end col-->
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

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
<div class="modal fade" id="DeleteProductRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form class="needs-validation Delete_Product_Form" id="Delete_Product_Form" novalidate>
                <input type="hidden" class="Product-Common-ID" name="id">

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