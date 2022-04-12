<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!empty($_POST["Qun"])) {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values["item_index"] == $_POST["CrrIndex"]) {
            $_SESSION["shopping_cart"][$keys]["item_quantity"] = $_POST["Qun"];
            echo json_encode(["status" => "success"]);
        }
    }
} else {
    echo json_encode(["method" => "error", "msg" => "Invalid Input"]);
}
