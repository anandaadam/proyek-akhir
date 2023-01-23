<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelianModel extends Model
{
    protected $request;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = db_connect();
        $this->session = session();
    }

    public function storeDetailPembelian()
    {
        $data = [
            'no_transaksi_pembelian' => $this->session->get('noPembelian'),
            'id_bahan' => $this->request->getVar('id_bahan'),
            'jumlah_pembelian' => $this->request->getVar('jumlah_pembelian'),
            'harga_pembelian' => preg_replace('/[^0-9 ]/i', '', $this->request->getVar('harga_pembelian')),
            'subtotal_pembelian' => $this->request->getVar('jumlah_pembelian') * preg_replace('/[^0-9 ]/i', '', $this->request->getVar('harga_pembelian')),
            'status_aktif' => 1
        ];
        $this->db->table('detail_pembelian')->insert($data);
    }

    public function itemDetailPembelian()
    {
        $query = $this->db->table('detail_pembelian')
            ->select('*')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_pembelian.id_bahan')
            ->where('detail_pembelian.no_transaksi_pembelian', $this->session->get('noPembelian'))
            ->where('detail_pembelian.status_aktif', 1)
            ->get();

        return $query;
    }

    public function cancelDetailPembelian($idDetailPembelian)
    {
        $data = [
            'status_aktif' => 0
        ];
        $this->db->table('detail_pembelian')->where('id_detail_pembelian', $idDetailPembelian)->update($data);
    }

    public function saveDetailPembelian()
    {
        $noPembelian = $this->session->get('noPembelian');
        $tipePembayaran = $this->session->get('tipePembayaran');
        $jumlahTotalPembelian =  substr(preg_replace('/[^0-9 ]/i', '', $this->request->getVar('jumlah_total_pembelian')), 0, -2);

        $dataTransaksi = [
            'nominal_transaksi' => $jumlahTotalPembelian
        ];
        $dataJurnal = [
            'nominal_jurnal' => $jumlahTotalPembelian
        ];
        $dataPembelian = [
            'total_pembelian' => $jumlahTotalPembelian
        ];

        $this->db->table('transaksi')->where('no_transaksi', $noPembelian)->update($dataTransaksi);
        $this->db->table('jurnal')->where('no_transaksi', $noPembelian)->update($dataJurnal);
        $this->db->table('pembelian')->where('no_transaksi_pembelian', $noPembelian)->update($dataPembelian);

        if ($tipePembayaran == 'kredit') {
            $dataUtang = [
                'total_utang_pembelian' => $jumlahTotalPembelian,
                'sisa_utang_pembelian' => $jumlahTotalPembelian
            ];

            $this->db->table('utang_pembelian')->where('no_transaksi_pembelian', $noPembelian)->update($dataUtang);
        }
    }

    public function getReturListBahan()
    {
        $query = $this->db->table('detail_pembelian')
            ->select('*')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_pembelian.id_bahan')
            ->where('detail_pembelian.no_transaksi_pembelian', $this->session->get('noPembelianUntukRetur'))
            ->where('detail_pembelian.status_aktif', 1)
            ->get();

        return $query;
    }
}
