<?php
//Starting Session
session_start();

//unset Session
unset($_SESSION['A_Name']);
unset($_SESSION['A_Pass']);
unset($_SESSION['A_UName']);
unset($_SESSION['A_UserId']);

header("Location:login.php");
