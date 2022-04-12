<?php
require("../../connection.php");
$html = "";
$i = 1;
$sql = "SELECT * FROM `user_account` ORDER BY `user_account`.`Date_Added` DESC";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row["Name"] . '</td>';
            $html .= '<td><a class="text-success" href="mailto:' . $row["Email"] . '">' . $row["Email"] . '</a></td>';
            $html .= '<td><a href="tel:' . $row["Number"] . '">' . $row["Number"] . '</a></td>';
            $html .= '<td>' . $row["City"] . '</td>';
            $html .= '<td>' . $row["Address"] . '</td>';
            $html .= '<td>' . $row["Postal_code"] . '</td>';
            if ($row["Status"] == 1) {
                $html .= '<td>Active User</td>';
            } else {
                $html .= '<td>Blocked</td>';
            }


            if ($row["Status"] == 1) {
                $html .= '<td>
                <div class="d-flex justify-content-end">
                <a href="#" data-toggle="modal" class="CommentIcon" data-target="#BlockUserRecord" 
                data-id="' . $row[0] . '" >
                    <i class="mdi mdi-account-remove-outline text-danger " style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="Block User" data-original-title="Block User"></i>
                </a>
                <a href="#" data-toggle="modal"  class="CommentIcon" data-target="#DeleteSliderRecord" 
                data-id="' . $row[0] . '">
                    <i class="mdi mdi-email-outline text-success ml-1" style="font-size:18.5px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="bottom" title="Mail" data-original-title="Mail"></i>
                </a>
                </div>
                ';
            } else {
                $html .= '<td>
                <div class="d-flex justify-content-end">
                <a href="#" data-toggle="modal" class="CommentIcon" data-target="#BlockUserRecord" 
                data-id="' . $row[0] . '" >
                    <i class="mdi mdi mdi-account-convert text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="Unblock User" data-original-title="Unblock User"></i>
                </a>
                <a href="#" data-toggle="modal"  class="CommentIcon" data-target="#DeleteSliderRecord" 
                data-id="' . $row[0] . '">
                <i class="mdi mdi-email-outline text-success ml-1" style="font-size:18.5px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="bottom" title="Mail" data-original-title="Mail"></i>
                </a>
                </div>
                ';
            }
            $html .= '</tr>';
            $i++;
        }
        echo json_encode(["status" => "success", "html" => $html]);
    } else {
        echo json_encode(["status" => "empty"]);
    }
}
