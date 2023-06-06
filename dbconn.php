<?php

$sname = "localhost";
$uname = "root";
$password = "";// papalit ako kung ano yung password sa inyo
$db_name = "e_hotel";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
