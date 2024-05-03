<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Musisi.php');

$musisi = new Musisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$musisi->open();

// Cek apakah ada parameter id yang diterima dari URL
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Hapus data musisi berdasarkan id
        $musisi->deleteMusisi($id);
        // Redirect ke halaman index setelah berhasil menghapus data
        header("Location: musisi.php");
        exit(); // Pastikan tidak ada output lain sebelum redirect
    }
}


$musisi->close();
