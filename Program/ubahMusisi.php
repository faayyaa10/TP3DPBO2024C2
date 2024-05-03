<?php
// Pengaturan koneksi ke database dan lainnya
include('config/db.php');
include('classes/DB.php');
include('classes/Musisi.php');
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

    // Inisialisasi objek musisi dengan menggunakan objek koneksi
    $musisi = new Musisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Mendapatkan data dari formulir
    $id = $_POST['id'];
    $nama_musisi = $_POST['nama_musisi'];

    // Memanggil fungsi untuk mengubah data musisi
    $result = $musisi->updateMusisi($id, $nama_musisi);

    if ($result) {
        // Data berhasil diubah
        header("Location: musisi.php");
        exit();
    } else {
        // Terjadi kesalahan saat mengubah data
        echo "Terjadi kesalahan saat mengubah data musisi.";
    }
}

// Mendapatkan ID musisi yang akan diubah dari parameter URL
$id = $_GET['id'];

// Inisialisasi objek musisi
$musisi = new Musisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi untuk musisi
$musisi->open();

// Mendapatkan data musisi yang akan diubah
$data_musisi_result = $musisi->getMusisiById($id);

// Memastikan hasil kueri berhasil
if ($data_musisi_result) {
    // Mengambil baris data dari hasil kueri
    $data_musisi = $data_musisi_result->fetch_assoc();
} else {
    // Menampilkan pesan kesalahan jika terjadi masalah dengan hasil kueri
    echo "Terjadi kesalahan saat mengambil data musisi.";
}


// Template untuk form ubah musisi
$formUbahMusisi = '
<div class="container mt-5 pt-3">
    <div class="row">
        <div class="col">
            <div class="card my-5 mx-5">
                <div class="card-header text-center">
                    <h3 class="my-0">Ubah Musisi</h3>
                </div>
                <div class="card-body">
                    <form action="ubahMusisi.php" method="POST">
                        <input type="hidden" name="id" value="' . $id . '">
                        <div class="mb-3">
                            <label for="nama_musisi" class="form-label">Nama Musisi</label>
                            <input type="text" class="form-control" id="nama_musisi" name="nama_musisi" value="' . $data_musisi['nama_musisi'] . '" required>
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
$home->replace('DATA_FORM', $formUbahMusisi);
$home->write();
