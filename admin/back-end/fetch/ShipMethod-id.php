<?php
require("../../connection.php");
$id = $_POST["id"];
$sql = "SELECT * FROM `shippingmethod` WHERE `ID`=$id";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $row  = mysqli_fetch_array($check);
        echo json_encode([
            "status" => "success",
            "Type" => $row["TYPE"],
            "Fuel_tax" => $row["FUEL_TAX"],
            "Sale_tax" => $row["SALES_TAX"],
            "Rate" => $row["RATE"],
        ]);
    }
} else {
}
