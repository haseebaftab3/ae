<?php
if (!isset($_SESSION)) {
    session_start();
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
    <!--Preloader-->
    <!-- <div class="preloader">
        <div class="preloader-after"></div>
        <div class="preloader-before hidden"></div>
        <div class="preloader-block">
            <div class="title">Abid Electrics</div>
            <div class="percent">0</div>
            <div class="loading">loading...</div>
        </div>
        <div class="preloader-bar">
            <div class="preloader-progress"></div>
        </div>
    </div> -->
    
    <!-- Preloader Start -->
    <?php require("includes/preloader.php"); ?>
    <!-- Preloader Section End -->
    
    <div class="after-loader" style="display: none;">
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

        <!-- Blog Section Start -->
    <div class="section section-padding">
        <div class="container">
             <!-- Section Title Start -->
               
            <div class="row learts-mb-n50">

                <div class="col-xl-12 col-lg-12 col-12 learts-mb-50">
                    <div class="row learts-mb-n40">
                        <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="#"><img src="./assets/images/banner/news&events/1.jpg" alt="Events"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="#"><img src="./assets/images/banner/news&events/2.jpg" alt="Events"></a>
                                </div>
                               
                            </div>
                    </div>
                    <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="#"><img src="./assets/images/banner/news&events/3.jpg" alt="Events"></a>
                                </div>
                               
                            </div>
                    </div>  
                    
                    <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="#"><img src="./assets/images/banner/news&events/4.jpg" alt="Events"></a>
                                </div>
                               
                            </div>
                    </div>

                    <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="#"><img src="./assets/images/banner/news&events/5.jpg" alt="Events"></a>
                                </div>
                               
                            </div>
                    </div>

                      <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="#"><img src="./assets/images/banner/news&events/6.jpg" alt="Events"></a>
                                </div>
                               
                            </div>
                    </div>
                    
                </div>

                

            </div>
        </div>

    </div>
    <!-- Blog Section End -->


        <!-- Succes Shop Modal -->
        <?php if (isset($_SESSION["Order_Msg"])  && !empty($_SESSION["Order_Msg"]) && $_SESSION["Order_Msg"] == "Done") { ?>

            <div class="container d-flex justify-content-center">
                <div id="SuccessShopModel" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered justify-content-center modal-lg" role="document">
                        <div class="modal-content border-0 mx-3">
                            <div class="modal-body p-0">

                                <div class="card text-center">
                                    <div class="card-header pb-0 bg-white border-0">
                                        <div class="row">
                                            <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                        </div><img src="./assets/images//icons/trophy.png" class="img-fluid mt-5" />
                                        <h3>
                                            You Successfully Placed Your Order ... What's Next?
                                        </h3>
                                    </div>
                                    <div class="card-body px-sm-5 mb-5">
                                        <p class="text-muted mb-0">You received an order confirmation followed by an order update that you are now "awaiting fulfillment" ... but what does that mean? It simply means your order have not yet shipped. Your order status will be updated when your order shipped. For a full list of Order Status Definitions, see below.</p>
                                        <p class="text-muted "> Have questions ? <span class="touch"> Get in touch </span></p>
                                        <div class="row justify-content-center mt-4 px-sm-5 ">
                                            <div class="col"><a href="mailto:contact@abidelectric.com" class="btn btn-inverse btn-block font-weight-bold text-dark text-uppercase"><span class="plan">Email</span></a></div>
                                            <div class="col"><button type="button" class="btn btn-success btn-block  font-weight-bold text-uppercase text-light  mt-2" data-dismiss="modal"><span class="plan">Whatsapp</span></button></div>
                                        </div>-
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Footer -->
        <?php require("includes/footer.php") ?>

        <!-- Modal -->
        <?php require("includes/quick-veiw.php") ?>


        <!-- JS
    ============================================ -->

        <?php require("includes/js.php") ?>

        <?php if (isset($_SESSION["Order_Msg"])  && !empty($_SESSION["Order_Msg"]) && $_SESSION["Order_Msg"] == "Done") { ?>
            <script>
                $(function() {
                    $(window).on('load', function() {
                        $('#SuccessShopModel').modal('show');
                    });

                })
            </script>
        <?php
            $_SESSION["Order_Msg"] = "NAN";
        }
        ?>

    </div>
</body>


</html>