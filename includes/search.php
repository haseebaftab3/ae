<div id="offcanvas-search" class="offcanvas offcanvas-search" style="overflow-y: scroll;">
    <div class="inner">
        <div class="offcanvas-search-form">
            <button class="offcanvas-close">×</button>
            <form action="#">
                <div class="row mb-n3">
                    <div class="col-lg-8 col-12 mb-3">
                        <input type="text" placeholder="Search Products..." class="MainSearchINput" />
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                        <select class="search-select select2-basic ChangeCatStatusSearch">
                            <option value="NULL">All Categories</option>
                            <?php
                            $SQL_Cat = "SELECT * FROM `category`  WHERE `Parent_ID` IS NULL ORDER BY `category`.`Sort_Order` ";
                            $Check_Cat = mysqli_query($connection, $SQL_Cat);
                            if ($Check_Cat) {
                                if ((mysqli_num_rows($Check_Cat) <= 6) > 0) {
                                    while ($Fetch_Cat = mysqli_fetch_array($Check_Cat)) {
                                        $ID = $Fetch_Cat["ID"];
                            ?>
                                        <option value="<?php echo $Fetch_Cat["ID"] ?>"><?php echo $Fetch_Cat["Name"] ?></option>
                                        <?php
                                        $Sub_Cat_SQL = "SELECT * FROM `category`  WHERE `Parent_ID`=$ID ORDER BY `category`.`Sort_Order`";
                                        $Sub_Cat_Check = mysqli_query($connection, $Sub_Cat_SQL);
                                        if (mysqli_num_rows($Sub_Cat_Check) > 0) {
                                        ?>

                                            <?php
                                            if ($Sub_Cat_Check) {
                                                while ($Sub_Cat_Row = mysqli_fetch_array($Sub_Cat_Check)) {
                                            ?>
                                                    <option value="<?php echo $Sub_Cat_Row["ID"] ?>">- <?php echo $Sub_Cat_Row["Name"] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>

                                        <?php } ?>
                            <?php
                                    }
                                }
                            }
                            ?>

                        </select>
                    </div>
                </div>
            </form>
        </div>
        <p class="search-description text-body-light mt-2">
            <span># Type at least 1 character to search</span>
            <span># Hit enter to search or ESC to close</span>
        </p>
    </div>

    <hr>
    <div class="row no-gutters learts-mb-n40">
        <div class="LoadSearchCont"></div>
        <!-- 
        <div class="col-12 border-bottom learts-pb-40 learts-mb-40">
            <div class="blog">
                <div class="row learts-mb-n30">
                    <div class="col-xl-4 col-md-5 col-12 learts-mb-30">
                        <div class="image mb-0">
                            <a href="blog-details-right-sidebar.html"><img src="assets/images/blog/s345/blog-1.jpg" alt="Blog Image"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-7 col-12 align-self-center learts-mb-30">
                        <div class="content">
                            <ul class="meta">
                                <li><i class="far fa-calendar"></i><a href="#">January 22, 2020</a></li>
                                <li><i class="far fa-eye"></i> 201 views</li>
                            </ul>
                            <h5 class="title"><a href="blog-details-right-sidebar.html">Start a Kickass Online Blog</a></h5>
                            <div class="desc">
                                <p>Working on writing our first book has been one of the most amazing projects. It seems like it will be forever until I get to show you what we’ve been…</p>
                            </div>
                            <a href="blog-details-right-sidebar.html" class="link">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>