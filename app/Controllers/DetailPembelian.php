<?php

namespace App\Controllers;

use App\Models\PersediaanBahanModel;
use App\Models\DetailPembelianModel;

class DetailPembelian extends BaseController
{
    protected $persediaaanBahanModel;
    protected $detailPembelianModel;

    public function __construct()
    {
        $this->persediaaanBahanModel = new PersediaanBahanModel();
        $this->detailPembelianModel = new DetailPembelianModel();
    }

    public function create()
    {
        session();
        $dataBahan = $this->persediaaanBahanModel->indexPersediaanBahan();

        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataBahan' => $dataBahan
        ];

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/detail-pembelian/create', $data);
        echo view('layouts/footer');
    }

    public function store()
    {
        $this->detailPembelianModel->storeDetailPembelian();
    }

    public function item()
    {
        $dataDetailPembelian = $this->detailPembelianModel->itemDetailPembelian();

        if ($this->request->isAJAX()) {
            $data = [
                'dataDetailPembelian' => $dataDetailPembelian
            ];

            $msg = [
                'data' => view('transaksi/detail-pembelian/index', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function cancel($idDetailPembelian)
    {
        $this->detailPembelianModel->cancelDetailPembelian($idDetailPembelian);
    }

    public function save()
    {
        $this->detailPembelianModel->saveDetailPembelian();
        $session = session();
        $session->setFlashdata("success", "Transaksi pembelian tersimpan");

        return redirect()->to('/Pembelian/create');
    }
}
