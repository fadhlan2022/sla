<?php
include "koneksi.php";
session_start();
$nik = $_SESSION['nik'];
$password = $_SESSION['password'];
$login = mysqli_query($konek, "SELECT * FROM user WHERE nik = '$nik' AND password = '$password'")
    or die(mysqli_error($konek));

$cek = mysqli_num_rows($login);
$data = mysqli_fetch_assoc($login);
if (empty($_SESSION['nik'])) {
    header("location: login.php?pesan=belum_login", true, 301);
}

$allowed_levels = array("1", "2");
if (!in_array($data['level'], $allowed_levels)) {
    header("location: kick.php?pesan=anda tidak memiliki hak akses", true, 301);
}
?>
