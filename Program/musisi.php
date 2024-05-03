<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Musisi.php');
include('classes/Template.php');

$musisi = new Musisi($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$musisi->open();
$musisi->getMusisi();

if (!isset($_GET['id'])) { // Jika tidak ada parameter id pada URL
    if (isset($_POST['submit'])) { // Jika tombol submit ditekan
        if ($musisi->addMusisi($_POST['nama_musisi']) > 0) { // Jika penambahan musisi berhasil
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'musisi.php';
            </script>"; // Menampilkan pesan berhasil dan redirect ke halaman musisi
        } else { // Jika penambahan musisi gagal
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'musisi.php';
            </script>"; // Menampilkan pesan gagal dan redirect ke halaman musisi
        }
    }

    $btn = 'Tambah'; // Set teks tombol tambah
    $title = 'Tambah'; // Set judul halaman
}

$view = new Template('templates/skintabel.html'); // Membuat objek Template untuk tampilan tabel

$mainTitle = 'Musisi'; // Judul utama halaman
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Musisi</th>
<th scope="row">Aksi</th>
</tr>'; // Header tabel
$data = null; // Data tabel
$no = 1; // Nomor urut

$formLabel = 'musisi'; // Form label

while ($div = $musisi->getResult()) { // Melakukan iterasi untuk setiap hasil query musisi
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_musisi'] . '</td>
    <td style="font-size: 22px;">
        <a href="ubahMusisi.php?id=' . $div['id_musisi'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="musisi.php?hapus=' . $div['id_musisi'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>'; // Menampilkan data musisi dan tombol edit dan hapus
    $no++; // Increment nomor urut
}

if (isset($_GET['id'])) { // Jika ada parameter id pada URL
    $id = $_GET['id']; // Ambil nilai id
    if ($id > 0) { // Jika id valid
        if (isset($_POST['submit'])) { // Jika tombol submit ditekan
            if ($musisi->updateMusisi($id, $_POST) > 0) { // Jika update musisi berhasil
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'musisi.php';
            </script>"; // Menampilkan pesan berhasil dan redirect ke halaman musisi
            } else { // Jika update musisi gagal
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'musisi.php';
            </script>"; // Menampilkan pesan gagal dan redirect ke halaman musisi
            }
        }

        $musisi->getMusisiById($id); // Mendapatkan data musisi berdasarkan id
        $row = $musisi->getResult(); // Menyimpan hasil query

        $dataUpdate = $row['nama_musisi']; // Menyimpan data musisi yang akan diupdate
        $btn = 'Simpan'; // Set teks tombol simpan
        $title = 'Ubah'; // Set judul halaman

        $view->replace('DATA_VAL_UPDATE', $dataUpdate); // Mengganti nilai variabel pada template
    }
}

if (isset($_GET['hapus'])) { // Jika ada parameter hapus pada URL
    $id = $_GET['hapus']; // Ambil nilai id
    if ($id > 0) { // Jika id valid
        if ($musisi->deleteMusisi($id) > 0) { // Jika penghapusan musisi berhasil
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'musisi.php';
            </script>"; // Menampilkan pesan berhasil dan redirect ke halaman musisi
        } else { // Jika penghapusan musisi gagal
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'musisi.php';
            </script>"; // Menampilkan pesan gagal dan redirect ke halaman musisi
        }
    }
}


$musisi->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
