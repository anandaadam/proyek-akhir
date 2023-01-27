<?php

namespace App\Controllers;

use App\Models\PersediaanBahanModel;
use App\Models\JenisSatuanModel;

class PersediaanBahan extends BaseController
{
    protected $persediaanBahanModel;
    protected $jenisSatuanModel;
    protected $session;

    public function __construct()
    {
        $this->persediaanBahanModel = new PersediaanBahanModel();
        $this->jenisSatuanModel = new JenisSatuanModel();
        $this->session = session();
    }

    public function index()
    {
        $dataPersediaanBahan = $this->persediaanBahanModel->indexPersediaanBahan();

        echo view('layouts/header', ['tittle' => 'Data Persediaan Bahan']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/persediaan-bahan/index', ['dataPersediaanBahan' => $dataPersediaanBahan]);
        echo view('layouts/footer');
    }

    public function create()
    {
        $dataJenisSatuan = $this->jenisSatuanModel->indexJenisSatuan();

        session();
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataJenisSatuan' => $dataJenisSatuan
        ];
        echo view('layouts/header', ['tittle' => 'Tambah Data Persediaan Bahan']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/persediaan-bahan/create', $data);
        echo view('layouts/footer');
    }

    public function store()
    {
        if (!$this->validate([
            'nama_bahan' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama bahan wajib diisi',
                    'min_length' => 'Panjang minimal nama bahan adalah 3',
                    'max_length' => 'Panjang maksimal nama bahan adalah 50'
                ]
            ],
            'harga_bahan' => [
                'rules' => 'required|greater_than[0]|max_length[11]',
                'errors' => [
                    'required' => 'Harga bahan wajib diisi',
                    'max_length' => 'Besar maksimal harga bahan adalah 11 digit',
                    'greater_than' => 'Harga bahan tidak boleh diisi 0'
                ]
            ],
            'stok_bahan' => [
                'rules' => 'required|max_length[50]|greater_than[0]',
                'errors' => [
                    'required' => 'Stok bahan wajib diisi',
                    'max_length' => 'Besar maksimal stok bahan adalah 11 digit',
                    'greater_than' => 'Stok bahan tidak boleh diisi 0'
                ]
            ]
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('PersediaanBahan/create')->withInput()->with('messageValidation', $messageValidation);
        }

        $this->persediaanBahanModel->storePersediaanBahan();
        $this->session->setFlashdata("success", "Data Bahan Tersimpan");

        return redirect()->to('PersediaanBahan/index');
    }

    public function edit($idBahan)
    {
        session();
        $dataPersediaanBahan = $this->persediaanBahanModel->editPersediaanBahan($idBahan);
        $dataJenisSatuan = $this->jenisSatuanModel->indexJenisSatuan();
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataPersediaanBahan' => $dataPersediaanBahan,
            'dataJenisSatuan' => $dataJenisSatuan
        ];

        echo view('layouts/header', ['tittle' => 'Edit Data Persediaan Bahan']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('master-data/persediaan-bahan/edit', $data);
        echo view('layouts/footer');
    }

    public function update()
    {
        if (!$this->validate([
            'nama_bahan' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama bahan wajib diisi',
                    'min_length' => 'Panjang minimal nama bahan adalah 3',
                    'max_length' => 'Panjang maksimal nama bahan adalah 50'
                ]
            ],
            'harga_bahan' => [
                'rules' => 'required|greater_than[0]|max_length[11]',
                'errors' => [
                    'required' => 'Harga bahan wajib diisi',
                    'max_length' => 'Besar maksimal harga bahan adalah 11 digit',
                    'greater_than' => 'Harga bahan tidak boleh diisi 0'
                ]
            ],
            'stok_bahan' => [
                'rules' => 'required|max_length[11]|greater_than[0]',
                'errors' => [
                    'required' => 'Stok bahan wajib diisi',
                    'max_length' => 'Besar maksimal stok bahan adalah 11 digit',
                    'greater_than' => 'Stok bahan tidak boleh diisi 0'
                ]
            ],
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('PersediaanBahan/edit/' . $this->request->getVar('id_supplier'))->withInput()->with('messageValidation', $messageValidation);
        }

        $this->persediaanBahanModel->updatePersediaanBahan($this->request->getVar('id_bahan'));
        $this->session->setFlashdata("success", "Data Bahan Terubah");

        return redirect()->to('PersediaanBahan/index');
    }

    public function remove($idBahan)
    {
        $this->persediaanBahanModel->removePersediaanBahan($idBahan);
        $this->session->setFlashdata("success", "Data Bahan Terhapus");

        return redirect()->to('PersediaanBahan/index');
    }
}
