<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Validate and sanitize user inputs
$kode_project = $_POST['kode_project'];
$kode_project2 = $_POST['kode_project2'];
$pic_hcsa = isset($_POST['pic_hcsa']) ? htmlspecialchars($_POST['pic_hcsa']) : '';
$pic_user = isset($_POST['pic_user']) ? htmlspecialchars($_POST['pic_user']) : '';
$pic_itScrum = isset($_POST['pic_itScrum']) ? htmlspecialchars($_POST['pic_itScrum']) : '';
$pic_itGm = isset($_POST['pic_itGm']) ? htmlspecialchars($_POST['pic_itGm']) : '';
$pic_itDev = isset($_POST['pic_itDev']) ? htmlspecialchars($_POST['pic_itDev']) : '';
$pic_itQa = isset($_POST['pic_itQa']) ? htmlspecialchars($_POST['pic_itQa']) : '';
$pic_itRoll = isset($_POST['pic_itRoll']) ? htmlspecialchars($_POST['pic_itRoll']) : '';

// Create a prepared statement for updating the user
$stmt_update = $konek->prepare("UPDATE master_project SET kode_project2=?, pic_hcsa=?, pic_user=?, pic_itScrum=?, pic_itGm=?, pic_itDev=?, pic_itQa=?, pic_itRoll=? WHERE kode_project=?");

// Bind the parameters for updating
$stmt_update->bind_param("sssssssss", $kode_project2, $pic_hcsa, $pic_user, $pic_itScrum, $pic_itGm, $pic_itDev, $pic_itQa, $pic_itRoll, $kode_project);

if ($stmt_update->execute()) {
    header("location: index.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt_update->close();
$konek->close();


?>
