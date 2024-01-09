<?php
// Include necessary files
$title = 'tambah_data_scope';
include 'level_2.php';
include 'requirement.php';
include 'navbar.php';
include 'sidebar_2.php';
include 'header.php';

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

// Fetch the last kode_scope from the database
$sql = "SELECT MAX(kode_scope) AS last_kode_scope FROM master_scope";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastKodeScope = $row["last_kode_scope"];

    // Check if it starts with 'SC', if not set it to SC000
    $lastKodeScope = (strpos($lastKodeScope, 'SC') === 0) ? $lastKodeScope : 'SC000';
    
    // Extract the numeric part and increment it
    $nextNumber = (int) substr($lastKodeScope, 2) + 1;
    $nextKodeScope = 'SC' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
} else {
    $nextKodeScope = 'SC000'; // Set a default value if the table is empty
}
?>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="card-header">
                            <h2 class="card-title kapital">Tambah Data Scope</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="proses_tambah_scope.php" autocomplete="off">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="kode_scope" class="col-sm-3 col-form-label">
                                        <div class="container">Kode Scope</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="kode_scope" name="kode_scope" value="<?php echo $nextKodeScope; ?>" required autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_scope" class="col-sm-3 col-form-label">
                                        <div class="container">Nama Scope</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="nama_scope" name="nama_scope"
                                            placeholder="Nama Scope" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_konsep" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA Konsep</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_konsep" name="std_sla_konsep"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_sr" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA SR</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_sr" name="std_sla_sr"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_sdonprogress" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA SD ON PROGRESS</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_sdonprogress" name="std_sla_sdonprogress"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_approvalsd" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA APPROVAL SD</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_approvalsd" name="std_sla_approvalsd"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_dev" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA DEVELOPMENT</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_dev" name="std_sla_dev"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_qa" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA QA</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_qa" name="std_sla_qa"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_uat" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA UAT</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_uat" name="std_sla_uat"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_to" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA TO</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_to" name="std_sla_to"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="std_sla_rollout" class="col-sm-3 col-form-label">
                                        <div class="container">Std SLA ROLLOUT</div>
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="std_sla_rollout" name="std_sla_rollout"
                                            placeholder="... day" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row justify-content-between">
                                    <div class="col-sm-2">
                                        <!-- Empty column to create space between buttons and the form -->
                                    </div>
                                    <div class="col-sm-10 text-right">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="master_scope.php" class="btn btn-default">Cancel</a>
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
