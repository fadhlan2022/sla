<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Validate and sanitize user inputs
$nik = $_POST['nik'];
$kode_role = $_POST['kode_role'];
$kode_trs = $_POST['kode_trs'];
$kode_project = $_POST['kode_project'];
$nama_project = $_POST['nama_project'];
$kode_proses = $_POST['kode_proses'];
$next_proses = $_POST['next_proses'];
$start_date = $_POST['start_date'];
$next_user = $_POST['next_user'];

// Get values for $pic_user, $pic_itScrum, $pic_itGm, $pic_itDev, $pic_itQa, and $pic_itRoll from the master_project table
$select_project_query = "SELECT pic_user, pic_itScrum, pic_itGm, pic_itDev, pic_itQa, pic_itRoll FROM master_project WHERE kode_project = ?";
$stmt_select_project = $konek->prepare($select_project_query);
$stmt_select_project->bind_param("s", $kode_project);
$stmt_select_project->execute();
$stmt_select_project->bind_result($pic_user, $pic_itScrum, $pic_itGm, $pic_itDev, $pic_itQa, $pic_itRoll);
$stmt_select_project->fetch();
$stmt_select_project->close();

        // Inisialisasi $flag berdasarkan nilai $next_user
        if ($next_user == $pic_user) {
            $flag = 2;
        } elseif ($next_user == $pic_itScrum) {
            $flag = 3;
        } elseif ($next_user == $pic_itGm) {
            $flag = 4;
        } elseif ($next_user == $pic_itDev) {
            $flag = 5;
        } elseif ($next_user == $pic_itQa) {
            $flag = 6;
        } elseif ($next_user == $pic_itRoll) {
            $flag = 7;
        } else {
            // Menentukan nilai default jika $next_user tidak cocok dengan nilai yang diharapkan
            $flag = 0; // Nilai default
        }

$stmt_insert_log = $konek->prepare("INSERT INTO log_trs (kode_trs, kode_project, nik, kode_role, start_date, kode_proses, next_proses, next_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_insert_log->bind_param("ssssssss", $kode_trs, $kode_project, $nik, $kode_role, $start_date, $kode_proses, $next_proses, $next_user);

// Execute the update statement
if ($stmt_insert_log->execute()) {
    switch($next_proses){
        case 'P0001':
        $kode_proses = 'P0001';
        break;

        case 'P0002':
        $kode_proses = 'P0002';
        break;
        
        case 'P0003':
        $kode_proses = 'P0003';
        break;

        case 'P0004':
        $kode_proses = 'P0004';
        break;

        case 'P0005':
        $kode_proses = 'P0005';
        break;
        
        case 'P0006':
        $kode_proses = 'P0006';
        break;

        case 'P0007':
        $kode_proses = 'P0007';
        break;
        
        case 'P0008':
        $kode_proses = 'P0008';
        break;

        case 'P0009':
        $kode_proses = 'P0009';
        break;

        case 'P0010':
        $kode_proses = 'P0010';
        break;
    }

    // Create a prepared statement for updating the user
    $stmt_update = $konek->prepare("UPDATE master_project SET nik=?, nama_project=?, kode_proses=?, flag=? WHERE kode_project=?");

    // Bind the parameters for updating
    $stmt_update->bind_param("sssss", $nik, $nama_project, $kode_proses, $flag, $kode_project);
    if ($stmt_update->execute()) {
        header("location: index.php", true, 301);
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt_insert_log->close();
} else {
    echo "Proses update gagal!";
}

$stmt_update->close();
$konek->close();


?>
