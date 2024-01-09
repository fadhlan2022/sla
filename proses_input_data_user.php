<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Validate and sanitize user inputs
$nik = $_POST['nik'];
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
$kode_role = $_POST['kode_role'];
$level = $_POST['level'];
$kode_departemen = $_POST['kode_departemen'];

// Check if nik or nama already exists
$check_query = "SELECT COUNT(*) FROM user WHERE nik = ? OR nama = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("ss", $nik, $nama);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('NIK atau Nama Karyawan sudah terdaftar.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $insert_query = "INSERT INTO user (nik, password, nama, kode_role, kode_departemen, level) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $konek->prepare($insert_query);

    // Bind the parameters
    $stmt->bind_param("ssssss", $nik, $password, $nama, $kode_role, $kode_departemen, $level);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: user.php");
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt->close();
}

$konek->close();
?>
