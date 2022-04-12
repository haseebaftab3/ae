<?php
if (!isset($_SESSION)) {
    session_start();
}
//  Global Variables
$SendSaleId = "NULL";
$SendSalePrice = 0;
$NewPrice = 0;
$currentDate = date("Y-m-d");
$Total_Product_Price = 0;
// echo $currentDate;
include("./UpdateValue.php");
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

    <?php
    // *Product ID
    $Product_ID =  $_GET["Product"];
    // *Fetch Product
    $Products_SQL = "SELECT * FROM `products` WHERE `ID`= $Product_ID";
    $Products_Check = mysqli_query($connection, $Products_SQL);
    $Prodcuts_Row = mysqli_fetch_array($Products_Check);
    $Min_JS_Val = $Prodcuts_Row["Minimum"];
    // *Category ID
    $Cat_ID = $Prodcuts_Row["Category_ID"];
    // *Category
    $Cat_SQL = "SELECT * FROM `category` WHERE `ID`= $Cat_ID";
    $Cat_Check = mysqli_query($connection, $Cat_SQL);
    $Cat_Row = mysqli_fetch_array($Cat_Check);

    // !!Total Price Value
    if (isset($CHangeTotalVal) && !empty($CHangeTotalVal)) {
        $Total_Product_Price =  $CHangeTotalVal;
    } else {
        $Total_Product_Price =  $Prodcuts_Row["Price"];
    }
    ?>
    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="assets/images/bg/page-title-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Detail</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="shop.php"><?php echo $Cat_Row["Name"] ?></a></li>
                            <li class="breadcrumb-item active"><?php echo $Prodcuts_Row["Name"] ?></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Single Products Section Start -->
    <div class="section section-padding border-bottom">
        <div class="container">
            <div class="row learts-mb-n40">

                <!-- Product Images Start -->
                <div class="col-lg-6 col-12 learts-mb-40">
                    <div class="product-images">
                        <span class="product-badges" id="Sale_Off_veiw" style="display: none;">
                            <span class="hot" id="Sale_Off_Val">hot</span>
                        </span>
                        <?php
                        $count = 0;
                        $load_BigImg = "";
                        $EX_SQL = "SELECT * FROM `products_images` WHERE `Product_ID`= $Product_ID";
                        $EX_Check = mysqli_query($connection, $EX_SQL);
                        $len = mysqli_num_rows($EX_Check);
                        while ($EX_Row = mysqli_fetch_array($EX_Check)) {
                            if ($count < $len - 1) {
                                $load_BigImg .= '{"src": "admin/uploads/Products/' . $EX_Row["Image"] . '", "w": 700, "h": 1100},';
                            } else {
                                $load_BigImg .= '{"src": "admin/uploads/Products/' . $EX_Row["Image"] . '", "w": 700, "h": 1100}';
                            }
                            $count++;
                        } ?>

                        <button class="product-gallery-popup hintT-left" data-hint="Click to enlarge" data-images='[
                            {"src": "admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>", "w": 700, "h": 1100},
                            <?php echo  $load_BigImg; ?>
                        ]'>
                            <i class="far fa-expand"></i></button>
                        <!-- <a href="#product-360-viewer" data-toggle="modal" class="toggle-360 hintT-left" data-hint="360 product"><img src="assets/images/icons/360.png" alt=""></a> -->

                        <div class="product-gallery-slider">

                            <div class="product-zoom" data-image="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>">
                                <img src="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>">
                            </div>

                            <?php
                            $NO = 1;
                            $EX_SQL = "SELECT * FROM `products_images` WHERE `Product_ID`= $Product_ID";
                            $EX_Check = mysqli_query($connection, $EX_SQL);
                            while ($EX_Row = mysqli_fetch_array($EX_Check)) {
                            ?>
                                <div class="product-zoom" data-image="admin/uploads/Products/<?php echo $EX_Row["Image"] ?>">
                                    <img src="admin/uploads/Products/<?php echo $EX_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] . "($NO)" ?>">
                                </div>

                            <?php
                                $NO++;
                            } ?>
                        </div>
                        <div class="product-thumb-slider">
                            <div class="item">
                                <img src="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>-Thumb">
                            </div>
                            <?php
                            $NO = 1;
                            $EX_SQL = "SELECT * FROM `products_images` WHERE `Product_ID`= $Product_ID";
                            $EX_Check = mysqli_query($connection, $EX_SQL);
                            while ($EX_Row = mysqli_fetch_array($EX_Check)) {
                            ?>
                                <div class="item">
                                    <img src="admin/uploads/Products/<?php echo $EX_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] . "($NO)" ?>-Thumb(<?php echo $NO++; ?>)">
                                </div>
                            <?php
                                $NO++;
                            } ?>
                        </div>
                    </div>
                    <!-- 360 Image -->
                    <!-- <div class="modal fade" id="product-360-viewer">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="cd-product-viewer-wrapper" data-frame="16" data-friction="0.33">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <figure class="product-viewer">
                                            <img src="assets/images/product/single/7/frame-review.jpg" alt="Product Preview">
                                            <div class="product-sprite" data-image="assets/images/product/single/7/frame-total.jpg"></div>
                                        </figure>

                                        <div class="cd-product-viewer-handle">
                                            <span class="fill"></span>
                                            <span class="handle">Handle</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- 360 Image -->
                </div>
                <!-- Product Images End -->
                <!-- Product Summery Start -->
                <div class="col-lg-6 col-12 learts-mb-40">
                    <form class="Add_To_Cart_Form">
                        <div class="" id="Detail_main_alert"></div>
                        <div class="product-summery">
                            <div class="product-nav">
                                <?php
                                $sql_prev = "SELECT `ID` FROM `products` ORDER BY `products`.`ID` ASC";
                                $check_prev = mysqli_query($connection, $sql_prev);
                                if (mysqli_num_rows($check_prev) > 0) {
                                    $row_prev = mysqli_fetch_array($check_prev);
                                    $prev_prodID = $Product_ID;
                                    if (--$prev_prodID >= $row_prev["ID"]) {
                                ?>
                                        <a href="detail.php?Product=<?php echo $prev_prodID ?>"><i class="fal fa-long-arrow-left"></i></a>
                                <?php
                                    }
                                }
                                ?>

                                <?php
                                $sql_next = "SELECT `ID` FROM `products` ORDER BY `products`.`ID` DESC";
                                $check_next = mysqli_query($connection, $sql_next);
                                if (mysqli_num_rows($check_next) > 0) {
                                    $row_next = mysqli_fetch_array($check_next);
                                    $next_prodID = $Product_ID;
                                    if (++$next_prodID <= $row_next["ID"]) {
                                ?>
                                        <a href="detail.php?Product=<?php echo $next_prodID ?>"><i class="fal fa-long-arrow-right"></i></a>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            $Rating_Sql = "SELECT * FROM `product_rating` WHERE `Product_ID` = $Product_ID AND `Status` = 1 ";
                            $check_Rating = mysqli_query($connection, $Rating_Sql);
                            $total_rating = 0;
                            $i = 0;
                            ?>
                            <div class="product-ratings">
                                <?php
                                while ($row_Rating = mysqli_fetch_array($check_Rating)) {
                                    $total_rating = $row_Rating["Rating"] +  $total_rating;
                                    $i++;
                                }
                                if ($total_rating > 0) {

                                    $Avg_rating = ($total_rating / (mysqli_num_rows($check_Rating) * 5)) * 100;
                                } else {
                                    $Avg_rating = 0;
                                }
                                ?>
                                <span class="star-rating">
                                    <span class="rating-active" style="width: <?php echo $Avg_rating ?>%;">ratings</span>
                                </span>

                                <a href="#reviews" class="review-link">(<span class="count"><?php echo mysqli_num_rows($check_Rating) ?></span> customer reviews)</a>
                            </div>

                            <h3 class="product-title"><?php echo $Prodcuts_Row["Name"] ?></h3>
                            <!-- Sale Value For Js  -->
                            <!-- <input type="hidden" class="Sale_Of_Value" value="NULL"> -->
                            <!-- Check Sale  -->
                            <?php
                            $FetchSale = "SELECT * FROM `sale` WHERE ((`Cat_ID`=$Cat_ID OR `Prodcut_ID`= $Product_ID) AND `Date_End`>'$currentDate')";
                            $checkSale = mysqli_query($connection, $FetchSale);
                            if ($checkSale) {
                                if (mysqli_num_rows($checkSale) > 0) {
                                    $rowSale = mysqli_fetch_array($checkSale);
                                    $SendSaleId = $rowSale["ID"];
                                    $NewPrice = (((int) $rowSale["Value"] / 100) * $Total_Product_Price);
                                    $SendSalePrice = round($Total_Product_Price - $NewPrice);
                            ?>
                                    <script>
                                        document.getElementById("Sale_Off_veiw").style.display = "flex"
                                        document.getElementById("Sale_Off_Val").innerHTML = "-" + <?php echo $rowSale["Value"] ?> + "%"
                                    </script>
                                    <input type="hidden" class="Sale_Of_Value" value="<?php echo $rowSale["Value"] ?>">
                                    <div class="text-danger font-weight-bold float-left pr-3"><del>Rs. <span class="Old_Product_Price"><?php echo  number_format($Total_Product_Price, 2) ?></span></del></div>
                                    <div class="product-price float-left">Rs. <?php echo  number_format($SendSalePrice, 2) ?></div>
                                    <div class="clearfix"></div>
                                    <?php
                                } else {
                                    $catSql = "SELECT * FROM `category` WHERE `ID` = $Cat_ID ";
                                    $CheckCat = mysqli_query($connection, $catSql);
                                    if ($CheckCat) {
                                        // Check By Category
                                        $RowCat = mysqli_fetch_array($CheckCat);
                                        $MainCatID = $RowCat["Parent_ID"];
                                        $MainCatSql = "SELECT * FROM `sale` WHERE `Cat_ID`=$MainCatID AND `Date_End`>'$currentDate'";
                                        $checkMainCat = mysqli_query($connection, $MainCatSql);

                                        if ($checkMainCat) {
                                            if (mysqli_num_rows($checkMainCat) > 0) {
                                                $rowSale = mysqli_fetch_array($checkMainCat);
                                                $SendSaleId = $rowSale["ID"];
                                                $NewPrice = (((int) $rowSale["Value"] / 100) * $Total_Product_Price);
                                                $SendSalePrice = round($Total_Product_Price - $NewPrice);
                                    ?>
                                                <script>
                                                    document.getElementById("Sale_Off_veiw").style.display = "flex"
                                                    document.getElementById("Sale_Off_Val").innerHTML = "-" + <?php echo $rowSale["Value"] ?> + "%"
                                                </script>
                                                <input type="hidden" class="Sale_Of_Value" value="<?php echo $rowSale["Value"] ?>">
                                                <div class="text-danger font-weight-bold float-left pr-3 "><del>Rs. <span class="Old_Product_Price"><?php echo  number_format($Total_Product_Price, 2) ?></span></del></div>
                                                <div class="product-price float-left">Rs. <?php echo  number_format($SendSalePrice, 2) ?></div>
                                                <div class="clearfix"></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="product-price">Rs. <?php echo  number_format($Total_Product_Price, 2) ?></div>
                            <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            <div class="product-description">
                                <p>
                                    <?php if (strlen($Prodcuts_Row["Description"]) > 60) {
                                        echo substr($Prodcuts_Row["Description"], 0, 300) . " .........";
                                    } else {
                                        echo $Prodcuts_Row["Description"];
                                    }
                                    ?>
                                </p>
                            </div>


                            <?php if (!empty($Prodcuts_Row["DAmp"]) && isset($Prodcuts_Row["DAmp"])) {
                                $inc = 1;
                                $Sql_Amp = "SELECT * FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Amp' ";
                                $Fetch_Amp = mysqli_query($connection, $Sql_Amp);
                            ?>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Select Amp</label>
                                    <select class="form-control Amp-Option-Select" id="exampleFormControlSelect1">
                                        <option value="<?php echo $Prodcuts_Row["UnitPrice"] ?>" data-TotalPrice="<?php echo $Total_Product_Price ?>" data-Quantity="<?php echo $Prodcuts_Row["Unit_Quantity"] ?>"><?php echo $Prodcuts_Row["DAmp"] ?> AMP</option>
                                        <?php
                                        if (mysqli_num_rows($Fetch_Amp) > 0) {
                                            while ($row_Amp = mysqli_fetch_array($Fetch_Amp)) {
                                        ?>
                                                <option value="<?php echo $row_Amp["Unit_Price"] ?>" data-TotalPrice="<?php echo $row_Amp["Price"] ?>" data-Quantity="<?php echo $row_Amp["Quantity"] ?>"><?php echo $row_Amp["Name"] ?> AMP</option>
                                        <?php
                                                $inc++;
                                            }
                                        } ?>
                                    </select>
                                </div>
                            <?php } ?>

                            <!-- Amp INfo -->
                            <?php if ((!empty($Prodcuts_Row["UnitPrice"]) && isset($Prodcuts_Row["UnitPrice"])) || (!empty($Prodcuts_Row["Unit_Quantity"]) && isset($Prodcuts_Row["Unit_Quantity"]))) {
                            ?>
                                <div class="group-product-list">
                                    <table>
                                        <tbody>
                                            <?php if (!empty($Prodcuts_Row["UnitPrice"]) && isset($Prodcuts_Row["UnitPrice"])) {
                                            ?>
                                                <tr>
                                                    <td class="title"><a href="javascript:void(0)">Price Per Piece</a></td>
                                                    <td class="price"><span class="pro-price"><span class="new change_unit_price">Rs. <?php echo number_format($Prodcuts_Row["UnitPrice"], 2) ?></span></span></td>
                                                </tr>
                                            <?php } ?>
                                            <?php if (!empty($Prodcuts_Row["Unit_Quantity"]) && isset($Prodcuts_Row["Unit_Quantity"])) {
                                            ?>
                                                <tr>
                                                    <td class="title"><a href="javascript:void(0)">Packing in box</a></td>
                                                    <td class="price"><span class="pro-price"><span class="new change_unit_Quntity"><?php echo $Prodcuts_Row["Unit_Quantity"] ?></span></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <span class="info-text">Products are available in limited quantities.</span>
                                </div>
                            <?php } ?>


                            <div class="product-variations">
                                <table>
                                    <tbody>
                                        <?php
                                        if (!empty($Prodcuts_Row["DColor"])) {
                                            $inc = 1;
                                            $Sql_Color = "SELECT `Name`,`H_Code` FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Color' ";
                                            $Fetch_Color = mysqli_query($connection, $Sql_Color);
                                        ?>
                                            <input type="hidden" class="Color_Avaliable_Status" value="true">
                                            <tr>
                                                <td class="label"><span>Color</span></td>
                                                <td class="value">
                                                    <div class="product-colors">
                                                        <div class="swatch clearfix" data-option-index="1">
                                                            <?php if ((strtolower($Prodcuts_Row["H_Code"]) == "white") || ($Prodcuts_Row["H_Code"] == "#FFFFFF") || (strtolower($Prodcuts_Row["H_Code"]) == "#fff")) { ?>
                                                                <div data-value="Blue" class="swatch-element color blue available">
                                                                    <div class="tooltip"><?php echo $Prodcuts_Row["DColor"] ?></div>
                                                                    <input quickbeam="color" id="swatch-1-blue<?php echo $inc ?>" type="radio" name="option-1" class="swatch_Color_Fetch" checked value="<?php echo $Prodcuts_Row["DColor"] ?>" />
                                                                    <label for="swatch-1-blue<?php echo $inc ?>" style="border-color:black!important;">
                                                                        <span style="background-color:<?php echo $Prodcuts_Row["DColor"] ?>;"></span>
                                                                    </label>
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div data-value="Blue" class="swatch-element color blue available">
                                                                    <div class="tooltip"><?php echo $Prodcuts_Row["DColor"] ?></div>
                                                                    <input quickbeam="color" id="swatch-1-blue<?php echo $inc ?>" type="radio" name="option-1" class="swatch_Color_Fetch" checked value="<?php echo $Prodcuts_Row["DColor"] ?>" />
                                                                    <label for="swatch-1-blue<?php echo $inc ?>" style="border-color:<?php echo strtolower($Prodcuts_Row["H_Code"]) ?>!important;">
                                                                        <span style="background-color:<?php echo strtolower($Prodcuts_Row["H_Code"]) ?>!important;"></span>
                                                                    </label>
                                                                </div>
                                                                <?php
                                                            }
                                                            if (mysqli_num_rows($Fetch_Color) > 0) {
                                                                while ($row_color = mysqli_fetch_array($Fetch_Color)) {
                                                                    if ((strtolower($row_color["H_Code"]) == "white") || ($row_color["H_Code"] == "#FFFFFF") || (strtolower($row_color["H_Code"]) == "#fff")) {
                                                                ?>
                                                                        <div data-value="<?php echo $row_color["Name"] ?>" class="swatch-element color blue available">
                                                                            <div class="tooltip"><?php echo $row_color["Name"] ?></div>
                                                                            <input quickbeam="color" id="swatch-1-blue<?php echo ++$inc ?>" type="radio" class="swatch_Color_Fetch" name="option-1" value="<?php echo $row_color["Name"] ?>" />
                                                                            <label for="swatch-1-blue<?php echo $inc ?>" style="border-color:black!important;">
                                                                                <span style="background-color: <?php echo strtolower($row_color["H_Code"]) ?>!important;"></span>
                                                                            </label>
                                                                        </div>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div data-value="<?php echo $row_color["Name"] ?>" class="swatch-element color blue available">
                                                                            <div class="tooltip"><?php echo $row_color["Name"] ?></div>
                                                                            <input quickbeam="color" id="swatch-1-blue<?php echo ++$inc ?>" type="radio" class="swatch_Color_Fetch" name="option-1" value="<?php echo $row_color["Name"] ?>" />
                                                                            <label for="swatch-1-blue<?php echo $inc ?>" style="border-color: <?php echo strtolower($row_color["H_Code"]) ?>!important;">
                                                                                <span style="background-color: <?php echo strtolower($row_color["H_Code"]) ?>!important;"></span>
                                                                            </label>
                                                                        </div>
                                                                <?php
                                                                    }
                                                                    $inc++;
                                                                } ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                                            }
                                                        } else {
                                        ?>
                                        <input type="hidden" class="Color_Avaliable_Status" value="false">
                                    <?php
                                                        }
                                    ?>
                                    <tr>
                                        <td class="label"><span>Quantity</span></td>
                                        <td class="value">
                                            <div class="product-quantity">
                                                <span class="qty-btn minus MinusQuntBtn"><i class="ti-minus"></i></span>
                                                <input type="text" class="input-qty" required value="<?php echo $Prodcuts_Row["Minimum"] ?>" name="CartProductQuantity">
                                                <span class="qty-btn plus PlusQuntBtn"><i class="ti-plus"></i></span>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Hidden Items Start -->
                            <?php
                            if ($SendSalePrice != 0) {
                            ?>
                                <!-- Base Price -->
                                <input type="hidden" class="QuickBasePrice" value="<?php echo  $SendSalePrice ?>">
                                <input type="hidden" name="CartProductUpdatedPrice" class="CartProductUpdatedPrice" value="<?php echo  $SendSalePrice ?>">
                            <?php
                            } else {
                            ?>
                                <!-- Base Price -->
                                <input type="hidden" class="QuickBasePrice" value="<?php echo $Total_Product_Price ?>">
                                <input type="hidden" name="CartProductUpdatedPrice" class="CartProductUpdatedPrice" value="<?php echo  $Total_Product_Price ?>">
                            <?php
                            }
                            ?>
                            <!-- Add Unit Values -->
                            <input type="hidden" class="Hidden_Unit_Price" value="<?php echo $Prodcuts_Row["UnitPrice"] ?>" name="Hidden_Unit_Price">
                            <input type="hidden" class="Hidden_Unit_Quantity" value="<?php echo $Prodcuts_Row["Unit_Quantity"] ?>" name="Hidden_Unit_Price">
                            <!-- Add Unit Values -->
                            <input type="hidden" name="CartProductPrice" value="<?php echo $Total_Product_Price ?>">
                            <input type="hidden" name="CartProductID" value="<?php echo $Product_ID ?>">
                            <input type="hidden" name="CartProductName" value="<?php echo $Prodcuts_Row["Name"] ?>">
                            <input type="hidden" class="CartProductPrice" name="CartShiipProductPrice" value="<?php echo $Prodcuts_Row["Shipping_Price"] ?>">
                            <input type="hidden" name="CartProductImg" value="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>">
                            <input type="hidden" name="CartProductColor" class="CartProductColor" value="<?php echo $Prodcuts_Row["DColor"] ?>">
                            <input type="hidden" name="CartProductSize" class="CartProductSize" value="<?php echo $Prodcuts_Row["DSize"] ?>">
                            <input type="hidden" name="CartProductWeight" value="<?php echo $Prodcuts_Row["Weight"] ?>">
                            <input type="hidden" name="CartProductSaleID" value="<?php echo $SendSaleId ?>">
                            <!-- Hidden Items End -->

                            <div class="product-buttons">
                                <!-- <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark hintT-top" data-hint="Add to Wishlist"><i class="fal fa-heart"></i></a> -->
                                <button class="btn btn-dark btn-outline-hover-dark"><i class="fal fa-shopping-cart"></i> Add to Cart</button>
                                <!-- <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="fal fa-shopping-cart"></i> Add to Cart</a> -->
                                <!-- <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark hintT-top" data-hint="Compare"><i class="fal fa-random"></i></a> -->
                            </div>
                            <div class="product-meta">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="label"><span>Model</span></td>
                                            <td class="value"><?php echo $Prodcuts_Row["Model"] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="label"><span>Category</span></td>
                                            <td class="value">
                                                <ul class="product-category">

                                                    <li><a href="#"><?php echo $Cat_Row["Name"] ?></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php
                                        $Fetch_SEO_Keyword = "SELECT `ProductTag` FROM `products_seo` WHERE `Product_ID`= $Product_ID";
                                        $Check_SEO_Keyword = mysqli_query($connection, $Fetch_SEO_Keyword);
                                        // die(mysqli_error($connection));
                                        if (mysqli_num_rows($Check_SEO_Keyword) > 0) {
                                            $Fetch_SEO_Keyword = mysqli_fetch_array($Check_SEO_Keyword);
                                            if (!empty($Fetch_SEO_Keyword["ProductTag"])) {
                                        ?>
                                                <tr>
                                                    <td class="label"><span>Tags</span></td>
                                                    <td class="value">
                                                        <ul class="product-tags">

                                                            <?php
                                                            $Fetch_SEO_Keyword = "SELECT `ProductTag` FROM `products_seo` WHERE `Product_ID`= $Product_ID ";
                                                            $Check_SEO_Keyword = mysqli_query($connection, $Fetch_SEO_Keyword);
                                                            while ($Fetch_SEO_Keyword = mysqli_fetch_array($Check_SEO_Keyword)) {
                                                                $keywork = explode(",", $Fetch_SEO_Keyword["ProductTag"]);
                                                                foreach ($keywork as $f_Keywork) {
                                                            ?>
                                                                    <li><a href="javascript:void(0)"><?php echo ($f_Keywork); ?></a></li>
                                                            <?php
                                                                }
                                                            } ?>

                                                        </ul>
                                                    </td>
                                                </tr>

                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Product Summery End -->

            </div>
        </div>

    </div>
    <!-- Single Products Section End -->

    <!-- Single Products Infomation Section Start -->
    <div class="section section-padding border-bottom">
        <div class="container">

            <ul class="nav product-info-tab-list">
                <li><a class="active" data-toggle="tab" href="#tab-description">Description</a></li>
                <li><a data-toggle="tab" href="#tab-additional_information">Additional information</a></li>
                <?php
                $Rating_Sql = "SELECT * FROM `product_rating` WHERE `Product_ID` = $Product_ID AND `Status` = 1 LIMIT 10";
                $check_Rating = mysqli_query($connection, $Rating_Sql);
                ?>
                <li><a data-toggle="tab" href="#tab-reviews">Reviews (<?php echo mysqli_num_rows($check_Rating) ?>)</a></li>
            </ul>
            <div class="tab-content product-infor-tab-content">
                <div class="tab-pane fade show active" id="tab-description">
                    <div class="row">
                        <div class="col-lg-10 col-12 mx-auto">
                            <p>
                                <?php
                                print_r($Prodcuts_Row["Description"]);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-additional_information">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 col-12 mx-auto">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <!-- Size -->
                                        <?php if (!empty($Prodcuts_Row["DSize"])) {
                                            $html_Size = "";
                                            $i = 0;
                                            $Sql_Size = "SELECT `Name` FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Size' ";
                                            $Fetch_Size = mysqli_query($connection, $Sql_Size);
                                            if (mysqli_num_rows($Fetch_Size) > 0) {
                                                $len = mysqli_num_rows($Fetch_Size);
                                                while ($row_Size = mysqli_fetch_array($Fetch_Size)) {
                                                    if ($i == $len - 1) {
                                                        $html_Size .= $row_Size["Name"];
                                                    } else {
                                                        $html_Size .= $row_Size["Name"]  . ", ";
                                                    }
                                                    $i++;
                                                }
                                            }
                                        ?>
                                            <tr>
                                                <td>Size</td>
                                                <td>
                                                    <?php
                                                    if (!empty($html_Size)) {
                                                        echo $Prodcuts_Row["DSize"] . ", " . $html_Size;
                                                    } else {
                                                        echo $Prodcuts_Row["DSize"];
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <!-- EndSize -->
                                        <!-- Color -->
                                        <?php if (!empty($Prodcuts_Row["DColor"])) {
                                            $html_color = "";
                                            $i = 0;
                                            $Sql_Color = "SELECT `Name` FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Color' ";
                                            $Fetch_Color = mysqli_query($connection, $Sql_Color);
                                            if (mysqli_num_rows($Fetch_Color) > 0) {
                                                $len = mysqli_num_rows($Fetch_Color);
                                                while ($row_color = mysqli_fetch_array($Fetch_Color)) {
                                                    if ($i == $len - 1) {
                                                        $html_color .= $row_color["Name"];
                                                    } else {
                                                        $html_color .= $row_color["Name"]  . ", ";
                                                    }
                                                    $i++;
                                                }
                                            }
                                        ?>
                                            <tr>
                                                <td>Color</td>
                                                <td>
                                                    <?php
                                                    if (!empty($html_color)) {
                                                        echo $Prodcuts_Row["DColor"] . ", " . $html_color;
                                                    } else {
                                                        echo $Prodcuts_Row["DColor"];
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <!-- EndColor -->
                                        <!-- AMP -->
                                        <?php if (!empty($Prodcuts_Row["DAmp"])) {
                                            $html_Amp = "";
                                            $i = 0;
                                            $Sql_Amp = "SELECT `Name` FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Amp' ";
                                            $Fetch_Amp = mysqli_query($connection, $Sql_Amp);
                                            if (mysqli_num_rows($Fetch_Amp) > 0) {
                                                $len = mysqli_num_rows($Fetch_Amp);
                                                while ($row_Amp = mysqli_fetch_array($Fetch_Amp)) {
                                                    if ($i == $len - 1) {
                                                        $html_Amp .= $row_Amp["Name"];
                                                    } else {
                                                        $html_Amp .= $row_Amp["Name"]  . ", ";
                                                    }
                                                    $i++;
                                                }
                                            }
                                        ?>
                                            <tr>
                                                <td>AMP</td>
                                                <td>
                                                    <?php
                                                    if (!empty($html_Amp)) {
                                                        echo $Prodcuts_Row["DAmp"] . ", " . $html_Amp;
                                                    } else {
                                                        echo $Prodcuts_Row["DAmp"];
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <!-- EndColor -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-reviews">
                    <div class="product-review-wrapper">
                        <?php
                        $Rating_Sql = "SELECT * FROM `product_rating` WHERE `Product_ID` = $Product_ID AND `Status` = 1 LIMIT 10";
                        $check_Rating = mysqli_query($connection, $Rating_Sql);
                        if (mysqli_num_rows($check_Rating) > 0) {

                        ?>
                            <span class="title"><?php echo mysqli_num_rows($check_Rating) ?> reviews for <?php echo $Prodcuts_Row["Name"] ?></span>
                            <ul class="product-review-list">
                                <?php while ($row_Rating = mysqli_fetch_array($check_Rating)) { ?>
                                    <li>
                                        <div class="product-review">
                                            <div class="thumb"><img src="assets/images/review/review-2.png" alt=""></div>
                                            <div class="content">
                                                <div class="ratings">
                                                    <span class="star-rating">
                                                        <?php
                                                        if ($row_Rating["Rating"] == 1) {
                                                        ?>
                                                            <span class="rating-active" style="width: 20%;">ratings</span>
                                                        <?php
                                                        } elseif ($row_Rating["Rating"] == 2) {
                                                        ?>
                                                            <span class="rating-active" style="width: 40%;">ratings</span>
                                                        <?php
                                                        } elseif ($row_Rating["Rating"] == 3) {
                                                        ?>
                                                            <span class="rating-active" style="width: 60%;">ratings</span>
                                                        <?php
                                                        } elseif ($row_Rating["Rating"] == 4) {
                                                        ?>
                                                            <span class="rating-active" style="width: 80%;">ratings</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="rating-active" style="width: 100%;">ratings</span>
                                                        <?php
                                                        }
                                                        ?>

                                                    </span>
                                                </div>
                                                <div class="meta">
                                                    <h5 class="title"><?php echo $row_Rating["Name"] ?></h5>
                                                    <span class="date"><?php echo $row_Rating["Date"] ?></span>
                                                </div>
                                                <p><?php echo $row_Rating["Review"] ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <span class="title">Add a review</span>
                        <div class="review-form">
                            <p class="note">Your email address will not be published. Required fields are marked *</p>
                            <form action="#" class="product-review-user">
                                <div id="RatingReview-alert"></div>
                                <input type="hidden" name="Product_ID" value="<?php echo  $Product_ID ?>">
                                <div class="row learts-mb-n30">
                                    <div class="col-md-6 col-12 learts-mb-30">
                                        <input type="text" placeholder="Name *" required name="name">
                                    </div>
                                    <div class="col-md-6 col-12 learts-mb-30">
                                        <input type="email" placeholder="Email *" required name="email">
                                    </div>
                                    <div class="col-12 learts-mb-10">
                                        <div class="form-rating">
                                            <span class="title pt-2">Your rating</span>
                                            <!-- <span class="rating">
                                                <span class="star"></span>
                                            </span> -->
                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    <input disabled checked class="rating__input rating__input--none" name="rating3" id="rating3-none" value="0" required type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating3-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio" required>
                                                    <label aria-label="2 stars" class="rating__label" for="rating3-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio" required>
                                                    <label aria-label="3 stars" class="rating__label" for="rating3-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio" required>
                                                    <label aria-label="4 stars" class="rating__label" for="rating3-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio" required>
                                                    <label aria-label="5 stars" class="rating__label" for="rating3-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                    <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 learts-mb-30"><textarea placeholder="Your Review *" required name="review"></textarea></div>
                                    <div class="col-12 text-center learts-mb-30">
                                        <button class="btn btn-dark btn-outline-hover-dark" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Single Products Infomation Section End -->

    <!-- Recommended Products Section Start -->

    <!-- Recommended Products Section End -->

    <!-- Footer -->
    <?php require("includes/footer.php") ?>

    <!-- Modal -->
    <?php require("includes/quick-veiw.php") ?>

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. 
 It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides. 
    PhotoSwipe keeps only 3 of them in the DOM to save memory.
    Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <button class="pswp__button pswp__button--share" title="Share"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader ">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>
    <!-- JS
============================================ -->

    <?php require("includes/js.php") ?>
    <script>
        var OrgQun = <?php echo $Min_JS_Val ?>;
        if ($(".input-qty").val() <= OrgQun) {
            $(".MinusQuntBtn").css("display", "none");
        } else {
            $(".MinusQuntBtn").css("display", "unset");
        }
        $(".input-qty").change(function(e) {
            if ($(".input-qty").val() <= OrgQun) {
                $(".MinusQuntBtn").css("display", "none");
                $(".input-qty").val(OrgQun);
            } else {
                $(".MinusQuntBtn").css("display", "unset");
            }
        });

        $(".MinusQuntBtn").click(function() {
            if ($(".input-qty").val() <= OrgQun) {
                $(".MinusQuntBtn").css("display", "none");
            } else {
                $(".MinusQuntBtn").css("display", "unset");
            }
        });
        $(".PlusQuntBtn").click(function() {
            if ($(".input-qty").val() <= OrgQun) {
                $(".MinusQuntBtn").css("display", "none");
            } else {
                $(".MinusQuntBtn").css("display", "unset");
            }
        });
    </script>
</body>


</html>