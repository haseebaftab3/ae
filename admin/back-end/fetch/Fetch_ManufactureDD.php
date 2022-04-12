<?php
require("../../connection.php");
//Variable
$html = "";
$sql = "SELECT `ID`,`Name` FROM `manufacturer`";
$check = mysqli_query($connection, $sql);
$html .= "<option value='NULL'>None</option>";
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row =  mysqli_fetch_array($check)) {
            $html .= "<option value='" . $row["ID"] . "'>" . $row["Name"] . "</option>";
        }
        echo json_encode(["status" => "success", "html" => $html]);
    } else {
        echo json_encode(["status" => "error", "html" => $html]);
    }
}
