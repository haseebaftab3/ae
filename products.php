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
                                <?php
                                if (!empty($_GET["Name"]) && isset($_GET["Name"])) {
                                    if(!empty($_GET["ParentID"]) && isset($_GET["ParentID"])){
                                        ?>
                                        <li class="breadcrumb-item"><a href="shop.php?List=<?php echo $_GET["ParentID"] ?>"><?php echo $_GET["Name"] ?></a></li>
                                        <?php
                                    }else{
                                        ?>
                                        <li class="breadcrumb-item"><a href="#"><?php echo $_GET["Name"] ?></a></li>
                                        <?php
                                    }
                                    
                                }
                                ?>
                                
                                <li class="breadcrumb-item active">Products</li>
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

                <!-- Shop Toolbar Start -->
                <div class="shop-toolbar border-bottom">
                    <div class="container">
                        <div class="row learts-mb-n20">

                            
                            <!-- Isotop Filter End -->

                            <div class="col-md-auto col-12 learts-mb-20">
                                <!--<ul class="shop-toolbar-controls">-->

                                <!--    <li>-->
                                <!--        <div class="product-sorting">-->
                                <!--            <select class="nice-select">-->
                                <!--                <option value="menu_order" selected="selected">Default sorting</option>-->
                                <!--                <option value="popularity">Sort by popularity</option>-->
                                <!--                <option value="rating">Sort by average rating</option>-->
                                <!--                <option value="date">Sort by latest</option>-->
                                <!--                <option value="price">Sort by price: low to high</option>-->
                                <!--                <option value="price-desc">Sort by price: high to low</option>-->
                                <!--            </select>-->
                                <!--        </div>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <div class="product-column-toggle d-none d-xl-flex">-->
                                <!--            <button class="toggle active hintT-top" data-hint="5 Column" data-column="5"><i class="ti-layout-grid4-alt"></i></button>-->
                                <!--            <button class="toggle hintT-top" data-hint="4 Column" data-column="4"><i class="ti-layout-grid3-alt"></i></button>-->
                                <!--            <button class="toggle hintT-top" data-hint="3 Column" data-column="3"><i class="ti-layout-grid2-alt"></i></button>-->
                                <!--        </div>-->
                                <!--    </li>-->
                                <!--    <li>-->
                                <!--        <a class="product-filter-toggle" href="#product-filter">Filters</a>-->
                                <!--    </li>-->

                                <!--</ul>-->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Shop Toolbar End -->

                <div class="section learts-mt-70">
                    <div class="container">
                        <!-- Products Start -->
                        <div id="shop-products" class="products isotope-grid row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                            <div class="grid-sizer col-1"></div>

                            <?php
                                    $Prodcucts_SQL = "SELECT * FROM `products` WHERE `Category_ID`= $Cat_ID ORDER BY `products`.`SortOrder` DESC";
                                    $Prodcucts_Check = mysqli_query($connection, $Prodcucts_SQL);
                                    while ($Prodcuts_Row = mysqli_fetch_array($Prodcucts_Check)) {
                                        $Product_ID = $Prodcuts_Row["ID"];
                                        $Prodcuts_ID = $Prodcuts_Row["ID"];
                            ?>
                                        <div class="grid-item col">

                                            <div class="product">
                                                <div class="product-thumb">
                                                    <a href="detail.php?Product=<?php echo $Prodcuts_Row["ID"] ?>" class="image">
                                                        <!-- Sale Percent Start -->
                                                        <span class="product-badges" id="Sale_Off_veiw">
                                                            <?php
                                                            $FetchSale = "SELECT `Value` FROM `sale` WHERE ((`Cat_ID`=$Cat_ID OR `Prodcut_ID`= $Product_ID) AND `Date_End`>'$currentDate')";
                                                            $checkSale = mysqli_query($connection, $FetchSale);
                                                            if ($checkSale) {
                                                                if (mysqli_num_rows($checkSale) > 0) {
                                                                    $rowSale = mysqli_fetch_array($checkSale);
                                                            ?>
                                                                    <span class="onsale" id="Sale_Off_Val"><?php echo $rowSale["Value"] ?></span>
                                                                    <?php
                                                                } else {
                                                                    $catSql = "SELECT * FROM `category` WHERE `ID` = $Cat_ID ";
                                                                    $CheckCat = mysqli_query($connection, $catSql);
                                                                    if ($CheckCat) {
                                                                        // Check By Category
                                                                        $RowCat = mysqli_fetch_array($CheckCat);
                                                                        $MainCatID = $RowCat["Parent_ID"];
                                                                        $MainCatSql = "SELECT `Value` FROM `sale` WHERE `Cat_ID`=$MainCatID AND `Date_End`>'$currentDate'";
                                                                        $checkMainCat = mysqli_query($connection, $MainCatSql);
                                                                        if ($checkMainCat) {
                                                                            if (mysqli_num_rows($checkMainCat) > 0) {
                                                                                $rowSale = mysqli_fetch_array($checkMainCat);
                                                                    ?>
                                                                                <span class="onsale" id="Sale_Off_Val">-<?php echo $rowSale["Value"] ?>%</span>
                                                            <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </span>
                                                        <!-- Sale Percent ENd -->
                                                        <?php
                                                        $Load_ExImg = "SELECT * FROM `products_images` WHERE `Product_ID` = $Prodcuts_ID";
                                                        $Check_ExImg = mysqli_query($connection, $Load_ExImg);
                                                        $Row_ExImg = mysqli_fetch_array($Check_ExImg);
                                                        if (mysqli_num_rows($Check_ExImg) > 0) {
                                                        ?>
                                                            <img src="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>">
                                                            <img class="image-hover" src="admin/uploads/Products/<?php echo $Row_ExImg["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>(1)">
                                                        <?php } else {
                                                        ?>
                                                            <img src="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>">
                                                        <?php
                                                        } ?>
                                                    </a>
                                                    <!-- <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i class="far fa-heart"></i></a> -->
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="title"><a href="detail.php?Product=<?php echo $Prodcuts_Row["ID"] ?>"><?php echo $Prodcuts_Row["Name"] ?></a></h6>
                                                    <!-- Check Sale  -->
                                                    <?php
                                                    $FetchSale = "SELECT * FROM `sale` WHERE ((`Cat_ID`=$Cat_ID OR `Prodcut_ID`= $Product_ID) AND `Date_End`>'$currentDate')";
                                                    $checkSale = mysqli_query($connection, $FetchSale);
                                                    if ($checkSale) {
                                                        if (mysqli_num_rows($checkSale) > 0) {
                                                            $rowSale = mysqli_fetch_array($checkSale);
                                                            $SendSaleId = $rowSale["ID"];
                                                            $NewPrice = (((int) $rowSale["Value"] / 100) * $Prodcuts_Row["Price"]);
                                                            $SendSalePrice = round($Prodcuts_Row["Price"] - $NewPrice);
                                                    ?>
                                                            <span class="price">
                                                                <span class="old">
                                                                    Rs. <?php echo  number_format($Prodcuts_Row["Price"], 2) ?>
                                                                </span>
                                                                <span class="new">
                                                                    Rs. <?php echo  number_format($SendSalePrice, 2) ?>
                                                                </span>
                                                            </span>
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
                                                                        $NewPrice = (((int) $rowSale["Value"] / 100) * $Prodcuts_Row["Price"]);
                                                                        $SendSalePrice = round($Prodcuts_Row["Price"] - $NewPrice);
                                                            ?>
                                                                        <span class="price">
                                                                            <span class="old">
                                                                                Rs. <?php echo  number_format($Prodcuts_Row["Price"], 2) ?>
                                                                            </span>
                                                                            <span class="new">
                                                                                Rs. <?php echo  number_format($SendSalePrice, 2) ?>
                                                                            </span>
                                                                        </span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span class="price">
                                                                            <span class="price">
                                                                                Rs. <?php echo  number_format($Prodcuts_Row["Price"], 2) ?>
                                                                            </span>
                                                                        </span>
                                                    <?php
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <!-- Hidden Items Start -->
                                                    <form class="Add_To_Cart_Form">
                                                        <?php
                                                        if ($SendSalePrice != 0) {
                                                        ?>
                                                            <!-- Base Price -->
                                                            <input type="hidden" class="QuickBasePrice" value="<?php echo  $SendSalePrice ?>">
                                                            <input type="hidden" name="CartProductUpdatedPrice" value="<?php echo  $SendSalePrice ?>">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <!-- Base Price -->
                                                            <input type="hidden" class="QuickBasePrice" value="<?php echo $Prodcuts_Row["Price"] ?>">
                                                            <input type="hidden" name="CartProductUpdatedPrice" value="<?php echo  $Prodcuts_Row["Price"] ?>">
                                                        <?php
                                                        }
                                                        ?>
                                                        <!-- Add Unit Values -->
                                                        <input type="hidden" value="<?php echo $Prodcuts_Row["UnitPrice"] ?>" name="Hidden_Unit_Price">
                                                        <input type="hidden" value="<?php echo $Prodcuts_Row["Unit_Quantity"] ?>" name="Hidden_Unit_Price">
                                                        <!-- Add Unit Values -->
                                                        <input type="hidden" name="CartProductPrice" value="<?php echo $Prodcuts_Row["Price"] ?>">
                                                        <input type="hidden" name="CartProductID" value="<?php echo $Product_ID ?>">
                                                        <input type="hidden" name="CartProductName" value="<?php echo $Prodcuts_Row["Name"] ?>">
                                                        <input type="hidden" name="CartProductQuantity" value="<?php echo $Prodcuts_Row["Minimum"] ?>">
                                                        <input type="hidden" class="CartProductPrice" name="CartShiipProductPrice" value="<?php echo $Prodcuts_Row["Shipping_Price"] ?>">
                                                        <input type="hidden" name="CartProductImg" value="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>">
                                                        <input type="hidden" name="CartProductColor" class="CartProductColor" value="<?php echo $Prodcuts_Row["DColor"] ?>">
                                                        <input type="hidden" name="CartProductSize" class="CartProductSize" value="<?php echo $Prodcuts_Row["DSize"] ?>">
                                                        <input type="hidden" name="CartProductWeight" value="">
                                                        <input type="hidden" name="CartProductSaleID" value="<?php echo $SendSaleId ?>">
                                                        <!-- Hidden Items End -->
                                                        <div class="product-buttons">
                                                            <a href="#quickViewModal" data-toggle="modal" class="product-button Quick_Veiw_Btn hintT-top" data-id="<?php echo $Product_ID ?>" data-hint="Quick View">
                                                                <i class="fal fa-search Quick_Veiw_Icon" data-id="<?php echo $Product_ID ?>"></i>
                                                            </a>
                                                            <button class="product-button hintT-top border-0" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></button>
                                                            <!-- <a href="#" class="product-button hintT-top" data-hint="Compare"><i class="fal fa-random"></i></a> -->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                
                            
                            ?>


                        </div>
                        <!-- Products End -->
                        <!-- <div class="text-center learts-mt-70">
                            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="ti-plus"></i> More</a>
                        </div> -->
                    </div>
                </div>

            </div>
            <!-- Shop Products Section End -->
        <?php } else {
        ?>
            <!-- Shop Products Section Start -->
            <div class="section section-padding pt-0">

                <!-- Shop Toolbar Start -->
                <div class="shop-toolbar border-bottom">
                    <div class="container">
                        <div class="row learts-mb-n20">

                            <!-- Isotop Filter Start -->
                            <?php
                            $SQL_Cat = "SELECT * FROM `category`  WHERE `Parent_ID` IS NULL  ORDER BY `category`.`Sort_Order` DESC";
                            $Check_Cat = mysqli_query($connection, $SQL_Cat);
                            if ($Check_Cat) {
                                if (mysqli_num_rows($Check_Cat) > 0) {
                            ?>
                                    <div class="col-md col-12 align-self-center learts-mb-20">
                                        <div class="isotope-filter shop-product-filter" data-target="#shop-products">
                                            <button class="active" data-filter="*">all</button>
                                            <?php
                                            while ($Fetch_Cat = mysqli_fetch_array($Check_Cat)) {
                                            ?>
                                                <button data-filter=".Sort_List_No_<?php echo $Fetch_Cat["ID"] ?>"><?php echo $Fetch_Cat["Name"] ?></button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <!-- Isotop Filter End -->

                            <div class="col-md-auto col-12 learts-mb-20">
                                <ul class="shop-toolbar-controls">

                                    <li>
                                        <div class="product-sorting">
                                            <select class="nice-select">
                                                <option value="menu_order" selected="selected">Default sorting</option>
                                                <option value="popularity">Sort by popularity</option>
                                                <option value="rating">Sort by average rating</option>
                                                <option value="date">Sort by latest</option>
                                                <option value="price">Sort by price: low to high</option>
                                                <option value="price-desc">Sort by price: high to low</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="product-column-toggle d-none d-xl-flex">
                                            <button class="toggle active hintT-top" data-hint="5 Column" data-column="5"><i class="ti-layout-grid4-alt"></i></button>
                                            <button class="toggle hintT-top" data-hint="4 Column" data-column="4"><i class="ti-layout-grid3-alt"></i></button>
                                            <button class="toggle hintT-top" data-hint="3 Column" data-column="3"><i class="ti-layout-grid2-alt"></i></button>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="product-filter-toggle" href="#product-filter">Filters</a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Shop Toolbar End -->

                <!-- Product Filter Start -->
                <div id="product-filter" class="product-filter bg-light">
                    <div class="container">
                        <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 learts-mb-n30">

                            <!-- Sort by Start -->
                            <div class="col learts-mb-30">
                                <h3 class="widget-title product-filter-widget-title">Sort by</h3>
                                <ul class="widget-list product-filter-widget customScroll">
                                    <li><a href="#">Popularity</a></li>
                                    <li><a href="#">Average rating</a></li>
                                    <li><a href="#">Newness</a></li>
                                    <li><a href="#">Price: low to high</a></li>
                                    <li><a href="#">Price: high to low</a></li>
                                </ul>
                            </div>
                            <!-- Sort by End -->

                            <!-- Price filter Start -->
                            <!-- <div class="col learts-mb-30">
                                <h3 class="widget-title product-filter-widget-title">Price filter</h3>
                                <ul class="widget-list product-filter-widget customScroll">
                                    <li> <a href="#">All</a></li>
                                    <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>0.00</span> - <span class="amount"><span class="cur-symbol">£</span>80.00</span></a></li>
                                    <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>80.00</span> - <span class="amount"><span class="cur-symbol">£</span>160.00</span></a></li>
                                    <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>160.00</span> - <span class="amount"><span class="cur-symbol">£</span>240.00</span></a></li>
                                    <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>240.00</span> - <span class="amount"><span class="cur-symbol">£</span>320.00</span></a></li>
                                    <li> <a href="#"><span class="amount"><span class="cur-symbol">£</span>320.00</span> +</a></li>
                                </ul>
                            </div> -->
                            <!-- Price filter End -->

                            <!-- Categories Start -->
                            <div class="col learts-mb-30">
                                <h3 class="widget-title product-filter-widget-title">Categories</h3>
                                <ul class="widget-list product-filter-widget customScroll">
                                    <li><a href="#">Gift ideas</a> <span class="count">16</span></li>
                                    <li><a href="#">Home Decor</a> <span class="count">16</span></li>
                                    <li><a href="#">Kids &amp; Babies</a> <span class="count">6</span></li>
                                    <li><a href="#">Kitchen</a> <span class="count">15</span></li>
                                    <li><a href="#">Kniting &amp; Sewing</a> <span class="count">4</span></li>
                                    <li><a href="#">Pots</a> <span class="count">4</span></li>
                                    <li><a href="#">Toys</a> <span class="count">6</span></li>
                                </ul>
                            </div>
                            <!-- Categories End -->

                            <!-- Filters by colors Start -->
                            <!-- <div class="col learts-mb-30">
                                <h3 class="widget-title product-filter-widget-title">Filters by colors</h3>
                                <ul class="widget-colors product-filter-widget customScroll">
                                    <li><a href="#" class="hintT-top" data-hint="Black"><span data-bg-color="#000000">Black</span></a></li>
                                    <li><a href="#" class="hintT-top" data-hint="White"><span data-bg-color="#FFFFFF">White</span></a></li>
                                    <li><a href="#" class="hintT-top" data-hint="Dark Red"><span data-bg-color="#b2483c">Dark Red</span></a></li>
                                    <li><a href="#" class="hintT-top" data-hint="Flaxen"><span data-bg-color="#d5b85a">Flaxen</span></a></li>
                                    <li><a href="#" class="hintT-top" data-hint="Pine"><span data-bg-color="#01796f">Pine</span></a></li>
                                    <li><a href="#" class="hintT-top" data-hint="Tortilla"><span data-bg-color="#997950">Tortilla</span></a></li>
                                </ul>
                            </div> -->
                            <!-- Filters by colors End -->

                            <!-- Brands Start -->
                            <!-- <div class="col learts-mb-30">
                                <h3 class="widget-title product-filter-widget-title">Brands</h3>
                                <ul class="widget-list product-filter-widget customScroll">
                                    <li><a href="#">Alexander</a> <span class="count">(2)</span></li>
                                    <li><a href="#">Carmella</a> <span class="count">(4)</span></li>
                                    <li><a href="#">Danielle</a> <span class="count">(7)</span></li>
                                    <li><a href="#">Diana Day</a> <span class="count">(13)</span></li>
                                    <li><a href="#">Emilia</a> <span class="count">(2)</span></li>
                                    <li><a href="#">Gasmine</a> <span class="count">(15)</span></li>
                                    <li><a href="#">Jack &amp; Ella</a> <span class="count">(7)</span></li>
                                    <li><a href="#">Juliette</a> <span class="count">(11)</span></li>
                                </ul>
                            </div> -->
                            <!-- Brands End -->

                        </div>
                    </div>
                </div>
                <!-- Product Filter End -->

                <div class="section learts-mt-70">
                    <div class="container">
                        <!-- Products Start -->
                        <div id="shop-products" class="products isotope-grid row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">

                            <div class="grid-sizer col-1"></div>
                            <?php
                            // ? Individual Product Start
                            $SQL_Cat = "SELECT * FROM `category`  WHERE `Parent_ID` IS NULL  ORDER BY `category`.`Sort_Order` DESC";
                            $Check_Cat = mysqli_query($connection, $SQL_Cat);
                            if ($Check_Cat) {
                                if (mysqli_num_rows($Check_Cat) > 0) {
                                    while ($Fetch_Cat = mysqli_fetch_array($Check_Cat)) {
                                        $ID = $Fetch_Cat["ID"];
                                        $Sub_Cat_SQL = "SELECT * FROM `category`  WHERE `Parent_ID`=$ID  ORDER BY `category`.`Sort_Order` DESC ";
                                        $Sub_Cat_Check = mysqli_query($connection, $Sub_Cat_SQL);
                                        if ($Sub_Cat_Check) {
                                            while ($Sub_Cat_Row = mysqli_fetch_array($Sub_Cat_Check)) {
                                                $Cat_ID = $Sub_Cat_Row["ID"];
                                                $Prodcucts_SQL = "SELECT * FROM `products` WHERE `Category_ID`= $Cat_ID ORDER BY `products`.`SortOrder` DESC ";
                                                $Prodcucts_Check = mysqli_query($connection, $Prodcucts_SQL);
                                                while ($Prodcuts_Row = mysqli_fetch_array($Prodcucts_Check)) {
                                                    $Prodcuts_ID = $Prodcuts_Row["ID"];
                                                    $Product_ID = $Prodcuts_Row["ID"];
                            ?>
                                                    <div class="grid-item col Sort_List_No_<?php echo  $Fetch_Cat["ID"] ?>">
                                                        <div class="product">
                                                            <div class="product-thumb">
                                                                <a href="detail.php?Product=<?php echo $Prodcuts_Row["ID"] ?>" class="image">
                                                                    <!-- Sale Percent Start -->
                                                                    <span class="product-badges" id="Sale_Off_veiw">
                                                                        <?php
                                                                        $FetchSale = "SELECT `Value` FROM `sale` WHERE ((`Cat_ID`=$Cat_ID OR `Prodcut_ID`= $Product_ID) AND `Date_End`>'$currentDate')";
                                                                        $checkSale = mysqli_query($connection, $FetchSale);
                                                                        if ($checkSale) {
                                                                            if (mysqli_num_rows($checkSale) > 0) {
                                                                                $rowSale = mysqli_fetch_array($checkSale);
                                                                        ?>
                                                                                <span class="onsale" id="Sale_Off_Val"><?php echo $rowSale["Value"] ?></span>
                                                                                <?php
                                                                            } else {
                                                                                $catSql = "SELECT * FROM `category` WHERE `ID` = $Cat_ID ";
                                                                                $CheckCat = mysqli_query($connection, $catSql);
                                                                                if ($CheckCat) {
                                                                                    // Check By Category
                                                                                    $RowCat = mysqli_fetch_array($CheckCat);
                                                                                    $MainCatID = $RowCat["Parent_ID"];
                                                                                    $MainCatSql = "SELECT `Value` FROM `sale` WHERE `Cat_ID`=$MainCatID AND `Date_End`>'$currentDate'";
                                                                                    $checkMainCat = mysqli_query($connection, $MainCatSql);
                                                                                    if ($checkMainCat) {
                                                                                        if (mysqli_num_rows($checkMainCat) > 0) {
                                                                                            $rowSale = mysqli_fetch_array($checkMainCat);
                                                                                ?>
                                                                                            <span class="onsale" id="Sale_Off_Val">-<?php echo $rowSale["Value"] ?>%</span>
                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                    <!-- Sale Percent ENd -->
                                                                    <?php
                                                                    $Load_ExImg = "SELECT * FROM `products_images` WHERE `Product_ID` = $Prodcuts_ID";
                                                                    $Check_ExImg = mysqli_query($connection, $Load_ExImg);
                                                                    $Row_ExImg = mysqli_fetch_array($Check_ExImg);
                                                                    if (mysqli_num_rows($Check_ExImg) > 0) {
                                                                    ?>
                                                                        <img src="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>">
                                                                        <img class="image-hover" src="admin/uploads/Products/<?php echo $Row_ExImg["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>(1)">
                                                                    <?php } else {
                                                                    ?>
                                                                        <img src="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>" alt="<?php echo $Prodcuts_Row["Name"] ?>">
                                                                    <?php
                                                                    } ?>
                                                                </a>
                                                                <!-- <a href="wishlist.html" class="add-to-wishlist hintT-left" data-hint="Add to wishlist"><i class="far fa-heart"></i></a> -->
                                                            </div>
                                                            <div class="product-info">
                                                                <h6 class="title"><a href="detail.php?Product=<?php echo $Prodcuts_Row["ID"] ?>"><?php echo $Prodcuts_Row["Name"] ?></a></h6>
                                                                <!-- Check Sale  -->
                                                                <?php
                                                                $FetchSale = "SELECT * FROM `sale` WHERE ((`Cat_ID`=$Cat_ID OR `Prodcut_ID`= $Product_ID) AND `Date_End`>'$currentDate')";
                                                                $checkSale = mysqli_query($connection, $FetchSale);
                                                                if ($checkSale) {
                                                                    if (mysqli_num_rows($checkSale) > 0) {
                                                                        $rowSale = mysqli_fetch_array($checkSale);
                                                                        $SendSaleId = $rowSale["ID"];
                                                                        $NewPrice = (((int) $rowSale["Value"] / 100) * $Prodcuts_Row["Price"]);
                                                                        $SendSalePrice = round($Prodcuts_Row["Price"] - $NewPrice);
                                                                ?>
                                                                        <span class="price">
                                                                            <span class="old">
                                                                                Rs. <?php echo  number_format($Prodcuts_Row["Price"], 2) ?>
                                                                            </span>
                                                                            <span class="new">
                                                                                Rs. <?php echo  number_format($SendSalePrice, 2) ?>
                                                                            </span>
                                                                        </span>
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
                                                                                    $NewPrice = (((int) $rowSale["Value"] / 100) * $Prodcuts_Row["Price"]);
                                                                                    $SendSalePrice = round($Prodcuts_Row["Price"] - $NewPrice);
                                                                        ?>
                                                                                    <span class="price">
                                                                                        <span class="old">
                                                                                            Rs. <?php echo  number_format($Prodcuts_Row["Price"], 2) ?>
                                                                                        </span>
                                                                                        <span class="new">
                                                                                            Rs. <?php echo  number_format($SendSalePrice, 2) ?>
                                                                                        </span>
                                                                                    </span>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <span class="price">
                                                                                        <span class="price">
                                                                                            Rs. <?php echo  number_format($Prodcuts_Row["Price"], 2) ?>
                                                                                        </span>
                                                                                    </span>
                                                                <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <!-- Hidden Items Start -->
                                                                <form class="Add_To_Cart_Form">
                                                                    <?php
                                                                    if ($SendSalePrice != 0) {
                                                                    ?>
                                                                        <!-- Base Price -->
                                                                        <input type="hidden" class="QuickBasePrice" value="<?php echo  $SendSalePrice ?>">
                                                                        <input type="hidden" name="CartProductUpdatedPrice" value="<?php echo  $SendSalePrice ?>">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <!-- Base Price -->
                                                                        <input type="hidden" class="QuickBasePrice" value="<?php echo $Prodcuts_Row["Price"] ?>">
                                                                        <input type="hidden" name="CartProductUpdatedPrice" value="<?php echo  $Prodcuts_Row["Price"] ?>">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <!-- Add Unit Values -->
                                                                    <input type="hidden" value="<?php echo $Prodcuts_Row["UnitPrice"] ?>" name="Hidden_Unit_Price">
                                                                    <input type="hidden" value="<?php echo $Prodcuts_Row["Unit_Quantity"] ?>" name="Hidden_Unit_Price">
                                                                    <!-- Add Unit Values -->
                                                                    <input type="hidden" name="CartProductPrice" value="<?php echo $Prodcuts_Row["Price"] ?>">
                                                                    <input type="hidden" name="CartProductID" value="<?php echo $Product_ID ?>">
                                                                    <input type="hidden" name="CartProductName" value="<?php echo $Prodcuts_Row["Name"] ?>">
                                                                    <input type="hidden" name="CartProductQuantity" value="<?php echo $Prodcuts_Row["Minimum"] ?>">
                                                                    <input type="hidden" class="CartProductPrice" name="CartShiipProductPrice" value="<?php echo $Prodcuts_Row["Shipping_Price"] ?>">
                                                                    <input type="hidden" name="CartProductImg" value="admin/uploads/Products/<?php echo $Prodcuts_Row["Image"] ?>">
                                                                    <input type="hidden" name="CartProductColor" class="CartProductColor" value="<?php echo $Prodcuts_Row["DColor"] ?>">
                                                                    <input type="hidden" name="CartProductSize" class="CartProductSize" value="<?php echo $Prodcuts_Row["DSize"] ?>">
                                                                    <input type="hidden" name="CartProductWeight" value="">
                                                                    <input type="hidden" name="CartProductSaleID" value="<?php echo $SendSaleId ?>">
                                                                    <!-- Hidden Items End -->
                                                                    <div class="product-buttons">
                                                                        <a href="#quickViewModal" data-toggle="modal" class="product-button Quick_Veiw_Btn hintT-top" data-id="<?php echo $Product_ID ?>" data-hint="Quick View">
                                                                            <i class="fal fa-search Quick_Veiw_Icon" data-id="<?php echo $Product_ID ?>"></i>
                                                                        </a>
                                                                        <button class="product-button hintT-top border-0" data-hint="Add to Cart"><i class="fal fa-shopping-cart"></i></button>
                                                                        <!-- <a href="#" class="product-button hintT-top" data-hint="Compare"><i class="fal fa-random"></i></a> -->
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                            <?php }
                                }
                            }
                            ?>


                        </div>
                        <!-- Products End -->
                        <!-- <div class="text-center learts-mt-70">
                            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="ti-plus"></i> More</a>
                        </div> -->
                    </div>
                </div>

            </div>
            <!-- Shop Products Section End -->
        <?php
        } ?>


        <!-- Footer -->
        <?php require("includes/footer.php") ?>

        <!-- Modal -->
        <?php require("includes/quick-veiw.php") ?>


        <!-- JS
    ============================================ -->

        <?php require("includes/js.php") ?>
    </body>


    </html>