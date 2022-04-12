<?php
require("../../connection.php");
$html = "";
$i = 1;
$sql = "SELECT * FROM `ads`";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row["Name"] . '</td>';

            //Image
            if ($row['Image'] == "") {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td class="p-0 d-flex justify-content-center"><img style="height:68px" class="img-thumbnail rounded" src="uploads/Offer/' . $row['Image'] . '"></td>';
            }

            //Status
            if ($row["Link"] == "" || $row["Link"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["Link"] . '</td>';
            }

            //Status
            if ($row["Status"] == "" || $row["Status"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["Status"] . '</td>';
            }
            $html .= '<td>
        <div class="d-flex justify-content-end">
        <a href="#" data-toggle="modal" class="CommentIcon" data-target="#EditAdsRecord" 
        data-id="' . $row[0] . '" >
            <i class="mdi mdi-circle-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
        </a></td>
        ';
            $html .= '</tr>';
            $i++;
        }
        echo json_encode(["status" => "success", "html" => $html]);
    } else {
        echo json_encode(["status" => "empty"]);
    }
}
