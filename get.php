<?php
$kode_project = isset($_GET['kode_project']) ? $_GET['kode_project'] : '';
if ($data['level'] >= 1) {
    $query_project = mysqli_query($konek, "SELECT master_project.*, dept.*, master_scope.*, master_status_proses.* FROM master_project
    LEFT JOIN dept ON master_project.kode_departemen = dept.kode_departemen
    LEFT JOIN user ON master_project.nik = user.nik 
    LEFT JOIN master_scope ON master_project.kode_scope = master_scope.kode_scope
    LEFT JOIN master_status_proses ON master_project.kode_proses = master_status_proses.kode_proses
    WHERE kode_project = '$kode_project'");
    $row_project = mysqli_fetch_assoc($query_project);
    if ($row_project) {
        $kode_project = $row_project['kode_project'];
        $nama_project = $row_project['nama_project'];
        $kode_departemen = $row_project['kode_departemen'];
        $kode_scope = $row_project['kode_scope'];
        $kode_proses = $row_project['kode_proses'];
        $nama_proses = $row_project['nama_proses'];
        $departemen = $row_project['departemen'];
        $nama_scope = $row_project['nama_scope'];
        $pic_itScrum = $row_project['pic_itScrum'];
        $pic_hcsa = $row_project['pic_hcsa'];
        $pic_user = $row_project['pic_user'];
        $pic_itGm = $row_project['pic_itGm'];
        $pic_itDev = $row_project['pic_itDev'];
        $pic_itQa = $row_project['pic_itQa'];
        $pic_itRoll = $row_project['pic_itRoll'];
        $sla_hcsa = $row_project['sla_hcsa'];
        $sla_user = $row_project['sla_user'];
        $sla_itScrum = $row_project['sla_itScrum'];
        $sla_itDev = $row_project['sla_itDev'];
        $sla_itQa = $row_project['sla_itQa'];
        $sla_itGm = $row_project['sla_itGm'];
        $sla_itRoll = $row_project['sla_itRoll'];
    }
}
$kode_trs = isset($_GET['kode_trs']) ? $_GET['kode_trs'] : '';
if ($data['level'] >= 1) {
    $query_trs = mysqli_query($konek, "SELECT kode_trs, end_date FROM log_trs WHERE kode_trs = '$kode_trs'");
    $row_trs = mysqli_fetch_assoc($query_trs);
    if ($row_trs) {
        $kode_trs = $row_trs['kode_trs'];
        $end_date = $row_trs['end_date'];
    }
}

$start_date = '';
if ($data['level'] >= 1) {
    $query_startDate = mysqli_query($konek, "SELECT start_date FROM log_trs WHERE  kode_project = '$kode_project'");
    $row_startDate = mysqli_fetch_assoc($query_startDate);
    if ($row_startDate) {
        $start_date = $row_startDate['start_date'];
    }
}

$end_date = '';
if ($data['level'] >= 1) {
    $query_endDate = mysqli_query($konek, "SELECT end_date FROM log_trs WHERE  kode_project = '$kode_project'");
    $row_endDate = mysqli_fetch_assoc($query_endDate);
    if ($row_endDate) {
        $end_date = $row_endDate['end_date'];
    }
}

$kode_departemen = "";
if ($data['level'] >= 1) {
    $query_dept = mysqli_query($konek, "SELECT user.kode_departemen, dept.departemen AS dept_nama_departemen FROM user LEFT JOIN dept ON
    user.kode_departemen = dept.kode_departemen WHERE  nik = $nik");
    $row_dept = mysqli_fetch_assoc($query_dept);
    if ($row_dept) {
        $kode_departemen = $row_dept['kode_departemen'];
        $departemen = $row_dept['dept_nama_departemen'];
    }
}

$kode_role = "";
if ($data['level'] >= 1) {
    $query_role = mysqli_query($konek, "SELECT * FROM user WHERE nik = $nik");
    $row_role = mysqli_fetch_assoc($query_role);
    if ($row_role) {
        $kode_role = $row_role['kode_role'];
    }
}

$nama_role = "";
if ($data['level'] >= 1) {
    $query_namaRole = mysqli_query($konek, "SELECT role.nama_role FROM user INNER JOIN role ON
    role.kode_role = user.kode_role WHERE  nik = $nik");
    $row_namaRole = mysqli_fetch_assoc($query_namaRole);
    if ($row_namaRole) {
        $nama_role = $row_namaRole['nama_role'];
    }
}