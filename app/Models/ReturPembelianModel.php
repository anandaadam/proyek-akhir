<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturPembelianModel extends Model
{
    public $noTransaksi;
    public $noTransaksiMax;
    protected $request;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = db_connect();
        $this->session = session();
    }

    public function indexReturPembelian()
    {
        $query = $this->db->table('retur_pembelian')
            ->select('*')
            ->join('supplier', 'supplier.id_supplier = retur_pembelian.id_supplier')
            ->join('transaksi', 'transaksi.no_transaksi = retur_pembelian.no_transaksi_retur_pembelian')
            ->where('retur_pembelian.status_aktif', 1)
            ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
            ->orderBy('retur_pembelian.no_transaksi_pembelian', 'DESC')
            ->get();

        return $query;
    }

    public function findPembelian($noPembelian)
    {
        $query = $this->db->table('pembelian')
            ->select('*')
            ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier')
            ->where('pembelian.no_transaksi_pembelian', $noPembelian)
            ->get();

        return $query;
    }

    public function getNoTransaksi($tanggal)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(no_transaksi,4)) AS trs_max FROM transaksi WHERE DATE(tanggal_transaksi)=?", $tanggal)->getResult();

        foreach ($query as $data) {
            $this->noTransaksiMax = (int)$data->trs_max;
        }

        $this->noTransaksiMax ? $this->noTransaksi = sprintf("%04s", $this->noTransaksiMax + 1) : $this->noTransaksi = '0001';
    }

    public function storeReturPembelian()
    {
        $idSupplier = trim($this->request->getVar('id_supplier'));
        $catatanTransaksi = trim($this->request->getVar('catatan_transaksi'));
        $tanggalReturPembelian = trim($this->request->getVar('tanggal_retur_pembelian'));
        $nomorPembelian = trim($this->request->getVar('nomor_pembelian'));
        $tipePembayaran = trim($this->request->getVar('tipe_pembayaran'));

        $this->getNoTransaksi($tanggalReturPembelian);
        $setNoTransaksi = 'TRS' . preg_replace('/[^0-9 ]/i', '', $tanggalReturPembelian) . $this->noTransaksi;

        $dataTransaksi = [
            'no_transaksi' => $setNoTransaksi,
            'id_perusahaan' => $this->session->get('idPerusahaan'),
            'catatan_transaksi'  => $catatanTransaksi,
            'nominal_transaksi'  => 0,
            'tanggal_transaksi' => $tanggalReturPembelian,
            'status_aktif' => 1
        ];

        $dataReturPembelian = [
            'no_transaksi_retur_pembelian' => $setNoTransaksi,
            'no_transaksi_pembelian' => $nomorPembelian,
            'id_supplier'  => $idSupplier,
            'total_retur_pembelian'  => 0,
            'tanggal_retur_pembelian' => $tanggalReturPembelian,
            'status_aktif' => 1
        ];

        $this->db->table('transaksi')->insert($dataTransaksi);
        $this->db->table('retur_pembelian')->insert($dataReturPembelian);

        if ($tipePembayaran == 'kas') {
            $dataJurnal = [
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 11111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Debit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalReturPembelian,
                    'status_aktif' => 1,
                ],
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 15111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Kredit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalReturPembelian,
                    'status_aktif' => 1
                ]
            ];

            $this->db->table('jurnal')->insertBatch($dataJurnal);
        }

        if ($tipePembayaran == 'kredit') {
            $dataJurnal = [
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 21111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Debit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalReturPembelian,
                    'status_aktif' => 1,
                ],
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 15111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Kredit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalReturPembelian,
                    'status_aktif' => 1
                ]
            ];

            $this->db->table('jurnal')->insertBatch($dataJurnal);
        }

        $this->session->set(['noReturPembelian' => $setNoTransaksi]);
        $this->session->set(['noPembelianUntukRetur' => $nomorPembelian]);
        $this->session->set(['tipePembayaranReturPembelian' => $tipePembayaran]);
    }

    public function showReturPembelian($noTransaksiReturPembelian)
    {
        $query = $this->db->table('detail_retur_pembelian')
            ->select('*')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_retur_pembelian.id_bahan')
            ->where('detail_retur_pembelian.no_transaksi_retur_pembelian', $noTransaksiReturPembelian)
            ->where('detail_retur_pembelian.status_aktif', 1)
            ->get();

        return $query;
    }
}
