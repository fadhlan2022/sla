<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Retrieve NIK from the session (assuming you've set it in the session)
session_start(); // Start the session if not already started
$nik = $_SESSION['nik'];

// Validate and sanitize user inputs
$kode_project = isset($_POST['kode_project']) ? htmlspecialchars($_POST['kode_project']) : '';
$nama_project = isset($_POST['nama_project']) ? htmlspecialchars($_POST['nama_project']) : '';
$start_date = date('Y-m-d H:i:s');  // Assuming start_date should be the current date and time

// Check if kode_project or nama_project already exists
$check_query = "SELECT COUNT(*) FROM master_project WHERE kode_project = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("s", $kode_project);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('Kode Project sudah terdaftar.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $insert_query = "INSERT INTO master_project (kode_project, nama_project, nik) VALUES (?, ?, ?)";
    $stmt = $konek->prepare($insert_query);

    // Bind the parameters
    $stmt->bind_param("sss", $kode_project, $nama_project, $nik);

    // Execute the statement
    if ($stmt->execute()) {
        // Insert into log_trs
        $insert_log_query = "INSERT INTO log_trs (start_date) VALUES (?)";
        $stmt_log = $konek->prepare($insert_log_query);
        $stmt_log->bind_param("s", $start_date);
        $stmt_log->execute();
        $stmt_log->close();

        header("location: index.php");
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt->close();
}

$konek->close();
?>
----
<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// Retrieve NIK from the session (assuming you've set it in the session)
session_start(); // Start the session if not already started
$nik = $_SESSION['nik'];

// Validate and sanitize user inputs
$kode_project = isset($_POST['kode_project']) ? htmlspecialchars($_POST['kode_project']) : '';
$nama_project = isset($_POST['nama_project']) ? htmlspecialchars($_POST['nama_project']) : '';
$start_date = date('Y-m-d H:i:s');  // Assuming start_date should be the current date and time

// Check if kode_project or nama_project already exists
$check_query = "SELECT COUNT(*) FROM master_project WHERE kode_project = ?";
$check_stmt = $konek->prepare($check_query);
$check_stmt->bind_param("s", $kode_project);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    echo "<script>alert('Kode Role atau Nama Role sudah ada.'); history.go(-1);</script>";
} else {
    // Create a prepared statement for insertion
    $stmt = $konek->prepare("INSERT INTO role (kode_role, nama_role) VALUES (?, ?)");

    // Bind the parameters
    $stmt->bind_param("ss", $kode_role, $nama_role);

    // Execute the statement
    if ($stmt->execute()) {
        header("location: master_role.php", true, 301);
        exit();
    } else {
        echo "Proses input gagal!";
    }

    $stmt->close();
}

$konek->close();
?>
