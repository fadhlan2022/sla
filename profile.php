<?php
// Include necessary files
$title = 'edit_profile';
include 'koneksi.php';
include 'validasi.php';
include 'requirement.php';
include 'get.php';
include 'navbar.php';
if($data['level']=="1"){
  include 'sidebar_1.php';
}else if($data['level']=="2"){
  include 'sidebar_2.php';
}
include 'header.php';
$role = mysqli_query($konek, "SELECT * FROM role");
$dept = mysqli_query($konek, "SELECT * FROM dept");
?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="card-header">
                            <h2 class="card-title kapital">Profile</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="proses_edit_profile.php" autocomplete="off">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-4 col-form-label">
                                      <div class="container">NIK Karyawan</div>
                                      <div class="form-control" id="nik" name="nik" readonly><?php echo $nik; ?></div>
                                    </label>
                                </div>
                                <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">
                                  <div class="container">Nama Karyawan</div>
                                  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" autocomplete="off">
                                </label>
                                </div>
                                <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">
                                  <div class="container">Password</div>
                                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" autocomplete="off">
                                </label>
                                </div>
                                <div class="form-group row">
                                <label for="departemen" class="col-sm-4 col-form-label">
                                  <div class="container">Departemen</span></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <div>
                                        <select id="kode_departemen" name="kode_departemen" class="selectpicker form-control" data-live-search="true">
                                          <option selected><?php echo $departemen?></option>
                                          <?php foreach ($dept as $key) : ?>
                                              <option value="<?= $key['kode_departemen'] ?>"><?= $key['departemen'];  ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </label>
                                </div>
                                <div class="form-group row">
                                <label for="nama_role" class="col-sm-4 col-form-label">
                                  <div class="container">Role</span></div>
                                  <div class="panel-body">
                                    <div class="form-group">
                                      <div>
                                        <select id="kode_role" name="kode_role" class="selectpicker form-control" style="background-color: yellow;" data-live-search="true">
                                          <option selected><?php echo $nama_role?></option>
                                          <?php foreach ($role as $key) : ?>
                                              <option value="<?= $key['kode_role'] ?>" style="background-color: yellow;"><?= $key['nama_role'];  ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </label>
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
<?php
include 'script.php';
?>
</body>

</html>
