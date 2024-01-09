<?php
session_start();
include "koneksi.php";

$nik = $_POST['nik'];
$password = $_POST['password'];

$login = mysqli_query($konek, "SELECT * FROM user WHERE nik = '$nik' AND password = '$password'")
    or die(mysqli_error($konek));

$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    // Simpan hasil query dalam variabel dalam sesi
    $_SESSION['user_data'] = $data;

    if ($data['level'] == "1") {
        $_SESSION['nik'] = $nik;
        $_SESSION['password'] = $password;

        // Hapus cookie
        setcookie("nama_cookie", "", time() - 3600, "/");

        // Bersihkan cache
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        header("location: index.php?pesan=Login_Success", true, 301);
    } else if ($data['level'] == "2") {
        $_SESSION['nik'] = $nik;
        $_SESSION['password'] = $password;

        // Hapus cookie
        setcookie("nama_cookie", "", time() - 3600, "/");

        // Bersihkan cache
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        header("location: index.php?pesan=Login_Success", true, 301);
    } else {
        header("location: login.php?pesan=gagal", true, 301);
    }
} else {
    header("location: login.php?pesan=gagal", true, 301);
}
?>
