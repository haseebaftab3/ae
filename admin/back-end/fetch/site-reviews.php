<?php
//connection
require("../../connection.php");

//variables
$html = "";
$len = 0;

//query
$query = "SELECT DISTINCT `product_rating`.`ID`,`product_rating`.`Name` AS `User Name`,`product_rating`.`Email`,`products`.`Name`, `products`.`Model`, `product_rating`.`Review`, `product_rating`.`Quality`,`product_rating`.`Value`,`product_rating`.`Price`, `product_rating`.`Status` AS Visibility FROM `product_rating`,`products` where `product_rating`.`Product_ID`=`products`.`ID`";

//check
$check = mysqli_query($connection, $query);
if ($check) {
    while ($row = mysqli_fetch_array($check)) {
        $html .= '<tr>';
        $html .= '<td>' . $row['ID'] . '</td>';
        $html .= '<td>' . $row['User Name'] . '</td>';
        $html .= '<td>' . $row['Email'] . '</td>';
        $html .= '<td>' . $row['Name'] . '</td>';
        $html .= '<td>' . $row['Model'] . '</td>';
        $html .= '<td>' . $row['Review'] . '</td>';
        $html .= '<td>' . $row['Quality'] . '</td>';
        $html .= '<td>' . $row['Value'] . '</td>';
        $html .= '<td>' . $row['Price'] . '</td>';
        if ($row['Visibility'] == 1) {
            $html .= '<td>
            <label class="switch" data-id="' . $row["ID"] . '">
              <input type="checkbox"  class="ChangeCommentStatus" checked>
              <span class="slider round"></span>
            </label>
            </td>';
        } else if ($row['Visibility'] == 0) {
            $html .= '<td>
            <label class="switch CommentIcons" data-id="' . $row["ID"] . '">
              <input type="checkbox" class="ChangeCommentStatus ">
              <span class="slider round"></span>
            </label>
            </td>';
        }

        $len = $row[0];
    }
    echo json_encode(['status' => 'success', 'html' => $html, 'Query_length' => $len]);
} else {
    echo json_encode(['status' => 'error', 'html' => $error]);
}
