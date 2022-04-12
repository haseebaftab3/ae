<?php
require("../../connection.php");
$html = "";
$i = 1;
$sql = "SELECT * FROM `shippingmethod`";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row["TYPE"] . '</td>';
            $html .= '<td>' . $row["RATE"] . '</td>';

            //FULE_TAX
            if ($row['FUEL_TAX'] == "" || $row['FUEL_TAX'] == NULL) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["FUEL_TAX"] . '</td>';
            }

            //SALES_TAX
            if ($row['SALES_TAX'] == "" || $row['SALES_TAX'] == NULL) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["SALES_TAX"] . '</td>';
            }

            $html .= '<td>
        <div class="d-flex justify-content-end">
        <a href="#" data-toggle="modal" class="CommentIcon" data-target="#EditShipModal" 
        data-id="' . $row[0] . '" >
            <i class="mdi mdi-circle-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
        </a>
        </div>
        ';
            $html .= '</tr>';
            $i++;
        }
        echo json_encode(["status" => "success", "html" => $html]);
    } else {
        echo json_encode(["status" => "empty"]);
    }
}
