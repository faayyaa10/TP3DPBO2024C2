<?php
// Pengaturan koneksi ke database dan lainnya
include('config/db.php');
include('classes/DB.php');
include('classes/Musisi.php');
include('classes/Template.php');

// Cek apakah formulir telah disubmit
if (isset($_POST['submit'])) {
    // Mendapatkan data dari formulir
    $nama_musisi = $_POST['nama_musisi'];

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

    // Memanggil fungsi untuk menambahkan data musisi
    $result = $musisi->addMusisi($nama_musisi);

    // Periksa apakah penambahan data berhasil
    if ($result) {
        // Data berhasil ditambahkan
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'musisi.php';
        </script>";
        exit();
    } else {
        // Terjadi kesalahan saat menambahkan data
        echo "<script>
            alert('Terjadi kesalahan saat menambahkan data musisi.');
            document.location.href = 'musisi.php';
        </script>";
    }
}


// Template untuk form tambah musisi
$formTambahMusisi = '
<div class="container mt-5 pt-3">
    <div class="row">
        <div class="col">
            <div class="card my-5 mx-5">
                <div class="card-header">
                    <h3 class="my-0 float-start">Daftar Musisi</h3>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <form action="tambahMusisi.php" method="POST">
                        <div class="mb-3">
                            <label for="nama_musisi" class="form-label">Nama Musisi</label>
                            <input type="text" class="form-control" id="nama_musisi" name="nama_musisi" required>
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
$home->replace('DATA_FORM', $formTambahMusisi);
$home->write();

