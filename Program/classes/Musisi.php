<?php

class Musisi extends DB
{
    private $db;

    // Konstruktor kelas untuk menginisialisasi properti $db
    public function __construct($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME)
    {
        // Memanggil konstruktor kelas induk (DB)
        parent::__construct($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        
        // Inisialisasi objek koneksi basis data
        $this->db = new DB($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
    }

    function getMusisi()
    {
        $query = "SELECT * FROM musisi";
        return $this->execute($query);
    }

    function getMusisiById($id)
    {
        $query = "SELECT * FROM musisi WHERE id_musisi=$id";
        return $this->execute($query);
    }

    // Tambahkan fungsi untuk mendapatkan data musisi dalam bentuk array asosiatif
    function getMusisiArray()
    {
        $query = "SELECT id_musisi, nama_musisi FROM musisi";
        $result = $this->execute($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    //fungsi untuk menambahkan musisi
    function addMusisi($nama_musisi)
    {
        $query = "INSERT INTO musisi (nama_musisi) VALUES ('$nama_musisi')";
        return $this->executeAffected($query);
    }
    

    //fungsi untuk update musisi
    public function updateMusisi($id, $nama_musisi)
    {
        // Query untuk mengubah data musisi
        $query = "UPDATE musisi SET nama_musisi = '$nama_musisi' WHERE id_musisi = $id";

        // Execute query dan mengembalikan hasilnya
        return $this->db->executeAffected($query);
    }

    //fungsi untuk menghapus musisi
    function deleteMusisi($id)
    {
        $query = "DELETE FROM musisi WHERE id_musisi = ?";
        
        // Persiapkan parameter
        $types = "i"; // Sesuaikan dengan tipe data di database (integer)
        $params = array(&$types, &$id);
    
        // Execute query using the execute2 method
        $affectedRows = $this->execute2($query, $params);
    
        // Check if the query was successful
        if ($affectedRows > 0) {
            // Jika ada baris yang terpengaruh, penghapusan berhasil
            return true;
        } else {
            // Jika tidak ada baris yang terpengaruh, penghapusan gagal
            return false;
        }
    }
    
}
