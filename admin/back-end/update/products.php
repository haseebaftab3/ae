<?php
require("../../connection.php");





//Variables

$ID = $_POST["ID"];
$Name = $_POST["Name"];
$Model = $_POST["Model"];
$Parent = $_POST["Product_Parent"];
$Price = $_POST["Price"];
$UnitPrice = $_POST["UnitPrice"];
$UnitQuantity = $_POST["UnitQuantity"];
$discription = $_POST["Discription"];
$MetaTitle = $_POST["MetaTitle"];
// Data
$Manufacture = $_POST["Manufacture"];
$SortOrder = $_POST["SortOrder"];
$Quantity = $_POST["Quantity"];
$MinQuantity = $_POST["MinQuantity"];
$SubStock = $_POST["SubStock"];
$StockStatus = $_POST["StockStatus"];
$DateAv = $_POST["DateAv"];
$ShippingPrice = $_POST["ShippingPrice"];
$Length = $_POST["Length"];
$Width = $_POST["Width"];
$Height = $_POST["Height"];
$LengthClass = $_POST["LengthClass"];
$Weight = $_POST["Weight"];
$WeightClass = $_POST["WeightClass"];
$Shipping = $_POST["Shipping"];

// Default
$DefaultColor = $_POST["DefaultColor"];
$DefaultColorHex = $_POST["DefaultColorHex"];
$DefaultSize = $_POST["DefaultSize"];
$DefaultAmp = $_POST["DefaultAmp"];
// Options
$Color = $_POST["Color"];
$Color_Price = $_POST["Color_Value"];

$ColorLen =  count($Color);
// **Size
$Size = $_POST["Size"];
$Size_Price = $_POST["Size_Value"];

$SizeLen =  count($Size);

$m = 0;
$uploadStatus = 1;

// SEO
$MetaDiscription = $_POST["MetaDiscription"];
$MetaKeywords = $_POST["MetaKeywords"];
$ProductTag = $_POST["ProductTag"];

// Images
$Image = basename($_FILES["image"]["name"]);

$uploadStatus = 0;

if (isset($_POST["Status"])) {
    $Status = 1;
} else {
    $Status = 0;
}




