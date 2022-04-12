<?php
require("../../connection.php");
// if (((isset($_POST["Category_ID"]) && !empty($_POST["Category_ID"]) && isset($_POST["Products_ID"]) && !empty($_POST["Products_ID"])) && $_POST["Products_ID"] !=  "NULL") || $_POST["Category_ID"] !=  "NULL") {
//Variables
$ID = $_POST["Sales-Common-ID"];
$Name = $_POST["Name"];
$Category_ID = "NULL";
if (isset($_POST["Category_ID"])) {
    $Category_ID = $_POST["Category_ID"];
} else {
    $Category_ID = "NULL";
}
if (isset($_POST["Products_ID"])) {
    $Products_ID = $_POST["Products_ID"];
} else {
    $Products_ID = "NULL";
}
$Sale_Type = $_POST["Sale_Type"];
$StartDate = $_POST["StartDate"];
$EndDate = $_POST["EndDate"];
$Amount = $_POST["Amount"];

$sql = "UPDATE `sale` SET `Name`='$Name',`Cat_ID`=$Category_ID,`Prodcut_ID`=$Products_ID,`Date_Start`='$StartDate',`Date_End`='$EndDate',`Value`=$Amount,`Type`='$Sale_Type' WHERE `ID` = $ID";
$check = mysqli_query($connection, $sql);
if ($check) {
    echo json_encode(["status" => "success", "msg" => "Sales record added successfully!"]);
} else {
    echo json_encode(["status" => "error", "msg" => "Failed to add new sale record"]);
}
// } else {
//     echo json_encode(["status" => "error", "msg" => "Please select a category or product"]);
// // }
