<?php
include 'koneksi.php';

// Ambil kode project dari parameter GET
$kode_project = $_GET['kode_project'];

// Buat kueri SQL untuk mengambil nama PIC
$query = "SELECT user.*, master_project.* FROM master_project 
          LEFT JOIN user ON master_project.nik = user.nik WHERE kode_project = '$kode_project'";
$result = mysqli_query($konek, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);

  // Buat array dengan nama PIC
  $picArray = [
    $row['pic_hcsa'],
    $row['pic_user'],
    $row['pic_itScrum'],
    $row['pic_itGm'],
    $row['pic_itDev'],
    $row['pic_itQa'],
    $row['pic_itRoll']
  ];

  // Generate an HTML table
  echo '<table border="1">';
  echo '<tr><th>PIC Role</th><th>NIK</th><th>PIC Name</th></tr>';
  $picRoles = ['PIC HCSA', 'PIC User', 'PIC IT Scrum', 'PIC IT GM', 'PIC IT Dev', 'PIC IT QA', 'PIC IT Rollout'];
  for ($i = 0; $i < count($picArray); $i++) {
    $picName = getUserName($picArray[$i]);
    echo '<tr>';
    echo '<td>' . $picRoles[$i] . '</td>';
    echo '<td>' . $picArray[$i] . '</td>';
    echo '<td>' . $picName . '</td>';
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo 'Error: ' . mysqli_error($konek);
}

// Function to get user names based on NIK
function getUserName($nik) {
  global $konek;
  $query = mysqli_query($konek, "SELECT nama FROM user WHERE nik = '$nik'");
  $hasil = mysqli_fetch_array($query);

  if ($hasil && !empty($hasil['nama'])) {
    return $hasil['nama'];
  } else {
    return " ";
  }
}

// Tutup koneksi database
mysqli_close($konek);
?>
