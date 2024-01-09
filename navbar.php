<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand" style="background-color: #FF0000;">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars" style="color: white;"></i>
          </a>
        </li>
      </ul>

      <!-- Title -->
      <a class="navbar-brand" style="color: white;">
        <?php
        // Judul default
        $pageTitle = "Dashboard";

        // Daftar judul untuk setiap halaman
        $pageTitles = array(
          "index.php" => "Transaksi",
          "user.php" => "Master User",
          "tambah_data_user.php" => "Tambah Data User",
          "edit_data_user.php" => "Edit Data User",
          "master_role.php" => "Master Role",
          "tambah_data_role.php" => "Tambah Data Role",
          "edit_data_role.php" => "Edit Data Role",
          "master_departemen.php"=> "Master Departemen",
          "tambah_data_departemen.php"=> "Tambah Data Departemen",
          "tambah_project.php"=> "Tambah Project",
          "master_status_proses.php"=> "Master Status Proses",
          "tambah_status_proses.php"=> "Tambah Status Proses",
          "edit_status_proses.php"=> "Edit Status Proses",
          "tambah_transaksi.php"=> "Transaksi",
          "master_scope.php"=> "Master Scope",
          "tambah_data_scope.php"=> "Tambah Data Scope",
          "edit_data_scope.php"=> "Edit Data Scope",
          "transaksi_awal.php" => "Transaksi",
          "transaksi_existing_user.php"=>"Transaksi",
          "transaksi_existing_hcsa.php"=>"Transaksi",
          "transaksi_existing_scrum.php"=>"Transaksi",
          "transaksi_existing_itDev.php"=>"Transaksi",
          "transaksi_existing_itQa.php"=>"Transaksi",
          "transaksi_existing_itRoll.php"=>"Transaksi",
          "transaksi_existing_itGm.php"=>"Transaksi"
          // Tambahkan halaman dan judulnya sesuai kebutuhan
        );
      
        // Dapatkan nama file halaman saat ini
        $currentPage = basename($_SERVER['PHP_SELF']);
      
        // Periksa apakah halaman ada dalam daftar judul
        if (isset($pageTitles[$currentPage])) {
          $pageTitle = $pageTitles[$currentPage];
        }
      
        echo $pageTitle;
        ?>
      </a>

      <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->
  </div>