<?php
require("../../connection.php");
$html = "";
$i = 1;
$sql = "SELECT * FROM `category` WHERE `Parent_ID` IS NULL";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<tr>';
            // $html .= '<td><input type="checkbox"  value="' . $row["ID"] . '"></td>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row["Name"] . '</td>';
            if ($row['Discription'] == "") {
                $html .= '<td style="color:green">N/A</td>';
            } else if (strlen($row['Discription']) > 40) {
                $html .= '<td>' . $substr($row['Discription'], 0, 30) . "......" . '</td>';
            } else {
                $html .= '<td>' . $row["Discription"] . '</td>';
            }

            //Image
            if ($row['Image'] == "") {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td class="p-0 d-flex justify-content-center"><img style="height:68px" class="img-thumbnail rounded" src="uploads/Categories/' . $row['Image'] . '"></td>';
            }
            //SORT oRDER
            if ($row["Sort_Order"] == "" || $row["Sort_Order"] == null) {
                $html .= '<td style="color:green">N/A</td>';
            } else {
                $html .= '<td>' . $row["Sort_Order"] . '</td>';
            }
            if ($row["Status"] == false || $row["Status"] == "False") {
                $html .= '<td>

                <label class="switch" data-id="' . $row[0] . '">
                <input type="checkbox"  class="ChangeCommentStatus" name="Cat_Status" >
                <span class="slider round"></span>
              </label>
              </td>';
            } else if ($row["Status"] == true || $row["Status"] == "True") {
                $html .= '<td>
                    
                    <label class="switch" data-id="' . $row[0] . '">
                        <input type="checkbox"  class="ChangeCommentStatus" name="Cat_Status" checked>
                        <span class="slider round"></span>
                    </label>
                </td>';
            } else {
                $html .= '<td class="text-danger">N/A</td>';
            }

            $html .= '<td>
        <div class="d-flex justify-content-end">
        <a href="#" data-toggle="modal" class="CommentIcon" data-target="#EditCatModal" 
        data-id="' . $row[0] . '" >
            <i class="mdi mdi-circle-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
        </a>
        <a href="#" data-toggle="modal"  class="CommentIcon" data-target="#Delete_Cat_Form" 
        data-id="' . $row[0] . '">
            <i class="mdi mdi-delete-variant text-dark" style="font-size:20px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Record"></i>
        </a>
        </div>
        ';
            $html .= '</tr>';

            $id = $row["ID"];
            if ($id != "NULL" && $id != "Null" && !empty($id)) {
                $sql_sub = "SELECT *  FROM `category` WHERE Parent_ID = $id";
                $check_sub = mysqli_query($connection, $sql_sub);
                while ($row_sub = mysqli_fetch_array($check_sub)) {
                    $html .= '<tr>';
                    // $html .= '<td><input type="checkbox"  value="' . $row["ID"] . '"></td>';
                    $html .= '<td>' . $i . '</td>';
                    $html .= '<td>' . $row["Name"] . "➡" . $row_sub["Name"] . '</td>';
                    if ($row_sub['Discription'] == "") {
                        $html .= '<td style="color:green">N/A</td>';
                    } else if (strlen($row_sub['Discription']) > 40) {
                        $html .= '<td>' . $substr($row_sub['Discription'], 0, 30) . "......" . '</td>';
                    } else {
                        $html .= '<td>' . $row_sub["Discription"] . '</td>';
                    }

                    //Image
                    if ($row_sub['Image'] == "") {
                        $html .= '<td style="color:green">N/A</td>';
                    } else {
                        $html .= '<td class="p-0 d-flex justify-content-center"><img style="height:68px" class="img-thumbnail rounded" src="uploads/Categories/' . $row_sub['Image'] . '"></td>';
                    }
                    //SORT oRDER
                    if ($row_sub["Sort_Order"] == "" || $row_sub["Sort_Order"] == null) {
                        $html .= '<td style="color:green">N/A</td>';
                    } else {
                        $html .= '<td>' . $row_sub["Sort_Order"] . '</td>';
                    }
                    if ($row_sub["Status"] == false || $row_sub["Status"] == "False") {
                        $html .= '<td>

                                <label class="switch" data-id="' . $row_sub[0] . '">
                                <input type="checkbox"  class="ChangeCommentStatus" name="Cat_Status" >
                                <span class="slider round"></span>
                            </label>
                            </td>';
                    } else if ($row_sub["Status"] == true || $row_sub["Status"] == "True") {
                        $html .= '<td>
                    
                        <label class="switch" data-id="' . $row_sub[0] . '">
                            <input type="checkbox"  class="ChangeCommentStatus" name="Cat_Status" checked>
                            <span class="slider round"></span>
                        </label>
                        </td>';
                    } else {
                        $html .= '<td class="text-danger">N/A</td>';
                    }

                    $html .= '<td>
                        <div class="d-flex justify-content-end">
                        <a href="#" data-toggle="modal" class="CommentIcon" data-target="#EditCatModal" 
                        data-id="' . $row_sub[0] . '" >
                            <i class="mdi mdi-circle-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
                        </a>
                        <a href="#" data-toggle="modal"  class="CommentIcon" data-target="#Delete_Cat_Form" 
                        data-id="' . $row_sub[0] . '">
                            <i class="mdi mdi-delete-variant text-dark" style="font-size:20px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete Record"></i>
                        </a>
                        </div>
                        ';
                    $html .= '</tr>';
                }
            }


            $i++;
        }
        echo json_encode(["status" => "success", "html" => $html]);
    } else {
        echo json_encode(["status" => "empty"]);
    }
}
