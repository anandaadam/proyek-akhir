<?php

namespace App\Models;

use CodeIgniter\Model;

class UtangPembelianModel extends Model
{
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->db = db_connect();
        $this->session = session();
    }

    public function indexUtangPembelian()
    {
        $query = $this->db->table('utang_pembelian')
            ->select('*')
            ->join('supplier', 'supplier.id_supplier = utang_pembelian.id_supplier')
            ->join('pembelian', 'pembelian.no_transaksi_pembelian = utang_pembelian.no_transaksi_pembelian')
            ->join('transaksi', 'transaksi.no_transaksi = pembelian.no_transaksi_pembelian')
            ->where('utang_pembelian.status_aktif', 1)
            ->where('transaksi.id_perusahaan', $this->session->get('idPerusahaan'))
            ->orderBy('utang_pembelian.id_utang_pembelian', 'DESC')
            ->get();

        return $query;
    }

    public function showUtangPembelian($idUtangPembelian)
    {
        $query = $this->db->table('pembayaran_utang_pembelian')
            ->where('id_utang_pembelian', $idUtangPembelian)
            ->where('status_aktif', 1)
            ->orderBy('no_transaksi_pembayaran_utang_pembelian', 'DESC')
            ->get();

        return $query;
    }
}
