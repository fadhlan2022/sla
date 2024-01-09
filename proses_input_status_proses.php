<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$kode_proses = $_POST['kode_proses'];
$nama_proses = $_POST['nama_proses'];

// Check if kode_role or kode_departemen already exists
$check_query = "SELECT COUNT(*) FROM master_status_proses WHERE kode_proses = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("s", $kode_proses);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('Kode Proses atau Nama Proses sudah ada.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $stmt = $konek->prepare("INSERT INTO master_status_proses (kode_proses, nama_proses) VALUES (?, ?)");

    // Bind the parameters
    $stmt->bind_param("ss", $kode_proses, $nama_proses);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: master_status_proses.php", true, 301);
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt->close();
}

$konek->close();
?>
