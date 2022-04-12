<?php
require("../../connection.php");

if (
    isset($_POST["Name"]) && isset($_POST["Email"]) && isset($_POST["City"]) && isset($_POST["Pass"]) && isset($_POST["Number"])
    && !empty($_POST["Name"]) && !empty($_POST["Email"]) && !empty($_POST["City"]) && !empty($_POST["Pass"]) && !empty($_POST["Number"])
) {
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Number = $_POST["Number"];
    $City = $_POST["City"];
    $Password = $_POST["Pass"];

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $Password);
    $lowercase = preg_match('@[a-z]@', $Password);
    $number    = preg_match('@[0-9]@', $Password);
    $specialChars = preg_match('@[^\w]@', $Password);

    // Check mail

    $EmailSql = "SELECT * FROM `user_account` WHERE `Email` = '$Email'";
    $checkEmail = mysqli_query($connection, $EmailSql);
    if (mysqli_num_rows($checkEmail) > 0) {
        echo json_encode(["status" => "error", "msg" => "That email is taken. Try another"]);
    } else {
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 8) {
            echo json_encode(["status" => "error", "msg" => "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character."]);
        } else {

            //Password Encryption
            $Password = password_hash($Password, PASSWORD_DEFAULT);
            if ($checkEmail) {
                $sql = "INSERT INTO `user_account`(`Name`, `Email`, `Number`, `City`, `Password`) 
                        VALUES
                        ('$Name','$Email',$Number,'$City','$Password')";
                $check = mysqli_query($connection, $sql);
                if ($check) {
                    echo json_encode(["status" => "success", "msg" => "Account created successfully!"]);
                } else {
                    echo json_encode(["status" => "error", "msg" => "Failed to create new account please try again."]);
                }
            }
        }
    }
} else {
    echo json_encode(["status" => "error", "msg" => "All Feilds Must be Required."]);
}
