<?php
// Include necessary files
$title = 'tambah_data_role';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
include 'header.php';

// Function to generate the next kode_role
function generateKodeRole($lastKodeRole)
{
    // If lastKodeRole is 'R0000', start from 'R0001', else start from 'R0000'
    $startNumber = ($lastKodeRole === 'R0000') ? 1 : 0;
    $nextNumber = (int) substr($lastKodeRole, 1) + $startNumber;
    $nextKodeRole = 'R' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    return $nextKodeRole;
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

// Fetch the last kode_role from the database
$sql = "SELECT MAX(kode_role) AS last_kode_role FROM role";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastKodeRole = $row["last_kode_role"];
    // Increment the lastKodeRole for the next one
    $lastKodeRole = 'R' . str_pad((int) substr($lastKodeRole, 1) + 1, 4, '0', STR_PAD_LEFT);
} else {
    $lastKodeRole = 'R0000'; // Set a default value if the table is empty
}

$nextKodeRole = generateKodeRole($lastKodeRole);
?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="card-header">
                            <h2 class="card-title kapital">Tambah Data Role</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="proses_input_data_role.php" autocomplete="off">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="kode_role" class="col-sm-2 col-form-label">
                                        <div class="container">Kode Role</div>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="kode_role" name="kode_role"
                                            value="<?php echo $nextKodeRole; ?>" required autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_role" class="col-sm-2 col-form-label">
                                        <div class="container">Role</div>
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="nama_role" name="nama_role"
                                            placeholder="Nama role" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-10">
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
