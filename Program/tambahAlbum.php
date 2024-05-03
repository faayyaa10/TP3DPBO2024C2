<?php
// Pengaturan koneksi ke database dan lainnya
include('config/db.php');
include('classes/DB.php');
include('classes/Album.php');
include('classes/Musisi.php');
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

    // Inisialisasi objek album dengan menggunakan objek koneksi
    $album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

    // Mendapatkan data dari formulir
    $nama_album = $_POST['nama_album'];
    $title_track = $_POST['title_track'];
    $tahun_rilis = $_POST['tahun_rilis'];
    $jumlah_lagu = $_POST['jumlah_lagu'];
    $id_musisi = $_POST['musisi'];
    $id_label = $_POST['label'];

    // Periksa apakah file telah diunggah dengan sukses sebelum mengaksesnya
    if (isset($_FILES['foto_album']) && $_FILES['foto_album']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        // Handle file upload
    $file_name = $_FILES['foto_album']['name'];
    $path = 'assets/images/' . $file_name;

    // Pindahkan file ke direktori upload
    if (move_uploaded_file($_FILES['foto_album']['tmp_name'], $path)) {
    // Memanggil fungsi untuk menambahkan data album
    $result = $album->addData($nama_album, $title_track, $tahun_rilis, $jumlah_lagu, $id_musisi, $id_label, $file_name);


            if ($result) {
                // Data berhasil ditambahkan
                header("Location: index.php");
                exit();
            } else {
                // Terjadi kesalahan saat menambahkan data
                echo "Terjadi kesalahan saat menambahkan data album.";
            }
        } else {
            // Menampilkan pesan kesalahan jika file tidak diunggah dengan sukses
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        // Menampilkan pesan kesalahan jika file tidak diunggah
        echo "Silakan pilih file gambar album.";
    }
}


// Inisialisasi objek musisi
$musisi = new Musisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Inisialisasi objek label
$label = new Label($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Buka koneksi untuk musisi dan label
$musisi->open();
$label->open();

// Mendapatkan data musisi dan label dalam bentuk array asosiatif
$data_musisi = $musisi->getMusisiArray();
$data_label = $label->getLabelArray();

// Template untuk form tambah album
$formTambahAlbum = '
<div class="container mt-5 pt-3">
    <div class="row">
        <div class="col">
            <div class="card my-5 mx-5">
                <div class="card-header text-center">
                    <h3 class="my-0">Tambah Album</h3>
                </div>
                <div class="card-body">
                    <form action="tambahAlbum.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_album" class="form-label">Nama Album</label>
                            <input type="text" class="form-control" id="nama_album" name="nama_album" required>
                        </div>
                        <div class="mb-3">
                            <label for="title_track" class="form-label">Title Track Album</label>
                            <input type="text" class="form-control" id="title_track" name="title_track" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_rilis" class="form-label">Tahun Rilis</label>
                            <input type="text" class="form-control" id="tahun_rilis" name="tahun_rilis" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_lagu" class="form-label">Jumlah Lagu</label>
                            <input type="text" class="form-control" id="jumlah_lagu" name="jumlah_lagu" required>
                        </div>
                        <div class="mb-3">
                            <label for="musisi" class="form-label">Musisi</label>
                            <select class="form-select" id="musisi" name="musisi" required>
                                <option value="">Pilih Musisi</option>';
                                foreach ($data_musisi as $musisi) {
                                    $formTambahAlbum .= '<option value="' . $musisi['id_musisi'] . '">' . $musisi['nama_musisi'] . '</option>';
                                }
                            $formTambahAlbum .= '
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <select class="form-select" id="label" name="label" required>
                                <option value="">Pilih Label</option>';
                                foreach ($data_label as $label) {
                                    $formTambahAlbum .= '<option value="' . $label['id_label'] . '">' . $label['nama_label'] . '</option>';
                                }
                            $formTambahAlbum .= '
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto_album" class="form-label">Foto Album</label>
                            <input type="file" class="form-control" id="foto_album" name="foto_album" accept="image/*" required>
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
$home->replace('DATA_FORM', $formTambahAlbum);
$home->write();