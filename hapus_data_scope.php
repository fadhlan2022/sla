<?php
include 'level_2.php';
include 'koneksi.php';

$kode_scope = $_GET['kode_scope'];

$query = mysqli_query($konek, "DELETE FROM master_scope WHERE kode_scope='$kode_scope'");

if ($query) {
    header("location: master_scope.php", true, 301);
} else {
    echo "Data gagal dihapus!";
}
exit(0);
