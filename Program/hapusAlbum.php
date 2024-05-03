<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Album.php');

$album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$album->open();

// Cek apakah ada parameter id yang diterima dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // Hapus data album berdasarkan id
        $album->deleteData($id);
        // Redirect ke halaman index setelah berhasil menghapus data
        header("Location: index.php");
        exit(); // Pastikan tidak ada output lain sebelum redirect
    }
}

$album->close();
