<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
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

    public function getNoTransaksi($tanggal)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(no_transaksi,4)) AS trs_max FROM transaksi WHERE DATE(tanggal_transaksi) = ?", $tanggal)->getResult();

        foreach ($query as $data) {
            $this->noTransaksiMax = (int)$data->trs_max;
        }

        $this->noTransaksiMax ? $this->noTransaksi = sprintf("%04s", $this->noTransaksiMax + 1) : $this->noTransaksi = '0001';
    }

    public function indexPembelian()
    {
        $query = $this->db->table('pembelian')
            ->select('*')
            ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier')
            ->join('transaksi', 'transaksi.no_transaksi = pembelian.no_transaksi_pembelian')
            ->where('pembelian.status_aktif', 1)
            ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
            ->orderBy('pembelian.no_transaksi_pembelian', 'DESC')
            ->get();

        return $query;
    }

    public function storePembelian()
    {
        $idSupplier = trim($this->request->getVar('id_supplier'));
        $tanggalPembelian = trim($this->request->getVar('tanggal_pembelian'));
        $tipePembayaran = trim($this->request->getVar('tipe_pembayaran'));
        $catatanTransaksi = trim($this->request->getVar('catatan_transaksi'));

        $this->getNoTransaksi($tanggalPembelian);
        $setNoTransaksi = 'TRS' . preg_replace('/[^0-9 ]/i', '', $tanggalPembelian) . $this->noTransaksi;

        $dataTransaksi = [
            'no_transaksi' => $setNoTransaksi,
            'id_perusahaan' => $this->session->get('idPerusahaan'),
            'catatan_transaksi'  => $catatanTransaksi,
            'nominal_transaksi'  => 0,
            'tanggal_transaksi' => $tanggalPembelian,
            'status_aktif' => 1
        ];

        $dataPembelian = [
            'no_transaksi_pembelian' => $setNoTransaksi,
            'id_supplier'  => $idSupplier,
            'total_pembelian'  => 0,
            'tanggal_pembelian' => $tanggalPembelian,
            'tipe_pembayaran' => $tipePembayaran,
            'status_aktif' => 1
        ];

        $this->db->table('transaksi')->insert($dataTransaksi);
        $this->db->table('pembelian')->insert($dataPembelian);

        if ($tipePembayaran == 'kas') {
            $dataJurnal = [
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 15111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Debit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalPembelian,
                    'status_aktif' => 1,
                ],
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 11111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Kredit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalPembelian,
                    'status_aktif' => 1
                ]
            ];

            $this->db->table('jurnal')->insertBatch($dataJurnal);
        }

        if ($tipePembayaran == 'kredit') {
            $dataJurnal = [
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 15111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Debit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalPembelian,
                    'status_aktif' => 1,
                ],
                [
                    'no_transaksi' => $setNoTransaksi,
                    'kode_akun' => 21111,
                    'deskripsi_jurnal' => $catatanTransaksi,
                    'debit_kredit' => 'Kredit',
                    'nominal_jurnal' => 0,
                    'tanggal_jurnal' => $tanggalPembelian,
                    'status_aktif' => 1
                ]
            ];

            $dataUtang = [
                'no_transaksi_pembelian' => $setNoTransaksi,
                'id_supplier' => $idSupplier,
                'total_utang_pembelian' => 0,
                'nilai_retur_pembelian' => 0,
                'sisa_utang_pembelian' => 0,
                'tanggal_utang_pembelian' => $tanggalPembelian,
                'status_utang_pembelian' => 'Belum Lunas',
                'status_aktif' => 1
            ];

            $this->db->table('jurnal')->insertBatch($dataJurnal);
            $this->db->table('utang_pembelian')->insert($dataUtang);
        }

        $this->session->set(['noPembelian' => $setNoTransaksi]);
        $this->session->set(['tipePembayaran' => $tipePembayaran]);
    }

    public function showPembelian($noTransaksiUtangPembelian)
    {
        $query = $this->db->table('detail_pembelian')
            ->select('*')
            ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_pembelian.id_bahan')
            ->where('detail_pembelian.no_transaksi_pembelian', $noTransaksiUtangPembelian)
            ->where('detail_pembelian.status_aktif', 1)
            ->get();

        return $query;
    }

    public function printInvoice($noTransaksiPembelian)
    {
        $query = $this->db->query("SELECT * FROM detail_pembelian WHERE no_transaksi_pembelian = ?", array($noTransaksiPembelian));
        // $query = $this->db->table('pembelian')
        //     ->select('*')
        //     ->join('supplier', 'supplier.id_supplier = pembelian.id_supplier')
        //     ->join('detail_pembelian', 'detail_pembelian.no_transaksi_pembelian')
        //     ->join('persediaan_bahan', 'persediaan_bahan.id_bahan = detail_pembelian.id_bahan')
        //     ->where('pembelian.no_transaksi_pembelian', $noTransaksiPembelian)
        //     ->get();

        return $query;
    }
}
