<?php
require("../../connection.php");
$Check_status  = $_POST["Check_status"];
$id  = $_POST["id"];
// echo ($Check_status . $id);
//query
$query = "UPDATE `product_rating` SET `Status`='$Check_status' WHERE `ID`=$id ";

//query checker
$check = mysqli_query($connection, $query);
if ($check) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
