<?php
if (!isset($_SESSION)) {
    session_start();
}
require("connection.php");
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php require("includes/head.php"); ?>
</head>

<body>
    <div class="Preloader-container d-none">
        <div class="preloader">
            <div class="spinner"></div>
            <span id="loading-msg"></span>
        </div>
    </div>
    <div class="MainContainer-Vis">
        <!-- Topbar Section Start -->
        <?php require("includes/top-bar.php"); ?>
        <!-- Topbar Section End -->

        <!-- Header Section Start -->
        <?php require("includes/header.php") ?>
        <!-- Header Section End -->

        <!-- Header Sticky Section Start -->
        <?php require("includes/header-sticky.php") ?>
        <!-- Header Sticky Section End -->

        <!-- Mobile Header Section Start -->
        <?php require("includes/mobile-header.php") ?>
        <!-- Mobile Header Section End -->


        <!-- OffCanvas Search Start -->
        <?php require("includes/search.php") ?>
        <!-- OffCanvas Search End -->

        <!-- OffCanvas Wishlist Start -->
        <?php require("includes/wishlist.php") ?>
        <!-- OffCanvas Wishlist End -->

        <!-- OffCanvas Cart Start -->
        <?php require("includes/cart.php") ?>
        <!-- OffCanvas Cart End -->

        <!-- OffCanvas Search Start -->
        <?php require("includes/search-category.php") ?>
        <!-- OffCanvas Search End -->

        <div class="offcanvas-overlay"></div>


        <!-- Page Title/Header Start -->
        <div class="page-title-section section" style="background-size: 156%;" data-bg-image="assets/images/bg/checkout.png">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="page-title">
                            <h1 class="title">Checkout</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Page Title/Header End -->

        <!-- Checkout Section Start -->
        <div class="section section-padding">
            <div class="container">
                <div class="checkout-coupon">
                    <p class="coupon-toggle">Have a coupon? <a href="#checkout-coupon-form" data-toggle="collapse">Click here to enter your code</a></p>
                    <div id="checkout-coupon-form" class="collapse">
                        <div class="coupon-form">
                            <p>If you have a coupon code, please apply it below.</p>
                            <form action="#" class="learts-mb-n10">
                                <input class="learts-mb-10" type="text" placeholder="Coupon code">
                                <button class="btn btn-dark btn-outline-hover-dark learts-mb-10">apply coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-title2 mb-4">
                    <h2 class="title">Billing details</h2>
                </div>
                <div id="CheckOutAlert" class="mb-3"></div>
                <!-- <form action=""> -->
                <?php
                if (isset($_SESSION['U_name']) && !empty($_SESSION['U_name']) && isset($_SESSION['U_pass']) && isset($_SESSION['U_Username']) && isset($_SESSION['U_UserId'])) {
                    $UID = $_SESSION['U_UserId'];
                    $FetcUserDetail = "SELECT * FROM `user_account` WHERE `ID` = $UID";
                    $CheckUserDetail = mysqli_query($connection, $FetcUserDetail);
                    if ($CheckUserDetail) {
                        if (mysqli_num_rows($CheckUserDetail) == 1) {
                            $RowUser = mysqli_fetch_array($CheckUserDetail);
                ?>
                            <!-- User Id -->
                            <input type="hidden" value="<?php echo $RowUser["ID"] ?>" id="bdUserId">
                            <div class="checkout-form learts-mb-50">
                                <div class="row">
                                    <div class="col-md-12 col-12 learts-mb-20">
                                        <label for="bdFirstName">Full Name <abbr class="required">*</abbr></label>
                                        <input type="text" id="bdFirstName" name="Name" value="<?php echo $RowUser["Name"] ?>">
                                    </div>
                                    <div class=" col-12 learts-mb-20">
                                        <label for="bdCompanyName">Company name (optional)</label>
                                        <input type="text" name="CName" id="bdCompanyName">
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="bdCountry">Country <abbr class="required">*</abbr></label>
                                        <select id="bdCountry" class="select2-basic" name="Country">
                                            <option value="" disabled>Select a country…</option>
                                            <option value="PK" selected>Pakistan</option>
                                        </select>
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="bdAddress1">Street address <abbr class="required">*</abbr></label>
                                        <input type="text" id="bdAddress1" name="Address" value="<?php echo $RowUser["Address"] ?>" placeholder=" House number and street name">
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="bdAddress2" class="sr-only">Apartment, suite, unit etc. (optional)</label>
                                        <input type="text" id="bdAddress2" name="Address2" placeholder="Apartment, suite, unit etc. (optional) ">
                                    </div>
                                    <!-- <div class="col-12 learts-mb-20">
                                    <label for="bdTownOrCity">Town / City <abbr class="required">*</abbr></label>
                                    <input type="text" id="bdTownOrCity">
                                </div> -->
                                    <div class="col-12 learts-mb-20">
                                        <label for="bdDistrict">City <abbr class="required">*</abbr></label>
                                        <select id="bdDistrict" name="City" class="select2-basic">
                                            <option value="Islamabad">Islamabad</option>
                                            <option value="" disabled>Punjab Cities</option>
                                            <option value="Ahmed Nager Chatha">Ahmed Nager Chatha</option>
                                            <option value="Ahmadpur East">Ahmadpur East</option>
                                            <option value="Ali Khan Abad">Ali Khan Abad</option>
                                            <option value="Alipur">Alipur</option>
                                            <option value="Arifwala">Arifwala</option>
                                            <option value="Attock">Attock</option>
                                            <option value="Bhera">Bhera</option>
                                            <option value="Bhalwal">Bhalwal</option>
                                            <option value="Bahawalnagar">Bahawalnagar</option>
                                            <option value="Bahawalpur">Bahawalpur</option>
                                            <option value="Bhakkar">Bhakkar</option>
                                            <option value="Burewala">Burewala</option>
                                            <option value="Chillianwala">Chillianwala</option>
                                            <option value="Chakwal">Chakwal</option>
                                            <option value="Chichawatni">Chichawatni</option>
                                            <option value="Chiniot">Chiniot</option>
                                            <option value="Chishtian">Chishtian</option>
                                            <option value="Daska">Daska</option>
                                            <option value="Darya Khan">Darya Khan</option>
                                            <option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
                                            <option value="Dhaular">Dhaular</option>
                                            <option value="Dina">Dina</option>
                                            <option value="Dinga">Dinga</option>
                                            <option value="Dipalpur">Dipalpur</option>
                                            <option value="Faisalabad">Faisalabad</option>
                                            <option value="Fateh Jhang">Fateh Jang</option>
                                            <option value="Ghakhar Mandi">Ghakhar Mandi</option>
                                            <option value="Gojra">Gojra</option>
                                            <option value="Gujranwala">Gujranwala</option>
                                            <option value="Gujrat">Gujrat</option>
                                            <option value="Gujar Khan">Gujar Khan</option>
                                            <option value="Hafizabad">Hafizabad</option>
                                            <option value="Haroonabad">Haroonabad</option>
                                            <option value="Hasilpur">Hasilpur</option>
                                            <option value="Haveli">Haveli</option>
                                            <option value="Lakha">Lakha</option>
                                            <option value="Jalalpur">Jalalpur</option>
                                            <option value="Jattan">Jattan</option>
                                            <option value="Jampur">Jampur</option>
                                            <option value="Jaranwala">Jaranwala</option>
                                            <option value="Jhang">Jhang</option>
                                            <option value="Jhelum">Jhelum</option>
                                            <option value="Kalabagh">Kalabagh</option>
                                            <option value="Karor Lal Esan">Karor Lal Esan</option>
                                            <option value="Kasur">Kasur</option>
                                            <option value="Kamalia">Kamalia</option>
                                            <option value="Kamoke">Kamoke</option>
                                            <option value="Khanewal">Khanewal</option>
                                            <option value="Khanpur">Khanpur</option>
                                            <option value="Kharian">Kharian</option>
                                            <option value="Khushab">Khushab</option>
                                            <option value="Kot Adu">Kot Adu</option>
                                            <option value="Jauharabad">Jauharabad</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Lalamusa">Lalamusa</option>
                                            <option value="Layyah">Layyah</option>
                                            <option value="Liaquat Pur">Liaquat Pur</option>
                                            <option value="Lodhran">Lodhran</option>
                                            <option value="Malakwal">Malakwal</option>
                                            <option value="Mamoori">Mamoori</option>
                                            <option value="Mailsi">Mailsi</option>
                                            <option value="Mandi Bahauddin">Mandi Bahauddin</option>
                                            <option value="mian Channu">Mian Channu</option>
                                            <option value="Mianwali">Mianwali</option>
                                            <option value="Multan">Multan</option>
                                            <option value="Murree">Murree</option>
                                            <option value="Muridke">Muridke</option>
                                            <option value="Mianwali Bangla">Mianwali Bangla</option>
                                            <option value="Muzaffargarh">Muzaffargarh</option>
                                            <option value="Narowal">Narowal</option>
                                            <option value="Okara">Okara</option>
                                            <option value="Renala Khurd">Renala Khurd</option>
                                            <option value="Pakpattan">Pakpattan</option>
                                            <option value="Pattoki">Pattoki</option>
                                            <option value="Pir Mahal">Pir Mahal</option>
                                            <option value="Qaimpur">Qaimpur</option>
                                            <option value="Qila Didar Singh">Qila Didar Singh</option>
                                            <option value="Rabwah">Rabwah</option>
                                            <option value="Raiwind">Raiwind</option>
                                            <option value="Rajanpur">Rajanpur</option>
                                            <option value="Rahim Yar Khan">Rahim Yar Khan</option>
                                            <option value="Rawalpindi">Rawalpindi</option>
                                            <option value="Sadiqabad">Sadiqabad</option>
                                            <option value="Safdarabad">Safdarabad</option>
                                            <option value="Sahiwal">Sahiwal</option>
                                            <option value="Sangla Hill">Sangla Hill</option>
                                            <option value="Sarai Alamgir">Sarai Alamgir</option>
                                            <option value="Sargodha">Sargodha</option>
                                            <option value="Shakargarh">Shakargarh</option>
                                            <option value="Sheikhupura">Sheikhupura</option>
                                            <option value="Sialkot">Sialkot</option>
                                            <option value="Sohawa">Sohawa</option>
                                            <option value="Soianwala">Soianwala</option>
                                            <option value="Siranwali">Siranwali</option>
                                            <option value="Talagang">Talagang</option>
                                            <option value="Taxila">Taxila</option>
                                            <option value="Toba Tek  Singh">Toba Tek Singh</option>
                                            <option value="Vehari">Vehari</option>
                                            <option value="Wah Cantonment">Wah Cantonment</option>
                                            <option value="Wazirabad">Wazirabad</option>
                                            <option value="" disabled>Sindh Cities</option>
                                            <option value="Badin">Badin</option>
                                            <option value="Bhirkan">Bhirkan</option>
                                            <option value="Rajo Khanani">Rajo Khanani</option>
                                            <option value="Chak">Chak</option>
                                            <option value="Dadu">Dadu</option>
                                            <option value="Digri">Digri</option>
                                            <option value="Diplo">Diplo</option>
                                            <option value="Dokri">Dokri</option>
                                            <option value="Ghotki">Ghotki</option>
                                            <option value="Haala">Haala</option>
                                            <option value="Hyderabad">Hyderabad</option>
                                            <option value="Islamkot">Islamkot</option>
                                            <option value="Jacobabad">Jacobabad</option>
                                            <option value="Jamshoro">Jamshoro</option>
                                            <option value="Jungshahi">Jungshahi</option>
                                            <option value="Kandhkot">Kandhkot</option>
                                            <option value="Kandiaro">Kandiaro</option>
                                            <option value="Karachi">Karachi</option>
                                            <option value="Kashmore">Kashmore</option>
                                            <option value="Keti Bandar">Keti Bandar</option>
                                            <option value="Khairpur">Khairpur</option>
                                            <option value="Kotri">Kotri</option>
                                            <option value="Larkana">Larkana</option>
                                            <option value="Matiari">Matiari</option>
                                            <option value="Mehar">Mehar</option>
                                            <option value="Mirpur Khas">Mirpur Khas</option>
                                            <option value="Mithani">Mithani</option>
                                            <option value="Mithi">Mithi</option>
                                            <option value="Mehrabpur">Mehrabpur</option>
                                            <option value="Moro">Moro</option>
                                            <option value="Nagarparkar">Nagarparkar</option>
                                            <option value="Naudero">Naudero</option>
                                            <option value="Naushahro Feroze">Naushahro Feroze</option>
                                            <option value="Naushara">Naushara</option>
                                            <option value="Nawabshah">Nawabshah</option>
                                            <option value="Nazimabad">Nazimabad</option>
                                            <option value="Qambar">Qambar</option>
                                            <option value="Qasimabad">Qasimabad</option>
                                            <option value="Ranipur">Ranipur</option>
                                            <option value="Ratodero">Ratodero</option>
                                            <option value="Rohri">Rohri</option>
                                            <option value="Sakrand">Sakrand</option>
                                            <option value="Sanghar">Sanghar</option>
                                            <option value="Shahbandar">Shahbandar</option>
                                            <option value="Shahdadkot">Shahdadkot</option>
                                            <option value="Shahdadpur">Shahdadpur</option>
                                            <option value="Shahpur Chakar">Shahpur Chakar</option>
                                            <option value="Shikarpaur">Shikarpaur</option>
                                            <option value="Sukkur">Sukkur</option>
                                            <option value="Tangwani">Tangwani</option>
                                            <option value="Tando Adam Khan">Tando Adam Khan</option>
                                            <option value="Tando Allahyar">Tando Allahyar</option>
                                            <option value="Tando Muhammad Khan">Tando Muhammad Khan</option>
                                            <option value="Thatta">Thatta</option>
                                            <option value="Umerkot">Umerkot</option>
                                            <option value="Warah">Warah</option>
                                            <option value="" disabled>Khyber Cities</option>
                                            <option value="Abbottabad">Abbottabad</option>
                                            <option value="Adezai">Adezai</option>
                                            <option value="Alpuri">Alpuri</option>
                                            <option value="Akora Khattak">Akora Khattak</option>
                                            <option value="Ayubia">Ayubia</option>
                                            <option value="Banda Daud Shah">Banda Daud Shah</option>
                                            <option value="Bannu">Bannu</option>
                                            <option value="Batkhela">Batkhela</option>
                                            <option value="Battagram">Battagram</option>
                                            <option value="Birote">Birote</option>
                                            <option value="Chakdara">Chakdara</option>
                                            <option value="Charsadda">Charsadda</option>
                                            <option value="Chitral">Chitral</option>
                                            <option value="Daggar">Daggar</option>
                                            <option value="Dargai">Dargai</option>
                                            <option value="Darya Khan">Darya Khan</option>
                                            <option value="dera Ismail Khan">Dera Ismail Khan</option>
                                            <option value="Doaba">Doaba</option>
                                            <option value="Dir">Dir</option>
                                            <option value="Drosh">Drosh</option>
                                            <option value="Hangu">Hangu</option>
                                            <option value="Haripur">Haripur</option>
                                            <option value="Karak">Karak</option>
                                            <option value="Kohat">Kohat</option>
                                            <option value="Kulachi">Kulachi</option>
                                            <option value="Lakki Marwat">Lakki Marwat</option>
                                            <option value="Latamber">Latamber</option>
                                            <option value="Madyan">Madyan</option>
                                            <option value="Mansehra">Mansehra</option>
                                            <option value="Mardan">Mardan</option>
                                            <option value="Mastuj">Mastuj</option>
                                            <option value="Mingora">Mingora</option>
                                            <option value="Nowshera">Nowshera</option>
                                            <option value="Paharpur">Paharpur</option>
                                            <option value="Pabbi">Pabbi</option>
                                            <option value="Peshawar">Peshawar</option>
                                            <option value="Saidu Sharif">Saidu Sharif</option>
                                            <option value="Shorkot">Shorkot</option>
                                            <option value="Shewa Adda">Shewa Adda</option>
                                            <option value="Swabi">Swabi</option>
                                            <option value="Swat">Swat</option>
                                            <option value="Tangi">Tangi</option>
                                            <option value="Tank">Tank</option>
                                            <option value="Thall">Thall</option>
                                            <option value="Timergara">Timergara</option>
                                            <option value="Tordher">Tordher</option>
                                            <option value="" disabled>Balochistan Cities</option>
                                            <option value="Awaran">Awaran</option>
                                            <option value="Barkhan">Barkhan</option>
                                            <option value="Chagai">Chagai</option>
                                            <option value="Dera Bugti">Dera Bugti</option>
                                            <option value="Gwadar">Gwadar</option>
                                            <option value="Harnai">Harnai</option>
                                            <option value="Jafarabad">Jafarabad</option>
                                            <option value="Jhal Magsi">Jhal Magsi</option>
                                            <option value="Kacchi">Kacchi</option>
                                            <option value="Kalat">Kalat</option>
                                            <option value="Kech">Kech</option>
                                            <option value="Kharan">Kharan</option>
                                            <option value="Khuzdar">Khuzdar</option>
                                            <option value="Killa Abdullah">Killa Abdullah</option>
                                            <option value="Killa Saifullah">Killa Saifullah</option>
                                            <option value="Kohlu">Kohlu</option>
                                            <option value="Lasbela">Lasbela</option>
                                            <option value="Lehri">Lehri</option>
                                            <option value="Loralai">Loralai</option>
                                            <option value="Mastung">Mastung</option>
                                            <option value="Musakhel">Musakhel</option>
                                            <option value="Nasirabad">Nasirabad</option>
                                            <option value="Nushki">Nushki</option>
                                            <option value="Panjgur">Panjgur</option>
                                            <option value="Pishin valley">Pishin Valley</option>
                                            <option value="Quetta">Quetta</option>
                                            <option value="Sherani">Sherani</option>
                                            <option value="Sibi">Sibi</option>
                                            <option value="Sohbatpur">Sohbatpur</option>
                                            <option value="Washuk">Washuk</option>
                                            <option value="Zhob">Zhob</option>
                                            <option value="Ziarat">Ziarat</option>
                                        </select>
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="bdPostcode">Postcode / ZIP (optional)</label>
                                        <input type="text" name="Postal" value="<?php echo $RowUser["Postal_code"] ?>" id="bdPostcode">
                                    </div>
                                    <div class="col-md-6 col-12 learts-mb-20">
                                        <label for="bdEmail">Email address <abbr class="required">*</abbr></label>
                                        <input type="email" name="Email" value="<?php echo $RowUser["Email"] ?>" id="bdEmail">
                                    </div>
                                    <div class="col-md-6 col-12 learts-mb-30">
                                        <label for="bdPhone">Phone <abbr class="required">*</abbr></label>
                                        <input type="tel" name="Tel" value="<?php echo $RowUser["Number"] ?>" id="bdPhone">
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="bdOrderNote">Order Notes (optional)</label>
                                        <textarea id="bdOrderNote" name="name" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                } else {
                    // !!With Out Login
                    ?>
                    <input type="hidden" value="NULL" id="bdUserId">
                    <div class="checkout-form learts-mb-50">
                        <div class="row">
                            <div class="col-md-12 col-12 learts-mb-20">
                                <label for="bdFirstName">Full Name <abbr class="required">*</abbr></label>
                                <input type="text" id="bdFirstName" name="Name">
                            </div>
                            <div class=" col-12 learts-mb-20">
                                <label for="bdCompanyName">Company name (optional)</label>
                                <input type="text" name="CName" id="bdCompanyName">
                            </div>
                            <div class="col-12 learts-mb-20">
                                <label for="bdCountry">Country <abbr class="required">*</abbr></label>
                                <select id="bdCountry" class="select2-basic" name="Country">
                                    <option value="" disabled>Select a country…</option>
                                    <option value="PK" selected>Pakistan</option>
                                </select>
                            </div>
                            <div class="col-12 learts-mb-20">
                                <label for="bdAddress1">Street address <abbr class="required">*</abbr></label>
                                <input type="text" id="bdAddress1" name="Address" placeholder=" House number and street name">
                            </div>
                            <div class="col-12 learts-mb-20">
                                <label for="bdAddress2" class="sr-only">Apartment, suite, unit etc. (optional)</label>
                                <input type="text" id="bdAddress2" name="Address2" placeholder="Apartment, suite, unit etc. (optional) ">
                            </div>
                            <!-- <div class="col-12 learts-mb-20">
                                    <label for="bdTownOrCity">Town / City <abbr class="required">*</abbr></label>
                                    <input type="text" id="bdTownOrCity">
                                </div> -->
                            <div class="col-12 learts-mb-20">
                                <label for="bdDistrict">City <abbr class="required">*</abbr></label>
                                <select id="bdDistrict" name="City" class="select2-basic">
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="" disabled>Punjab Cities</option>
                                    <option value="Ahmed Nager Chatha">Ahmed Nager Chatha</option>
                                    <option value="Ahmadpur East">Ahmadpur East</option>
                                    <option value="Ali Khan Abad">Ali Khan Abad</option>
                                    <option value="Alipur">Alipur</option>
                                    <option value="Arifwala">Arifwala</option>
                                    <option value="Attock">Attock</option>
                                    <option value="Bhera">Bhera</option>
                                    <option value="Bhalwal">Bhalwal</option>
                                    <option value="Bahawalnagar">Bahawalnagar</option>
                                    <option value="Bahawalpur">Bahawalpur</option>
                                    <option value="Bhakkar">Bhakkar</option>
                                    <option value="Burewala">Burewala</option>
                                    <option value="Chillianwala">Chillianwala</option>
                                    <option value="Chakwal">Chakwal</option>
                                    <option value="Chichawatni">Chichawatni</option>
                                    <option value="Chiniot">Chiniot</option>
                                    <option value="Chishtian">Chishtian</option>
                                    <option value="Daska">Daska</option>
                                    <option value="Darya Khan">Darya Khan</option>
                                    <option value="Dera Ghazi Khan">Dera Ghazi Khan</option>
                                    <option value="Dhaular">Dhaular</option>
                                    <option value="Dina">Dina</option>
                                    <option value="Dinga">Dinga</option>
                                    <option value="Dipalpur">Dipalpur</option>
                                    <option value="Faisalabad">Faisalabad</option>
                                    <option value="Fateh Jhang">Fateh Jang</option>
                                    <option value="Ghakhar Mandi">Ghakhar Mandi</option>
                                    <option value="Gojra">Gojra</option>
                                    <option value="Gujranwala">Gujranwala</option>
                                    <option value="Gujrat">Gujrat</option>
                                    <option value="Gujar Khan">Gujar Khan</option>
                                    <option value="Hafizabad">Hafizabad</option>
                                    <option value="Haroonabad">Haroonabad</option>
                                    <option value="Hasilpur">Hasilpur</option>
                                    <option value="Haveli">Haveli</option>
                                    <option value="Lakha">Lakha</option>
                                    <option value="Jalalpur">Jalalpur</option>
                                    <option value="Jattan">Jattan</option>
                                    <option value="Jampur">Jampur</option>
                                    <option value="Jaranwala">Jaranwala</option>
                                    <option value="Jhang">Jhang</option>
                                    <option value="Jhelum">Jhelum</option>
                                    <option value="Kalabagh">Kalabagh</option>
                                    <option value="Karor Lal Esan">Karor Lal Esan</option>
                                    <option value="Kasur">Kasur</option>
                                    <option value="Kamalia">Kamalia</option>
                                    <option value="Kamoke">Kamoke</option>
                                    <option value="Khanewal">Khanewal</option>
                                    <option value="Khanpur">Khanpur</option>
                                    <option value="Kharian">Kharian</option>
                                    <option value="Khushab">Khushab</option>
                                    <option value="Kot Adu">Kot Adu</option>
                                    <option value="Jauharabad">Jauharabad</option>
                                    <option value="Lahore">Lahore</option>
                                    <option value="Lalamusa">Lalamusa</option>
                                    <option value="Layyah">Layyah</option>
                                    <option value="Liaquat Pur">Liaquat Pur</option>
                                    <option value="Lodhran">Lodhran</option>
                                    <option value="Malakwal">Malakwal</option>
                                    <option value="Mamoori">Mamoori</option>
                                    <option value="Mailsi">Mailsi</option>
                                    <option value="Mandi Bahauddin">Mandi Bahauddin</option>
                                    <option value="mian Channu">Mian Channu</option>
                                    <option value="Mianwali">Mianwali</option>
                                    <option value="Multan">Multan</option>
                                    <option value="Murree">Murree</option>
                                    <option value="Muridke">Muridke</option>
                                    <option value="Mianwali Bangla">Mianwali Bangla</option>
                                    <option value="Muzaffargarh">Muzaffargarh</option>
                                    <option value="Narowal">Narowal</option>
                                    <option value="Okara">Okara</option>
                                    <option value="Renala Khurd">Renala Khurd</option>
                                    <option value="Pakpattan">Pakpattan</option>
                                    <option value="Pattoki">Pattoki</option>
                                    <option value="Pir Mahal">Pir Mahal</option>
                                    <option value="Qaimpur">Qaimpur</option>
                                    <option value="Qila Didar Singh">Qila Didar Singh</option>
                                    <option value="Rabwah">Rabwah</option>
                                    <option value="Raiwind">Raiwind</option>
                                    <option value="Rajanpur">Rajanpur</option>
                                    <option value="Rahim Yar Khan">Rahim Yar Khan</option>
                                    <option value="Rawalpindi">Rawalpindi</option>
                                    <option value="Sadiqabad">Sadiqabad</option>
                                    <option value="Safdarabad">Safdarabad</option>
                                    <option value="Sahiwal">Sahiwal</option>
                                    <option value="Sangla Hill">Sangla Hill</option>
                                    <option value="Sarai Alamgir">Sarai Alamgir</option>
                                    <option value="Sargodha">Sargodha</option>
                                    <option value="Shakargarh">Shakargarh</option>
                                    <option value="Sheikhupura">Sheikhupura</option>
                                    <option value="Sialkot">Sialkot</option>
                                    <option value="Sohawa">Sohawa</option>
                                    <option value="Soianwala">Soianwala</option>
                                    <option value="Siranwali">Siranwali</option>
                                    <option value="Talagang">Talagang</option>
                                    <option value="Taxila">Taxila</option>
                                    <option value="Toba Tek  Singh">Toba Tek Singh</option>
                                    <option value="Vehari">Vehari</option>
                                    <option value="Wah Cantonment">Wah Cantonment</option>
                                    <option value="Wazirabad">Wazirabad</option>
                                    <option value="" disabled>Sindh Cities</option>
                                    <option value="Badin">Badin</option>
                                    <option value="Bhirkan">Bhirkan</option>
                                    <option value="Rajo Khanani">Rajo Khanani</option>
                                    <option value="Chak">Chak</option>
                                    <option value="Dadu">Dadu</option>
                                    <option value="Digri">Digri</option>
                                    <option value="Diplo">Diplo</option>
                                    <option value="Dokri">Dokri</option>
                                    <option value="Ghotki">Ghotki</option>
                                    <option value="Haala">Haala</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Islamkot">Islamkot</option>
                                    <option value="Jacobabad">Jacobabad</option>
                                    <option value="Jamshoro">Jamshoro</option>
                                    <option value="Jungshahi">Jungshahi</option>
                                    <option value="Kandhkot">Kandhkot</option>
                                    <option value="Kandiaro">Kandiaro</option>
                                    <option value="Karachi">Karachi</option>
                                    <option value="Kashmore">Kashmore</option>
                                    <option value="Keti Bandar">Keti Bandar</option>
                                    <option value="Khairpur">Khairpur</option>
                                    <option value="Kotri">Kotri</option>
                                    <option value="Larkana">Larkana</option>
                                    <option value="Matiari">Matiari</option>
                                    <option value="Mehar">Mehar</option>
                                    <option value="Mirpur Khas">Mirpur Khas</option>
                                    <option value="Mithani">Mithani</option>
                                    <option value="Mithi">Mithi</option>
                                    <option value="Mehrabpur">Mehrabpur</option>
                                    <option value="Moro">Moro</option>
                                    <option value="Nagarparkar">Nagarparkar</option>
                                    <option value="Naudero">Naudero</option>
                                    <option value="Naushahro Feroze">Naushahro Feroze</option>
                                    <option value="Naushara">Naushara</option>
                                    <option value="Nawabshah">Nawabshah</option>
                                    <option value="Nazimabad">Nazimabad</option>
                                    <option value="Qambar">Qambar</option>
                                    <option value="Qasimabad">Qasimabad</option>
                                    <option value="Ranipur">Ranipur</option>
                                    <option value="Ratodero">Ratodero</option>
                                    <option value="Rohri">Rohri</option>
                                    <option value="Sakrand">Sakrand</option>
                                    <option value="Sanghar">Sanghar</option>
                                    <option value="Shahbandar">Shahbandar</option>
                                    <option value="Shahdadkot">Shahdadkot</option>
                                    <option value="Shahdadpur">Shahdadpur</option>
                                    <option value="Shahpur Chakar">Shahpur Chakar</option>
                                    <option value="Shikarpaur">Shikarpaur</option>
                                    <option value="Sukkur">Sukkur</option>
                                    <option value="Tangwani">Tangwani</option>
                                    <option value="Tando Adam Khan">Tando Adam Khan</option>
                                    <option value="Tando Allahyar">Tando Allahyar</option>
                                    <option value="Tando Muhammad Khan">Tando Muhammad Khan</option>
                                    <option value="Thatta">Thatta</option>
                                    <option value="Umerkot">Umerkot</option>
                                    <option value="Warah">Warah</option>
                                    <option value="" disabled>Khyber Cities</option>
                                    <option value="Abbottabad">Abbottabad</option>
                                    <option value="Adezai">Adezai</option>
                                    <option value="Alpuri">Alpuri</option>
                                    <option value="Akora Khattak">Akora Khattak</option>
                                    <option value="Ayubia">Ayubia</option>
                                    <option value="Banda Daud Shah">Banda Daud Shah</option>
                                    <option value="Bannu">Bannu</option>
                                    <option value="Batkhela">Batkhela</option>
                                    <option value="Battagram">Battagram</option>
                                    <option value="Birote">Birote</option>
                                    <option value="Chakdara">Chakdara</option>
                                    <option value="Charsadda">Charsadda</option>
                                    <option value="Chitral">Chitral</option>
                                    <option value="Daggar">Daggar</option>
                                    <option value="Dargai">Dargai</option>
                                    <option value="Darya Khan">Darya Khan</option>
                                    <option value="dera Ismail Khan">Dera Ismail Khan</option>
                                    <option value="Doaba">Doaba</option>
                                    <option value="Dir">Dir</option>
                                    <option value="Drosh">Drosh</option>
                                    <option value="Hangu">Hangu</option>
                                    <option value="Haripur">Haripur</option>
                                    <option value="Karak">Karak</option>
                                    <option value="Kohat">Kohat</option>
                                    <option value="Kulachi">Kulachi</option>
                                    <option value="Lakki Marwat">Lakki Marwat</option>
                                    <option value="Latamber">Latamber</option>
                                    <option value="Madyan">Madyan</option>
                                    <option value="Mansehra">Mansehra</option>
                                    <option value="Mardan">Mardan</option>
                                    <option value="Mastuj">Mastuj</option>
                                    <option value="Mingora">Mingora</option>
                                    <option value="Nowshera">Nowshera</option>
                                    <option value="Paharpur">Paharpur</option>
                                    <option value="Pabbi">Pabbi</option>
                                    <option value="Peshawar">Peshawar</option>
                                    <option value="Saidu Sharif">Saidu Sharif</option>
                                    <option value="Shorkot">Shorkot</option>
                                    <option value="Shewa Adda">Shewa Adda</option>
                                    <option value="Swabi">Swabi</option>
                                    <option value="Swat">Swat</option>
                                    <option value="Tangi">Tangi</option>
                                    <option value="Tank">Tank</option>
                                    <option value="Thall">Thall</option>
                                    <option value="Timergara">Timergara</option>
                                    <option value="Tordher">Tordher</option>
                                    <option value="" disabled>Balochistan Cities</option>
                                    <option value="Awaran">Awaran</option>
                                    <option value="Barkhan">Barkhan</option>
                                    <option value="Chagai">Chagai</option>
                                    <option value="Dera Bugti">Dera Bugti</option>
                                    <option value="Gwadar">Gwadar</option>
                                    <option value="Harnai">Harnai</option>
                                    <option value="Jafarabad">Jafarabad</option>
                                    <option value="Jhal Magsi">Jhal Magsi</option>
                                    <option value="Kacchi">Kacchi</option>
                                    <option value="Kalat">Kalat</option>
                                    <option value="Kech">Kech</option>
                                    <option value="Kharan">Kharan</option>
                                    <option value="Khuzdar">Khuzdar</option>
                                    <option value="Killa Abdullah">Killa Abdullah</option>
                                    <option value="Killa Saifullah">Killa Saifullah</option>
                                    <option value="Kohlu">Kohlu</option>
                                    <option value="Lasbela">Lasbela</option>
                                    <option value="Lehri">Lehri</option>
                                    <option value="Loralai">Loralai</option>
                                    <option value="Mastung">Mastung</option>
                                    <option value="Musakhel">Musakhel</option>
                                    <option value="Nasirabad">Nasirabad</option>
                                    <option value="Nushki">Nushki</option>
                                    <option value="Panjgur">Panjgur</option>
                                    <option value="Pishin valley">Pishin Valley</option>
                                    <option value="Quetta">Quetta</option>
                                    <option value="Sherani">Sherani</option>
                                    <option value="Sibi">Sibi</option>
                                    <option value="Sohbatpur">Sohbatpur</option>
                                    <option value="Washuk">Washuk</option>
                                    <option value="Zhob">Zhob</option>
                                    <option value="Ziarat">Ziarat</option>
                                </select>
                            </div>
                            <div class="col-12 learts-mb-20">
                                <label for="bdPostcode">Postcode / ZIP (optional)</label>
                                <input type="text" name="Postal" id="bdPostcode">
                            </div>
                            <div class="col-md-6 col-12 learts-mb-20">
                                <label for="bdEmail">Email address <abbr class="required">*</abbr></label>
                                <input type="email" name="Email" id="bdEmail">
                            </div>
                            <div class="col-md-6 col-12 learts-mb-30">
                                <label for="bdPhone">Phone <abbr class="required">*</abbr></label>
                                <input type="tel" name="Tel" id="bdPhone">
                            </div>
                            <div class="col-12 learts-mb-20">
                                <label for="bdOrderNote">Order Notes (optional)</label>
                                <textarea id="bdOrderNote" name="name" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
                <!-- </form> -->
                <div class="section-title2 text-center">
                    <h2 class="title">Your order</h2>
                </div>
                <?php
                if (!empty($_SESSION["shopping_cart"])) {
                ?>
                    <div class="row learts-mb-n30">
                        <div class="col-lg-6 order-lg-2 learts-mb-30">
                            <div class="order-review">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="name">Product</th>
                                            <th class="total">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($_SESSION["shopping_cart"] as $keys => $values) { ?>
                                            <tr>
                                                <td class="name"><?php echo $values["item_name"]; ?>&nbsp; <strong class="quantity">×&nbsp;<?php echo $values["item_quantity"]; ?></strong></td>
                                                <td class="total"><span><?php echo "Rs. " . number_format($values["item_quantity"] *  $NetPrice, 2); ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="subtotal">
                                            <th>Subtotal</th>
                                            <td><span><?php echo "Rs. " . number_format($total, 2); ?></span></td>
                                        </tr>
                                        <tr class="subtotal">
                                            <th>Shipping</th>
                                            <td><span><?php echo "Rs. " . number_format($totalShipPrice, 2); ?></span></td>
                                        </tr>
                                        <tr class="total">
                                            <th>Total</th>
                                            <td><strong><span><?php echo "Rs. " . number_format($TotalPrice + $totalShipPrice, 2); ?></span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-6 order-lg-1 learts-mb-30">
                            <div class="order-payment">
                                <div class="payment-method">
                                    <div class="accordion" id="paymentMethod">
                                        <div class="card active">
                                            <div class="card-header">
                                                <button data-toggle="collapse" data-target="#cashkPayments">Cash on delivery</button>
                                            </div>
                                            <div id="cashkPayments" class="collapse show" data-parent="#paymentMethod">
                                                <div class="card-body">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <button data-toggle="collapse" data-target="#checkPayments">Check payments</button>
                                            </div>
                                            <div id="checkPayments" class="collapse" data-parent="#paymentMethod">
                                                <div class="card-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="card">
                                        <div class="card-header">
                                            <button data-toggle="collapse" data-target="#payPalPayments">PayPal <img src="assets/images/others/pay-2.png" alt=""></button>
                                        </div>
                                        <div id="payPalPayments" class="collapse" data-parent="#paymentMethod">
                                            <div class="card-body">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div> -->
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="payment-note">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                                    <button class="btn btn-dark btn-outline-hover-dark" id="PlaceOrderbtn">place order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>

            </div>
        </div>
        <!-- Checkout Section End -->

        <!-- Footer -->
        <?php require("includes/footer.php") ?>

        <!-- Modal -->
        <?php require("includes/quick-veiw.php") ?>


        <!-- JS
============================================ -->

        <?php require("includes/js.php") ?>
    </div>
    <script>
        (function() {
            var loaderText = document.getElementById("loading-msg");
            var refreshIntervalId = setInterval(function() {
                loaderText.innerHTML = getLoadingText();
            }, 2500);

            function getLoadingText() {
                var strLoadingText;
                var arrLoadingText = ["placing an order", "make a request", "placing your order", "make one request", "sending email ...", "Please wait"];
                var rand = Math.floor(Math.random() * arrLoadingText.length);
                return arrLoadingText[rand];
            }
        })();
    </script>
</body>

</html>