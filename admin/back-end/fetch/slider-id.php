<?php
require("../../connection.php");
$id = $_POST["id"];
$sql = "SELECT * FROM `slider` WHERE `ID`=$id";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $row  = mysqli_fetch_array($check);
        echo json_encode([
            "status" => "success",
            "ID" => $row["ID"],
            "Title" => $row["Title"],
            "Detail" => $row["Detail"],
            "Link" => $row["Link"],
            "Image" => $row["Image"],
            "Alt" => $row["Alt"],
        ]);
    }
} else {
    // echo json_encode(["status" => "Error", "msg" => '<td valign="top" colspan="7" class="dataTables_empty">Some Thing Wrong! Please Dail The Given Number</td>']);
}