if (!empty($Image)) {
    // echo "aa";
    //File Uploading
    $target_dir = "../../uploads/Products/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // $uploadOk = 1;
        // Check file size
        if ($_FILES["image"]["size"] > 1000000) {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, your Image is too large.']);
            $uploadOk = 0;
        } else {
            // Allow certain file formats

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Sorry, your Image was not uploaded.']);
                // if everything is ok, try to upload file
            } else {
                // echo "aaaasda";
                $f_name = $_FILES["image"]["name"];
                $ext = explode('.', $f_name);
                $file_extension = end($ext);
                $Image = md5(rand()) . '.' . $file_extension;
                $target_file = $target_dir . $Image;
                // echo $Image;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    //query
                    // echo "Aa";
                    $query = "UPDATE `products` SET `Category_ID`=$Parent,`Manufacture_ID`=$Manufacture,`Name`='$Name',`Model`='$Model',
                            `Price`=$Price,`UnitPrice`='$UnitPrice',`Unit_Quantity`='$UnitQuantity',`Shipping_Price`='$ShippingPrice',`Description`='$discription',`MetaTitle`='$MetaTitle',`Image`='$Image',
                            `Quantity`=$Quantity,`Weight`='$Weight',`Length`='$Length',`Width`='$Width',`Height`='$Height',
                            `DColor`='$DefaultColor',`H_Code`='$DefaultColorHex',`DSize`='$DefaultSize',`DAmp`='$DefaultAmp',`SortOrder`='$SortOrder',`Stock_staus`='$StockStatus',
                            `Status`=$Status,`Shipping`='$Shipping',`Minimum`=$MinQuantity,`LengthClass`='$LengthClass',
                            `WeightClass`='$WeightClass',`Subtract`='$SubStock',`Date_modified`= 'current_timestamp()',`Date_avilable`='$DateAv'  WHERE  ID = $ID";

                    $check = mysqli_query($connection, $query);
                    // die(mysqli_error($connection));
                    if ($check) {
                        $uploadStatus = 1;
                        // update SEO
                        $ESEO = "UPDATE `products_seo` SET `MetaDiscription`='$MetaDiscription',`MetaKeywords`='$MetaKeywords',`ProductTag`='$ProductTag' WHERE product_ID = $ID";
                        $Check_ESEO = mysqli_query($connection, $ESEO);
                        // die(mysqli_error($connection));
                        if ($Check_ESEO) {
                            $uploadStatus = 1;
                            //Create File Variabels;
                            if (isset($_FILES['Add_Img']) && !empty($_FILES['Add_Img'])) {
                                $files = $_FILES['Add_Img'];
                                $data = [];
                                // print_r($_FILES['Add_Img']);
                                //for each to extrect values from array
                                foreach ($files as $index => $file_info) {
                                    //for each to seprate values
                                    foreach ($file_info as $inner_html => $value) {
                                        $data[$inner_html][$index] = $value;
                                    }
                                }


                                // Add Additional Images
                                foreach ($data as $files) {
                                    if ($files["name"] != "" && !empty($files["name"]) && $files["type"] != "" && !empty($files["type"]) && $files["size"] != 0 && !empty($files["size"])) {
                                        //File Uploading
                                        $target_dir1 = "../../uploads/Products/";
                                        $target_file1 = $target_dir1 . basename($files['name']);
                                        $uploadOk1 = 1;
                                        $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                                        $MID = $_POST["SendImg" . $m];
                                        // echo $MID . "\n";
                                        $ext1 = explode('/', $files['type']);

                                        $Image1 = md5(rand()) . '.' . $ext1[1];
                                        $target_file1 = $target_dir1 . $Image1;
                                        // print_r($target_file1);
                                        if (move_uploaded_file($files["tmp_name"], $target_file1)) {

                                            $ADDImg_SQL = "UPDATE `products_images` SET `Image`='$Image1' WHERE  `product_ID` = $ID AND `ID` = $MID";
                                            $ADDImg_Check = mysqli_query($connection, $ADDImg_SQL);
                                            if ($ADDImg_Check) {
                                                $uploadStatus = 1;
                                            } else {
                                                $uploadStatus = 0;
                                            }
                                        }

                                        // }
                                        $m++;
                                    }
                                }
                            }
                            // End Additional Images
                        } else {
                            $uploadStatus = 0;
                            // echo json_encode(['status' => 'error', 'message' => 'Sorry something went wrong. Please Try Again.']);
                        }
                    }
                } else {
                    $uploadStatus = 0;
                    // echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
                }
            }
        }
    }
} else {
    $query = "UPDATE `products` SET `Category_ID`=$Parent,`Manufacture_ID`=$Manufacture,`Name`='$Name',`Model`='$Model',
    `Price`=$Price,`UnitPrice`='$UnitPrice',`Unit_Quantity`='$UnitQuantity',`Shipping_Price`='$ShippingPrice',`Description`='$discription',`MetaTitle`='$MetaTitle',
    `Quantity`=$Quantity,`Weight`='$Weight',`Length`='$Length',`Width`='$Width',`Height`='$Height',
    `DColor`='$DefaultColor',`H_Code`='$DefaultColorHex',`DSize`='$DefaultSize',`DAmp`='$DefaultAmp',`SortOrder`='$SortOrder',`Stock_staus`='$StockStatus',
    `Status`=$Status,`Shipping`='$Shipping',`Minimum`=$MinQuantity,`LengthClass`='$LengthClass',
    `WeightClass`='$WeightClass',`Subtract`='$SubStock',`Date_modified`= 'current_timestamp()',`Date_avilable`='$DateAv'  WHERE  ID = $ID";
    $check = mysqli_query($connection, $query);
    if ($check) {
        $uploadStatus = 1;
        // update SEO
        $ESEO = "UPDATE `products_seo` SET `MetaDiscription`='$MetaDiscription',`MetaKeywords`='$MetaKeywords',`ProductTag`='$ProductTag' WHERE product_ID = $ID";
        $Check_ESEO = mysqli_query($connection, $ESEO);
        // die(mysqli_error($connection));
        if ($Check_ESEO) {
            $uploadStatus = 1;
            //Create File Variabels;
            if (isset($_FILES['Add_Img']) && !empty($_FILES['Add_Img'])) {
                $files = $_FILES['Add_Img'];
                $data = [];
                // print_r($_FILES['Add_Img']);
                // print_r($_FILES['Add_Img']);
                //for each to extrect values from array
                foreach ($files as $index => $file_info) {
                    //for each to seprate values
                    foreach ($file_info as $inner_html => $value) {
                        $data[$inner_html][$index] = $value;
                    }
                }


                // Add Additional Images
                foreach ($data as $files) {
                    if ($files["name"] != "" && !empty($files["name"]) && $files["type"] != "" && !empty($files["type"]) && $files["size"] != 0 && !empty($files["size"])) {
                        //File Uploading
                        $target_dir1 = "../../uploads/Products/";
                        $target_file1 = $target_dir1 . basename($files['name']);
                        $uploadOk1 = 1;
                        $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
                        $MID = $_POST["SendImg" . $m];
                        // echo $MID . "\n";
                        $ext1 = explode('/', $files['type']);

                        $Image1 = md5(rand()) . '.' . $ext1[1];
                        $target_file1 = $target_dir1 . $Image1;
                        // print_r($target_file1);
                        if (move_uploaded_file($files["tmp_name"], $target_file1)) {

                            $ADDImg_SQL = "UPDATE `products_images` SET `Image`='$Image1' WHERE  `product_ID` = $ID AND `ID` = $MID";
                            $ADDImg_Check = mysqli_query($connection, $ADDImg_SQL);
                            if ($ADDImg_Check) {
                                $uploadStatus = 1;
                            } else {
                                $uploadStatus = 0;
                            }
                        }

                        // }
                        $m++;
                    }
                }
            }
            // End Additional Images
        } else {
            $uploadStatus = 0;
            // echo json_encode(['status' => 'error', 'message' => 'Sorry something went wrong. Please Try Again.']);
        }
    }
}





