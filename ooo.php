<?php
// Include your database connection code here
include 'koneksi.php';

// Include the PhpSpreadsheet library
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Get the selected project code from the form
$selectedProjectCode = $_POST['kode_project'];

// Create a filename for the report
$filename = 'report_' . $selectedProjectCode . '.xlsx';

// Create a new PhpSpreadsheet spreadsheet
$spreadsheet = new Spreadsheet();


// Fetch data from the database
$query = "SELECT 
    master_project.start_date AS mp_start_date,
    master_project.nama_project AS mp_nama_project,
    log_trs.kode_project AS log_kode_project,
    log_trs.kode_proses AS log_kode_proses,
    master_status_proses.nama_proses AS msp_nama_proses,
    log_trs.nik AS log_nik,
    user.nama AS user_nama,
    role.nama_role AS role_nama_role,
    log_trs.end_date AS log_end_date,
    log_trs.start_date AS log_start_date,
    log_trs.end_date AS log_end_date,
    master_scope.nama_scope AS ms_nama_scope
FROM log_trs
LEFT JOIN master_project ON log_trs.kode_project = master_project.kode_project
LEFT JOIN user ON log_trs.nik = user.nik
LEFT JOIN role ON log_trs.kode_role = role.kode_role
LEFT JOIN master_status_proses ON log_trs.kode_proses = master_status_proses.kode_proses
LEFT JOIN master_scope ON master_project.kode_scope = master_scope.kode_scope
WHERE log_trs.kode_project = '$selectedProjectCode'";

$projectResult = mysqli_query($konek, $query);

// Check if there are any rows returned from the query
if (mysqli_num_rows($projectResult) > 0) {
    // Create a new worksheet
    $worksheet = $spreadsheet->getActiveSheet();

    // Set up headers
    $worksheet->setCellValue('A7', 'Start Project');
    $worksheet->setCellValue('B7', 'Kode Project');
    $worksheet->setCellValue('C7', 'Nama Project');
    $worksheet->setCellValue('D7', 'Kode Proses');
    $worksheet->setCellValue('E7', 'Proses' + 1);
    $worksheet->setCellValue('F7', 'Scope');
    $worksheet->setCellValue('G7', 'NIK');
    $worksheet->setCellValue('H7', 'Nama User');
    $worksheet->setCellValue('I7', 'Role');
    $worksheet->setCellValue('J7', 'Tgl Transaksi');
    $worksheet->setCellValue('K7', 'Start Date');
    $worksheet->setCellValue('L7', 'End Date');
    $worksheet->setCellValue('M7', 'SLA Per User');
    $worksheet->setCellValue('N7', 'STD SLA Per Proses');
    $worksheet->setCellValue('O7', 'SLA Per Proses');

    // Merge cells and set cell labels along with values
    $worksheet->mergeCells('A2:O2');
    $cellH3 = $worksheet->getCell('A2');
    $cellH3->setValue('REPORT SLA');
    $cellH3->getStyle()->getFont()->setBold(false);
    $cellH3->getStyle()->getFont()->setSize(12);

    $worksheet->mergeCells('A3:O3');
    $cellH3 = $worksheet->getCell('A3');
    $cellH3->setValue('PT. SUMBER ALFARIA TRIJAYA Tbk.');
    $cellH3->getStyle()->getFont()->setBold(true);
    $cellH3->getStyle()->getFont()->setSize(14);

    $worksheet->mergeCells('A4:O4');
    $cellH4 = $worksheet->getCell('A4');
    $cellH4->setValue('Kode Project : ' . $selectedProjectCode); // Update with the selected project code
    $cellH4->getStyle()->getFont()->setBold(false);
    $cellH4->getStyle()->getFont()->setSize(12);

    $worksheet->mergeCells('A5:O5');
    $cellH5 = $worksheet->getCell('A5');
    $cellH5->setValue('Nama Project : ' . 'Your Project Name'); // Update with the project name from your data
    $cellH5->getStyle()->getFont()->setBold(false);
    $cellH5->getStyle()->getFont()->setSize(12);

    // Fetch data and place it in cells
    $row = 8; // Start from the second row
    while ($data = mysqli_fetch_assoc($projectResult)) {
        $worksheet->setCellValue('A' . $row, $data['mp_start_date']);
        $worksheet->setCellValue('B' . $row, $data['log_kode_project']);
        $worksheet->setCellValue('C' . $row, $data['mp_nama_project']);
        $worksheet->setCellValue('D' . $row, $data['log_kode_proses']);
        $worksheet->setCellValue('E' . $row, $data['msp_nama_proses']);
        $worksheet->setCellValue('F' . $row, $data['ms_nama_scope']);
        $worksheet->setCellValue('G' . $row, $data['log_nik']);
        $worksheet->setCellValue('H' . $row, $data['user_nama']);
        $worksheet->setCellValue('I' . $row, $data['role_nama_role']);
        $worksheet->setCellValue('J' . $row, $data['log_end_date']);
        $worksheet->setCellValue('K' . $row, $data['log_start_date']);
        $worksheet->setCellValue('L' . $row, $data['log_end_date']);

        $row++; // Increment row for the next data
    }

    // Set cell alignment
    $cellRange = 'A2:O5';
    $worksheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $worksheet->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
    // Set cell labels to wrap text
    $worksheet->getStyle($cellRange)->getAlignment()->setWrapText(true);

    // Auto-size column width to fit content
    foreach (range('A', 'K') as $column) {
        $worksheet->getColumnDimension($column)->setAutoSize(true);
    }
}

// Save the Excel file
$writer = new Xlsx($spreadsheet);

// Set the HTTP response headers to indicate an XLSX download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Output the XLSX file
$writer->save('php://output');

// Close the database connection
mysqli_close($konek);
?>
