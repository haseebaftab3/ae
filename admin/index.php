<?php
session_start();
?>
<?php
//session
if (
    !isset($_SESSION['A_Name'])      && empty($_SESSION['A_Name'])
    && !isset($_SESSION['A_Pass'])   && empty($_SESSION['A_Pass'])
    && !isset($_SESSION['A_UName'])  && empty($_SESSION['A_UName'])
    && !isset($_SESSION['A_Pass'])   && empty($_SESSION['A_Pass'])
    && !isset($_SESSION['A_UName'])  && empty($_SESSION['A_UName'])
    && !isset($_SESSION['A_UserId']) && empty($_SESSION['A_UserId'])
) {
    header("Location:login.php");
} else if (!isset($_SESSION['A_Pass']) && isset($_SESSION['A_Name'])) {
    header("Location:lock-screen.php");
}
require("includes/head.php");
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body class="darkmode--activated">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php require("includes/header.php") ?>

        <!-- ========== Left Sidebar Start ========== -->
        <?php require("includes/sidebar.php") ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content ">
                <!-- container-fluid -->
                <?php
                if (isset($_GET["manage"])) {
                    if ($_GET['manage'] == "categories") {
                        require("categories.php");
                    } else if ($_GET['manage'] == "products") {
                        require("products.php");
                    } else if ($_GET['manage'] == "sale") {
                        require("sale.php");
                    } else if ($_GET['manage'] == "reviews") {
                        require("reviews.php");
                    } else if ($_GET['manage'] == "manufacturers") {
                        require("manufacturers.php");
                    } else if ($_GET['manage'] == "slider") {
                        require("slider.php");
                    } else if ($_GET['manage'] == "shipping-methods") {
                        require("shipping-methods.php");
                    } else if ($_GET['manage'] == "user-accounts") {
                        require("user-accounts.php");
                    } else if ($_GET['manage'] == "ads") {
                        require("ads.php");
                    } else if ($_GET['manage'] == "order") {
                        require("order.php");
                    } else  if ($_GET['manage'] == "Site_Reviews") {
                        require("site-reviews.php");
                    } else  if ($_GET['manage'] == "ShopCatImg") {
                        require("site-reviews.php");
                    }else  if ($_GET['manage'] == "main_page_banner") {
                        require("main_page_banner.php");
                    }
                } else {
                ?>
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="text-uppercase font-size-12 text-muted mb-3">TOTAL SALES</h6>
                                                        <?php
                                                        $TotalSum = "SELECT IFNULL(SUM(`Sub_Total`),0) AS `Total` FROM `product_order`";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);
                                                        ?>
                                                        <span class="h3 mb-0"> Rs.<?php echo number_format($rowSum["Total"]) ?> </span>
                                                    </div>
                                                    <?php
                                                    $TotalSum = "SELECT IFNULL(SUM(`Sub_Total`),0) FROM `product_order` where (`Date_added`> DATE_ADD(Now(), INTERVAL - 30 DAY))";
                                                    $Check_sum = mysqli_query($connection, $TotalSum);
                                                    $rowSum = mysqli_fetch_array($Check_sum);

                                                    $TotalComp = "SELECT IFNULL(SUM(`Sub_Total`),0) FROM `product_order`  where (`Date_added`> DATE_ADD(Now(), INTERVAL - 60 DAY)) AND (`Date_added`< DATE_ADD(Now(), INTERVAL - 31 DAY))";
                                                    $Check_Comp = mysqli_query($connection, $TotalComp);
                                                    $rowComp = mysqli_fetch_array($Check_Comp);

                                                    $TotalPer = "SELECT IFNULL(SUM(`Sub_Total`),0) FROM `product_order`";
                                                    $Check_Per = mysqli_query($connection, $TotalPer);
                                                    $rowPer = mysqli_fetch_array($Check_Per);

                                                    $result = $rowSum[0] - $rowComp[0];
                                                    if ($rowPer[0] == 0) {
                                                        $result = 0;
                                                    } else {
                                                        $result = ($result / $rowPer[0]) * 100;
                                                    }                                                      ?>
                                                    <?php if ($result > 0) {
                                                    ?>
                                                        <span class="badge badge-soft-success">+<?php echo number_format($result)  ?>%</span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="badge badge-soft-danger"><?php echo  number_format($result) ?>%</span>
                                                    <?php
                                                    } ?>

                                                </div> <!-- end row -->

                                                <div id="sparkline1" class="mt-3"></div>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="text-uppercase font-size-12 text-muted mb-3">TOTAL ORDERS</h6>
                                                        <?php
                                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `product_order`";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);
                                                        ?>
                                                        <span class="h3 mb-0"><?php echo number_format($rowSum[0]) ?> </span>

                                                    </div>
                                                    <div class="col-auto">
                                                        <?php
                                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `product_order` where (`Date_added`> DATE_ADD(Now(), INTERVAL - 30 DAY))";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);

                                                        $TotalComp = "SELECT IFNULL(COUNT(*),0) FROM `product_order`  where (`Date_added`> DATE_ADD(Now(), INTERVAL - 60 DAY)) AND (`Date_added`< DATE_ADD(Now(), INTERVAL - 31 DAY))";
                                                        $Check_Comp = mysqli_query($connection, $TotalComp);
                                                        $rowComp = mysqli_fetch_array($Check_Comp);

                                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `product_order`";
                                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                                        $rowPer = mysqli_fetch_array($Check_Per);

                                                        $result = $rowSum[0] - $rowComp[0];
                                                        if ($rowPer[0] == 0) {
                                                            $result = 0;
                                                        } else {
                                                            $result = ($result / $rowPer[0]) * 100;
                                                        }                                                       ?>
                                                        <?php if ($result > 0) {
                                                        ?>
                                                            <span class="badge badge-soft-success">+<?php echo number_format($result)  ?>%</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge badge-soft-danger"><?php echo  number_format($result) ?>%</span>
                                                        <?php
                                                        } ?>

                                                    </div>
                                                </div> <!-- end row -->

                                                <div id="sparkline2" class="mt-3"></div>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="text-uppercase font-size-12 text-muted mb-3">TOTAL CUSTOMERS</h6>
                                                        <span class="h3 mb-0"> Rs.8,451.28 </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <span class="badge badge-soft-success">+3.5%</span>
                                                    </div>
                                                </div> -->
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="text-uppercase font-size-12 text-muted mb-3">TOTAL CUSTOMERS</h6>
                                                        <?php
                                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `user_account`";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);
                                                        ?>
                                                        <span class="h3 mb-0"><?php echo number_format($rowSum[0]) ?> </span>

                                                    </div>
                                                    <div class="col-auto">
                                                        <?php
                                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `user_account` where (`Date_Added`> DATE_ADD(Now(), INTERVAL - 30 DAY))";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);

                                                        $TotalComp = "SELECT IFNULL(COUNT(*),0) FROM `user_account`  where (`Date_Added`> DATE_ADD(Now(), INTERVAL - 60 DAY)) AND (`Date_Added`< DATE_ADD(Now(), INTERVAL - 31 DAY))";
                                                        $Check_Comp = mysqli_query($connection, $TotalComp);
                                                        $rowComp = mysqli_fetch_array($Check_Comp);

                                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `user_account`";
                                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                                        $rowPer = mysqli_fetch_array($Check_Per);

                                                        $result = $rowSum[0] - $rowComp[0];
                                                        if ($rowPer[0] == 0) {
                                                            $result = 0;
                                                        } else {
                                                            $result = ($result / $rowPer[0]) * 100;
                                                        }                                                   ?>
                                                        <?php if ($result > 0) {
                                                        ?>
                                                            <span class="badge badge-soft-success">+<?php echo number_format($result)  ?>%</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge badge-soft-danger"><?php echo  number_format($result) ?>%</span>
                                                        <?php
                                                        } ?>

                                                    </div>
                                                </div>
                                                <div id="sparkline3" class="mt-3"></div>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <h6 class="text-uppercase font-size-12 text-muted mb-3">WEBSITE VIEWS</h6>
                                                        <?php
                                                        $TotalSum = "SELECT Sum(`totalvisit`) AS `Total Visit` FROM `totalview` ";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);


                                                        // $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `totalview`";
                                                        // $Check_Per = mysqli_query($connection, $TotalPer);
                                                        // $rowPer = mysqli_fetch_array($Check_Per);


                                                        // $result = ($rowSum[0] / $rowPer[0]) * 100;
                                                        ?>
                                                        <span class="h3 mb-0"> <?php echo  $rowSum["Total Visit"]; ?> </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <?php
                                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `pageview` where (`Date`> DATE_ADD(Now(), INTERVAL - 30 DAY))";
                                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                                        $rowSum = mysqli_fetch_array($Check_sum);

                                                        $TotalComp = "SELECT IFNULL(COUNT(*),0) FROM `pageview`  where (`Date`> DATE_ADD(Now(), INTERVAL - 60 DAY)) AND (`Date`< DATE_ADD(Now(), INTERVAL - 31 DAY))";
                                                        $Check_Comp = mysqli_query($connection, $TotalComp);
                                                        $rowComp = mysqli_fetch_array($Check_Comp);

                                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `pageview`";
                                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                                        $rowPer = mysqli_fetch_array($Check_Per);

                                                        $result = $rowSum[0] - $rowComp[0];
                                                        if ($rowPer[0] == 0) {
                                                            $result = 0;
                                                        } else {
                                                            $result = ($result / $rowPer[0]) * 100;
                                                        }
                                                        ?>
                                                        <?php if ($result > 0) {
                                                        ?>
                                                            <span class="badge badge-soft-success">+<?php echo number_format($result)  ?>%</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge badge-soft-danger"><?php echo  number_format($result) ?>%</span>
                                                        <?php
                                                        } ?>
                                                    </div>
                                                </div> <!-- end row -->

                                                <div id="sparkline4" class="mt-3"></div>
                                            </div> <!-- end card-body-->
                                        </div> <!-- end card-->
                                    </div> <!-- end col-->
                                </div>
                                <!-- end row-->
                            </div> <!-- end col -->

                            <div class="col-xl-7">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Per Page Views</h4>
                                        <!-- <p class="card-subtitle mb-4">From date of 1st Jan 2019 to continue</p> -->

                                        <div id="morris-bar-example" class="morris-chart" style="height: 304px;"></div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col-->

                        </div> <!-- end row-->

                        <div class="row">

                            <div class="col-xl-3">
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Pending Orders</h4>
                                        <?php
                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `product_order` where `Status`= 'Pending'";
                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                        $rowSum = mysqli_fetch_array($Check_sum);


                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `product_order`";
                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                        $rowPer = mysqli_fetch_array($Check_Per);



                                        if ($rowPer[0] == 0) {
                                            $result = 0;
                                        } else {
                                            $result = ($rowSum[0] / $rowPer[0]) * 100;
                                        }
                                        ?>

                                        <div class="text-center">
                                            <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#f1c31c" value="<?php echo (int) $result ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                                            <div class="clearfix"></div>
                                            <a href="index.php?manage=order" class="btn btn-sm btn-light mt-2">View All Data</a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Shipped Orders</h4>
                                        <?php
                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `product_order` where `Status`= 'Shipped'";
                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                        $rowSum = mysqli_fetch_array($Check_sum);


                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `product_order`";
                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                        $rowPer = mysqli_fetch_array($Check_Per);




                                        if ($rowPer[0] == 0) {
                                            $result = 0;
                                        } else {
                                            $result = ($rowSum[0] / $rowPer[0]) * 100;
                                        }
                                        ?>

                                        <div class="text-center">
                                            <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#A1c31c" value="<?php echo (int) $result ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                                            <div class="clearfix"></div>
                                            <a href="index.php?manage=order" class="btn btn-sm btn-light mt-2">View All Data</a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Returned Orders</h4>
                                        <?php
                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `product_order` where `Status`= 'Returned'";
                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                        $rowSum = mysqli_fetch_array($Check_sum);


                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `product_order`";
                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                        $rowPer = mysqli_fetch_array($Check_Per);



                                        if ($rowPer[0] == 0) {
                                            $result = 0;
                                        } else {
                                            $result = ($rowSum[0] / $rowPer[0]) * 100;
                                        }
                                        ?>


                                        <div class="text-center">
                                            <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#19c0ea" value="<?php echo (int) $result ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                                            <div class="clearfix"></div>
                                            <a href="index.php?manage=order" class="btn btn-sm btn-light mt-2">View All Data</a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3">
                                <div class="card m-b-20">
                                    <div class="card-body">
                                        <h4 class="card-title">Cancelled Orders</h4>
                                        <?php
                                        $TotalSum = "SELECT IFNULL(COUNT(*),0) FROM `product_order` where `Status`= 'Canceled'";
                                        $Check_sum = mysqli_query($connection, $TotalSum);
                                        $rowSum = mysqli_fetch_array($Check_sum);


                                        $TotalPer = "SELECT IFNULL(COUNT(*),0) FROM `product_order`";
                                        $Check_Per = mysqli_query($connection, $TotalPer);
                                        $rowPer = mysqli_fetch_array($Check_Per);



                                        if ($rowPer[0] == 0) {
                                            $result = 0;
                                        } else {
                                            $result = ($rowSum[0] / $rowPer[0]) * 100;
                                        }

                                        ?>
                                        <div class="text-center">
                                            <input data-plugin="knob" data-width="120" data-height="120" data-linecap=round data-fgColor="#FF0000" value="<?php echo (int) $result ?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />

                                            <div class="clearfix"></div>
                                            <a href="./index.php?manage=order" class="btn btn-sm btn-light mt-2">View All Data</a>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Recent Customers</h4>
                                        <p class="card-subtitle mb-4 font-size-13">Transaction period is last 15 days.</p>

                                        <div class="table-responsive">
                                            <table class="table table-centered table-striped table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Customer</th>
                                                        <th>Order ID</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Location</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $Customer = "SELECT DISTINCT * FROM `product_order` where (`Date_Added`> DATE_ADD(Now(), INTERVAL - 15 DAY)) ORDER BY `ID` DESC";
                                                    $checkCustomer = mysqli_query($connection, $Customer);
                                                    if (mysqli_num_rows($checkCustomer) > 0) {
                                                        while ($rowCustomer = mysqli_fetch_array($checkCustomer)) {

                                                    ?>
                                                            <tr>
                                                                <td class="table-user">
                                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold"><?php echo $rowCustomer["Name"] ?></a>
                                                                </td>
                                                                <td>
                                                                    <?php echo $rowCustomer["Order_ID"] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $rowCustomer["Number"] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $rowCustomer["Email"] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $rowCustomer["Address"] ?>,<?php echo $rowCustomer["City"] ?>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->


                        </div>
                        <!-- end row-->

                    </div> <!-- container-fluid -->
                <?php
                }

                ?>

            </div>
            <!-- End Page-content -->
            <?php require("includes/footer.php") ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>

    <?php require("includes/js.php") ?>
</body>

</html>