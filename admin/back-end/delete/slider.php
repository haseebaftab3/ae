<?php
require("../../connection.php");
$id = $_POST["id"];
$image = $_POST["image"];
$query = "DELETE FROM `slider` WHERE id=$id";
//query checker
$check = mysqli_query($connection, $query);
if ($check) {
    if (file_exists("../../uploads/slider/" . $image)) {
        unlink("../../uploads/slider/" . $image);
    }
    echo json_encode(['status' => 'success', 'message' => 'Record Deleted Successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Sorry Some Thing Wrong. Please Try Again']);
}
