<?php
require("../../connection.php");
$id = $_POST["id"];
$type = $_POST["type"];
$FlatRate = $_POST["flat_rate"];
$TableFule = $_POST["fule_tax"];
$TableSale = $_POST["sales_tax"];
$TableRate = $_POST["table_rate"];
if (isset($_POST["flat_rate"]) && !empty($_POST["flat_rate"]) && $type == "FLAT") {
    $sql = "UPDATE `shippingmethod` SET `RATE`='$FlatRate' WHERE `ID` = $id";
    $check = mysqli_query($connection, $sql);
    if (!$check) {
        echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
        echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
} else {
    $sql = "UPDATE `shippingmethod` SET `FUEL_TAX`='$TableFule',`SALES_TAX`='$TableSale',`RATE`='$TableRate' WHERE `ID` = $id";
    $check = mysqli_query($connection, $sql);
    if (!$check) {
        echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
        echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
}
