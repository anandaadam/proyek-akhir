<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailReturPembelianModel extends Model
{
    public $nilaiReturPembelian;
    public $sisaUtangPembelianLama;
    protected $request;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = db_connect();
        $this->session = session();
    }

    public function storeDetailReturPembelian()
    {
        $data = [
            'no_transaksi_retur_pembelian' => $this->session->get('noReturPembelian'),
            'id_bahan' => trim($this->request->getVar('id_bahan')),
            'jumlah_retur_pembelian' => trim($this->request->getVar('jumlah_retur_pembelian')),
            'harga_retur_pembelian' => preg_replace('/[^0-9 ]/i', '', trim($this->request->getVar('harga_retur_pembelian'))),
            'subtotal_retur_pembelian' => trim($this->request->getVar('jumlah_retur_pembelian')) * preg_replace('/[^0-9 ]/i', '', trim($this->request->getVar('harga_retur_pembelian'))),
            'status_aktif' => 1
        ];

        $this->db->table('detail_retur_pembelian')->insert($data);
    }

    public function itemDetailReturPembelian()
    {

        $query = $this->db->table('detail_retur_pembelian')
            ->select('*')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_retur_pembelian.id_bahan')
            ->where('detail_retur_pembelian.no_transaksi_retur_pembelian', $this->session->get('noReturPembelian'))
            ->where('detail_retur_pembelian.status_aktif', 1)
            ->get();

        return $query;
    }

    public function cancelDetailReturPembelian($idDetailReturPembelian)
    {
        $data = [
            'status_aktif' => 0
        ];
        $this->db->table('detail_retur_pembelian')
            ->where('id_detail_retur_pembelian', $idDetailReturPembelian)
            ->update($data);
    }

    public function getDataUtang()
    {

        $dataSisaUtangPembelian = $this->db->table('utang_pembelian')
            ->select('nilai_retur_pembelian, sisa_utang_pembelian')
            ->get();

        foreach ($dataSisaUtangPembelian->getResult() as $data) {
            $this->nilaiReturPembelian = $data->nilai_retur_pembelian;
            $this->sisaUtangPembelianLama = $data->sisa_utang_pembelian;
        }
    }

    public function saveDetailReturPembelian()
    {
        $this->getDataUtang();

        $noReturPembelian = $this->session->get('noReturPembelian');
        $tipePembayaranReturPembelian = $this->session->get('tipePembayaranReturPembelian');

        $jumlahTotalReturPembelian = trim($this->request->getVar('jumlah_total_retur_pembelian'));

        $dataTransaksi = [
            'nominal_transaksi' => $jumlahTotalReturPembelian
        ];
        $dataJurnal = [
            'nominal_jurnal' => $jumlahTotalReturPembelian
        ];
        $dataReturPembelian = [
            'total_retur_pembelian' => $jumlahTotalReturPembelian
        ];

        $this->db->table('transaksi')
            ->where('no_transaksi', $noReturPembelian)
            ->update($dataTransaksi);

        $this->db->table('jurnal')
            ->where('no_transaksi', $noReturPembelian)
            ->update($dataJurnal);

        $this->db->table('retur_pembelian')
            ->where('no_transaksi_retur_pembelian', $noReturPembelian)
            ->update($dataReturPembelian);

        if ($tipePembayaranReturPembelian == 'kredit') {
            $dataUtang = [
                'nilai_retur_pembelian' => $this->nilaiReturPembelian + $jumlahTotalReturPembelian,
                'sisa_utang_pembelian' => $this->sisaUtangPembelianLama - $jumlahTotalReturPembelian
            ];

            $this->db->table('utang_pembelian')
                ->where('no_transaksi_pembelian', $this->session->get('noPembelianUntukRetur'))
                ->update($dataUtang);
        }
    }
}
