<?php
include('config/db.php');
include('classes/DB.php');
include('classes/Label.php');

$label = new Label($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$label->open();

// Cek apakah ada parameter id yang diterima dari URL
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        // Hapus data label berdasarkan id
        $label->deleteLabel($id);
        // Redirect ke halaman index setelah berhasil menghapus data
        header("Location: label.php");
        exit(); // Pastikan tidak ada output lain sebelum redirect
    }
}


$label->close();
