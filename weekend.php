<!-- Weekend & tgl merah exception -->
<?php
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$start = strtotime($start_date);
$end = strtotime($end_date);

function countWeekendDays($start, $end){
    $iter = 24*60*60; // Satu hari dalam detik
    $weekendCount = 0; // Menyimpan jumlah Sabtu & Minggu

    for($i = $start; $i <= $end; $i = $i + $iter) {
        if (date('D', $i) == 'Sat' || date('D', $i) == 'Sun') {
            $weekendCount++;
        }
    }

    return $weekendCount;
}
$libur = countWeekendDays($start, $end);
?>