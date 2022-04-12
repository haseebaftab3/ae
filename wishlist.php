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
                        <h1 class="title">Wishlist</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Wishlist</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Wishlist Section Start -->
    <div class="section section-padding">
        <div class="container">
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                        <tr>
                            <th class="name" colspan="2">Product</th>
                            <th class="price">Unit Price</th>
                            <th class="add-to-cart">&nbsp;</th>
                            <th class="remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="thumbnail"><a href="product-details.html"><img src="assets/images/product/cart-product-1.jpg"></a></td>
                            <td class="name"> <a href="product-details.html">Walnut Cutting Board</a></td>
                            <td class="price"><span>£100.00</span></td>
                            <td class="add-to-cart"><a href="#" class="btn btn-light btn-hover-dark"><i class="fal fa-shopping-cart mr-2"></i>Add to Cart</a></td>
                            <td class="remove"><a href="#" class="btn">×</a></td>
                        </tr>
                        <tr>
                            <td class="thumbnail"><a href="product-details.html"><img src="assets/images/product/cart-product-2.jpg"></a></td>
                            <td class="name"> <a href="product-details.html">Lucky Wooden Elephant</a></td>
                            <td class="price"><span>£35.00</span></td>
                            <td class="add-to-cart"><a href="#" class="btn btn-light btn-hover-dark"><i class="fal fa-shopping-cart mr-2"></i>Add to Cart</a></td>
                            <td class="remove"><a href="#" class="btn">×</a></td>
                        </tr>
                        <tr>
                            <td class="thumbnail"><a href="product-details.html"><img src="assets/images/product/cart-product-3.jpg"></a></td>
                            <td class="name"> <a href="product-details.html">Fish Cut Out Set</a></td>
                            <td class="price"><span>£9.00</span></td>
                            <td class="add-to-cart"><a href="#" class="btn btn-light btn-hover-dark"><i class="fal fa-shopping-cart mr-2"></i>Add to Cart</a></td>
                            <td class="remove"><a href="#" class="btn">×</a></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-center mb-n3">
                        <a class="btn btn-light btn-hover-dark mr-3 mb-3" href="shop.html">Continue Shopping</a>
                        <a class="btn btn-dark btn-outline-hover-dark mb-3" href="shopping-cart.html">View Cart</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- Wishlist Section End -->
    <!-- Footer -->
    <?php require("includes/footer.php") ?>

    <!-- Modal -->
    <?php require("includes/quick-veiw.php") ?>


    <!-- JS
============================================ -->

    <?php require("includes/js.php") ?>

</body>

</html>