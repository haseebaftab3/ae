<?php
//PHP Session
session_start();

//Checking Session
if (isset($_SESSION['A_Name'])  && !empty($_SESSION['A_Name']) && isset($_SESSION['A_Pass']) && !empty($_SESSION['A_Pass']) && isset($_SESSION['A_UName']) && !empty($_SESSION['A_UName']) && isset($_SESSION['A_Pass']) && !empty($_SESSION['A_Pass']) && isset($_SESSION['A_UName']) && !empty($_SESSION['A_UName']) && isset($_SESSION['A_UserId']) && !empty($_SESSION['A_UserId'])) {
    header("Location:index.php");
} else if (!isset($_SESSION['A_Pass']) && isset($_SESSION['A_Name'])) {
    header("Location:lock-screen.php");
}
//connection
require("connection.php");

//variables
$nameErr = $passErr = $name = $pass = $queryErr = $UserName = "";

//validation
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['Admin_Name'])) {
        $nameErr = "Name Must required";
    } else {
        $name = $_POST['Admin_Name'];
        if (!preg_match("/^[a-zA-Z 1-9]*$/", $name)) {
            $nameErr = "Only small letters and white space allowed";
            $name = "";
        } else {
            $name = check_input($_POST['Admin_Name']);
        }
    }
}


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
if (isset($name) && !empty($name) && isset($pass) && !empty($pass)) {
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
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require("includes/head.php")
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
                                <div class="col-lg-5 d-none d-lg-block bg-login-d rounded-left" style="background: url(assets/images/bg-login.jpg);background-position: center; background-size: cover;"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="index.php" class="text-dark font-size-22 font-family-secondary">
                                                <!--                                                <i class="mdi mdi-album"></i> <b>SCOXE</b>-->
                                                <img src="assets/images/logo/logo.png" alt="" style="height: 175px;" class="img-fluid">
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Welcome Back!</h1>
                                        <p class="text-muted mb-4">Enter your user name and password to access admin panel.</p>


                                        <form class="user needs-validation" novalidate id="LoginForm" action="<?php echo (htmlspecialchars($_SERVER['PHP_SELF'])) ?>" method="post">

                                            <!-- Alerts @ S-->
                                            <?php
                                            if ($nameErr && $passErr) {
                                                echo ('<div class="alert alert-danger" role="alert">' . $nameErr . '<br>' . $passErr . '</div>');
                                                $nameErr = $passErr = "";
                                            }
                                            if ($passErr && !$nameErr) {
                                                echo ('<div class="alert alert-danger" role="alert">' . $passErr . '</div>');
                                                $passErr = "";
                                            }
                                            if ($nameErr && !$passErr) {
                                                echo ('<div class="alert alert-danger" role="alert">' . $nameErr . '</div>');
                                                $nameErr = "";
                                            }

                                            if ($queryErr && !$nameErr && !$passErr) {
                                                echo ('<div class="alert alert-danger" role="alert">' . $queryErr . '</div>');
                                                $queryErr = '';
                                            }
                                            ?>
                                            <!-- Alerts @E -->

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="validationCustomUsername LoginName" placeholder="Username" aria-describedby="inputGroupPrepend" required name="Admin_Name">
                                                    <div class="invalid-feedback">
                                                        Please enter a username.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="Password LoginPass" placeholder="Password" name="Admin_Pass" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter a password.
                                                </div>
                                            </div>
                                            <input type="submit" class="p-b p-border btn btn-success btn-block waves-effect waves-light" value="Login">

                                        </form>

                                        <div class="row mt-4">
                                            <div class="col-12 text-center">
                                                <!--<p class="text-muted mb-2"><a href="pages-recoverpw.html" class="text-muted font-weight-medium ml-1">Forgot your password?</a></p>-->
                                            </div>
                                            <!-- end col -->
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
    <?php
    require("includes/js.php") ?>
</body>

</html>