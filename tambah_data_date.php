<?php
$title = 'tambah_data_departemen';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
include 'header.php';
?>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<?php  
function generateKodeDate($lastKodeDate)
{
    // If lastKodeDate is 'D0000', start from 'R0001', else start from 'D0000'
    $startNumber = ($lastKodeDate === 'D0000') ? 1 : 0;
    $nextNumber = (int) substr($lastKodeDate, 1) + $startNumber;
    $nextKodeDate = 'D' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    return $nextKodeDate;
}

// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "sla";

// Create a connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the last kode_date from the database
$sql = "SELECT MAX(kode_date) AS last_kode_date FROM master_date";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastKodeDate = $row["last_kode_date"];
    // Increment the lastKodeDate for the next one
    $lastKodeDate = 'D' . str_pad((int) substr($lastKodeDate, 1) + 1, 4, '0', STR_PAD_LEFT);
} else {
    $lastKodeDate = 'D0000'; // Set a default value if the table is empty
}

$nextKodeDate = generateKodeDate($lastKodeDate);
?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="card-header">
                    <h2 class="card-title kapital"> Tambah Data Date </h2>
                </div>
              </div>
              <div class="card-body">
                <form class="form-horizontal" method="POST" action="proses_input_date.php" autocomplete="off">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="kode_date" class="col-sm-2 col-form-label">
                                <div class="container">Kode Date</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="kode_date" name="kode_date"
                                    value="<?php echo $nextKodeDate; ?>" required autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_libur" class="col-sm-2 col-form-label">
                                <div class="container">Date Exception</div>
                            </label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="date_libur" name="date_libur" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="master_date.php" class="btn btn-default">Cancel</a>
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
