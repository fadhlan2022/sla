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
                    <h2 class="card-title kapital"> Edit Data </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_edit_project.php" autocomplete="off">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="kode_project" class="col-sm-4 col-form-label">
                          <div class="container">Kode Project Existing</div>
                          <input type="text" name="kode_project" class="form-control" value="<?php echo $kode_project ?>" readonly>
                        </label>
                        <label for="kode_project" class="col-sm-4 col-form-label">
                          <div class="container">Kode Project Diubah</div>
                          <input type="text" class="form-control" id="kode_project2" name="kode_project2" placeholder="Kosongkan Jika Tidak Diubah!">
                        </label>
                      </div>
                      <div class="form-group row">
                        <label for="nama_project" class="col-sm-4 col-form-label">
                          <div class="container">Nama Project</div>
                          <div class="form-control" id="nama_project" name="nama_project" readonly><?php echo $nama_project ?></div>
                        </label>
                        <label for="pic_itGm" class="col-sm-4 col-form-label">
                          <div class="container">PIC IT GM</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itGm" name="pic_itGm" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0004') {
                                        $selected = ($key['nik'] == $pic_itGm) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
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
                      <label for="pic_user" class="col-sm-4 col-form-label">
                          <div class="container">PIC User</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_user" name="pic_user" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0002') {
                                        $selected = ($key['nik'] == $pic_user) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
                                      }
                                      ?>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </label>
                        <label for="pic_itDev" class="col-sm-4 col-form-label">
                          <div class="container">PIC IT DEV</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                <select id="pic_itDev" name="pic_itDev" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0005') {
                                        $selected = ($key['nik'] == $pic_itDev) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
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
                      <label for="pic_hcsa" class="col-sm-4 col-form-label">
                          <div class="container">PIC HCSA</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_hcsa" name="pic_hcsa" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0001') {
                                        $selected = ($key['nik'] == $pic_hcsa) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
                                      }
                                      ?>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </label>
                        <label for="pic_itQa" class="col-sm-4 col-form-label">
                          <div class="container">PIC IT QA</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itQa" name="pic_itQa" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0006') {
                                        $selected = ($key['nik'] == $pic_itQa) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
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
                        <label for="pic_itScrum" class="col-sm-4 col-form-label">
                          <div class="container">PIC IT SCRUM</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itScrum" name="pic_itScrum" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0003') {
                                        $selected = ($key['nik'] == $pic_itScrum) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
                                      }
                                      ?>
                                    <?php endforeach ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </label>
                        <label for="pic_itRoll" class="col-sm-4 col-form-label">
                          <div class="container">PIC IT ROLLOUT</div>
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="form-group">
                                <div>
                                  <select id="pic_itRoll" name="pic_itRoll" class="selectpicker form-control" data-live-search="true" required>
                                    <?php foreach ($user as $key) : ?>
                                      <?php
                                      // Check if role is 'user'
                                      if ($key['kode_role'] === 'R0007') {
                                        $selected = ($key['nik'] == $pic_itRoll) ? 'selected' : '';
                                        echo '<option value="' . $key['nik'] . '" ' . $selected . '>' . $key['nama'] . '</option>';
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
<?php
include 'script.php';
?>
</body>
</html>
