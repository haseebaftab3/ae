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

        <!-- Slider main container Start -->
        <div class="section" style="overflow: hidden!important;">
            <div class="container">

                <div class="home4-slider swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $Load_Slider = "SELECT * FROM `slider` LIMIT 10";
                        $Check_Slider = mysqli_query($connection, $Load_Slider);
                        if ($Check_Slider) {
                            if (mysqli_num_rows($Check_Slider) > 0) {
                                $i = 0;
                                while ($Row_Slider = mysqli_fetch_array($Check_Slider)) {
                        ?>
                                    <div class="home4-slide-item swiper-slide" data-swiper-autoplay="5000">
                                        <div class="home4-slide-image"><img src="admin/uploads/slider/<?php echo $Row_Slider["Image"]; ?>" alt="<?php echo $Row_Slider["Alt"]; ?>""></div>
                            <div class=" home4-slide-content">
                                            <span class="category mb-2 text-white"><?php echo $Row_Slider["Detail"]; ?></span>
                                            <h2 class="title text-white mb-3"><?php echo $Row_Slider["Title"]; ?></h2>
                                            <?php 
                                            if(!empty($Row_Slider["Link"])){
                                            ?>
                                            <div class="link"><a href="<?php echo $Row_Slider["Link"]; ?>" class="btn btn-black btn-outline-hover-black">shop now</a></div>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>


                    </div>
                    <div class="home4-slider-prev swiper-button-prev"><i class="ti-angle-left"></i></div>
                    <div class="home4-slider-next swiper-button-next"><i class="ti-angle-right"></i></div>
                    <div class="home4-slider-pagination swiper-pagination"></div>
                </div>
            </div>
        </div>
        <!-- Slider main container End -->

        <!-- Category Banner Section Start -->
        <div class="section section-fluid learts-pt-30 bg-white">
            <div class="container">
                <div class="row learts-mb-n30">

                    <div class="col-xxl-9 col-xl-9 col-12 learts-mb-30 p-0">
                        <div class="learts-blockquote" style="background-color:#D0261D">
                            <div class="inner">
                                <h2 class="title " style="color:#fffc20">We complete a Beautiful Interior with a Safe Experience.</h2>
                                <div class="desc" style="color:#FFF">
                                    <p>I find myself thankful to the Almighty, for He has made me a source of trust and satisfaction for numerous customers over the Years. I feel pride in representing this company and its high standards of care for its products and its customers.</p>
                                </div>
                                <a href="about-us.php" class="link text-light">CEO's Message</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-md-6 col-12 learts-mb-30 p-0">
                        <div class="sale-banner3-1">
                            <div class="image "><img data-src="https://abidelectric.sirv.com/CEO/2.PNG?format=webp&webp.fallback=png" class=" w-auto lazy" alt="CEO Abid Electric's" style="height: 313px;"></div>
                            <!-- <div class="content">
                                <span class="special-title">Spring sale</span>
                                <h2 class="title">Sale up to 10% all</h2>
                                <a href="#" class="link">SHOP NOW</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category Banner Section End -->


        <!-- Feature Section Start -->
        <div class="section section-padding pt-5">
            <div class="container">
                <div class="row learts-mb-n30">
                    <div class="col-xl-3 col-lg-4 col-12 mr-auto learts-mb-30">
                        <h1 class="fw-400">
                            We Serve What You Desire
                        </h1>
                    </div>
                    <div class="col-lg-8 col-12 learts-mb-30">
                        <div class="row learts-mb-n30">
                            <div class="col-md-6 col-12 learts-mb-30">
                                <p class="text-heading fw-600 learts-mb-10">Quality Assurance</p>
                                <p>
                                    At ABID’s, we never compromise on quality, and provide what’s in your best interest.
                                </p>
                            </div>

                             <div class="col-md-6 col-12 learts-mb-30">
                                <p class="text-heading fw-600 learts-mb-10">Customer Service</p>
                                <p>
                                    We always prioritize our customers need at hand all time, and wish to continue it to the end
                                </p>
                            </div>

                            <div class="col-md-6 col-12 learts-mb-30">
                                <p class="text-heading fw-600 learts-mb-10">On Time Delivery</p>
                                <p>
                                    The company has a strict time policy, of a 2-3 days delivery time for each and every order.
                                </p>
                            </div>

                            <div class="col-md-6 col-12 learts-mb-30">
                                <p class="text-heading fw-600 learts-mb-10">Tradition of Trust</p>
                                <p>
                                    ABID has always put its clients trust above the company’s interests and tend to maintain this tradition.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature Section End -->

        <!-- Product/Sale Banner Section Start -->
        <div class="section section-padding pt-0">
            <div class="container">
                <div class="row row-cols-lg-2 row-cols-1 learts-mb-n30">

                    <div class="col learts-mb-30">
                        <a href="./downloads" target="_blank">
                            <div class="sale-banner8">
                                <img class="lazy" data-src="assets/images/banner/sale/1.jpg" alt="" />
                                <!-- <div class="content">
                                <h2 class="title">Little simple <br> things</h2>
                                <a href="#" class="link">shop now</a>
                            </div> -->
                            </div>
                        </a>
                    </div>

                    <div class="col learts-mb-30">
                        <a href="./shop.php">
                            <div class="sale-banner8">
                                <img class="lazy" data-src="assets/images/banner/sale/2.jpg" alt="" />
                                <!-- <div class="content">
                                <h2 class="title">Holiday <br> Gifts</h2>
                                <a href="#" class="link">shop now</a>
                            </div> -->
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Product/Sale Banner Section End -->

        <!-- Product Section Start -->
        <div class="section section-padding pt-0">
            <div class="container-fluid">

                <!-- Section Title Start -->
                <div class="section-title2 text-center">
                    <h2 class="title">Shop By Category</h2>
                    <!-- <p>Browse a wide range of distinctive pieces of arts you could never find elsewhere.</p> -->
                </div>
                <!-- Section Title End -->

                <div class="row justify-content-center learts-mb-n40">

                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="./shop.php?List=11" class="inner">
                                <div class="image"><img src="assets/images/categories/4.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="./shop.php?List=4" class="inner">
                                <div class="image"><img src="assets/images/categories/3.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="./shop.php?List=1" class="inner">
                                <div class="image"><img src="assets/images/categories/6.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="./shop.php?List=6" class="inner">
                                <div class="image"><img src="assets/images/categories/2.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="./shop.php?List=9" class="inner">
                                <div class="image"><img src="assets/images/categories/5.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="#" class="inner">
                                <div class="image"><img src="assets/images/categories/7.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-md-6 col-12 learts-mb-40">
                        <div class="category-banner3">
                            <a href="#" class="inner">
                                <div class="image"><img src="assets/images/categories/1.jpeg" alt=""></div>
                                
                            </a>
                        </div>
                    </div>

                
                </div>

            </div>
        </div>
        <!-- Product Section End -->
        <?php
        $Main_Banner = "SELECT `Image` From `main_page_banner`";
        $Check_Main_Banner = mysqli_query($connection,$Main_Banner);
        if($Check_Main_Banner){
            $Fetch_Main_Banner = mysqli_fetch_array($Check_Main_Banner);
      
        ?>
            <!-- Parallax Banner Start -->
            <div class="parallax-banner parallax-banner-3" data-scrollax-parent="true">
                <div class="parallax-image" data-scrollax="properties: { translateY: '30%' }"><img data-src="admin/uploads/banner/<?php echo $Fetch_Main_Banner["Image"] ?>" class="lazy" /></div>
                <div class="content text-center">

                    <!-- <h2 class="title">LX Series</h2>
                    <a href="./shop.php" class="btn btn-light btn-hover-dark">shop now</a> -->
                </div>
            </div>
        <?php } ?>
        <!-- Parallax Banner End -->

        <!-- Blog Section Start -->
    <div class="section section-padding">
        <div class="container">
             <!-- Section Title Start -->
 <div class="section-title2 text-center">
                    <h2 class="title">News and Company Profile</h2>
                </div>
            <div class="row learts-mb-n50">

                <div class="col-xl-12 col-lg-12 col-12 learts-mb-50">
                    <div class="row learts-mb-n40">

                        <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="./events.php"><img src="assets/images/banner/main-page/1.jpg" alt="Events Image"></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 learts-mb-40">
                            <div class="blog">
                                <div class="image">
                                    <a href="./company-profile.php"><img src="assets/images/banner/main-page/2.jpg" alt="Company Profile"></a>
                                </div>
                               
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