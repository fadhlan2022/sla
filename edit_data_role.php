<?php
$title = 'edit_data_role';
include 'level_2.php';
include 'requirement.php';
$dept = mysqli_query($konek, "SELECT * FROM dept");
?>
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
                    <h2 class="card-title kapital"> Edit Data Role </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_edit_data_role.php" autocomplete="off">
                    <div class="card-body">
                        <?php
                          $kode_role = isset($_GET['kode_role']) ? $_GET['kode_role'] : '';
                          $data = mysqli_query($konek, "SELECT * FROM role WHERE kode_role ='$kode_role'");
                          while ($hasil = mysqli_fetch_array($data)) {
                        ?>
                        <div class="form-group row">
                            <label for="kode_role" class="col-sm-2 col-form-label">
                                <div class="container">Kode Role</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" name="kode_role" class="form-control" value="<?php echo $hasil['kode_role']; ?>" readonly>
                            </div>
                        </div>
                        <?php
                          }
                        ?>
                        <div class="form-group row">
                            <label for="nama_role" class="col-sm-2 col-form-label">
                                <div class="container">Nama Role</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nama_role" name="nama_role" placeholder="Nama role" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="master_role.php" class="btn btn-default">Cancel</a>
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
