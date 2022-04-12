<?php
require("../../connection.php");
session_start();

// Variables
$Email = $_POST["acc-email"];
$Name = $_POST["acc-name"];
$Password = $_POST["acc-old-pass"];
$NewPass = $_POST["acc-pass2"];
$CNewPass = $_POST["acc-pass3"];

if (isset($_POST["acc-old-pass"]) && !empty($Password) && isset($_POST["acc-email"]) && isset($_POST["acc-name"])) {
    // No Chane In Email
    if ($Email == $_SESSION["U_name"]) {
        if (password_verify($_POST["acc-old-pass"], $_SESSION["U_pass"])) {
            if (isset($_POST["acc-pass2"]) && isset($_POST["acc-pass3"]) && !empty($_POST["acc-pass2"]) && !empty($_POST["acc-pass3"])) {
                // Validate password strength
                $uppercase = preg_match('@[A-Z]@', $NewPass);
                $lowercase = preg_match('@[a-z]@', $NewPass);
                $number    = preg_match('@[0-9]@', $NewPass);
                $specialChars = preg_match('@[^\w]@', $NewPass);
                if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($NewPass) < 8) {
                    echo json_encode(["status" => "error", "msg" => "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character."]);
                } else {
                    if ($NewPass == $CNewPass) {
                        //Password Encryption
                        $NewPass = password_hash($NewPass, PASSWORD_DEFAULT);
                        $id = $_SESSION["U_UserId"];
                        $update = "UPDATE `user_account` SET `Name`='$Name',`Password`='$NewPass' WHERE `ID` = $id  ";
                        // $_SESSION["U_name"] = $name;
                        $_SESSION["U_pass"] = $NewPass;
                        $_SESSION["U_Username"] = $Name;
                        $check = mysqli_query($connection, $update);
                        if ($check) {
                            echo json_encode(["status" => "success", "msg" => "Record updated successfully"]);
                        } else {
                            echo json_encode(["status" => "error", "msg" => "Failed to update record please try again"]);
                        }
                    } else {
                        echo json_encode(["status" => "error", "msg" => "Password dosen't match please try again"]);
                    }
                }
            } else {
                echo json_encode(["status" => "error", "msg" => "Please enter a valid new <b>password</b>"]);
            }
        } else {
            echo json_encode(["status" => "error", "msg" => "You entered wrong <b>password</b>"]);
        }
    } else {
        // IF User Enter New Email
        $EmailSql = "SELECT * FROM `user_account` WHERE `Email` = '$Email'";
        $checkEmail = mysqli_query($connection, $EmailSql);
        if (mysqli_num_rows($checkEmail) > 0) {
            echo json_encode(["status" => "error", "msg" => "Already have an account"]);
        } else {
            if ($_POST["acc-old-pass"] == $_SESSION["U_pass"]) {
                if (isset($_POST["acc-pass2"]) && isset($_POST["acc-pass3"]) && !empty($_POST["acc-pass2"]) && !empty($_POST["acc-pass3"])) {
                    // Validate password strength
                    $uppercase = preg_match('@[A-Z]@', $NewPass);
                    $lowercase = preg_match('@[a-z]@', $NewPass);
                    $number    = preg_match('@[0-9]@', $NewPass);
                    $specialChars = preg_match('@[^\w]@', $NewPass);
                    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($NewPass) < 8) {
                        echo json_encode(["status" => "error", "msg" => "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character."]);
                    } else {
                        if ($NewPass == $CNewPass) {
                            //Password Encryption
                            $NewPass = password_hash($NewPass, PASSWORD_DEFAULT);
                            $id = $_SESSION["U_UserId"];
                            $update = "UPDATE `user_account` SET `Name`='$Name',`Email`='$Email',`Password`='$NewPass' WHERE `ID` = $id  ";
                            $_SESSION["U_name"] = $Email;
                            $_SESSION["U_pass"] = $NewPass;
                            $_SESSION["U_Username"] = $Name;
                            $check = mysqli_query($connection, $update);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "Record updated successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed to update record please try again"]);
                            }
                        } else {
                            echo json_encode(["status" => "error", "msg" => "Password dosen't match please try again"]);
                        }
                    }
                } else {
                    echo json_encode(["status" => "error", "msg" => "Please enter a valid new <b>password</b>"]);
                }
            } else {
                echo json_encode(["status" => "error", "msg" => "You entered wrong <b>password</b>"]);
            }
        }
    }
} else {
    if ($Email == $_SESSION["U_name"]) {
        $id = $_SESSION["U_UserId"];
        // echo $Name;
        $update = "UPDATE `user_account` SET `Name`='$Name' WHERE `ID` = $id  ";
        // $_SESSION["U_name"] = $Email;
        $_SESSION["U_Username"] = $Name;
        $check = mysqli_query($connection, $update);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "Record updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed to update record please try again"]);
        }
    } else {
        // IF User Enter New Email
        $EmailSql = "SELECT * FROM `user_account` WHERE `Email` = '$Email'";
        $checkEmail = mysqli_query($connection, $EmailSql);
        if (mysqli_num_rows($checkEmail) > 0) {
            echo json_encode(["status" => "error", "msg" => "Already have an account"]);
        } else {
            $id = $_SESSION["U_UserId"];
            $update = "UPDATE `user_account` SET `Name`='$Name',`Email`='$Email' WHERE `ID` = $id  ";
            $_SESSION["U_name"] = $Email;
            $_SESSION["U_Username"] = $Name;
            $check = mysqli_query($connection, $update);
            if ($check) {
                echo json_encode(["status" => "success", "msg" => "Record updated successfully"]);
            } else {
                echo json_encode(["status" => "error", "msg" => "Failed to update record please try again"]);
            }
        }
    }
}
