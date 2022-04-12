<?php
require("../../connection.php");
session_start();

use PHPMailer\PHPMailer;

require("../../PHPMailer/PHPMailer.php");
require("../../PHPMailer/SMTP.php");
require("../../PHPMailer/Exception.php");

$Err = "";
$total = 0;
$TotalPrice = $total;
$TotalWeight = 0;
$Date_P = date('dS M, Y');
$MailShipPrice = $_SESSION["CheckOut_Form"]["checkout_shippingrate"] + $TotalPrice;
$Err = "";
$total = 0;
$TotalPrice = $total;
$TotalWeight = 0;
$Date_P = date('dS M, Y');
$MailShipPrice = $_SESSION["CheckOut_Form"]["checkout_shippingrate"] + $TotalPrice;


$_SESSION["OrderPlacedStatus"] = 0;
// If Shopping Cart Not Empty

if (!empty($_SESSION["shopping_cart"])) {
  // Fetch Shopping Detail From Cart
  $today = date("Ymd");
  $rand = strtoupper(substr(uniqid(sha1(time())), 0, 4));
  $unique = $today . $rand;
  $orderStatus = $_POST["orderStatus"];

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
      $order_product_size = $values["item_size"];
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

    // Order ID


    $order_product_weight = $values["item_weight"];
    $order_product_updated_price = $values["item_updated_price"];
    $order_product_shipping_method = "0";
    $order_product_coupoun_id = $_SESSION["CheckOut_Form"]["checkout_coupounid"];

    $order_user_name = $_SESSION["CheckOut_Form"]["checkout_name"];
    $to_name = $_SESSION["CheckOut_Form"]["checkout_name"];
    $order_user_email = $_SESSION["CheckOut_Form"]["checkout_email"];
    $to_mail = $_SESSION["CheckOut_Form"]["checkout_email"];

    $order_user_address = $_SESSION["CheckOut_Form"]["checkout_address"];
    $order_user_city = $_SESSION["CheckOut_Form"]["checkout_city"];
    $order_user_zip = $_SESSION["CheckOut_Form"]["checkout_zip"];
    $order_user_number = $_SESSION["CheckOut_Form"]["checkout_number"];

    $NetPrice =  $values["item_updated_price"];
    $SendSHipPrice = $_SESSION["CheckOut_Form"]["checkout_shippingrate"];
    // !!Total Wight
    $TotalWeight += (int) $values["item_weight"] * (int)$values["item_quantity"];

    $NEtShipping =  $values["item_Shipcost"];

    $total = $total + ($values["item_quantity"] * $NetPrice);
    $totalShipPrice =  $totalShipPrice + ((int)$values["item_quantity"] * (int)$NEtShipping);
    $TotalPrice = $total + $totalShipPrice;

    $NewUpdatedPrice = $values["item_quantity"] * $NetPrice;
    $BankStatus  = "NULL";
    if ($orderStatus == "Bank-Payment") {
      $BankStatus  = "Pending";
    }
    $Send = "INSERT INTO `product_order`(`Order_ID`,`Product_ID`, `User_ID`, `Sales_ID`,
        `Color_ID`, `Size_ID`, `Type`, `Quantity`, `Sub_Total`,`Product_price`, `Name`, `Email`,`Address`, `City`,
         `Number`, `Postal_Code`, `Shipping_Method`,`Shipping_Price`,`Coupen_Code`, `Status`,`Bank_Payment_Staus`)
        VALUES ('$unique',$order_product_id,$order_userid,$order_saleid,$order_product_color,$order_product_size,
        '$orderStatus',$order_product_quantity,$TotalPrice,$order_product_updated_price,'$order_user_name',
        '$order_user_email','$order_user_address','$order_user_city','$order_user_number','$order_user_zip',
        '$order_product_shipping_method',$NEtShipping,'$order_product_coupoun_id','Pending','$BankStatus')";

    $check = mysqli_query($connection, $Send);
    if ($check) {
      $Err = "Success";


      $html = '
      <html>
        <body
          style="
            background-color: #e2e1e0;
            font-family: Poppins, Arial, sans-serif;
            font-size: 100%;
            font-weight: 400;
            line-height: 1.4;
            color: #000;
          "
        >
          <table
            style="
              max-width: 670px;
              margin: 50px auto 10px;
              background-color: #fff;
              padding: 50px;
              -webkit-border-radius: 3px;
              -moz-border-radius: 3px;
              border-radius: 3px;
              -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12),
                0 1px 2px rgba(0, 0, 0, 0.24);
              -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12),
                0 1px 2px rgba(0, 0, 0, 0.24);
              box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
              border-top: solid 10px #9e091c;
              font-family: Poppins, Arial, sans-serif !important;
            "
          >
            <thead>
              <tr>
                <th style="text-align: left;">
                  <img style="max-width: 150px;" src="cid:logo" alt="Logo" />
                </th>
                <th style="text-align: right; font-weight: 400;">' . $Date_P . '</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="height: 35px;"></td>
              </tr>
              <tr>
                <td colspan="2" style="border: solid 1px #ddd; padding: 10px 20px;">
                  <p style="font-size: 14px; margin: 0 0 6px 0;">
                    <span
                      style="
                        font-weight: bold;
                        display: inline-block;
                        min-width: 150px;
                        font-family: Poppins, Arial, sans-serif;
                      "
                      >Order Status</span
                    ><b style="color: red; font-weight: normal; margin: 0;">Placed</b>
                  </p>
                  <p style="font-size: 14px; margin: 0 0 6px 0;">
                    <span
                      style="
                        font-weight: bold;
                        display: inline-block;
                        min-width: 146px;
                        font-family: Poppins, Arial, sans-serif;
                      "
                      >Order ID</span
                    >
                    ' . $unique . '
                  </p>
                  <p style="font-size: 14px; margin: 0 0 0 0;">
                    <span
                      style="
                        font-weight: bold;
                        display: inline-block;
                        min-width: 146px;
                        font-family: Poppins, Arial, sans-serif;
                      "
                      >Order Amount</span
                    >
                      Rs. ' .  $total . ' + Rs. ' .   $totalShipPrice . ' (Shipping)  = Rs. ' . $TotalPrice    . ' 
                  </p>
                </td>
              </tr>
              <tr>
                <td style="height: 35px;"></td>
              </tr>
              <tr>
                <td style="width: 50%; padding: 20px; vertical-align: top;">
                  <p
                    style="
                      margin: 0 0 10px 0;
                      padding: 0;
                      font-size: 14px;
                      font-family: Poppins, Arial, sans-serif !important;
                    "
                  >
                    <span
                      style="
                        display: block;
                        font-weight: bold;
                        font-size: 13px;
                        font-family: Poppins, Arial, sans-serif !important;
                      "
                      >Name</span
                    >
                    ' . $_SESSION["CheckOut_Form"]["checkout_name"] . '
                  </p>
                  <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                    <span style="display: block; font-weight: bold; font-size: 13px;"
                      >Email</span
                    >
                   ' . $_SESSION["CheckOut_Form"]["checkout_email"] . '
                  </p>
                  <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                    <span style="display: block; font-weight: bold; font-size: 13px;"
                      >Phone</span
                    >
                    ' . $_SESSION["CheckOut_Form"]["checkout_number"] . '
                  </p>
                </td>
                <td style="width: 50%; padding: 20px; vertical-align: top;">
                  <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                    <span style="display: block; font-weight: bold; font-size: 13px;"
                      >Address</span
                    >
                    ' . $_SESSION["CheckOut_Form"]["checkout_address"] . " , " . $_SESSION["CheckOut_Form"]["checkout_zip"] . '
                  </p>
                  <!-- <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                    <span style="display: block; font-weight: bold; font-size: 13px;"
                      >Number of gusets</span
                    >
                    2
                  </p> -->
                  <!-- <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                    <span style="display: block; font-weight: bold; font-size: 13px;"
                      >Duration of your vacation</span
                    >
                    25/04/2017 to 28/04/2017 (3 Days)
                  </p> -->
                </td>
              </tr>
              <tr>
                <td colspan="2" style="font-size: 20px; padding: 30px 15px 0 15px;">
                  Items
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding: 15px;">
                ';

      foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        $NetPrice =  $values["item_updated_price"];
        $ShopProductID =  $values["item_id"];
        $FetchP = "SELECT `products`.`Model`,`manufacturer`.`Name` FROM `products`,`manufacturer` WHERE `products`.`ID` =$ShopProductID AND `manufacturer`.ID = `products`.`Manufacture_ID` ";
        $checkP = mysqli_query($connection, $FetchP);
        $rowP = mysqli_fetch_array($checkP);
        $html .= '<p
                    style="
                      font-size: 14px;
                      margin: 0;
                      padding: 10px;
                      border: solid 1px #ddd;
                      font-weight: bold;
                    "
                  >
                    <span
                      style="
                        display: block;
                        font-size: 13px;
                        font-weight: normal;
                        font-family: Poppins, Arial, sans-serif !important;
                      "
                      >' . $values["item_name"] . '( ' . $rowP["Model"] . ' )</span>
                      <span style="
                      display: block;
                      font-size: 13px;
                      font-weight: normal;
                      font-family: Poppins, Arial, sans-serif !important;
                    ">Brand: ' . $rowP["Name"] . '</span>
                    ' . $values["item_quantity"] . ' x Rs. ' . $values["item_updated_price"] . ' = Rs. ' . number_format($values["item_quantity"] *  $NetPrice, 2) . '
                  </p>
                  ';
      }
      $html .= '</td>
              </tr>
            </tbody>
            <tfooter>
              <tr>
                <td colspan="2" style="font-size: 14px; padding: 50px 15px 0 15px;">
                  <strong
                    style="
                      display: block;
                      margin: 0 0 10px 0;
                      font-family: Poppins, Arial, sans-serif !important;
                    "
                    >Regards</strong
                  >
                  SHAMA ELECTRONICS<br />
                  Katchehry Bazar Rd, Katchehry Bazar, Block 4, Sargodha 40100 (0.76
                  km), Sargodha, Pakistan.<br /><br />
                  <b>Phone:</b> <a href="tel:+923227127439">(+92)-322-7127439</a>
                  <br />
                  <b>Email:</b>
                  <a href="mailto:sales@shamaelectronics.pk"
                    >sales@shamaelectronics.pk</a
                  >
                </td>
              </tr>
            </tfooter>
          </table>
        </body>
      </html>
      
      
      ';


      $mail = new PHPMailer\PHPMailer();
      $mail->isSMTP();
      $mail->Host = 'mail.shamaelectronics.pk';
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->Username = 'sales@shamaelectronics.pk';
      $mail->Password = 'Abuaab30192';
      $mail->setFrom('sales@shamaelectronics.pk', 'Shama Electronics');
      // $to_mail = "haseebaftab3@gmail.com";
      // $to_name = "ok";
      $mail->addAddress($to_mail, $to_name);
      if ($mail->addReplyTo($to_mail, $to_name)) {
        $mail->Subject = 'Thank You for Shopping with Us';
        // $mail->isHTML(false);
        $mail->addEmbeddedImage('../../assets/images/logo.png', 'logo');
        $mail->Body = $html;


        $mail->isHTML(true);

        if (!$mail->send()) {
        } else {
        }
      }

      unset($_SESSION["shopping_cart"]);
      unset($_SESSION["CheckOut_Form"]);
    } else {
      $Err = "Error";
    }
  }
  if ($Err == "Success") {
    echo  json_encode(["status" => "success", "msg" => "Order Placed!"]);
    $_SESSION["OrderPlacedStatus"] = 1;
  } else {
    echo   json_encode(["status" => "error", "msg" => "Failed to place order!"]);
  }
  // echo $Err;
} else {
  echo json_encode(["status" => "error", "msg" => "Empty Cart!"]);
}
