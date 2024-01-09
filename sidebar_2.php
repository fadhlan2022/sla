<!-- Main Sidebar Container -->
<?php
include "collect.php";
?>


<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
      <a href="profile.php" class="d-block"><?php echo $nama ?></a>
        <div class="d-flex align-items-center">
          <a href="logout.php" class="d-block" id="logout-btn">Logout</a>
          <div class="online-indicator"></div> <!-- Green circular indicator -->
        </div>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview <?php if ($title == 'master_data' || $title == 'user' || $title == 'tambah_data_user' || $title == 'edit_data_user' || $title == 'master_role' || $title == 'tambah_data_role' 
        || $title == 'edit_data_role' || $title == 'master_departemen' || $title == 'tambah_data_departemen' || $title == 'edit_data_departemen' || $title == 'master_status_proses' || $title == 'tambah_status_proses' 
        || $title == 'edit_status_proses' || $title == 'master_scope' || $title == 'tambah_data_scope' || $title == 'edit_data_scope' || $title == 'master_date' || $title == 'tambah_data_date' || $title == 'edit_data_date') {echo 'menu-open active';} ?>">
          <a href="#" class="nav-link <?php if ($title == 'master_data' || $title == 'user' || $title == 'tambah_data_user' || $title == 'edit_data_user' || $title == 'master_role' || $title == 'tambah_data_role' 
          || $title == 'edit_data_role' || $title == 'master_departemen' || $title == 'tambah_data_departemen' || $title == 'edit_data_departemen' || $title == 'master_status_proses' || $title == 'tambah_status_proses' 
          || $title == 'edit_status_proses' || $title == 'master_scope' || $title == 'tambah_data_scope' || $title == 'edit_data_scope' || $title == 'master_date' || $title == 'tambah_data_date' || $title == 'edit_data_date') {echo 'active';} ?>">
            <i class="nav-icon fas fa-database"></i>
            <p>Master Data</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="user.php" class="nav-link <?php if ($title == 'user' || $title == 'tambah_data_user' || $title == 'edit_data_user') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Master User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="master_role.php" class="nav-link <?php if ($title == 'master_role' || $title == 'tambah_data_role' || $title == 'edit_data_role') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Role</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="master_departemen.php" class="nav-link <?php if ($title == 'master_departemen' || $title == 'tambah_data_departemen' || $title == 'edit_data_departemen') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Departemen</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="master_status_proses.php" class="nav-link <?php if ($title == 'master_status_proses' || $title == 'tambah_status_proses' || $title == 'edit_status_proses') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Status Proses</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="master_scope.php" class="nav-link <?php if ($title == 'master_scope' || $title == 'tambah_data_scope' || $title == 'edit_data_scope') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Scope</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="master_date.php" class="nav-link <?php if ($title == 'master_date' || $title == 'tambah_data_date' || $title == 'edit_data_date') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Master Date</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($title == 'dashboard' || $title == 'tambah_project' || $title == 'transaksi_hcsa' || $title == 'transaksi_awal' || $title == 'transaksi_user' || $title == 'edit_pic') {echo 'menu-open active';} ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>Transaksi</p>
          </a>
        </li>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview <?php if ($title == 'report_sla_project' || $title == 'report_sla_date') {echo 'menu-open active';} ?>">
          <a href="#" class="nav-link <?php if ($title == 'report_sla_project' || $title == 'report_sla_date') {echo 'active';} ?>">
            <i class="nav-icon fas fa-laptop"></i>
            <p>Report SLA</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="report_sla_project.php" class="nav-link <?php if ($title == 'report_sla_project') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Report SLA by Project</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="report_sla_date.php" class="nav-link <?php if ($title == 'report_sla_date') {echo 'active';} ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Report SLA by Date</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link <?php if ($title == 'edit_profile') {echo 'active';} ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>Profile</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Saat elemen master data diklik
    $(".nav-item.has-treeview").click(function() {
      // Jika sudah terbuka, maka tutup
      if ($(this).hasClass("menu-open")) {
        $(this).removeClass("menu-open");
      } else {
        // Jika belum terbuka, maka buka
        $(".nav-item.has-treeview").removeClass("menu-open");
        $(this).addClass("menu-open");
      }
    });
  });
</script>


