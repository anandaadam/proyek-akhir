<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $request;
    protected $db;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = db_connect();
    }

    public function indexSupplier()
    {
        $query = $this->db->table('supplier')
            ->where('status_aktif', 1)
            ->where('id_perusahaan', session()->get('idPerusahaan'))->get();

        return $query;
    }

    public function storeSupplier()
    {
        $data = [
            'id_perusahaan' => session()->get('idPerusahaan'),
            'nama_supplier'  => trim($this->request->getVar('nama_supplier')),
            'telepon_supplier'  => trim($this->request->getVar('telepon_supplier')),
            'alamat_supplier' => trim($this->request->getVar('alamat_supplier')),
            'status_aktif' => 1,
        ];
        $this->db->table('supplier')->insert($data);
    }

    public function editSupplier($idSupplier)
    {
        $query = $this->db->table('supplier')->where('id_supplier', $idSupplier)->get();
        return $query;
    }

    public function updateSupplier($idSupplier)
    {
        $data = [
            'nama_supplier'  => trim($this->request->getVar('nama_supplier')),
            'telepon_supplier'  => trim($this->request->getVar('telepon_supplier')),
            'alamat_supplier' => trim($this->request->getVar('alamat_supplier')),
        ];
        $this->db->table('supplier')->where('id_supplier', $idSupplier)->update($data);
    }

    public function removeSupplier($idSupplier)
    {
        $data = [
            'status_aktif' => 0
        ];
        $this->db->table('supplier')->where('id_supplier', $idSupplier)->update($data);
    }
}