// Additiona; Images
if (isset($_FILES['Add_Img']) && !empty($_FILES['Add_Img'])  &&  $_FILES['Add_Img']["error"][0] <= 0) {
    //Create File Variabels;
    $files = $_FILES['Add_Img'];
    $data = [];

    //for each to extrect values from array
    foreach ($files as $index => $file_info) {
        //for each to seprate values
        foreach ($file_info as $inner_html => $value) {
            $data[$inner_html][$index] = $value;
        }
    }


    // Add Additional Images
    foreach ($data as $files) {
        if ($files["name"] != "" && !empty($files["name"]) && $files["type"] != "" && !empty($files["type"]) && $files["size"] != 0 && !empty($files["size"])) {

            //File Uploading
            $target_dir1 = "../../uploads/Products/";
            $target_file1 = $target_dir1 . basename($files['name']);
            $uploadOk1 = 1;
            $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));


            $ext1 = explode('/', $files['type']);
            $Image1 = md5(rand()) . '.' . $ext1[1];
            $target_file1 = $target_dir1 . $Image1;
            // print_r($target_file1);
            if (move_uploaded_file($files["tmp_name"], $target_file1)) {

                $ADDImg_SQL = "INSERT INTO `products_images`(`product_ID`, `Image`) VALUES
                                 ($FetchID,'$Image1')";
                $ADDImg_Check = mysqli_query($connection, $ADDImg_SQL);
                if ($ADDImg_Check) {
                    $uploadStatus = 1;
                } else {
                    $uploadStatus = 0;
                }
            }
        }
    }
}




// Add New AddImage


if (isset($_FILES['InNewImg']) && !empty($_FILES['InNewImg'])  &&  $_FILES['InNewImg']["error"][0] <= 0) {
    //Create File Variabels;
    $files = $_FILES['InNewImg'];

    // print_r($files);
    //for each to extrect values from array
    foreach ($files as $index => $file_info) {
        //for each to seprate values
        foreach ($file_info as $inner_html => $value) {
            $data[$inner_html][$index] = $value;
        }
    }



    // Add Additional Images
    foreach ($data as $files) {
        //File Uploading
        if ($files["name"] != "" && !empty($files["name"]) && $files["type"] != "" && !empty($files["type"]) && $files["size"] != 0 && !empty($files["size"])) {

            $target_dir1 = "../../uploads/Products/";
            $target_file1 = $target_dir1 . basename($files['name']);
            $uploadOk1 = 1;
            $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));


            $ext1 = explode('/', $files['type']);
            $Image1 = md5(rand()) . '.' . $ext1[1];
            $target_file1 = $target_dir1 . $Image1;
            // print_r($target_file1);
            if (move_uploaded_file($files["tmp_name"], $target_file1)) {

                $ADDImg_SQL = "INSERT INTO `products_images`(`product_ID`, `Image`) VALUES
                                 ($ID,'$Image1')";
                $ADDImg_Check = mysqli_query($connection, $ADDImg_SQL);
                // die(mysqli_error($connection));
                if ($ADDImg_Check) {
                    $uploadStatus = 1;
                } else {
                    $uploadStatus = 0;
                }
            }
        }
    }
}



if ($uploadStatus == 1) {
    echo json_encode(['status' => 'success', 'message' => 'Record updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Sorry something went wrong. Please Try Again.']);
}
