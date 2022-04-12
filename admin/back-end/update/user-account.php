<?php
require("../../connection.php");
$id = $_POST["id"];
$status = $_POST["status"];
// echo $status;
if ($_POST["status"] == 1) {
    $sql = "UPDATE `user_account` SET `Status`=0 WHERE `ID` =  $id";
    $check = mysqli_query($connection, $sql);
    if (!$check) {
        echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
        echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
} else {
    $sql = "UPDATE `user_account` SET `Status`=1 WHERE `ID` =  $id";
    $check = mysqli_query($connection, $sql);
    if (!$check) {
        echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
        echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
}
