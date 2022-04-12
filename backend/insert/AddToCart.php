<?php
session_start();
$_SESSION["SuccesCartId"] = null;
$_SESSION["SuccesCartUpPrice"] = null;
$_SESSION["SuccesCartId"] = $_POST["CartProductID"];
$_SESSION["SuccesCartUpPrice"] = $_POST["CartProductPrice"];
// Cart Status
$_SESSION["AddtoCartStatus"] = 0;
if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    $item_array_color = array_column($_SESSION["shopping_cart"], "item_color");
    $item_array_size = array_column($_SESSION["shopping_cart"], "item_size");
    if (!in_array($_POST["CartProductID"], $item_array_id)) {

        $count = count($_SESSION["shopping_cart"]);
        $item_array = array(
            'item_index'               =>     $_SESSION["index"][0] = $_SESSION["index"][0] + 1,
            'item_id'               =>     $_POST["CartProductID"],
            'item_name'               =>     $_POST["CartProductName"],
            'item_price'          =>     $_POST["CartProductPrice"],
            'item_quantity'          =>     $_POST["CartProductQuantity"],
            'item_img'          =>     $_POST["CartProductImg"],
            'item_color'          =>     $_POST["CartProductColor"],
            'item_size'          =>     $_POST["CartProductSize"],
            'item_weight'          =>     $_POST["CartProductWeight"],
            'item_updated_price'          =>     $_POST["CartProductUpdatedPrice"],
            'item_sale_id'          =>     $_POST["CartProductSaleID"],
            'item_Shipcost' => $_POST["CartShiipProductPrice"],

        );
        array_push($_SESSION["shopping_cart"], $item_array);
        $_SESSION["SuccesCartUpPrice"] = 1;
        echo json_encode(["status" => "success", "data" => $_SESSION["shopping_cart"]]);
    } else {
        if (!in_array($_POST["CartProductColor"], $item_array_color) && !in_array($_POST["CartProductSize"], $item_array_size)) {
            $item_array = array(
                'item_index'               =>     $_SESSION["index"][0] = $_SESSION["index"][0] + 1,
                'item_id'               =>     $_POST["CartProductID"],
                'item_name'               =>     $_POST["CartProductName"],
                'item_price'          =>     $_POST["CartProductPrice"],
                'item_quantity'          =>     $_POST["CartProductQuantity"],
                'item_img'          =>     $_POST["CartProductImg"],
                'item_color'          =>     $_POST["CartProductColor"],
                'item_size'          =>     $_POST["CartProductSize"],
                'item_weight'          =>     $_POST["CartProductWeight"],
                'item_updated_price'          =>     $_POST["CartProductUpdatedPrice"],
                'item_sale_id'          =>     $_POST["CartProductSaleID"],
                'item_Shipcost' => $_POST["CartShiipProductPrice"],

            );
            array_push($_SESSION["shopping_cart"], $item_array);
            $_SESSION["SuccesCartUpPrice"] = 1;
            echo json_encode(["status" => "success", "data" => $_SESSION["shopping_cart"]]);
        } else if (!in_array($_POST["CartProductColor"], $item_array_color) && in_array($_POST["CartProductSize"], $item_array_size)) {
            $item_array = array(
                'item_index'               =>     $_SESSION["index"][0] = $_SESSION["index"][0] + 1,
                'item_id'               =>     $_POST["CartProductID"],
                'item_name'               =>     $_POST["CartProductName"],
                'item_price'          =>     $_POST["CartProductPrice"],
                'item_quantity'          =>     $_POST["CartProductQuantity"],
                'item_img'          =>     $_POST["CartProductImg"],
                'item_color'          =>     $_POST["CartProductColor"],
                'item_size'          =>     $_POST["CartProductSize"],
                'item_weight'          =>     $_POST["CartProductWeight"],
                'item_updated_price'          =>     $_POST["CartProductUpdatedPrice"],
                'item_sale_id'          =>     $_POST["CartProductSaleID"],
                'item_Shipcost' => $_POST["CartShiipProductPrice"],

            );
            array_push($_SESSION["shopping_cart"], $item_array);
            $_SESSION["SuccesCartUpPrice"] = 1;
            echo json_encode(["status" => "success", "data" => $_SESSION["shopping_cart"]]);
        } else if (!in_array($_POST["CartProductSize"], $item_array_size) && in_array($_POST["CartProductColor"], $item_array_color)) {
            $item_array = array(
                'item_index'               =>     $_SESSION["index"][0] = $_SESSION["index"][0] + 1,
                'item_id'               =>     $_POST["CartProductID"],
                'item_name'               =>     $_POST["CartProductName"],
                'item_price'          =>     $_POST["CartProductPrice"],
                'item_quantity'          =>     $_POST["CartProductQuantity"],
                'item_img'          =>     $_POST["CartProductImg"],
                'item_color'          =>     $_POST["CartProductColor"],
                'item_size'          =>     $_POST["CartProductSize"],
                'item_weight'          =>     $_POST["CartProductWeight"],
                'item_updated_price'          =>     $_POST["CartProductUpdatedPrice"],
                'item_sale_id'          =>     $_POST["CartProductSaleID"],
                'item_Shipcost' => $_POST["CartShiipProductPrice"],


            );
            array_push($_SESSION["shopping_cart"], $item_array);
            $_SESSION["SuccesCartUpPrice"] = 1;
            echo json_encode(["status" => "success"]);
        } else {
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                if ($values["item_id"] == $_POST["CartProductID"]) {
                    $index = $keys;
                }
            }
            $_SESSION["shopping_cart"][$index]['item_quantity'] += 1;
            $_SESSION["SuccesCartUpPrice"] = 1;
            echo json_encode(["status" => "success", "data" => $_SESSION["shopping_cart"]]);
        } //end else
    }
} else {
    $_SESSION["index"][0] = 0;
    $item_array = array(
        'item_index'               =>     $_SESSION["index"][0],
        'item_id'               =>     $_POST["CartProductID"],
        'item_name'               =>     $_POST["CartProductName"],
        'item_price'          =>     $_POST["CartProductPrice"],
        'item_quantity'          =>     $_POST["CartProductQuantity"],
        'item_img'          =>     $_POST["CartProductImg"],
        'item_color'          =>     $_POST["CartProductColor"],
        'item_size'          =>     $_POST["CartProductSize"],
        'item_weight'          =>     $_POST["CartProductWeight"],
        'item_updated_price'          =>     $_POST["CartProductUpdatedPrice"],
        'item_sale_id'          =>     $_POST["CartProductSaleID"],
        'item_Shipcost' => $_POST["CartShiipProductPrice"],

    );
    $_SESSION["shopping_cart"][0] = $item_array;
    echo json_encode(["status" => "success", "data" => $_SESSION["shopping_cart"]]);
    $_SESSION["SuccesCartUpPrice"] = 1;
}
