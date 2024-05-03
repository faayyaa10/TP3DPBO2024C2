<?php

class Label extends DB
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

    function getLabel()
    {
        $query = "SELECT * FROM label";
        return $this->execute($query);
    }

    function getLabelById($id)
    {
        $query = "SELECT * FROM label WHERE id_label=$id";
        return $this->execute($query);
    }

    // Tambahkan fungsi untuk mendapatkan data label dalam bentuk array asosiatif
    function getLabelArray()
    {
        $query = "SELECT id_label, nama_label FROM label";
        $result = $this->execute($query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    //fungsi untuk menambahkan label
    function addLabel($nama_label)
    {
        $query = "INSERT INTO label (nama_label) VALUES ('$nama_label')";
        return $this->executeAffected($query);
    }

    //fungsi untuk update label
    public function updateLabel($id, $nama_label)
    {
        // Query untuk mengubah data label
        $query = "UPDATE label SET nama_label = '$nama_label' WHERE id_label = $id";

        // Execute query dan mengembalikan hasilnya
        return $this->db->executeAffected($query);
    }

    //fungsi untuk menghapus label
    function deleteLabel($id)
    {
        $query = "DELETE FROM label WHERE id_label = ?";
        
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
