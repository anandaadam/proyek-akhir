<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranUtangPembelianModel extends Model
{
    public $totalUtangPembelian;
    public $sisaUtangPembelianBaru;
    public $sisaUtangPembelianLama;
    public $dataUtangPembelian;
    public $noTransaksi;
    public $noTransaksiMax;
    protected $db;
    protected $request;
    protected $session;

    public function __construct()
    {
        $this->db = db_connect();
        $this->request = \Config\Services::request();
        $this->session = session();
    }

    public function getNoTransaksi($tanggal)
    {
        $query = $this->db->query("SELECT MAX(RIGHT(no_transaksi,4)) AS trs_max FROM transaksi WHERE DATE(tanggal_transaksi)=?", $tanggal)->getResult();

        foreach ($query as $data) {
            $this->noTransaksiMax = (int)$data->trs_max;
        }

        $this->noTransaksiMax ? $this->noTransaksi = sprintf("%04s", $this->noTransaksiMax + 1) : $this->noTransaksi = '0001';
    }

    public function storePembayaranUtangPembelian($idUtangPembelian)
    {
        $tanggalPembayaran = trim($this->request->getVar('tanggal_pembayaran'));
        $catatanTransaksi = trim($this->request->getVar('catatan_transaksi'));
        $jumlahPembayaran = trim($this->request->getVar('jumlah_pembayaran'));

        $this->getNoTransaksi($tanggalPembayaran);
        $setNoTransaksi = 'TRS' . preg_replace('/[^0-9 ]/i', '', $tanggalPembayaran) . $this->noTransaksi;

        $dataSisaUtangPembelian = $this->db->table('utang_pembelian')->select('total_utang_pembelian, sisa_utang_pembelian')->get();

        foreach ($dataSisaUtangPembelian->getResult() as $data) {
            $this->totalUtangPembelian = $data->total_utang_pembelian;
            $this->sisaUtangPembelianLama = $data->sisa_utang_pembelian;
        }

        $jumlahPembayaran = preg_replace('/[^0-9 ]/i', '', $jumlahPembayaran);
        $tanggalPembayaran = $tanggalPembayaran;
        $catatanTransaksi = $catatanTransaksi;

        $this->sisaUtangPembelianBaru = $this->sisaUtangPembelianLama - $jumlahPembayaran;

        $dataTransaksi = [
            'no_transaksi' => $setNoTransaksi,
            'id_perusahaan' => $this->session->get('idPerusahaan'),
            'catatan_transaksi' => $catatanTransaksi,
            'nominal_transaksi' => $jumlahPembayaran,
            'tanggal_transaksi' => $tanggalPembayaran,
            'status_aktif' => 1
        ];

        $dataJurnal = [
            [
                'no_transaksi' => $setNoTransaksi,
                'kode_akun' => 21111,
                'deskripsi_jurnal' => $catatanTransaksi,
                'debit_kredit' => 'Debit',
                'nominal_jurnal' => $jumlahPembayaran,
                'tanggal_jurnal' => $tanggalPembayaran,
                'status_aktif' => 1,
            ],
            [
                'no_transaksi' => $setNoTransaksi,
                'kode_akun' => 11111,
                'deskripsi_jurnal' => $catatanTransaksi,
                'debit_kredit' => 'Kredit',
                'nominal_jurnal' => $jumlahPembayaran,
                'tanggal_jurnal' => $tanggalPembayaran,
                'status_aktif' => 1
            ]
        ];

        $dataPembayaran = [
            'no_transaksi_pembayaran_utang_pembelian' => $setNoTransaksi,
            'id_utang_pembelian' => $idUtangPembelian,
            'jumlah_pembayaran_utang_pembelian' => $jumlahPembayaran,
            'tanggal_pembayaran_utang_pembelian' => $tanggalPembayaran,
            'status_aktif' => 1
        ];

        $this->db->table('transaksi')->insert($dataTransaksi);
        $this->db->table('jurnal')->insertBatch($dataJurnal);
        $this->db->table('pembayaran_utang_pembelian')->insert($dataPembayaran);

        if ($this->sisaUtangPembelianBaru == 0) {
            $this->dataUtangPembelian = [
                'sisa_utang_pembelian' => 0,
                'status_utang_pembelian' => 'Lunas'
            ];
        } else {
            $this->dataUtangPembelian = [
                'sisa_utang_pembelian' => $this->sisaUtangPembelianBaru,
            ];
        }

        $this->db->table('utang_pembelian')->where('id_utang_pembelian', $idUtangPembelian)->update($this->dataUtangPembelian);
    }
}
