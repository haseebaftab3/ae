<?php
if (!isset($_SESSION)) {
    session_start();
}
require("connection.php");
if (!isset($_SESSION['U_name']) && empty($_SESSION['U_name']) && !isset($_SESSION['U_pass']) && !isset($_SESSION['U_Username']) && !isset($_SESSION['U_UserId'])) {
    echo "<script>window.location.href = 'login-register.php'</script>";
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php require("includes/head.php"); ?>
</head>

<body>
    <!-- Topbar Section Start -->
    <?php require("includes/top-bar.php"); ?>
    <!-- Topbar Section End -->

    <!-- Header Section Start -->
    <?php require("includes/header.php") ?>
    <!-- Header Section End -->

    <!-- Header Sticky Section Start -->
    <?php require("includes/header-sticky.php") ?>
    <!-- Header Sticky Section End -->

    <!-- Mobile Header Section Start -->
    <?php require("includes/mobile-header.php") ?>
    <!-- Mobile Header Section End -->


    <!-- OffCanvas Search Start -->
    <?php require("includes/search.php") ?>
    <!-- OffCanvas Search End -->

    <!-- OffCanvas Wishlist Start -->
    <?php require("includes/wishlist.php") ?>
    <!-- OffCanvas Wishlist End -->

    <!-- OffCanvas Cart Start -->
    <?php require("includes/cart.php") ?>
    <!-- OffCanvas Cart End -->

    <!-- OffCanvas Search Start -->
    <?php require("includes/search-category.php") ?>
    <!-- OffCanvas Search End -->

    <div class="offcanvas-overlay"></div>


    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="assets/images/bg/page-title-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">My Account</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- My Account Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row learts-mb-n30">

                <!-- My Account Tab List Start -->
                <div class="col-lg-4 col-12 learts-mb-30">
                    <div class="myaccount-tab-list nav">
                        <a href="#dashboad" class="active" data-toggle="tab">Dashboard <i class="far fa-home"></i></a>
                        <a href="#orders" data-toggle="tab">Orders <i class="far fa-file-alt"></i></a>
                        <!-- <a href="#download" data-toggle="tab">Download <i class="far fa-arrow-to-bottom"></i></a> -->
                        <a href="#address" data-toggle="tab">address <i class="far fa-map-marker-alt"></i></a>
                        <a href="#account-info" data-toggle="tab">Account Details <i class="far fa-user"></i></a>
                        <a href="./logout.php">Logout <i class="far fa-sign-out-alt"></i></a>
                    </div>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-8 col-12 learts-mb-30">
                    <div class="tab-content">

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade show active" id="dashboad">
                            <div class="myaccount-content dashboad">
                                <p>Hello <strong><?php echo   $_SESSION["U_Username"] ?></strong> (not <strong><?php echo   $_SESSION["U_Username"] ?></strong>? <a href="./logout.php">Log out</a>)</p>
                                <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>shipping and billing addresses</span>, and <span>edit your password and account details</span>.</p>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="orders">
                            <div class="myaccount-content order">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Order No.</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $UID = $_SESSION['U_UserId'];
                                            $OrderDetail  = "SELECT `products`.`Name` AS `User_Name`,`product_order`.`Order_ID`,`product_order`.`Sub_Total`,`product_order`.`Product_ID`,`product_order`.`Date_added`,`product_order`.`Date_added`,`product_order`.`Status` FROM `products`,`product_order` Where `products`.`ID` = `product_order`.`Product_ID` AND `product_order`.`User_ID` =$UID";
                                            $checkOrderDetail = mysqli_query($connection, $OrderDetail);
                                            if (mysqli_num_rows($checkOrderDetail) > 0) {
                                                while ($DetailRow = mysqli_fetch_array($checkOrderDetail)) {
                                            ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $i ?></td>
                                                        <td scope="row"><?php echo $DetailRow["Order_ID"] ?></td>
                                                        <td><?php echo $DetailRow["Date_added"] ?></td>
                                                        <td><?php echo $DetailRow["Status"] ?></td>
                                                        <td>Rs. <?php echo number_format($DetailRow["Sub_Total"], 2) ?></td>
                                                        <td><a href="detail.php?Product=<?php echo $DetailRow["Product_ID"] ?>">View Product</a></td>

                                                    </tr>

                                                <?php
                                                    $i++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="7">
                                                        <div class="d-flex justify-content-center">
                                                            <p>No order found, <a href="./shop.php"> <u><b> Shop Now</b> </u> </a> </p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <!-- <div class="tab-pane fade" id="download">
                            <div class="myaccount-content download">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Expire</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Haven - Free Real Estate PSD Template</td>
                                                <td>Aug 22, 2018</td>
                                                <td>Yes</td>
                                                <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                            </tr>
                                            <tr>
                                                <td>HasTech - Profolio Business Template</td>
                                                <td>Sep 12, 2018</td>
                                                <td>Never</td>
                                                <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="address">
                            <div class="myaccount-content address">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                <?php
                                $UID = $_SESSION['U_UserId'];
                                $UserDetail  = "SELECT * FROM `user_account` WHERE `ID` =$UID";
                                $checkUserDetail = mysqli_query($connection, $UserDetail);
                                ?>
                                <div class="row learts-mb-n30">
                                    <div class="col-md-6 col-12 learts-mb-30">
                                        <h4 class="title">Billing Address
                                            <!-- <a href="#" class="edit-link">edit</a> -->
                                        </h4>
                                        <address>
                                            <?php
                                            if (mysqli_num_rows($checkUserDetail) > 0) {
                                                $DetailRow = mysqli_fetch_array($checkUserDetail);
                                                if (!empty($DetailRow["Address"])) {
                                            ?>
                                                    <p><?php echo $DetailRow["Address"] ?>,<?php echo $DetailRow["City"] ?>,<?php echo $DetailRow["Postal_code"] ?></p>
                                                    <p><?php echo $DetailRow["Number"] ?></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p>No address found</p>
                                            <?php
                                                }
                                            } ?>
                                        </address>
                                    </div>
                                    <div class="col-md-6 col-12 learts-mb-30">
                                        <h4 class="title">Shipping Address
                                            <!-- <a href="#" class="edit-link">edit</a> -->
                                        </h4>
                                        <address>
                                            <?php
                                            if (mysqli_num_rows($checkUserDetail) > 0) {
                                                $DetailRow = mysqli_fetch_array($checkUserDetail);
                                                if (!empty($DetailRow["Shipping_Address	"])) {
                                            ?>
                                                    <p><?php echo $DetailRow["Shipping_Address"] ?>,<?php echo $DetailRow["City"] ?>,<?php echo $DetailRow["Postal_code"] ?></p>
                                                    <p><?php echo $DetailRow["Number"] ?></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p>No Shipping address found</p>
                                            <?php
                                                }
                                            } ?>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="account-info">
                            <div class="myaccount-content account-details">
                                <div class="account-details-form">
                                    <form action="#" class="Edit_Account_Credential">
                                        <div id="MyAccount-Alert"></div>
                                        <div class="row learts-mb-n30">
                                            <div class="col-md-12 col-12 learts-mb-30">
                                                <div class="single-input-item">
                                                    <label for="first-name">Name <abbr class="required">*</abbr></label>
                                                    <input type="text" id="first-name" name="acc-name" value="<?php echo $_SESSION["U_Username"] ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6 col-12 learts-mb-30">
                                                <div class="single-input-item">
                                                    <label for="last-name">Last Name <abbr class="required">*</abbr></label>
                                                    <input type="text" id="last-name">
                                                </div>
                                            </div> -->
                                            <div class="col-12 learts-mb-30">
                                                <label for="display-name">Display Name <abbr class="required">*</abbr></label>
                                                <input type="text" id="display-name" value="<?php echo $_SESSION["U_Username"] ?>" readonly>
                                                <p>This will be how your name will be displayed in the account section and in reviews</p>
                                            </div>
                                            <div class="col-12 learts-mb-30">
                                                <label for="email">Email Addres <abbr class="required">*</abbr></label>
                                                <input type="email" name="acc-email" id="email" value="<?php echo $_SESSION["U_name"] ?>">
                                            </div>
                                            <div class="col-12 learts-mb-30 learts-mt-30">
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <div class="row learts-mb-n30">
                                                        <div class="col-12 learts-mb-30">
                                                            <label for="current-pwd">Current password (leave blank to leave unchanged)</label>
                                                            <input type="password" name="acc-old-pass" id="current-pwd">
                                                        </div>
                                                        <div class="col-12 learts-mb-30">
                                                            <label for="new-pwd">New password (leave blank to leave unchanged)</label>
                                                            <input type="password" name="acc-pass2" id="new-pwd">
                                                        </div>
                                                        <div class="col-12 learts-mb-30">
                                                            <label for="confirm-pwd">Confirm new password</label>
                                                            <input type="password" name="acc-pass3" id="confirm-pwd">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 learts-mb-30">
                                                <button class="btn btn-dark btn-outline-hover-dark">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- Single Tab Content End -->

                    </div>
                </div> <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->

    <!-- Footer -->
    <?php require("includes/footer.php") ?>

    <!-- Modal -->
    <?php require("includes/quick-veiw.php") ?>


    <!-- JS
============================================ -->

    <?php require("includes/js.php") ?>
</body>


</html>