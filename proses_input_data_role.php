<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$kode_role = $_POST['kode_role'];
$nama_role = $_POST['nama_role'];

// Check if kode_role or kode_departemen already exists
$check_query = "SELECT COUNT(*) FROM role WHERE kode_role = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("s", $kode_role);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('Kode Role atau Nama Role sudah ada.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $stmt = $konek->prepare("INSERT INTO role (kode_role, nama_role) VALUES (?, ?)");

    // Bind the parameters
    $stmt->bind_param("ss", $kode_role, $nama_role);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: master_role.php", true, 301);
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt->close();
}

$konek->close();
?>
