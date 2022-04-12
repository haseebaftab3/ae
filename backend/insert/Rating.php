<?php
session_start();
require("../../connection.php");

// !!PHP Mailer

use PHPMailer\PHPMailer;

require("../../PHPMailer/PHPMailer.php");
require("../../PHPMailer/SMTP.php");
require("../../PHPMailer/Exception.php");


// !!Mail Template

$html = '';


$html .= '<html
xmlns="http://www.w3.org/1999/xhtml"
xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1"
  />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="format-detection" content="date=no" />
  <meta name="format-detection" content="address=no" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="x-apple-disable-message-reformatting" />
  <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet"
  />
  <title>Email Template</title>

  <style type="text/css" media="screen">
    /* Linked Styles */
    body {
      padding: 0 !important;
      margin: 0 !important;
      display: block !important;
      min-width: 100% !important;
      width: 100% !important;
      background: #ffffff;
      -webkit-text-size-adjust: none;
    }
    a {
      color: #66b7f0;
      text-decoration: none;
    }
    p {
      padding: 0 !important;
      margin: 0 !important;
    }
    img {
      -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */
    }
    .mcnPreviewText {
      display: none !important;
    }

    /* Mobile styles */
    @media only screen and (max-device-width: 480px),
      only screen and (max-width: 480px) {
      .mobile-shell {
        width: 100% !important;
        min-width: 100% !important;
      }

      .m-center {
        text-align: center !important;
      }

      .center {
        margin: 0 auto !important;
      }

      .td {
        width: 100% !important;
        min-width: 100% !important;
      }

      .m-br-3 {
        height: 3px !important;
      }
      .m-br-4 {
        height: 4px !important;
        background: #f4f4f4 !important;
      }
      .m-br-15 {
        height: 15px !important;
      }
      .m-br-25 {
        height: 25px !important;
      }

      .m-td,
      .m-hide {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        font-size: 0 !important;
        line-height: 0 !important;
        min-height: 0 !important;
      }

      .m-block {
        display: block !important;
      }

      .fluid-img img {
        width: 100% !important;
        max-width: 100% !important;
        height: auto !important;
      }

      .column-top,
      .column {
        float: left !important;
        width: 100% !important;
        display: block !important;
      }

      .content-spacing {
        width: 15px !important;
      }

      .m-bg {
        display: block !important;
        width: 100% !important;
        height: auto !important;
        background-position: center center !important;
      }

      .h-auto {
        height: auto !important;
      }

      .plr-15 {
        padding-left: 15px !important;
        padding-right: 15px !important;
      }

      .w-2 {
        width: 2% !important;
      }
      .w-49 {
        width: 49% !important;
      }

      .pb-4 {
        padding-bottom: 4px !important;
      }
      .pb-15 {
        padding-bottom: 15px !important;
      }

      .pt-0 {
        padding-top: 0 !important;
      }

      .h1,
      .h1-white {
        font-size: 36px !important;
        line-height: 46px !important;
      }
      .h2 {
        font-size: 26px !important;
        line-height: 36px !important;
      }

      .text-btn-large,
      .text-btn-large-white {
        padding: 15px 25px !important;
      }
      .text-btn,
      .text-btn-1,
      .text-btn-1-white {
        padding: 12px 15px !important;
      }
    }
  </style>
</head>
<body
  class="body"
  style="
    padding: 0 !important;
    margin: 0 !important;
    display: block !important;
    min-width: 100% !important;
    width: 100% !important;
    background: #ffffff;
    -webkit-text-size-adjust: none;
  "
