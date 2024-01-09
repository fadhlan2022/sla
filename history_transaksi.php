<?php
$title = 'dashboard';
include 'validasi.php';
include 'requirement.php';
include 'get.php';
include 'koneksi.php';
?>

<?php
include 'navbar.php';
?>

  <?php
  if($data['level']=="1"){
    include 'sidebar_1.php';
  }else if($data['level']=="2"){
    include 'sidebar_2.php';
  }
  ?>


  <?php
  include 'header.php';
  function getUserName($pic_user) {
    global $konek;
    $query = mysqli_query($konek, "SELECT nama FROM user WHERE nik = '$pic_user'");
    $hasil = mysqli_fetch_array($query);
    
    if ($hasil && !empty($hasil['nama'])) {
        return $hasil['nama'];
    } else {
        return " ";
    }
}
  ?>

<!-- Main content -->
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <!-- Tabel Data SLA -->
                <div class="card-body">
                    <div class="search-box">
                      <div class="input-group">
                        <input class="form-control form-control-sm-2" id="myInput" type="text" placeholder="Search..." style="max-width: 200px;" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="search()">
                              <i class="fas fa-search" style="color: white;"></i>&nbsp;&nbsp;Search
                            </button>
                        </div>
                      </div>
                    </div>
                    <?php
                    function countDays($kode_project, $konek, $kode_proses){
                      $queryTest = "SELECT SUM(`sla_user`),SUM(`sla_hcsa`),SUM(`sla_itScrum`),SUM(`sla_itGm`),SUM(`sla_itDev`),SUM(`sla_itQa`),SUM(`sla_itRoll`) FROM `log_trs` WHERE `kode_proses` = '$kode_proses' 
                      AND kode_project IN ($kode_project)";
                      $queryTestResult = mysqli_query($konek, $queryTest);
                      $row = mysqli_fetch_array($queryTestResult);
                      $totalSLADays = 0;
                      for($i=0;$i<count($row)/2;$i++){
                          $totalSLADays += $row[$i];
                      }
                      return $totalSLADays;
                  }
                    ?>
                    <div class="table-container">
                      <table id="example2" class="table table-striped projects mt-3">
                        <thead>
                            <tr>
                                <th style="width: 10%">Start Project</th>
                                <th style="width: 5%">Kode Project</th>
                                <th style="width: 30%">Nama Project</th>
                                <th class="width: 5%">Kode Proses</th>
                                <th style="width: 10%">Proses</th>
                                <th style="width: 10%">Scope</th>
                                <th style="width: 10%">NIK</th>
                                <th style="width: 20%">User</th>
                                <th style="width: 10%">Tanggal Transaksi</th>
                                <th style="width: 10%">Start Date</th>
                                <th style="width: 10%">End Date</th>
                                <th style="width: 10%">SLA Per User</th>
                                <th style="width: 10%">STD SLA Per Proses</th>
                                <th style="width: 10%">SLA Per Proses</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        <?php
                        $query = mysqli_query($konek, "SELECT
                        user.nama AS user_nama,
                        master_project.start_date AS mp_start_date,
                        master_project.kode_project AS mp_kode_project,
                        master_project.nama_project AS mp_nama_project,
                        log_trs.kode_proses AS log_kode_proses,
                        master_project.kode_scope,
                        master_status_proses.nama_proses AS msp_nama_proses,
                        log_trs.nik AS log_nik,
                        log_trs.start_date AS log_start_date,
                        log_trs.end_date AS log_end_date,
                        master_scope.nama_scope AS ms_nama_scope,
                        master_scope.std_sla_konsep AS ms_std_sla_konsep,
                        master_scope.std_sla_sr AS ms_std_sla_sr,
                        master_scope.std_sla_sdonprogress AS ms_std_sla_sdonprogress,
                        master_scope.std_sla_approvalsd AS ms_std_sla_approvalsd,
                        master_scope.std_sla_dev AS ms_std_sla_dev,
                        master_scope.std_sla_qa AS ms_std_sla_qa,
                        master_scope.std_sla_uat AS ms_std_sla_uat,
                        master_scope.std_sla_to AS ms_std_sla_to,
                        master_scope.std_sla_rollout AS ms_std_sla_rollout,
                        log_trs.sla_user AS log_sla_user,
                        log_trs.sla_hcsa AS log_sla_hcsa,
                        log_trs.sla_itScrum AS log_sla_itScrum,
                        log_trs.sla_itGm AS log_sla_itGm,
                        log_trs.sla_itDev AS log_sla_itDev,
                        log_trs.sla_itQa AS log_sla_itQa,
                        log_trs.sla_itRoll AS log_sla_itRoll,
                        log_trs.kode_role AS log_kode_role,
                        master_project.kode_scope AS mp_kode_scope,
                        log_trs.kode_project AS log_kode_project
                        FROM log_trs
                        LEFT JOIN master_project ON log_trs.kode_project = master_project.kode_project
                        LEFT JOIN user ON log_trs.nik = user.nik
                        LEFT JOIN role ON log_trs.kode_role = role.kode_role
                        LEFT JOIN master_status_proses ON log_trs.kode_proses = master_status_proses.kode_proses
                        LEFT JOIN master_scope ON master_project.kode_scope = master_scope.kode_scope
                        WHERE log_trs.kode_project = '$kode_project'");
                        while ($hasil = mysqli_fetch_array($query)){
                        ?>
                          <tr>
                            <td><?php echo $hasil['mp_start_date']; ?></td>
                            <td><?php echo $hasil['mp_kode_project']; ?></td>
                            <td><?php echo $hasil['mp_nama_project']; ?></td>
                            <td><?php echo $hasil['log_kode_proses']; ?></td>
                            <td><?php echo $hasil['msp_nama_proses']; ?></td>          
                            <td><?php echo $hasil['ms_nama_scope']; ?></td>      
                            <td><?php echo $hasil['log_nik']; ?></td>  
                            <td><?php echo $hasil['user_nama']; ?></td>  
                            <td><?php echo $hasil['log_end_date']; ?></td>  
                            <td><?php echo $hasil['log_start_date']; ?></td>  
                            <td><?php echo $hasil['log_end_date']; ?></td>
                            <?php
                            $val = ''; // Initialize $val
                                switch ($hasil['log_kode_role']) {
                                    case 'R0001':
                                        // $val = $hasil['log_sla_hcsa'] == 0 ? "" : $hasil['log_sla_hcsa'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    case 'R0002':
                                        // $val = $hasil['log_sla_user'] == 0 ? "" : $hasil['log_sla_user'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    case 'R0003':
                                        // $val = $hasil['log_sla_itScrum'] == 0 ? "" : $hasil['log_sla_itScrum'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    case 'R0004':
                                        // $val = $hasil['log_sla_itGm'] == 0 ? "" : $hasil['log_sla_itGm'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    case 'R0005':
                                        // $val = $hasil['log_sla_itDev'] == 0 ? "" : $hasil['log_sla_itDev'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    case 'R0006':
                                        // $val = $hasil['log_sla_itQa'] == 0 ? "" : $hasil['log_sla_itQa'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    case 'R0007':
                                        // $val = $hasil['log_sla_itRoll'] == 0 ? "" : $hasil['log_sla_itRoll'];
                                        $val = $hasil['log_sla_hcsa'] + $hasil['log_sla_user'] + $hasil['log_sla_itScrum'] + $hasil['log_sla_itGm']
                                        + $hasil['log_sla_itDev'] + $hasil['log_sla_itQa'] + $hasil['log_sla_itRoll'];
                                        ?><td><?php echo $val; ?></td><?php
                                        break;
                                    default:
                                        // Set a default value or handle it as per your requirement
                                        $val = '';
                                        break;
                                }
                                switch ($hasil['mp_kode_scope']) {
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
                              
                                      $prosesCode = $hasil['log_kode_proses'];
                                      // var_dump ($prosesCode);
                                      $column = isset($prosesColumn[$prosesCode]) ? $prosesColumn[$prosesCode] : '';
                                      // var_dump ($column);
                                      ?><td><?php echo $hasil[$column] ?? ''; ?></td><?php
                                      // $worksheet->setCellValue('N' . $row, $hasil[$column] ?? '');
                                      break;
                              
                                  default:
                                      // Handle the default case as per your requirements
                                      // $worksheet->setCellValue('N' . $row, '');
                                      ?><td><?php echo ''; ?></td><?php
                                      break;
                              }
                              $totalSLA = 0;
                              if($hasil['log_kode_proses'] == 'P0001'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0002'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0003'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0004'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0005'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0006'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0007'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0008'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              elseif($hasil['log_kode_proses'] == 'P0009'){
                                  $selectedProjectCode = "'".$hasil['log_kode_project']."'";
                                  $totalSLA = countDays($selectedProjectCode, $konek, $hasil['log_kode_proses']);
                              }
                              $totalSLA = $totalSLA == 0 ? "" : $totalSLA ;
                              ?><td><?php echo $totalSLA; ?></td><?php
                              // $worksheet->setCellValue('O' . $row, $totalSLA);
                            ?>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- Pagination -->
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<?php
include 'footer.php';
?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script>
    // Function to toggle HCSA button visibility
    function toggleHCSAButtonVisibility() {
        const startButton = document.querySelector('.start-button');
        const hcsaButton = document.querySelector('.hcsa-button');

        if (startButton) {
            startButton.addEventListener('click', () => {
                // Show the HCSA button when START button is clicked
                hcsaButton.style.display = 'block';
            });
        }
    }

    // Call the function to toggle HCSA button visibility
    toggleHCSAButtonVisibility();
</script>
<?php
include 'script.php';
?>
</body>
</html>
