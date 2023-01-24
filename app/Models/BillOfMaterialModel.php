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

    public function storeBillOfMaterial($idBom = false)
    {
        if (!$idBom) {
            $dataBom = [
                'id_perusahaan' => session()->get('idPerusahaan'),
                'id_produk' => $this->request->getVar('produk'),
                'status_aktif' => 1
            ];

            $this->db->table('bill_of_material')->insert($dataBom);
            $lastIdBom = $this->db->insertID();
        }

        $jumlahInput = (int)$this->request->getVar('jumlah_bom');
        for ($i = 1; $i <= $jumlahInput; $i++) {
            $dataDetailBom = [
                'id_bom' => $idBom ? $idBom : $lastIdBom,
                'id_bahan'  => $this->request->getVar("bahan_bom_{$i}"),
                'kuantitas'  => $this->request->getVar("kuantitas_bom_{$i}"),
                'status_aktif' => 1,
            ];

            $this->db->table('detail_bill_of_material')->insert($dataDetailBom);
        }
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

    public function editBillOfMaterial($idBom)
    {
        $query = $this->db->table('detail_bill_of_material')
            ->select('*')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_bill_of_material.id_bahan')
            ->where('detail_bill_of_material.id_bom', $idBom)
            ->where('detail_bill_of_material.status_aktif', 1)
            ->get();

        return $query;
    }

    public function updateBillOfMaterial()
    {
        $jumlahInputUpdate = $this->request->getVar('jumlah_bom_update');
        for ($i = 1; $i <= $jumlahInputUpdate; $i++) {
            $dataDetailBomUpdate = [
                'id_bom' => $this->request->getVar('id_bom_update'),
                'id_bahan'  => $this->request->getVar("bahan_bom_update{$i}"),
                'kuantitas'  => $this->request->getVar("kuantitas_bom_update{$i}"),
                'status_aktif' => 1,
            ];

            $this->db->table('detail_bill_of_material')
                ->where('id_detail_bom', $this->request->getVar("id_detail_bom{$i}"))
                ->update($dataDetailBomUpdate);
        }
    }

    public function removeBillOfMaterial()
    {
        $jumlahInputDelete = $this->request->getVar('jumlah_bom');
        for ($i = 1; $i <= $jumlahInputDelete; $i++) {
            $idDetailBom = $this->request->getVar("id_detail_bom{$i}");
            $data = [
                'status_aktif' => 0
            ];

            $this->db->table('detail_bill_of_material')
                ->where('id_detail_bom', $idDetailBom)
                ->update($data);
        }
    }

    public function removeAllBillOfMaterial($idBom)
    {
        $data = [
            'status_aktif' => 0
        ];

        $this->db->table('detail_bill_of_material')
            ->where('id_bom', $idBom)
            ->update($data);

        $this->db->table('bill_of_material')
            ->where('id_bom', $idBom)
            ->update($data);
    }

    public function getDataProduk()
    {
        $query = $this->db->table('produk')
            ->where('produk.id_perusahaan', session()->get('idPerusahaan'))
            ->get();

        return $query;
    }

    public function getNameProduk($idBom)
    {
        $query = $this->db->table('bill_of_material')
            ->select('*')
            ->join('produk', 'produk.id_produk = bill_of_material.id_produk')
            ->where('bill_of_material.id_bom', $idBom)
            ->get();

        foreach ($query->getResult() as $data) {
            $namaProduk = $data->nama_produk;
        }
        return $namaProduk;
    }
}
