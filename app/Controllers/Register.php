<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use App\Models\TipePenggunaModel;

class Register extends BaseController
{
    public function index()
    {
        session();
        $tipePenggunaModel = new TipePenggunaModel();
        $data = [
            'messageValidation' => \Config\Services::validation(),
            'dataTipePengguna' => $tipePenggunaModel->indexTipePengguna()
        ];

        echo view('auth/layouts/header');
        echo view('auth/register/register', $data);
        echo view('auth/layouts/footer');
    }

    public function register()
    {
        if (!$this->validate([
            'nama_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama perusahaan wajib diisi'
                ]
            ],
            'telepon_perusahaan' => [
                'rules' => 'required|is_unique[perusahaan.telepon_perusahaan]',
                'errors' => [
                    'required' => 'Telepon perusahaan wajib diisi',
                    'is_unique' => 'Telepon perusahaan sudah terdaftar'
                ]
            ],
            'email_perusahaan' => [
                'rules' => 'required|is_unique[perusahaan.email_perusahaan]',
                'errors' => [
                    'required' => 'Email perusahaan wajib diisi',
                    'is_unique' => 'Email perusahaan sudah terdaftar'
                ]
            ],
            'alamat_perusahaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat perusahaan wajib diisi'
                ]
            ],
            'nama_pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pengguna wajib diisi'
                ]
            ],
            'telepon_pengguna' => [
                'rules' => 'required|is_unique[pengguna.telepon_pengguna]',
                'errors' => [
                    'required' => 'Telepon pengguna wajib diisi',
                    'is_unique' => 'Telepon pengguna sudah terdaftar'
                ]
            ],
            'email_pengguna' => [
                'rules' => 'required|is_unique[pengguna.email_pengguna]',
                'errors' => [
                    'required' => 'Email pengguna wajib diisi',
                    'is_unique' => 'Email pengguna sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password pengguna wajib diisi'
                ]
            ],
            'password_confirmation' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password pengguna wajib diisi',
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password'
                ]
            ]
        ])) {
            $messageValidation = \Config\Services::validation();

            return redirect()->to('Register')->withInput()->with('messageValidation', $messageValidation);
        }

        $penggunaModel = new PenggunaModel();
        $penggunaModel->register();
        $session = session();
        $session->setFlashdata("success", "Register berhasil. Silahkan login");

        return redirect()->to('Login');
    }
}
