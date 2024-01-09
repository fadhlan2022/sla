<?php
$title = 'transaksi_awal';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
include 'header.php';
include 'get.php';
$dept = mysqli_query($konek, "SELECT * FROM dept");
$master_status_proses = mysqli_query($konek, "SELECT * FROM master_status_proses");
$master_scope = mysqli_query($konek, "SELECT * FROM master_scope");
$user = mysqli_query($konek, "SELECT * FROM user");
$role = mysqli_query($konek, "SELECT * FROM role");
$master_project = mysqli_query($konek, "SELECT * FROM master_project");
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
                <form class="form-horizontal" method="POST" action="proses_transaksi_awal.php" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">
                              <div class="container">NIK Karyawan</div>
                              <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $nik; ?>" required autocomplete="off" readonly>
                            </label>
                            <label for="kode_transaksi" class="col-sm-3 col-form-label">
                              <div class="container">Kode Transaksi</div>
                              <input type="text" class="form-control" id="kode_trs" name="kode_trs"value="<?php echo $nextKodeTrs; ?>" required autocomplete="off" readonly>
                            </label>
                        </div>
                        <div class="form-group row">
                          <label for="nama" class="col-sm-3 col-form-label">
                            <div class="container">Nama Karyawan</div>
                            <div class="form-control" id="nama" name="nama" readonly><?php echo $nama; ?></div>
                          </label>
                          <label for="kode_scope" class="col-sm-3 col-form-label">
                            <div class="container">Scope</div>
                            <div class="form-control" id="kode_scope" name="kode_scope" readonly><?php echo $nama_scope ?></div>
                          </label>
                        </div>
                        <div class="form-group row">
                          <label for="kode_role" class="col-sm-3 col-form-label">
                            <div class="container">Role</div>
                            <input type="text" class="form-control" id="kode_role" name="kode_role" value="<?php echo $kode_role . ' - ' . $nama_role; ?>" required autocomplete="off" readonly>
                          </label>
                          <label for="start_date" class="col-sm-3 col-form-label">
                            <div class="container">Start Date</div>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                          </label>
                        </div>
                        <div class="form-group row">
                          <label for="kode_project" class="col-sm-3 col-form-label">
                            <div class="container">Kode Project</div>
                            <input type="text" class="form-control" id="kode_project" name="kode_project" value="<?php echo $kode_project; ?>" required autocomplete="off" readonly>
                          </label>
                          <label for="nama" class="col-sm-3 col-form-label">
                              <div class="container">Next User</div>
                              <div class="panel panel-default">
                                  <div class="panel-body">
                                      <div class="form-group">
                                          <div>
                                              <select id="next_user" name="next_user" class="selectpicker form-control" data-live-search="true" required>
                                                  <option selected></option>
                                                  <?php foreach ($user as $key) : ?>
                                                      <?php
                                                      $nik = $key['nik'];
                                                      $nama = $key['nama'];
                                                      $kode_role = $key['kode_role'];
                                                  
                                                      // Query untuk mendapatkan nama_role berdasarkan kode_role
                                                      $query_role = "SELECT nama_role FROM role WHERE kode_role = '$kode_role'";
                                                      $result_role = mysqli_query($konek, $query_role);  // Use $konek instead of undefined variable $connection
                                                  
                                                      if ($result_role && mysqli_num_rows($result_role) > 0) {
                                                          $row_role = mysqli_fetch_assoc($result_role);
                                                          $nama_role = $row_role['nama_role'];
                                                      
                                                          // Menampilkan nama_role - nama berdasarkan nik
                                                          echo "<option value=\"$nik\">$nama_role - $nama</option>";
                                                      }
                                                      ?>
                                                  <?php endforeach ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </label>
                        </div>
                        <div class="form-group row">
                          <label for="nama_project" class="col-sm-3 col-form-label">
                            <div class="container">Nama Project</div>
                            <input type="text" class="form-control" id="nama_project" name="nama_project" value="<?php echo $nama_project; ?>" required autocomplete="off" readonly>
                          </label>
                          <label for="nama_proses" class="col-sm-3 col-form-label">
                              <div class="container">Next Process</span></div>
                              <div class="panel panel-default">
                              <div class="panel-body">
                                    <select id="kode_proses" name="kode_proses" class="selectpicker form-control" data-live-search="true" required>
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
                            <input type="hidden" id="flag" name="flag" value="1">
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
<script>
    document.getElementById('start_date').addEventListener('change', function () {
        var selectedDate = this.value;
        if (selectedDate) {
            var formattedDate = new Date(selectedDate).toISOString().split('T')[0];
            this.value = formattedDate;
        }
    });
</script>
<script>
    document.getElementById('end_date').addEventListener('change', function () {
        var selectedDate = this.value;
        if (selectedDate) {
            var formattedDate = new Date(selectedDate).toISOString().split('T')[0];
            this.value = formattedDate;
        }
    });
</script>
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
