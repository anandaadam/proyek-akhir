<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuBesarModel;

class BukuBesar extends BaseController
{
    public function index()
    {
        $bukuBesarModel = new BukuBesarModel();
        $dataAkun = $bukuBesarModel->getAkun();
        $dataTahun = $bukuBesarModel->getPeriodeTahun();

        $data = [
            'dataAkun' => $dataAkun,
            'dataTahun' => $dataTahun
        ];

        echo view('layouts/header');
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('laporan/buku-besar/index', $data);
        echo view('layouts/footer');
    }

    public function show($kodeAkun, $periodeTahun, $periodeBulan)
    {
        $bukuBesarModel = new BukuBesarModel();
        $dataDebit = $bukuBesarModel->getNominalDebit($kodeAkun, $periodeTahun, $periodeBulan);
        $dataKredit = $bukuBesarModel->getNominalCredit($kodeAkun, $periodeTahun, $periodeBulan);
        $dataSaldoAwal = $dataDebit - $dataKredit;
        $dataBukuBesar = $bukuBesarModel->showBukuBesar($kodeAkun, $periodeTahun, $periodeBulan);

        // return (string)$dataSaldoAwal;

        if ($this->request->isAJAX()) {
            $data = [
                'dataSaldoAwal' => $dataSaldoAwal,
                'dataBukuBesar' => $dataBukuBesar
            ];

            $msg = [
                'data' => view('laporan/buku-besar/show', $data)
            ];

            echo json_encode($msg);
        }
    }
}
