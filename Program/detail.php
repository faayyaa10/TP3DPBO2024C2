<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Album.php');
include('classes/Musisi.php');
include('classes/Label.php');
include('classes/Template.php');

$album = new Album($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$album->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $album->getAlbumById($id);
        $row = $album->getResult();

        $data .= '
        <div class="card-header text-center">
            <h3 class="my-0">Detail ' . $row['nama_album'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['foto_album'] . '" class="img-thumbnail" alt="' . $row['album_foto'] . '" width="60">
                    </div>
                </div>
                <div class="col-9">
                    <div class="card px-3">
                        <table border="0" class="text-start">
                            <tr>
                                <td>Nama Album</td>
                                <td>:</td>
                                <td>' . $row['nama_album'] . '</td>
                            </tr>
                            <tr>
                                <td>Nama Musisi</td>
                                <td>:</td>
                                <td>' . $row['nama_musisi'] . '</td>
                            </tr>
                            <tr>
                                <td>Title Track</td>
                                <td>:</td>
                                <td>' . $row['title_track'] . '</td>
                            </tr>
                            <tr>
                                <td>Tahun Rilis</td>
                                <td>:</td>
                                <td>' . $row['tahun_rilis'] . '</td>
                            </tr>
                            <tr>
                                <td>Jumlah Lagu</td>
                                <td>:</td>
                                <td>' . $row['jumlah_lagu'] . '</td>
                            </tr>
                            <tr>
                                <td>Label</td>
                                <td>:</td>
                                <td>' . $row['nama_label'] . '</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="ubahAlbum.php?id=' . $id . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
            <a href="hapusAlbum.php?id=' . $id . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
        </div>';
    }
}

$album->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_ALBUM', $data);
$detail->write();
