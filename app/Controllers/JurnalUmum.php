<?php

namespace App\Controllers;

use App\Models\JurnalUmumModel;

class JurnalUmum extends BaseController
{
    public function index()
    {
        $jurnalUmumModel = new JurnalUmumModel();
        $dataTahun = $jurnalUmumModel->getPeriodeTahun();

        echo view('layouts/header', ['tittle' => 'Jurnal Umum']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('laporan/jurnal-umum/index', ['dataTahun' => $dataTahun]);
        echo view('layouts/footer');
    }

    public function show($periodeTahun, $periodeBulan)
    {
        $jurnalUmumModel = new JurnalUmumModel();
        $dataJurnalUmum = $jurnalUmumModel->showJurnalUmum($periodeTahun, $periodeBulan);

        if ($this->request->isAJAX()) {
            $data = [
                'dataJurnalUmum' => $dataJurnalUmum
            ];

            $msg = [
                'data' => view('laporan/jurnal-umum/show', $data)
            ];

            echo json_encode($msg);
        }
    }
}
