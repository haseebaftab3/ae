<?php
// !!For Server
// $username = "HaseebAftab3";
// $password = "Helloworld123@";
// $host     = "localhost";
// $dbname   = "Abid_Site_Data";

// $connection = mysqli_connect($host, $username, $password, $dbname);

// if (!$connection) {
//     header("Location:404.php");
// }

// !!For Localhost
$username = "root";
$password = "";
$host     = "localhost";
$dbname   = "ae";

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection) {
    header("Location:404.php");
}

