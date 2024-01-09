<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$nik = $_POST['nik'];
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
$kode_role = $_POST['kode_role'];
$level = $_POST['level'];
$kode_departemen = $_POST['kode_departemen'];

// Create a prepared statement for updating the user
$stmt = $konek->prepare("UPDATE user SET password=?, nama=?, kode_role=?, kode_departemen=?, level=? WHERE nik=?");

// Bind the parameters
$stmt->bind_param("ssssss", $password, $nama, $kode_role, $kode_departemen, $level, $nik);

// Execute the statement
if ($stmt->execute()) {
    header("location: user.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt->close();
$konek->close();
?>
