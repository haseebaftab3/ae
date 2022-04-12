<?php
require("../../connection.php");





//Variables
$Name = $_POST["Name"];
$Model = $_POST["Model"];
$Parent = $_POST["Product_Parent"];
$Price = $_POST["Price"];
$Disc = $_POST["Discription"];
$MetaTitle = $_POST["MetaTitle"];
// Data
// Addition Unit DATA End
$unitPrice = $_POST["Unit_Price"];
$unitQuantity = $_POST["Unit_Quantity"];
// Addition Unit DATA End
$ShippingPrice = $_POST["ShippingPrice"];
$Manufacture = $_POST["Manufacture"];
$SortOrder = $_POST["SortOrder"];
$Quantity = $_POST["Quantity"];
$MinQuantity = $_POST["MinQuantity"];
$SubStock = $_POST["SubStock"];
$StockStatus = $_POST["StockStatus"];
$DateAv = $_POST["DateAv"];
$Length = $_POST["Length"];
$Width = $_POST["Width"];
$Height = $_POST["Height"];
$LengthClass = $_POST["LengthClass"];
$Weight = $_POST["Weight"];
$WeightClass = $_POST["WeightClass"];
$Shipping = $_POST["Shipping"];

// Default
$DefaultColor = $_POST["DefaultColor"];
$DefaultSize = $_POST["DefaultSize"];
$DefaultHcode = $_POST["DefaultHcode"];
// Options
$Color = $_POST["Color"];
$Color_Price = $_POST["Color_Value"];
$ColorCode = $_POST["ColorCode"];

$ColorLen =  count($Color);
// **Size
$Size = $_POST["Size"];
$Size_Price = $_POST["Size_Value"];

$SizeLen =  count($Size);

// *AMP
$DefaultAmp = $_POST["DefaultAmp"];
$AmpName = $_POST["Amp"];
$Amp_Value = $_POST["Amp_Value"];
$Amp_Quantity = $_POST["Amp_Quantity"];
$ampLen = count($AmpName);
// SEO
$MetaDiscription = $_POST["MetaDiscription"];
$MetaKeywords = $_POST["MetaKeywords"];
$ProductTag = $_POST["ProductTag"];

// Images
$Image = basename($_FILES["Img"]["name"]);
// $CAddImage = basename($_FILES["Add_Img"]["name"]);

$uploadStatus = 0;

if (isset($_POST["Status"])) {
    $Status = 1;
} else {
    $Status = 0;
}


