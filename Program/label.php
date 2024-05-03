<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Label.php');
include('classes/Template.php');

$label = new Label($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$label->open();
$label->getLabel();

$label = new Label($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME); // Membuat objek dari kelas Label
$label->open(); // Membuka koneksi ke database
$label->getLabel(); // Mendapatkan data label

if (!isset($_GET['id'])) { // Jika tidak ada parameter id pada URL
    if (isset($_POST['submit'])) { // Jika tombol submit ditekan
        if ($label->addLabel($_POST['nama_label']) > 0) { // Jika penambahan label berhasil
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'label.php';
            </script>"; // Menampilkan pesan berhasil dan redirect ke halaman label
        } else { // Jika penambahan label gagal
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'label.php';
            </script>"; // Menampilkan pesan gagal dan redirect ke halaman label
        }
    }

    $btn = 'Tambah'; // Set teks tombol tambah
    $title = 'Tambah'; // Set judul halaman
}

$view = new Template('templates/skintabel.html'); // Membuat objek Template untuk tampilan tabel

$mainTitle = 'Label'; // Judul utama halaman
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Label</th>
<th scope="row">Aksi</th>
</tr>'; // Header tabel
$data = null; // Data tabel
$no = 1; // Nomor urut

$formLabel = 'label'; // Form label

while ($div = $label->getResult()) { // Melakukan iterasi untuk setiap hasil query label
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_label'] . '</td>
    <td style="font-size: 22px;">
        <a href="ubahLabel.php?id=' . $div['id_label'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="Label.php?hapus=' . $div['id_label'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>'; // Menampilkan data label dan tombol edit dan hapus
    $no++; // Increment nomor urut
}

if (isset($_GET['id'])) { // Jika ada parameter id pada URL
    $id = $_GET['id']; // Ambil nilai id
    if ($id > 0) { // Jika id valid
        if (isset($_POST['submit'])) { // Jika tombol submit ditekan
            if ($label->updateLabel($id, $_POST) > 0) { // Jika update label berhasil
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'label.php';
            </script>"; // Menampilkan pesan berhasil dan redirect ke halaman label
            } else { // Jika update label gagal
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'label.php';
            </script>"; // Menampilkan pesan gagal dan redirect ke halaman label
            }
        }

        $label->getLabelById($id); // Mendapatkan data label berdasarkan id
        $row = $label->getResult(); // Menyimpan hasil query

        $dataUpdate = $row['nama_label']; // Menyimpan data label yang akan diupdate
        $btn = 'Simpan'; // Set teks tombol simpan
        $title = 'Ubah'; // Set judul halaman

        $view->replace('DATA_VAL_UPDATE', $dataUpdate); // Mengganti nilai variabel pada template
    }
}

if (isset($_GET['hapus'])) { // Jika ada parameter hapus pada URL
    $id = $_GET['hapus']; // Ambil nilai id
    if ($id > 0) { // Jika id valid
        if ($label->deleteLabel($id) > 0) { // Jika penghapusan label berhasil
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'label.php';
            </script>"; // Menampilkan pesan berhasil dan redirect ke halaman label
        } else { // Jika penghapusan label gagal
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'label.php';
            </script>"; // Menampilkan pesan gagal dan redirect ke halaman label
        }
    }
}

$label->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
