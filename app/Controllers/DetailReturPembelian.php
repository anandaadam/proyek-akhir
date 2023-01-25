<?php

namespace App\Controllers;

use App\Models\DetailPembelianModel;
use App\Models\DetailReturPembelianModel;
use App\Models\PersediaanBahanModel;

class DetailReturPembelian extends BaseController
{
    protected $detailPembelianModel;
    protected $detailReturPembelianModel;
    protected $persediaaanBahanModel;
    protected $session;

    public function __construct()
    {
        $this->detailPembelianModel = new DetailPembelianModel();
        $this->persediaaanBahanModel = new PersediaanBahanModel();
        $this->detailReturPembelianModel = new DetailReturPembelianModel();
        $this->session = session();
    }

    public function create()
    {
        session();
        $dataListBahan = $this->detailPembelianModel->getReturListBahan();

        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataListBahan' => $dataListBahan
        ];

        echo view('layouts/header', ['tittle' => 'Tambah Data Item Transaksi Retur Pembelian']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('transaksi/detail-retur-pembelian/create', $data);
        echo view('layouts/footer');
    }

    public function store()
    {
        $this->detailReturPembelianModel->storeDetailReturPembelian();
    }

    public function item()
    {
        $dataDetailReturPembelian = $this->detailReturPembelianModel->itemDetailReturPembelian();

        if ($this->request->isAJAX()) {
            $data = [
                'dataDetailReturPembelian' => $dataDetailReturPembelian
            ];

            $msg = [
                'data' => view('transaksi/detail-retur-pembelian/list-item-table', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function cancel($idDetailReturPembelian)
    {
        $this->detailReturPembelianModel->cancelDetailReturPembelian($idDetailReturPembelian);
    }

    public function save()
    {
        $this->detailReturPembelianModel->saveDetailReturPembelian();
        $this->session->setFlashdata("success", "Transaksi retur pembelian tersimpan");

        return redirect()->to('/ReturPembelian/create');
    }
}
