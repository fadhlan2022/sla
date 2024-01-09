<?php
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

// Check if kode_role or kode_departemen already exists
$check_query = "SELECT COUNT(*) FROM master_scope WHERE nama_scope = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("s", $nama_scope);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('Nama Scope sudah ada.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $stmt = $konek->prepare("INSERT INTO master_scope (kode_scope, nama_scope, std_sla_konsep, std_sla_sr,
    std_sla_sdonprogress, std_sla_approvalsd, std_sla_dev, std_sla_qa, std_sla_uat, std_sla_to, std_sla_rollout) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("sssssssssss", $kode_scope, $nama_scope, $std_sla_konsep, $std_sla_sr, $std_sla_sdonprogress, $std_sla_approvalsd, $std_sla_dev, $std_sla_qa, $std_sla_uat, $std_sla_to, $std_sla_rollout);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: master_scope.php", true, 301);
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt->close();
}

$konek->close();
?>
