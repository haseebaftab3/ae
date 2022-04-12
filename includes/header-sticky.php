<div class="sticky-header header-menu-center section bg-white d-none d-xl-block">
    <div class="container">
        <div class="row align-items-center">
            <!-- Header Logo Start -->
            <div class="col">
                <div class="header-logo">
                    <a href="/index.php"><img src="https://abidelectric.sirv.com/logo/logo-2.png?format=webp&q=100&webp.fallback=png" alt="Abid Logo" /></a>
                </div>
            </div>
            <!-- Header Logo End -->

            <!-- Search Start -->
            <div class="col d-none d-xl-block">
                <nav class="site-main-menu justify-content-center">
                    <ul>
                        <?php
                        $Fetch_Header = "SELECT * FROM `category` WHERE `Parent_ID` IS NULL AND `Status` = 'True' ORDER BY `category`.`Sort_Order` ASC ";
                        $Check_Header = mysqli_query($connection, $Fetch_Header);
                        if ($Check_Header) {
                            if (mysqli_num_rows($Check_Header) > 0) {
                                while ($Row_Header = mysqli_fetch_array($Check_Header)) {
                        ?>
                                    <li class="has-children">
                                        <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>"><span class="menu-text"><?php echo $Row_Header["Name"] ?></span></a>
                                        <?php
                                        $Level_ID = $Row_Header["ID"];
                                        $Fetch_Levels = "SELECT * FROM `category` WHERE `Parent_ID` != 'NULl' AND `Parent_ID` = $Level_ID  AND `Status` = 'True' ORDER BY `category`.`Sort_Order` ASC";
                                        $Check_Levels = mysqli_query($connection, $Fetch_Levels);
                                        if ($Check_Levels) {
                                            if (mysqli_num_rows($Check_Levels) > 0 && mysqli_num_rows($Check_Levels) < 4) {
                                        ?>
                                                <ul class="sub-menu mega-menu">
                                                    <?php while ($Row_Level = mysqli_fetch_array($Check_Levels)) { ?>
                                                        <li>
                                                            <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>" class="mega-menu-title"><span class="menu-text"><?php echo $Row_Level["Name"] ?></span></a>
                                                            <?php
                                                            $Category_ID = $Row_Level["ID"];
                                                            $Fetch_Prodcuct = "SELECT * FROM `products` WHERE  `Category_ID` =  $Category_ID  AND `Status` = 1 ORDER BY `products`.`SortOrder` ASC LIMIT 6";
                                                            $Check_Prodcuct = mysqli_query($connection, $Fetch_Prodcuct);
                                                            if ($Check_Prodcuct) {
                                                                if (mysqli_num_rows($Check_Prodcuct) > 0 && mysqli_num_rows($Check_Prodcuct) < 6) {

                                                            ?>
                                                                    <ul>
                                                                        <?php
                                                                        while ($Row_Prodcuct = mysqli_fetch_array($Check_Prodcuct)) {
                                                                        ?>
                                                                            <li>
                                                                                <a href="detail.php?Product=<?php echo $Row_Prodcuct["ID"] ?>"><span class="menu-text"><?php echo $Row_Prodcuct["Name"] ?></span></a>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                <?php
                                                                } else if (mysqli_num_rows($Check_Prodcuct) > 0 && mysqli_num_rows($Check_Prodcuct) == 6) {
                                                                ?>
                                                                    <ul>
                                                                        <?php
                                                                        while ($Row_Prodcuct = mysqli_fetch_array($Check_Prodcuct)) {
                                                                        ?>
                                                                            <li>
                                                                                <a href="detail.php?Product=<?php echo $Row_Prodcuct["ID"] ?>"><span class="menu-text"><?php echo $Row_Prodcuct["Name"] ?></span></a>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <li>
                                                                            <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>"><span class="menu-text">See All</span></a>
                                                                        </li>
                                                                    </ul>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                    <li class="align-self-center">
                                                        <a href="#" class="menu-banner"><img src="assets/images/banner/menu-banner-2.png" alt="Shop Menu Banner" /></a>
                                                    </li>
                                                </ul>
                                            <?php } else if (mysqli_num_rows($Check_Levels) > 0 && mysqli_num_rows($Check_Levels) == 4) {
                                            ?>
                                                <ul class="sub-menu mega-menu">
                                                    <?php while ($Row_Level = mysqli_fetch_array($Check_Levels)) { ?>
                                                        <li>
                                                            <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>" class="mega-menu-title"><span class="menu-text"><?php echo $Row_Level["Name"] ?></span></a>
                                                            <?php
                                                            $Category_ID = $Row_Level["ID"];
                                                            $Fetch_Prodcuct = "SELECT * FROM `products` WHERE  `Category_ID` =  $Category_ID  AND `Status` = 1 ORDER BY `products`.`SortOrder` ASC LIMIT 6";
                                                            $Check_Prodcuct = mysqli_query($connection, $Fetch_Prodcuct);
                                                            if ($Check_Prodcuct) {
                                                                if (mysqli_num_rows($Check_Prodcuct) > 0 && mysqli_num_rows($Check_Prodcuct) < 6) {

                                                            ?>
                                                                    <ul>
                                                                        <?php
                                                                        while ($Row_Prodcuct = mysqli_fetch_array($Check_Prodcuct)) {
                                                                        ?>
                                                                            <li>
                                                                                <a href="detail.php?Product=<?php echo $Row_Prodcuct["ID"] ?>"><span class="menu-text"><?php echo $Row_Prodcuct["Name"] ?></span></a>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                <?php
                                                                } else if (mysqli_num_rows($Check_Prodcuct) > 0 && mysqli_num_rows($Check_Prodcuct) == 6) {
                                                                ?>
                                                                    <ul>
                                                                        <?php
                                                                        while ($Row_Prodcuct = mysqli_fetch_array($Check_Prodcuct)) {
                                                                        ?>
                                                                            <li>
                                                                                <a href="detail.php?Product=<?php echo $Row_Prodcuct["ID"] ?>"><span class="menu-text"><?php echo $Row_Prodcuct["Name"] ?></span></a>
                                                                            </li>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                        <li>
                                                                            <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>"><span class="menu-text">See All</span></a>
                                                                        </li>
                                                                    </ul>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php
                                            } else {
                                            ?>
                                                <ul class="sub-menu mega-menu">
                                                    <?php while ($Row_Level = mysqli_fetch_array($Check_Levels)) { ?>
                                                        <li>
                                                            <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>" style="font-size: 16px;" class="mega-menu-title"><span class="menu-text"><?php echo $Row_Level["Name"] ?></span></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                        <?php
                                            }
                                        } ?>
                                    </li>
                        <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <!-- Search End -->

            <!-- Header Tools Start -->
            <div class="col-auto">
                <div class="header-tools justify-content-end">
                    <div class="header-login">
                        <a href="my-account.php"><i class="fal fa-user"></i></a>
                    </div>
                    <div class="header-search d-none d-sm-block">
                        <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                    </div>
                    <!-- <div class="header-wishlist">
                        <a href="javascript:void(0)offcanvas-wishlist" class="offcanvas-toggle"><span class="wishlist-count">3</span><i class="fal fa-heart"></i></a>
                    </div> -->
                    <div class="header-cart">
                        <a href="#offcanvas-cart" class="offcanvas-toggle">
                            <span class="cart-count">
                                <?php
                                if (isset($_SESSION["shopping_cart"])) {
                                    echo count($_SESSION["shopping_cart"]);
                                } else {
                                    echo "0";
                                }
                                ?>
                            </span>
                            <i class="fal fa-shopping-cart"></i>
                        </a>
                    </div>
                    <div class="mobile-menu-toggle d-xl-none">
                        <a href="javascript:void(0)offcanvas-mobile-menu" class="offcanvas-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                <path d="M300,320 L540,320" id="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Header Tools End -->
        </div>
    </div>
</div>