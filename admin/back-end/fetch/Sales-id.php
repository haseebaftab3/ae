<?php
require("../../connection.php");
$id = $_POST["id"];
$sql = "SELECT * FROM `sale` WHERE `ID`=$id";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $row  = mysqli_fetch_array($check);
        echo json_encode([
            "status" => "success",
            "Name" => $row["Name"],
            "Cat_ID" => $row["Cat_ID"],
            "Product_ID" => $row["Prodcut_ID"],
            "Date_Start" => $row["Date_Start"],
            "Date_End" => $row["Date_End"],
            "Value" => $row["Value"],
            "Type" => $row["Type"],
        ]);
    }
}
