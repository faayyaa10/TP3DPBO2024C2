<?php
// Pengaturan koneksi ke database dan lainnya
include('config/db.php');
include('classes/DB.php');
include('classes/Label.php');
include('classes/Template.php');

if (isset($_POST['submit'])) {
    // Inisialisasi objek koneksi ke database
    $db = new DB($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Periksa apakah koneksi database berhasil
    if (!$db) {
        die("Koneksi database gagal");
    }

    // Buka koneksi database
    $db->open();

    // Inisialisasi objek label dengan menggunakan objek koneksi
    $label = new Label($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Mendapatkan data dari formulir
    $id = $_POST['id'];
    $nama_label = $_POST['nama_label'];

    // Memanggil fungsi untuk mengubah data label
    $result = $label->updateLabel($id, $nama_label);

    if ($result) {
        // Data berhasil diubah
        header("Location: label.php");
        exit();
    } else {
        // Terjadi kesalahan saat mengubah data
        echo "Terjadi kesalahan saat mengubah data label.";
    }
}

// Mendapatkan ID label yang akan diubah dari parameter URL
$id = $_GET['id'];

// Inisialisasi objek label
$label = new Label($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi untuk label
$label->open();

// Mendapatkan data label yang akan diubah
$data_label_result = $label->getLabelByID($id);

// Memastikan hasil kueri berhasil
if ($data_label_result) {
    // Mengambil baris data dari hasil kueri
    $data_label = $data_label_result->fetch_assoc();
} else {
    // Menampilkan pesan kesalahan jika terjadi masalah dengan hasil kueri
    echo "Terjadi kesalahan saat mengambil data label.";
}


// Template untuk form ubah label
$formUbahLabel = '
<div class="container mt-5 pt-3">
    <div class="row">
        <div class="col">
            <div class="card my-5 mx-5">
                <div class="card-header text-center">
                    <h3 class="my-0">Ubah Label</h3>
                </div>
                <div class="card-body">
                    <form action="ubahLabel.php" method="POST">
                        <input type="hidden" name="id" value="' . $id . '">
                        <div class="mb-3">
                            <label for="nama_label" class="form-label">Nama Label</label>
                            <input type="text" class="form-control" id="nama_label" name="nama_label" value="' . $data_label['nama_label'] . '" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>';

// Buat instance template
$home = new Template('templates/skinform.html');

// Simpan data ke template
$home->replace('DATA_FORM', $formUbahLabel);
$home->write();