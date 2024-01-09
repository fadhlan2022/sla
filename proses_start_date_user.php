<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Validate and sanitize user inputs
$kode_trs = $_POST['kode_trs'];
$kode_project = $_POST['kode_project'];
$nik = $_POST['nik'];
$kode_role = $_POST['kode_role'];
$start_date = $_POST['start_date'];

// Create a prepared statement for insertion
$insert_query = "INSERT INTO log_trs (kode_trs, kode_project, nik, kode_role, start_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $konek->prepare($insert_query);

// Bind the parameters
$stmt->bind_param("sssss", $nik, $kode_trs, $kode_project, $kode_role, $start_date);

// Execute the statement
if ($stmt->execute()) {
    header("location: index.php");
    exit();
} else {
    echo "Proses input gagal!";
}

$stmt->close();
$konek->close();
?>
