<?php
include 'level_2.php';
include 'koneksi.php';

$kode_trs = $_GET['kode_trs'];

$query = mysqli_query($konek, "DELETE FROM log_trs WHERE kode_trs='$kode_trs'");

if ($query) {
    header("location: log_trs.php", true, 301);
} else {
    echo "Data gagal dihapus!";
}
exit(0);
