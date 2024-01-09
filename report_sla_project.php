<?php
$title = 'report_sla_project';
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
                    <h2 class="card-title kapital"> Report SLA By Project </h2>
                </div>
              </div>
              <div class="card-body">
              <form class="form-horizontal" method="POST" action="proses_download_report_project.php" autocomplete="off">
                  <div class="card-body">
                      <div class="form-group row">
                          <label for="kode_project" class="col-sm-3 col-form-label">
                              <div class="container">Kode Project</div>
                              <div class="panel panel-default">
                                  <div class="panel-body">
                                      <div class="form-group">
                                          <div>
                                              <select id="kode_project" name="kode_project" class="selectpicker form-control" data-live-search="true" required>
                                                  <option selected></option>
                                                  <?php foreach ($master_project as $key) : ?>
                                                      <option value="<?= $key['kode_project'] ?>"><?= $key['kode_project']; ?></option>
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
                          <div class="container">Nama Project</div>
                          <input type="text" class="form-control" id="nama" name="nama" value="" required autocomplete="off" readonly>
                        </label>
                      </div>
                      <div class="form-group row justify-content-end">
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Download Report</button>
                        </div>
                      </div>
                    </div>
                </form>
                <script>
                    // Fungsi ini akan dipanggil ketika kode_project diubah
                    function updateNamaProject() {
                        var kodeProject = document.getElementById("kode_project").value;
                    
                        // Buat AJAX request ke server untuk mendapatkan nama_project sesuai kode_project
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "get_nama_project.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                var response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    document.getElementById("nama").value = response.nama_project;
                                } else {
                                    document.getElementById("nama").value = "";
                                }
                            }
                        };
                        xhr.send("kode_project=" + kodeProject);
                    }
                    // Panggil fungsi updateNamaProject() ketika kode_project berubah
                    document.getElementById("kode_project").addEventListener("change", updateNamaProject);
                </script>
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
