<?php
// Pengaturan koneksi ke database dan lainnya
include('config/db.php');
include('classes/DB.php');
include('classes/Label.php');
include('classes/Template.php');

// Cek apakah formulir telah disubmit
if (isset($_POST['submit'])) {
    // Mendapatkan data dari formulir
    $nama_label = $_POST['nama_label'];

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

    // Memanggil fungsi untuk menambahkan data label
    $result = $label->addLabel($nama_label);

    // Periksa apakah penambahan data berhasil
    if ($result) {
        // Data berhasil ditambahkan
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'label.php';
        </script>";
        exit();
    } else {
        // Terjadi kesalahan saat menambahkan data
        echo "<script>
            alert('Terjadi kesalahan saat menambahkan data label.');
            document.location.href = 'label.php';
        </script>";
    }
}

// Template untuk form tambah label
$formTambahLabel = '
<div class="container mt-5 pt-3">
    <div class="row">
        <div class="col">
            <div class="card my-5 mx-5">
                <div class="card-header">
                    <h3 class="my-0 float-start">Daftar Label</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <form action="tambahlabel.php" method="POST">
                        <div class="mb-3">
                            <label for="nama_label" class="form-label">Nama Label</label>
                            <input type="text" class="form-control" id="nama_label" name="nama_label" required>
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
$home->replace('DATA_FORM', $formTambahLabel);
$home->write();
