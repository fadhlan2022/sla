<?php
include 'level_2.php';
include 'koneksi.php';

$kode_departemen = $_GET['kode_departemen'];

$query = mysqli_query($konek, "DELETE FROM dept WHERE kode_departemen='$kode_departemen'");

if ($query) {
    header("location: master_departemen.php", true, 301);
} else {
    echo "Data gagal dihapus!";
}
exit(0);
