<?php
$title = 'tambah_data_user';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
include 'header.php';

$role = mysqli_query($konek, "SELECT * FROM role");
$dept = mysqli_query($konek, "SELECT * FROM dept");
?>

  <?php
  $nik = isset($_GET['nik']) ? $_GET['nik'] : '';
  $data = mysqli_query($konek, "SELECT * FROM user WHERE nik ='$nik'");
  while ($hasil = mysqli_fetch_array($data)) {
  ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="card-header">
                    <h2 class="card-title kapital"> Edit Data User </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_edit_data_user.php" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nik" class="col-sm-2 col-form-label">
                                <div class="container">NIK</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" name="nik" class="form-control" value="<?php echo $hasil['nik']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">
                                <div class="container">Password</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $hasil['password']; ?>" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">
                                <div class="container">Nama Lengkap</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?php echo $hasil['nama']; ?>" required autocomplete="off" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">
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
                                    <select id="kode_role" name="kode_role" class="selectpicker form-control" data-live-search="true" required>
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
                                  <option selected></option>
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
              <?php } ?>
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
function validateForm() {
    var nik = document.forms["editForm"]["nik"].value;
    var password = document.forms["editForm"]["password"].value;
    var nama = document.forms["editForm"]["nama"].value;
    var kode_role = document.forms["editForm"]["kode_role"].value;
    var kode_departemen = document.forms["editForm"]["kode_departemen"].value;

    if (nik == '' || password == '' || nama == '' || kode_role == 'Pilih Role' || kode_departemen == 'Pilih Departemen') {
        alert('Harap lengkapi semua input sebelum menyimpan.');
        return false;
    }
    return true;
}
</script>
<?php
include 'script.php';
?>
</body>
</html>
