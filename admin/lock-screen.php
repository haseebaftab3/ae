<!DOCTYPE html>
<html lang="en">



<head>
    <?php
    require("includes/head.php");
    session_start();
    unset($_SESSION['A_Pass']);
    // echo ($_SESSION['A_Name']);
    // echo ("<br>");
    // echo ($_SESSION['A_Pass']);
    // echo ("<br>");
    // echo ($_SESSION['A_UName']);
    // echo ("<br>");
    // echo ($_SESSION['A_UserId']);
    // echo ("<br>");
    if (
        !isset($_SESSION['A_Name'])      && empty($_SESSION['A_Name'])
        && !isset($_SESSION['A_Pass'])   && empty($_SESSION['A_Pass'])
        && !isset($_SESSION['A_UName'])  && empty($_SESSION['A_UName'])
        && !isset($_SESSION['A_Pass'])   && empty($_SESSION['A_Pass'])
        && !isset($_SESSION['A_UName'])  && empty($_SESSION['A_UName'])
        && !isset($_SESSION['A_UserId']) && empty($_SESSION['A_UserId'])
    ) {
        header("Location:login.php");
    } else if (isset($_SESSION['A_Name'])  && !empty($_SESSION['A_Name']) && isset($_SESSION['A_Pass']) && !empty($_SESSION['A_Pass']) && isset($_SESSION['A_UName']) && !empty($_SESSION['A_UName']) && isset($_SESSION['A_Pass']) && !empty($_SESSION['A_Pass']) && isset($_SESSION['A_UName']) && !empty($_SESSION['A_UName']) && isset($_SESSION['A_UserId']) && !empty($_SESSION['A_UserId'])) {
        header("Location:index.php");
    }
    //connection
    require("connection.php");

    //variables
    $passErr = $name = $pass = $queryErr = $UserName = "";
    $name = $_SESSION["A_Name"];

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['Admin_Pass'])) {
            $passErr = "Password Must required";
        } else {
            $pass = $_POST['Admin_Pass'];
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $pass)) {
                $passErr = "Please check your <b>Password</b> again";
                $pass = "";
            } else {
                $pass = check_input($_POST['Admin_Pass']);
            }
        }
    }



    function check_input($par)
    {
        $data = htmlspecialchars($par);
        $data = trim($par);
        $data = stripslashes($par);
        return ($data);
    }

    //Query
    if (isset($pass) && !empty($pass)) {
        $query  = "SELECT * FROM `admin` where `User_Name`='$name'";
        $check  = mysqli_query($connection, $query);
        if (mysqli_num_rows($check) > 0) {
            $root   = mysqli_fetch_array($check);
            if (password_verify($pass, $root['Password'])) {
                $_SESSION['A_Name'] = $name;
                $_SESSION['A_Pass'] = $root['Password'];
                $_SESSION['A_UName'] = $root['Name'];
                $_SESSION['A_UserId'] = $root['Id'];
                header("Location:index.php");
            } else {
                $passErr = "Wrong Password!";
            }
        } else {
            $queryErr = "No User Found";
        }
    }
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
                                            <img src="assets/images/users/avatar-1.jpg" alt="Generic placeholder image" class="avatar-md rounded-circle img-thumbnail">
                                            <h1 class="h5 mb-1 mt-2">
                                                <?php
                                                if (isset($_SESSION['A_Name'])) {
                                                    echo ($_SESSION['A_UName']);
                                                }
                                                ?>
                                            </h1>
                                            <p class="text-muted mb-4">Enter your password to access the admin.</p>
                                        </div>

                                        <form class="needs-validation" novalidate action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])) ?>" method="post">
                                            <?php

                                            if ($passErr) {
                                                echo ('<div class="alert alert-danger" role="alert">' . $passErr . '</div>');
                                                $passErr = "";
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label for="enterpass">Password</label>
                                                <input type="password" class="form-control form-control-user" require id="enterpass" name="Admin_Pass" placeholder="Enter password">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter a password.
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-success btn-block waves-effect waves-light"> Log In </a>

                                        </form>

                                        <div class="row mt-5">
                                            <div class="col-12 text-center">
                                                <p class="text-muted">Not you? return <a href="login.php" class="text-muted font-weight-medium ml-1"><b>Sign In</b></a></p>
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