>
  <table
    width="100%"
    border="0"
    cellspacing="0"
    cellpadding="0"
    bgcolor="#ffffff"
  >
    <tr>
      <td align="center" valign="top">
        <!-- Top -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top">
              <table
                width="650"
                border="0"
                cellspacing="0"
                cellpadding="0"
                class="mobile-shell"
              >
                <tr>
                  <td class="plr-15" style="padding: 20px 0">
                    <table
                      width="100%"
                      border="0"
                      cellspacing="0"
                      cellpadding="0"
                    >
                      <tr>
                        <th
                          class="column-top"
                          valign="top"
                          width="360"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            padding: 0;
                            margin: 0;
                            font-weight: normal;
                            vertical-align: top;
                          "
                        >
                          <table
                            width="100%"
                            border="0"
                            cellspacing="0"
                            cellpadding="0"
                          >
                            <tr>
                              <td
                                class="text-top to-left m-center"
                                style="
                                  color: #888888;
                                  font-family: Poppins, Arial, sans-serif;
                                  font-size: 12px;
                                  line-height: 20px;
                                  text-align: left;
                                "
                              >
                                Is this email not displayng correctly?
                                <a
                                  href="#"
                                  target="_blank"
                                  class="link-1-u"
                                  style="
                                    color: #888888;
                                    text-decoration: underline;
                                  "
                                  ><span
                                    class="link-1-u"
                                    style="
                                      color: #888888;
                                      text-decoration: underline;
                                    "
                                    >View in your browser.</span
                                  ></a
                                >
                              </td>
                            </tr>
                          </table>
                        </th>
                        <th
                          class="column-top"
                          valign="top"
                          width="15"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            padding: 0;
                            margin: 0;
                            font-weight: normal;
                            vertical-align: top;
                          "
                        >
                          <div
                            style="font-size: 0pt; line-height: 0pt"
                            class="m-br-15"
                          ></div>
                        </th>
                        <th
                          class="column-top"
                          valign="top"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            padding: 0;
                            margin: 0;
                            font-weight: normal;
                            vertical-align: top;
                          "
                        >
                          <table
                            width="100%"
                            border="0"
                            cellspacing="0"
                            cellpadding="0"
                          >
                            <tr>
                              <td
                                class="text-top to-right m-center"
                                style="
                                  color: #888888;
                                  font-family: Poppins, Arial, sans-serif;
                                  font-size: 12px;
                                  line-height: 20px;
                                  text-align: right;
                                "
                              >
                                New this Weekend!
                              </td>
                            </tr>
                          </table>
                        </th>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <!-- END Top -->

        <!-- Header -->
        <table
          width="100%"
          border="0"
          cellspacing="0"
          cellpadding="0"
          bgcolor="#f4f4f4"
        >
          <tr>
            <td align="center" valign="top">
              <table
                width="650"
                border="0"
                cellspacing="0"
                cellpadding="0"
                class="mobile-shell"
              >
                <tr>
                  <td
                    class="img-center"
                    style="
                      padding: 45px 15px;
                      font-size: 0pt;
                      line-height: 0pt;
                      text-align: center;
                    "
                  >
                    <a href="#" target="_blank"
                      ><img
                        src="cid:logo"
                        width="130"
                        height="70"
                        border="0"
                        alt="Abid Electric Logo"
                    /></a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <!-- END Header -->

        <!-- Main -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
              <!-- Section - Intro -->
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">
                    <table
                      width="100%"
                      border="0"
                      cellspacing="0"
                      cellpadding="0"
                    >
                      <tr>
                        <td
                          class="img"
                          height="245"
                          bgcolor="#f4f4f4"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            text-align: left;
                          "
                        >
                          &nbsp;
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td
                    align="center"
                    valign="top"
                    width="650"
                    class="mobile-shell"
                  >
                    <table
                      width="650"
                      border="0"
                      cellspacing="0"
                      cellpadding="0"
                      class="mobile-shell"
                    >
                      <tr>
                        <td>
                          <table
                            width="100%"
                            border="0"
                            cellspacing="0"
                            cellpadding="0"
                          >
                            <tr>
                              <td
                                class="fluid-img"
                                style="
                                  padding-bottom: 40px;
                                  font-size: 0pt;
                                  line-height: 0pt;
                                  text-align: left;
                                "
                              >
                                <a href="#" target="_blank"
                                  >
                                  <img
                                    src="cid:big_img"
                                    width="650"
                                    height="487"
                                    border="0"
                                    alt=""
                                />
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td
                                class="plr-15"
                                style="padding: 0 60px 50px 60px"
                              >
                                <table
                                  width="100%"
                                  border="0"
                                  cellspacing="0"
                                  cellpadding="0"
                                >
                                  <tr>
                                    <td
                                      class="h1 fw-medium"
                                      style="
                                        padding-bottom: 20px;
                                        color: #4a4a4a;
                                        font-family: Poppins, Arial,
                                          sans-serif;
                                        font-size: 40px;
                                        line-height: 50px;
                                        text-align: center;
                                        font-weight: 500;
                                      ">';

