<?php

namespace App\Controllers;

use App\Models\ReturPembelianModel;


class ReturPembelian extends BaseController
{
    public $isNew;
    protected $returPembelianModel;

    public function __construct()
    {
        $this->returPembelianModel = new ReturPembelianModel();
    }

    public function index()
    {
        $dataReturPembelian = $this->returPembelianModel->indexReturPembelian();

        echo view('layouts/header', ['tittle' => 'Data Transaksi Retur Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/retur-pembelian/index', ['dataReturPembelian' => $dataReturPembelian]);
        echo view('layouts/footer');
    }

    public function create($noPembelian = false)
    {
        $this->isNew = $noPembelian;
        session();
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'isNew' => $this->isNew
        ];

        if (!$noPembelian) {
            echo view('layouts/header', ['tittle' => 'Tambah Data Transaksi Retur Pembelian']);
            echo view('layouts/body');
            echo view('layouts/sidebar');
            echo view('transaksi/retur-pembelian/create', $data);
            echo view('layouts/footer');
        }

        if ($noPembelian) {
            $dataPembelian = $this->returPembelianModel->findPembelian($noPembelian);
            $data = [
                'messageValidation' => \Config\Services::validation(),
                'dataPembelian' => $dataPembelian,
                'isNew' => $this->isNew
            ];

            echo view('layouts/header', ['tittle' => 'Tambah Data Transaksi Retur Pembelian']);
            echo view('layouts/body');
            echo view('layouts/sidebar');
            echo view('transaksi/retur-pembelian/create', $data);
            echo view('layouts/footer');
        }
    }

    public function find()
    {
        if (!$this->validate([
            'nomor_pembelian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor pembelian wajib diisi'
                ]
            ],
        ])) {
            $messageValidation = \Config\Services::validation();
            return redirect()->to('ReturPembelian/create')->withInput()->with('messageValidation', $messageValidation);
        }

        return redirect()->to('ReturPembelian/create/' . trim($this->request->getVar('nomor_pembelian')));
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
            'tanggal_retur_pembelian' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal retur pembelian wajib diisi'
                ]
            ],
        ])) {
            $messageValidation = \Config\Services::validation();
            return redirect()->to('ReturPembelian/create/' . trim($this->request->getVar('nomor_pembelian')))->withInput()->with('messageValidation', $messageValidation);
        }

        $this->returPembelianModel->storeReturPembelian();
        return redirect()->to('DetailReturPembelian/create');
    }

    public function show($noReturPembelian)
    {
        $dataReturPembelian = $this->returPembelianModel->showReturPembelian($noReturPembelian);

        echo view('layouts/header', ['tittle' => 'Data Detail Transaksi Retur Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/retur-pembelian/show', ['dataReturPembelian' => $dataReturPembelian]);
        echo view('layouts/footer');
    }
}
