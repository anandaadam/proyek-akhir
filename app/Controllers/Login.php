<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Login extends BaseController
{
    public $idPerusahaan;
    public $namaPerusahaan;
    public $idPengguna;
    public $namaPengguna;
    public $tipePengguna;
    public $passwordPengguna;

    public function index($message = false)
    {
        session();
        $data = [];

        if ($message == false) {
            $data = [
                'messageValidation' => \Config\Services::validation(),
                'message' => false
            ];
        } else {
            $data = [
                'messageValidation' => \Config\Services::validation(),
                'message' => $message
            ];
        }

        echo view('auth/layouts/header');
        echo view('auth/login/login', $data);
        echo view('auth/layouts/footer');
    }

    public function login()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email anda wajib diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password anda wajib diisi',
                ]
            ],
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('Login')->withInput()->with('messageValidation', $messageValidation);
        }

        $penggunaModel = new PenggunaModel();
        $loginPengguna = $penggunaModel->login($_POST['email']);

        foreach ($loginPengguna->getResult() as $pengguna) {
            $this->idPerusahaan = $pengguna->id_perusahaan;
            $this->namaPerusahaan = $pengguna->nama_perusahaan;
            $this->idPengguna = $pengguna->id_pengguna;
            $this->namaPengguna = $pengguna->nama_pengguna;
            $this->tipePengguna = $pengguna->nama_tipe_pengguna;
            $this->passwordPengguna = $pengguna->kata_sandi;
        }

        if ($this->namaPengguna == NULL) {
            return $this->index('Email yang anda masukkan tidak terdaftar');
        }
        if ($this->namaPengguna !== NULL) {
            if (password_verify($_POST['password'], $this->passwordPengguna)) {
                $session = session();
                $data = [
                    'loggedIn'     => TRUE,
                    'idPerusahaan'     => $this->idPerusahaan,
                    'namaPerusahaan' => $this->namaPerusahaan,
                    'idPengguna' => $this->idPengguna,
                    'namaPengguna' => $this->namaPengguna,
                    'tipePengguna' => $this->tipePengguna,
                ];
                $session->set($data);

                return redirect()->to('/');
            } else {
                return $this->index('Password tidak cocok dengan email');
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('Login');
    }
}