if (!empty($Name) && !empty($Model) && !empty($MetaTitle) && !empty($Price)) {
    if (!empty($Image) && isset($_FILES['Add_Img']) && !empty($_FILES['Add_Img'])  &&  $_FILES['Add_Img']["error"][0] <= 0) {

        if (isset($_FILES["Img"]["name"]) && !empty($_FILES["Img"]["name"])) {
            //File Uploading
            $target_dir = "../../uploads/Products/";
            $target_file = $target_dir . basename($_FILES["Img"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["Img"]["tmp_name"]);
                if ($check !== false) {
                    echo json_encode(['status' => 'error', 'msg' => 'Image is an image - " . $check["mime"] . "."']);
                    $uploadOk = 1;
                } else {
                    echo json_encode(['status' => 'error', 'msg' => 'Image is not an image.']);
                    $uploadOk = 0;
                }
            }
            // Check file size
            if ($_FILES["Img"]["size"] > 50000000) {
                echo json_encode(['status' => 'error', 'msg' => 'Sorry, your Image is too large.']);
                $uploadOk = 0;
            } else {
                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo json_encode(['status' => 'error', 'msg' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
                    $uploadOk = 0;
                } else {
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo json_encode(['status' => 'error', 'msg' => 'Sorry, your Image was not uploaded.']);
                        // if everything is ok, try to upload file
                    } else {
                        // Check if file already exists
                        $f_name = $_FILES["Img"]["name"];
                        $ext = explode('.', $f_name);
                        $file_extension = end($ext);
                        $Image = md5(rand()) . '.' . $file_extension;
                        $target_file = $target_dir . $Image;
                        // print_r($_FILES["Img"]["tmp_name"]);
                        if (move_uploaded_file($_FILES["Img"]["tmp_name"], $target_file)) {
                            $sql = "INSERT INTO `products`
                        (`Category_ID`, `Manufacture_ID`, `Name`, `Model`, `Price`,`UnitPrice`, `Unit_Quantity`,`Shipping_Price`, `Description`, `MetaTitle`,
                        `Image`,`Quantity`, `Weight`,`Length`, `Width`, `Height`, `DColor`,`H_Code`, `DSize`,`DAmp`, `SortOrder`, `Stock_staus`, `Status`,
                        `Shipping`, `Minimum`, `LengthClass`, `WeightClass`, `Subtract`, `Date_avilable`) 
                        VALUES ($Parent,$Manufacture,'$Name','$Model',$Price,$unitPrice,'$unitQuantity','$ShippingPrice','$Disc','$MetaTitle','$Image',$Quantity,
                        '$Weight','$Length','$Width','$Height','$DefaultColor','$DefaultHcode','$DefaultSize','$DefaultAmp','$SortOrder','$StockStatus',$Status,'$Shipping',$MinQuantity,
                        '$LengthClass','$WeightClass','$SubStock','$DateAv')";

                            $check = mysqli_query($connection, $sql);

                            if ($check) {

                                // Fetch Result 
                                $FetchSQL = "SELECT `ID` FROM `products` WHERE `Name`='$Name' AND `Model` = '$Model' AND `Price` = $Price";
                                $CheckSQL = mysqli_query($connection, $FetchSQL);
                                if (mysqli_num_rows($CheckSQL) > 0) {
                                    $FetchROW = mysqli_fetch_array($CheckSQL);
                                    $FetchID  = $FetchROW[0];
                                    // SEO

                                    $SEO_SQL = "INSERT INTO `products_seo`(`Product_ID`, `MetaDiscription`, `MetaKeywords`, `ProductTag`)
                                VALUES ($FetchID,'$MetaDiscription','$MetaKeywords','$ProductTag')";
                                    $SEO_Check = mysqli_query($connection, $SEO_SQL);

                                    if ($SEO_Check) {
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

                                                //File Uploading
                                                $target_dir1 = "../../uploads/Products/";
                                                $target_file1 = $target_dir1 . basename($files['name']);
                                                $uploadOk1 = 1;
                                                $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

                                                if (
                                                    $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
                                                    && $imageFileType1 != "gif"
                                                ) {
                                                    echo json_encode(['status' => 'error', 'msg' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
                                                    $uploadOk = 0;
                                                } else {
                                                    $ext1 = explode('/', $files['type']);
                                                    $Image1 = md5(rand()) . '.' . $ext1[1];
                                                    $target_file1 = $target_dir1 . $Image1;
                                                    // print_r($target_file1);
                                                    if (move_uploaded_file($files["tmp_name"], $target_file1)) {

                                                        $ADDImg_SQL = "INSERT INTO `products_images`(`Product_ID`, `Image`) VALUES
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
                                            if ($uploadStatus == 1) {
                                                echo json_encode(["status" => "success", "msg" => "New Product Added Successfully"]);
                                            } else {
                                                echo json_encode(["status" => "error", "msg" => "Unknown Error!!"]);
                                            }
                                            // End Additional Images
                                        } else {
                                            echo json_encode(["status" => "success", "msg" => "New Product Added Successfully"]);
                                        }
                                    } else {
                                        echo json_encode(['status' => 'error', 'msg' => 'Unknown Error.']);
                                    }

                                    // !! Options
                                    // ??Color
                                    if ($ColorLen > 0 && !empty($Color[0])) {
                                        for ($i = 0; $i <= $ColorLen - 1; $i++) {
                                            $NewCol = $Color[$i];
                                            $NewColPrice = $Color_Price[$i];
                                            $NewColCode = $ColorCode[$i];

                                            $AddOption = "INSERT INTO `prodcuts_option`( `Product_ID`, `Type`, `Name`,`H_Code`, `Price`, `Required`) VALUES
                                        ($FetchID,'Color','$NewCol','$NewColCode','$NewColPrice',1)";
                                            $checkOption = mysqli_query($connection, $AddOption);
                                            // if (!$checkOption) {
                                            //     die(mysqli_error($connection));
                                            // }
                                        }
                                    }


                                    // ?Amp
                                    if ($ampLen > 0 && !empty($AmpName[0])) {
                                        for ($i = 0; $i <= $ampLen - 1; $i++) {
                                            $NewAmp = $AmpName[$i];
                                            $NewAmpPrice = $Amp_Value[$i];
                                            $NewAmpQuen = $Amp_Quantity[$i];
                                            $AddOption = "INSERT INTO `prodcuts_option`( `Product_ID`, `Type`, `Name`,`Price`,`Quantity`,`Required`) VALUES
                                            ($FetchID,'Amp','$NewAmp',$NewAmpPrice,'$NewAmpQuen',1)";
                                            $checkOption = mysqli_query($connection, $AddOption);
                                            // if (!$checkOption) {
                                            //     die(mysqli_error($connection));
                                            // }
                                        }
                                    }

                                    // ??Size
                                    if ($SizeLen > 0 && !empty($Size[0])) {
                                        for ($i = 0; $i <= $SizeLen - 1; $i++) {
                                            $NewColS = $Size[$i];
                                            $NewColPriceS = $Size_Price[$i];
                                            $AddOptionS = "INSERT INTO `prodcuts_option`( `Product_ID`, `Type`, `Name`, `Price`, `Required`) VALUES
                                        ($FetchID,'Size','$NewColS','$NewColPriceS',1)";
                                            $checkOption = mysqli_query($connection, $AddOptionS);
                                        }
                                    }
                                    // !! Options ENd

                                } else {
                                    echo json_encode(["status" => "error", "msg" => "Unknown Error."]);
                                }
                            } else {
                                echo json_encode(['status' => 'error', 'msg' => 'Failed To  Add Prodcut']);
                            }
                        } else {
                            echo json_encode(['status' => 'error', 'msg' => 'Sorry, there was an error uploading your file.']);
                        }
                    }
                }
            }
        } else {
            $sql = "INSERT INTO `products`
                        (`Category_ID`, `Manufacture_ID`, `Name`, `Model`, `Price`,`UnitPrice`, `Unit_Quantity`, `Description`, `MetaTitle`,
                       `Quantity`,`Weight`, `Length`, `Width`, `Height`, `DColor`, `H_Code`, `DSize`,`DAmp`,`SortOrder`, `Stock_staus`, `Status`,
                        `Shipping`, `Minimum`, `LengthClass`, `WeightClass`, `Subtract`, `Date_avilable`) 
                        VALUES ($Parent,$Manufacture,'$Name','$Model',$Price,$unitPrice,'$unitQuantity','$Disc','$MetaTitle',$Quantity,'$Weight',
                        '$Length','$Width','$Height','$DefaultColor','$DefaultHcode','$DefaultSize','$DefaultAmp','$SortOrder','$StockStatus',$Status,'$Shipping',$MinQuantity,
                        '$LengthClass','$WeightClass','$SubStock','$DateAv')";

            $check = mysqli_query($connection, $sql);

            if ($check) {

                // Fetch Result 
                $FetchSQL = "SELECT `ID` FROM `products` WHERE `Name`='$Name' AND `Model` = '$Model' AND `Price` = $Price";
                $CheckSQL = mysqli_query($connection, $FetchSQL);
                if (mysqli_num_rows($CheckSQL) > 0) {
                    $FetchROW = mysqli_fetch_array($CheckSQL);
                    $FetchID  = $FetchROW[0];
                    // SEO

                    $SEO_SQL = "INSERT INTO `products_seo`(`Product_ID`, `MetaDiscription`, `MetaKeywords`, `ProductTag`)
                                VALUES ($FetchID,'$MetaDiscription','$MetaKeywords','$ProductTag')";
                    $SEO_Check = mysqli_query($connection, $SEO_SQL);
                    if ($SEO_Check) {
                        // print_r($_FILES['Add_Img']);
                        // print_r($_FILES['Add_Img']["error"][0]);
                        if (isset($_FILES['Add_Img']) && !empty($_FILES['Add_Img']) &&  $_FILES['Add_Img']["error"][0] <= 0) {
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
                                //File Uploading
                                $target_dir1 = "../../uploads/Products/";
                                $target_file1 = $target_dir1 . basename($files['name']);
                                $uploadOk1 = 1;
                                $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));

                                if (
                                    $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
                                    && $imageFileType1 != "gif"
                                ) {
                                    echo json_encode(['status' => 'error', 'msg' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
                                    $uploadOk = 0;
                                } else {
                                    $ext1 = explode('/', $files['type']);
                                    // print_r($ext1);
                                    $Image1 = md5(rand()) . '.' . $ext1[1];
                                    $target_file1 = $target_dir1 . $Image1;
                                    // print_r($target_file1);
                                    if (move_uploaded_file($files["tmp_name"], $target_file1)) {

                                        $ADDImg_SQL = "INSERT INTO `products_images`(`Product_ID`, `Image`) VALUES
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
                            if ($uploadStatus == 1) {
                                echo json_encode(["status" => "success", "msg" => "New Product Added Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Unknown Error!!"]);
                            }
                            // End Additional Images
                        } else {
                            echo json_encode(["status" => "success", "msg" => "New Product Added Successfully"]);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'msg' => 'Unknown Error.']);
                    }
                }

                // !! Options
                // ??Color
                if ($ColorLen > 0 && !empty($Color[0])) {
                    for ($i = 0; $i <= $ColorLen - 1; $i++) {
                        $NewCol = $Color[$i];
                        $NewColPrice = $Color_Price[$i];
                        $NewColCode = $ColorCode[$i];
                        $AddOption = "INSERT INTO `prodcuts_option`( `Product_ID`, `Type`, `Name`,`H_Code`, `Price`, `Required`) VALUES
                        ($FetchID,'Color','$NewCol','$NewColCode','$NewColPrice',1)";
                        $checkOption = mysqli_query($connection, $AddOption);
                        // if (!$checkOption) {
                        //     die(mysqli_error($checkOption));
                        // }
                    }
                }


                // ?Amp
                if ($ampLen > 0 && !empty($AmpName[0])) {
                    for ($i = 0; $i <= $ampLen - 1; $i++) {
                        $NewAmp = $AmpName[$i];
                        $NewAmpPrice = $Amp_Value[$i];
                        $NewAmpQuen = $Amp_Quantity[$i];
                        $AddOption = "INSERT INTO `prodcuts_option`( `Product_ID`, `Type`, `Name`,`Price`,`Quantity`,`Required`) VALUES
                                            ($FetchID,'Amp','$NewAmp',$NewAmpPrice,'$NewAmpQuen',1)";
                        $checkOption = mysqli_query($connection, $AddOption);
                        // if (!$checkOption) {
                        //     die(mysqli_error($connection));
                        // }
                    }
                }

                // ??Size
                if ($SizeLen > 0 && !empty($Size[0])) {
                    for ($i = 0; $i <= $SizeLen - 1; $i++) {
                        $NewColS = $Size[$i];
                        $NewColPriceS = $Size_Price[$i];
                        $AddOptionS = "INSERT INTO `prodcuts_option`( `Product_ID`, `Type`, `Name`, `Price`, `Required`) VALUES
                                        ($FetchID,'Size','$NewColS','$NewColPriceS',1)";
                        $checkOption = mysqli_query($connection, $AddOptionS);
                    }
                }
                // !! Options ENd

            } else {
                echo json_encode(["status" => "error", "msg" => "Failed To  Add Product"]);
            }
        }
    } else {
        echo json_encode(["status" => "error", "msg" => "Both Thumbnail And Additional Image Is Required"]);
    }
} else {
    echo json_encode(["status" => "error", "msg" => "Please Fill All Fields Carefully"]);
}
