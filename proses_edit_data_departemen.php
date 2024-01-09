<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$kode_departemen = $_POST['kode_departemen'];
$departemen = $_POST['departemen'];

// Create a prepared statement for updating the user
$stmt = $konek->prepare("UPDATE dept SET departemen=? WHERE kode_departemen=?");

// Bind the parameters
$stmt->bind_param("ss", $departemen, $kode_departemen);

// Execute the statement
if ($stmt->execute()) {
    header("location: master_departemen.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt->close();
$konek->close();
?>
