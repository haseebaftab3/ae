<?php
require("../../connection.php");
$id = $_POST["Quick_ID"];
$Product_ID = $_POST["Quick_ID"];
$html = "";
$SendSalePrice = 0;
$SendSaleType = 0;
$SendSaleId = "NULL";
$Prodcucts_SQL = "SELECT * FROM `products` WHERE `ID`= $id";
$Prodcucts_Check = mysqli_query($connection, $Prodcucts_SQL);
$Prodcuts_Row = mysqli_fetch_array($Prodcucts_Check);

// Extra Images
$ExImg = "SELECT `Image` FROM `products_images` WHERE `Product_ID`= $id";
$ExCheck = mysqli_query($connection, $ExImg);

$LoadColorOption = "SELECT * FROM `prodcuts_option` WHERE `Product_ID` = $id AND `Type` = 'Color' ";
$CHeckColorOption = mysqli_query($connection, $LoadColorOption);

$LoadSizeOption = "SELECT * FROM `prodcuts_option` WHERE `Product_ID` = $id AND `Type` = 'Size' ";
$CHeckSizeOption = mysqli_query($connection, $LoadSizeOption);

$Cat_ID = $Prodcuts_Row["Category_ID"];

$Cat_SQL = "SELECT * FROM `category` WHERE `ID`= $Cat_ID";
$Cat_Check = mysqli_query($connection, $Cat_SQL);
$Cat_Row = mysqli_fetch_array($Cat_Check);
// Sale
$currentDate = date("m/d/Y");

$html .= '<button class="close" data-dismiss="modal">&times;</button>';

//  !Product Images Start
$html .= '<div class="row learts-mb-n30">
            <div class="col-lg-6 col-12 learts-mb-30">
                <div class="product-images">
                    <div class="product-gallery-slider-quickview">
                        <div class="product-zoom" data-image="admin/uploads/Products/' . $Prodcuts_Row["Image"] . '">
                            <img src="admin/uploads/Products/' . $Prodcuts_Row["Image"] . '" alt="' .  $Prodcuts_Row["Name"] . '" />
                        </div>';

while ($Exrow = mysqli_fetch_array($ExCheck)) {
    $html .= '<div class="product-zoom" data-image="admin/uploads/Products/' . $Exrow["Image"] . '">
                <img src="admin/uploads/Products/' . $Exrow["Image"] . '"  />
            </div>';
}
$html .= '         </div>
                </div>
            </div>';
//  !Product Images End

//  !Product Summery Start
$Rating_Sql = "SELECT * FROM `product_rating` WHERE `Product_ID` = $Product_ID AND `Status` = 1 ";
$check_Rating = mysqli_query($connection, $Rating_Sql);
$total_rating = 0;
$i = 0;
while ($row_Rating = mysqli_fetch_array($check_Rating)) {
    $total_rating = $row_Rating["Rating"] +  $total_rating;
    $i++;
}
if ($total_rating > 0) {

    $Avg_rating = ($total_rating / (mysqli_num_rows($check_Rating) * 5)) * 100;
} else {
    $Avg_rating = 0;
}

$html .= '  
        <div class="col-lg-6 col-12 overflow-hidden learts-mb-30">
        <div class="product-summery customScroll">
        <div class="product-ratings">
            <span class="star-rating">
                <span class="rating-active" style="width:' . $Avg_rating . '%;">ratings</span>
            </span>
            <a href="#reviews" class="review-link">(<span class="count">' . mysqli_num_rows($check_Rating) . '</span> customer reviews)</a>
        </div>

            <h3 class="product-title">' . $Prodcuts_Row["Name"] . '</h3>
            ';
