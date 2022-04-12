<?php
require("../../connection.php");
$IMG = [];
$IMG_ID = [];
// Options
$OptionID = [];
$OptionType = [];
$OptionName = [];
$OptionPrice = [];
$OptionProdId = [];
$Option_H_Code = [];
$Option_Unit_Price = [];
$Option_Quantity = [];

$id = $_POST["id"];
$sql = "SELECT * FROM `products` WHERE `ID`=$id";
$check = mysqli_query($connection, $sql);
if ($check) {
    if (mysqli_num_rows($check) > 0) {
        $row  = mysqli_fetch_array($check);
        if (!empty($row["Category_ID"])) {
            $Catid = $row["Category_ID"];
            $Fetch_cat = "SELECT `Name` FROM `category` WHERE `ID`=$Catid";
            $check_cat = mysqli_query($connection, $Fetch_cat);
            $rowcat = mysqli_fetch_array($check_cat);
        }
        $rowManA = "None";

        if (!empty($row["Manufacture_ID"])) {
            if ($row["Manufacture_ID"] != "NULL") {
                $Manid = $row["Manufacture_ID"];
                $Fetch_Man = "SELECT `Name` FROM `manufacturer` WHERE `ID`=$Manid";
                $check_Man = mysqli_query($connection, $Fetch_Man);
                $rowMan = mysqli_fetch_array($check_Man);
                $rowManA = $rowcat["Name"];
            }
        }
        // print_r($row["Manufacture_ID"]));


        $FetchSEO = "SELECT * FROM `products_seo`  WHERE `Product_ID`=$id";
        $checkSEO = mysqli_query($connection, $FetchSEO);
        $rowSEO = mysqli_fetch_array($checkSEO);

        $FetchSEO = "SELECT * FROM `products_seo`  WHERE `Product_ID`=$id";
        $checkSEO = mysqli_query($connection, $FetchSEO);
        $rowSEO = mysqli_fetch_array($checkSEO);



        $Fetchimg = "SELECT `Image`,`ID` FROM `products_images`  WHERE `Product_ID`=$id";
        $checkimg = mysqli_query($connection, $Fetchimg);
        while ($rowimg = mysqli_fetch_array($checkimg)) {
            array_push($IMG, $rowimg["Image"]);
            array_push($IMG_ID, $rowimg["ID"]);
        }

        $FetchOpt = "SELECT * FROM `prodcuts_option`  WHERE `Product_ID`=$id";
        $checkOpt = mysqli_query($connection, $FetchOpt);
        while ($rowOpt = mysqli_fetch_array($checkOpt)) {
            array_push($OptionID, $rowOpt["ID"]);
            array_push($OptionProdId, $rowOpt["Product_ID"]);
            array_push($OptionType, $rowOpt["Type"]);
            array_push($OptionName, $rowOpt["Name"]);
            array_push($OptionPrice, $rowOpt["Price"]);
            array_push($Option_H_Code, $rowOpt["H_Code"]);
            array_push($Option_Unit_Price, $rowOpt["Unit_Price"]);
            array_push($Option_Quantity, $rowOpt["Quantity"]);
        }

        echo json_encode([
            "status" => "success",
            "Name" => $row["Name"],
            "Category_ID" => $row["Category_ID"],
            "Category_Name" => $rowcat["Name"],
            "Manufacture_ID" => $row["Manufacture_ID"],
            "Manufacture_Name" => $rowManA,
            "Model" => $row["Model"],
            "Price" => $row["Price"],
            "UnitPrice" => $row["UnitPrice"],
            "Unit_Quantity" => $row["Unit_Quantity"],
            "Description" => $row["Description"],
            "ShippingPrice" => $row["Shipping_Price"],
            "MetaTitle" => $row["MetaTitle"],
            "Image" => $row["Image"],
            "Quantity" => $row["Quantity"],
            "Weight" => $row["Weight"],
            "Length" => $row["Length"],
            "Width" => $row["Width"],
            "Height" => $row["Height"],
            "DColor" => $row["DColor"],
            "H_Code" => $row["H_Code"],
            "DSize" => $row["DSize"],
            "DAmp" => $row["DAmp"],
            "SortOrder" => $row["SortOrder"],
            "Stock_staus" => $row["Stock_staus"],
            "Status" => $row["Status"],
            "Shipping" => $row["Shipping"],
            "Minimum" => $row["Minimum"],
            "LengthClass" => $row["LengthClass"],
            "WeightClass" => $row["WeightClass"],
            "Youtube" => $row["Youtube"],
            "Subtract" => $row["Subtract"],
            "Date_avilable" => $row["Date_avilable"],
            "MetaDiscription" => $rowSEO["MetaDiscription"],
            "MetaKeywords" => $rowSEO["MetaKeywords"],
            "ProductTag" => $rowSEO["ProductTag"],
            "ADDImage" => $IMG,
            "ADDImageID" => $IMG_ID,
            // !! Product Option
            "OptionID" => $OptionID,
            "OptionProdId" => $OptionProdId,
            "OptionType" => $OptionType,
            "OptionName" => $OptionName,
            "OptionPrice" => $OptionPrice,
            "Option_H_Code" => $Option_H_Code,
            "Option_Unit_Price" => $Option_Unit_Price,
            "Option_Quantity" => $Option_Quantity,

        ]);
    }
} else {
    echo json_encode([
        "status" => "success"
    ]);
}
