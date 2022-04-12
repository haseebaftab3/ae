<?php
require("../../connection.php");
//Variables
$Name = $_POST["Name"];
$ID = $_POST["Id"];
$Image = basename($_FILES["Img"]["name"]);


// Files
if (!empty($Name)) {
    if (isset($_FILES["Img"]["name"]) && !empty($_FILES["Img"]["name"])) {
        //File Uploading
        $target_dir = "../../uploads/Manufacturer/";
        $target_file = $target_dir . basename($_FILES["Img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["Img"]["tmp_name"]);
            if ($check !== false) {
                echo json_encode(['status' => 'error', 'message' => 'Image is an image - " . $check["mime"] . "."']);
                $uploadOk = 1;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Image is not an image.']);
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["Img"]["size"] > 500000) {
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
                    $f_name = $_FILES["Img"]["name"];
                    $ext = explode('.', $f_name);
                    $file_extension = end($ext);
                    $Image = md5(rand()) . '.' . $file_extension;
                    $target_file = $target_dir . $Image;
                    if (move_uploaded_file($_FILES["Img"]["tmp_name"], $target_file)) {
                        //Query
                        $sql = "UPDATE `manufacturer` SET `Name`='$Name',`Img`='$Image' WHERE `ID` = $ID";
                        $check = mysqli_query($connection, $sql);
                        if ($check) {
                            echo json_encode(["status" => "success", "msg" => "You have modified manufacturers!"]);
                        } else {
                            echo json_encode(["status" => "error", "msg" => "Failed to add new manufacturers"]);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your image.']);
                    }
                }
            }
        }
    } else {

        //Query
        $sql = "UPDATE `manufacturer` SET `Name`='$Name' WHERE `ID` = $ID";
        $check = mysqli_query($connection, $sql);
        if ($check) {
            echo json_encode(["status" => "success", "msg" => "You have modified manufacturers!"]);
        } else {
            echo json_encode(["status" => "error", "msg" => "Failed to add new manufacturers"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "msg" => "Manufacturer Name must be between 1 and 64 characters!"]);
}
