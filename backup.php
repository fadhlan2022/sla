<?php
$title = 'master_role';
include 'level_2.php';
include 'requirement.php';
?>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini

-->

<?php
$kode_departemen = isset($_GET['kode_departemen']) ? $_GET['kode_departemen'] : '';
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
                    <h2 class="card-title kapital"> Master Role </h2>
                </div>
              </div>
              <!-- Tabel Master Role -->
                <div class="card-body">
                    <div class="search-box">
                      <div class="input-group">
                        <input class="form-control form-control-sm-2" id="myInput" type="text" placeholder="Search..." style="max-width: 200px;" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="search()">
                              <i class="fas fa-search" style="color: white;"></i>&nbsp;&nbsp;Search
                            </button>
                        </div>
                      </div>
                    </div>
                    <a class="btn btn-success btn-sm mt-2" href="tambah_data_role.php">
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
                                    Kode Role
                                </th>
                                <th style="width: 10%">
                                    Nama role
                                </th>
                                <th style="width: 15%">
                                    Nama Departemen
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
                            $query = mysqli_query($konek, "SELECT * FROM role LIMIT $start, $limit");
                            
                            // Fetch total number of users for pagination
                            $total_rows = mysqli_num_rows(mysqli_query($konek, "SELECT * FROM role"));
                            $total_pages = ceil($total_rows / $limit);  // Calculate total pages
                            
                            $no = $start + 1;
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no++;?>
                                    </td>
                                    <td>
                                        <?php echo $data['kode_role']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama_role']; ?>
                                    </td>
                                    <?php
                                      $sql_departemen = "SELECT dept.departemen FROM dept INNER JOIN role ON role.kode_departemen = dept.kode_departemen WHERE role.kode_departemen='$data[kode_departemen]'";
                                      $result_departemen = mysqli_query($konek, $sql_departemen);
                                      $departemen_data = mysqli_fetch_assoc($result_departemen);
                                      $nama_departemen = $departemen_data['departemen'];
                                    ?>
                                    <td>
                                        <?php echo $nama_departemen; ?>
                                    </td>
                                    <td class="project-actions text-left">
                                        <a class="btn btn-info btn-sm" href="edit_data_role.php?kode_role=<?php echo $data['kode_role']; ?>">
                                            <i class=" fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="hapus_data_role.php?kode_role=<?php echo $data['kode_role']; ?>" onclick="return confirm('Anda yakin akan menghapus role <?php echo $data['nama_role']; ?>?');">
                                            <i class=" fas fa-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <ul class="pagination justify-content-center mt-4">
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
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
  function search() {
    const searchInput = document.getElementById('myInput').value;
    const tableRows = document.getElementById('myTable').getElementsByTagName('tr');
    
    for (let i = 0; i < tableRows.length; i++) {
      const row = tableRows[i];
      const rowData = row.getElementsByTagName('td');
      let found = false;
      for (let j = 0; j < rowData.length; j++) {
        const cell = rowData[j];
        if (cell) {
          const cellText = cell.textContent || cell.innerText;
          if (cellText.toLowerCase().indexOf(searchInput.toLowerCase()) > -1) {
            found = true;
            break;
          }
        }
      }
      row.style.display = found ? '' : 'none';
    }
  }

  $(document).ready(function() {
    $("#myInput").on("keyup", function() {
      search(); // Call the search function on keyup
    });
  });
</script>

<?php
include 'script.php';
?>
</body>
</html>

<td><?php echo $hasil['start_date']; ?></td>

<?php
$query = mysqli_query($konek, "SELECT user.*, role.*, dept.*, master_project.*, 
log_trs.*, master_status_proses.* FROM dept 
INNER JOIN user ON dept.kode_departemen = user.kode_departemen
INNER JOIN master_std_sla ON master_std_sla.kode_role = user.kode_role
INNER JOIN master_project ON master_project.nik = user.nik
INNER JOIN log_trs ON master_project.kode_project = log_trs.kode_project
INNER JOIN master_status_proses ON log_trs.kode_proses = master_status_proses.kode_proses
WHERE user.nik = '$nik'");
while ($hasil = mysqli_fetch_array($query)) {
    
    $nama_role = $hasil['nama_role'];
}
?>


<?php

$kode_project = "";
if ($data['level'] >= 2) {
    $query_project = mysqli_query($konek, "SELECT kode_project FROM master_project WHERE nik = '$nik'");
    $row_project = mysqli_fetch_assoc($query_project);
    if ($row_project) {
        $kode_project = $row_project['kode_project'];
    }
}

$kode_departemen = "";
if ($data['level'] >= 2) {
    $query_dept = mysqli_query($konek, "SELECT user.kode_departemen FROM user INNER JOIN dept ON
    user.kode_departemen = dept.kode_departemen WHERE  nik = $nik");
    $row_dept = mysqli_fetch_assoc($query_dept);
    if ($row_dept) {
        $kode_departemen = $row_dept['kode_departemen'];
    }
}

$kode_role = "";
if ($data['level'] >= 2) {
    $query_role = mysqli_query($konek, "SELECT kode_role FROM user WHERE  nik = $nik");
    $row_role = mysqli_fetch_assoc($query_role);
    if ($row_role) {
        $kode_role = $row_role['kode_role'];
    }
}



?>

<div class="form-group row">
                          <fieldset class="form-group">
                              <div class="row">
                                  <label for="scope" class="col-sm-2 col-form-label">
                                      <div class="container">Scope <span style="color: red">*</span></div>
                                  </label>
                                  <div class="col-sm-10">
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="scope" id="Laki-Laki" value="L" checked>
                                          <label class="form-check-label" for="Laki-Laki">
                                              Laki-Laki
                                          </label>
                                      </div>
                                      <div class="form-check">
                                          <input class="form-check-input" type="radio" name="scope" id="Perempuan" value="P">
                                          <label class="form-check-label" for="Perempuan">
                                              Perempuan
                                          </label>
                                      </div>
                                  </div>
                              </div>
                          </fieldset>
                        </div>

                        <?php
$title = 'edit_data_scope';
include 'level_2.php';
include 'requirement.php';
$master_scope = mysqli_query($konek, "SELECT * FROM master_scope");
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
                            <label for="kode_scope" class="col-sm-2 col-form-label">
                                <div class="container">Kode Scope</div>
                            </label>
                            <div class="col-sm-6">
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

<?php
function hitungSLA($start_date, $end_date) {
    // Mengubah tanggal ke objek DateTime
    $start_datetime = new DateTime($start_date);
    $end_datetime = new DateTime($end_date);

    // Menghitung selisih dalam hari
    $interval = $start_datetime->diff($end_datetime);
    $sla_hari = $interval->days;

    return $sla_hari;
}

$sla = hitungSLA($start_date, $end_date);
?>
