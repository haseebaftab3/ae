<?php
require("../../connection.php");
//Variable
$html = "";
$sql = "SELECT `ID`,`Name`,`Parent_ID` FROM `category` WHERE Parent_ID IS NULL ";
$check = mysqli_query($connection, $sql);
$html .= "<option value='NULL' >None</option>";
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row =  mysqli_fetch_array($check)) {
            $html .= "<option value='" . $row["ID"] . "'>" . $row["Name"] . "</option>";
            $id = $row["ID"];
            $sql_sub = "SELECT `ID`,`Name`,`Parent_ID` FROM `category` WHERE Parent_ID = $id";
            $check_sub = mysqli_query($connection, $sql_sub);
            while ($row_sub = mysqli_fetch_array($check_sub)) {
                $html .= "<option value='" . $row_sub["ID"] . "'>" . $row["Name"] . "➡" . $row_sub["Name"] . "</option>";
                // 3rd Level
                $id_1 = $row_sub["ID"];
                $sql_sub_1 = "SELECT `ID`,`Name`,`Parent_ID` FROM `category` WHERE Parent_ID = $id_1";
                $check_sub_1 = mysqli_query($connection, $sql_sub_1);
                while ($row_sub_1 = mysqli_fetch_array($check_sub_1)) {
                    $html .= "<option value='" . $row_sub_1["ID"] . "'>" . $row["Name"] . "➡" . $row_sub["Name"] . "➡" . $row_sub_1["Name"] . "</option>";
                }
            }
        }
        echo json_encode(["status" => "success", "html" => $html]);
    } else {
        echo json_encode(["status" => "error", "html" => $html]);
    }
}
