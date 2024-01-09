<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$kode_role = $_POST['kode_role'];
$nama_role = $_POST['nama_role'];

// Create a prepared statement for updating the user
$stmt = $konek->prepare("UPDATE role SET nama_role=? WHERE kode_role=?");

// Bind the parameters
$stmt->bind_param("ss", $nama_role, $kode_role);

// Execute the statement
if ($stmt->execute()) {
    header("location: master_role.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt->close();
$konek->close();
?>
