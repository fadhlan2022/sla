<?php
date_default_timezone_set('Asia/Jakarta');
$title = 'transaksi_user';
include 'level_1.php';
include 'requirement.php';
include 'navbar.php';
if($data['level']=="1"){
  include 'sidebar_1.php';
}else if($data['level']=="2"){
  include 'sidebar_2.php';
}
include 'header.php';
include 'get.php';
$dept = mysqli_query($konek, "SELECT * FROM dept");
$master_status_proses = mysqli_query($konek, "SELECT * FROM master_status_proses");
$master_scope = mysqli_query($konek, "SELECT * FROM master_scope");
$user = mysqli_query($konek, "SELECT * FROM user");
$role = mysqli_query($konek, "SELECT * FROM role");
$master_project = mysqli_query($konek, "SELECT * FROM master_project");

$query_previous_end_date = "SELECT end_date FROM log_trs WHERE kode_project = ? ORDER BY kode_trs DESC LIMIT 1";
$stmt_previous_end_date = $konek->prepare($query_previous_end_date);
$stmt_previous_end_date->bind_param("s", $kode_project);
$stmt_previous_end_date->execute();
$stmt_previous_end_date->bind_result($previous_end_date);
$stmt_previous_end_date->fetch();
$stmt_previous_end_date->close();

$query_previous_next_proses = "SELECT next_proses FROM log_trs WHERE kode_project = ? ORDER BY kode_trs DESC LIMIT 1";
$stmt_previous_next_proses = $konek->prepare($query_previous_next_proses);
$stmt_previous_next_proses->bind_param("s", $kode_project);
$stmt_previous_next_proses->execute();
$stmt_previous_next_proses->bind_result($next_proses);
$stmt_previous_next_proses->fetch();
$stmt_previous_next_proses->close();

?>

