<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$kode_proses = $_POST['kode_proses'];
$nama_proses = $_POST['nama_proses'];

// Create a prepared statement for updating the user
$stmt = $konek->prepare("UPDATE master_status_proses SET nama_proses=? WHERE kode_proses=?");

// Bind the parameters
$stmt->bind_param("ss", $nama_proses, $kode_proses);

// Execute the statement
if ($stmt->execute()) {
    header("location: master_status_proses.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt->close();
$konek->close();
?>
