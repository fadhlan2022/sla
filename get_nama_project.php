<?php
// get_nama_project.php
include 'koneksi.php'; // Sertakan file koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeProject = $_POST['kode_project'];

    $query = "SELECT nama_project FROM master_project WHERE kode_project = '$kodeProject'";
    $result = mysqli_query($konek, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            echo json_encode(["success" => true, "nama_project" => $row['nama_project']]);
        } else {
            echo json_encode(["success" => false, "nama_project" => ""]);
        }
    } else {
        echo json_encode(["success" => false, "nama_project" => ""]);
    }
}
?>
