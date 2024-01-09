<?php
$title = 'tambah_data_departemen';
include 'level_2.php';
include 'requirement.php';
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
                    <h2 class="card-title kapital"> Bulk Upload Data </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_bulk_upload.php" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="kode_departemen" class="col-sm-2 col-form-label">
                                <div class="container">Upload File</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <a href="master_departemen.php" class="btn btn-default">Cancel</a>
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
  document.getElementById('departemen').addEventListener('input', function() {
    capitalizeInput('departemen');
  });
</script>
<?php
include 'script.php';
?>
</body>
</html>
