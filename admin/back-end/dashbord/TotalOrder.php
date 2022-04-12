<?php

require("./../../connection.php");
$arr = [0];
$sql = "SELECT IFNULL(COUNT(*),0) FROM `product_order` where (`Date_added`> DATE_ADD(Now(), INTERVAL - 30 DAY)) GROUP BY `Date_added`";
$check = mysqli_query($connection, $sql);
if (mysqli_num_rows($check) > 0) {
    while ($row = mysqli_fetch_array($check)) {
        // print_r($row);
        array_push($arr, $row["0"]);
    }
    echo json_encode(["method" => "success", "msg" => $arr]);
} else {
    echo json_encode(["method" => "success", "msg" => $arr]);
}
