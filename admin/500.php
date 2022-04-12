<!DOCTYPE html>
<html lang="en">


<head>
    <?php
    require("includes/head.php");
    ?>

</head>


<body>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-register rounded-left"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.php" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-album"></i> <b>SCOXE</b>
                                            </a>
                                        </div>

                                        <div class="text-center">
                                            <img src="assets/images/500-error.svg" alt="error" height="140">
                                            <h1 class="h4 mb-3 mt-4">Internal Server Error</h1>
                                            <p class="text-muted mb-4 w-75 m-auto">We are experiencing an internal server problem, please try back later.</p>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <a href="index.php" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-home mr-2"></i>Back to Home </a>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <?php require("includes/js.php") ?>

</body>


</html>