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
                        <h1 class="title">Contact us</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Contact us</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- Contact Information & Map Section Start -->
    <div class="section section-padding">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">Keep in touch with us</h2>
                <p>A WONDERFUL SERENITY HAS TAKEN POSSESSION OF MY ENTIRE SOUL, LIKE THESE SWEET MORNINGS OF SPRING WHICH I ENJOY WITH MY WHOLE HEART...</p>
            </div>
            <!-- Section Title End -->

            <!-- Contact Information Start -->
            <div class="row learts-mb-n30">
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title">ADDRESS</h4>
                        <span class="info"><i class="icon fal fa-map-marker-alt"></i> Main Factory Area Chowk, Peoples Colony, Sargodha, Punjab 40100</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title">CONTACT</h4>
                        <span class="info"><i class="icon fal fa-phone-alt"></i> Mobile:  (+92) 308 8881993  <br> Help Line:+92-308-8881993 </span>
                        <span class="info"><i class="icon fal fa-envelope"></i> Mail: <a href="#"> contact@abidelectric.com</a></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 learts-mb-30">
                    <div class="contact-info">
                        <h4 class="title"> HOUR OF OPERATION</h4>
                        <span class="info"><i class="icon fal fa-clock"></i> Monday – Thrusday : 09:00 – 18:00 <br>Saturday  & Sunday:  09:00 – 18:00</span>
                    </div>
                </div>
            </div>
            <!-- Contact Information End -->

            <!-- Contact Map Start -->
            <div class="row learts-mt-60">
                <div class="col">
                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3380.6553682062768!2d72.65541071464547!3d32.07856882657637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x392177ae1b9f68cd%3A0xcc7363c0e1f116e!2sAbid%20Electric%20Accessories!5e0!3m2!1sen!2s!4v1593935624202!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <!-- Contact Map End -->

        </div>
    </div>
    <!-- Contact Information & Map Section End -->

    <!-- Contact Form Section Start -->
    <div class="section section-padding pt-0">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h2 class="title">Send a message</h2>
            </div>
            <!-- Section Title End -->

            <div class="row">
                <div class="col-lg-8 col-12 mx-auto">
                    <div class="contact-form">
                        <form action="#" id="contact-form" method="post">
                            <div class="row learts-mb-n30">
                                <div class="col-md-6 col-12 learts-mb-30"><input type="text" placeholder="Your Name *" name="name"></div>
                                <div class="col-md-6 col-12 learts-mb-30"><input type="email" placeholder="Email *" name="email"></div>
                                <div class="col-12 learts-mb-30"><textarea name="message" placeholder="Message"></textarea></div>
                                <div class="col-12 text-center learts-mb-30"><button class="btn btn-dark btn-outline-hover-dark">Submit</button></div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact Form Section End -->

    <!-- Footer -->
    <?php require("includes/footer.php") ?>

    <!-- Modal -->
    <?php require("includes/quick-veiw.php") ?>


    <!-- JS
============================================ -->

    <?php require("includes/js.php") ?>
</body>

<!-- Mirrored from demo.hasthemes.com/learts-preview/learts/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Jun 2020 09:11:46 GMT -->

</html>