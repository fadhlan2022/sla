<?php
// Include necessary files
$title = 'tambah_status_proses';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
include 'header.php';

// Function to generate the next kode_proses
function generateKodeProses($lastKodeProses)
{
    // If lastKodeProses is 'R0000', start from 'R0001', else start from 'R0000'
    $startNumber = ($lastKodeProses === 'P0000') ? 1 : 0;
    $nextNumber = (int) substr($lastKodeProses, 1) + $startNumber;
    $nextKodeProses = 'P' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    return $nextKodeProses;
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

// Fetch the last kode_proses from the database
$sql = "SELECT MAX(kode_proses) AS last_kode_proses FROM master_status_proses";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastKodeProses = $row["last_kode_proses"];
    // Increment the lastKodeProses for the next one
    $lastKodeProses = 'P' . str_pad((int) substr($lastKodeProses, 1) + 1, 4, '0', STR_PAD_LEFT);
} else {
    $lastKodeProses = 'P0000'; // Set a default value if the table is empty
}

$nextKodeProses = generateKodeProses($lastKodeProses);
?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="card-header">
                            <h2 class="card-title kapital">Tambah Status Proses</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="proses_input_status_proses.php" autocomplete="off">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="kode_proses" class="col-sm-2 col-form-label">
                                        <div class="container">Kode Proses</div>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="kode_proses" name="kode_proses"
                                            value="<?php echo $nextKodeProses; ?>" required autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_proses" class="col-sm-2 col-form-label">
                                        <div class="container">Nama Proses</div>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="nama_proses" name="nama_proses"
                                            placeholder="Nama Proses" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="master_status_proses.php" class="btn btn-default">Cancel</a>
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
<script>
  // Function to capitalize input value
  function capitalizeInput(elementId) {
    var inputElement = document.getElementById(elementId);
    if (inputElement.value.length > 0) {
      inputElement.value = inputElement.value.toUpperCase();
    }
  }

  // Event listener to trigger capitalizeInput function when input changes
  document.getElementById('nama_proses').addEventListener('input', function() {
    capitalizeInput('nama_proses');
  });
</script>
<?php
include 'script.php';
?>
</body>

</html>
