<?php
require("../../connection.php");
$ID = $_POST["Sales-Common-ID"];
$query = "DELETE FROM `sale` WHERE id=$ID";
//query checker
$check = mysqli_query($connection, $query);
if ($check) {
    echo json_encode(['status' => 'success', 'msg' => 'Record Deleted Successfully']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Sorry Some Thing Wrong. Please Try Again']);
}
