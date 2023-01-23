<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuBesarModel extends Model
{
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->db = db_connect();
        $this->session = session();
    }

    public function getPeriodeTahun()
    {
        $query = $this->db->query("SELECT DISTINCT(YEAR(jurnal.tanggal_jurnal)) as tahun FROM jurnal 
        JOIN transaksi ON jurnal.no_transaksi = transaksi.no_transaksi 
        WHERE transaksi.id_perusahaan = ? ORDER BY tahun ASC", $this->session->get('idPerusahaan'));

        return $query;
    }

    public function getAkun()
    {
        $query = $this->db->table('jurnal')
            ->select('*')
            ->join('bagan_akun', 'bagan_akun.kode_akun = jurnal.kode_akun')
            ->join('transaksi', 'transaksi.no_transaksi = jurnal.no_transaksi')
            ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
            ->groupBy('jurnal.kode_akun')
            ->orderBy('jurnal.kode_akun', 'ASC')
            ->get();

        return $query;
    }

    public function getNominalDebit($kodeAkun, $periodeTahun, $periodeBulan)
    {
        $periode = $periodeTahun . "-" . $periodeBulan;

        $query = $this->db->query("SELECT jurnal.nominal_jurnal FROM jurnal JOIN transaksi ON jurnal.no_transaksi = transaksi.no_transaksi
        WHERE transaksi.id_perusahaan = ? AND jurnal.kode_akun = ? AND DATE_FORMAT(jurnal.tanggal_jurnal, '%Y%m') < ? AND jurnal.debit_kredit = 'Debit'", array($this->session->get('idPerusahaan'), $kodeAkun, $periode));

        // $query = $this->db->table('jurnal')
        //     ->select('*')
        //     ->join('transaksi', 'transaksi.no_transaksi = jurnal.no_transaksi')
        //     ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
        //     ->where('jurnal.debit_kredit', 'Debit')
        //     ->where('jurnal.kode_akun', $kodeAkun)
        //     ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%Y') <", $periodeTahun)
        //     ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%m') <", $periodeBulan)
        //     ->get();

        $nilaiDebit = 0;
        foreach ($query->getResult() as $data) {
            $nilaiDebit += $data->nominal_jurnal;
        }

        return $nilaiDebit;
    }

    public function getNominalCredit($kodeAkun, $periodeTahun, $periodeBulan)
    {
        $periode = $periodeTahun . "-" . $periodeBulan;

        $query = $this->db->query("SELECT jurnal.nominal_jurnal FROM jurnal JOIN transaksi ON jurnal.no_transaksi = transaksi.no_transaksi
        WHERE transaksi.id_perusahaan = ? AND jurnal.kode_akun = ? AND DATE_FORMAT(jurnal.tanggal_jurnal, '%Y%m') < ? AND jurnal.debit_kredit = 'Kredit'", array($this->session->get('idPerusahaan'), $kodeAkun, $periode));

        // $query = $this->db->table('jurnal')
        //     ->select('*')
        //     ->join('transaksi', 'transaksi.no_transaksi = jurnal.no_transaksi')
        //     ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
        //     ->where('jurnal.debit_kredit', 'Kredit')
        //     ->where('jurnal.kode_akun', $kodeAkun)
        //     ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%Y') <", $periodeTahun)
        //     ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%m') <", $periodeBulan)
        //     ->get();

        $nilaiKredit = 0;
        foreach ($query->getResult() as $data) {
            $nilaiKredit += $data->nominal_jurnal;
        }

        return $nilaiKredit;
    }

    public function showBukuBesar($kodeAkun, $periodeTahun, $periodeBulan)
    {
        // $query = $this->db->query("SELECT jurnal.*, transaksi.*, bagan_akun.* FROM jurnal JOIN transaksi ON jurnal.no_transaksi = transaksi.no_transaksi JOIN
        // bagan_akun ON jurnal.kode_akun = bagan_akun.kode_akun WHERE transaksi.id_perusahaan = 1 and jurnal.kode_akun = 11111");

        // return $query;

        $query = $this->db->table('jurnal')
            ->select('*')
            ->join('bagan_akun', 'bagan_akun.kode_akun = jurnal.kode_akun')
            ->join('transaksi', 'transaksi.no_transaksi = jurnal.no_transaksi')
            ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
            ->where('jurnal.kode_akun', $kodeAkun)
            ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%Y')", $periodeTahun)
            ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%m')", $periodeBulan)
            ->get();

        return $query;
    }
}

// SELECT jurnal.nominal_jurnal 
// FROM jurnal JOIN transaksi
// ON jurnal.no_transaksi = transaksi.no_transaksi
// WHERE transaksi.id_perusahaan = 1 AND jurnal.debit_kredit = 'Kredit' 
// AND jurnal.kode_akun = 11111 AND
// DATE_FORMAT(jurnal.tanggal_jurnal, '%Y%m') < '2023-12'
