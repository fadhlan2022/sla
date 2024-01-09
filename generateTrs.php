<?php  
function generateKodeTrs($lastKodeTrs)
{
    $lastKodeTrsNumber = (int)substr($lastKodeTrs, 1);
    $nextNumber = $lastKodeTrsNumber + 1;
    $nextKodeTrs = 'T' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    return $nextKodeTrs;
}

// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "sla";

// Create a connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the last kode_role from the database
$sql = "SELECT MAX(kode_trs) AS last_kode_trs FROM log_trs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastKodeTrs = $row["last_kode_trs"];

    if ($lastKodeTrs !== null) {
        // If there's a previous kode_trs, increment it for the next one
        $nextKodeTrs = generateKodeTrs($lastKodeTrs);
    } else {
        // If there's no kode_trs in the database, start from T0001
        $nextKodeTrs = 'T0001';
    }
} else {
    // If there's no kode_trs in the database, start from T0001
    $nextKodeTrs = 'T0001';
}

$nextKodeTrs = generateKodeTrs($lastKodeTrs);
?>