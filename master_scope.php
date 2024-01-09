<?php
$title = 'master_scope';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
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
                    <h2 class="card-title kapital"> Master Scope </h2>
                </div>
              </div>
              <!-- Tabel Master Role -->
                <div class="card-body table-responsive">
                    <a class="btn btn-success btn-sm mt-2" href="tambah_data_scope.php">
                        <i class="fas fa-plus"></i>
                        Tambah Data
                    </a>
                    <table id="example2" class="table table-striped projects mt-3">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    No
                                </th>
                                <th style="width: 15%">
                                    Kode Scope
                                </th>
                                <th style="width: 10%">
                                    Nama Scope
                                </th>
                                <th>
                                    Std SLA Konsep
                                </th>
                                <th>
                                    Std SLA SR
                                </th>
                                <th>
                                    Std SLA SD ON PROGRESS
                                </th>
                                <th>
                                    Std SLA APPROVAL SD
                                </th>
                                <th>
                                    Std SLA DEV
                                </th>
                                <th>
                                    Std SLA QA
                                </th>
                                <th>
                                    Std SLA UAT
                                </th>
                                <th>
                                    Std SLA TO
                                </th>
                                <th>
                                    Std SLA ROLLOUT
                                </th>
                                <th style="width: 10%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            include 'koneksi.php';
                            // Pagination parameters
                            $limit = 10;  // Number of items to show per page
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $start = ($page - 1) * $limit;
                            
                            // Fetch users with pagination
                            $query = mysqli_query($konek, "SELECT * FROM master_scope LIMIT $start, $limit");
                            
                            // Fetch total number of users for pagination
                            $total_rows = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM master_scope"));
                            $total_pages = ceil($total_rows / $limit);  // Calculate total pages
                            
                            $no = $start + 1;
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no++;?>
                                    </td>
                                    <td>
                                        <?php echo $data['kode_scope']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama_scope']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_konsep']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_sr']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_sdonprogress']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_approvalsd']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_dev']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_qa']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_uat']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_to']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['std_sla_rollout']; ?>
                                    </td>
                                    <td class="project-actions text-center">
                                        <a class="btn btn-info btn-sm" href="edit_data_scope.php?kode_scope=<?php echo $data['kode_scope']; ?>">
                                            <i class=" fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="hapus_data_scope.php?kode_scope=<?php echo $data['kode_scope']; ?>" onclick="return confirm('Anda yakin akan menghapus scope <?php echo $data['nama_scope']; ?>?');">
                                            <i class=" fas fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>   
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
