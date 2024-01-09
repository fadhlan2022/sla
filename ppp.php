<?php
// Include your database connection code here
include 'koneksi.php';

// Include the PhpSpreadsheet library
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Get the selected project code from the form
$selectedProjectCode = $_POST['kode_project'];

// Fetch data from the master_project table
$query = "SELECT * FROM master_project WHERE kode_project = '$selectedProjectCode'";
$projectResult = mysqli_query($konek, $query);
$projectData = mysqli_fetch_assoc($projectResult);

// Fetch data from the log_trs table
$query = "SELECT * FROM log_trs WHERE kode_project = '$selectedProjectCode'";
$logResult = mysqli_query($konek, $query);

// Create a filename for the report
$filename = 'report_' . $selectedProjectCode . '.xlsx';


// Create a new PHPExcel spreadsheet
$spreadsheet = new Spreadsheet();

// Create a worksheet
$worksheet = $spreadsheet->getActiveSheet();

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
$cellH4->setValue('Kode Project : ' . $projectData['kode_project']);
$cellH4->getStyle()->getFont()->setBold(false);
$cellH4->getStyle()->getFont()->setSize(12);

$worksheet->mergeCells('A5:O5');
$cellH5 = $worksheet->getCell('A5');
$cellH5->setValue('Nama Project : ' . $projectData['nama_project']);
$cellH5->getStyle()->getFont()->setBold(false);
$cellH5->getStyle()->getFont()->setSize(12);

$worksheet->setCellValue('A7', 'Start Project');
$worksheet->setCellValue('B7', 'Kode Project');
$worksheet->setCellValue('C7', 'Nama Project');
$worksheet->setCellValue('D7', 'Kode Proses');
$worksheet->setCellValue('E7', 'Proses');
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

// Fetch data and place it in cells
$worksheet->setCellValue('A8', $projectData['start_date']);
$worksheet->setCellValue('B8', $projectData['kode_project']);
$worksheet->setCellValue('C8', $projectData['nama_project']);

// Fetch 'kode_proses' and place it in cell E8
$kodeProsesQuery = "SELECT kode_proses FROM log_trs WHERE kode_project = '$selectedProjectCode' LIMIT 1";
$kodeProsesResult = mysqli_query($konek, $kodeProsesQuery);

if ($kodeProsesResult) {
    $kodeProsesData = mysqli_fetch_assoc($kodeProsesResult);
    if ($kodeProsesData) {
        $worksheet->setCellValue('D8', $kodeProsesData['kode_proses']);
    } else {
        // Set a default value or handle this case as needed
        $worksheet->setCellValue('D8', 'No Data');
    }
} else {
    // Handle query error, e.g., log it or set a default value
    $worksheet->setCellValue('D8', 'Query Error');
}


// Set cell alignment
$cellRange = 'A2:O5';
$worksheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$worksheet->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

// Set cell labels to wrap text
$worksheet->getStyle($cellRange)->getAlignment()->setWrapText(true);

// Add other data

// Auto-size column width to fit content
foreach (range('A', 'O') as $column) {
    $worksheet->getColumnDimension($column)->setAutoSize(true);
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

$projectResult = mysqli_query($konek, $query);
$projectData = mysqli_fetch_assoc($projectResult);