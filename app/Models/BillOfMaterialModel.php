<?php

namespace App\Models;

use CodeIgniter\Model;

class BillOfMaterialModel extends Model
{
    protected $request;
    protected $db;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = db_connect();
    }

    public function indexBillOfMaterial()
    {
        $query = $this->db->table('bill_of_material')
            ->join('produk', 'produk.id_produk = bill_of_material.id_produk')
            ->where('bill_of_material.status_aktif', 1)
            ->where('bill_of_material.id_perusahaan', session()->get('idPerusahaan'))
            ->get();

        return $query;
    }

    public function storeBillOfMaterial()
    {
    }

    public function showBillOfMaterial($idBom)
    {
        $query = $this->db->table('detail_bill_of_material')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_bill_of_material.id_bahan')
            ->where('detail_bill_of_material.id_bom', $idBom)
            ->where('detail_bill_of_material.status_aktif', 1)
            ->get();

        return $query;
    }

    public function editBillOfMaterial()
    {
    }

    public function updateBillOfMaterial()
    {
    }

    public function removeBillOfMaterial()
    {
    }

    public function getDataProduk()
    {
        $query = $this->db->table('produk')
            ->where('produk.id_perusahaan', session()->get('idPerusahaan'))
            ->get();

        return $query;
    }
}
