<?php
include "collect.php";
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
      <a href="#" class="d-block"><?php echo $nama ?></a>
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
        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if ($title == 'dashboard' || $title == 'transaksi_existing_user') {echo 'active';} ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>Transaksi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link <?php if ($title == 'edit_profile') {echo 'active';} ?>">
            <i class="nav-icon fas fa-th"></i>
            <p>Profile</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>