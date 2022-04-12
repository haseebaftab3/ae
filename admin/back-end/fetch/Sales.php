<?php
require("../../connection.php");
$html = "";
$i = 1;
$sql = "SELECT * FROM `sale`";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<tr>';
            // $html .= '<td><input type="checkbox"  value="' . $row["ID"] . '"></td>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row["Name"] . '</td>';


            if ($row['Cat_ID'] == "") {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $CatID = $row["Cat_ID"];
                $Fetch_Cat = "SELECT `Name` FROM `category` WHERE `ID` = $CatID";
                $Check_Cat = mysqli_query($connection, $Fetch_Cat);
                $Fetch_Cat = mysqli_fetch_array($Check_Cat);
                $html .= '<td>' .  $Fetch_Cat["Name"] . '</td>';
            }

            if ($row['Prodcut_ID'] == "") {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $ProductsID = $row["Prodcut_ID"];
                $Fetch_Prodcut = "SELECT `Name` FROM `products` WHERE `ID` = $ProductsID";
                $Check_Prodcut = mysqli_query($connection, $Fetch_Prodcut);
                $Fetch_Prodcut = mysqli_fetch_array($Check_Prodcut);
                $html .= '<td>' .  $Fetch_Prodcut["Name"] . '</td>';
            }



            //SORT oRDER
            if ($row["Date_Start"] == "" || $row["Date_Start"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["Date_Start"] . '</td>';
            }

            //SORT oRDER
            if ($row["Date_End"] == "" || $row["Date_End"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["Date_End"] . '</td>';
            }


            //SORT oRDER
            if ($row["Value"] == "" || $row["Value"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . (int) $row["Value"] . '%</td>';
            }
            //SORT oRDER
            if ($row["Type"] == "" || $row["Type"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["Type"] . '</td>';
            }


            $html .= '<td>
        <div class="d-flex justify-content-end">
        <a href="#" data-toggle="modal" class="CommentIcon" data-target="#EditSaleModal" 
        data-id="' . $row[0] . '" >
            <i class="mdi mdi-circle-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
        </a>
        <a href="#" data-toggle="modal"  class="CommentIcon" data-target="#DeleteSaleRecord" 
        data-id="' . $row[0] . '">
            <i class="mdi mdi-delete-variant text-dark" style="font-size:20px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Record"></i>
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
