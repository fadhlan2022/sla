<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SLA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.css">

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css"> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Add custom styles to achieve the desired layout */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .main-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 250px; /* Adjust width as needed */
      background-color: #343a40; /* Sidebar background color */
      color: #ffffff; /* Sidebar text color */
    }

    .sidebar {
      padding-top: 15px;
      /* Add any other styles you need for the sidebar content */
    }

    /* Add more styles for the sidebar links, icons, etc. */
    .nav-link {
      color: #c8c9cb;
    }

    .nav-link.active {
      color: #ffffff;
      background-color: #495057; /* Active link background color */
    }

    .table-container {
      overflow-x: auto;
      width: 100%;
    }
    .table {
      min-width: 1200px; /* Set a minimum width for the table */
    }

  th, td {
    padding: 10px;
    border: 1px solid #ddd; /* Add border style */
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .lebar-kolom {
    width: 100px; /* Sesuaikan dengan lebar yang diinginkan */
}

  td {
    text-align: center;
  }

  th {
    background-color: #f5f5f5;
    font-weight: bold;
    text-align: center;
  }

  /* Adjust the width for Nama Project and Start Project */
  th:nth-child(2), th:nth-child(3) {
    width: 40%; /* Adjust the width as needed */
  }

  .custom-nama-project-width {
    width: 50% !important;
  }
  </style>
  <style>
    .hidden {
        display: none;
    }
</style>
<style>
  .password-icon {
    cursor: pointer;
  }
</style>
<style>
  .custom-padding {
    padding-bottom: 5px; /* Adjust the padding as needed */
  }
</style>
<style>
/* Styling for the PIC popup */
.pic-popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.pic-popup-inner {
  background: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  max-width: 600px; /* Adjust the max-width to your preferred value */
  width: 100%;
  text-align: center;
}

/* Add the following CSS for the table */
table {
  width: 100%;
  white-space: nowrap;
}

table td {
  white-space: nowrap;
}

.pic-list {
  list-style: none;
  padding: 0;
}

.pic-list li {
  margin: 5px 0;
  font-size: 16px;
}

.close-button {
  display: block;
  margin-top: 20px;
  padding: 10px 20px;
  background: #333;
  color: #fff;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 16px;
}

</style>
<style>
  /* Mengubah warna latar belakang dropdown menjadi kuning */
  select#pic_user {
    background-color: yellow;
  }

  select#pic_hcsa {
    background-color: yellow;
  }
  
  select#pic_itScrum {
    background-color: yellow;
  }

  select#pic_itGm {
    background-color: yellow;
  }

  select#pic_itDev {
    background-color: yellow;
  }

  select#pic_itQa {
    background-color: yellow;
  }

  select#pic_itRoll {
    background-color: yellow;
  }

  select#kode_departemen {
    background-color: yellow;
  }

  select#kode_scope {
    background-color: yellow;
  }

  select#next_user {
    background-color: yellow;
  }

  select#kode_proses {
    background-color: yellow;
  }

  select#next_proses {
    background-color: yellow;
  }

  select#kode_project {
    background-color: yellow;
  }
</style>
</head>