<?php
$title = 'edit_status_proses';
include 'level_2.php';
include 'requirement.php';
$master_status_proses = mysqli_query($konek, "SELECT * FROM master_status_proses");
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
                    <h2 class="card-title kapital"> Edit Status Proses </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_edit_status_proses.php" autocomplete="off">
                    <div class="card-body">
                        <?php
                          $kode_proses = isset($_GET['kode_proses']) ? $_GET['kode_proses'] : '';
                          $data = mysqli_query($konek, "SELECT * FROM master_status_proses WHERE kode_proses ='$kode_proses'");
                          while ($hasil = mysqli_fetch_array($data)) {
                        ?>
                        <div class="form-group row">
                            <label for="kode_proses" class="col-sm-2 col-form-label">
                                <div class="container">Kode Proses</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" name="kode_proses" class="form-control" value="<?php echo $hasil['kode_proses']; ?>" readonly>
                            </div>
                        </div>
                        <?php
                          }
                        ?>
                        <div class="form-group row">
                            <label for="nama_proses" class="col-sm-2 col-form-label">
                                <div class="container">Nama Proses</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nama_proses" name="nama_proses" placeholder="Nama Proses" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="master_status_proses.php" class="btn btn-default">Cancel</a>
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
  document.getElementById('nama_proses').addEventListener('input', function() {
    capitalizeInput('nama_proses');
  });
</script>
<?php
include 'script.php';
?>
</body>
</html>
