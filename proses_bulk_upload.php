<?php
// Include file yang dibutuhkan
include 'PHPExcel/PHPExcel/IOFactory.php';
include 'koneksi.php'; // Gantilah 'koneksi.php' dengan file yang berisi koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan informasi file yang diupload
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];

    // Memeriksa apakah file yang diupload adalah file Excel
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    if ($file_ext == "xlsx" || $file_ext == "xls") {
        // Memindahkan file sementara ke direktori yang diinginkan
        move_uploaded_file($file_tmp, "uploads/" . $file_name);

        // Membaca data dari file Excel
        $excel = PHPExcel_IOFactory::load("uploads/" . $file_name);
        $sheet = $excel->getActiveSheet();
        
        // Mengambil data dari setiap baris kecuali header
        foreach ($sheet->getRowIterator(2) as $row) {
            $kode_departemen = $row->getCell(1)->getValue(); // Gantilah angka 1 dengan indeks kolom yang sesuai dengan struktur file Excel Anda

            // Lakukan query SQL untuk menyimpan data ke dalam database
            $query = "INSERT INTO nama_tabel (kode_departemen) VALUES ('$kode_departemen')"; // Gantilah 'nama_tabel' dengan nama tabel yang sesuai
            mysqli_query($koneksi, $query); // Sesuaikan dengan nama variabel koneksi yang Anda gunakan
        }

        // Hapus file yang diupload setelah selesai
        unlink("uploads/" . $file_name);

        // Redirect atau tampilkan pesan sukses sesuai kebutuhan
        header("Location: master_departemen.php");
        exit();
    } else {
        // Jika file yang diupload bukan file Excel, tampilkan pesan error
        echo "Hanya file Excel yang diizinkan!";
    }
}
?>