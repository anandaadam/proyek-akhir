<?php

namespace App\Controllers;

use App\Models\UtangPembelianModel;

class UtangPembelian extends BaseController
{
    protected $utangPembelianModel;

    public function __construct()
    {
        $this->utangPembelianModel = new UtangPembelianModel();
    }

    public function index()
    {
        $dataUtangPembelian = $this->utangPembelianModel->indexUtangPembelian();

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/utang-pembelian/index', ['dataUtangPembelian' => $dataUtangPembelian]);
        echo view('layouts/footer');
    }

    public function show($idUtangPembelian)
    {
        $dataUtangPembelian = $this->utangPembelianModel->showUtangPembelian($idUtangPembelian);

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/utang-pembelian/show', ['dataUtangPembelian' => $dataUtangPembelian]);
        echo view('layouts/footer');
    }
}
