<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    public function login($emailPengguna)
    {
        $db = db_connect();
        $query = $db->table('pengguna')
            ->select("*")
            ->join('perusahaan', 'perusahaan.id_perusahaan = pengguna.id_perusahaan')
            ->join('tipe_pengguna', 'tipe_pengguna.id_tipe_pengguna = pengguna.id_tipe_pengguna')
            ->where('pengguna.email_pengguna', $emailPengguna)
            ->get();
        return $query;
    }

    public function register()
    {
        $db = db_connect();
        $dataPerusahaan = [
            'nama_perusahaan'  => $_POST['nama_perusahaan'],
            'telepon_perusahaan'  => $_POST['telepon_perusahaan'],
            'email_perusahaan' => $_POST['email_perusahaan'],
            'alamat_perusahaan' => $_POST['alamat_perusahaan'],
        ];
        $db->table('perusahaan')->insert($dataPerusahaan);

        $lastId = $db->insertID();

        $dataPengguna = [
            'id_perusahaan'  => $lastId,
            'id_tipe_pengguna'  => $_POST['tipe_pengguna'],
            'nama_pengguna'  => $_POST['nama_pengguna'],
            'email_pengguna' => $_POST['email_pengguna'],
            'telepon_pengguna'  => $_POST['telepon_pengguna'],
            'kata_sandi' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        ];
        $db->table('pengguna')->insert($dataPengguna);
    }
}
