<?php
include 'level_2.php';
include 'koneksi.php';

$nik = $_GET['nik'];

$query = mysqli_query($konek, "DELETE FROM user WHERE nik='$nik'");

if ($query) {
    header("location: user.php", true, 301);
} else {
    echo "Data gagal dihapus!";
}
exit(0);
