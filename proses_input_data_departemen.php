<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Assuming your table has columns named nik, password, nama, role, and level
$kode_departemen = $_POST['kode_departemen'];
$departemen = $_POST['departemen'];

// Create a prepared statement
$stmt = $konek->prepare("INSERT INTO dept (kode_departemen, departemen) VALUES (?, ?)");

// Bind the parameters
$stmt->bind_param("ss", $kode_departemen, $departemen);

// Execute the statement
if ($stmt->execute()) {
    header("location: master_departemen.php", true, 301);
    exit();
} else {
    echo "Proses input gagal!";
}

$stmt->close();
$konek->close();
?>
