<?php
require("../../connection.php");
//Variables
$ID = $_POST["Id"];
$Img = $_POST["Img"];
if (empty($Img)) {
    $sql = "DELETE FROM `manufacturer` WHERE `ID` = $ID";
    $check = mysqli_query($connection, $sql);
    if ($check) {
        echo json_encode(["status" => "success", "msg" => "Record deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "msg" => "Failed to delete record"]);
    }
} else {
    if (file_exists("../../uploads/Manufacturer/" . $Img)) {
        unlink("../../uploads/Manufacturer/" . $Img);
        $sql = "DELETE FROM `manufacturer` WHERE `ID` = $ID";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "Record deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed to delete record"]);
        }
    } else {
        $sql = "DELETE FROM `manufacturer` WHERE `ID` = $ID";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "Record deleted successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed to delete record"]);
        }
    }
}
