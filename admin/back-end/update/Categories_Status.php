<?php
require("../../connection.php");
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $val = $_POST["val"];
    $sql = "UPDATE `category` SET `Status`='$val' , `Date_modified`=current_timestamp() WHERE `ID`=$id";
    $check = mysqli_query($connection, $sql);
    if (!$check) {
        echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
        echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
}
