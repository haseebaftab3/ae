 <div class="header-section header-menu-center section bg-white d-none d-xl-block">
     <div class="container">
         <div class="row align-items-center">

             <!-- Header Logo Start -->
             <!-- <div class="col p-0"> -->
             <!-- <div class="footer5-social align-self-start  text-dark"> -->
             <ul class="widget-social justify-content-center">
             <li class="hintT-bottom" data-hint="Twitter"> <a href="https://twitter.com/electric_pk" target="_blank"><i class="fab fa-twitter text-dark"></i></a></li>
                 <li class="hintT-bottom" data-hint="Facebook"> <a href="https://www.facebook.com/Abid-Electric-PK-107274490680374/" target="_blank"><i class="fab fa-facebook-f text-dark"></i></a></li>
                 <li class="hintT-bottom" data-hint="Instagram"> <a href="https://www.instagram.com/abidelectricpkoffical" target="_blank"><i class="fab fa-instagram text-dark"></i></a></li>
                 <li class="hintT-bottom" data-hint="Whatsapp"> <a href="https://wa.me/03088881993" target="_blank"><i class="fab fa-whatsapp text-dark"></i></a></li>
                 <li class="hintT-bottom" data-hint="We Chat"> <a href="./assets/images/icons/we-chat.jpeg" target="_blank"><i class="fab fa-weixin"></i></a></li>
                 <!--<li class="hintT-top" data-hint="Youtube"> <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>-->
             </ul>
             <!-- </div> -->
             <!-- </div> -->
             <!-- Header Logo End -->

             <!-- Search Start -->
             <div class="col">
                 <nav class="site-main-menu menu-height-60 justify-content-center">
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
                                                         <a href="#" class="menu-banner"><img src="/assets/images/banner/menu-banner-2.png" alt="Shop Menu Banner" /></a>
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
             <div class="col">
                 <div class="header-tools justify-content-end">
                     <?php
                        if (isset($_SESSION['U_name']) && !empty($_SESSION['U_name']) && isset($_SESSION['U_pass']) && isset($_SESSION['U_Username']) && isset($_SESSION['U_UserId'])) {
                        ?>
                         <div class="header-login">
                             <a href="my-account.php"><i class="fal fa-user"></i></a>
                         </div>
                     <?php
                        } else {
                        ?>
                         <div class="header-login">
                             <a href="login-register.php"><i class="fal fa-user"></i></a>
                         </div>
                     <?php
                        }
                        ?>


                     <div class="header-search">
                         <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                     </div>
                     <!-- <div class="header-wishlist">
                         <a href="#offcanvas-wishlist" class="offcanvas-toggle"><span class="wishlist-count">3</span><i class="fal fa-heart"></i></a>
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
                 </div>
             </div>
             <!-- Header Tools End -->

         </div>
     </div>

 </div>