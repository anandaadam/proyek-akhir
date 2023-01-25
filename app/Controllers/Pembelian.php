<?php

namespace App\Controllers;

use App\Models\PembelianModel;
use App\Models\SupplierModel;
use Dompdf\Dompdf;

class Pembelian extends BaseController
{
    protected $pembelianModel;
    protected $supplierModel;

    public function __construct()
    {
        $this->pembelianModel = new PembelianModel();
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        $dataPembelian = $this->pembelianModel->indexPembelian();

        echo view('layouts/header', ['tittle' => 'Data Transaksi Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/pembelian/index', ['dataPembelian' => $dataPembelian]);
        echo view('layouts/footer');
    }

    public function create()
    {
        session();
        $dataSupplier = $this->supplierModel->indexSupplier();

        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataSupplier' => $dataSupplier,
        ];

        echo view('layouts/header', ['tittle' => 'Tambah Data Transaksi Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/pembelian/create', $data);
        echo view('layouts/footer');
    }

    public function store()
    {
        if (!$this->validate([
            'catatan_transaksi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Catatan transaksi wajib diisi'
                ]
            ],
            'tipe_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe pembayaran wajib diisi'
                ]
            ],
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('Pembelian/create')->withInput()->with('messageValidation', $messageValidation);
        }

        $this->pembelianModel->storePembelian();

        return redirect()->to('DetailPembelian/create');
    }

    public function show($noTransaksiPembelian)
    {
        $dataPembelian = $this->pembelianModel->showPembelian($noTransaksiPembelian);

        echo view('layouts/header', ['tittle' => 'Data Detail Transaksi Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/pembelian/show', ['dataPembelian' => $dataPembelian]);
        echo view('layouts/footer');
    }

    public function printInvoice($noTransaksiPembelian)
    {
        $dataPembelian = $this->pembelianModel->printInvoice($noTransaksiPembelian);

        $dompdf = new Dompdf();
        $html = view('transaksi/pembelian/invoice', ['dataPembelian' => $dataPembelian]);
        $dompdf->loadHtml($html);

        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();
        $dompdf->stream();
    }
}
