<?php

namespace App\Models;

use CodeIgniter\Model;

class PersediaanBahanModel extends Model
{
    protected $request;
    protected $db;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = db_connect();
    }

    public function indexPersediaanBahan()
    {
        $query = $this->db->table('persediaan_bahan')
            ->select('*')
            ->join('jenis_satuan', 'jenis_satuan.id_jenis_satuan = persediaan_bahan.id_jenis_satuan')
            ->where('persediaan_bahan.status_aktif', 1)
            ->where('persediaan_bahan.id_perusahaan', session()->get('idPerusahaan'))
            ->get();

        return $query;
    }
    public function storePersediaanBahan()
    {
        $data = [
            'id_perusahaan' => session()->get('idPerusahaan'),
            'nama_bahan'  => trim($this->request->getVar('nama_bahan')),
            'harga_bahan' => trim($this->request->getVar('harga_bahan')),
            'stok_bahan'  => trim($this->request->getVar('stok_bahan')),
            'id_jenis_satuan' => trim($this->request->getVar('jenis_satuan')),
            'status_aktif' => 1,

        ];
        $this->db->table('persediaan_bahan')->insert($data);
    }
    public function editPersediaanBahan($idBahan)
    {
        $query = $this->db->table('persediaan_bahan')->where('id_bahan', $idBahan)->get();
        return $query;
    }
    public function updatePersediaanBahan($idBahan)
    {
        $data = [
            'nama_bahan'  => trim($this->request->getVar('nama_bahan')),
            'harga_bahan' => trim($this->request->getVar('harga_bahan')),
            'stok_bahan'  => trim($this->request->getVar('stok_bahan')),
            'id_jenis_satuan' => trim($this->request->getVar('jenis_satuan')),
        ];
        $this->db->table('persediaan_bahan')->where('id_bahan', $idBahan)->update($data);
    }
    public function removePersediaanBahan($idBahan)
    {
        $data = [
            'status_aktif' => 0
        ];
        $this->db->table('persediaan_bahan')->where('id_bahan', $idBahan)->update($data);
    }
}