<?php
include 'generateTrs.php';
?>


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="card-header">
                    <h2 class="card-title kapital"> Transaksi </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_transaksi_existing_user.php" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">
                              <div class="container">NIK Karyawan</div>
                              <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $nik; ?>" required autocomplete="off" readonly>
                            </label>
                            <label for="kode_scope" class="col-sm-3 col-form-label">
                              <div class="container">Scope</div>
                              <div class="form-control" id="kode_scope" name="kode_scope" readonly><?php echo $nama_scope ?></div>
                            </label>
                            <label for="nama_proses" class="col-sm-3 col-form-label">
                              <div class="container">Next Process</span></div>
                                <div class="panel panel-default">
                                <div class="panel-body">
                                      <select id="next_proses" name="next_proses" class="selectpicker form-control" data-live-search="true" required>
                                        <option selected></option>
                                        <?php foreach ($master_status_proses as $key) : ?>
                                            <option value="<?= $key['kode_proses'] ?>"><?= $key['nama_proses'];  ?></option>
                                        <?php endforeach ?>
                                      </select>
                                </div>
                              </div>
                            </label>
                        </div>
                        <div class="form-group row">
                          <label for="nama" class="col-sm-3 col-form-label">
                            <div class="container">Nama Karyawan</div>
                            <div class="form-control" id="nama" name="nama" readonly><?php echo $nama; ?></div>
                          </label>
                          <label for="start_date" class="col-sm-3 col-form-label">
                          <?php
                          if($kode_role == 'R0001') { ?>
                            <div class="container">Start Date</div>
                            <input type="date" class="form-control" id="start_date" name="start_date" required autocomplete="off">
                          <?php 
                          }else{ ?>
                            <div class="container">Start Date</div>
                              <?php
                              if ($previous_end_date == '0000-00-00') {
                                  $start_date_value = $start_date;
                              } else {
                                  $start_date_value = $previous_end_date;
                              }
                              ?>
                              <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date_value; ?>" required autocomplete="off" readonly>
                          <?php }
                          ?>
                          </label>
                          <label for="nama" class="col-sm-3 col-form-label">
                              <div class="container">Next User</div>
                              <div class="panel panel-default">
                                  <div class="panel-body">
                                      <div class="form-group">
                                          <div>
                                            <select id="next_user" name="next_user" class="selectpicker form-control" data-live-search="true" required>
                                                <option selected></option>
                                                <?php
                                                $query_user = "SELECT * FROM user WHERE nik = '$pic_hcsa' OR nik = '$pic_user' OR nik = '$pic_itScrum' OR nik = '$pic_itGm' OR nik = '$pic_itDev' OR nik = '$pic_itQa' OR nik = '$pic_itRoll'";
                                                $result_user = mysqli_query($konek, $query_user);

                                                if ($result_user && mysqli_num_rows($result_user) > 0) {
                                                    while ($user_row = mysqli_fetch_assoc($result_user)) {
                                                        $nik = $user_row['nik'];
                                                        $nama = $user_row['nama'];
                                                        $kode_peran = $user_row['kode_role']; // Ganti nama variabel menjadi $kode_peran

                                                        // Query untuk mendapatkan nama_role berdasarkan kode_role
                                                        $query_peran = "SELECT nama_role FROM role WHERE kode_role = '$kode_peran'"; // Ganti nama variabel di sini
                                                        $result_peran = mysqli_query($konek, $query_peran);

                                                        if ($result_peran && mysqli_num_rows($result_peran) > 0) {
                                                            $row_peran = mysqli_fetch_assoc($result_peran);
                                                            $nama_peran = $row_peran['nama_role'];

                                                            // Menampilkan nama_peran - nama berdasarkan nik
                                                            echo "<option value=\"$nik\">$nama_peran - $nama</option>";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </label>
                        </div>
                        <div class="form-group row">
                        <label for="kode_role" class="col-sm-3 col-form-label">
                            <div class="container">Role</div>
                            <input type="text" class="form-control" id="kode_role" name="kode_role" value="<?php echo $kode_role . ' - ' . $nama_role; ?>" required autocomplete="off" readonly>
                          </label>
                          <label for="start_date" class="col-sm-3 col-form-label">
                          <?php
                          if($kode_role == 'R0001') { ?>
                            <div class="container">End Date</div>
                            <input type="date" class="form-control" id="end_date" name="end_date" required autocomplete="off">
                          <?php 
                          }else{ ?>
                              <div class="container">End Date</div>
                              <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo date('Y-m-d'); ?>" required readonly>                       
                            <?php 
                          }
                          ?>
                          </label>
                        </div>
                        <div class="form-group row">
                          <label for="kode_project" class="col-sm-3 col-form-label">
                            <div class="container">Kode Project</div>
                            <input type="text" class="form-control" id="kode_project" name="kode_project" value="<?php echo $kode_project; ?>" required autocomplete="off" readonly>
                          </label>
                          <label for="kode_transaksi" class="col-sm-3 col-form-label">
                            <div class="container">Kode Transaksi</div>
                            <input type="text" class="form-control" id="kode_trs" name="kode_trs"value="<?php echo $nextKodeTrs; ?>" required autocomplete="off" readonly>
                          </label>
                          <!-- <label for="sla_user" class="col-sm-3 col-form-label">
                            <div class="container">SLA</div>
                            <input type="text" class="form-control" id="sla_user" name="sla_user" value="<?php echo $sla; ?>" required autocomplete="off" readonly>
                          </label> -->
                        </div>
                        <div class="form-group row">
                          <label for="nama_project" class="col-sm-3 col-form-label">
                            <div class="container">Nama Project</div>
                            <input type="text" class="form-control" id="nama_project" name="nama_project" value="<?php echo $nama_project; ?>" required autocomplete="off" readonly>
                          </label>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" id="kode_proses" name="kode_proses" value="<?php echo $next_proses; ?>">
                        </div>
                        <div class="form-group row justify-content-end">
                          <div class="col-sm-3">
                            <button type="button" class="btn btn-primary" onclick="if (validateForm()) document.querySelector('form').submit();">Save</button>
                            <a href="index.php" class="btn btn-default">Cancel</a>
                          </div>
                        </div>
                    </div>
                </form>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<?php
include 'footer.php';
?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateForm() {
        let valid = true;

        // Check each required input
        const requiredInputs = document.querySelectorAll('input[required], select[required]');
        for (const input of requiredInputs) {
            if (!input.value) {
                valid = false;
                input.style.border = '1px solid red';
            } else {
                input.style.border = ''; // Reset border if the input is filled
            }
        }

        if (!valid) {
            alert('Please fill in all required fields.');
        }

        return valid;
    }

    function onSaveButtonClick() {
        const isValid = validateForm();

        if (isValid) {
            document.querySelector('form').submit();
        }
    }
</script>

<?php
include 'script.php';
?>
</body>
</html>
