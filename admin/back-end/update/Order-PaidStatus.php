<?php
require("../../connection.php");
$id = $_POST["id"];
$val = $_POST["CStatuts"];
$sql = "UPDATE `product_order` SET `Bank_Payment_Staus`='$val'  WHERE `ID`=$id";
$check = mysqli_query($connection, $sql);
if (!$check) {
    echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
} else {
    echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
}
