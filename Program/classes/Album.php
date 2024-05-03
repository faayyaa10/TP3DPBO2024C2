<?php

class Album extends DB
{    
    private $db;

    public function __construct($hostname, $username, $password, $dbname)
    {
        // Memanggil konstruktor kelas induk (DB)
        parent::__construct($hostname, $username, $password, $dbname);
    }

    function getAlbumJoin()
    {
        $query = "SELECT * FROM album JOIN musisi ON Album.id_musisi=musisi.id_musisi JOIN label ON Album.id_label=label.id_label ORDER BY Album.id_album";

        return $this->execute($query);
    }

    function getAlbum()
    {
        $query = "SELECT * FROM album"; // Mengambil semua data album
        return $this->execute($query); // Eksekusi query
    }

    function getAlbumById($id)
    {
        $query = "SELECT * FROM album JOIN musisi ON Album.id_musisi=musisi.id_musisi JOIN label ON Album.id_label=label.id_label WHERE id_album=$id";
        return $this->execute($query);
    }

    function searchAlbum($keyword)
    {
        $query = "SELECT * FROM album 
                  JOIN musisi ON Album.id_musisi=musisi.id_musisi 
                  JOIN label ON Album.id_label=label.id_label 
                  WHERE nama_album LIKE '%$keyword%' OR nama_musisi LIKE '%$keyword%' OR nama_label LIKE '%$keyword%' 
                  ORDER BY id_album";
    
        return $this->execute($query);
    }

    function sortAlbum($sortBy)
    {
    // Pastikan $sortBy hanya menerima nilai 'asc' atau 'desc'
    $orderBy = ($sortBy == 'asc') ? 'ASC' : 'DESC';
    
    $query = "SELECT * FROM album 
              JOIN musisi ON Album.id_musisi=musisi.id_musisi 
              JOIN label ON Album.id_label=label.id_label 
              ORDER BY nama_album $orderBy";

    return $this->execute($query);
    }    
    
    //fungsi untuk menambah data album
    public function addData($nama_album, $title_track, $tahun_rilis, $jumlah_lagu, $id_musisi, $id_label, $photo_path)
    {
        // Query untuk menambahkan data album ke dalam tabel album
        $query = "INSERT INTO album (nama_album, title_track, tahun_rilis, jumlah_lagu, id_musisi, id_label, foto_album) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Persiapkan parameter
        $types = "sssiiss"; // Sesuaikan dengan tipe data di database
        // Perbaikan pada pemanggilan metode execute2
        $params = array(&$types, &$nama_album, &$title_track, &$tahun_rilis, &$jumlah_lagu, &$id_musisi, &$id_label, &$photo_path);

        // Execute query using the execute2 method dari kelas induk (DB)
        return $this->execute2($query, $params);
    }                          

    // fungsi untuk update data album
    public function updateData($id, $nama_album, $title_track, $tahun_rilis, $jumlah_lagu, $id_musisi, $id_label, $foto_album)
    {
        // Persiapkan query untuk mengubah data album
        $query = "UPDATE album SET nama_album = ?, title_track = ?, tahun_rilis = ?, jumlah_lagu = ?, id_musisi = ?, id_label = ?";

        // Jika foto album tidak kosong, tambahkan kolom foto_album ke dalam query
        if (!empty($foto_album)) {
            $query .= ", foto_album = ?";
        }

        // Tambahkan kondisi WHERE
        $query .= " WHERE id_album = ?";

        // Persiapkan parameter untuk binding
        $params = array('sssssss', &$nama_album, &$title_track, &$tahun_rilis, &$jumlah_lagu, &$id_musisi, &$id_label);

        // Jika foto album tidak kosong, tambahkan foto_album ke dalam parameter
        if (!empty($foto_album)) {
            $query .= ", ?";
            $params[] = &$foto_album;
        }

        // Tambahkan id_album ke dalam parameter
        $params[] = &$id;

        // Execute query dan kembalikan hasilnya
        return $this->execute2($query, $params);
    }


    //fungsi untuk menghapus data album
    function deleteData($id)
    {
        $query = "DELETE FROM album WHERE id_album = ?";
        
        // Persiapkan parameter
        $types = "i"; // Sesuaikan dengan tipe data di database (integer)
        $params = array(&$types, &$id);
    
        // Execute query using the execute2 method
        $result = $this->execute2($query, $params);
    
        // Check if the query was successful
        if ($result) {
            // Query berhasil dieksekusi
            return true;
        } else {
            // Query gagal dieksekusi
            return false;
        }
    }
    
}