$FetchSale = "SELECT * FROM `sale` WHERE ((`Cat_ID`=$Cat_ID OR `Prodcut_ID`= $Product_ID) AND `Date_End`>'$currentDate')";
$checkSale = mysqli_query($connection, $FetchSale);
if ($checkSale) {
    if (mysqli_num_rows($checkSale) > 0) {
        $rowSale = mysqli_fetch_array($checkSale);
        $SendSaleId = $rowSale["ID"];
        $NewPrice = (((int) $rowSale["Value"] / 100) * $Prodcuts_Row["Price"]);
        $SendSalePrice = round($Prodcuts_Row["Price"] - $NewPrice);
        $html .= '
        <input type="hidden" class="Sale_Of_Value" value="' .  $rowSale["Value"] . '">
        <div class="text-danger font-weight-bold float-left pr-3"><del>Rs.  <span class="Old_Product_Price">' .  number_format($Prodcuts_Row["Price"], 2) . '</span></del></div>
        <div class="product-price float-left">  Rs. ' .  number_format($SendSalePrice, 2) . '</div>
        <div class="clearfix"></div>';
    } else {
        $catSql = "SELECT * FROM `category` WHERE `ID` = $Cat_ID ";
        $CheckCat = mysqli_query($connection, $catSql);
        if ($CheckCat) {
            // Check By Category
            $RowCat = mysqli_fetch_array($CheckCat);
            $MainCatID = $RowCat["Parent_ID"];
            $MainCatSql = "SELECT * FROM `sale` WHERE `Cat_ID`=$MainCatID AND `Date_End`>'$currentDate'";
            $checkMainCat = mysqli_query($connection, $MainCatSql);

            if ($checkMainCat) {
                if (mysqli_num_rows($checkMainCat) > 0) {
                    $rowSale = mysqli_fetch_array($checkMainCat);
                    $SendSaleId = $rowSale["ID"];
                    $NewPrice = (((int) $rowSale["Value"] / 100) * $Prodcuts_Row["Price"]);
                    $SendSalePrice = round($Prodcuts_Row["Price"] - $NewPrice);

                    $html .= '
                    <input type="hidden" class="Sale_Of_Value" value="' .  $rowSale["Value"] . '">
                    <div class="text-danger font-weight-bold float-left pr-3"><del>Rs.  <span class="Old_Product_Price">' .  number_format($Prodcuts_Row["Price"], 2) . '</span></del></div>
                    <div class="product-price float-left">  Rs. ' .  number_format($SendSalePrice, 2) . '</div>
                    <div class="clearfix"></div>';
                } else {
                    $html .= '
                    <div class="product-price float-left">  Rs. ' .  number_format($Prodcuts_Row["Price"], 2) . '</div>
                    <div class="clearfix"></div>';
                }
            }
        }
    }
}


$html .= ' <div class="product-description">';
if (strlen($Prodcuts_Row["Description"]) > 60) {
    $html .= '
                <p>
               ' . substr($Prodcuts_Row["Description"], 0, 300) . " .........</li></ul>" . '
                </p>';
} else {
    $html .= '
                <p>
            ' . $Prodcuts_Row["Description"] . '
                </p>';
}

if (!empty($Prodcuts_Row["DAmp"]) && isset($Prodcuts_Row["DAmp"])) {
    $inc = 1;
    $Sql_Amp = "SELECT * FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Amp' ";
    $Fetch_Amp = mysqli_query($connection, $Sql_Amp);
    $html .= '<div class="form-group">
    <label for="exampleFormControlSelect1">Select Amp</label>
    <select class="form-control Amp-Option-Select" id="exampleFormControlSelect1">';
    $html .= ' <option value="' . $Prodcuts_Row["UnitPrice"] . '" data-TotalPrice="' . $Prodcuts_Row["Price"] . '" data-Quantity="' . $Prodcuts_Row["Unit_Quantity"] . '">' . $Prodcuts_Row["DAmp"] . ' AMP</option>';
    if (mysqli_num_rows($Fetch_Amp) > 0) {
        while ($row_Amp = mysqli_fetch_array($Fetch_Amp)) {
            $html .= ' <option value="' . $row_Amp["Unit_Price"] . '" data-TotalPrice="' . $row_Amp["Price"] . '" data-Quantity="' . $row_Amp["Quantity"] . '">' . $row_Amp["Name"] . ' AMP</option>';
            $inc++;
        }
    }
    $html .= ' </select>
</div>';
}

// Info Unit
if ((!empty($Prodcuts_Row["UnitPrice"]) && isset($Prodcuts_Row["UnitPrice"])) || (!empty($Prodcuts_Row["Unit_Quantity"]) && isset($Prodcuts_Row["Unit_Quantity"]))) {
    $html .= '<div class="group-product-list">
    <table>
        <tbody>
        ';
    if (!empty($Prodcuts_Row["UnitPrice"]) && isset($Prodcuts_Row["UnitPrice"])) {
        $html .= ' <tr>
                    <td class="title"><a href="javascript:void(0)">Price Per Piece</a></td>
                    <td class="price"><span class="pro-price"><span class="new change_unit_price">Rs. ' . number_format($Prodcuts_Row["UnitPrice"], 2) . '</span></span></td>
                </tr>';
    }
    if (!empty($Prodcuts_Row["Unit_Quantity"]) && isset($Prodcuts_Row["Unit_Quantity"])) {

        $html .= '<tr>
                    <td class="title"><a href="javascript:void(0)">Packing in box</a></td>
                    <td class="price"><span class="pro-price"><span class="new change_unit_Quntity">' . $Prodcuts_Row["Unit_Quantity"] . '</span></span></td>
                </tr>';
    }
    $html .= ' </tbody>
    </table>
    <span class="info-text">Products are available in limited quantities.</span>
</div>';
}
$html .= '
            </div>
            <form class="Add_To_Cart_Form">

            <div class="product-variations">
                <table>
                    <tbody>
                        ';