// !!Insert  Review
$name = $_POST["name"];
$email = $_POST["email"];
$rating = $_POST["rating3"];
$review = $_POST["review"];
$Product_ID = $_POST["Product_ID"];
if (isset($_SESSION['U_UserId']) && !empty($_SESSION['U_UserId'])) {
  $UID  = $_SESSION['U_UserId'];
} else {
  $UID  = 'NULL';
}
$sql = "INSERT INTO `product_rating`(`User_ID`, `Product_ID`, `Name`, `Email`, `Review`, `Rating`, `Status`) VALUES ($UID,$Product_ID,'$name','$email','$review','$rating',0)";
$check = mysqli_query($connection, $sql);
if ($check) {
  if ($rating < 3) {
    echo json_encode([
      "status" => "success",
      "msg" => "Thank you for posting a review and we’re sorry to hear that your experience was not of the quality you expected. We would like the opportunity to investigate your feedback further."
    ]);

    $html .= '
                 Dear ' . $name . ', thanks for sharing your feedback.
                </td>
                </tr>
                <tr>
                <td
                class="text-1"
                style="
                padding-bottom: 30px;
                color: #4a4a4a;
                font-family: Poppins, Arial,
                    sans-serif;
                font-size: 16px;
                line-height: 30px;
                text-align: center;
                "
                >
                We’re sorry your experience didn’t match your expectations. It was an uncommon instance and we’ll do better.
                Please feel free reach out to <a href="mailto:contact@abidelectric.com">contact@abidelectric.com</a> with any further comments, concerns, or suggestions you wish to share. We would love to make things right if you give us another chance
                </td>
                </tr>
                <tr>
                <td
                align="center"
                style="padding-bottom: 30px"
                >
                <!-- Button -->
                <table
                border="0"
                cellspacing="0"
                cellpadding="0"
                >
                <tr>
                    <td
                    class="text-btn-large"
                    bgcolor="#ffffff"
                    style="
                        color: #4a4a4a;
                        font-family: Poppins, Arial,
                        sans-serif;
                        font-size: 14px;
                        line-height: 18px;
                        text-align: center;
                        border: 1px solid #e5e5e5;
                        padding: 15px 35px;
                    "
                    >
                    <a
                        href="detail.php?Product=' . $Product_ID . '"
                        target="_blank"
                        class="link-2"
                        style="
                        color: #4a4a4a;
                        text-decoration: none;
                        "
                        ><span
                        class="link-2"
                        style="
                            color: #4a4a4a;
                            text-decoration: none;
                        "
                        >View Product</span
                        ></a
                    >
                    </td>
                </tr>
                </table>
                <!-- END Button -->
                </td>
                </tr>
                ';
  } else if ($rating == 3) {
    echo json_encode([
      "status" => "success",
      "msg" => "Dear " . $name . ", thanks for your review. We would love to hear more about your experience, so that we can use your valuable feedback to deliver an even better experience next time. Please reach out to 'contact@abidelectric.com' with any further comments or suggestions you wish to share. Again, thank you for taking the time to review our business!"
    ]);

    //** */ Mail
    $html .= '
        Dear ' . $name . ', thanks for sharing your feedback.
       </td>
       </tr>
       <tr>
       <td
       class="text-1"
       style="
       padding-bottom: 30px;
       color: #4a4a4a;
       font-family: Poppins, Arial,
           sans-serif;
       font-size: 16px;
       line-height: 30px;
       text-align: center;
       "
       >
       We would love to hear more about your experience, so that we can use your valuable feedback to deliver an even better experience next time. Please reach out to <a href="mailto:contact@abidelectric.com">contact@abidelectric.com</a> with any further comments or suggestions you wish to share. Again, thank you for taking the time to review our business!
       </td>
       </tr>
       <tr>
       <td
       align="center"
       style="padding-bottom: 30px"
       >
       <!-- Button -->
       <table
       border="0"
       cellspacing="0"
       cellpadding="0"
       >
       <tr>
           <td
           class="text-btn-large"
           bgcolor="#ffffff"
           style="
               color: #4a4a4a;
               font-family: Poppins, Arial,
               sans-serif;
               font-size: 14px;
               line-height: 18px;
               text-align: center;
               border: 1px solid #e5e5e5;
               padding: 15px 35px;
           "
           >
           <a
               href="#"
               target="_blank"
               class="link-2"
               style="
               color: #4a4a4a;
               text-decoration: none;
               "
               ><span
               class="link-2"
               style="
                   color: #4a4a4a;
                   text-decoration: none;
               "
               >SHOP NOW</span
               ></a
           >
           </td>
       </tr>
       </table>
       <!-- END Button -->
       </td>
       </tr>
       ';
  } else {
    echo json_encode([
      "status" => "success",
      "msg" => "Dear " . $name . ", thanks for leaving us such a wonderful review. We are thrilled that you loved your experience; our staff will definitely be happy to read what you wrote. We put customer experience and satisfaction as our priority, and your review reaffirms the hard work we put in every day. So thanks for your kind words and we look forward to seeing you again."
    ]);


    //** */ Mail
    $html .= '
        Dear ' . $name . ',  thanks for leaving us such a wonderful feedback.
       </td>
       </tr>
       <tr>
       <td
       class="text-1"
       style="
       padding-bottom: 30px;
       color: #4a4a4a;
       font-family: Poppins, Arial,
           sans-serif;
       font-size: 16px;
       line-height: 30px;
       text-align: center;
       "
       >
       We are thrilled that you loved your experience; our staff will definitely be happy to read what you wrote. We put customer experience and satisfaction as our priority, and your review reaffirms the hard work we put in every day. So thanks for your kind words and we look forward to seeing you again.
       </td>
       </tr>
       <tr>
       <td
       align="center"
       style="padding-bottom: 30px"
       >
       <!-- Button -->
       <table
       border="0"
       cellspacing="0"
       cellpadding="0"
       >
       <tr>
           <td
           class="text-btn-large"
           bgcolor="#ffffff"
           style="
               color: #4a4a4a;
               font-family: Poppins, Arial,
               sans-serif;
               font-size: 14px;
               line-height: 18px;
               text-align: center;
               border: 1px solid #e5e5e5;
               padding: 15px 35px;
           "
           >
           <a
               href="#"
               target="_blank"
               class="link-2"
               style="
               color: #4a4a4a;
               text-decoration: none;
               "
               ><span
               class="link-2"
               style="
                   color: #4a4a4a;
                   text-decoration: none;
               "
               >SHOP NOW</span
               ></a
           >
           </td>
       </tr>
       </table>
       <!-- END Button -->
       </td>
       </tr>
       ';
  }
} else {
  echo json_encode(["status" => "error", "msg" => "Failed to add review."]);
}

