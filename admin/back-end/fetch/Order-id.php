<?php
require("../../connection.php");
$id = $_POST["id"];
// echo $id;
// $sql = "SELECT `product_order`.`ID`,`product_order`.`Order_ID`,GROUP_CONCAT(`products`.`Name`,' (',`products`.`Model`,') QTY= ',`product_order`.`Quantity`) as `Product Detail`,`product_order`.`Name`,`product_order`.`Number`,`product_order`.`Email`,`product_order`.`Type`,`product_order`.`Status`,`product_order`.`Bank_Payment_Staus`, SUM(`product_order`.`Sub_Total`) AS Total FROM `product_order`,`products` where `products`.`ID`=`product_order`.`Product_ID` GROUP BY `Order_ID`";
$sql = "SELECT GROUP_CONCAT(`products`.`Name`,' (',`products`.`Model`,') Price=',`products`.`Price`,' QTY= ',`product_order`.`Quantity`) as `Product Detail`,`product_order`.*, SUM(`product_order`.`Sub_Total`) AS Total FROM `product_order`,`products` where `products`.`ID`=`product_order`.`Product_ID` AND `product_order`.`Order_ID`= '$id' GROUP BY `Order_ID` ";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $row  = mysqli_fetch_array($check);
        // $ProductDetailv = explode(",", );
        // print_r($ProductDetailv);
        // echo $row["Product Detail"];
        echo json_encode([
            "status" => "success",
            "ID" => $row["ID"],
            "Order_ID" => $row["Order_ID"],
            "Type" => $row["Type"],
            "Product_Detail" => $row["Product Detail"],
            "Sub_Total" => $row["Total"],
            "Name" => $row["Name"],
            "Email" => $row["Email"],
            "City" => $row["City"],
            "Number" => $row["Number"],
            "Postal_Code" => $row["Postal_Code"],
            "Shipping_Method" => $row["Shipping_Method"],
            "Shipping_Price" => $row["Shipping_Price"],
            "Address" => $row["Address"],
            "Coupen_Code" => $row["Coupen_Code"],
            "Status" => $row["Status"],
            "Bank_Payment_Staus" => $row["Bank_Payment_Staus"],
        ]);
    }
} else {
    // echo json_encode(["status" => "Error", "msg" => '<td valign="top" colspan="7" class="dataTables_empty">Some Thing Wrong! Please Dail The Given Number</td>']);
}
