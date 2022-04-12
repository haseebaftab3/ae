<?php
require("../../connection.php");
$id = $_POST["id"];
$sql = "SELECT * FROM `user_account` WHERE `ID`=$id";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $row  = mysqli_fetch_array($check);
        echo json_encode([
            "status" => "success",
            "User_Status" => $row["Status"],
        ]);
    }
}
