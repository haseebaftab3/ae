<?php
require("../../connection.php");
$id = $_POST["id"];
$image = $_POST["image"];
$query = "DELETE FROM `main_page_banner` WHERE id=$id";
//query checker
$check = mysqli_query($connection, $query);
if ($check) {
    if (file_exists("../../uploads/banner/" . $image)) {
        unlink("../../uploads/banner/" . $image);
    }
    echo json_encode(['status' => 'success', 'message' => 'Record Deleted Successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Sorry Some Thing Wrong. Please Try Again']);
}
