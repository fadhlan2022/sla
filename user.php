<?php
$title = 'user';
include 'level_2.php';
include 'requirement.php';
?>

<?php
$kode_role = isset($_GET['kode_role']) ? $_GET['kode_role'] : '';
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
                    <h2 class="card-title kapital"> Data User </h2>
                </div>
              </div>
              <!-- Tabel Data User -->
                <div class="card-body table-responsive">
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
                    <a class="btn btn-success btn-sm mt-2" href="tambah_data_user.php">
                        <i class="fas fa-plus"></i>
                        Tambah Data
                    </a>
                    <table id="example2" class="table table-striped projects mt-3">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    No
                                </th>
                                <th style="width: 10%">
                                    NIK
                                </th>
                                <th style="width: 12%">
                                    Password
                                </th>
                                <th style="width: 20%">
                                    Nama Karyawan
                                </th>
                                <th style="width: 10%">
                                    Role
                                </th>
                                <th style="width: 20%">
                                    Departemen
                                </th>
                                <th style="width: 5%">
                                    Level
                                </th>
                                <th style="width: 20%">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            // Fetch all users and order them by kode_role in ascending order
                            $query = mysqli_query($konek, "SELECT * FROM user ORDER BY kode_role ASC");
                            
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td>
                                        <?php echo $no++;?>
                                    </td>
                                    <td>
                                        <?php echo $data['nik']; ?>
                                    </td>
                                    <td class="password" data-password="<?php echo $data['password']; ?>">
                                        <button id="passwordIcon<?php echo $no; ?>" class="btn btn-link btn-sm" onclick="togglePasswordVisibility(<?php echo $no; ?>)">
                                          <i id="passwordIconEye<?php echo $no; ?>" class="fas fa-eye"></i>
                                        </button>
                                        <span class="password-content"><?php echo $data['password']; ?></span>
                                    </td>
                                    <td>
                                        <?php echo $data['nama']; ?>
                                    </td>
                                    <?php
                                      $sql_role = "SELECT role.nama_role FROM role INNER JOIN user ON user.kode_role = role.kode_role WHERE user.kode_role='$data[kode_role]'";
                                      $result_role = mysqli_query($konek, $sql_role);
                                      $role_data = mysqli_fetch_assoc($result_role);
                                      $nama_role = $role_data['nama_role'];
                                    ?>
                                    <td>
                                        <?php echo $nama_role; ?>
                                    </td>
                                    <?php
                                      $sql_dept = "SELECT dept.departemen FROM dept INNER JOIN user ON user.kode_departemen = dept.kode_departemen WHERE user.kode_departemen='$data[kode_departemen]'";
                                      $result_dept = mysqli_query($konek, $sql_dept);
                                      $dept_data = mysqli_fetch_assoc($result_dept);
                                      $departemen = $dept_data['departemen'];
                                    ?>
                                    <td>
                                        <?php echo $departemen; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['level']; ?>
                                    </td>
                                    <td class="project-actions text-center">
                                        <a class="btn btn-info btn-sm" href="edit_data_user.php?nik=<?php echo $data['nik']; ?>">
                                            <i class=" fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="hapus_data_user.php?nik=<?php echo $data['nik']; ?>" onclick="return confirm('Anda yakin akan menghapus user <?php echo $data['nama']; ?>?');">
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
<script>
    function togglePasswordVisibility(no) {
        const passwordIcon = document.getElementById(`passwordIconEye${no}`);
        const passwordContent = document.querySelector(`#passwordIcon${no} + .password-content`);

        if (passwordContent.style.display === 'none' || passwordContent.style.display === '') {
            passwordContent.style.display = 'inline';
            passwordIcon.classList.remove('fa-eye');  // Remove eye icon
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordContent.style.display = 'none';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');  // Add eye icon
        }
    }

    // Initially hide all password contents and show eye icons without strike-through
    const passwordIcons = document.querySelectorAll('.fas.fa-eye');
    const passwordContents = document.querySelectorAll('.password-content');

    for (let i = 0; i < passwordIcons.length; i++) {
        passwordContents[i].style.display = 'none';  // Hide password initially
        passwordIcons[i].classList.remove('fa-eye-slash');
        passwordIcons[i].classList.add('fa-eye');
    }
</script>

<?php
include 'script.php';
?>
</body>
</html>
