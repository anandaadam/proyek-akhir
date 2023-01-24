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

    public function create($idBom = false)
    {
        session();
        if ($idBom) $namaProduk = $this->billOfMaterialModel->getNameProduk($idBom);
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataBahan' => $this->persediaanBahanModel->indexPersediaanBahan(),
            'dataProduk' => $this->billOfMaterialModel->getDataProduk(),
            'idBom' => $idBom ? $idBom : false,
            'namaProduk' => $idBom ? $namaProduk : false
        ];

        $page = $idBom ? 'add' : 'create';

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view("master-data/bill-of-material/{$page}", $data);
        echo view('layouts/footer');
    }

    public function store($idBom = false)
    {
        if ($idBom) $this->billOfMaterialModel->storeBillOfMaterial($idBom);
        if (!$idBom) $this->billOfMaterialModel->storeBillOfMaterial();

        return redirect()->to('BillOfMaterial/index');
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

    public function edit($idBom)
    {
        $data = [
            'namaProduk' => $this->billOfMaterialModel->getNameProduk($idBom),
            'dataBom' => $this->billOfMaterialModel->editBillOfMaterial($idBom),
            'dataBahan' => $this->persediaanBahanModel->indexPersediaanBahan(),
            'idBom' => $idBom
        ];

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/bill-of-material/edit', $data);
        echo view('layouts/footer');
    }

    public function update()
    {
        $this->billOfMaterialModel->updateBillOfMaterial();
        return redirect()->to('BillOfMaterial/index');
    }

    public function delete($idBom)
    {
        $data = [
            'dataBom' => $this->billOfMaterialModel->editBillOfMaterial($idBom),
            'namaProduk' => $this->billOfMaterialModel->getNameProduk($idBom),
            'idBom' => $idBom
        ];

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/bill-of-material/delete', $data);
        echo view('layouts/footer');
    }

    public function remove()
    {
        $this->billOfMaterialModel->removeBillOfMaterial();
        return redirect()->to('BillOfMaterial/index');
    }

    public function removeAll($idBom)
    {
        $this->billOfMaterialModel->removeAllBillOfMaterial($idBom);
        return redirect()->to('BillOfMaterial/index');
    }
}
