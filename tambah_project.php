<?php
$title = 'tambah_project';
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

$start_date = date('Y-m-d');
?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="card-header">
                    <h2 class="card-title kapital"> Add New Project </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_add_project.php" autocomplete="off">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">
                          <div class="container">NIK</div>
                          <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $nik; ?>" required autocomplete="off" readonly>
                        </label>
                        <label for="pic_hcsa" class="col-sm-3 col-form-label">
                          <div class="container">PIC HCSA</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_hcsa" name="pic_hcsa" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0001') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                        <label for="nama" class="col-sm-3 col-form-label">
                          <div class="container">Nama Karyawan</div>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required autocomplete="off" readonly>
                        </label>
                        <label for="pic_user" class="col-sm-3 col-form-label">
                          <div class="container">PIC User</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_user" name="pic_user" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0002') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                        <label for="kode_project" class="col-sm-3 col-form-label">
                          <div class="container">Kode Project</div>
                          <input type="text" class="form-control" id="kode_project" name="kode_project" placeholder="Kode Project" required>
                        </label>
                        <label for="pic_itScrum" class="col-sm-3 col-form-label">
                          <div class="container">PIC IT SCRUM</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itScrum" name="pic_itScrum" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0003') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                          <input type="text" class="form-control" id="nama_project" name="nama_project" placeholder="Nama Project" required  value="<?php echo isset($_POST['nama_project']) ? htmlspecialchars($_POST['nama_project']) : ''; ?>">
                        </label>
                        <label for="pic_itGm" class="col-sm-3 col-form-label">
                          <div class="container">PIC IT GM</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itGm" name="pic_itGm" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0004') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                        <label for="departemen" class="col-sm-3 col-form-label">
                          <div class="container">Departemen Pengaju</span></div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="kode_departemen" name="kode_departemen" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($dept as $key) : ?>
                                        <option value="<?= $key['kode_departemen'] ?>"><?= $key['departemen'];  ?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </label>
                        <label for="pic_itDev" class="col-sm-3 col-form-label">
                          <div class="container">PIC IT DEV</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itDev" name="pic_itDev" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0005') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                        <label for="nama_scope" class="col-sm-3 col-form-label">
                          <div class="container">Scope</span></div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="kode_scope" name="kode_scope" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($master_scope as $key) : ?>
                                        <option value="<?= $key['kode_scope'] ?>"><?= $key['nama_scope'];  ?></option>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </label>
                        <label for="pic_itQa" class="col-sm-3 col-form-label">
                          <div class="container">PIC IT QA</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itQa" name="pic_itQa" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0006') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                        <label for="start_date" class="col-sm-3 col-form-label">
                          <div class="container">Start Project</div>
                          <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date; ?>" required autocomplete="off" readonly>
                        </label>
                        <label for="pic_itRoll" class="col-sm-3 col-form-label">
                          <div class="container">PIC IT ROLLOUT</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itRoll" name="pic_itRoll" class="selectpicker form-control" data-live-search="true" required>
                                    <option selected></option>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0007') {
                                        echo '<option value="' . $key['nik'] . '">' . $key['nama'] . '</option>';
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
                        <input type="hidden" id="kode_proses" name="kode_proses" value="NEW">
                      </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
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
  // Function to capitalize input value
  function capitalizeInput(elementId) {
    var inputElement = document.getElementById(elementId);
    if (inputElement.value.length > 0) {
      inputElement.value = inputElement.value.toUpperCase();
    }
  }

  // Event listener to trigger capitalizeInput function when input changes
  document.getElementById('nama_project').addEventListener('input', function() {
    capitalizeInput('nama_project');
  });
</script>
<script>
  // Function to capitalize input value
  function capitalizeInput(elementId) {
    var inputElement = document.getElementById(elementId);
    if (inputElement.value.length > 0) {
      inputElement.value = inputElement.value.toUpperCase();
    }
  }

  // Event listener to trigger capitalizeInput function when input changes
  document.getElementById('kode_project').addEventListener('input', function() {
    capitalizeInput('kode_project');
  });
</script>
<?php
include 'script.php';
?>
</body>
</html>
