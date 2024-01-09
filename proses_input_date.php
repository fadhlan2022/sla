<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Assuming your table has columns named nik, password, nama, role, and level
$kode_date = $_POST['kode_date'];
$date_libur = $_POST['date_libur'];

// Create a prepared statement
$stmt = $konek->prepare("INSERT INTO master_date (kode_date, date_libur) VALUES (?, ?)");

// Bind the parameters
$stmt->bind_param("ss", $kode_date, $date_libur);

// Execute the statement
if ($stmt->execute()) {
    header("location: master_date.php", true, 301);
    exit();
} else {
    echo "Proses input gagal!";
}

$stmt->close();
$konek->close();
?>
