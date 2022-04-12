<?php
// !Remove ALl Items Form Cart
if (isset($_GET["action"])) {
    if ($_GET["action"] == "deleteAll") {
        unset($_SESSION["shopping_cart"]);
    }
}

// !Remove Item From Cart
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            //  echo '<script>alert("Item Removed' . $keys . '")</script>';
            if ($values["item_index"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                // echo '<script>alert("Item Removed' . $keys . '")</script>';
                echo '<script>location.reload()</script>';
            }
        }
    }
}
?>

<div id="offcanvas-cart" class="offcanvas offcanvas-cart">
    <div class="inner">
        <div class="head">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                <?php
                $TotalPrice = 0;
                $TotalWeight = 0;
                $totalShipPrice = 0;
                if (!empty($_SESSION["shopping_cart"])) {
                    $total = 0;
                    $TotalPrice = $total;
                    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                        // Variables
                        $NetPrice =  $values["item_updated_price"];
                        $NEtShipping =  $values["item_Shipcost"];
                        // !!Total Weight
                        $TotalWeight += (int)$values["item_weight"] * (int)$values["item_quantity"];
                        $total = $total + ($values["item_quantity"] * (int)$NetPrice);
                        $totalShipPrice =  $totalShipPrice + ((int)$values["item_quantity"] * (int)$NEtShipping);
                        $TotalPrice = $total;
                        // Color
                        $ColID = $values["item_color"];
                ?>
                        <li>
                            <a href="detail.php?Product=<?php echo $values["item_id"]; ?>" class="image"><img src="<?php echo $values["item_img"]; ?>" alt="Cart product Image(<?php echo $values["item_name"]; ?>)" /></a>
                            <div class="content">
                                <a href="detail.php?Product=<?php echo $values["item_id"]; ?>" class="title"><?php echo $values["item_name"]; ?></a>
                                <span class="quantity-price"><?php echo $values["item_quantity"]; ?> x <span class="amount">Rs. <?php echo number_format($values["item_updated_price"], 2); ?></span></span>
                                <?php if ($values["item_color"] !== "NULL"  && !empty($values["item_color"]) && isset($values["item_color"])) {
                                ?>
                                    <span class="quantity-price">Color: <?php echo $values["item_color"]; ?> </span>
                                <?php
                                }
                                // echo basename($_SERVER['PHP_SELF']) . "<br>";
                                // echo basename($_SERVER['REQUEST_URI']);
                                if (strpos(basename($_SERVER['REQUEST_URI']), "?")) {
                                ?>
                                    <a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&action=delete&id=<?php echo $values["item_index"]; ?>" class="remove">×</a>
                                <?php } else if (!strpos(basename($_SERVER['REQUEST_URI']), ".php")) {
                                ?>
                                    <a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?action=delete&id=<?php echo $values["item_index"]; ?>" class="remove">×</a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>?action=delete&id=<?php echo $values["item_index"]; ?>" class="remove">×</a>
                                <?php
                                } ?>
                            </div>
                        </li>
                    <?php  }
                } else {
                    ?>
                    <div class="dropdownmenu-wrapper">
                        <tr>
                            <p class="text-center lead">Your cart is empty!</p>
                        </tr>
                    </div><!-- End .dropdown-menu -->
                <?php
                }
                ?>
            </ul>
        </div>
        <?php
        if (!empty($_SESSION["shopping_cart"])) {
        ?>
            <div class="foot">
                <div class="sub-total">
                    <strong>Subtotal :</strong>
                    <span class="amount">Rs. <?php echo number_format($TotalPrice, 2); ?></span>
                </div>
                <div class="buttons">
                    <a href="cart.php" class="btn btn-dark btn-hover-primary">view cart</a>
                    <a href="checkout.php" class="btn btn-outline-dark">checkout</a>
                </div>
                <!-- <p class="minicart-message">Free Shipping on All Orders Over $100!</p> -->
            </div>
        <?php } ?>
    </div>
</div>