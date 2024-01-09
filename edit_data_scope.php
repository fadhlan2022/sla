<?php
$title = 'edit_data_scope';
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
                    <h2 class="card-title kapital"> Edit Data Scope </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_edit_data_scope.php" autocomplete="off">
                    <div class="card-body">
                        <?php
                          $kode_scope = isset($_GET['kode_scope']) ? $_GET['kode_scope'] : '';
                          $data = mysqli_query($konek, "SELECT * FROM master_scope WHERE kode_scope ='$kode_scope'");
                          while ($hasil = mysqli_fetch_array($data)) {
                        ?>
                        <div class="form-group row">
                            <label for="kode_scope" class="col-sm-3 col-form-label">
                                <div class="container">Kode Scope</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="kode_scope" class="form-control" value="<?php echo $hasil['kode_scope']; ?>" readonly>
                            </div>
                        </div>
                        <?php
                          }
                        ?>
                        <div class="form-group row">
                            <label for="nama_scope" class="col-sm-3 col-form-label">
                                <div class="container">Nama Scope</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nama_scope" name="nama_scope" placeholder="Nama Scope" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_konsep" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA Konsep</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_konsep" name="std_sla_konsep"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_sr" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA SR</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_sr" name="std_sla_sr"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_sdonprogress" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA SD ON PROGRESS</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_sdonprogress" name="std_sla_sdonprogress"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_approvalsd" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA APPROVAL SD</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_approvalsd" name="std_sla_approvalsd"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_dev" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA DEVELOPMENT</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_dev" name="std_sla_dev"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_qa" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA QA</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_qa" name="std_sla_qa"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_uat" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA UAT</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_uat" name="std_sla_uat"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_to" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA TO</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_to" name="std_sla_to"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="std_sla_rollout" class="col-sm-3 col-form-label">
                                <div class="container">Std SLA ROLLOUT</div>
                            </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="std_sla_rollout" name="std_sla_rollout"
                                    placeholder="... day" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="master_scope.php" class="btn btn-default">Cancel</a>
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
