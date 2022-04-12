<?php
if (!isset($_SESSION)) {
    session_start();
}
require("./connection.php");
if (isset($_GET["List"]) && !empty($_GET["List"])) {
    $Cat_ID = $_GET["List"];
}
$SendSaleId = "NULL";
$SendSalePrice = 0;
$NewPrice = 0;
$currentDate = date("Y-m-d");
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
    <div class="page-title-section section" data-bg-image="assets/images/bg/1.png">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Shop</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">categories</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <?php if (isset($_GET["List"]) && !empty($_GET["List"])) { ?>

        <!-- Shop Products Section Start -->
        <div class="section section-padding pt-0">

            
            <div class="section learts-mt-70">
                <div class="container">
                    <!-- Products Start -->
                    <div id="shop-products" class="products isotope-grid row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                        <div class="grid-sizer col-1"></div>

                        <?php
                        $Sub_Cat_SQL = "SELECT * FROM `category`  WHERE `Parent_ID`=$Cat_ID  ORDER BY `category`.`Sort_Order` DESC ";
                        $Sub_Cat_Check = mysqli_query($connection, $Sub_Cat_SQL);
                        if ($Sub_Cat_Check) {
                            while ($Sub_Cat_Row = mysqli_fetch_array($Sub_Cat_Check)) {
                                $Cat_ID = $Sub_Cat_Row["ID"];
                            ?>
                                    <div class="grid-item col Sort_List_No_<?php echo $Cat_ID ?>">

                                        <div class="product">
                                            <div class="product-thumb">
                                                <a href="detail.php?Product=<?php echo $Sub_Cat_Row["ID"] ?>" class="image">
                                                        <img src="admin/uploads/Categories/<?php echo $Sub_Cat_Row["Image"] ?>" alt="<?php echo $Sub_Cat_Row["Name"] ?>">
                                                    <?php
                                                     ?>
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h6 class="title"><a href="detail.php?Product=<?php echo $Sub_Cat_Row["ID"] ?>"><?php echo $Sub_Cat_Row["Name"] ?></a></h6>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        ?>


                    </div>
                </div>
            </div>

        </div>
        <!-- Shop Products Section End -->
    <?php 
    }
    ?>


    <!-- Footer -->
    <?php require("includes/footer.php") ?>

    <!-- Modal -->
    <?php require("includes/quick-veiw.php") ?>


    <!-- JS
============================================ -->

    <?php require("includes/js.php") ?>
</body>


</html>