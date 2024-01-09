<!-- Weekend & tgl merah exception -->
<?php
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';

$start = strtotime($start_date);
$end = strtotime($end_date);

function countLibur($sdate, $edate, $konek){
  $liburCount = 0;

  // Query untuk mengambil jumlah $date_libur dari tabel master_date
  $date_libur_query = "SELECT COUNT(*) FROM master_date WHERE tanggal BETWEEN ? AND ?"; // Sesuaikan dengan struktur tabel Anda
  $date_libur_stmt = $konek->prepare($date_libur_query);
  $date_libur_stmt->bind_param("ss", $sdate, $edate);
  $date_libur_stmt->execute();
  $date_libur_stmt->bind_result($liburCount);
  $date_libur_stmt->fetch();
  $date_libur_stmt->close();

  return $liburCount;
}

function countWeekendDays($start, $end){
    $iter = 24*60*60; // Satu hari dalam detik
    $weekendCount = 0; // Menyimpan jumlah Sabtu & Minggu

    for($i = $start; $i <= $end; $i += $iter) {
        if (date('D', $i) == 'Sat' || date('D', $i) == 'Sun') {
            $weekendCount++;
        }
    }

    return $weekendCount;
}

$libur = countLibur($start_date, $end_date, $konek);
$weekend = countWeekendDays($start, $end);
?>
<!-- SLA COUNT -->
<?php

function hitungSLA($start_date, $end_date, $libur, $weekend) {
  if (!$start_date || !$end_date) {
    return ''; // Return an empty string if start_date or end_date is not available
  }

  // Mengubah tanggal ke objek DateTime
  $start_datetime = new DateTime($start_date);
  $end_datetime = new DateTime($end_date);

  // Menghitung selisih dalam hari
  $interval = $start_datetime->diff($end_datetime);
  $totalDays = $interval->days;

  // Kurangi jumlah hari libur (weekends) dan tambahkan satu hari jika start_date adalah Sabtu
  $sla_hari = $totalDays - $libur - $weekend;
  if ($start_datetime->format('D') == 'Sat') {
    $sla_hari += 1;
  }

  return $sla_hari;
}

$sla = hitungSLA($start_date, $end_date, $libur, $weekend);
?>
