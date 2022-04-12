<!-- Use the minified version files listed below for better performance and remove the files listed above -->
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>

<!-- Main Activation JS -->
<script src="assets/js/main.js" async></script>
<script src="assets/js/script.js"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
</script>
<script src="assets/js/dsn-grid.js"></script>
<script src="assets/js/plugins.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GMRRB4KVYV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-GMRRB4KVYV');
</script>



<!-- // Open Modal After Successfullly Adding Item In cart -->
<?php if (isset($_SESSION["SuccesCartUpPrice"])  && !empty($_SESSION["SuccesCartUpPrice"]) && $_SESSION["SuccesCartUpPrice"] == 1) { ?>
    <script>
        var $body = $("body");
        var $offCanvasToggle = $(".offcanvas-toggle"),
            $offCanvas = $(".offcanvas"),
            $offCanvasOverlay = $(".offcanvas-overlay"),
            $mobileMenuToggle = $(".mobile-menu-toggle");
        // e.preventDefault();
        var $this = $(this),
            $target = $this.attr("href");
        $body.addClass("offcanvas-open");
        $($target).addClass("offcanvas-open");
        $("#offcanvas-cart").addClass("offcanvas-open");
        $offCanvasOverlay.fadeIn();
        if ($this.parent().hasClass("mobile-menu-toggle")) {
            $this.addClass("close");
        }
    </script>
<?php
    $_SESSION["SuccesCartUpPrice"] = 0;
    // echo "<script>alert(" . $_SESSION['SuccesCartUpPrice'] . ")</script>";
}
?>