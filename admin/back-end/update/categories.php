<?php
require("../../connection.php");
//Variables
$Name = $_POST["Cat_Name"];
if (isset($_POST["Cat_Parent"])) {
    $Parent = $_POST["Cat_Parent"];
}
$Sort_Order = $_POST["Cat_Order"];
$id = $_POST["Cat-ID"];
$Description = $_POST["Cat_Des"];
$Image = basename($_FILES["Cat_Img"]["name"]);


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
            echo json_encode(['status' => 'error', 'msg' => 'Image is an image - " . $check["mime"] . "."']);
            $uploadOk = 1;
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Image is not an image.']);
            $uploadOk = 0;
        }
    }
    // Check file size
    if ($_FILES["Cat_Img"]["size"] > 1000000) {
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
                if (file_exists($target_file)) {
                    $f_name = $_FILES["Cat_Img"]["name"];
                    $ext = explode('.', $f_name);
                    $file_extension = end($ext);
                    $Image = md5(rand()) . '.' . $file_extension;
                    $target_file = $target_dir . $Image;
                    if (move_uploaded_file($_FILES["Cat_Img"]["tmp_name"], $target_file)) {
                        if (!empty($Name) && isset($Name) && !empty($Parent) && isset($Parent)) {
                            //Query
                            $sql = "UPDATE `category` SET `Parent_ID`=$Parent,`Name`='$Name',`Discription`='$Description',`Sort_Order`='$Sort_Order',`Image`='$Image',`Date_modified`=current_timestamp() WHERE id=$id";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Update Record"]);
                            }
                        } else if (!empty($Name) && isset($Name) && empty($Parent) && !isset($Parent)) {
                            //Query
                            $sql = "UPDATE `category` SET `Name`='$Name',`Discription`='$Description',`Sort_Order`='$Sort_Order',`Image`='$Image',`Date_modified`=current_timestamp() WHERE id=$id";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Update Record"]);
                            }
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'msg' => 'Sorry, there was an error uploading your file.']);
                    }
                } else {
                    if (move_uploaded_file($_FILES["Cat_Img"]["tmp_name"], $target_file)) {
                        if (!empty($Name) && isset($Name) && !empty($Parent) && isset($Parent)) {
                            //Query
                            $sql = "UPDATE `category` SET `Parent_ID`=$Parent,`Name`='$Name',`Discription`='$Description',`Sort_Order`='$Sort_Order',`Image`='$Image',`Date_modified`=current_timestamp() WHERE id=$id";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Update Record"]);
                            }
                        } else if (!empty($Name) && isset($Name) && empty($Parent) && !isset($Parent)) {
                            //Query
                            $sql = "UPDATE `category` SET `Name`='$Name',`Discription`='$Description',`Sort_Order`='$Sort_Order',`Image`='$Image',`Date_modified`=current_timestamp() WHERE id=$id";
                            $check = mysqli_query($connection, $sql);
                            if ($check) {
                                echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
                            } else {
                                echo json_encode(["status" => "error", "msg" => "Failed To Update Record"]);
                            }
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'msg' => 'Sorry, there was an error uploading your file.']);
                    }
                }
            }
        }
    }
} else {
    if (!empty($Name) && isset($Name) && !empty($Parent) && isset($Parent)) {
        //Query
        $sql = "UPDATE `category` SET `Parent_ID`=$Parent,`Name`='$Name',`Discription`='$Description',`Sort_Order`='$Sort_Order',`Date_modified`=current_timestamp() WHERE id=$id";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed To Add New Category"]);
        }
    } else if (!empty($Name) && isset($Name) && empty($Parent) && !isset($Parent)) {
        //Query
        $sql = "UPDATE `category` SET `Name`='$Name',`Discription`='$Description',`Sort_Order`='$Sort_Order',`Date_modified`=current_timestamp() WHERE id=$id";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed to add new category"]);
        }
    }
}
