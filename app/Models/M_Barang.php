<?php

namespace App\Models;

use CodeIgniter\Model as CodeIgniterModel;

class M_Barang extends CodeIgniterModel
{
    protected $model;
    protected $table      = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = ['id_barang', 'nama_barang', 'stok', 'harga_barang', 'nama_file'];

    public function getAll()
    {

        $sql = "SELECT * FROM barang";

        // eksekusi sql di atas
        $db = db_connect();
        $data = $db->query("SELECT * FROM {$this->table}");

        // return by array
        return $data->getResultArray();
    }

    public function __construct()
    {
        $this->db = db_connect();
    }

    //store data barang
    public function barang_store($data)
    {
        return $this->db->query("INSERT INTO {$this->table} (nama_barang, stok, harga_barang, nama_file) VALUES ('{$data['nama_barang']}', '{$data['stok']}', '{$data['harga_barang']}', '{$data['nama_file']}')");
    }

    // get data barang berdasarkan id_barang
    public function barang_get($id_barang)
    {
        $data = $this->db->query("SELECT * FROM {$this->table} WHERE id_barang = '{$id_barang}'");
        $this->db->close();
        return $data->getRowArray();
    }

    // hapus data barang berdasarkan id barang
    public function barang_destroy($id_barang)
    {
        return $this->db->query("DELETE FROM {$this->table} WHERE id_barang = '{$id_barang}'");
    }

    // update data barang berdasarkan id barang
    public function barang_update($data)
    {
        return $this->db->query("UPDATE {$this->table} SET id_barang = '{$data['id_barang']}', nama_barang = '{$data['nama_barang']}', stok = '{$data['stok']}', nama_barang = '{$data['harga_barang']}', nama_file = '{$data['nama_file']}'WHERE id_barang = '{$data['id_barang']}'");
    }

    public function barang_kurang_stok($id_barang, $quantity = 1)
    {
        $barang = $this->db->query("SELECT * FROM {$this->table} WHERE id_barang = '{$id_barang}'")->getRowArray();
        $new_stok = $barang['stok'] - $quantity;
        return $this->db->query("UPDATE {$this->table} SET stok = '{$new_stok}' WHERE id_barang = '{$id_barang}'");
    }

    public function barang_tambah_stok($id_barang, $quantity = 1)
    {
        $barang = $this->db->query("SELECT * FROM {$this->table} WHERE id_barang = '{$id_barang}'")->getRowArray();
        $new_stok = $barang['stok'] + $quantity;
        return $this->db->query("UPDATE {$this->table} SET stok = '{$new_stok}' WHERE id_barang = '{$id_barang}'");
    }
}
