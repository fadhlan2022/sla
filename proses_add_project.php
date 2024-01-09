<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Retrieve NIK from the session (assuming you've set it in the session)
session_start(); // Start the session if not already started
$nik = $_SESSION['nik'];

// Validate and sanitize user inputs
$nik = $_POST['nik'];
$kode_project = $_POST['kode_project'];
$nama_project = isset($_POST['nama_project']) ? htmlspecialchars($_POST['nama_project']) : '';
$kode_departemen = $_POST['kode_departemen'];
$kode_scope = $_POST['kode_scope'];
$start_date = $_POST['start_date'];
$pic_hcsa = isset($_POST['pic_hcsa']) ? htmlspecialchars($_POST['pic_hcsa']) : '';
$pic_user = isset($_POST['pic_user']) ? htmlspecialchars($_POST['pic_user']) : '';
$pic_itScrum = isset($_POST['pic_itScrum']) ? htmlspecialchars($_POST['pic_itScrum']) : '';
$pic_itGm = isset($_POST['pic_itGm']) ? htmlspecialchars($_POST['pic_itGm']) : '';
$pic_itDev = isset($_POST['pic_itDev']) ? htmlspecialchars($_POST['pic_itDev']) : '';
$pic_itQa = isset($_POST['pic_itQa']) ? htmlspecialchars($_POST['pic_itQa']) : '';
$pic_itRoll = isset($_POST['pic_itRoll']) ? htmlspecialchars($_POST['pic_itRoll']) : '';
$kode_proses = $_POST['kode_proses'];

// Check if kode_project or nama_project already exists
$check_query = "SELECT COUNT(*) FROM master_project WHERE kode_project = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("s", $kode_project);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('Kode Project sudah terdaftar.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $insert_query = "INSERT INTO master_project (nik, kode_project, kode_proses, nama_project, kode_departemen, kode_scope, start_date, pic_hcsa, pic_user, pic_itScrum, pic_itGm, pic_itDev, pic_itQa, pic_itRoll) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $konek->prepare($insert_query);
    
    // Bind the parameters
    $stmt->bind_param("ssssssssssssss", $nik, $kode_project, $kode_proses, $nama_project, $kode_departemen, $kode_scope, $start_date, $pic_hcsa, $pic_user, $pic_itScrum, $pic_itGm, $pic_itDev, $pic_itQa, $pic_itRoll);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: index.php", true, 301);
        exit();
    } else {
        echo "Proses input gagal!";
    }
    
    $stmt->close();
    
}

$konek->close();
?>
