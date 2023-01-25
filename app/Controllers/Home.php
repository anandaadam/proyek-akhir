<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('layouts/header', ['tittle' => 'Dashboard']);
        echo view('layouts/body');
        echo view('layouts/sidebar');
        echo view('dashboard');
        echo view('layouts/footer');
    }
}
