<?php
//connection
require("../../connection.php");

//variables
$Title = $_POST['Slider_Title'];
$Detail = $_POST['Slider_Detail'];
$Link = $_POST['Slider_Link'];
$Alt = $_POST['Slider_Alt'];
$Image = basename($_FILES["image"]["name"]);

if (!empty($Image)) {
    //File Uploading
    $target_dir = "../../uploads/slider/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // $uploadOk = 1;
        // Check file size
        if ($_FILES["image"]["size"] > 8000000) {
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
                        $f_name = $_FILES["image"]["name"];
                        $ext = explode('.', $f_name);
                        $file_extension = end($ext);
                        $Image = md5(rand()) . '.' . $file_extension;
                        $target_file = $target_dir . $Image;
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            //query
                            $query = "INSERT INTO `slider`(`Title`, `Detail`, `Link`, `Image`, `Alt`) VALUES ('$Title','$Detail','$Link','$Image','$Alt')";
                            //query checker
                            $check = mysqli_query($connection, $query);
                            if ($check) {
                                echo json_encode(['status' => 'success', 'message' => 'New Record Added Sucessfully']);
                            } else {
                                echo json_encode(['status' => 'error', 'message' => 'Sorry Something went wrong. Please Try Again.']);
                                if (file_exists($target_dir . $Image)) {
                                    unlink($target_dir . $Image);
                                }
                            }
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
                        }
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            //query
                            $query = "INSERT INTO `slider`(`Title`, `Detail`, `Link`, `Image`,`Alt` ) VALUES ('$Title','$Detail','$Link','$Image','$Alt')";

                            //query checker
                            $check = mysqli_query($connection, $query);
                            if ($check) {
                                echo json_encode(['status' => 'success', 'message' => 'New Record Added Sucessfully']);
                            } else {
                                echo json_encode(['status' => 'error', 'message' => 'Sorry Something went wrong. Please Try Again.']);
                                if (file_exists($target_dir . $Image)) {
                                    unlink($target_dir . $Image);
                                }
                            }
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
                        }
                    }
                }
            }
        }
    }
}
