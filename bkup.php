<?php
$title = 'dashboard';
include 'validasi.php';
include 'requirement.php';
include 'get.php';
?>

<?php
include 'navbar.php';
?>

  <?php
  if($data['level']=="1"){
    include 'sidebar_1.php';
  }else if($data['level']=="2"){
    include 'sidebar_2.php';
  }
  ?>


  <?php
  include 'header.php';
  function getUserName($pic_user) {
    global $konek;
    $query = mysqli_query($konek, "SELECT nama FROM user WHERE nik = '$pic_user'");
    $hasil = mysqli_fetch_array($query);
    
    if ($hasil && !empty($hasil['nama'])) {
        return $hasil['nama'];
    } else {
        return " ";
    }
}
  ?>

<!-- Main content -->
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <!-- Tabel Data SLA -->
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
                    <?php
                    if ($data['level'] == "1") {
                    } else if ($data['level'] == "2") {
                      include 'sidebar_2.php';  // Include sidebar for level 2 users
                      echo '<a class="btn btn-success btn-sm mt-2" href="tambah_project.php">
                                <i class="fas fa-plus"></i>
                                &nbsp;&nbsp; Add New Project
                            </a>';
                    } 
                    ?>
                    <div class="table-container">
                      <table id="example2" class="table table-striped projects mt-3">
                        <thead>
                            <tr>
                                <th style="width: 2%">No</th>
                                <th style="width: 5%">Kode Project</th>
                                <th class="width: 30%">Nama Project</th>
                                <th style="width: 5%">Departemen</th>
                                <th style="width: 5%">Scope</th>
                                <th style="width: 20%">User</th>
                                <th style="width: 5%">SLA User</th>
                                <th style="width: 5%">SLA HCSA</th>
                                <th style="width: 5%">SLA IT Scrum</th>
                                <th style="width: 5%">SLA IT GM</th>
                                <th style="width: 5%">SLA IT DEV</th>
                                <th style="width: 5%">SLA IT QA</th>
                                <th style="width: 5%">SLA IT Rollout</th>
                                <th style="width: 5%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                        <?php
                        $no = 0;
                        $query = mysqli_query($konek, "SELECT user.*, master_project.*, dept.*, master_scope.* FROM user 
                        INNER JOIN master_project ON master_project.nik = user.nik
                        LEFT JOIN dept ON master_project.kode_departemen = dept.kode_departemen
                        LEFT JOIN master_scope ON master_project.kode_scope = master_scope.kode_scope");
                        while ($hasil = mysqli_fetch_array($query)){
                        $no++;
                        ?>
                          <tr>
                            <td><?php echo $no++;?></td>
                            <td><?php echo $hasil['kode_project']; ?></td>
                            <td><?php echo $hasil['nama_project']; ?></td>
                            <td><?php echo $hasil['departemen']; ?></td>
                            <td><?php echo $hasil['nama_scope']; ?></td>
                            <td><?php echo getUserName($hasil['pic_user']); ?></td>
                            <td><?php echo $hasil['sla_user']; ?></td>
                            <td><?php echo $hasil['sla_hcsa']; ?></td>
                            <td><?php echo $hasil['sla_itScrum']; ?></td>
                            <td><?php echo $hasil['sla_itGm']; ?></td>
                            <td><?php echo $hasil['sla_itDev']; ?></td>
                            <td><?php echo $hasil['sla_itQa']; ?></td>
                            <td><?php echo $hasil['sla_itRoll']; ?></td>
                            <td class="project-actions text-center">
                            <?php
                              // Query untuk mengambil pic_user dari tabel master_project berdasarkan kode_project
                              $query_pic_user = mysqli_query($konek, "SELECT pic_user FROM master_project WHERE kode_project = '" . $hasil['kode_project'] . "'");
                              $pic_user_data = mysqli_fetch_array($query_pic_user);
                              $pic_user = $pic_user_data['pic_user'];
                              // Memeriksa apakah database log_trs memiliki data transaksi
                              $query_check_transaksi = mysqli_query($konek, "SELECT COUNT(*) as count_transaksi FROM log_trs WHERE kode_project='" . $hasil['kode_project'] . "'");
                              $data_check_transaksi = mysqli_fetch_assoc($query_check_transaksi);

                              if ($hasil['kode_proses']) {
                              ?>      
                              <!-- HCSA -->
                              <?php if ($level == 2 && $kode_role == 'R0001'): ?>
                              <?php
                                if (empty($hasil['flag'])) {?>
                                <a class="btn btn-success btn-sm" href="transaksi_awal.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      Transaksi
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>
                                  <a class="btn btn-primary btn-sm" href="hapus_data_project.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      Edit
                                  </a>
                                  <a class="btn btn-danger btn-sm" href="hapus_data_project.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      Delete
                                  </a>
                                <?php } ?>
                              <?php
                                  if ($hasil['flag'] == '1' && $hasil['pic_hcsa'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_hcsa.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>
                                  <a class="btn btn-primary btn-sm" href="hapus_data_project.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      Edit
                                  </a>
                                  <a class="btn btn-danger btn-sm" href="hapus_data_project.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      Delete
                                  </a>

                              <!-- User -->
                              <?php elseif ($level == 1 && $kode_role == 'R0002'): ?>
                              <?php
                                  if ($hasil['flag'] == '2' && $hasil['pic_user'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_user.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-info btn-sm pic-button" data-kode-project="<?php echo $hasil['kode_project']; ?>">
                                    PIC
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>

                              <!-- Scrum -->
                              <?php elseif ($level == 1 && $kode_role == 'R0003'): ?>
                              <?php
                                  if ($hasil['flag'] == '3' && $hasil['pic_scrum'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_scrum.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-info btn-sm" href="pic_info.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      PIC
                                  </a>                                  
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>

                              <!-- IT GM -->
                              <?php elseif ($level == 1 && $kode_role == 'R0004'): ?>
                              <?php
                                  if ($hasil['flag'] == '4' && $hasil['pic_itGm'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_itGm.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-info btn-sm" href="pic_info.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      PIC
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>

                              <!-- IT Dev -->
                              <?php elseif ($level == 1 && $kode_role == 'R0005'): ?>
                              <?php
                                  if ($hasil['flag'] == '5' && $hasil['pic_itDev'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_itDev.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-info btn-sm" href="pic_info.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      PIC
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>
                                
                              <!-- IT QA -->
                              <?php elseif ($level == 1 && $kode_role == 'R0006'): ?>
                              <?php
                                  if ($hasil['flag'] == '6' && $hasil['pic_itQa'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_itQa.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-info btn-sm" href="pic_info.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      PIC
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>
                              
                              <!-- IT Rollout -->
                              <?php elseif ($level == 1 && $kode_role == 'R0007'): ?>
                              <?php
                                  if ($hasil['flag'] == '7' && $hasil['pic_itRoll'] == $nik) {
                                    // Kode untuk menampilkan tombol "Transaksi" jika flag tidak kosong
                                    echo '<a class="btn btn-success btn-sm" href="transaksi_existing_itRoll.php?kode_project=' . $hasil['kode_project'] . '">Transaksi</a>';
                                  } else {
                                    // Kode jika start_date kosong
                                    echo '<a class="btn btn-secondary btn-sm" disabled>Transaksi</a>';
                                  }
                                  ?>
                                  <a class="btn btn-info btn-sm" href="pic_info.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      PIC
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>

                              <?php endif; ?>
                              <?php
                              } 
                              else {
                                if ($level == 2 && $kode_role == 'R0001'): ?>
                                  <a class="btn btn-success btn-sm" href="transaksi_awal.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      Transaksi
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>
                                  <a class="btn btn-danger btn-sm" href="hapus_data_project.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      Delete
                                  </a>
                                  <?php
                                else:
                                ?>
                                  <a class="btn btn-secondary btn-sm" disabled>
                                    Transaksi
                                  </a>
                                  <a class="btn btn-info btn-sm" href="pic_info.php?kode_project=<?php echo $hasil['kode_project']; ?>" onclick="return confirm('Anda yakin akan menghapus project <?php echo $hasil['nama_project']; ?>?');">
                                      PIC
                                  </a>
                                  <a class="btn btn-warning btn-sm" href="history_transaksi.php?kode_project=<?php echo $hasil['kode_project']; ?>">
                                      History
                                  </a>
                                <?php
                                endif;
                                ?>
                              <?php
                              }
                              ?>
                            </td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- Pagination -->
                </div>
                <!-- <div class="pic-popup">
                  <div class="pic-popup-inner">
                    <h3>PIC List</h3>
                    <ul class="pic-list"> -->
                      <!-- Daftar PIC akan ditampilkan di sini -->
                    <!-- </ul>
                    <button class="close-button" onclick="closePICPopup()">Close</button>
                  </div>
                </div> -->
                <div class="pic-popup">
                  <div class="pic-popup-inner">
                    <h3>PIC List</h3>
                    <div class="pic-list">
                      <div class="col-sm-3">
                        <label for="picUser" class="col-form-label">PIC User</label>
                        <div class="form-control" id="picUser" name="picUser" readonly>
                          <?php echo $picUser; ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label for="picHCSA" class="col-form-label">PIC HCSA</label>
                        <div class="form-control" id="picHCSA" name="picHCSA" readonly>
                          <?php echo $picHCSA; ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label for="picItScrum" class="col-form-label">PIC IT Scrum</label>
                        <div class="form-control" id="picItScrum" name="picItScrum" readonly>
                          <?php echo $picItScrum; ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label for="picItGm" class="col-form-label">PIC IT GM</label>
                        <div class="form-control" id="picItGm" name="picItGm" readonly>
                          <?php echo $picItGm; ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label for="picItDev" class="col-form-label">PIC IT Dev</label>
                        <div class="form-control" id="picItDev" name="picItDev" readonly>
                          <?php echo $picItDev; ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label for="picItQa" class="col-form-label">PIC IT QA</label>
                        <div class="form-control" id="picItQa" name="picItQa" readonly>
                          <?php echo $picItQa; ?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <label for="picItRoll" class="col-form-label">PIC IT Roll</label>
                        <div class="form-control" id="picItRoll" name="picItRoll" readonly>
                          <?php echo $picItRoll; ?>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <button class="btn btn-secondary close-button" onclick="closePICPopup()">Close</button>
                      </div>
                    </div>
                  </div>
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

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<?php
include 'footer.php';
?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to toggle HCSA button visibility
    function toggleHCSAButtonVisibility() {
        const startButton = document.querySelector('.start-button');
        const hcsaButton = document.querySelector('.hcsa-button');

        if (startButton) {
            startButton.addEventListener('click', () => {
                // Show the HCSA button when START button is clicked
                hcsaButton.style.display = 'block';
            });
        }
    }

    // Call the function to toggle HCSA button visibility
    toggleHCSAButtonVisibility();
</script>
<script>
  // Function to show the PIC popup
function showPICPopup(kodeProject) {
  const picPopup = document.querySelector('.pic-popup');
  const picList = document.querySelector('.pic-list');

  // Clear existing PIC list
  picList.innerHTML = '';

  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_pic_data.php?kode_project=' + kodeProject, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const picData = JSON.parse(xhr.responseText);

      // Populate the PIC list
      picData.forEach(function (pic) {
        const li = document.createElement('li');
        li.textContent = pic;
        picList.appendChild(li);
      });

      // Show the popup
      picPopup.style.display = 'flex';

      // Function to close the popup
      const closePopupButton = document.querySelector('.close-button');
      closePopupButton.addEventListener('click', function () {
        picPopup.style.display = 'none';
      });
    }
  };

  xhr.send();
}

// Select the buttons that will open the PIC popup
const picButtons = document.querySelectorAll('.pic-button');
picButtons.forEach(function (button) {
  button.addEventListener('click', function () {
    const kodeProject = this.getAttribute('data-kode-project');
    showPICPopup(kodeProject);
  });
});

  function closePICPopup() {
  const picPopup = document.querySelector('.pic-popup');
  picPopup.style.display = 'none';
}

</script>

<?php
include 'script.php';
?>
</body>
</html>