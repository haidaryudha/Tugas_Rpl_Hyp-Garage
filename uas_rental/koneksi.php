<?php
session_start(); 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_rental";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>