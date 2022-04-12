<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
    <div class="inner customScroll">
        <div class="offcanvas-menu-search-form">
            <form action="#">
                <input type="text" placeholder="Search..." class="MainSearchINput" />
                <!-- <button><i class="fal fa-search"></i></button> -->
            </form>
        </div>
        <div class="offcanvas-menu">
            <ul>
                <li>
                    <a href="index.php"><span class="menu-text">Home</span></a>
                </li>
                <li>
                    <a href="shop.php"><span class="menu-text">Shop</span></a>
                </li>
                <?php
                $Fetch_Header = "SELECT * FROM `category` WHERE `Parent_ID` IS NULL AND `Status` = 'True' ORDER BY `category`.`Sort_Order` ASC ";
                $Check_Header = mysqli_query($connection, $Fetch_Header);
                if ($Check_Header) {
                    if (mysqli_num_rows($Check_Header) > 0) {
                        while ($Row_Header = mysqli_fetch_array($Check_Header)) {
                ?>
                            <li>
                                <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>"><span class="menu-text"><?php echo $Row_Header["Name"] ?></span></a>
                                <?php
                                $Level_ID = $Row_Header["ID"];
                                $Fetch_Levels = "SELECT * FROM `category` WHERE `Parent_ID` != 'NULl' AND `Parent_ID` = $Level_ID  AND `Status` = 'True' ORDER BY `category`.`Sort_Order` ASC";
                                $Check_Levels = mysqli_query($connection, $Fetch_Levels);
                                if ($Check_Levels) {
                                    if (mysqli_num_rows($Check_Levels) > 0) {

                                ?>
                                        <ul class="sub-menu">
                                            <?php while ($Row_Level = mysqli_fetch_array($Check_Levels)) { ?>

                                                <li>
                                                    <a href="shop.php?List=<?php echo $Row_Header["ID"]; ?>" class="mega-menu-title"><span class="menu-text"><?php echo $Row_Level["Name"] ?></span></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                <?php
                                    }
                                }
                                ?>
                            </li>
                <?php
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <div class="offcanvas-buttons">
            <div class="header-tools">
                <div class="header-login">
                    <a href="my-account.php"><i class="fal fa-user"></i></a>
                </div>
                <div class="header-wishlist">
                    <a href="wishlist.php"><span>3</span><i class="fal fa-heart"></i></a>
                </div>
                <div class="header-cart">
                    <a href="shopping-cart.php"><span class="cart-count">3</span><i class="fal fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
        <div class="offcanvas-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>