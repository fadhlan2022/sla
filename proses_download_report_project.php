<?php
// Include your database connection code here
include 'koneksi.php';

// Include the PhpSpreadsheet library
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Get the selected project code from the form
$selectedProjectCode = $_POST['kode_project'];

// var_dump($_POST['kode_project']);
// exit();
if ($selectedProjectCode == 'ALL') {
    $listProject = "SELECT kode_project FROM master_project WHERE 1=1";
    $listProjectResult = mysqli_query($konek, $listProject);
    $stringListKodeProject = "";
    while ($row = mysqli_fetch_array($listProjectResult)){
        $stringListKodeProject .= "'".$row["kode_project"]."',";
    };
    $filename = 'report_ALL.xlsx';
    $selectedProjectCode = substr_replace($stringListKodeProject ,"",-1);
}
else{
    $filename = 'report_' . $selectedProjectCode . '.xlsx';
    $selectedProjectCode = "'".$selectedProjectCode."'";
}

// Create a filename for the report



// Create a new PhpSpreadsheet spreadsheet
$spreadsheet = new Spreadsheet();
 
// Fetch data from the database to get the project name

$projectNameQuery = "SELECT nama_project FROM master_project WHERE kode_project IN ($selectedProjectCode)";
$projectNameResult = mysqli_query($konek, $projectNameQuery);


if (mysqli_num_rows($projectNameResult) > 0) {
    $projectNameData = mysqli_fetch_assoc($projectNameResult);
    $nama_project = $projectNameData['nama_project'];
} else {
    $nama_project = 'Project Name Not Found';
}

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
    master_scope.nama_scope AS ms_nama_scope,
    log_trs.kode_role AS log_kode_role,
    log_trs.sla_user AS log_sla_user,
    log_trs.sla_hcsa AS log_sla_hcsa,
    log_trs.sla_itScrum AS log_sla_itScrum,
    log_trs.sla_itGm AS log_sla_itGm,
    log_trs.sla_itDev AS log_sla_itDev,
    log_trs.sla_itQa AS log_sla_itQa,
    log_trs.sla_itRoll AS log_sla_itRoll,
    master_project.kode_scope AS mp_kode_scope,
    master_scope.std_sla_konsep AS ms_std_sla_konsep,
    master_scope.std_sla_sr AS ms_std_sla_sr,
    master_scope.std_sla_sdonprogress AS ms_std_sla_sdonprogress,
    master_scope.std_sla_approvalsd AS ms_std_sla_approvalsd,
    master_scope.std_sla_dev AS ms_std_sla_dev,
    master_scope.std_sla_qa AS ms_std_sla_qa,
    master_scope.std_sla_uat AS ms_std_sla_uat,
    master_scope.std_sla_to AS ms_std_sla_to,
    master_scope.std_sla_rollout AS ms_std_sla_rollout
FROM log_trs
LEFT JOIN master_project ON log_trs.kode_project = master_project.kode_project
LEFT JOIN user ON log_trs.nik = user.nik
LEFT JOIN role ON log_trs.kode_role = role.kode_role
LEFT JOIN master_status_proses ON log_trs.kode_proses = master_status_proses.kode_proses
LEFT JOIN master_scope ON master_project.kode_scope = master_scope.kode_scope
WHERE log_trs.kode_project IN ($selectedProjectCode)";

$projectResult = mysqli_query($konek, $query);
// while ($row = mysqli_fetch_assoc($projectResult)) {
//     print_r($row);
//     print_r("<br><br>");
//  }
//  exit();

function countDays($selectedProjectCode, $konek, $kode_proses){
    $queryTest = "SELECT SUM(`sla_user`),SUM(`sla_hcsa`),SUM(`sla_itScrum`),SUM(`sla_itGm`),SUM(`sla_itDev`),SUM(`sla_itQa`),SUM(`sla_itRoll`) FROM `log_trs` WHERE `kode_proses` = '$kode_proses' 
    AND kode_project IN ($selectedProjectCode)";
    $queryTestResult = mysqli_query($konek, $queryTest);
    $row = mysqli_fetch_array($queryTestResult);
    $totalSLADays = 0;
    for($i=0;$i<count($row)/2;$i++){
        $totalSLADays += $row[$i];
    }
    return $totalSLADays;
}

// Check if there are any rows returned from the query