if (!empty($Prodcuts_Row["DColor"])) {
    $inc = 1;
    $Sql_Color = "SELECT `Name`,`H_Code` FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Color' ";
    $Fetch_Color = mysqli_query($connection, $Sql_Color);
    $html .= ' <tr>
        <td class="label"><span>Color</span></td>
        <td class="value">
            <div class="product-colors">
                <div class="swatch clearfix" data-option-index="1"> ';
    if (strtolower($Prodcuts_Row["DColor"]) == "white" || $Prodcuts_Row["DColor"] == "#FFFFFF") {
        $html .= ' <div data-value="Blue" class="swatch-element color blue available">
                            <div class="tooltip">' .   $Prodcuts_Row["DColor"]  . '</div>
                            <input quickbeam="color" id="swatch-1-blue' .  $inc  . '" type="radio" name="option-1" class="swatch_Color_Fetch" checked value=" ' . $Prodcuts_Row["DColor"] . ' " />
                            <label for="swatch-1-blue' .   $inc  . '" style="border-color:black;">
                                <span style="background-color:' .   $Prodcuts_Row["DColor"]  . ';"></span>
                            </label>
                        </div>';
    } else {
        $html .= '  <div data-value="Blue" class="swatch-element color blue available">
                            <div class="tooltip">' .   $Prodcuts_Row["DColor"]  . '</div>
                            <input quickbeam="color" id="swatch-1-blue' .   $inc  . '" type="radio" name="option-1" class="swatch_Color_Fetch" checked value="' .   $Prodcuts_Row["DColor"]  . '" />
                            <label for="swatch-1-blue' .   $inc  . '" style="border-color:' .   strtolower($Prodcuts_Row["DColor"])  . ';">
                                <span style="background-color:' .   strtolower($Prodcuts_Row["DColor"])  . ';"></span>
                            </label>
                        </div>';
    }
    if (mysqli_num_rows($Fetch_Color) > 0) {
        while ($row_color = mysqli_fetch_array($Fetch_Color)) {
            $html .= ' <div data-value="' .   $row_color["Name"]  . '" class="swatch-element color blue available">
                                <div class="tooltip">' .   $row_color["Name"]  . '</div>
                                <input quickbeam="color" id="swatch-1-blue' .   ++$inc  . '" type="radio" class="swatch_Color_Fetch" name="option-1" value="' .   $row_color["Name"]  . '" />
                                <label for="swatch-1-blue' .   $inc  . '" style="border-color: ' .   strtolower($row_color["H_Code"])  . '!important;">
                                    <span style="background-color: ' .   strtolower($row_color["H_Code"])  . '!important;"></span>
                                </label>
                            </div>';


            $inc++;
        }
        $html .= '   
                        </div>
                        </div>
                        </td>
                        </tr>';
    }
}

$html .= '
<tr>
    <td class="label"><span>Quantity</span></td>
    <td class="value">
        <div class="product-quantity">
            <span class="qty-btn minus MinusQuntBtnQuickVeiw"><i class="ti-minus"></i></span>
            <input type="hidden"  value="' . $Prodcuts_Row["Minimum"] . '" class="QucikMaxvalue">
            <input type="text" class="input-qty input-qtyQuickVeiw" required value="' . $Prodcuts_Row["Minimum"] . '" name="CartProductQuantity">
            <span class="qty-btn plus PlusQuntBtnQuickVeiw"><i class="ti-plus"></i></span>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>
<div class="product-buttons">
<!--    <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark"><i class="fal fa-heart"></i></a> -->
';

$html .= '<input type="hidden" name="CartProductID" value="' .  $id . '">
          <input type="hidden" name="CartProductName" value="' .  $Prodcuts_Row["Name"] . '">
          <input type="hidden" name="CartProductPrice" value="' .  $Prodcuts_Row["Price"] . '">
          <input type="hidden"name="CartShiipProductPrice" value="' . $Prodcuts_Row["Shipping_Price"] . '">
          <input type="hidden" name="CartProductImg" value="admin/uploads/Products/' .  $Prodcuts_Row["Image"] . '">
          <input type="hidden" name="CartProductColor" class="CartProductColor" value="' . $Prodcuts_Row["DColor"] . '">
          <input type="hidden" name="CartProductSize" class="CartProductSize" value="' . $Prodcuts_Row["DSize"] . '">
          <input type="hidden" name="CartProductUpdatedPrice" class="CartProductUpdatedPrice" value="' .  $Prodcuts_Row["Price"] . '">
          <input type="hidden" name="CartProductWeight" value="' . $Prodcuts_Row["Weight"] . '">';


