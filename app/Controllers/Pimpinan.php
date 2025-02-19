<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pimpinan extends BaseController
{
    public function index()
    {
        //kembali ke tampilan pimpinan
        return view('pimpinan/show');
    }
}
