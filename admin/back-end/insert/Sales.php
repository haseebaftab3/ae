<?php
require("../../connection.php");
if (((isset($_POST["Category_ID"]) && !empty($_POST["Category_ID"]) && isset($_POST["Products_ID"]) && !empty($_POST["Products_ID"])) && $_POST["Products_ID"] !=  "NULL") || $_POST["Category_ID"] !=  "NULL") {
    //Variables
    $Name = $_POST["Name"];
    $Category_ID = $_POST["Category_ID"];
    $Products_ID = $_POST["Products_ID"];
    $Date = $_POST["Date"];
    $Sale_Type = $_POST["Sale_Type"];
    // echo $Date;
    $NewDate = explode("-", $Date);


    $time = strtotime($NewDate[0]);
    $StartDate = date('Y-m-d', $time);

    $time = strtotime($NewDate[1]);
    $EndDate = date('Y-m-d', $time);
    // echo $StartDate;
    // echo $newformat;

    $Amount = $_POST["Amount"];

    $sql = "INSERT INTO `sale`(`Name`,`Cat_ID`, `Prodcut_ID`, `Date_Start`, `Date_End`, `Value`,`Type`) VALUES ('$Name',$Category_ID,$Products_ID, '$StartDate', '$EndDate',$Amount,'$Sale_Type')";
    $check = mysqli_query($connection, $sql);
    if ($check) {
        echo json_encode(["status" => "success", "msg" => "Sales record added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "msg" => "Failed to add new sale record"]);
    }
} else {
    echo json_encode(["status" => "error", "msg" => "Please select a category or product"]);
}
