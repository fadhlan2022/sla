<?php
include 'level_1.php';
include 'koneksi.php';
include 'get.php';

date_default_timezone_set('Asia/Jakarta');

// Validate and sanitize user inputs
$kode_trs = $_POST['kode_trs'];
$kode_project = $_POST['kode_project'];
$nik = $_POST['nik'];
$kode_role = $_POST['kode_role'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$kode_proses = $_POST['kode_proses'];
$next_proses = $_POST['next_proses'];

// Get values for $pic_user, $pic_hcsa, $pic_itScrum, $pic_itDev, $pic_itGm, and $pic_itQa from the master_project table
$select_project_query = "SELECT pic_user, pic_hcsa, pic_itScrum, pic_itDev, pic_itGm, pic_itQa FROM master_project WHERE kode_project = ?";
$stmt_select_project = $konek->prepare($select_project_query);
$stmt_select_project->bind_param("s", $kode_project);
$stmt_select_project->execute();
$stmt_select_project->bind_result($pic_user, $pic_hcsa, $pic_itScrum, $pic_itDev, $pic_itGm, $pic_itQa);
$stmt_select_project->fetch();
$stmt_select_project->close();

// Inisialisasi $flag berdasarkan nilai $next_user
if (empty($next_user)){
    $flag = 8;
} elseif($next_user == $pic_hcsa) {
    $flag = 1;
} elseif ($next_user == $pic_user) {
    $flag = 2;
} elseif ($next_user == $pic_itScrum) {
    $flag = 3;
} elseif ($next_user == $pic_itGm) {
    $flag = 4;
} elseif ($next_user == $pic_itDev) {
    $flag = 5;
} elseif ($next_user == $pic_itRoll) {
    $flag = 7;
} else {
    // Menentukan nilai default jika $next_user tidak cocok dengan nilai yang diharapkan
    $flag = 0; // Nilai default
}

// Create a prepared statement for insertion
$insert_query = "INSERT INTO log_trs (kode_trs, kode_project, nik, kode_role, start_date, end_date, kode_proses, next_proses, sla_itRoll) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $konek->prepare($insert_query);

// Hitung SLA
$start = strtotime($start_date);
$end = strtotime($end_date);

function countLibur($sdate, $edate, $konek) {
    $liburCount = 0;

    // Ganti 'tanggal' dan 'master_date' sesuai dengan nama kolom dan tabel Anda
    $date_libur_query = "SELECT COUNT(*) FROM master_date WHERE date_libur BETWEEN ? AND ?"; 
    $date_libur_stmt = $konek->prepare($date_libur_query);
    $date_libur_stmt->bind_param("ss", $sdate, $edate);
    $date_libur_stmt->execute();
    $date_libur_stmt->bind_result($liburCount);
    $date_libur_stmt->fetch();
    $date_libur_stmt->close();

    return $liburCount;
}

function countWeekendDays($start, $end){
    $iter = 24*60*60; // Satu hari dalam detik
    $weekendCount = 0; // Menyimpan jumlah Sabtu & Minggu

    for($i = $start; $i <= $end; $i += $iter) {
        if (date('D', $i) == 'Sat' || date('D', $i) == 'Sun') {
            $weekendCount++;
        }
    }

    return $weekendCount;
}

$libur = countLibur($start_date, $end_date, $konek);
$weekend = countWeekendDays($start, $end);

// Hitung SLA
function hitungSLA($start_date, $end_date, $libur, $weekend) {
    if (!$start_date || !$end_date) {
        return ''; // Return an empty string if start_date or end_date is not available
    }

    // Mengubah tanggal ke objek DateTime
    $start_datetime = new DateTime($start_date);
    $end_datetime = new DateTime($end_date);

    // Menghitung selisih dalam hari
    $interval = $start_datetime->diff($end_datetime);
    $totalDays = $interval->days;

    // Kurangi jumlah hari libur (weekends) dan tambahkan satu hari jika start_date adalah Sabtu
    $sla_hari = $totalDays - $libur - $weekend + '1';
    if ($start_datetime->format('D') == 'Sat') {
        $sla_hari += 1;
    }

    return $sla_hari;
}

$sla_itRoll = hitungSLA($start_date, $end_date, $libur, $weekend);

// Bind the parameters
$stmt->bind_param("sssssssss", $kode_trs, $kode_project, $nik, $kode_role, $start_date, $end_date, $kode_proses, $next_proses, $sla_itRoll);

if ($stmt->execute()) {

    // Get the current value of sla_itRoll from master_project
    $select_current_sla_query = "SELECT sla_itRoll FROM master_project WHERE kode_project = ?";
    $stmt_select_current_sla = $konek->prepare($select_current_sla_query);
    $stmt_select_current_sla->bind_param("s", $kode_project);
    $stmt_select_current_sla->execute();
    $stmt_select_current_sla->bind_result($current_sla);
    $stmt_select_current_sla->fetch();
    $stmt_select_current_sla->close();
    
    // Calculate the new value of sla_itRoll by adding the current value and the new sla_itRoll
    $new_sla_itRoll = $current_sla + $sla_itRoll;
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
        $kode_proses = 'P0009';
        break;

        default:
        $kode_proses = 'P0009';
        break;
    }
    // Create a prepared statement for updating the user
    $stmt_update = $konek->prepare("UPDATE master_project SET sla_itRoll = ?, flag = ?, kode_proses = ? WHERE kode_project = ?");
    
    // Bind the parameters for updating
    $stmt_update->bind_param("ssss", $new_sla_itRoll, $flag, $kode_proses, $kode_project);
    
    // Execute the statement
    if ($stmt_update->execute()) {
        header("location: index.php");
        exit();
    } else {
        echo "Proses input gagal!";
    }

} else {
    echo "Proses update gagal!";
}

$stmt->close();
$konek->close();
?>
