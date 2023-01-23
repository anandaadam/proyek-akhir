<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalUmumModel extends Model
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
        WHERE transaksi.id_perusahaan = ? ORDER BY jurnal.tanggal_jurnal ASC", $this->session->get('idPerusahaan'));

        return $query;
    }

    public function showJurnalUmum($periodeTahun, $periodeBulan)
    {
        $query = $this->db->table('jurnal')
            ->select('*')
            ->join('bagan_akun', 'bagan_akun.kode_akun = jurnal.kode_akun')
            ->join('transaksi', 'transaksi.no_transaksi = jurnal.no_transaksi')
            ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
            ->where('jurnal.status_aktif', 1)
            ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%Y')", $periodeTahun)
            ->where("DATE_FORMAT(jurnal.tanggal_jurnal, '%m')", $periodeBulan)
            ->orderBy('jurnal.no_transaksi', 'ASC')
            ->orderBy('jurnal.debit_kredit', 'ASC')
            ->get();

        return $query;
    }
}
