<?php
session_start();

$_SESSION['U_name'] = "";
$_SESSION['U_pass'] = "";
$_SESSION['U_Username'] = "";
$_SESSION['U_UserId'] = "";

header("Location:index.php");
// echo '<script>window.location.reload();</script>';
