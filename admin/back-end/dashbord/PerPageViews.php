<?php

require("./../../connection.php");
$arr = [];
$sql = "SELECT `page`,`totalvisit` FROM `totalview`";
$check = mysqli_query($connection, $sql);
if (mysqli_num_rows($check) > 0) {
    while ($row = mysqli_fetch_array($check)) {
        // $str=array(label: $row[0], value: $row[1]);
        array_push($arr, ['label' => $row[0], 'value' => (int)$row[1]]);
        // array_push($arr, ['label:' => $row[0], 'value:' => $row[1]]);
    }
    echo json_encode(["method" => "success", "msg" => $arr]);
} else {
    echo json_encode(["method" => "success", "msg" => $arr]);
}
