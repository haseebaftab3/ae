<?php
if (!isset($_SESSION)) {
    session_start();
}
$TotalPrice = 0;
$total = 0;
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
                        <h1 class="title">Cart</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Cart</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Shopping Cart Section Start -->
    <div class="section section-padding">
        <div class="container">
            <?php
            if (!empty($_SESSION["shopping_cart"])) {
            ?>
                <!-- <form class="cart-form" action="#"> -->
                    <div id="msg_Cart_Qun"></div>
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">Product</th>
                            <th class="price">Price</th>
                            <th class="quantity">Quantity</th>
                            <th class="subtotal">Total</th>
                            <th class="remove">&nbsp;</th>
                            <th class="remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                        ?>
                            <tr>
                                <td class="thumbnail"><a href="product-details.php"><img src="<?php echo $values["item_img"]; ?>" alt="cart_item_<?php echo $values["item_name"]; ?>"></a></td>
                                <td class="name">
                                    <a href="product-details.php"><?php echo $values["item_name"]; ?></a>
                                    <?php
                                    if ($values["item_color"] !== "NULL" && $values["item_color"] != 0 && !empty($values["item_color"]) && isset($values["item_color"])) {
                                    ?>
                                        <span class="quantity-price">Color: <?php echo $values["item_color"]; ?> </span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="price"><span>Rs. <?php echo  number_format($values["item_updated_price"], 2); ?></span></td>
                                <td class="quantity">
                                    <?php
                                    require("./connection.php");
                                    $Min_Qun_SQL = "SELECT `Minimum` FROM `products` WHERE `ID` = {$values['item_id']}";
                                    $Check_Min_Qun = mysqli_query($connection, $Min_Qun_SQL);
                                    if (mysqli_num_rows($Check_Min_Qun) > 0) {
                                        $Row_Min_Qun = mysqli_fetch_array($Check_Min_Qun);
                                    ?>
                                        <div class="product-quantity" data-id="<?php echo $Row_Min_Qun["Minimum"]; ?>">
                                            <span class="MinusQuntBtn qty-btn minus"><i class="ti-minus"></i></span>
                                            <input type="text" class="input-qty CartQuantity<?php echo $values["item_index"] ?>" min="<?php echo $values["item_quantity"]; ?>" value="<?php echo $values["item_quantity"]; ?>">
                                            <span class="PlusQuntBtn qty-btn plus"><i class="ti-plus"></i></span>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </td>
                                <td class="subtotal"><span><?php echo "Rs. " . number_format($values["item_quantity"] *  $NetPrice, 2); ?></span></td>
                                <td>
                                    <button type="submit" data-id="<?php echo $values["item_index"] ?>" class=" btn btn-dark btn-outline-hover-dark mb-3 Cart_Upate_btn">Update Item</button>
                                </td>
                                <?php
                                if (strpos(basename($_SERVER['REQUEST_URI']), "?")) {
                                ?>
                                    <td class="remove"> <a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&action=delete&id=<?php echo $values["item_index"]; ?>" class="remove">×</a></td>
                                <?php } else {
                                ?>
                                    <td class="remove"><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>?action=delete&id=<?php echo $values["item_index"]; ?>" class="remove">×</a></td>
                                <?php
                                } ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row justify-content-between mb-n3">
                    <div class="col-auto mb-3">
                        <div class="cart-coupon">
                            <input type="text" placeholder="Enter your coupon code">
                            <button class="btn"><i class="fal fa-gift"></i></button>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-light btn-hover-dark mr-3 mb-3" href="shop.php">Continue Shopping</a>
                    </div>
                </div>
                <!-- </form> -->
            <?php
            } else {
                echo "<script>window.location.href='shop.php'</script>";
            }
            ?>
            <div class="cart-totals mt-5">
                <h2 class="title">Cart totals</h2>
                <table>
                    <tbody>
                        <tr class="subtotal">
                            <th>Subtotal</th>
                            <td><span class="amount">Rs. <?php echo number_format($TotalPrice, 2); ?></span></td>
                        </tr>
                        <tr class="total">
                            <th>Total</th>
                            <td><strong><span class="amount">Rs. <?php echo number_format($TotalPrice, 2); ?></span></strong></td>
                        </tr>
                    </tbody>
                </table>
                <a href="checkout.php" class="btn btn-dark btn-outline-hover-dark">Proceed to checkout</a>
            </div>
        </div>

    </div>
    <!-- Shopping Cart Section End -->

    <!-- Footer -->
    <?php require("includes/footer.php") ?>

    <!-- Modal -->
    <?php require("includes/quick-veiw.php") ?>


    <!-- JS
============================================ -->

    <?php require("includes/js.php") ?>

    <script>
        $(".input-qty").change(function(e) {
            var Target_Parent = $(e.target).parent(".product-quantity");
            var Target_Parent_alt = $(e.target).parent().parent(".product-quantity");
            var OrgQun = Target_Parent.attr("data-id");
            // alert($(Target_Parent.children(".input-qty")).val());
            // alert(OrgQun);

            if (parseInt($(Target_Parent.children(".input-qty")).val()) <= parseInt(OrgQun)) {
                Target_Parent.children(".MinusQuntBtn").css("display", "none")
                Target_Parent.children(".input-qty").val(OrgQun);
            } else {
                Target_Parent.children(".MinusQuntBtn").css("display", "unset");
            }
        });

        $(".MinusQuntBtn").click(function(e) {
            var Target_Parent = $(e.target).parent().parent(".product-quantity");
            var OrgQun = Target_Parent.attr("data-id");
            // alert(OrgQun);
            // alert($(Target_Parent.children(".input-qty")).val());

            if (parseInt($(Target_Parent.children(".input-qty")).val()) <= parseInt(OrgQun)) {
                Target_Parent.children(".MinusQuntBtn").css("display", "none");
                Target_Parent.children(".input-qty").val(OrgQun);
            } else {
                Target_Parent.children(".MinusQuntBtn").css("display", "unset");
            }
        });
        $(".PlusQuntBtn").click(function(e) {
            var Target_Parent = $(e.target).parent().parent(".product-quantity");
            var OrgQun = Target_Parent.attr("data-id");
            // alert(OrgQun);

            if (parseInt($(Target_Parent.children(".input-qty")).val()) <= parseInt(OrgQun)) {
                Target_Parent.children(".MinusQuntBtn").css("display", "none")
                Target_Parent.children(".input-qty").val(OrgQun);
            } else {
                Target_Parent.children(".MinusQuntBtn").css("display", "unset")
            }
        });
    </script>
</body>


</html>