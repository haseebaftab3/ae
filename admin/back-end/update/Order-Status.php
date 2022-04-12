<?php

use PHPMailer\PHPMailer;

require("../../../PHPMailer/PHPMailer.php");
require("../../../PHPMailer/SMTP.php");
require("../../../PHPMailer/Exception.php");
require("../../connection.php");


$Date_P = date('dS M, Y');

$id = $_POST["id"];
$OrderID = $_POST["COrderNo"];
$val = $_POST["CStatuts"];

$CNumber = "NULL";
$SVendor = "NULL";

$SVendor = $_POST["Ship_Vendor"];
$CNumber = $_POST["Consignment"];

if (!empty($val) && isset($val)) {
  if ($val == "Confirmed") {

    // Change Status
    $sql = "UPDATE `product_order` SET `Status`='$val'  WHERE `Order_ID`='$OrderID'";
    $check = mysqli_query($connection, $sql);
    // die(mysqli_error($connection));
    if (!$check) {
      echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
      echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }

    // !!Mail

    $sqlMail = "SELECT GROUP_CONCAT(`products`.`Name`,' (',`products`.`Model`,')/',`products`.`Price`,'/',`product_order`.`Quantity`) as `Product Detail`,`product_order`.*, SUM(`product_order`.`Sub_Total`) AS Total, SUM(`product_order`.`Shipping_Price`) AS `ShipTotal` FROM `product_order`,`products` where `products`.`ID`=`product_order`.`Product_ID`  AND `product_order`.`Order_ID`= '$OrderID' GROUP BY `Order_ID` ";
    $checkMail = mysqli_query($connection, $sqlMail);
    if ($checkMail) {
      if (mysqli_num_rows($checkMail) > 0) {
        $rowMail  = mysqli_fetch_array($checkMail);
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
           <td colspan="2">
           <h1 style="text-align:justify;">
           Your order # ' . $OrderID . ' has been confirmed. You will recieve an email once the order is shipped.</h1>';

        $html .= ' </td>
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
               ><b style="color: blue; font-weight: normal; margin: 0;">Confirmed</b>
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
               ' . $OrderID . '
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
               Rs. ' .  ($rowMail["Total"] - $rowMail["ShipTotal"]) . ' + Rs. ' .   $rowMail["ShipTotal"] . ' (Shipping)  = Rs. ' . $rowMail["Total"]    . '
                 
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
               ' . $rowMail["Name"] . '
             </p>
             <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
               <span style="display: block; font-weight: bold; font-size: 13px;"
                 >Email</span
               >
              ' . $rowMail["Email"] . '
             </p>
             <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
               <span style="display: block; font-weight: bold; font-size: 13px;"
                 >Phone</span
               >
               ' . $rowMail["Number"] . '
             </p>
           </td>
           <td style="width: 50%; padding: 20px; vertical-align: top;">
             <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
               <span style="display: block; font-weight: bold; font-size: 13px;"
                 >Address</span
               >
               ' . $rowMail["Address"] . " , " . $rowMail["City"] . '( ' . $rowMail["Postal_Code"] . ' )
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

        $PDetail = $rowMail["Product Detail"];
        $NPdetail = explode(",", $PDetail);
        foreach ($NPdetail as $keys => $values) {
          // echo $values;
          $NPDetails = explode("/", $values);
          // print_r($NPdetail);
          // print_r($NPvalues);
          // echo $NPvalues;
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
                 >' .  $NPDetails[0] . '</span>
                 <span style="
                 display: block;
                 font-size: 13px;
                 font-weight: normal;
                 font-family: Poppins, Arial, sans-serif !important;
               ">
               ' .  $NPDetails[2] . ' x Rs. ' . number_format((int) $NPDetails[1], 2) . ' = Rs. ' . number_format((int)$NPDetails[1] * (int)$NPDetails[2], 2) . '
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
        $to_mail = $rowMail["Email"];
        $to_name = $rowMail["Name"];
        $mail->addAddress($to_mail, $to_name);
        if ($mail->addReplyTo($to_mail, $to_name)) {
          $mail->Subject = 'Order #' . $OrderID . ' Confirmed.';
          // $mail->isHTML(false);
          $mail->addEmbeddedImage('../../../assets/images/logo.png', 'logo');
          $mail->Body = $html;


          $mail->isHTML(true);

          if (!$mail->send()) {
          } else {
          }
        }
      }
    }
  } else if ($val == "Shipped") {

    $link = "";
    if ($SVendor === "TCS") {
      $link = "https://www.tcsexpress.com/tracking";
    } else if ($SVendor === "Leopards") {
      $link = "http://leopardscourier.com/pk/";
    }

    // Change Status
    $sql = "UPDATE `product_order` SET `Status`='$val', `Shipping_Vendor`='$SVendor',`Consignment_No`='$CNumber'  WHERE `Order_ID`='$OrderID'";
    $check = mysqli_query($connection, $sql);

    // die(mysqli_error($connection));
    if (!$check) {
      echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
      echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }

    // !!Mail

    $sqlMail = "SELECT GROUP_CONCAT(`products`.`Name`,' (',`products`.`Model`,')/',`products`.`Price`,'/',`product_order`.`Quantity`) as `Product Detail`,`product_order`.*, SUM(`product_order`.`Sub_Total`) AS Total, SUM(`product_order`.`Shipping_Price`) AS `ShipTotal` FROM `product_order`,`products` where `products`.`ID`=`product_order`.`Product_ID`  AND `product_order`.`Order_ID`= '$OrderID' GROUP BY `Order_ID` ";
    $checkMail = mysqli_query($connection, $sqlMail);
    if ($checkMail) {
      if (mysqli_num_rows($checkMail) > 0) {
        $rowMail  = mysqli_fetch_array($checkMail);
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
              <td colspan="2">
              <h1>Your order # ' . $OrderID . ' is on its way</h1>';
        if ($link != "") {
          $html .= '<h4>' . $SVendor . ' Consignment # ' . $CNumber . '  <a href="' . $link . '">Track Your Shipment</a></h4>';
        } else {
          $html .= '<h4>Consignment # ' . $CNumber . '</h4>';
        }

        $html .= ' </td>
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
                  ><b style="color: green; font-weight: normal; margin: 0;">Shipped</b>
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
                  ' . $OrderID . '
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
                  Rs. ' .  ($rowMail["Total"] - $rowMail["ShipTotal"]) . ' + Rs. ' .   $rowMail["ShipTotal"] . ' (Shipping)  = Rs. ' . $rowMail["Total"]    . '
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
                  ' . $rowMail["Name"] . '
                </p>
                <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                  <span style="display: block; font-weight: bold; font-size: 13px;"
                    >Email</span
                  >
                 ' . $rowMail["Email"] . '
                </p>
                <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                  <span style="display: block; font-weight: bold; font-size: 13px;"
                    >Phone</span
                  >
                  ' . $rowMail["Number"] . '
                </p>
              </td>
              <td style="width: 50%; padding: 20px; vertical-align: top;">
                <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;">
                  <span style="display: block; font-weight: bold; font-size: 13px;"
                    >Address</span
                  >
                  ' . $rowMail["Address"] . " , " . $rowMail["City"] . '( ' . $rowMail["Postal_Code"] . ' )
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

        $PDetail = $rowMail["Product Detail"];
        $NPdetail = explode(",", $PDetail);
        foreach ($NPdetail as $keys => $values) {
          // echo $values;
          $NPDetails = explode("/", $values);
          // print_r($NPdetail);
          // print_r($NPvalues);
          // echo $NPvalues;
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
                       >' .  $NPDetails[0] . '</span>
                       <span style="
                       display: block;
                       font-size: 13px;
                       font-weight: normal;
                       font-family: Poppins, Arial, sans-serif !important;
                     ">
                     ' .  $NPDetails[2] . ' x Rs. ' . number_format((int) $NPDetails[1], 2) . ' = Rs. ' . number_format((int)$NPDetails[1] * (int)$NPDetails[2], 2) . '
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
        $to_mail = $rowMail["Email"];
        $to_name = $rowMail["Name"];
        $mail->addAddress($to_mail, $to_name);
        if ($mail->addReplyTo($to_mail, $to_name)) {
          $mail->Subject = 'Order #' . $OrderID . ' has been Shipped';
          // $mail->isHTML(false);
          $mail->addEmbeddedImage('../../../assets/images/logo.png', 'logo');
          $mail->Body = $html;


          $mail->isHTML(true);

          if (!$mail->send()) {
          } else {
          }
        }
      }
    }
  } else if ($val == "Delivered") {

    // Change Status
    $sql = "UPDATE `product_order` SET `Status`='$val'  WHERE `Order_ID`='$OrderID'";
    $check = mysqli_query($connection, $sql);
    // die(mysqli_error($connection));
    if (!$check) {
      echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
      echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
  } else if ($val == "Canceled") {

    // Change Status
    $sql = "UPDATE `product_order` SET `Status`='$val'  WHERE `Order_ID`='$OrderID'";
    $check = mysqli_query($connection, $sql);
    // die(mysqli_error($connection));
    if (!$check) {
      echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
      echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
  } else if ($val == "Returned") {

    // Change Status
    $sql = "UPDATE `product_order` SET `Status`='$val'  WHERE `Order_ID`='$OrderID'";
    $check = mysqli_query($connection, $sql);
    // die(mysqli_error($connection));
    if (!$check) {
      echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
      echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
  } else if ($val == "Pending") {

    // Change Status
    $sql = "UPDATE `product_order` SET `Status`='$val'  WHERE `Order_ID`='$OrderID'";
    $check = mysqli_query($connection, $sql);
    // die(mysqli_error($connection));
    if (!$check) {
      echo json_encode(["status" => "error", "msg" => "Please Try Again"]);
    } else {
      echo json_encode(["status" => "success", "msg" => "Record Updated Successfully"]);
    }
  }
} else {
  echo json_encode(["status" => "error", "msg" => "Undefined Value"]);
}
