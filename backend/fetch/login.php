<?php
//connection
require("../../connection.php");
session_start();

function check_input($par)
{
    $data = htmlspecialchars($par);
    $data = trim($par);
    $data = stripslashes($par);
    return ($data);
}
//Checking Login Status
if (isset($_SESSION['U_name']) && !empty($_SESSION['U_name']) && isset($_SESSION['U_pass']) && isset($_SESSION['U_Username']) && isset($_SESSION['U_UserId'])) {
    echo json_encode(["status" => "login"]);
} else {

    //variables
    $nameErr = $passErr = $name = $pass = $queryErr = $UserName = "";


    //validation
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['name'])) {
            echo json_encode(["status" => "error", "msg" => "Please enter a valid E-Mail"]);
        } else {
            $name = check_input($_POST['name']);
        }
    }

    if (!empty($name)) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (empty($_POST['pass'])) {
                $passErr = "Password Must required";
                echo json_encode(["status" => "error", "msg" => "Please enter a valid Password"]);
            } else {
                // $pass = $_POST['pass'];
                $pass = check_input($_POST['pass']);
            }
        }
    }



    //Query
    if (isset($name) && !empty($name) && isset($pass) && !empty($pass)) {
        $query  = "SELECT * FROM `user_account` where  `Email`='$name'";
        $check  = mysqli_query($connection, $query);
        if (mysqli_num_rows($check) > 0) {
            $root   = mysqli_fetch_array($check);
            if (password_verify($pass, $root['Password'])) {
                $remembering_timespan = time() + 7 * 24 * 60 * 60;
                $_SESSION["U_name"] = $name;
                $_SESSION["U_pass"] = $root['Password'];
                $_SESSION["U_Username"] = $root['Name'];
                $_SESSION["U_UserId"] = $root['ID'];
                // header("Location:index.php");
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "msg" => "No match for E-Mail Address and/or Password."]);
                // $passErr = " ";
            }
        } else {
            echo json_encode(["status" => "error", "msg" => "No User Found"]);
            // $queryErr = "";
        }
    }
}
