<?php
include 'level_1.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$sla_user = $_POST['sla_user'];
$kode_project = $_POST['kode_project'];

// Create a prepared statement for updating the user
$stmt = $konek->prepare("UPDATE log_trs SET sla_user=? WHERE kode_project=?");

// Bind the parameters
$stmt->bind_param("ss", $sla_user, $kode_project);

// Execute the statement
if ($stmt->execute()) {
    header("location: index.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt->close();
$konek->close();
?>
