<?php
include('config/db.php');
include('classes/DB.php'); // Sertakan kelas DB
include('classes/Album.php');
include('classes/Template.php');

// Membuat objek koneksi ke database
$db = new DB($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// Buka koneksi database
$db->open();

// buat instance album
$listalbum = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listalbum->open();

// tampilkan data album
if (isset($_POST['btn-cari'])) {
    // methode mencari data album
    $listalbum->searchAlbum($_POST['cari']);
} elseif (isset($_GET['sort'])) {
    // jika ada permintaan pengurutan
    $listalbum->sortAlbum($_GET['sort']);
} else {
    // method menampilkan data album
    $listalbum->getAlbumJoin();
}

$data = null;

// ambil data album
$counter = 0;
while ($row = $listalbum->getResult()) {
    if ($counter % 4 == 0) {
        // Awal baris baru
        $data .= '<div class="row mb-3">';
    }
    $data .= '
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card pt-4 px-2 album-thumbnail">
            <a href="detail.php?id=' . $row['id_album'] . '">
                <div class="row justify-content-center">
                    <img src="assets/images/' . $row['foto_album'] . '" class="card-img-top" alt="' . $row['foto_album'] . '">
                </div>
                <div class="card-body">
                    <p class="card-text album-nama my-0">' . $row['nama_album'] . '</p>
                    <p class="card-text tahun-nama my-0">' . $row['tahun_rilis'] . '</p>
                    <p class="card-text musisi-nama">' . $row['nama_musisi'] . '</p>
                </div>
            </a>
        </div>    
    </div>';
    $counter++;
    if ($counter % 4 == 0) {
        // Akhir baris
        $data .= '</div>';
    }
}

// tutup koneksi
$listalbum->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_ALBUM', $data);
$home->write();
