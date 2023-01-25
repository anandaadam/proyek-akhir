<?php

namespace App\Controllers;

use App\Models\UtangPembelianModel;
use App\Models\PembayaranUtangPembelianModel;

class PembayaranUtangPembelian extends BaseController
{
    protected $utangPembelianModel;
    protected $pembayaranUtangPembelianModel;
    protected $session;

    public function __construct()
    {
        $this->utangPembelianModel = new UtangPembelianModel();
        $this->pembayaranUtangPembelianModel = new PembayaranUtangPembelianModel();
        $this->session = session();
    }

    public function create($idUtangPembelian)
    {
        session();
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'idUtangPembelian' => $idUtangPembelian
        ];

        echo view('layouts/header', ['tittle' => 'Tambah Data Pembayaran Utang Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/pembayaran-utang-pembelian/create', $data);
        echo view('layouts/footer');
    }

    public function store($idUtangPembelian)
    {
        if (!$this->validate([
            'tanggal_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal pembayaran wajib diisi'
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah pembayaran wajib diisi',
                ]
            ],
            'catatan_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Catatan transaksi wajib diisi'
                ]
            ]
        ])) {
            $messageValidation = \Config\Services::validation();
            return redirect()->to('PembayaranUtangPembelian/create/' . $idUtangPembelian)->withInput()->with('messageValidation', $messageValidation);
        }

        $this->pembayaranUtangPembelianModel->storePembayaranUtangPembelian($idUtangPembelian);
        $this->session->setFlashdata("success", "Pembayaran utang tersimpan");

        return redirect()->to('UtangPembelian/index');
    }
}
