<?php
// Collecting data from database
$query = "SELECT * FROM user WHERE nik = '$nik' "; // Sesuaikan dengan query Anda
$result = $konek->query($query);

if ($result->num_rows > 0) {
    // Ambil data dari hasil query
    $row = $result->fetch_assoc();
    $nik = $row['nik'];
    $nama = $row['nama'];
    $password = $row['password'];
    $level = $row['level'];
} else {
    $nik = "NIK Tidak Tersedia";
    $nama = "Nama Tidak Tersedia";
    $password = "Password Tidak Tersedia";
    $level = "Level Tidak Tersedia";
}

// $konek->close();
?>
