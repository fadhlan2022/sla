<?php
include 'level_2.php';
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$kode_scope = $_POST['kode_scope'];
$nama_scope = $_POST['nama_scope'];
$std_sla_konsep = $_POST['std_sla_konsep'];
$std_sla_sr = $_POST['std_sla_sr'];
$std_sla_sdonprogress = $_POST['std_sla_sdonprogress'];
$std_sla_approvalsd = $_POST['std_sla_approvalsd'];
$std_sla_dev = $_POST['std_sla_dev'];
$std_sla_qa = $_POST['std_sla_qa'];
$std_sla_uat = $_POST['std_sla_uat'];
$std_sla_to = $_POST['std_sla_to'];
$std_sla_rollout = $_POST['std_sla_rollout'];

// Create a prepared statement for updating the user
$stmt = $konek->prepare("UPDATE master_scope SET nama_scope=?, std_sla_konsep=?, std_sla_sr=?, std_sla_sdonprogress=?, std_sla_approvalsd=?, std_sla_dev=?, std_sla_qa=?, std_sla_uat=?, std_sla_to=?, std_sla_rollout=? WHERE kode_scope=?");

// Bind the parameters
$stmt->bind_param("sssssssssss", $nama_scope, $std_sla_konsep, $std_sla_sr, $std_sla_sdonprogress, $std_sla_approvalsd, $std_sla_dev, $std_sla_qa, $std_sla_uat, $std_sla_to, $std_sla_rollout, $kode_scope);

// Execute the statement
if ($stmt->execute()) {
    header("location: master_scope.php", true, 301);
    exit();
} else {
    echo "Data gagal diubah!";
}

$stmt->close();
$konek->close();
?>
