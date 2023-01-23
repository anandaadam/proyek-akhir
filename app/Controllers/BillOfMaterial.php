<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BillOfMaterialModel;
use App\Models\PersediaanBahanModel;

class BillOfMaterial extends BaseController
{
    protected $billOfMaterialModel;
    protected $persediaanBahanModel;
    protected $session;

    public function __construct()
    {
        $this->billOfMaterialModel = new BillOfMaterialModel();
        $this->persediaanBahanModel = new PersediaanBahanModel();
        $this->session = session();
    }

    public function index()
    {
        $dataBillOfMaterial = $this->billOfMaterialModel->indexBillOfMaterial();

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/bill-of-material/index', ['dataBillOfMaterial' => $dataBillOfMaterial]);
        echo view('layouts/footer');
    }

    public function create()
    {
        session();
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataBahan' => $this->persediaanBahanModel->indexPersediaanBahan(),
            'dataProduk' => $this->billOfMaterialModel->getDataProduk()
        ];

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/bill-of-material/create', $data);
        echo view('layouts/footer');
    }

    public function store()
    {
    }

    public function show($idBom)
    {
        $dataBillOfMaterial = $this->billOfMaterialModel->showBillOfMaterial($idBom);

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/bill-of-material/show', ['dataBillOfMaterial' => $dataBillOfMaterial]);
        echo view('layouts/footer');
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function remove()
    {
    }
}
