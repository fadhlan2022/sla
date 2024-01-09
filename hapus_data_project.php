<?php
include 'level_2.php';
include 'koneksi.php';

$kode_project = $_GET['kode_project'];

// Delete from master_project table
$query_master_project = mysqli_query($konek, "DELETE FROM master_project WHERE kode_project='$kode_project'");

// Delete from tabel_log table
$query_tabel_log = mysqli_query($konek, "DELETE FROM log_trs WHERE kode_project='$kode_project'");

if ($query_master_project && $query_tabel_log) {
    header("location: index.php", true, 301);
} else {
    echo "Data gagal dihapus!";
}

exit(0);
?>