if (mysqli_num_rows($projectResult) > 0) {
    // Create a new worksheet
    $worksheet = $spreadsheet->getActiveSheet();

    // Set up headers
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
    $cellH5->setValue('Nama Project : ' . $nama_project); // Use the project name fetched from the database
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
        // if ($previousMspKodeProses !== null) {
        //     $worksheet->setCellValue('D' . $row, $previousMspKodeProses);
        // }
        // $previousMspKodeProses = $data['log_kode_proses'];
        // if ($previousMspNamaProses !== null) {
        //     $worksheet->setCellValue('E' . $row, $previousMspNamaProses);
        // }
        // $previousMspNamaProses = $data['msp_nama_proses'];
        $worksheet->setCellValue('F' . $row, $data['ms_nama_scope']);
        $worksheet->setCellValue('G' . $row, $data['log_nik']);
        $worksheet->setCellValue('H' . $row, $data['user_nama']);
        $worksheet->setCellValue('I' . $row, $data['role_nama_role']);
        $worksheet->setCellValue('J' . $row, $data['log_end_date']);
        $worksheet->setCellValue('K' . $row, $data['log_start_date']);
        $worksheet->setCellValue('L' . $row, $data['log_end_date']);
        switch ($data['log_kode_role']) {
            case 'R0001':
                // $val = $data['log_sla_hcsa'] == 0 ? "" : $data['log_sla_hcsa'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            case 'R0002':
                // $val = $data['log_sla_user'] == 0 ? "" : $data['log_sla_user'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            case 'R0003':
                // $val = $data['log_sla_itScrum'] == 0 ? "" : $data['log_sla_itScrum'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            case 'R0004':
                // $val = $data['log_sla_itGm'] == 0 ? "" : $data['log_sla_itGm'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            case 'R0005':
                // $val = $data['log_sla_itDev'] == 0 ? "" : $data['log_sla_itDev'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            case 'R0006':
                // $val = $data['log_sla_itQa'] == 0 ? "" : $data['log_sla_itQa'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            case 'R0007':
                // $val = $data['log_sla_itRoll'] == 0 ? "" : $data['log_sla_itRoll'] ;
                $val = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] + $data['log_sla_itGm']
                + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'];
                $worksheet->setCellValue('M' . $row, $val);
                break;
            default:
                $val = '';
                // Set a default value or handle it as per your requirement
                $worksheet->setCellValue('M' . $row, $val);
                break;
        }

        switch ($data['mp_kode_scope']) {
            case 'SC001':
            case 'SC002':
            case 'SC003':
                $prosesColumn = [
                    'P0001' => 'ms_std_sla_konsep',
                    'P0002' => 'ms_std_sla_sr',
                    'P0003' => 'ms_std_sla_sdonprogress',
                    'P0004' => 'ms_std_sla_approvalsd',
                    'P0005' => 'ms_std_sla_dev',
                    'P0006' => 'ms_std_sla_qa',
                    'P0007' => 'ms_std_sla_uat',
                    'P0008' => 'ms_std_sla_to',
                    'P0009' => 'ms_std_sla_rollout',
                    'P0010' => 'ms_std_sla_rollout',
                ];
        
                $prosesCode = $data['log_kode_proses'];
                // var_dump ($prosesCode);
                $column = isset($prosesColumn[$prosesCode]) ? $prosesColumn[$prosesCode] : '';
                // var_dump ($column);
                
                $worksheet->setCellValue('N' . $row, $data[$column] ?? '');
                break;
        
            default:
                // Handle the default case as per your requirements
                $worksheet->setCellValue('N' . $row, '');
                break;
        }
        $totalSLA = 0;
        if($data['log_kode_proses'] == 'P0001'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0002'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0003'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0004'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0005'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0006'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0007'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0008'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        elseif($data['log_kode_proses'] == 'P0009'){
            $selectedProjectCode = "'".$data['log_kode_project']."'";
            $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
            // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
            // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        }
        // elseif($data['log_kode_proses'] == 'P0010'){
        //     $selectedProjectCode = "'".$data['log_kode_project']."'";
        //     $totalSLA = countDays($selectedProjectCode, $konek, $data['log_kode_proses']);
        //     // $totalSLA = $data['log_sla_hcsa'] + $data['log_sla_user'] + $data['log_sla_itScrum'] 
        //     // + $data['log_sla_itGm'] + $data['log_sla_itDev'] + $data['log_sla_itQa'] + $data['log_sla_itRoll'] ;
        // }
        $totalSLA = $totalSLA == 0 ? "" : $totalSLA ;
        $worksheet->setCellValue('O' . $row, $totalSLA);

        $row++; // Increment row for the next data
    }
    // exit();
    

    // Set cell alignment
    $cellRange = 'A2:O5';
    $worksheet->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $worksheet->getStyle($cellRange)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
    // Set cell labels to wrap text
    $worksheet->getStyle($cellRange)->getAlignment()->setWrapText(true);

    // Auto-size column width to fit content
    foreach (range('A', 'O') as $column) {
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
