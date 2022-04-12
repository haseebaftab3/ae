<?php
session_start();
require("../../connection.php");

// !!PHP Mailer

use PHPMailer\PHPMailer;

require("../../PHPMailer/PHPMailer.php");
require("../../PHPMailer/SMTP.php");
require("../../PHPMailer/Exception.php");


// !!Mail Template

// Variables
$Uid = $_POST["Uid"];
$Fname = $_POST["FName"];

$html = "Thanks For Place order <br> Your Order is underd proecess ";

if ($_POST["CName"] != "undefined" && $_POST["CName"] != "NULL" && !empty($_POST["CName"])) {
  $CName = $_POST["CName"];
} else {
  $CName = "NULL";
}
$Country = $_POST["Country"];
$Address1 = $_POST["Address1"];
if ($_POST["Address2"] != "undefined" && $_POST["Address2"] != "NULL" && !empty($_POST["Address2"])) {
  $Address2 = $_POST["Address2"];
} else {
  $Address2 = "NULL";
}
$District = $_POST["District"];
$PostalCode = $_POST["bdPostcode"];
$Email = $_POST["Email"];
$Phone = $_POST["Phone"];
if ($_POST["Order_Notes"] != "undefined" && $_POST["Order_Notes"] != "NULL" && !empty($_POST["Order_Notes"])) {
  $Order_Notes = $_POST["Order_Notes"];
} else {
  $Order_Notes = "NULL";
}

if ($_POST["OrderType"] !=  "NAN" && !empty($_POST["OrderType"])) {
  $OrderType =  $_POST["OrderType"];
} else {
  $OrderType =  "Inavlid";
}


// !! Cart Variables
$Err = "";
$total = 0;
$TotalPrice = $total;
$TotalWeight = 0;
$Date_P = date('dS M, Y');

$_SESSION["OrderPlacedStatus"] = 0;

if ((isset($Fname) && !empty($Fname)) && (isset($Country) && !empty($Country))
  && (isset($Address1) && !empty($Address1)) && (isset($District) && !empty($District))
  && (isset($Email) && !empty($Email)) && (isset($Phone) && !empty($Phone))
) {
  if (!empty($_SESSION["shopping_cart"])) {
    // Fetch Shopping Detail From Cart
    $today = date("Ymd");
    $rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
    $unique = $today . $rand;
    // $orderStatus = $_POST["orderStatus"];

    $totalShipPrice = 0;
    $NEtShipping = 0;
    $total = 0;

    foreach ($_SESSION["shopping_cart"] as $keys => $values) {

      $order_product_id = $values["item_id"];
      $order_product_price = (int) $values["item_price"];
      $order_product_quantity = $values["item_quantity"];

      if (!empty($values["item_color"])) {
        $order_product_color = $values["item_color"];
      } else {
        $order_product_color = "NULL";
      }
      if (!empty($values["item_size"])) {
        $order_product_size = htmlentities($values["item_size"], ENT_SUBSTITUTE);
        $order_product_size = mysqli_real_escape_string($connection, $order_product_size);
        // echo $order_product_size;
      } else {
        $order_product_size = "NULL";
      }
      if (!empty($_SESSION["CheckOut_Form"]["checkout_userid"])) {
        $order_userid = $_SESSION["CheckOut_Form"]["checkout_userid"];
      } else {
        $order_userid = "NULL";
      }


      if (!empty($values["item_sale_id"])) {
        $order_saleid = $values["item_sale_id"];
      } else {
        $order_saleid = "NULL";
      }
      // Order ID



      $order_product_weight = $values["item_weight"];
      $order_product_updated_price = $values["item_updated_price"];
      $order_product_shipping_method = "0";


      $NetPrice =  $values["item_updated_price"];


      // !!Total Wight
      $TotalWeight += (int) $values["item_weight"] * (int)$values["item_quantity"];

      if (empty($NEtShipping)) {
        $NEtShipping = 0;
      } else {
        $NEtShipping =  $values["item_Shipcost"];
      }
      // echo $NEtShipping;
      $total = $total + ($values["item_quantity"] * $NetPrice);
      $totalShipPrice =  $totalShipPrice + ((int)$values["item_quantity"] * (int)$NEtShipping);
      $TotalPrice = $total + $totalShipPrice;

      $NewUpdatedPrice = $values["item_quantity"] * $NetPrice;
      // Int For
      $orderStatus = $OrderType;


      $BankStatus  = "NULL";
      if ($orderStatus == "Online") {
        $BankStatus  = "Pending";
      }

      $order_product_coupoun_id = "Not Available";
      // echo $order_product_size;
      $Send = "INSERT INTO `product_order`(`Order_ID`,`Product_ID`, `User_ID`, `Sales_ID`,
        `Color`, `Size`, `Type`, `Quantity`, `Sub_Total`,`Product_price`, `Name`,`Company_Name`,`Email`,`Address`,`Address1`,`City`,`Number`,
         `Postal_Code`, `Shipping_Method`,`Shipping_Price`,`Coupen_Code`, `Status`,`Bank_Payment_Staus`)
        VALUES ('$unique',$order_product_id,$Uid,$order_saleid,'$order_product_color','$order_product_size',
        '$orderStatus',$order_product_quantity,$TotalPrice,$order_product_updated_price,'$Fname','$CName','$Email','$Address1','$Address2','$District','$Phone','$PostalCode',
        '$order_product_shipping_method',$NEtShipping,'$order_product_coupoun_id','Pending','$BankStatus')";

      $check = mysqli_query($connection, $Send);
      if ($check) {
        $Err = "False";
      } else {
        $Err = "True";
      }
    }
  }
} else {
  echo json_encode(["status" => "error", "msg" => "All Feilds Must be Required."]);
}









if ($Err == "False") {

  $mail = new PHPMailer\PHPMailer();
  $mail->isSMTP();
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

  $mail->Host = 'mail.privateemail.com';
  $mail->Port = 587;
  $mail->SMTPAuth = true;
  $mail->Username = 'noreply@abidelectric.com';
  $mail->Password = '60319930';
  $mail->setFrom('noreply@abidelectric.com', 'Abid Electric');
  $to_mail = $Email;
  $to_name = $Fname;
  $mail->addAddress($to_mail, $to_name);
  if ($mail->addReplyTo($to_mail, $to_name)) {
    $mail->Subject = 'Thank You for Shopping with Us';
    // $mail->addEmbeddedImage('../../assets/images/logo/logo.png', 'logo');
    // $mail->addEmbeddedImage('../../assets/images/mail/ico_envelope_light.png', 'mail_icon');
    // $mail->addEmbeddedImage('../../assets/images/mail/ico_facebook_light.png', 'fb_icon');
    // $mail->addEmbeddedImage('../../assets/images/mail/parallax-3.jpg', 'big_img');
    $mail->Body = $html;


    $mail->isHTML(true);

    if (!$mail->send()) {
      // print_r($mail);
    } else {
      // print_r($mail);
    }
  }
  echo json_encode(["status" => "success", "msg" => "Order Placed"]);

  // Empty Cart
  unset($_SESSION["shopping_cart"]);
  $_SESSION["Order_Msg"] = "Done";
} else {
  echo json_encode(["status" => "error", "msg" => "Failed To Place Order"]);
  if (!isset($_SESSION["Order_Msg"])) {
    $_SESSION["Order_Msg"] = "NAN";
  }
}
