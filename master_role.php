<?php
$title = 'master_role';
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
                    <h2 class="card-title kapital"> Master Role </h2>
                </div>
              </div>
              <!-- Tabel Master Role -->
                <div class="card-body table-responsive"">
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
                                    <td class="project-actions text-center">
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