$html .= '                                 
                                  <tr>
                                    <td
                                      class="text-2"
                                      style="
                                        color: #4a4a4a;
                                        font-family: Poppins, Arial,
                                          sans-serif;
                                        font-size: 11px;
                                        line-height: 15px;
                                        text-align: center;
                                      "
                                    >
                                      <a
                                        href="www.abidelectric.com/"
                                        target="_blank"
                                        class="link-2-u"
                                        style="
                                          color: #4a4a4a;
                                          text-decoration: underline;
                                        "
                                        ><span
                                          class="link-2-u"
                                          style="
                                            color: #4a4a4a;
                                            text-decoration: underline;
                                          "
                                          >Website</span
                                        ></a
                                      >
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td valign="top">
                    <table
                      width="100%"
                      border="0"
                      cellspacing="0"
                      cellpadding="0"
                    >
                      <tr>
                        <td
                          class="img"
                          height="245"
                          bgcolor="#f4f4f4"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            text-align: left;
                          "
                        >
                          &nbsp;
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <!-- END Section - Intro -->
            </td>
          </tr>
        </table>
        <!-- END Main -->

        <!-- Footer -->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top">
              <table
                width="650"
                border="0"
                cellspacing="0"
                cellpadding="0"
                class="mobile-shell"
              >
                <tr>
                  <td class="plr-15" style="padding: 40px 30px">
                    <table
                      width="100%"
                      border="0"
                      cellspacing="0"
                      cellpadding="0"
                    >
                      <tr>
                        <th
                          class="column-top"
                          valign="top"
                          width="225"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            padding: 0;
                            margin: 0;
                            font-weight: normal;
                            vertical-align: top;
                          "
                        >
                          <div
                            class="img-center"
                            style="
                              font-size: 0pt;
                              line-height: 0pt;
                              text-align: center;
                            "
                          >
                            <a href="#" target="_blank"
                              ><img
                                src="cid:logo"
                                border="0"
                                width="110"
                                height="55"
                                alt="Abid Electric Logo"
                            /></a>
                          </div>
                        </th>
                        <th
                          class="column-top"
                          valign="top"
                          width="15"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            padding: 0;
                            margin: 0;
                            font-weight: normal;
                            vertical-align: top;
                          "
                        >
                          <div
                            style="font-size: 0pt; line-height: 0pt"
                            class="m-br-15"
                          ></div>
                        </th>
                        <th
                          class="column-top"
                          valign="top"
                          style="
                            font-size: 0pt;
                            line-height: 0pt;
                            padding: 0;
                            margin: 0;
                            font-weight: normal;
                            vertical-align: top;
                          "
                        >
                          <table
                            width="100%"
                            border="0"
                            cellspacing="0"
                            cellpadding="0"
                          >
                            <tr>
                              <td
                                align="right"
                                style="padding: 15px 0 25px 0"
                              >
                                <!-- Socials -->
                                <table
                                  border="0"
                                  cellspacing="0"
                                  cellpadding="0"
                                  class="center"
                                >
                                  <tr>
                                    <td
                                      class="img"
                                      width="11"
                                      style="
                                        font-size: 0pt;
                                        line-height: 0pt;
                                        text-align: left;
                                      "
                                    >
                                      <a
                                        href="https://www.facebook.com/Abid-Electric-PK-107274490680374"
                                        target="_blank"
                                        ><img
                                          src="cid:fb_icon"
                                          width="11"
                                          height="22"
                                          border="0"
                                          alt=""
                                      /></a>
                                    </td>
                                    <td
                                      class="img"
                                      width="40"
                                      style="
                                        font-size: 0pt;
                                        line-height: 0pt;
                                        text-align: left;
                                      "
                                    ></td>

                                    <td
                                      class="img"
                                      width="23"
                                      style="
                                        font-size: 0pt;
                                        line-height: 0pt;
                                        text-align: left;
                                      "
                                    >
                                      <a
                                        href="mailto:contact@abidelectric.com"
                                        target="_blank"
                                        ><img
                                          src="cid:mail_icon"
                                          width="23"
                                          height="22"
                                          border="0"
                                          alt=""
                                      /></a>
                                    </td>
                                  </tr>
                                </table>
                                <!-- END Socials -->
                              </td>
                            </tr>
                            <tr>
                              <td
                                class="text-footer-1 to-right m-center"
                                style="
                                  color: #a0a09a;
                                  font-family: Poppins, Arial, sans-serif;
                                  font-size: 11px;
                                  line-height: 22px;
                                  text-align: right;
                                "
                              >
                                <span
                                  class="link-4"
                                  style="
                                    color: #a0a09a;
                                    text-decoration: none;
                                  "
                                >
                                  Factory Area Sargodha Pakistan,40100 </span
                                ><br />
                                Copyright &copy;
                                <a href="http://abidelectric.com/">
                                  www.abidelectric.com
                                </a>
                              </td>
                            </tr>
                          </table>
                        </th>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <!-- END Footer -->

        <!-- Bottom -->
        <table
          width="100%"
          border="0"
          cellspacing="0"
          cellpadding="0"
          bgcolor="#f4f4f4"
        >
          <tr>
            <td align="center" valign="top">
              <table
                width="650"
                border="0"
                cellspacing="0"
                cellpadding="0"
                class="mobile-shell"
              >
                <tr>
                  <td
                    class="text-bottom"
                    style="
                      padding: 35px 15px;
                      color: #888888;
                      font-family: Poppins, Arial, sans-serif;
                      font-size: 11px;
                      line-height: 18px;
                      text-align: center;
                    "
                  >
                  To make sure our emails arrive, please add 
                    <a
                      href="mailto:noreply@abidelectric.com"
                      target="_blank"
                      class="link-3-u"
                      style="color: #a8a8a8; text-decoration: underline"
                      ><span
                        class="link-3-u"
                        style="color: #a8a8a8; text-decoration: underline"
                        >noreply@abidelectric.com</span
                      ></a
                    >
                    to your contacts.
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <!-- END Bottom -->
      </td>
    </tr>
  </table>
</body>
</html>
';



$mail = new PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);

$mail->Host = 'mail.abidelectric.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'noreply@abidelectric.com';
$mail->Password = ')2SKLrwJ=JhH';
$mail->setFrom('noreply@abidelectric.com', 'Abid Electric');
$to_mail = $email;
$to_name = $name;
$mail->addAddress($to_mail, $to_name);
if ($mail->addReplyTo($to_mail, $to_name)) {
  $mail->Subject = 'Thank You for Shopping with Us';
  $mail->addEmbeddedImage('../../assets/images/logo/logo.png', 'logo');
  $mail->addEmbeddedImage('../../assets/images/mail/ico_envelope_light.png', 'mail_icon');
  $mail->addEmbeddedImage('../../assets/images/mail/ico_facebook_light.png', 'fb_icon');
  $mail->addEmbeddedImage('../../assets/images/mail/parallax-3.jpg', 'big_img');
  $mail->Body = $html;


  $mail->isHTML(true);

  if (!$mail->send()) {
    print_r($mail);
  } else {
    print_r($mail);
  }
}