$html .= '  <input type="hidden" class="Hidden_Unit_Price" value="' . $Prodcuts_Row["UnitPrice"] . '" name="Hidden_Unit_Price">
            <input type="hidden" class="Hidden_Unit_Quantity" value="' . $Prodcuts_Row["Unit_Quantity"] . '" name="Hidden_Unit_Price">';

if ($SendSalePrice != 0) {
    $html .= '<input type="hidden" class="QuickBasePrice" value="' . $SendSalePrice .  '">';
    $html .= '<input type="hidden" name="CartProductUpdatedPrice" class="CartProductUpdatedPrice" value="' . $SendSalePrice . '">';
    $html .= '<input type="hidden" name="CartProductSaleID" value="' . $SendSaleId . '">';
} else {
    $html .= ' <input type="hidden" class="QuickBasePrice" value="' . $Prodcuts_Row["Price"] . '">';
    $html .= '<input type="hidden" name="CartProductUpdatedPrice" class="CartProductUpdatedPrice" value="' . $Prodcuts_Row["Price"] . '">';
    $html .= '<input type="hidden" name="CartProductSaleID" value="">';
}
$html .= '<button href="#" class="btn btn-dark btn-outline-hover-dark"><i class="fal fa-shopping-cart"></i> Add to Cart</button>
<!--   <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark"><i class="fal fa-random"></i></a> -->
</div>
</form>    

<div class="product-meta mb-0">
    <table>
        <tbody>
            <tr>
                <td class="label"><span>Model No. </span></td>
                <td class="value">' . $Prodcuts_Row["Model"] . '</td>
            </tr>
            <tr>
                <td class="label"><span>Category</span></td>
                <td class="value">
                    <ul class="product-category">
                        <li><a href="javascript:void(0)">' . $Cat_Row["Name"] . '</a></li>
                    </ul>
                </td>
            </tr>
            ';
$Fetch_SEO_Keyword = "SELECT `ProductTag` FROM `products_seo` WHERE `Product_ID`= $Product_ID";
$Check_SEO_Keyword = mysqli_query($connection, $Fetch_SEO_Keyword);
if (mysqli_num_rows($Check_SEO_Keyword) > 0) {
    $Fetch_SEO_Keyword = mysqli_fetch_array($Check_SEO_Keyword);
    if (!empty($Fetch_SEO_Keyword["ProductTag"])) {
        $html .= '  
        <tr>
        <td class="label"><span>Tags</span></td>
        <td class="value">
        <ul class="product-tags">';
        $Fetch_SEO_Keyword = "SELECT `ProductTag` FROM `products_seo` WHERE `Product_ID`= $Product_ID ";
        $Check_SEO_Keyword = mysqli_query($connection, $Fetch_SEO_Keyword);
        while ($Fetch_SEO_Keyword = mysqli_fetch_array($Check_SEO_Keyword)) {
            $keywork = explode(",", $Fetch_SEO_Keyword["ProductTag"]);
            foreach ($keywork as $f_Keywork) {

                $html .= '  <li><a href="javascript:void(0)">
                 ' . $f_Keywork . '
                 </a>
                 </li>';
            }
        }

        $html .= '  </ul>
         </td>
         </tr>';
    }
}
if (!empty($Prodcuts_Row["DSize"])) {
    $html_Size = "";
    $i = 0;
    $Sql_Size = "SELECT `Name` FROM `prodcuts_option` WHERE `Product_ID`= $Product_ID AND `Type`='Size' ";
    $Fetch_Size = mysqli_query($connection, $Sql_Size);
    $html .= '
    <tr>
    <td class="label"><span>Size</span></td>
    <td class="value">
    <ul class="product-tags">
        ';
    if (mysqli_num_rows($Fetch_Size) > 0) {
        $len = mysqli_num_rows($Fetch_Size);
        while ($row_Size = mysqli_fetch_array($Fetch_Size)) {
            if ($i == 0) {
                $html_Size .= $row_Size["Name"] . ", ";
            } else if ($i == $len - 1) {
                $html_Size .= $row_Size["Name"];
            } else {
                $html_Size .= $row_Size["Name"]  . ", ";
            }

            if (!empty($html_Size)) {
                $html .= '<li><a href="#">' . $Prodcuts_Row["DSize"] . ", " . $html_Size . '</a></li>';
            } else {
                $html .= '<li><a href="#">' . $Prodcuts_Row["DSize"] . '</a></li>';
            }
            $i++;
        }
    } else {
        $html .= '<li><a href="#">' . $Prodcuts_Row["DSize"] . '</a></li>';
    }
    $html .= '</ul>
    </td>
</tr>';
}
$html .= '
        </tbody>
    </table>
</div>
</div>
</div>
</div>
';

echo json_encode(["status" => "success", "html" => $html]);
