<?php
require("../../connection.php");
//Variables
$Name = $_POST["Cat_Name"];
if (isset($_POST["Cat_Parent"])) {
    $Parent = $_POST["Cat_Parent"];
}
$Sort_Order = $_POST["Cat_Order"];
// $Status = "";
$Description = $_POST["Cat_Des"];
$Image = basename($_FILES["Cat_Img"]["name"]);

if (isset($_POST["Cat_Status"])) {
    $Status = "True";
} else {
    $Status = "False";
}


// Files
if (isset($_FILES["Cat_Img"]["name"]) && !empty($_FILES["Cat_Img"]["name"])) {
    //File Uploading
    $target_dir = "../../uploads/Categories/";
    $target_file = $target_dir . basename($_FILES["Cat_Img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["Cat_Img"]["tmp_name"]);
        if ($check !== false) {
            echo json_encode(['status' => 'error', 'message' => 'Image is an image - " . $check["mime"] . "."']);
            $uploadOk = 1;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Image is not an image.']);
            $uploadOk = 0;
        }
    }
    // Check file size
    if ($_FILES["Cat_Img"]["size"] > 500000) {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, your Image is too large.']);
        $uploadOk = 0;
    } else {
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
            $uploadOk = 0;
        } else {
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Sorry, your Image was not uploaded.']);
                // if everything is ok, try to upload file
            } else {
                // Check if file already exists
                if (file_exists($target_file)) {
                    $f_name = $_FILES["Cat_Img"]["name"];
                    $ext = explode('.', $f_name);
                    $file_extension = end($ext);
                    $Image = md5(rand()) . '.' . $file_extension;
                    $target_file = $target_dir . $Image;
                    if (move_uploaded_file($_FILES["Cat_Img"]["tmp_name"], $target_file)) {
                        if (!empty($Name) && isset($Name) && !empty($Parent) && isset($Parent)) {
                            //Query
                            $sql = "INSERT INTO `category`(`Parent_ID`, `Name`, `Discription`, `Sort_Order`, `Image`, `Status`) VALUES ($Parent,'$Name','$Description',$Sort_Order,'$Image',$Status)";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "New Category Added Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Add New Category"]);
                            }
                        } else if (!empty($Name) && isset($Name) && empty($Parent) && !isset($Parent)) {
                            //Query
                            $sql = "INSERT INTO `category`(`Name`, `Discription`, `Sort_Order`, `Image`, `Status`) VALUES ('$Name','$Description',$Sort_Order,'$Image',$Status)";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "New Category Added Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Add New Category"]);
                            }
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
                    }
                } else {
                    if (move_uploaded_file($_FILES["Cat_Img"]["tmp_name"], $target_file)) {
                        if (!empty($Name) && isset($Name) && !empty($Parent) && isset($Parent)) {
                            //Query
                            $sql = "INSERT INTO `category`(`Parent_ID`, `Name`, `Discription`,  `Sort_Order`,`Image`,`Status`)
                            VALUES 
                            ($Parent,'$Name','$Description','$Sort_Order','$Image','$Status')";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "New Category Added Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Add New Category"]);
                            }
                        } else if (!empty($Name) && isset($Name) && empty($Parent) && !isset($Parent)) {
                            //Query
                            $sql = "INSERT INTO `category`(`Name`, `Discription`, `Sort_Order`, `Image`, `Status`)
                            VALUES 
                            ('$Name','$Description','$Sort_Order',$Image,'$Status')";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "New category added successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed to add new category"]);
                            }
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
                    }
                }
            }
        }
    }
} else {
    if (!empty($Name) && isset($Name) && !empty($Parent) && isset($Parent)) {
        //Query
        $sql = "INSERT INTO `category`(`Parent_ID`, `Name`, `Discription`,  `Sort_Order`, `Status`)
        VALUES 
        ($Parent,'$Name','$Description','$Sort_Order','$Status')";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "New Category Added Successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed To Add New Category"]);
        }
    } else if (!empty($Name) && isset($Name) && empty($Parent) && !isset($Parent)) {
        //Query
        $sql = "INSERT INTO `category`(`Name`, `Discription`, `Sort_Order`, `Status`)
        VALUES 
        ('$Name','$Description','$Sort_Order','$Status')";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "New category added successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed to add new category"]);
        }
    }
}
