<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    protected $supplierModel;
    protected $session;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->session = session();
    }

    public function index()
    {
        $dataSupplier = $this->supplierModel->indexSupplier();

        echo view('layouts/header', ['tittle' => 'Data Supplier']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/supplier/index', ['dataSupplier' => $dataSupplier]);
        echo view('layouts/footer');
    }

    public function create()
    {
        session();
        $data = [
            'messageValidation' => \Config\Services::validation()
        ];

        echo view('layouts/header', ['tittle' => 'Tambah Data Supplier']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/supplier/create', $data);
        echo view('layouts/footer');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Supplier wajib diisi'
                ]
            ],
            'telepon_supplier' => [
                'rules' => 'required|is_unique[supplier.telepon_supplier]',
                'errors' => [
                    'required' => 'Telepon supplier wajib diisi',
                    'is_unique' => 'Telepon supplier sudah terdaftar'
                ]
            ],
            'alamat_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat supplier wajib diisi'
                ]
            ]
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('Supplier/create')->withInput()->with('messageValidation', $messageValidation);
        }

        $this->supplierModel->storeSupplier();
        $this->session->setFlashdata("success", "Data Supplier Tersimpan");

        return redirect()->to('Supplier/index');
    }

    public function edit($idSupplier)
    {
        session();
        $dataSupplier = $this->supplierModel->editSupplier($idSupplier);
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataSupplier' => $dataSupplier
        ];

        echo view('layouts/header', ['tittle' => 'Edit Data Supplier']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/supplier/edit', $data);
        echo view('layouts/footer');
    }

    public function update()
    {
        if (!$this->validate([
            'nama_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Supplier wajib diisi'
                ]
            ],
            'telepon_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Telepon supplier wajib diisi',
                ]
            ],
            'alamat_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat supplier wajib diisi'
                ]
            ]
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('Supplier/edit/' . $this->request->getVar('id_supplier'))->withInput()->with('messageValidation', $messageValidation);
        }

        $this->supplierModel->updateSupplier($this->request->getVar('id_supplier'));
        $this->session->setFlashdata("success", "Data Supplier Terubah");

        return redirect()->to('Supplier/index');
    }

    public function remove($idSupplier)
    {
        $this->supplierModel->removeSupplier($idSupplier);
        $this->session->setFlashdata("success", "Data Supplier Terhapus");

        return redirect()->to('Supplier/index');
    }
}
