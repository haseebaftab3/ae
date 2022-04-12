<?php
require("../../connection.php");
$html = "";
$i = 1;
$sql = "SELECT `product_order`.`ID`,`product_order`.`Order_ID`,GROUP_CONCAT(`products`.`Name`,' (',`products`.`Model`,') QTY= ',`product_order`.`Quantity`) as `Product Detail`,`product_order`.`Name`,`product_order`.`Number`,`product_order`.`Email`,`product_order`.`Shipping_Vendor`,`product_order`.`Consignment_No`,`product_order`.`Type`,`product_order`.`Status`,`product_order`.`Bank_Payment_Staus`,`product_order`.`Address`, SUM(`product_order`.`Sub_Total`) AS Total FROM `product_order`,`products` where `products`.`ID`=`product_order`.`Product_ID` GROUP BY `Order_ID` ORDER BY `product_order`.`ID` DESC";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<tr>';
            $html .= '<td>' . $i . '</td>';
            $html .= '<td>' . $row["Order_ID"] . '</td>';
            $ProductDetailv = explode(",", $row["Product Detail"]);
            // print_r($ProductDetailv);
            $html .= '<td>';
            foreach ($ProductDetailv as $key => $NRow) {
                $html .= '(' . ++$key . ') ' .  $NRow;
                $html .= '<br>';
            }
            $html .= '</td>';
            $html .= '<td>Rs.' . $row["Total"] . '</td>';
            $html .= '<td>' . $row["Name"] . '</td>';
            $html .= '<td><a href="mailto:' . $row["Email"] . '">' . $row["Email"] . '</a></td>';
            $html .= '<td><a href="tel:' . $row["Number"] . '">' . $row["Number"] . '</a></td>';
            $html .= '<td>' . $row["Address"] . '</td>';

            $html .= '<td>' . $row["Type"] . '</td>';
            if ($row["Bank_Payment_Staus"] == NULL) {
                $html .= '<td>N/A</td>';
            } else {
                $html .= '<td>' . $row["Bank_Payment_Staus"] . '</td>';
            }
            $html .= '<td>' . $row["Status"] . '</td>';
            $html .= '<td>' . $row["Consignment_No"] . '</td>';
            $html .= '<td>' . $row["Shipping_Vendor"] . '</td>';

            if ($row["Type"] == NULL  || $row["Type"] === "COD") {
                $html .= '<td>
                <div class="d-flex justify-content-end">
                <a href="#" data-toggle="modal" class="CommentIconA" data-target="#EditOrderModal" 
                data-id="' . $row[0] . '" data-orderid = "' . $row["Order_ID"] . '"  data-status = "' . $row["Status"] . '">
                    <i class="mdi mdi-file-document-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
                </a> 
                <a href="#" data-toggle="modal" class="CommentIcon" data-target="#ViewOrderModal" 
                data-id="' . $row["Order_ID"] . '" >
                    <i class="mdi mdi-file-eye-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
                </a>
                ';
            } else {
                $html .= '<td>
        <div class="d-flex justify-content-end">
        <a href="#" data-toggle="modal" class="CommentIconA" data-target="#EditOrderModal" 
        data-id="' . $row[0] . '" data-orderid = "' . $row["Order_ID"] . '" data-status = "' . $row["Status"] . '">
            <i class="mdi mdi-file-document-edit-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
        </a> 
        <a href="#" data-toggle="modal" class="CommentIcon" data-target="#ViewOrderModal" 
        data-id="' . $row["Order_ID"] . '" >
            <i class="mdi mdi-file-eye-outline text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
        </a>
         <a href="#" data-toggle="modal" class="CommentIconA" data-target="#ChangeShipPaidStatus" 
        data-id="' . $row[0] . '" data-orderid = "' . $row["Order_ID"] . '"  data-status = "' . $row["Status"] . '">
            <i class="mdi mdi-bank-plus text-dark" style="font-size:18px;cursor:pointer;color: #747a80;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"></i>
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
