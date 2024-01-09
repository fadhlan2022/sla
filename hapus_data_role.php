<?php
include 'level_2.php';
include 'koneksi.php';

$kode_role = $_GET['kode_role'];

$query = mysqli_query($konek, "DELETE FROM role WHERE kode_role='$kode_role'");

if ($query) {
    header("location: master_role.php", true, 301);
} else {
    echo "Data gagal dihapus!";
}
exit(0);
