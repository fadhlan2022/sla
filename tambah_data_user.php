<?php
$title = 'tambah_data_user';
include 'level_2.php';
include 'requirement.php';
$role = mysqli_query($konek, "SELECT * FROM role");
$dept = mysqli_query($konek, "SELECT * FROM dept");
?>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<?php
include 'navbar.php';
?>

  <?php
  include 'sidebar_2.php';
  ?>

  <?php
  include 'header.php';
  ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="card-header">
                    <h2 class="card-title kapital"> Tambah Data User </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_input_data_user.php" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-2 col-form-label">
                                <div class="container">NIK</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK Karyawan" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">
                                <div class="container">Password</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">
                                <div class="container">Nama Karyawan</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required autocomplete="off" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="nama_role" class="col-sm-2 col-form-label">
                              <div class="container">Role</span></div>
                          </label>
                          <div class="col-sm-6">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="form-group">
                                  <div>
                                    <select id="kode_role" name="kode_role" class="selectpicker form-control" style="background-color: yellow;" data-live-search="true" required>
                                      <option selected></option>
                                      <?php foreach ($role as $key) : ?>
                                          <option value="<?= $key['kode_role'] ?>"><?= $key['nama_role'];  ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="departemen" class="col-sm-2 col-form-label">
                              <div class="container">Departemen</span></div>
                          </label>
                          <div class="col-sm-6">
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
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="level" class="col-sm-2 col-form-label">
                              <div class="container">Level</div>
                          </label>
                          <div class="col-sm-6">
                              <select class="form-control" id="level" name="level" required autocomplete="off">
                                  <option value="1">Level 1</option>
                                  <option value="2">Level 2</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="user.php" class="btn btn-default">Cancel</a>
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
  document.getElementById('nama').addEventListener('input', function() {
    capitalizeInput('nama');
  });
</script>
<?php
include 'script.php';
?>
</body>
</html>
